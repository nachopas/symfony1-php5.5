<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Initialization for propel and i18n propel integration.
 *
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 */
class sfPropel
{
    protected static $defaultCulture = 'en';

    /**
     * Initialize symfony propel
     *
     * @param sfEventDispatcher $dispatcher
     * @param string $culture
     *
     * @deprecated Moved to {@link sfPropelPluginConfiguration}
     */
    public static function initialize(sfEventDispatcher $dispatcher, $culture = null)
    {
        $dispatcher->notify(new sfEvent(self::class, 'application.log', [__METHOD__.'() has been deprecated. Please call sfPropel::setDefaultCulture() to set the culture.', 'priority' => sfLogger::NOTICE]));

        if (null !== $culture) {
            self::setDefaultCulture($culture);
        } elseif (class_exists('sfContext', false) && sfContext::hasInstance() && $user = sfContext::getInstance()->getUser()) {
            self::setDefaultCulture($user->getCulture());
        }
    }

    /**
     * Sets the default culture
     *
     * @param string $culture
     */
    public static function setDefaultCulture($culture)
    {
        self::$defaultCulture = $culture;
    }

    /**
     * Return the default culture
     *
     * @return string the default culture
     */
    public static function getDefaultCulture()
    {
        return self::$defaultCulture;
    }

    /**
     * Listens to the user.change_culture event.
     *
     * @param sfEvent An sfEvent instance
     *
     */
    public static function listenToChangeCultureEvent(sfEvent $event)
    {
        self::setDefaultCulture($event['culture']);
    }

    /**
     * @deprecated Use Propel::importClass() instead
     */
    public static function import($path)
    {
        return Propel::importClass($path);
    }

    /**
     * @deprecated Use Propel::importClass() instead
     */
    public static function importClass($path)
    {
        return Propel::importClass($path);
    }

    /**
     * Clears all instance pools.
     *
     * @deprecated Moved to {@link sfPropelPluginConfiguration}
     */
    public static function clearAllInstancePools()
    {
        sfProjectConfiguration::getActive()->getPluginConfiguration('sfPropelPlugin')->clearAllInstancePools();
    }
}
