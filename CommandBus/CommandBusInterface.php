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
    /**
     * @param CommandInterface $command
     * @return mixed
     */
    public function getCommandResponse(CommandInterface $command);

    /**
     * @param CommandInterface $command
     */
    public function postCommand(CommandInterface $command);
}