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

}
?>