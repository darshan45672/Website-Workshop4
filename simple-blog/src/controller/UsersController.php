<?php
namespace Blogs\Controller;

include_once "../includes/classes.php";
use Blogs\Users;

class UsersController{

    /**
     * Get the user data from model and pass it to front end to display
     */
    public function fetchUserData($user_id)
    {
        $usersObj = new Users;
        $user_data = $usersObj->fetchUserById($user_id);

        return $user_data[0];
    }

}
?>