<?php

/**
 * AuthorInheritanceConcrete form base class.
 *
 * @method AuthorInheritanceConcrete getObject() Returns the current form's model object
 *
 * @author     Your name here
 */
abstract class BaseAuthorInheritanceConcreteForm extends AuthorForm
{
    protected function setupInheritance()
    {
        parent::setupInheritance();

        $this->widgetSchema['additional'] = new sfWidgetFormInputText();
        $this->validatorSchema['additional'] = new sfValidatorString(['max_length' => 255, 'required' => false]);

        $this->widgetSchema->setNameFormat('author_inheritance_concrete[%s]');
    }

    public function getModelName()
    {
        return 'AuthorInheritanceConcrete';
    }
}
