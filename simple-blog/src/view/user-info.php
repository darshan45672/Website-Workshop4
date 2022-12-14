<!-- Paste Session start code -->

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


            // On delete click 
            

            // On posting new blog


            // Login validation call


            // Fetch blogs by that user.


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


                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <?php include './footer.php' ?>

    </body>
</html>