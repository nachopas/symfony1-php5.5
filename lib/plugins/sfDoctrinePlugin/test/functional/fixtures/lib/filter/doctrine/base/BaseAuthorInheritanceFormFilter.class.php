<?php

/**
 * AuthorInheritance filter form base class.
 *
 * @author     Your name here
 */
abstract class BaseAuthorInheritanceFormFilter extends AuthorFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('author_inheritance_filters[%s]');
  }

  public function getModelName()
  {
    return 'AuthorInheritance';
  }
}
