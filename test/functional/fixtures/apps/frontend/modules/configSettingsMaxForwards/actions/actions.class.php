<?php

/**
 * configSettingsMaxForwards actions.
 *
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 */
class configSettingsMaxForwardsActions extends sfActions
{
  public function executeSelfForward()
  {
    $this->forward('configSettingsMaxForwards', 'selfForward');
  }
}
