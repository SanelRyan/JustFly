<?php

namespace astrxicz\JustFly;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\math\Vector3;

use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;

class main extends PluginBase implements Listener {

	public function onEnable() : void{
		$this->getLogger()->info(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::GOLD.'JustFly has been '.TextFormat::YELLOW.'enabled.');
	}

	public function onCommand(CommandSender $plr, Command $cmd, String $label, Array $args) : bool {
		switch ($cmd->getName()) {
			case 'fly':
				if($plr instanceof Player) {
					if($plr->hasPermission('justfly.fly')) {
						if(!$plr->getAllowFlight()) {
							$plr->setAllowFlight(true);
							$plr->sendMessage(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::GOLD.'Your flight has been '.TextFormat::YELLOW.'enabled.');
						} else {
							$plr->setAllowFlight(false);
							$plr->sendMessage(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::GOLD.'Your flight has been '.TextFormat::YELLOW.'disabled.');
						}
						if(!$plr->isFlying()) {
							$plr->setFlying(true);
						} else {
							$plr->setFlying(false);
						}
					} else {
						$plr->sendMessage(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::RED.'Permission missing.');
					}
				} else {
					$this->getLogger()->info(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::RED.'You can not use this command via console or a command block.');
				}
				break;
		}
		return true;
	}
}