<?php

/**
 * FormGeneratorTest2 filter form base class.
 *
 * @author     Your name here
 */
abstract class BaseFormGeneratorTest2FormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(['name' => new sfWidgetFormFilterInput()]);

    $this->setValidators(['name' => new sfValidatorPass(['required' => false])]);

    $this->widgetSchema->setNameFormat('form_generator_test2_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FormGeneratorTest2';
  }

  public function getFields()
  {
    return ['id'   => 'Number', 'name' => 'Text'];
  }
}
