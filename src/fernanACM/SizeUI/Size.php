<?php

namespace fernanACM\SizeUI;


use fernanACM\SizeUI\PluginUtils;
use fernanACM\SizeUI\utils\FormImageFix;
use pocketmine\utils\Utils;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use fernanACM\SizeUI\FormsUI\SimpleForm;
use fernanACM\SizeUI\FormsUI\Form;
use fernanACM\SizeUI\FormsUI\FormsUI;

use pocketmine\player\Player;
use pocketmine\Server;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;

class Size extends PluginBase implements Listener {


	public function onEnable(): void{
		@mkdir($this->getDataFolder());

		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		switch($command->getName()){
			case "size":
			if($sender instanceof Player)       {
				           $this->getMenuSize($sender);
				           PluginUtils::PlaySound($sender, "random.totem", 1, 1.5);
					 } else {
						     $sender->sendMessage("Use this command in-game");
						      return true;
					 }
			break;
		}
	    return true;
	}

	public function getMenuSize(Player $player){
		$form = new SimpleForm(function (Player $player, int $data = null){
			    $result = $data;
			    if($result === null){
				      return;
				}
				switch($result){
					case 0:
					         $player->setScale("1.0");
					         $player->sendMessage($this->getConfig()->get("Prefix") . $this->getConfig()->get("MessageReset"));
					         PluginUtils::PlaySound($player, "random.burp", 1, 1.5);
					         return;
				    break;

					case 1:
				             $this->getBig($player);
				             PluginUtils::PlaySound($player, "random.click", 1, 1.5);
					         return;
				    break;

					case 2:
				             $this->getSmall($player);
				             PluginUtils::PlaySound($player, "random.click", 1, 1.5);
					         return;
				    break;

				    case 3:
				             PluginUtils::PlaySound($player, "random.pop2", 1, 1.5);
				    break;
					}



			});
			$form->setTitle("§l§5SizeUI");
			$form->setContent($this->getConfig()->get("Content-Menu"));
			$form->addButton($this->getConfig()->get("ResetButton"),1,"https://i.imgur.com/Ua9jmdv.png");
			$form->addButton($this->getConfig()->get("BigButton"),1,"https://i.imgur.com/qylczpW.png");
			$form->addButton($this->getConfig()->get("SmallButton"),1,"https://i.imgur.com/ma7SfWo.png");
			$form->addButton($this->getConfig()->get("ExitButton"),1,"https://i.imgur.com/atLAJj3.png");
			$form->sendToPlayer($player);
			return $form;
		}

		public function getSmall(Player $player){
		$form = new SimpleForm(function (Player $player, int $data = null){
			    $result = $data;
			    if($result === null){
				      return;
				}
				switch($result){
					case 0: 
                            $player->setScale("0.3");
                            $player->sendMessage($this->getConfig()->get("Prefix") . $this->getConfig()->get("MessageSmall-1"));
                            PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    break;

                    case 1:
                            $player->setScale("0.4");
                            $player->sendMessage($this->getConfig()->get("Prefix") . $this->getConfig()->get("MessageSmall-2"));
                            PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    break;

                    case 2:
                            $player->setScale("0.5");
                            $player->sendMessage($this->getConfig()->get("Prefix") . $this->getConfig()->get("MessageSmall-3"));
                            PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    break;
                    
                    case 3:
                            $player->setScale("0.6");
                            $player->sendMessage($this->getConfig()->get("Prefix") . $this->getConfig()->get("MessageSmall-4"));
                            PluginUtils::PlaySound($player, "random.levelup", 1, 1.5); 
                    break;

                    case 4:
                            $player->setScale("0.7");
                            $player->sendMessage($this->getConfig()->get("Prefix") . $this->getConfig()->get("MessageSmall-5"));
                            PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    break;

                    case 5:
                            $player->setScale("0.8");
                            $player->sendMessage($this->getConfig()->get("Prefix") . $this->getConfig()->get("MessageSmall-6"));
                            PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    break;

                    case 6:
                            $player->setScale("0.9");
                            $player->sendMessage($this->getConfig()->get("Prefix") . $this->getConfig()->get("MessageSmall-7"));
                            PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    break;
                            
                    case 7:
                            $this->getMenuSize($player);
                            PluginUtils::PlaySound($player, "mob.slime.jump", 1, 1.5);
                            return;
				    break;
					}

            });
			$form->setTitle("§5§lSizeUI");
			$form->setContent($this->getConfig()->get("Content-Menu-Small"));
			$form->addButton($this->getConfig()->get("SmallButtonLV-1"),1,"https://i.imgur.com/kmTmNfV.png");
			$form->addButton($this->getConfig()->get("SmallButtonLV-2"),1,"https://i.imgur.com/kmTmNfV.png");
			$form->addButton($this->getConfig()->get("SmallButtonLV-3"),1,"https://i.imgur.com/kmTmNfV.png");
			$form->addButton($this->getConfig()->get("SmallButtonLV-4"),1,"https://i.imgur.com/kmTmNfV.png");
			$form->addButton($this->getConfig()->get("SmallButtonLV-5"),1,"https://i.imgur.com/kmTmNfV.png");
			$form->addButton($this->getConfig()->get("SmallButtonLV-6"),1,"https://i.imgur.com/kmTmNfV.png");
			$form->addButton($this->getConfig()->get("SmallButtonLV-7"),1,"https://i.imgur.com/kmTmNfV.png");
			$form->addButton($this->getConfig()->get("ExitSmall"),1,"https://i.imgur.com/atLAJj3.png");
			$form->sendToPlayer($player);
			return $form;
		}

		public function getBig(Player $player){
		$form = new SimpleForm(function (Player $player, int $data = null){
			    $result = $data;
			    if($result === null){
				      return;
				}
				switch($result){
					case 0: 
                            $player->setScale("2.0");
                            $player->sendMessage($this->getConfig()->get("Prefix") . $this->getConfig()->get("MessageBig-1"));
                            PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    break;

                    case 1:
                            $player->setScale("3.0");
                            $player->sendMessage($this->getConfig()->get("Prefix") . $this->getConfig()->get("MessageBig-2"));
                            PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    break;

                    case 2:
                            $player->setScale("4.0");
                            $player->sendMessage($this->getConfig()->get("Prefix") . $this->getConfig()->get("MessageBig-3"));
                            PluginUtils::PlaySound($player, "random.levelup", 1, 1.5);
                    break;
                    
                    case 3:
                            $player->setScale("5.0");
                            $player->sendMessage($this->getConfig()->get("Prefix") . $this->getConfig()->get("MessageBig-4"));
                            PluginUtils::PlaySound($player, "random.levelup", 1, 1.5); 
                    break;
 
                    case 4:
                            $this->getMenuSize($player);
                            PluginUtils::PlaySound($player, "mob.slime.jump", 1, 1.5);
                            return;
				    break;
					}

            });
			$form->setTitle("§5SizeUI");
			$form->setContent($this->getConfig()->get("Content-Menu-Big"));
			$form->addButton($this->getConfig()->get("BigButtonLV-1"),1,"https://i.imgur.com/kmTmNfV.png");
			$form->addButton($this->getConfig()->get("BigButtonLV-2"),1,"https://i.imgur.com/kmTmNfV.png");
			$form->addButton($this->getConfig()->get("BigButtonLV-3"),1,"https://i.imgur.com/kmTmNfV.png");
			$form->addButton($this->getConfig()->get("BigButtonLV-4"),1,"https://i.imgur.com/kmTmNfV.png");
			$form->addButton($this->getConfig()->get("ExitBig"),1,"https://i.imgur.com/atLAJj3.png");
			$form->sendToPlayer($player);
			return $form;
		}
}
