<?php

namespace syouyu\kekkon;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\event\Listener;
use syouyu\kekkon\form\CustomForm;
use syouyu\kekkon\form\CustomForm1;
use pocketmine\utils\Config;
use pocketmine\entity\Entity;
use pocketmine\Server;

class Main extends PluginBase implements Listener{

    public $config;

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->config = new Config($this->getDataFolder() . "display.yml", Config::YAML);
    }

    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        $name = $player->getName();
        if(!$this->config->exists($name)){
            $this->config->set($name, $name);
            $this->config->save();
        }
        $player->setDisplayName($this->config->get($name));
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
        switch($command->getName()){
            case "kekkon":
                if(!($sender instanceof Player)){
                    return true;
                }elseif(!$sender->isOp()){
                    $sender->sendMessage("権限がありません");
                }
                $sender->sendForm(new CustomForm($this));
        
                return true;
            break;
            case "rikon":
                if(!($sender instanceof Player)){
                    return true;
                }elseif(!$sender->isOp()){
                    $sender->sendMessage("権限がありません");
                }
                $sender->sendForm(new CustomForm1($this));
        
                return true;
            break;
        }
        return true;
    }
}