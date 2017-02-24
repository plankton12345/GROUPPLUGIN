<?php
//このプラグインはLaika氏以外の二次配布、改造、商用利用、というか利用以外を禁じます
namespace plugin;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\plugin\PluginBase;
use ClassLoader;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
class Plugin extends PluginBase implements Listener{
function onEnable(){
        if(!file_exists($this->getDataFolder())){
			mkdir($this->getDataFolder(), 0744, true);
		}
		$this->config = new Config($this->getDataFolder() . "data.yml", Config::YAML,array());//Config生成
	}
    
public function onCommand(CommandSender $sender, Command $command, $label, array $args){
if($command->getName() == "join"){
    
		if($this->config->exists($sender)){
			 $gr=$this->config->get($sender);
                         $sender->sendMessage("あなたは"."$gr"."に参加しています");  
		}else{
                    if($this->config->exists($label)){
                        $this->config->set("$sender", "$label");
                        $this->config->save();
                        $sender->sendMessage("$label"."に参加しました");
                    }
                    }
                }
if($command->getName() == "creategroup"){
if($this->config->exists("$label")){
          $sender->sendMessage("その名前のGroupはすでに存在します");
          }else{
$this->config->set("$label", "$label");
$this->config->save();
$sender->sendMessage("Groupを作成しました");
            }
}
}
}
