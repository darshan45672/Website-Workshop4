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


    /**
     * Method to validate user credentials and redirect on success.
     */
    public function validateLogin($username, $password)
    {
        // encrypting the password before validation because in database the passwords encypted and stored.
        $encryptedPassword = hash("sha256", $password);

        $ObjUsers = new Users;
        $userData = $ObjUsers->fetchByUserNamePassword($username, $encryptedPassword);

        if(!empty($userData)){
            // set the user session 
            $_SESSION['userName'] = $userData[0]['username'];
            $_SESSION['userId'] = $userData[0]['user_id'];

            return $userData[0];
        }else{
            // if login fails redirect back to login pafe with failure message.
            header('Location: login.php?failed=true');
            exit;
        }
    }


    /**
     * Method to validate and call model save for the user data on signup
     */
    public function userSignup($userData){
        // validate if the username is already taken
        $objUsers = new Users;
        $userCount = $objUsers->fetchCountByUserName($userData['uname']);

        if($userCount > 0){
            header("Location: signup.php?failed=true");
            exit;
        }

        // encrypt the password before saving
        $encryptedPassword = hash("sha256", $userData['psw']);
        $userData['psw'] = $encryptedPassword;
        $result = $objUsers->save($userData);

        if(!$result){
            header('Location: signup.php?failed=true');
            exit;
        }

        header("Location: login.php");
        exit;
    }


}
?>
