<?php

namespace astrxicz\JustFly\command;

use astrxicz\JustFly\Main;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\plugin\Plugin;
use pocketmine\command\PluginIdentifiableCommand;

use pocketmine\plugin\PluginException;
use pocketmine\utils\TextFormat;

abstract class JustFlyCommands extends Command implements PluginIdentifiableCommand {
	public function __construct($name, $description = "", $usageMessage = null, $aliases = []) {
		parent::__construct($name, $description, $usageMessage, $aliases);
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args) {}

	public function getPlugin(): Plugin {
		return Main::getInstance();
    }
}