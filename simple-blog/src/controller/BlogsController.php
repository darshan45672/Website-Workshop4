<?php
namespace Blogs\Controller;

include_once "../includes/classes.php";
use Blogs\Blogs;

class BlogsController{


public function fetchBlogsData()
{
    $blogsObj = new Blogs;
    $blogs_data = $blogsObj->fetchAllBlogs();
    if(!is_array($blogs_data)){
        $blogs_data = array();
    }

    return $blogs_data;
}


/**
     * Fetches the blogs by the uses from model and returns the total blog count and the data.
     */
    public function fetchBlogsByUser($user_id)
    {
        $blogsObj = new Blogs;
        $user_blogs = $blogsObj->fetchAllBlogsByUserID($user_id);
        if(empty($user_blogs))
        {
            $user_blogs = array();
        }

        $total_blog_count = count($user_blogs);

        return array($total_blog_count, $user_blogs);
    }



}
?>