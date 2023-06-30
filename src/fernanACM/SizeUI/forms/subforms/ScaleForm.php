<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\SizeUI\forms\subforms;

use pocketmine\player\Player;

use Vecnavium\FormsUI\CustomForm;
use Vecnavium\FormsUI\SimpleForm;

use fernanACM\SizeUI\forms\SizeMenu;
use fernanACM\SizeUI\manager\SizeManager;
use fernanACM\SizeUI\utils\PluginUtils;
use fernanACM\SizeUI\SizeUI;

class ScaleForm{

    /**
     * @param Player $player
     * @return void
     */
    public static function getLargeScale(Player $player): void{
        $form = new SimpleForm(function(Player $player, $data){
            if(is_null($data)){
                PluginUtils::PlaySound($player, "random.pop", 1, 4.4);
                return true;
            }
            $buttonCount = 14;
            if($data >= 0 && $data < $buttonCount){
                $scale = $data + 1;
                SizeManager::getInstance()->setLargeScale($player, $scale);
            }elseif($data == $buttonCount)
                SizeMenu::getInstance()->getSizeMenu($player);
        });
        $form->setTitle(SizeUI::getMessage($player, "SizeForm.large.title"));
        $form->setContent(SizeUI::getMessage($player, "SizeForm.large.content"));
        for($i = 1; $i <= 14; $i++){
            $buttonName = str_replace(["{LEVEL}", "{SCALE}"], [$i, $i + 1], SizeUI::getMessage($player, "SizeForm.large.button-level"));
            $form->addButton($buttonName,1,"https://i.imgur.com/kmTmNfV.png");
        }
        $form->addButton(SizeUI::getMessage($player, "SizeForm.large.button-return"),1,"https://i.imgur.com/atLAJj3.png");
        $player->sendForm($form);
    }

    /**
     * @param Player $player
     * @return void
     */
    public static function getSmallScale(Player $player): void{
        $form = new SimpleForm(function(Player $player, $data){
            if(is_null($data)){
                PluginUtils::PlaySound($player, "random.pop", 1, 4.4);
                return true;
            }
            $buttonCount = 8;
            if($data >= 0 && $data < $buttonCount){
                $scale = 0.9 - ($data * 0.1);
                SizeManager::getInstance()->setSmallScale($player, $scale);
            }elseif($data == $buttonCount)
                SizeMenu::getInstance()->getSizeMenu($player);
        });
        $form->setTitle(SizeUI::getMessage($player, "SizeForm.small.title"));
        $form->setContent(SizeUI::getMessage($player, "SizeForm.small.content"));
        for($i = 1; $i <= 8; $i++){
            $scale = 0.9 - ($i * 0.1);
            $formattedScale = number_format($scale, 1);
            $buttonName = str_replace(["{LEVEL}", "{SCALE}"], [$i, $formattedScale], SizeUI::getMessage($player, "SizeForm.large.button-level"));
            $form->addButton($buttonName,1,"https://i.imgur.com/kmTmNfV.png");
        }
        $form->addButton(SizeUI::getMessage($player, "SizeForm.small.button-return"),1,"https://i.imgur.com/atLAJj3.png");
        $player->sendForm($form);
    }

    /**
     * @param Player $player
     * @return void
     */
    public static function getSetGlobalScale(Player $player): void {
        $custom = new CustomForm(function(Player $player, $data) {
            if (is_null($data)) {
                PluginUtils::PlaySound($player, "random.pop", 1, 4.4);
                return true;
            }
            
            $selectedPlayerName = $data[0] ?? '';
            $scale = floatval($data[1] ?? 1);
            if(!empty($selectedPlayerName)){
                $selectedPlayer = $player->getServer()->getPlayerByPrefix($selectedPlayerName) ??
                                  $player->getServer()->getPlayerExact($selectedPlayerName);
                if (!is_null($selectedPlayer)) {
                    SizeManager::getInstance()->setGlobalScale($selectedPlayer, $scale);
                }else{
                    $player->sendMessage(SizeUI::Prefix(). SizeUI::getMessage($player, "Messages.error.player-not-found"));
                }
            }
        });
        $custom->setTitle(SizeUI::getMessage($player, "SizeForm.global.title"));
        $custom->addInput(SizeUI::getMessage($player, "SizeForm.global.select-player"), "playerName", $player->getName());
        $custom->addInput(SizeUI::getMessage($player, "SizeForm.global.select-level"), "", "2");   
        $player->sendForm($custom);
    }    
}