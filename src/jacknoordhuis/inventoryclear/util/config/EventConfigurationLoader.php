<?php

/**
 * EventConfigurationLoader.php – InventoryClear
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

namespace jacknoordhuis\inventoryclear\util\config;

use jacknoordhuis\inventoryclear\event\handle\DeathClear;
use jacknoordhuis\inventoryclear\event\handle\JoinClear;
use jacknoordhuis\inventoryclear\event\handle\LeaveClear;
use jacknoordhuis\inventoryclear\util\InvUtils;

class EventConfigurationLoader extends ConfigurationLoader {

	public function onLoad(array $data) : void {
		$manager = $this->getPlugin()->getEventManager();
		$eventData = $data["general"]["events"];

		if(($invType = self::getInventoryType($eventData["join-clear"])) !== InvUtils::INV_TYPE_INVALID) {
			$manager->registerHandler(new JoinClear($manager, $invType));
		}

		if(($invType = self::getInventoryType($eventData["death-clear"])) !== InvUtils::INV_TYPE_INVALID) {
			$manager->registerHandler(new DeathClear($manager, $invType));
		}

		if(($invType = self::getInventoryType($eventData["leave-clear"])) !== InvUtils::INV_TYPE_INVALID) {
			$manager->registerHandler(new LeaveClear($manager, $invType));
		}
	}

	public static function getInventoryType(string $value) : int {
		switch(strtolower($value)) {
			case "all":
				return InvUtils::INV_TYPE_ALL;
			case "normal":
				return InvUtils::INV_TYPE_NORMAL;
			case "armor":
			case "armour":
				return InvUtils::INV_TYPE_ARMOR;
			default:
				return InvUtils::INV_TYPE_INVALID;
		}
	}

}