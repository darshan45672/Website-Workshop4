# Controller code

## 1. BlogsController.php

### 1.1 Fetching all blogs to display in main page

- Since this is the middle layer we know that we need to display all the blogs in home page.
- To do that we need a method which communicates with `Blogs.php` class in model layer ad gets all the blogs.
- Below code calls the method in `Blogs.php` class of model which will return all the blogs.
- Paste the below code in `BlogsController.php` class withing `controller` folder.

```php

public function fetchBlogsData()
    {
        $blogsObj = new Blogs;
        $blogs_data = $blogsObj->fetchAllBlogs();
        if(!is_array($blogs_data)){
            $blogs_data = array();
        }

        return $blogs_data;
    }

```

### 1.2 Fetching all blogs added be a particular user to show it in user's profile page

- Below code calles a method in `Blogs.php` class of model which returns all the blogs added by a particular user.
- Paste the below code in `BlogsController.php` within the `controller` folder.

```php

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

```

-----------------------------------------------------------------------------------------------

## 2. UsersController.php

### 2.1 Fetch user data to be shown in the Users profile info

- Below code calles a method in `Users.php` class of model which returns the user data of a particular user.
- Paste the below code in `UsersController.php` within the `controller` folder.

```php

    /**
     * Get the user data from model and pass it to front end to display
     */
    public function fetchUserData($user_id)
    {
        $usersObj = new Users;
        $user_data = $usersObj->fetchUserById($user_id);

        return $user_data[0];
    }

```

#### Continue the blog creation Refer : Point 2.3 [Fetching the data in index.php](./index_code.md)
