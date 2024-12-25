<?php

/**
 * Profile filter form base class.
 *
 * @author     Your name here
 */
abstract class BaseProfileFormFilter extends BaseFormFilterDoctrine
{
    public function setup()
    {
        $this->setWidgets(['user_id'    => new sfWidgetFormDoctrineChoice(['model' => $this->getRelatedModelName('User'), 'add_empty' => true]), 'first_name' => new sfWidgetFormFilterInput(), 'last_name'  => new sfWidgetFormFilterInput()]);

        $this->setValidators(['user_id'    => new sfValidatorDoctrineChoice(['required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id']), 'first_name' => new sfValidatorPass(['required' => false]), 'last_name'  => new sfValidatorPass(['required' => false])]);

        $this->widgetSchema->setNameFormat('profile_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName()
    {
        return 'Profile';
    }

    public function getFields()
    {
        return ['id'         => 'Number', 'user_id'    => 'ForeignKey', 'first_name' => 'Text', 'last_name'  => 'Text'];
    }
}
