<?php

/**
 * Author form base class.
 *
 * @method Author getObject() Returns the current form's model object
 *
 * @author     Your name here
 */
abstract class BaseAuthorForm extends BaseFormDoctrine
{
    public function setup()
    {
        $this->setWidgets(['id'   => new sfWidgetFormInputHidden(), 'name' => new sfWidgetFormInputText(), 'type' => new sfWidgetFormInputText()]);

        $this->setValidators(['id'   => new sfValidatorChoice(['choices' => [$this->getObject()->get('id')], 'empty_value' => $this->getObject()->get('id'), 'required' => false]), 'name' => new sfValidatorString(['max_length' => 255, 'required' => false]), 'type' => new sfValidatorString(['max_length' => 255, 'required' => false])]);

        $this->widgetSchema->setNameFormat('author[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName()
    {
        return 'Author';
    }
}
