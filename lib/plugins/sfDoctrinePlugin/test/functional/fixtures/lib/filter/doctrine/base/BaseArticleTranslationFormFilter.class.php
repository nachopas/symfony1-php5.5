<?php

/**
 * ArticleTranslation filter form base class.
 *
 * @author     Your name here
 */
abstract class BaseArticleTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(['title'       => new sfWidgetFormFilterInput(), 'body'        => new sfWidgetFormFilterInput(), 'test_column' => new sfWidgetFormFilterInput(), 'slug'        => new sfWidgetFormFilterInput()]);

    $this->setValidators(['title'       => new sfValidatorPass(['required' => false]), 'body'        => new sfValidatorPass(['required' => false]), 'test_column' => new sfValidatorPass(['required' => false]), 'slug'        => new sfValidatorPass(['required' => false])]);

    $this->widgetSchema->setNameFormat('article_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArticleTranslation';
  }

  public function getFields()
  {
    return ['id'          => 'Number', 'title'       => 'Text', 'body'        => 'Text', 'test_column' => 'Text', 'lang'        => 'Text', 'slug'        => 'Text'];
  }
}
