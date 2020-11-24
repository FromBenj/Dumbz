<?php


namespace App\Model;




class CommentManager extends AbstractManager
{
    const TABLE = 'comment';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function addComment($userid, $content, $postid) :void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`user_id`, `content`, `creation_at`, `post_id`) VALUES (:userid, :content, now(), :postid)");
        $statement->bindValue(':userid', $userid, \PDO::PARAM_INT);
        $statement -> bindValue(':content', $content, \PDO::PARAM_STR);
        $statement -> bindValue(':postid', $postid, \PDO::PARAM_INT);
        $statement ->execute();
    }

    public function showComments() :array
    {
        $comment = $this->pdo->query("SELECT c.content, c.post_id, c.creation_at, c.user_id, u.name AS username FROM comment c JOIN user u on c.user_id = u.id ORDER BY c.creation_at DESC;");
        $comment->execute();
        $allComments = $comment->fetchAll();
        return $allComments;
    }
    
    public function showUserNameByComment()
    {
        $userNameByComment = $this->pdo->query("SELECT user.name FROM comment LEFT JOIN user on comment.user_id = user.id;");
        $userNameByComment->execute();
        return $userNameByComment->fetchAll();

    }
}
