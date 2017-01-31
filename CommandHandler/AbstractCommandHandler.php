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
     * @return bool
     */
    public function eventEnabled(): bool
    {
        return true;
    }
}