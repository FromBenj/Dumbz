<?php


namespace App\Controller;


use App\Model\LanguageManager;
use App\Model\PostManager;

class LanguageController extends AbstractController
{
    public function language($id)
    {
        $languageManager = new LanguageManager();
        $categories = $languageManager->selectAll();

        $languageById = new LanguageManager();
        $allPostsOrderedByDate = $languageById->selectPostsByLanguageOrderedBy($id, 'creation_at');
        $allPostsOrderedByPopularity = $languageById->selectPostsByLanguageOrderedBy($id, 'popularity');

        return $this->twig->render('Home/index.html.twig', [
            'languages' => $categories,
            'all_posts_by_date' => $allPostsOrderedByDate,
            'all_posts_by_pop' => $allPostsOrderedByPopularity
        ]);
    }


}