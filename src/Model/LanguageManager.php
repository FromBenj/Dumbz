<?php


namespace App\Model;


class LanguageManager extends AbstractManager
{
    const TABLE = 'language';

    /**
     *  Initializes this class.
     */

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectPostsByLanguageOrderedBy(int $id, $order): array
    {
        return $this->pdo->query('SELECT *, post.id as post_unique_id, (post.like - post. dislike) as popularity FROM post LEFT JOIN ' . $this->table . ' ON post.language_id = language.id HAVING language.id = "' .$id . '" ORDER BY ' . $order . ' DESC;')->fetchAll();
    }


}


