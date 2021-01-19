<?php

namespace Prismeral;

 use pocketmine\command\{CommandSender, Command};
  use pocketmine\plugin\Plugin;
  use pocketmine\plugin\PluginBase;
  use pocketmine\Player;
  use pocketmine\Server; 
  use pocketmine\level\Position;
  use pocketmine\level\particle\HugeExplodeSeedParticle;
  use pocketmine\math\Vector3;
  use jojoe77777\FormAPI\FormAPI;

class main extends PluginBase{
  
  public function onEnable(){
    $this->getLogger()->info("[TitaniumGames] The warp plugin is now running! - Prismeral loves you.");
  }
  public function onDisable(){
    $this->getLogger()->info("[TitaniumGames] The warp plugin is now collapsing! - Prismeral loves you.");
  }
  public function onCommand(CommandSender $sender, Command $commandname, string $label, array $args): bool {
    if($commandname->getName() === "warp"){
        $this->Form($sender);
    }
    return true;
  }
  public function Form(Player $player){
    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
    $form = $api->createSimpleForm(function(Player $player, $veri){
    if(is_null($veri)){
      return;
    }
    switch($veri){
        case 0:
          $a = $player->getX();
		      $b = $player->getY();
		      $c = $player->getZ();
		      $pos = new Vector3($a, $b, $c);
        $player->sendMessage("§l§8(§b!§8) §r§7You have boarded the portal to §eSpawn§7!");
        $player->teleport(new Position(Server::getInstance()->getLevelByName("Spawn")->getSpawnLocation()));
        $player->getLevel()->addParticle(new HugeExplodeSeedParticle($pos), [$player]);
        break;
      
    }
    });
  $form->setTitle("Skyblock Portal");
  $form->addButton("§7[§dSpawn§7]");
  $form->sendToPlayer($player);
  }
}
