<?php

/**
 * BlogArticle form base class.
 *
 * @method BlogArticle getObject() Returns the current form's model object
 *
 * @author     Your name here
 */
abstract class BaseBlogArticleForm extends ArticleForm
{
    protected function setupInheritance()
    {
        parent::setupInheritance();

        $this->widgetSchema->setNameFormat('blog_article[%s]');
    }

    public function getModelName()
    {
        return 'BlogArticle';
    }
}
