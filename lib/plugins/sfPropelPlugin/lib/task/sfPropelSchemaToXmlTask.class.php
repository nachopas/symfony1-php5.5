<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(__DIR__.'/sfPropelBaseTask.class.php');

/**
 * Creates schema.yml from schema.xml.
 *
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 */
class sfPropelSchemaToXmlTask extends sfPropelBaseTask
{
    /**
     * @see sfTask
     */
    protected function configure()
    {
        $this->namespace = 'propel';
        $this->name = 'schema-to-xml';
        $this->briefDescription = 'Creates schema.xml from schema.yml';

        $this->detailedDescription = <<<EOF
The [propel:schema-to-xml|INFO] task converts YML schemas to XML:

  [./symfony propel:schema-to-xml|INFO]
EOF;
    }

    /**
     * @see sfTask
     */
    protected function execute($arguments = [], $options = [])
    {
        $this->schemaToXML(self::CHECK_SCHEMA);
    }
}
