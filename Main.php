<?php

namespace Text;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\math\Vector3;
use pocketmine\level\particle\FloatingTextParticle;
use pockemine\block\Block;
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener{
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		@mkdir($this->getDataFolder());
		$this->config = new Config($this->getDataFolder().
		"config.yml",Config::YAML, [
		"block" => 20,
		"text" => "§aPrimeiro",
		"subtext" => "§aProjeto",
		]);
		$this->config->save();
	}
  public function onInteract(PlayerInteractEvent $event){
  	$player = $event->getPlayer();
  	$block = $event->getBlock();
    $id = $this->config->get("block");
  	if($block->getId() === $id && $player->isOp()){
  		
  	$text = new FloatingTextParticle(new Vector3($block->getX(), $block->getY()+1, $block->getZ()), "", "");
  	$text->setTitle($this->config->get("text"));
  	$text->setText($this->config->get("subtext"));
  	$player->getLevel()->addParticle($text);
  	}
  }
 }