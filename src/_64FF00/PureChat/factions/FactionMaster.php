<?php

namespace _64FF00\PureChat\factions;

use pocketmine\Player;
use pocketmine\Server;
use ShockedPlot7560\FactionMaster\API\MainAPI;
use ShockedPlot7560\FactionMaster\Database\Entity\FactionEntity;
use ShockedPlot7560\FactionMaster\Utils\Ids;

class FactionMaster implements FactionsInterface
{
    /*
        PureChat by 64FF00 (Twitter: @64FF00)

          888  888    .d8888b.      d8888  8888888888 8888888888 .d8888b.   .d8888b.
          888  888   d88P  Y88b    d8P888  888        888       d88P  Y88b d88P  Y88b
        888888888888 888          d8P 888  888        888       888    888 888    888
          888  888   888d888b.   d8P  888  8888888    8888888   888    888 888    888
          888  888   888P "Y88b d88   888  888        888       888    888 888    888
        888888888888 888    888 8888888888 888        888       888    888 888    888
          888  888   Y88b  d88P       888  888        888       Y88b  d88P Y88b  d88P
          888  888    "Y8888P"        888  888        888        "Y8888P"   "Y8888P"
    */

    /**
     * @return null|\pocketmine\plugin\Plugin
     */
    public function getAPI()
    {
        return Server::getInstance()->getPluginManager()->getPlugin("FactionMaster");
    }

    /**
     * @param Player $player
     * @return string
     */
    public function getPlayerFaction(Player $player)
    {
        $faction = MainAPI::getFactionOfPlayer($player->getName());
        
        if ($faction instanceof FactionEntity) 
        {
            return $faction->getName();
        } 
        else 
        {
            return '';
        }
    }

    /**
     * @param Player $player
     * @return string
     */
    public function getPlayerRank(Player $player)
    {
        if($this->getPlayerFaction($player->getName()) instanceof FactionEntity)
        {
            $user = MainAPI::getUser($player->getName());
            if($user->rank == Ids::COOWNER_ID) {
                return '*';
            }
            elseif($user->rank == Ids::OWNER_ID)
            {
                return '**';
            }
            else
            {
                return '';
            }
        }

        // TODO
        return '';
    }
}
