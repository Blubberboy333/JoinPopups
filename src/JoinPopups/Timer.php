<?php

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\scheduler\PluginTask;

class Timer extends PluginTask{
  private $plugin;
  public function __construct(Main $plugin){
    $this->plugin = $plugin;
    parent::__construct(Main $plugin);
  }
  
  public function onRun(){
    if($this->plugin->time = 0){
      $this->plugin->time = 1;
      foreach($this->getServer()->getOnlinePlayers() as $p){
        if(isset($this->plugin->playersEnabled[$p->getName()])){
          if($this->plugin->showPlayers == "true"){
            $p->sendPopup($this->plugin->message." | ". "Players online: ".$this->plugin->playersOnline);
          }else{
            $p->sendPopup($this->plugin->message);
          }
        }
      }
    }elseif($this->plugin->time = 0){
      $this->plugin->time = 0;
      foreach($this->getServer()->getOnlinePlayers() as $p){
        if(isset($this->plugin->playersEnabled[$p->getName()])){
          if($this->plugin->showPlayers == "true"){
            $p->sendPopup($this->plugin->message." | ". "Players online: ".$this->plugin->playersOnline);
          }else{
            $p->sendPopup($this->plugin->message);
          }
        }
      }
    }
  }
}
