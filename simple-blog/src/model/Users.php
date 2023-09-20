<?php
namespace Blogs;

include_once "../includes/classes.php";
use Connection\Connection;
use PDO;

/**
 * This class contains all the queries which fetchs data from Users table
 */
class Users extends Connection{

        // trigger the parent construct so that the connect object gets created
        public function __construct()
        {
            parent::__construct();
        }
    
    /**
     * Method to fetch the user data by user id.
     */
    public function fetchUserById($user_id)
    {
        //query
        $query = "SELECT user_id, first_name, last_name, username, (to_char(created_on, 'Mon DD, YYYY')) as created_on, profession, profile_pic FROM users WHERE user_id = $user_id";

        $user_data = $this->_connection->query($query)->fetchAll();

        return $user_data;
    }


/**
     * Method to fetch data based on username and sha256 encrypted password
     */
    public function fetchByUserNamePassword($userName, $password){
        //query
        $query = "SELECT user_id, first_name, last_name, username, (to_char(created_on, 'Mon DD, YYYY')) as created_on, profession, profile_pic FROM users WHERE username = '$userName' AND user_password = '$password'";

        $user_data = $this->_connection->query($query)->fetchAll();

        return $user_data;
    }

    /**
     * method to fetch user count by username to check if he username is already taken.
     */
    public function fetchCountByUserName($userName){
        // query
        $query = "SELECT count(*) FROM users WHERE username = '$userName'";
        $user_data = $this->_connection->query($query)->fetch();
        return $user_data['count'];
    }


    /**
     * method to save user.
     */
    public function save($userData){
        //query
        $query = "INSERT INTO users (first_name, last_name, user_password, username, profession) VALUES ('".$userData['fname']."', '".$userData['lname']."', '".$userData['psw']."', '".$userData['uname']."', '".$userData['profession']."')";

        if($this->_connection->exec($query)){
            return true;
        };

        return false;
    }


}
?>
