<?php

namespace astrxicz\JustFly\command;

use astrxicz\JustFly\Main;
use astrxicz\JustFly\command\JustFlyCommands;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;
use pocketmine\plugin\PluginLogger;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;

class Fly extends JustFlyCommands {
	public function __construct() {
		parent::__construct("fly", "Just fly!", "Usage: /fly <player>");
   	}

	public function execute(CommandSender $sender, string $commandLabel, array $args) {

		if(empty($args)) {
			if($sender instanceof Player) {
				if($sender->hasPermission('fly')) {
					if($sender->isCreative()) {
						$sender->sendMessage(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::RED.'You are in creative mode. This command only works if you are in survival mode.');
					} else {
						if(!$sender->getAllowFlight()) {
							$sender->setAllowFlight(true);
							$sender->sendMessage(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::GOLD.'Your flight has been '.TextFormat::YELLOW.'enabled.');
						} else {
							$sender->setAllowFlight(false);
							$sender->sendMessage(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::GOLD.'Your flight has been '.TextFormat::YELLOW.'disabled.');
						}
						if(!$sender->isFlying()) {
							$sender->setFlying(true);
						} else {
							$sender->setFlying(false);
						}
					}
				} else {
					$sender->sendMessage(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::RED.'Permission missing.');
				}
			} else {
				$this->getPlugin()->getLogger()->info(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::RED.'You can not use this command via console or a command block.');
			}
		} else {
			$plr = $this->getPlugin()->getServer()->getPlayer($args[0]);
			if(isset($plr) && $plr instanceof Player) {
				if($sender->hasPermission('fly_others')) {
					if($plr->isCreative()) {
						$sender->sendMessage(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::RED.'The user is in creative mode. This command only works if the user is in survival mode.');
					} else {
						if($sender instanceof Player) {
							if(!$plr->getAllowFlight()) {
								$plr->setAllowFlight(true);
								$sender->sendMessage(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::YELLOW.' '.$plr->getDisplayName().TextFormat::GOLD.'\'s flight has been '.TextFormat::YELLOW.'enabled.');
								$plr->sendMessage(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::YELLOW.' '.$sender->getDisplayName().TextFormat::GOLD.' has '.TextFormat::YELLOW.'enabled'.TextFormat::GOLD.' your flight.');
							} else {
								$plr->setAllowFlight(false);
								$sender->sendMessage(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::YELLOW.' '.$plr->getDisplayName().TextFormat::GOLD.'\'s has been '.TextFormat::YELLOW.'disabled.');
								$plr->sendMessage(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::YELLOW.' '.$sender->getDisplayName().TextFormat::GOLD.' has '.TextFormat::YELLOW.'disabled'.TextFormat::GOLD.' your flight.');
							}
							if(!$plr->isFlying()) {
								$plr->setFlying(true);
							} else {
								$plr->setFlying(false);
							}
						} else {
							if(!$plr->getAllowFlight()) {
								$plr->setAllowFlight(true);
								$this->getPlugin()->getLogger()->info(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::YELLOW.' '.$plr->getDisplayName().TextFormat::GOLD.'\'s flight has been '.TextFormat::YELLOW.'enabled.');
								$plr->sendMessage(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::YELLOW.' Console'.TextFormat::GOLD.' has '.TextFormat::YELLOW.'enabled'.TextFormat::GOLD.' your flight.');
							} else {
								$plr->setAllowFlight(false);
								$this->getPlugin()->getLogger()->info(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::YELLOW.' '.$plr->getDisplayName().TextFormat::GOLD.'\'s has been '.TextFormat::YELLOW.'disabled.');
								$plr->sendMessage(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::YELLOW.' Console'.TextFormat::GOLD.' has '.TextFormat::YELLOW.'disabled'.TextFormat::GOLD.' your flight.');
							}
							if(!$plr->isFlying()) {
								$plr->setFlying(true);
							} else {
								$plr->setFlying(false);
							}
						}
					}
				} else {
					$sender->sendMessage(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::RED.'Permission missing!');
				}
			} else {
				$sender->sendMessage(TextFormat::BLUE.TextFormat::BOLD.'[JustFly] '.TextFormat::RESET.TextFormat::RED.'User with that name is not online.');
			}
		}
	}

}