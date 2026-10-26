<?php

require_once dirname(__FILE__).'/../../../../vendor/lime/lime.php';
require_once dirname(__FILE__).'/../../lib/vendor/doctrine/Doctrine/Core.php';
spl_autoload_register(array('Doctrine_Core', 'autoload'));

$t = new lime_test(34);
$dsn = getenv('DOCTRINE_TEST_MYSQL_DSN');
if (!$dsn)
{
  $t->skip('Set DOCTRINE_TEST_MYSQL_DSN, DOCTRINE_TEST_MYSQL_USER and DOCTRINE_TEST_MYSQL_PASSWORD to run MySQL integration tests.', 34);
  return;
}

$pdo = new PDO($dsn, getenv('DOCTRINE_TEST_MYSQL_USER'), getenv('DOCTRINE_TEST_MYSQL_PASSWORD'), array(
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
));
$connection = Doctrine_Manager::connection($pdo, 'migration_mysql_test');

class MysqlTestMigration extends Doctrine_Migration
{
  protected $_migrationTableName = 'doctrine_test_migration_version';
  protected $_migrationTableCreated = true;
}

class MysqlTestSchemaMigration extends Doctrine_Migration_Base
{
  public function up()
  {
    $this->addColumn('doctrine_test_migration_data', 'value', 'integer', 4);
  }
}

class MysqlTestDataMigration extends Doctrine_Migration_Base
{
  public function up()
  {
    Doctrine_Manager::getInstance()->getConnection('migration_mysql_test')
      ->exec('INSERT INTO doctrine_test_migration_data (id, value) VALUES (1, 10)');
  }

  public function down()
  {
    Doctrine_Manager::getInstance()->getConnection('migration_mysql_test')
      ->exec('DELETE FROM doctrine_test_migration_data WHERE id = 1');
  }
}

class MysqlTestFailingMigration extends Doctrine_Migration_Base
{
  public function up()
  {
    $this->addColumn('doctrine_test_migration_data', 'failure_probe', 'integer', 4);
    $this->addColumn('doctrine_test_migration_data', 'failure_probe', 'integer', 4);
  }
}

try
{
  $pdo->exec('CREATE TEMPORARY TABLE doctrine_test_migration_version (version INT) ENGINE=InnoDB');
  $pdo->exec('INSERT INTO doctrine_test_migration_version VALUES (0)');
  $pdo->exec('CREATE TEMPORARY TABLE doctrine_test_migration_data (id INT PRIMARY KEY) ENGINE=InnoDB');

  $migration = new MysqlTestMigration(null, $connection);
  $migration->loadMigrationClass('MysqlTestSchemaMigration');
  $migration->loadMigrationClass('MysqlTestDataMigration');
  $migration->loadMigrationClass('MysqlTestFailingMigration');

  $t->is($migration->migrate(1), 1, 'DDL migration succeeds after an implicit commit');
  $t->is($migration->getCurrentVersion(), 1, 'DDL migration persists its version');
  $t->is(count($pdo->query("SHOW COLUMNS FROM doctrine_test_migration_data LIKE 'value'")->fetchAll()), 1, 'DDL change is applied');
  $t->is($connection->getTransactionLevel(), 0, 'DDL commit resets Doctrine transaction nesting');
  $t->ok(!$pdo->inTransaction(), 'DDL commit leaves no PDO transaction');
  $t->is($migration->getNumErrors(), 0, 'Successful DDL migration records no errors');

  $t->is($migration->migrate(2, true), 2, 'DML dry run completes');
  $t->is($migration->getCurrentVersion(), 1, 'DML dry run does not advance the version');
  $t->is((int) $pdo->query('SELECT COUNT(*) FROM doctrine_test_migration_data')->fetchColumn(), 0, 'DML dry run rolls back its data');
  $t->is($connection->getTransactionLevel(), 0, 'DML dry run resets nesting');

  $t->is($migration->migrate(2), 2, 'A subsequent DML migration succeeds');
  $t->is($migration->getCurrentVersion(), 2, 'DML migration advances the version');
  $t->is((int) $pdo->query('SELECT value FROM doctrine_test_migration_data WHERE id = 1')->fetchColumn(), 10, 'DML changes are committed');
  $t->is($migration->migrate(1), 1, 'Down migration succeeds');
  $t->is($migration->getCurrentVersion(), 1, 'Down migration updates the version');
  $t->is((int) $pdo->query('SELECT COUNT(*) FROM doctrine_test_migration_data')->fetchColumn(), 0, 'Down migration removes its data');

  $connection->beginTransaction();
  $connection->exec('INSERT INTO doctrine_test_migration_data (id, value) VALUES (2, 20)');
  $connection->rollback();
  $t->is((int) $pdo->query('SELECT COUNT(*) FROM doctrine_test_migration_data')->fetchColumn(), 0, 'Ordinary transactions still roll back');
  $t->is($connection->getTransactionLevel(), 0, 'Ordinary rollback resets nesting');

  $connection->beginTransaction();
  $connection->beginTransaction();
  $connection->exec('INSERT INTO doctrine_test_migration_data (id, value) VALUES (2, 20)');
  $connection->commit();
  $t->ok($pdo->inTransaction(), 'Nested commit preserves the outer transaction');
  $connection->rollback();
  $t->is((int) $pdo->query('SELECT COUNT(*) FROM doctrine_test_migration_data')->fetchColumn(), 0, 'Outer rollback still rolls back nested work');

  foreach (array('commit', 'rollback') as $method)
  {
    try
    {
      $connection->$method();
      $t->fail($method.' without a Doctrine transaction must throw');
    }
    catch (Doctrine_Transaction_Exception $e)
    {
      $t->pass($method.' without a Doctrine transaction still throws');
    }
  }

  $migration->migrate(2);
  try
  {
    $migration->migrate(3);
    $t->fail('A failing DDL migration must throw');
  }
  catch (Doctrine_Migration_Exception $e)
  {
    $t->ok(strpos($e->getMessage(), 'failure_probe') !== false, 'DDL failure reports the original SQL error, not a rollback error');
  }
  $t->is($migration->getCurrentVersion(), 2, 'Failed DDL does not advance the version');
  $t->is($migration->getNumErrors(), 1, 'Failed DDL records the original error');
  $t->is($connection->getTransactionLevel(), 0, 'Failed DDL resets Doctrine nesting');
  $t->is(count($pdo->query("SHOW COLUMNS FROM doctrine_test_migration_data LIKE 'failure_probe'")->fetchAll()), 1, 'DDL preceding a failure remains applied in MySQL');

  $connection->beginTransaction();
  $t->ok($pdo->inTransaction(), 'A new transaction can start after failed DDL');
  $connection->rollback();

  $pdo->exec('ALTER TABLE doctrine_test_migration_data DROP COLUMN failure_probe');
  $t->is($migration->migrate(3, true), false, 'Failing DDL dry run returns false without masking the SQL error');
  $t->is($migration->getCurrentVersion(), 2, 'Failing DDL dry run does not advance the version');

  $pdo->exec('ALTER TABLE doctrine_test_migration_data DROP COLUMN value');
  $migration->setCurrentVersion(0);
  $t->is($migration->migrate(1, true), 1, 'Successful DDL dry run handles the implicit commit');
  $t->is($migration->getCurrentVersion(), 0, 'Successful DDL dry run does not advance the version');
  $t->is($connection->getTransactionLevel(), 0, 'Successful DDL dry run resets nesting');
  $t->is(count($pdo->query("SHOW COLUMNS FROM doctrine_test_migration_data LIKE 'value'")->fetchAll()), 1, 'MySQL cannot undo schema changes even in a successful dry run');
}
finally
{
  if ($pdo->inTransaction())
  {
    $pdo->rollBack();
  }
  $pdo->exec('DROP TEMPORARY TABLE IF EXISTS doctrine_test_migration_data');
  $pdo->exec('DROP TEMPORARY TABLE IF EXISTS doctrine_test_migration_version');
}
