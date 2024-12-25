[?php

/**
 * <?php echo $this->table->getOption('name') ?> filter form.
 *
 * @author     ##AUTHOR_NAME##
 */
class <?php echo $this->table->getOption('name') ?>FormFilter extends Base<?php echo $this->table->getOption('name') ?>FormFilter
{
<?php if ($parent = $this->getParentModel()): ?>
  /**
   * @see <?php echo $parent ?>FormFilter
   */
  public function configure()
  {
    parent::configure();
  }
<?php else: ?>
  public function configure()
  {
  }
<?php endif; ?>
}
