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

abstract class AbstractEventContainer implements EventContainerInterface
{
    /**
     * @var Event[]
     */
    protected $events = array();

    /**
     * {@inheritDoc}
     */
    public function getEvents(): array
    {
        return $this->events;
    }

    public function eraseEvents()
    {
        $this->events = array();
    }
}