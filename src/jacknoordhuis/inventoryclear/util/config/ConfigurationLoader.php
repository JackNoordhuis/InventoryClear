<?php

/**
 * ConfigurationLoader.php – InventoryClear
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

use jacknoordhuis\inventoryclear\InventoryClear;
use pocketmine\utils\Config;

/**
 * Basic class to help manage configuration values
 */
abstract class ConfigurationLoader {

	/** @var InventoryClear */
	private $plugin;

	/** @var string */
	private $path;

	/** @var array */
	private $data;

	public function __construct(InventoryClear $plugin, string $path) {
		$this->plugin = $plugin;
		$this->path = $path;

		$this->loadData();
		$this->onLoad($this->data);
	}

	/**
	 * @return InventoryClear
	 */
	public function getPlugin() : InventoryClear {
		return $this->plugin;
	}

	final public function loadData() : void {
		$this->data = (new Config($this->path))->getAll();  // use pocketmine config class to detect file type and parse into array
	}

	final public function saveData(bool $async = true) : void {
		$config = new Config($this->path);
		$config->setAll($this->data);
		$config->save($async);
	}

	final public function reloadData() : void {
		$this->saveData(false);
		$this->loadData();
	}

	/**
	 * Called when the config is loaded
	 *
	 * @param array $data
	 */
	abstract protected function onLoad(array $data) : void;

	/**
	 * Retrieve a boolean value
	 *
	 * @param string|int $value
	 *
	 * @return bool
	 */
	public static function getBoolean($value) : bool {
		if(is_bool($value)) {
			return $value;
		}

		switch(is_string($value) ? strtolower($value) : $value) {
			case "off":
			case "false":
			case "no":
			case 0:
				return false;
		}

		return true;
	}

}