# MVC Design

    - MVC stand for : Model , View and Controller. (Basically three different folders with those names)
    - This type of design is used to segregate the code so that its easy to read and maintain.

## 1 MVC Design details

### 1.1 Model

- This folder contains all the code related to the database, This layer's work is just to connect to db and do all the database operations of the application.
- It should not have any other logic other than DB operations.
- Now we know where to keep our quries or any DB related operations or codes, We dont have to search the entire application to find some quries.
- IMPORTANT : Model later should never call any method / function from View or Controller layers, Its job is to do what the controller says.

### 1.2 View

- This folder contains ony the view related code.
- Whatever the end user sees in the browser when the website is accessed will be kept in this folder.
- Html files, Css files, Images, Frontend javascrip files etc all these will come under view folder because its all related to the view.
- IMPORTANT : No files in the view folder should directly communicate with the files in the Model layer, Controller is a middle layer between View and Model and communication should happen via controllers.

### 1.3 Controller

- This is a middle layer between View and Model.
- All the communication between layers should go via controller.
- This layer will have all the logic required for the application.
- IMPORTANT : This layer should not connect to database directly, It should use the model layer to do that.
- Whatever data is sent my the model layer will be validated or purified in this layer.

-----------------------------------------------------------------------------------------------

## 2. MVC Folder Structure

- The MVC folder structure is already created in your fork.
- If you open the simple-blog/src folder you will see folders named `model`, `view` and `controller`
- These MVC folders have different files inside them
  - model
    - Blogs.php
      - This file connects to `blogs` table, and all the operations related to `blogs` table will be kept here
    - Users.php
      - This file connects to `users` table, and all the operations related to `user` table will be kept here

  - controller
    - BlogsController.php
      - This files communicates with Blogs.php from models and it containes the logics related to `blogs`
    - UsersController.php
      - This files communicates with Users.php from models and it containes the logics related to `users`

  - view
    - css folder
      - Contains all the `.css` files required for the application.
      - This file contains same code which was done in workshop 2, Only one new style is added
      - Copy the below style and paste it at the end of the `style.css` file within `css` folder

      ```css

        .blogs{
            border-bottom: solid rgba(0,0,0,.2) 1px;
            margin-top: 10px;
            padding-bottom: 10px;
            font-size: 1.3rem;
            font-weight: 600;
        }

      ```

    - images folder
      - Contains all the images used in the application.
      - For now all the images required for the application are already added into the folder.
    - footer.php
      - It will contain the footer code for the application which can be imported where ever its required instead of writing it again.
    - header.php
      - It will contain the header code for the application which can be imported where ever its required instead of writing it again.
    - index.php
      - This is the main page or the first page which is accessed and it contains the main blogs display code.
    - user-info.php
      - This file contains the view of individual user.
    - single-post.php
      - This will have the view of individual posts or blogs.

-----------------------------------------------------------------------------------------------

## 3. Other folders and files

### 3.1 .env file

- This is the environment file.
- It will contains all the important values which will be used in the application
- Example : database credentials lile username , password, hostname, port number etc.
- Lets add our database credentials to this file. Paste the below code in `.env` file.

```

DB_HOST=192.168.2.79
DB_NAME=site_blog
DB_PORT=5431
DB_USER=user
DB_PASSWORD=password

```

### 3.2 config folder

- This file contains all the configurations related to the application
- Example, Database connection.
- Paste the below code in `Connection.php` file.

```php

    public $_connection = null;

    public function __construct()
    {
        try {
            // fetch all the variables from the environment file.
            $db_host = getenv('DB_HOST');
            $db_name = getenv('DB_NAME');
            $db_port = (int) getenv('DB_PORT');
            $db_user = getenv('DB_USER');
            $db_password = getenv('DB_PASSWORD');

            $this->_connection = new PDO("pgsql:host=" . $db_host . ";port= $db_port ;dbname=" .  $db_name , $db_user, $db_password, array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_EMULATE_PREPARES => true));

        } catch (Exception $e) {
            throw new Exception("Unable to connect to database. Error: " . json_encode(['dbhost' => $db_host, 'database_port' => $db_port, 'db_name' => $db_name]). $_SERVER['REQUEST_URI']);
        }
    }

```

### 3.3 includes folder

- This folder contains files which will have all the requered files included in it so that we dont have to import each files everytime when its required. Instead we can just import the one file `classes.php` which has all the files included in it.
- Include all the classes in the `classes.php` file.

```php

    // All the required classes will be added here so that we dont have to include it in each file where its used.
    include_once '../config/Connection.php';
    include_once '../controller/BlogsController.php';
    include_once '../controller/UsersController.php';
    include_once '../model/Blogs.php';
    include_once '../model/Users.php';

```
