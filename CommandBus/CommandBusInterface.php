<?php

/*
 * This file is part of the EmharCqrsInfrastructure library.
 *
 * (c) Emmanuel Harleaux
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Emhar\CqrsInfrastructure\CommandBus;

use Emhar\CqrsInfrastructure\Command\CommandInterface;

interface CommandBusInterface
{
    const DEFAULT_QUEUE = 'default';

    /**
     * @param CommandInterface $command
     * @param bool $enableUserNotification
     * @return mixed
     */
    public function getCommandResponse(CommandInterface $command, bool $enableUserNotification = true);

    /**
     * @param CommandInterface $command
     * @param bool $userNotificationEnabled
     * @param string $queue
     * @return
     */
    public function postCommand(CommandInterface $command, bool $userNotificationEnabled = true, string $queue = self::DEFAULT_QUEUE);
}