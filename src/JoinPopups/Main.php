<?php

namespace JoinPopups;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\Config;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerQuitEvent;

class Main extends PluginBase implements Listener{
    public function onEnable(){
        $this->saveDefaultConfig();
        $this->time = 0;
        $this->playersEnabled = array();
        $this->playersOnline = count($this->getServer()->getOnlinePlayers());
        $schedule = $this->getServer()->getScheduler()->scheduleRepeatingTask(new Timer);
        $this->showPlayers = $this->getConfig()->get("PlayerCount");
        $this->message = $this->getConfig()->get("Message");
        $this->getLogger()->info("§aJoinPopups enabled");
    }
    public function onDisable(){
        $this->getLogger()->sendMessage("§4JoinPopups disabled");
    }
    
    public function onCommand(CommandSender $sender, Command $command, $label, array $args){
        if(strtolower($command->getName()) == "popup"){
            if($sender->hasPermission("joinpopup") || $sender->hasPermission("joinpopup.command")){
                if(isset($args[0]) == "off"){
                    if(isset($this->playersEnabled[$sender->getName()])){
                        unset($this->playersEnabled[$sender->getName()]);
                        $sender->sendMessage("Popups disabled");
                        return true;
                    }else{
                        $sender->sendMessage("Popups aren't enabled for you");
                        return true;
                    }
                }elseif($args[0] == "on"){
                    if(isset($this->playersEnabled[$sender->getName()])){
                        $sender->sendMessage("Popups are already enabled for you");
                        return true;
                    }else{
                        $this->playersEnabled[$sender->getName] = $sender->getName();
                        $sender->sendMessage("Popups has been enabled for you");
                        return true;
                    }
                }else{
                    $sender->sendMessage("Unknown argument: ".$args[0]);
                    return true;
                }
            }else{
                $sender->sendMessage("You don't have permission to use that command!");
                return true;
            }
        }
    }
    
    public function onJoin(PlayerJoinEvent $event){
        $this-playersEnabled[$event->getPlayer()->getName()] = $event->getPlayer()->getName();
    }
    
    public function onLeave(PlayerQuitEvent $event){
        if(isset($this->playersEnabled[$event->getPlayer()->getName()])){
            unset($this->playersEnabled[$event->getPlayer()->getName()]);
        }
    }
}
