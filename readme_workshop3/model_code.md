# Model creation

## 1. Blogs.php (Part 1)

### 1.1 What do we need?

- Based on our final product we know that we have to fetch all the blogs in descening order of their last modified date.
- To get that first we will have to connect to the database, then run a query to fetch the data from `blogs` table.
- Lets create a method to do that , copy the below code and paste it in `Blogs.php` within `Models` folder.

```php

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

```

- Now if you try to connect to db it will fail because you have not established the connection to database yet.
- To establish the connection add the blow code in `Blogs.php` file in `models` folder.

```php

    // trigger the parent construct so that the connection gets created
    public function __construct()
    {
        parent::__construct();
    }

```

-----------------------------------------------------------------------------------------------

## 2. Users.php

### 2.2 What we need to do here?

- We know that when we click on a user's name it opens their profile and show their information.
- To do this we will have to write a query to fetch all the required information from the database.
- Paste the below code in `Users.php` class within `models` folder.

```php

    /**
     * Method to fetch the user data by user id.
     */
    public function fetchUserById($user_id)
    {
        //query
        $query = "SELECT user_id, first_name, last_name, username, (to_char(created_on, 'Mon DD, YYYY')) as created_on, profession, profile_pic FROM users WHERE user_id = $user_id";

        $user_data = $this->_connection->query($query)->fetchAll();

        return $user_data;
    }

```

-- Now again we need to establish the connection so we use the below code.

```php

    // trigger the parent construct so that the connect object gets created
    public function __construct()
    {
        parent::__construct();
    }

```

-----------------------------------------------------------------------------------------------

## 2. Blogs.php (Part 2)

### 2.2 What more do we need?

- In the final product when you click on a user it will show you his details and below that it will fetch all the blogs which he has added till now.
- So we need to write a query to fetch all the blogs added by a particular user based on their usre_id
- Paste the below code in `Blogs.php` in model folder.
-- Establishing the DB connection code is alread added so no need to add again.

```php

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

```

#### Continue the blog creation Refer : Point 2.2 [Creating controller](./index_code.md)
