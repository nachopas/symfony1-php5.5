<?php

/**
 * pooling actions.
 *
 * @author     Your name here
 */
class poolingActions extends sfActions
{
  public function executeAddArticleButDontSave(sfWebRequest $request)
  {
    $article = new Article();
    $article->setTitle(__METHOD__.'()');

    $category = CategoryPeer::retrieveByPK($request->getParameter('category_id'));
    $category->addArticle($article);

    return sfView::NONE;
  }

  public function executeAddArticleAndSave(sfWebRequest $request)
  {
    $article = new Article();
    $article->setTitle(__METHOD__.'()');

    $category = CategoryPeer::retrieveByPK($request->getParameter('category_id'));
    $category->addArticle($article);
    $category->save();

    return sfView::NONE;
  }
}
