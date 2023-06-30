<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\SizeUI\commands\subcommands;

use pocketmine\player\Player;

use pocketmine\command\CommandSender;

use CortexPE\Commando\args\FloatArgument;
use CortexPE\Commando\BaseSubCommand;

use fernanACM\SizeUI\manager\SizeManager;
use fernanACM\SizeUI\utils\PluginUtils;
use fernanACM\SizeUI\SizeUI;

class SetSubCommand extends BaseSubCommand{
    
    public function __construct(){
        parent::__construct("set", "", []);
        $this->setPermission("sizeui.acm");
    }

    /**
     * @return void
     */
    protected function prepare(): void{
        $this->registerArgument(0, new FloatArgument("scale"));
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

        if(!isset($args["scale"])){
            $sender->sendMessage(SizeUI::Prefix(). "§cUse: /sizeui <scale> <playerName>");
            PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
            return;
        }

        if(!is_float($args["scale"])){
            $sender->sendMessage(SizeUI::Prefix(). SizeUI::getMessage($sender, "Messages.error.not-numeric"));
            return;
        }
        SizeManager::getInstance()->setGlobalScale($sender, $args["scale"]);
    }
}