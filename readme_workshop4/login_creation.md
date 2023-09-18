# Login Creation

## 1. Create the login form

- Paste the below code in `login.php` file above `Paste the buffer start code here`

```php
<?php
    session_start();
    ob_start();
?>
```

- Paste the below code in `login.php` page within the views folder where its mentioned as `Paste Login Form content below`.

```html

    <div class="container">
        <form action="user-info.php" method="post">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <button type="submit" name="btnLogin">Login</button>

            <div style="background-color:#f1f1f1">
                <span class="psw">Forgot <a href="#">password?</a></span>
            </div>

            <?php if($unauthorised) : ?>
                <div class="unauthorised">
                    <p>Incorrect Username or Password</p>
                </div>
            <?php endif ?>
        </form>
    </div>

```

## 2. Add error check code

- Paste the below code in `login.php` where its mentioned as `paste the error check code here`

```php

        $unauthorised = false;
        if(isset($_REQUEST['failed'])){
            $unauthorised = true;
        }

```

## 3. Create method to validate the user

- Paste the below method in `UserController.php` within the controller folder.

```php

    /**
     * Method to validate user credentials and redirect on success.
     */
    public function validateLogin($username, $password)
    {
        // encrypting the password before validation because in database the passwords encypted and stored.
        $encryptedPassword = hash("sha256", $password);

        $ObjUsers = new Users;
        $userData = $ObjUsers->fetchByUserNamePassword($username, $encryptedPassword);

        if(!empty($userData)){
            // set the user session 
            $_SESSION['userName'] = $userData[0]['username'];
            $_SESSION['userId'] = $userData[0]['user_id'];

            return $userData[0];
        }else{
            // if login fails redirect back to login pafe with failure message.
            header('Location: login.php?failed=true');
            exit;
        }
    }

```

## 4. Create method to fetch the data from database to validate the login

- Paste the below code in `Users.php` class within Model folder.

```php

/**
     * Method to fetch data based on username and sha256 encrypted password
     */
    public function fetchByUserNamePassword($userName, $password){
        //query
        $query = "SELECT user_id, first_name, last_name, username, (to_char(created_on, 'Mon DD, YYYY')) as created_on, profession, profile_pic FROM users WHERE username = '$userName' AND user_password = '$password'";

        $user_data = $this->_connection->query($query)->fetchAll();

        return $user_data;
    }

```
