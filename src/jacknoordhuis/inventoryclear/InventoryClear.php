<?php

/**
 * InventoryClear.php – InventoryClear
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

namespace jacknoordhuis\inventoryclear;

use jacknoordhuis\inventoryclear\event\EventManager;
use jacknoordhuis\inventoryclear\util\config\EventConfigurationLoader;
use pocketmine\plugin\PluginBase;

class InventoryClear extends PluginBase {

	/** @var EventManager */
	public $eventManager;

	/** @var EventConfigurationLoader */
	private $eventConfigLoader;

	const SETTINGS_CONFIG = "Settings.yml";

	public function onEnable() {
		$this->saveResource(self::SETTINGS_CONFIG);
		$this->setEventManager();
		$this->eventConfigLoader = new EventConfigurationLoader($this, $this->getDataFolder() . self::SETTINGS_CONFIG);
	}

	public function getEventConfigurationLoader() : EventConfigurationLoader {
		return $this->eventConfigLoader;
	}

	protected function setEventManager() : void {
		if(!($this->eventManager instanceof EventManager)) {
			$this->eventManager = new EventManager($this);
		}
	}

	public function getEventManager() : EventManager {
		return $this->eventManager;
	}

}