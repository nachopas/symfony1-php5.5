<?php

/**
 * renderText actions.
 *
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 */
class renderTextActions extends sfActions
{
  public function executeIndex()
  {
    return $this->renderText('foo');
  }
}
