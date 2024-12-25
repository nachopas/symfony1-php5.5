<?php

/**
 * BlogArticle filter form base class.
 *
 * @author     Your name here
 */
abstract class BaseBlogArticleFormFilter extends ArticleFormFilter
{
    protected function setupInheritance()
    {
        parent::setupInheritance();

        $this->widgetSchema->setNameFormat('blog_article_filters[%s]');
    }

    public function getModelName()
    {
        return 'BlogArticle';
    }
}
