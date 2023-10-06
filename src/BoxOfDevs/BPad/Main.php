<?php

namespace BoxOfDevs\BPad;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\world\World;
use pocketmine\world\Position;
use pocketmine\utils\Config;
use pocketmine\player\Player;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\Server;
use pocketmine\math\Vector3;
use pocketmine\block\Block;

class Main extends PluginBase implements Listener {
	
	public function onEnable(): void {
		$this->getServer()->getPluginManager()->registerEvents($this ,$this);
		$this->saveDefaultConfig();
	}
	
	public function onMove(PlayerMoveEvent $event) {
    $player = $event->getPlayer();
    $position = $player->getPosition();
    $x = $position->getX();
    $y = $position->getY();
    $z = $position->getZ();
    $world = $player->getWorld();
    $block = $world->getBlock($position);
    
    $config = $this->getConfig();
    $boostBlockId = $config->get("Block");
    
    if ($block->getTypeId() === $boostBlockId) {
        $boostPower = $config->get("BoostPower");
        $direction = $player->getDirectionVector();
        $player->addForce($direction->multiply($boostPower));
        }
    }
}
