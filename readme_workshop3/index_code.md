# Blog Main page creation

## 1. index.php within view

### 1.1 Existing Conents of index.php (As per workshop 2)

```html

<html>
    <head>
    </head>

    <body>
        <header>
            // inside it had all the contents of header 
            // menu items , unicourt logo etc
        </header>

        <section>
            <article>
                // her we had all our posts 
                / we had added 3 posts (same post copy pasted 3 times)
            </article>
        </section>

        <footer>
            // her we had footer contents and links
        </footer>
    </body>
</html>

```

### 1.2 What are the common items which can be separated?

- Header is same in all pages.
- Footer is same in all pages.
- We can move it to a separate file and import it. Refer [Header and Footer creation](./header_footer_creation.md)

## 2. Fetching the blogs to display

### 2.1 We need to fetch all the blogs which has to be displayed. Refer Pont 1 of [Model creation](./model_code.md)

### 2.2 Creating controller to communicate with the above created model and fetch data. Refer [Controller Creation](./controller_code.md)

### 2.3 Fetching the data in index.php

- Withing the php block where you have imported the header.php file add the below code (where its mentioned `Paste blogs code below this`).
- This code block called the method which we created in `BlogsController.php` and fetch the blogs data to be displayed.

```php

            include_once "../includes/classes.php";
            use Blogs\Controller\BlogsController as BlogsController;

            $blogsControllerObj = new BlogsController; 
            $blogs = $blogsControllerObj->fetchBlogsData();

```

- There can be multiple blogs and all blogs has to be displayed one by one.
- So loop the data which you fetch from the `BlogsController.php` and display one by one.
- Remove the existing `<section>` area and replace it with below code.
- Below code block will loop the data fetched from  `BlogsController.php` and display it.
- Paste the below code where its mentioned as `Paste section code below`.

```html

                <section id="primary">
                    <?php foreach ($blogs as $blog) : ?>
                        <article id="<?php echo $blog['blog_id'] ?>">
                            <div class="post-image">
                                <a href="./single-post.php" title="<?php echo $blog['blog_title'] ?>">
                                    <img src=".<?php echo $blog['image_path'] ?>" alt="<?php echo $blog['blog_title'] ?>" width="900" height="500">
                                </a>
                            </div>
                            <!-- The user data should be pasted below -->
                        </article>
                    <?php endforeach; ?>
                </section>
                <!-- Side section should be pasted below -->

```

- On reloading the page in browser you will see that only images are displayed without any other content.
- Lets display the user info below the image now.
- Paste the below code where its mentioned as `The user data should be pasted below`.

```html

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
                                <!-- The content should be pasted below this -->
                            </div>

```

- Reload the page again ad you will see the use data is displayed.
- Now lets display the blog contents.
- Paste the below code where its mentioned as `The content should be pasted below this`.

```html

                                <div class="content">
                                    <p><?php echo $blog['blog_content'] ?></p>
                                </div>

```

- We are at the last section of this page , Lets create the side content.
- We have already fetched all the blogs to be displayed.
- Now we just have to get the Title of each blog and show it in the side section.
- Paste the below code where its mentioned as `Side section should be pasted below`.

```html

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

```

#### 3 Now lets create the User Info page. Refer [User Info Creation](./user_info_code.md)
