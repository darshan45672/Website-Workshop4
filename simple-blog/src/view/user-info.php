<!-- Paste Session start code -->

<?php
if (isset($_SESSION)) {
    session_start();
    ob_start();
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>HTML & CSS Learning Workshop Blog</title>
		<meta content="width=device-width, initial-scale=1" name="viewport" />
        <link rel="stylesheet" href="./css/style.css" />
	</head>
    <body>

        
        <?php 
            // include the classes and fetch blog and user data to display
            include_once "../includes/classes.php";
            use Blogs\Controller\BlogsController;
            use Blogs\Controller\UsersController;

            // set userId code

            if(isset($_REQUEST['userId'])){
                $userId = $_REQUEST['userId'];
            }elseif(isset($_SESSION['userId']))
            {
                $userId = $_SESSION['userId'];
            }


            // On delete click 
            
            if(isset($_POST['btnDelete'])){
                $blogsControllerObj = new BlogsController;
                $blogsControllerObj->deleteBlog($_POST['btnDelete']);
            }


            // On posting new blog

            if(isset($_POST['title']) && isset($_POST['content']))
            {
                $info = pathinfo($_FILES['image']['name']);

                // Save the blog data
                $blogsControllerObj = new BlogsController;
                $blogsControllerObj->saveBlogData($_POST['title'], $_POST['content'], $info);
            }


            // Login validation call

            if (isset($_POST['uname']) && isset($_POST['psw'])) {
                $objUserController = new UsersController;
                $user_data = $objUserController->validateLogin($_POST['uname'], $_POST['psw']);
            }elseif(!empty($userId)){
                // Fetch user data 
                $usersControllerObj = new UsersController; 
                $user_data = $usersControllerObj->fetchUserData($userId);
            }else{
                header("Location: index.php");
                exit();
            }


            // Fetch blogs by that user.

            $blogsControllerObj = new BlogsController; 
            list($blogs_count, $blogs) = $blogsControllerObj->fetchBlogsByUser($user_data['user_id']);



            // load header after setting the session.
            include './header.php';
        ?>


        <div class="container">
            
            <article id="<?php echo $user_data['user_id'] ?>">
                <div class="post-image">
                    <img src=".<?php echo $user_data['profile_pic'] ?>" alt="<?php echo $user_data['first_name'] ?>" width="200" height="100">
                    <h2 class="title"><?php echo $user_data['first_name']. " ". $user_data['last_name'] ?></h2>
                    <p class="userdata"><?php echo "@".$user_data['username'] ?></p>
                    <p class="userdata"><?php echo $user_data['profession'] ?></p>
                    <p class="userdata"><?php echo "Joined ".$user_data['created_on'] ?></p>
                </div>
            </article>
                
            <!-- Paste the blog form -->

            <?php if(isset($_SESSION['userId']) && $_SESSION['userId'] == $user_data['user_id']) : ?>
                <form action="user-info.php" method="post" enctype="multipart/form-data">
                    <lable for="title"><b>Title</b></label>
                    <input type="text" placeholder="Blog Title" name="title" required>

                    <lable for="content"><b>Content</b></label>
                    <textarea placeholder="Blog Content" name="content" required></textarea>

                    <lable for="img"><b>Blog Image</b></label>
                    <input type="file" accept="image/*" name="image" id="image" required>

                    <button class="blogbuttons" type="submit">Post</button>
                </form>
            <?php endif ?>

            

            <h2 class="blogs">Blogs <?php echo "(".$blogs_count.")"?></h2>
            <?php foreach ($blogs as $blog) : ?>
                <article id="<?php echo $blog['blog_id'] ?>">
                    <div class="post-image">
                        <a href="./single-post.php" title="<?php echo $blog['blog_title'] ?>">
                            <img src=".<?php echo $blog['image_path'] ?>" alt="<?php echo $blog['blog_title'] ?>" width="900" height="500">
                        </a>
                    </div>
                    <div class="post-content">
                        <div class="post-details">
                            <h2 class="title"><a href="./single-post.php" rel="bookmark"><?php echo $blog['blog_title'] ?></a></h2>
                            <p class="post-meta">
                            <span class="wrap-posted-on">
                                By <a href="./user-info.php?userId=<?php echo $blog['user_id'] ?>"><?php echo $blog['created_by'] ?></a>
                                on <time datetime="<?php echo $blog['created_on'] ?>"><?php echo $blog['created_on'] ?></time>
                            </span>
                            </p>
                        </div>
                        <div class="content">
                            <p><?php echo $blog['blog_content'] ?></p>
                        </div>
                        
                        <!-- Delete and edit options -->

                        <?php if(isset($_SESSION['userId']) && $_SESSION['userId'] == $user_data['user_id']) : ?>
                            <form action="user-info.php" method="post">
                                <button type="submit" class="blogbuttondelete" id="<?php echo $blog['blog_id'] ?>" onclick="return confirm('Are you sure?')" name="btnDelete" value="<?php echo $blog['blog_id'] ?>">Delete</button>

                                <button type="submit" class="blogbuttonedit" id="<?php echo $blog['blog_id'] ?>" name="btnEdit" onclick="alert('This functionality is assignment')">Edit</button>
                            </form>
                        <?php endif ?>



                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <?php include './footer.php' ?>

    </body>
</html>
