<?php


namespace App\Model;


class LoginManager extends AbstractManager
{
    /**
     *
    */
    const TABLE = 'login'; // don't forget to replace it!

    /**
     *  Initializes this class.
     */

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
