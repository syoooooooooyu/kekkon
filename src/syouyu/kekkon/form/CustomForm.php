<?php

/**
 *    ＿＿＿＿＿   _     ＿   ＿　　  ＿　＿　
 *   /  ＿＿＿/\ //＿＿ | |  | |\  / /|  | |
 *   \＿＿＿＿\ \// ＿  \ |  | | \/ / |  | |
 *    ＿＿＿  \  / |＿| | |__| |   /| \__/ |
 *   /＿＿＿＿/　/\＿＿＿/\_____/  / \_____/
 *          /＿/            　 /__/
 *
 * @author Syouyu(syoooooooooyu)
 * @link https://github.com/syoooooooooyu/
 */

namespace syouyu\kekkon\form;

use pocketmine\form\Form;
use pocketmine\Player;
use syouyu\kekkon\Main;
use pocketmine\Server;
use pocketmine\entity\Entity;

class CustomForm implements Form{

    public function __construct(Main $main){
        $this->config = $main->config;
    }

    public function handleResponse(Player $player, $data): void{
        if($data === null){
            return;
        }
        $player = Server::getInstance()->getPlayer($data[0]);
        $name = $player->getName();
        $player->setDisplayName("[既婚者]".$name);
        $newname = $player->getDisplayName();
        $this->config->set($name, $newname);
        $this->config->save();
        $player = Server::getInstance()->getPlayer($data[1]);
        $name = $player->getName();
        $player->setDisplayName("[既婚者]".$name);
        $newname = $player->getDisplayName();
        $this->config->set($name, $newname);
        $this->config->save();
    }

    public function jsonSerialize(){
        return[
            'type' => 'custom_form',
            'title' => '結婚.com',
            'content' => [
                [
                    'type' => 'input',
                    'text' => 'ここに結婚する人の名前を入力してください。',
                ],
                [
                    'type' => 'input',
                    'text' => 'ここに結婚する人の名前を入力してください。'
                ]
            ]
       ];
    }
}
