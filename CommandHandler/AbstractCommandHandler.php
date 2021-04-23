<?php

/*
 * This file is part of the EmharCqrsInfrastructure library.
 *
 * (c) Emmanuel Harleaux
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Emhar\CqrsInfrastructure\CommandHandler;

abstract class AbstractCommandHandler
{
    /**
     * @var boolean
     */
    private $userNotificationEnabled;

    /**
     * @var array
     */
    private $options;

    /**
     * @return bool
     */
    public function isUserNotificationEnabled(): bool
    {
        return $this->userNotificationEnabled;
    }

    /**
     * @param bool $userNotificationEnabled
     */
    public function setUserNotificationEnabled(bool $userNotificationEnabled)
    {
        $this->userNotificationEnabled = $userNotificationEnabled;
    }

    /**
     * @param \Exception $e
     * @return bool
     */
    public function canBeRetried(\Exception $e, int $retryCounter): bool
    {
        return $retryCounter < 0;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }
}