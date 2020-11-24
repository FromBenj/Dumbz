<?php


namespace App\Controller;

use App\Model\LanguageManager;
use App\Model\AbstractManager;
use App\Model\PostManager;

class LikeController extends AbstractController
{
    public function addLike()
    {
        $json = file_get_contents('php://input');
        $jsonData = json_decode($json, true);
        $postId = $jsonData['cheatsheet'];
        $userId = $jsonData['userid'];
        $postManager = new PostManager();
        $postManager->changeLike($postId, $userId);
        $response = [
            'status' => 'success',
            'user' => $userId,
            'cheat' => $postId,
        ];
        return json_encode($response);
    }

    public function addDislike()
    {
        $json = file_get_contents('php://input');
        $jsonData = json_decode($json, true);
        $postId = $jsonData['cheatsheet'];
        $userId = $jsonData['userid'];
        $postManager = new PostManager();
        $postManager->changeDislike($postId, $userId);
        $response = [
            'status' =>'success',
            'user' => $userId,
            'cheat' =>$postId,
        ];
        return json_encode($response);
    }
}
