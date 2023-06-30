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

use CortexPE\Commando\BaseSubCommand;

use fernanACM\SizeUI\forms\subforms\ScaleForm;
use fernanACM\SizeUI\utils\PluginUtils;
use fernanACM\SizeUI\SizeUI;

class ManageSubCommand extends BaseSubCommand{
    
    public function __construct(){
        parent::__construct("manage", "", []);
        $this->setPermission("sizeui.manage.acm");
    }

    /**
     * @return void
     */
    protected function prepare(): void{
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

        if(!$sender->hasPermission("sizeui.manage.acm")){
            $sender->sendMessage(SizeUI::Prefix(). SizeUI::getMessage($sender, "Messages.error.no-permission"));
            PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
            return;
        }
        ScaleForm::getSetGlobalScale($sender);
        PluginUtils::PlaySound($sender, "random.pop2", 1, 4.5);
    }
}