<?php

/**
 * UniqueTest filter form base class.
 *
 * @author     Your name here
 */
abstract class BaseUniqueTestFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(['unique_test1' => new sfWidgetFormFilterInput(), 'unique_test2' => new sfWidgetFormFilterInput(), 'unique_test3' => new sfWidgetFormFilterInput(), 'unique_test4' => new sfWidgetFormFilterInput()]);

    $this->setValidators(['unique_test1' => new sfValidatorPass(['required' => false]), 'unique_test2' => new sfValidatorPass(['required' => false]), 'unique_test3' => new sfValidatorPass(['required' => false]), 'unique_test4' => new sfValidatorPass(['required' => false])]);

    $this->widgetSchema->setNameFormat('unique_test_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UniqueTest';
  }

  public function getFields()
  {
    return ['id'           => 'Number', 'unique_test1' => 'Text', 'unique_test2' => 'Text', 'unique_test3' => 'Text', 'unique_test4' => 'Text'];
  }
}
