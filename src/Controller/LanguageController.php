<?php

namespace App\Controller;

use App\Model\LanguageManager;
use App\Model\CommentManager;
use App\Model\PostManager;
use App\Model\FavoriteManager;

class LanguageController extends AbstractController
{
    public function language($id)
    {
        $languageManager = new LanguageManager();
        $categories = $languageManager->selectAll();

        $languageById = new LanguageManager();
        $allPostsOrderedByDate = $languageById->selectPostsByLanguageOrderedBy($id, 'creation_at');
        $allPostsOrderedByPopularity = $languageById->selectPostsByLanguageOrderedBy($id, 'popularity');
          $allPostManager = new PostManager();
        if (isset($_SESSION['userid'])) {
                    $favoriteManager = new FavoriteManager();
                    $favorites = $favoriteManager->selectAllFavoritePostId($_SESSION['userid']);
                } else {
                    $favorites = [];
                }

        $colors = ['#EE908A','#EEAE8A', '#EEDC8A', '#B5E1EE', '#D7B0EE' ];
         if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['comment'])) {
                            $newComment = new CommentManager();
                            $content = $_POST ['comment'];
                            $userid = $_SESSION['userid'];
                            $postid = $_POST['postid'];
                            $newComment->addComment($userid, $content, $postid);
                }
                $allComments = '';
                $newComment = new CommentManager();
                $allComments = $newComment->showComments();
        return $this->twig->render('Home/index.html.twig', [
            'languages' => $categories,
            'all_posts_by_date' => $allPostsOrderedByDate,
            'all_posts_by_pop' => $allPostsOrderedByPopularity,
            'colors' => $colors,
             'all_comments' => $allComments,
             'favorite' => $favorites,
        ]);
    }
}