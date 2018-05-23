<?php

/**
 * EventManager.php – InventoryClear
 *
 * Copyright (C) 2018 Jack Noordhuis
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author Jack Noordhuis
 *
 */

declare(strict_types=1);

namespace jacknoordhuis\inventoryclear\event;

use jacknoordhuis\inventoryclear\InventoryClear;
use pocketmine\plugin\MethodEventExecutor;

class EventManager {

	/** @var InventoryClear */
	private $plugin;

	/** @var EventHandler[] */
	private $eventHandlers = [];

	public function __construct(InventoryClear $plugin) {
		$this->plugin = $plugin;
	}

	/**
	 * @return InventoryClear
	 */
	public function getPlugin() : InventoryClear {
		return $this->plugin;
	}

	public function registerHandler(EventHandler $handler) : void {
		$this->eventHandlers[] = $handler;

		foreach($handler->handles() as $eventClass => $handleFunc) {
			$this->plugin->getLogger()->debug("Registered " . (new \ReflectionClass($eventClass))->getShortName() . " for " . (new \ReflectionObject($handler))->getShortName() . "::" . $handleFunc);
			$this->plugin->getServer()->getPluginManager()->registerEvent($eventClass, $handler, $handler->getEventPriority(), new MethodEventExecutor($handleFunc), $this->plugin, $handler->ignoreCancelled());
		}
	}

}