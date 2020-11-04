<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\LanguageManager;
use App\Model\PostManager;

class HomeController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function index()
    {

        $languageManager = new LanguageManager();
        $categories = $languageManager->selectAll();

        $allPostManager = new PostManager();
        $allPostsWithLanguages = $allPostManager->selectAllWithLanguage();
        $allPostsOrderedByDate = $allPostManager->selectPostsOrderedBy('creation_at');
        $allPostsOrderedByPopularity = $allPostManager->selectPostsOrderedBy('popularity');


        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST['search'])) {
                $wordToSearch = $_POST['search'];
            }
        }
        $allPostByKeyword = $allPostManager->postByKeyword($wordToSearch);

        return $this->twig->render('Home/index.html.twig', [
            'languages' => $categories,
            'all_posts_by_date' => $allPostsOrderedByDate,
            'all_posts_by_pop' => $allPostsOrderedByPopularity,
            'search' => $allPostByKeyword,
        ]);
    }
}
