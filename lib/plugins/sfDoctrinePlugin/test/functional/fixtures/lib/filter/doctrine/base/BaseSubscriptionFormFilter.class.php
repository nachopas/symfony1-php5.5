<?php

/**
 * Subscription filter form base class.
 *
 * @author     Your name here
 */
abstract class BaseSubscriptionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(['name'   => new sfWidgetFormFilterInput(), 'status' => new sfWidgetFormChoice(['choices' => ['' => '', 'New' => 'New', 'Active' => 'Active', 'Pending' => 'Pending', 'Expired' => 'Expired']])]);

    $this->setValidators(['name'   => new sfValidatorPass(['required' => false]), 'status' => new sfValidatorChoice(['required' => false, 'choices' => ['New' => 'New', 'Active' => 'Active', 'Pending' => 'Pending', 'Expired' => 'Expired']])]);

    $this->widgetSchema->setNameFormat('subscription_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Subscription';
  }

  public function getFields()
  {
    return ['id'     => 'Number', 'name'   => 'Text', 'status' => 'Enum'];
  }
}
