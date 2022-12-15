# Signup Creation

## 1. Create signup form

- Paste the below code in `signup.php` file within the views folder where its mentioned as `Paste Signup Form content below`.

```html

<div class="container">
        <form action="signup.php" method="post" enctype="multipart/form-data">
            <label for="fname"><b>First Name</b></label>
            <input type="text" placeholder="Enter First Name" name="fname" required>

            <label for="lname"><b>Last Name</b></label>
            <input type="text" placeholder="Enter Last Name" name="lname" required>

            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" id="uname" required>
            <div id="usernameErrorMessage"></div>

            <label for="profession"><b>Profession</b></label>
            <input type="text" placeholder="Enter Profession" name="profession" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

            <label for="reneterpsw"><b>Reenter Password</b></label>
            <input type="password" placeholder="Reenter Password" name="reneterpsw" id="reneterpsw" required>
            <div id="passwordErrorMessage"></div>

            <lable for="img"><b>Blog Image</b></label>
            <input type="file" accept="image/*" name="image" id="image">

            <button type="submit" name="btnSignUp" id="btnSignUp">Signup</button>
        </form>
    </div>

```

## 2. Adding ajax validation scripts

- Paste the below code in `signup.php` file where its mentioned as `Ajax validation script`.

```html

<script>
        var password = document.getElementById("psw");
        var reenterPassword = document.getElementById("reneterpsw");
        var userName = document.getElementById("uname");
        var userNameValue = userName.value;

        // code to validate the password and reenter password
        

        // code to check if the user name is already taken
        
    </script>

```

## 3. Add validation for password and reenter password

- Paste the below code in `signup.php` where its mentioned as `code to validate the password and reenter password`

```javascript

        reenterPassword.onblur = function() {
            if(password.value != reenterPassword.value){
                document.getElementById("passwordErrorMessage").style.color = "red";
                document.getElementById("passwordErrorMessage").textContent = "Passwords do not match";
            }else{
                document.getElementById("passwordErrorMessage").style.display = "none";
            }
        }

```

## 4. Ajax code to check if a username is already taken

- Paste the below code in `signup.php` where its mentined as `code to check if the user name is already taken`.

```javascript

        $(document).ready(function(){
            $("#uname").keyup(function(){

            var username = $(this).val();
            var usernameRegex = /^[a-zA-Z0-9]+$/;

            if(usernameRegex.test(username) && username != ''){

                $.ajax({
                    url: 'ajaxfile.php',
                    type: 'post',
                    data: {username: username},
                    success: function(response){
                        $('#usernameErrorMessage').html(response);
                    }
                });
            }else{
                $("#usernameErrorMessage").html("<span style='color: red;'>Enter valid username</span>");
            }
            });
        });

```

## 5. Call the controller to signup a user when Signup button is clicked

- Paste the below code in `signup.php` where its mentioned as `controller call to save the user`.

```php

        if(isset($_POST['btnSignUp'])){
            $userData = array("fname"=>$_POST['fname'], "lname"=>$_POST['lname'], "uname"=>$_POST['uname'], "profession"=>$_POST['profession'], "psw"=>$_POST['psw'], );
            $objUserController = new UsersController;
            $objUserController->userSignup($userData);
        }

```

## 6. Failure message when signup fails

-- Paste the below code in `signup.php` where its mentioned as `failure message`.

```php

        if(isset($_REQUEST['failed'])){
            echo "Signup failed";
        }

```

## 7. Ajax file creation to fetch the usernames and show message

- Paste the below code in `ajaxfile.php`.

```php

<?php

use Blogs\Users;

include_once "../includes/classes.php";

if(isset($_POST['username'])){
    $objUser = new Users;
    $count = $objUser->fetchCountByUserName($_POST['username']);

    $response = "<span style='color: green;'>Available.</span>";
    if($count > 0){
        $response = "<span style='color: red;'>Not Available.</span>";
    }

    echo $response;
    die;
}

```

## 8. Create the controller method to validate the signup data and call save

-- Paste the below code in `UserController.php`.

```php

    /**
     * Method to validate and call model save for the user data on signup
     */
    public function userSignup($userData){
        // validate if the username is already taken
        $objUsers = new Users;
        $userCount = $objUsers->fetchCountByUserName($userData['uname']);

        if($userCount > 0){
            header('Location: signup.php?failed=true');
            exit;
        }

        // encrypt the password before saving
        $encryptedPassword = hash("sha256", $userData['psw']);
        $userData['psw'] = $encryptedPassword;
        $result = $objUsers->save($userData);

        if(!$result){
            header('Location: signup.php?failed=true');
            exit;
        }

        header('Location: login.php');
        exit;
    }

```

## 9. Create method in model to get the count based on username

- Paste the below code in `Users.php` within Model.

```php

    /**
     * method to fetch user count by username to check if he username is already taken.
     */
    public function fetchCountByUserName($userName){
        // query
        $query = "SELECT count(*) FROM users WHERE username = '$userName'";
        $user_data = $this->_connection->query($query)->fetch();
        return $user_data['count'];
    }

```

## 10. Create method to save the user info into database

- Paste the below code in `Users.php` file within model.

```php

    /**
     * method to save user.
     */
    public function save($userData){
        //query
        $query = "INSERT INTO users (first_name, last_name, user_password, username, profession) VALUES ('".$userData['fname']."', '".$userData['lname']."', '".$userData['psw']."', '".$userData['uname']."', '".$userData['profession']."')";

        if($this->_connection->exec($query)){
            return true;
        };

        return false;
    }

```
