<?php

/*
 * This file is part of the EmharCqrsInfrastructure library.
 *
 * (c) Emmanuel Harleaux
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Emhar\CqrsInfrastructure\Event;

/**
 * {@inheritDoc}
 */
abstract class Event
{
    /**
     * @var bool|null
     */
    private $userNotificationEnabled;

    /**
     * @return bool|null
     */
    public function isUserNotificationEnabled()
    {
        //if null return true
        return !($this->userNotificationEnabled === false);
    }

    /**
     * @param bool $userNotificationEnabled
     */
    public function setUserNotificationEnabled(bool $userNotificationEnabled)
    {
        $this->userNotificationEnabled = $userNotificationEnabled;
    }
}