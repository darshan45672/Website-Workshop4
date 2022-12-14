# Blog Operations

## 1. Create the blog form to add new blogs

- Paste the below code in `user-info.php` where its mentioned as `Paste the blog form`.

```html

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

```

## 2. Create the delete and edit options

- Paste the below code in `user-info.php` where its mentioned as `Delete and edit options`.

```php

                        <?php if(isset($_SESSION['userId']) && $_SESSION['userId'] == $user_data['user_id']) : ?>
                            <form action="user-info.php" method="post">
                                <button type="submit" class="blogbuttondelete" id="<?php echo $blog['blog_id'] ?>" onclick="return confirm('Are you sure?')" name="btnDelete" value="<?php echo $blog['blog_id'] ?>">Delete</button>

                                <button type="submit" class="blogbuttonedit" id="<?php echo $blog['blog_id'] ?>" name="btnEdit" onclick="alert('This functionality is assignment')">Edit</button>
                            </form>
                        <?php endif ?>

```

## 3. Add the controller call on delete click

- Paste the below code in `user-info.php` where its mentioned as `on delete click`.

```php

            if(isset($_POST['btnDelete'])){
                $blogsControllerObj = new BlogsController;
                $blogsControllerObj->deleteBlog($_POST['btnDelete']);
            }

```

## 4. Add the controller call on posting new blog

- Paste the below code in `user-info.php` where its mentioned as `On posting new blog`.

```php

            if(isset($_POST['title']) && isset($_POST['content']))
            {
                $info = pathinfo($_FILES['image']['name']);

                // Save the blog data
                $blogsControllerObj = new BlogsController;
                $blogsControllerObj->saveBlogData($_POST['title'], $_POST['content'], $info);
            }

```

## 5. Add the controller call for login validation

- Paste the below code in `user-info.php` where its mentioned as `Login validation call`.

```php

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

```

## 6. Fetch blogs based on user

- Paste the below code in `user-info.php` where its mentioned as `Fetch blogs by that user`.

```php

            $blogsControllerObj = new BlogsController; 
            list($blogs_count, $blogs) = $blogsControllerObj->fetchBlogsByUser($user_data['user_id']);

```

## 7. Getting the user Id on page load

- Paste the below code in `user-info.php` where its mentioned as `set userId code`.

```php

            if(isset($_REQUEST['userId'])){
                $userId = $_REQUEST['userId'];
            }elseif(isset($_SESSION['userId']))
            {
                $userId = $_SESSION['userId'];
            }

```

## 8. Create method to save the blog into database

- Paste the below code in `Blogs.php`.

```php

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

```

## 9. Create method to delete the blog from database

- Paste the below code in `Blogs.php`.

```php

    /**
     * Method to delete a blog by its id.
     */
    public function delete($blogId){
        // delete query
        $query = "DELETE FROM blogs where blog_id = $blogId";

        $this->_connection->exec($query);
    }

```

## 10. Add controller method to validate the blog data

- Paste the below code in `BlogsController.php`.

```php

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

```

## 11. Add controller method to handle blog deletion

- Paste the below code in `BlogsController.php`.

```php

    /**
     * Method to handle blog deletion.
     */
    public function deleteBlog($blogId){
        $objBlogs = new Blogs;
        $objBlogs->delete($blogId);

        header("Location: user-info.php");
        exit();
    }

```

## 12. Add the session start code

- Paste the below code in `user-info.php` where its mentioned as `Paste Session start code`.

```php

<?php
    session_start();
    ob_start();
?>

```
