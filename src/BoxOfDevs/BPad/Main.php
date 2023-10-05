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
		$player = $event->getPlayer();
		$position = $player->getPosition();
		$x = $position->getX();
		$y = $position->getY();
		$z = $position->getZ();
		$world = $player->getWorld();
		$block = $world->getBlock($position);
		$direction = $player->getDirectionVector();
		$dx = $direction->getX();
		$dz = $direction->getZ();
		$world->addParticle(new FlameParticle()->encode($player->getPosition()->add(0, 1, 0)));
		$world->addParticle(new FlameParticle(), new Vector3($x-0.3, $y, $z));
		$world->addParticle(new FlameParticle(), new Vector3($x, $y, $z-0.3));
		$world->addParticle(new FlameParticle(), new Vector3($x+0.3, $y, $z));
		$world->addParticle(new FlameParticle(), new Vector3($x, $y, $z+0.3));
		
		$player->knockBack($dx, $dz, $this->getConfig()->get('BoostPower'));
	}
}
