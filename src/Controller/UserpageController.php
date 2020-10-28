<?php


namespace App\Controller;


class UserpageController extends AbstractController
{
    public function userPage()
    {
        return $this->twig->render('Home/userPage.html.twig');
    }
}