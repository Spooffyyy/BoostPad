<?php

namespace BoxOfDevs\BPad;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\world\World;
use pocketmine\world\Position;
use pocketmine\world\particle\Particle;
use pocketmine\world\particle\FlameParticle;
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
	
	public function onMove(PlayerMoveEvent $event){
		$position = $event->getPosition();
		$player = $event->getPlayer();
		$x = $position->getX();
		$y = $position->getY();
		$z = $position->getZ();
		$world = $player->getWorld();
		$block = $world->getBlock($player->getSide(0));
		if($block->getID() == $this->config->get('Block')){
			$direction = $player->getDirectionVector();
			$dx = $direction->getX();
			$dz = $direction->getZ();
			if($this->config->get("Particle") == "true"){
				$world->addParticle(new FlameParticle($player));
				$world->addParticle(new FlameParticle(new Vector3($x-0.3, $y, $z)));
				$world->addParticle(new FlameParticle(new Vector3($x, $y, $z-0.3)));
				$world->addParticle(new FlameParticle(new Vector3($x+0.3, $y, $z)));
				$world->addParticle(new FlameParticle(new Vector3($x, $y, $z+0.3)));
			}
			$player->knockBack($player, 0, $dx, $dz, $this->config->get('BoostPower'));
		}
	}
	
}
