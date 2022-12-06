# User Info Page Creation

## 1. Import Header and Footer

- Similar to the index.php page here also import the header and footer pages, replace below code where its mentioned as `Paste header below this`

```php

        <?php 
            // include the classes and fetch blog and user data to display
            include './header.php';

            <!-- Paste User info fetch code below -->
        ?>

```

- Paste the below code where its mentioned as `Paste Footer below`

```php

    <?php include './footer.php' ?>

```

## 2. Fetch User info

- Paste the below code where it says `Paste User info fetch code below`.
- Below code fetches the user data and his blogs to be desplayed.

```php

            include_once "../includes/classes.php";
            use Blogs\Controller\BlogsController;
            use Blogs\Controller\UsersController;
        
            // Fetch user data 
            $usersControllerObj = new UsersController; 
            $user_data = $usersControllerObj->fetchUserData($_REQUEST['userId']);

            // Fetch blogs by that user.
            $blogsControllerObj = new BlogsController; 
            list($blogs_count, $blogs) = $blogsControllerObj->fetchBlogsByUser($_REQUEST['userId']);

```

## 3. Display the user data

- Paste the below code where its mentioned as `Paste User data display code below`.
- The below code displays the user data.

```html

            <article id="<?php echo $user_data['user_id'] ?>">
                <div class="post-image">
                    <img src=".<?php echo $user_data['profile_pic'] ?>" alt="<?php echo $user_data['first_name'] ?>" width="200" height="100">
                    <h2 class="title"><?php echo $user_data['first_name']. " ". $user_data['last_name'] ?></h2>
                    <p class="userdata"><?php echo "@".$user_data['username'] ?></p>
                    <p class="userdata"><?php echo $user_data['profession'] ?></p>
                    <p class="userdata"><?php echo "Joined ".$user_data['created_on'] ?></p>
                </div>
            </article>

```

## 4. Display the blogs by that user

- Paste the below code where its mentioned `Paste the user blogs data here`.
- Below code loops alll the blogs written by the user and displays it.

```html

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
                    </div>
                </article>
            <?php endforeach; ?>

```
