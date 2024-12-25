<?php

/**
 * BlogAuthor filter form base class.
 *
 * @author     Your name here
 */
abstract class BaseBlogAuthorFormFilter extends AuthorFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('blog_author_filters[%s]');
  }

  public function getModelName()
  {
    return 'BlogAuthor';
  }
}
