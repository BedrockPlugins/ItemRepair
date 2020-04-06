<?php

namespace BedrockPlugins\ItemRepair\commands;

use BedrockPlugins\ItemRepair\ItemRepair;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\Player;

class ItemRepairCommad extends Command {

    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = []) {
        $this->setPermission("command.itemrepair");
        parent::__construct($name, $description, $usageMessage, $aliases);
    }
    
    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if (!$sender instanceof Player) return;
        if (!$sender->hasPermission("command.itemrepair")) {
            $sender->sendMessage(ItemRepair::$prefix . "You don't have permissions to use this command");
            return;
        }
        $item = $sender->getInventory()->getItemInHand();
        if ($item->getId() == Item::AIR) {
            $sender->sendMessage(ItemRepair::$prefix . "You have to hold an item in your hand");
            return;
        }
        if (!ItemRepair::isValid($item)) {
            $sender->sendMessage(ItemRepair::$prefix . "This item is not repairable");
            return;
        }
        if ($item->getDamage() == 0) {
            $sender->sendMessage(ItemRepair::$prefix . "This item is not damaged");
            return;
        }
        $sender->getInventory()->setItemInHand($item->setDamage(0));
        $sender->sendMessage(ItemRepair::$prefix . "Item has been repaired");
    }

}