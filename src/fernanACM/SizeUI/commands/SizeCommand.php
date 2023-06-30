<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\SizeUI\commands;

use pocketmine\player\Player;

use pocketmine\command\CommandSender;

use CortexPE\Commando\BaseCommand;

use fernanACM\SizeUI\commands\subcommands\ManageSubCommand;
use fernanACM\SizeUI\commands\subcommands\ResetSubCommand;
use fernanACM\SizeUI\commands\subcommands\SetSubCommand;
use fernanACM\SizeUI\forms\SizeMenu;
use fernanACM\SizeUI\utils\PluginUtils;
use fernanACM\SizeUI\SizeUI;

class SizeCommand extends BaseCommand{

    public function __construct(){
        parent::__construct(SizeUI::getInstance(), "sizeui", "Open SizeUI by fernanACM", ["size"]);
        $this->setPermission("sizeui.acm");
    }

    /**
     * @return void
     */
    protected function prepare(): void{
        $this->registerSubCommand(new ManageSubCommand);
        $this->registerSubCommand(new ResetSubCommand);
        $this->registerSubCommand(new SetSubCommand);
    }

    /**
     * @param CommandSender $sender
     * @param string $aliasUsed
     * @param array $args
     * @return void
     */
    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void{
        if(!$sender instanceof Player){
            $sender->sendMessage("Use this command in-game");
            return;
        }

        if(!$sender->hasPermission("sizeui.acm")){
            $sender->sendMessage(SizeUI::Prefix(). SizeUI::getMessage($sender, "Messages.error.no-permission"));
            PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
            return;
        }
        SizeMenu::getInstance()->getSizeMenu($sender);
        PluginUtils::PlaySound($sender, SizeUI::getInstance()->config->getNested("Settings.sizeui.open-soundName"), 1, 1);
    }
}