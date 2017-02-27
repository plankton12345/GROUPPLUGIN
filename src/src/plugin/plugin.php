<?php

namespace plugin;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use BaseClassLoader;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;

class plugin extends PluginBase implements Listener{

	public function onEnable()
	{
                     	$this->getServer()->getPluginManager()->registerEvents($this,$this);
                        if(!file_exists($this->getDataFolder())){
           //configを入れるフォルダが有るかチェック
            mkdir($this->getDataFolder(), 0744, true);
          new Config($this->getDataFolder() . "config.yml", Config::YAML);
               }
	}
          	public function onCommand(CommandSender $sender, Command $command, $label, array $args)
	{
                      	if($command->getName() ==="groupjoin"){
                                  $player=$sender->getPlayer();//pluginコマンドの処理
                            if(!isset($args[0])) return false;
 
                             $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML,array());
                                             $name = $sender->getName();
                               if($this->config->exists($args[0])) {
                                           $gr = $this->config->get("{$name}");
                                           
                                         $sender->sendMessage("あなたはすでに参加しています");  
                               }else{
                                            if ($this->config->exists("{$args[0]}")) {
                                             $this->config->set("{$name},{$args[0]}");
                                                      $this->config->save();
                                                    $sender->sendMessage("{$args[0]}に参加しました");
                               }else{
                                   $sender->sendMessage("そのようなグールプは存在しませんｗ");
                               }
                               }
                                        }
                        
                             if($command->getName() === "groupcreate"){//pluginコマンドの処理
              $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML,array());
                                          
                                             $name = $sender->getName();
                               if ($this->config->exists($args[0])) {
                                           $gr = $this->config->get("{$name}");
                                           
                                         $sender->sendMessage("{$gr}はすでに存在します");  
                               }else{
  
                                             $this->config->set("{$args[0]}","{$name}");
                                                      $this->config->save();
                                                    $sender->sendMessage("{$args[0]}を作成しました");
       


                               
                               
                               }
                                        }
                                        
                                        
                      if($command->getName() === "mygroup"){
                        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML,array());
                        $name = $sender->getName();
                        if($this->config->exists($name)) {
                        $gr = $this->config->get("{$name}");
                        $sender->sendMessage("あなたは{$gr}に参加しています");
                        }else{
                            $sender->sendMessage("あなたはグループに参加していません");
                        
                                            
                                        }
                             }
        }
}
