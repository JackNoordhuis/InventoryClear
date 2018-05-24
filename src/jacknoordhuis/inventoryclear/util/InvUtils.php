<?php

/**
 * InvUtils.php – InventoryClear
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

namespace jacknoordhuis\inventoryclear\util;

use pocketmine\Player;

abstract class InvUtils {

	public const INV_TYPE_INVALID = -1; // represents an invalid or empty inventory value
	public const INV_TYPE_ALL = 0; // represents an all inventories value
	public const INV_TYPE_NORMAL = 1; // represents a normal inventory value
	public const INV_TYPE_ARMOR = 2; // represents an armor inventory value

	/**
	 * Empty a players main inventory
	 *
	 * @param Player $player
	 */
	public static function clearInventory(Player $player) : void {
		if(($inv = $player->getInventory()) !== null) {
			$inv->clearAll();
		}
	}

	/**
	 * Empty a players armor inventory
	 *
	 * @param Player $player
	 */
	public static function clearArmorInventory(Player $player) : void {
		if(($inv = $player->getArmorInventory()) !== null) {
			$inv->clearAll();
		}
	}

	/**
	 * Empty all inventories from a player
	 *
	 * @param Player $player
	 */
	public static function clearAllInventories(Player $player) : void {
		self::clearInventory($player);
		self::clearArmorInventory($player);
	}

	/**
	 * Empty a players inventories based on the type
	 *
	 * @param Player $player
	 * @param int $type
	 */
	public static function clearFromType(Player $player, int $type) : void {
		switch($type) {
			case self::INV_TYPE_ALL:
				self::clearAllInventories($player);
				return;
			case self::INV_TYPE_NORMAL:
				self::clearInventory($player);
				return;
			case self::INV_TYPE_ARMOR:
				self::clearArmorInventory($player);
				return;
		}
	}

}