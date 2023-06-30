<?php
    
#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\SizeUI\manager;

use pocketmine\player\Player;

use fernanACM\SizeUI\utils\PluginUtils;
use fernanACM\SizeUI\SizeUI;

class SizeManager{

    /** @var self|null */
    private static $instance = null;

    private function __construct(){
    }

    /**
     * @param Player $player
     * @param float $size
     * @return void
     */
    public function setGlobalScale(Player $player, float $size): void{
        if($size < 0.1 || $size > 15){
            $player->sendMessage(SizeUI::Prefix(). SizeUI::getMessage($player, "Messages.error.scale-limit"));
            PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
            return;
        }
        $player->setScale($size);
        $player->sendMessage(SizeUI::Prefix(). str_replace(["{SCALE}"], [$size], SizeUI::getMessage($player, "Messages.successful.scale-change")));
        PluginUtils::PlaySound($player, "random.levelup", 1, 8.6);
    }

    /**
     * @param Player $player
     * @param float $size
     * @return void
     */
    public function setLargeScale(Player $player, float $size): void{
        if($size > 15){
            $player->sendMessage(SizeUI::Prefix(). SizeUI::getMessage($player, "Messages.error.scale-limit"));
            PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
            return;
        }
        $player->setScale($size);
        $player->sendMessage(SizeUI::Prefix(). str_replace(["{SCALE}"], [$size], SizeUI::getMessage($player, "Messages.successful.scale-change")));
        PluginUtils::PlaySound($player, "random.levelup", 1, 8.6);
    }

    /**
     * @param Player $player
     * @param float $size
     * @return void
     */
    public function setSmallScale(Player $player, float $size): void{
        if($size < 0.1){
            $player->sendMessage(SizeUI::Prefix(). SizeUI::getMessage($player, "Messages.error.scale-limit"));
            PluginUtils::PlaySound($player, "mob.villager.no", 1, 1);
            return;
        }
        $player->setScale($size);
        $player->sendMessage(SizeUI::Prefix(). str_replace(["{SCALE}"], [$size], SizeUI::getMessage($player, "Messages.successful.scale-change")));
        PluginUtils::PlaySound($player, "random.levelup", 1, 8.6);
    }

    /**
     * @param Player $player
     * @return void
     */
    public function setScaleReset(Player $player): void{
        $player->setScale(1.0);
        $player->sendMessage(SizeUI::Prefix(). SizeUI::getMessage($player, "Messages.successful.scale-normal"));
        PluginUtils::PlaySound($player, "random.levelup", 1, 3.4);
    }

    /**
     * @return self
     */
    public static function getInstance(): self{
        if(is_null(self::$instance))self::$instance = new self();
        return self::$instance;
    }
}