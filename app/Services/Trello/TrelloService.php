<?php

namespace App\Services\Trello;

use Stevenmaguire\Services\Trello\Client;

class TrelloService
{
    public Client $client;

    public function __construct()
    {
        $this->client = new Client(array(
            'key' => config('trello.key'),
            'token' => config('trello.token'),
        ));
    }

    public function getCurrentUserBoards()
    {
        return  $this->client->getCurrentUserBoards();
    }

    public function getCurrentUserCards($boards)
    {
        $cards = [];
        foreach ($boards as $board){
            $cards[] = [
                'id_board' => $board->id,
                'card' => $this->client->getBoardCards( $board->id),
            ];
        }

        return $cards;
    }

    public function getAllMembersByCards($cards)
    {
        $members = [];
        foreach ($cards as $card){

            foreach ($card['card'] as $item){

                $items = $this->client->getCardMembers($item->id);

                foreach ( $items as $item_){
                    $members[] = $this->client->getMember( $item_->id);
                }
            }

        }

        return $members;

    }

    public function getAllMembers()
    {
        $boards = $this->getCurrentUserBoards();
        $cards = $this->getCurrentUserCards($boards);
        $members = $this->getAllMembersByCards($cards);

        return $members;
    }

    public function searchMemberByStr($str)
    {
        $members = $this->getAllMembers();
        $search = false;
        foreach ($members as $member){
            if (str_contains($str, $member->email) || str_contains($str, $member->username)){
                $search = $member;
                break;
            }
        }

        return $search;
    }


}
