<?php
namespace Blogs\Controller;

include_once "../includes/classes.php";
use Blogs\Users;

class UsersController{

    /**
     * Get the user data from model and pass it to front end to display
     */
    public function fetchUserData($userId)
    {
        $usersObj = new Users;
        $userData = $usersObj->fetchUserById($userId);

        return $userData[0];
    }

}
?>