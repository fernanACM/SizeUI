<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\SizeUI\forms;

use pocketmine\player\Player;

use Vecnavium\FormsUI\SimpleForm;

use fernanACM\SizeUI\forms\subforms\ScaleForm;
use fernanACM\SizeUI\manager\SizeManager;
use fernanACM\SizeUI\utils\PluginUtils;
use fernanACM\SizeUI\SizeUI;

class SizeMenu{

    /** @var self|null */
    private static $instance = null;

    private function __construct(){
    }

    /**
     * @param Player $player
     * @return void
     */
    public function getSizeMenu(Player $player): void{
        $form = new SimpleForm(function(Player $player, $data){
            if(is_null($data)){
                PluginUtils::PlaySound($player, SizeUI::getInstance()->config->getNested("Settings.sizeui.closed-soundName"), 1, 1);
                return true;
            }
            switch($data){
                case 0: // NORMAL
                    SizeManager::getInstance()->setScaleReset($player);
                    PluginUtils::PlaySound($player, "random.pop2", 1, 5.4);
                break;

                case 1: // LARGE
                    ScaleForm::getLargeScale($player);
                    PluginUtils::PlaySound($player, "random.pop2", 1, 5.4);
                break;

                case 2: // SMALL
                    ScaleForm::getSmallScale($player);
                    PluginUtils::PlaySound($player, "random.pop2", 1, 5.4);
                break;

                case 4: // EXIT
                    PluginUtils::PlaySound($player, SizeUI::getInstance()->config->getNested("Settings.sizeui.closed-soundName"), 1, 1);
                break;
            }
        });
        $form->setTitle(SizeUI::getMessage($player, "SizeForm.menu.title"));
        $form->setContent(SizeUI::getMessage($player, "SizeForm.menu.content"));
        $form->addButton(SizeUI::getMessage($player, "SizeForm.menu.button-normal"),1,"https://i.imgur.com/Ua9jmdv.png");
        $form->addButton(SizeUI::getMessage($player, "SizeForm.menu.button-large"),1,"https://i.imgur.com/qylczpW.png");
        $form->addButton(SizeUI::getMessage($player, "SizeForm.menu.button-small"),1,"https://i.imgur.com/ma7SfWo.png");
        $form->addButton(SizeUI::getMessage($player, "SizeForm.menu.button-exit"),0,"textures/ui/cancel");
        $player->sendForm($form);
    }

    /**
     * @return self
     */
    public static function getInstance(): self{
        if(is_null(self::$instance))self::$instance = new self();
        return self::$instance;
    }
}