<?php

/**
 * BlogAuthor form base class.
 *
 * @method BlogAuthor getObject() Returns the current form's model object
 *
 * @author     Your name here
 */
abstract class BaseBlogAuthorForm extends AuthorForm
{
    protected function setupInheritance()
    {
        parent::setupInheritance();

        $this->widgetSchema->setNameFormat('blog_author[%s]');
    }

    public function getModelName()
    {
        return 'BlogAuthor';
    }
}
