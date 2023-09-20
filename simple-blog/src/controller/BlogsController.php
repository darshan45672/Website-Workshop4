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

    /**
     * Method to validate blog data.
     */
    public function saveBlogData($title, $content, $imageInfo){
        // first upload the image to desired directory
        $fileName = $_FILES['image']['name'];
        $targetDir = getcwd().'/images/'.basename($fileName);
        $imageId = 1;

        while(file_exists($targetDir))
        {
            $fileName = $imageInfo['filename'].'_'.$imageId.'.'.$imageInfo['extension'];
            $targetDir = getcwd().'/images/'.$fileName;
            $imageId++;
        }
        
        $imagePath = '/images/'.$fileName;

        move_uploaded_file($_FILES["image"]["tmp_name"], $targetDir);

        $content = htmlspecialchars($content);

        $blogsData = array("title"=>$title, "content"=>$content, "createdBy"=>$_SESSION['userId'], "imagePath"=>$imagePath);

        $objBlogs = new Blogs;
        $objBlogs->save($blogsData);

        header("Location: user-info.php");
        exit();
    }


    /**
     * Method to handle blog deletion.
     */
    public function deleteBlog($blogId){
        $objBlogs = new Blogs;
        $objBlogs->delete($blogId);

        header("Location: user-info.php");
        exit();
    }



}
?>
