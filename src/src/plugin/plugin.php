<?php
namespace plugin;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;

class Team extends PluginBase implements Listener{

function onEnable(){
        $this->getLogger()->info(TextFormat::YELLOW."GroupPLUGin");

        if(!file_exists($this->getDataFolder())){
			mkdir($this->getDataFolder(), 0744, true);
		}
		$this->config = new Config($this->getDataFolder() . "data.yml", Config::YAML,array());//Config生成
	}



    
public function onCommand(CommandSender $sender, Command $command, $label, array $args){
switch (strtolower($command->getName())) {

case "join";
    
		$this->config = new Config($this->getDataFolder() . "data.yml", Config::YAML,array());//Config
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
case "creategroup";
$this->config = new Config($this->getDataFolder() . "data.yml", Config::YAML,array());//Config(2回目)
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