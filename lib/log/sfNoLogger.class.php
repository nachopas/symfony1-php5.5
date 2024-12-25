<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfNoLogger is a noop logger.
 *
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 */
class sfNoLogger extends sfLogger
{
    /**
     * Initializes this logger.
     *
     * @param  sfEventDispatcher $dispatcher  A sfEventDispatcher instance
     * @param  array             $options     An array of options.
     *
     * @return Boolean      true, if initialization completes successfully, otherwise false.
     */
    public function initialize(sfEventDispatcher $dispatcher, $options = [])
    {
    }

    /**
     * Logs a message.
     *
     * @param string $message   Message
     * @param string $priority  Message priority
     */
    protected function doLog($message, $priority)
    {
    }
}
