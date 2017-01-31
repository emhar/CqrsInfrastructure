<?php

/*
 * This file is part of the EmharCqrsInfrastructure library.
 *
 * (c) Emmanuel Harleaux
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Emhar\CqrsInfrastructure\Repository;

use Emhar\CqrsInfrastructure\Event\EventContainerInterface;

interface RepositoryInterface extends EventContainerInterface
{
    /**
     * @param mixed $id
     * @return mixed
     */
    public function find($id);
}