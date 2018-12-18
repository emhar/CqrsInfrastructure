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

use Emhar\CqrsInfrastructure\Command\CommandInterface;

abstract class AbstractInfrastructureExceptionListeningCommandHandler extends AbstractCommandHandler
{
    abstract function onInfrastructureException(\Exception $e, CommandInterface $command);
}