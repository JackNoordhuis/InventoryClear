<?php

/**
 * JoinClear.php – InventoryClear
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

namespace jacknoordhuis\inventoryclear\event\handle;

use jacknoordhuis\inventoryclear\event\EventHandler;
use pocketmine\event\player\PlayerJoinEvent;

class JoinClear extends EventHandler {

	public function handles(): array {
		return [
			PlayerJoinEvent::class => "handleJoin"
		];
	}

	public function handleJoin(PlayerJoinEvent $event) : void {

	}

}