<?php

/**
 * AuthorInheritanceConcrete filter form base class.
 *
 * @author     Your name here
 */
abstract class BaseAuthorInheritanceConcreteFormFilter extends AuthorFormFilter
{
    protected function setupInheritance()
    {
        parent::setupInheritance();

        $this->widgetSchema['additional'] = new sfWidgetFormFilterInput();
        $this->validatorSchema['additional'] = new sfValidatorPass(['required' => false]);

        $this->widgetSchema->setNameFormat('author_inheritance_concrete_filters[%s]');
    }

    public function getModelName()
    {
        return 'AuthorInheritanceConcrete';
    }

    public function getFields()
    {
        return array_merge(parent::getFields(), [
            'additional' => 'Text',
        ]);
    }
}
