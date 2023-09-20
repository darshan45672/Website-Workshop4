<!-- Paste Session Code -->

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
        include './header.php';

        include_once "../includes/classes.php";
        use Blogs\Controller\BlogsController as BlogsController;

        $blogsControllerObj = new BlogsController; 
        $blogs = $blogsControllerObj->fetchBlogsData();

    ?>
        
    <div class="container">
        <div class="wrapper">
            <section id="primary">
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

                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
            
            <aside id="secondary" class="column">
                <div id="recent-posts">
                    <div class="widget-content">
                        <h3 class="heading">Recent Posts</h3>
                        <?php foreach ($blogs as $blog) : ?>
                            <ul>
                                <li>
                                    <a href="./single-post.php"><?php echo $blog['blog_title'] ?></a>
                                </li>
                            </ul>
                        <?php endforeach; ?> 
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <?php 
        include './footer.php';
    ?>
    </body>
</html>
