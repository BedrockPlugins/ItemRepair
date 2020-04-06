<?php

namespace BedrockPlugins\ItemRepair;

use BedrockPlugins\ItemRepair\commands\ItemRepairCommad;
use pocketmine\item\Armor;
use pocketmine\item\Item;
use pocketmine\item\Tool;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class ItemRepair extends PluginBase {

    public static $prefix = TextFormat::AQUA . "ItemRepair " . TextFormat::DARK_GRAY . "» " . TextFormat::GRAY;

    public function onEnable() {
        $this->getServer()->getCommandMap()->register("itemrepair", new ItemRepairCommad("itemrepair", "Repairs the item you're holding", null ["repair"]));
    }

    public static function isValid(Item $item) : bool {
        return $item instanceof Tool || $item instanceof Armor;
    }

}