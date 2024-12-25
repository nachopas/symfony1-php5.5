<?php

/**
 * AuthorInheritance form base class.
 *
 * @method AuthorInheritance getObject() Returns the current form's model object
 *
 * @author     Your name here
 */
abstract class BaseAuthorInheritanceForm extends AuthorForm
{
    protected function setupInheritance()
    {
        parent::setupInheritance();

        $this->widgetSchema->setNameFormat('author_inheritance[%s]');
    }

    public function getModelName()
    {
        return 'AuthorInheritance';
    }
}
