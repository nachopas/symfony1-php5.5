<?php

/**
 * DefaultValueTest filter form base class.
 *
 * @author     Your name here
 */
abstract class BaseDefaultValueTestFormFilter extends BaseFormFilterDoctrine
{
    public function setup()
    {
        $this->setWidgets(['name' => new sfWidgetFormFilterInput(['with_empty' => false])]);

        $this->setValidators(['name' => new sfValidatorPass(['required' => false])]);

        $this->widgetSchema->setNameFormat('default_value_test_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName()
    {
        return 'DefaultValueTest';
    }

    public function getFields()
    {
        return ['id'   => 'Number', 'name' => 'Text'];
    }
}
