<?php

/**
 * article actions.
 *
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 */
class articleActions extends autoarticleActions
{
  public function executeMyAction()
  {
    return $this->renderText('Selected '.implode(', ', $this->getRequestParameter('sf_admin_batch_selection', [])));
  }
}
