<?php
namespace Blogs;

include_once "../includes/classes.php";
use Connection\Connection;
use PDO;

/**
 * This class contains all the queries which fetchs data from Blogs table
 */
class Blogs extends Connection{

        // trigger the parent construct so that the connection gets created
        public function __construct()
        {
            parent::__construct();
        }

    /**
     * Method to fetch all the blogs in desc order of last modified to show the latest on top.
     */
    public function fetchAllBlogs()
    {
        //query
        $query = "SELECT users.user_id, blogs.blog_id, blogs.image_path, blogs.blog_title, blogs.blog_content, (to_char(blogs.created_on, 'Mon DD, YYYY HH24:MI')) as created_on, CONCAT(users.first_name, ' ', users.last_name) as created_by FROM blogs 
        LEFT JOIN users on blogs.created_by = users.user_id 
        ORDER BY blogs.modified_on DESC";

        $blog_data = $this->_connection->query($query)->fetchAll();

        return $blog_data;
    }

     /**
     * Method to fetch total number of blogs created by a user based on user_id.
     */
    public function fetchAllBlogsByUserID($user_id)
    {
        //query
        $query = "SELECT users.user_id, blogs.blog_id, blogs.image_path, blogs.blog_title, blogs.blog_content, (to_char(blogs.created_on, 'Mon DD, YYYY HH24:MI')) as created_on, CONCAT(users.first_name, ' ', users.last_name) as created_by FROM blogs 
        LEFT JOIN users on blogs.created_by = users.user_id 
        WHERE blogs.created_by = $user_id 
        ORDER BY blogs.modified_on DESC";


        $user_blogs = $this->_connection->query($query)->fetchAll();

        return $user_blogs;
    }


    /**
     * Method to save blog.
     */
    public function save($blogData){
        // insert query
        $query = "INSERT INTO blogs (blog_title, blog_content, created_by, modified_on, image_path) VALUES ('".$blogData['title']."', '".$blogData['content']."', ".$blogData['createdBy'].", NOW(), '".$blogData['imagePath']."')";
        
        if($this->_connection->exec($query)){
            return true;
        };

        return false;
    }

    /**
     * Method to delete a blog by its id.
     */
    public function delete($blogId){
        // delete query
        $query = "DELETE FROM blogs where blog_id = $blogId";

        $this->_connection->exec($query);
    }

}
?>
