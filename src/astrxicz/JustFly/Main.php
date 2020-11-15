<?php

namespace astrxicz\JustFly;

use astrxicz\JustFly\command\Fly;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;

class main extends PluginBase implements Listener {

	private $commands;
	private static $instance;

	public function onEnable() : void{
		self::$instance = $this;
		
		$this->commands = [
			new Fly()
		];

		$this->getServer()->getCommandMap()->registerAll("justfly", $this->commands);
		$this->getLogger()->info(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::GOLD.'JustFly has been '.TextFormat::YELLOW.'enabled.');
	}

	public static function getInstance() : self{
        return self::$instance;
    }
}