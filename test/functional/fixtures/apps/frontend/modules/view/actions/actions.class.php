<?php

/**
 * view actions.
 *
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 */
class viewActions extends sfActions
{
  public function executeIndex()
  {
    $this->setTemplate('foo');
  }

  public function executePlain()
  {
  }

  public function executeImage()
  {
  }
}
