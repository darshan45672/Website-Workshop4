<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>HTML & CSS Learning Workshop Blog</title>
		<meta content="width=device-width, initial-scale=1" name="viewport" />
        <link rel="stylesheet" href="./css/style.css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

	</head>
    <body>
    <?php
        include './header.php';
        include_once "../includes/classes.php";
        use Blogs\Controller\UsersController;        

        // controller call to save the user.

        if(isset($_POST['btnSignUp'])){
            $userData = array("fname"=>$_POST['fname'], "lname"=>$_POST['lname'], "uname"=>$_POST['uname'], "profession"=>$_POST['profession'], "psw"=>$_POST['psw'], );
            $objUserController = new UsersController;
            $objUserController->userSignup($userData);
        }



        // failure message.

        if(isset($_REQUEST['failed'])){
            echo "Signup failed";
        }


    ?>

    <!-- Paste Signup Form content below-->
    
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


    <!-- Ajax validation script -->
    
<script>
        var password = document.getElementById("psw");
        var reenterPassword = document.getElementById("reneterpsw");
        var userName = document.getElementById("uname");
        var userNameValue = userName.value;

        // code to validate the password and reenter password
        
        reenterPassword.onblur = function() {
            if(password.value != reenterPassword.value){
                document.getElementById("passwordErrorMessage").style.color = "red";
                document.getElementById("passwordErrorMessage").textContent = "Passwords do not match";
            }else{
                document.getElementById("passwordErrorMessage").style.display = "none";
            }
        }


        // code to check if the user name is already taken

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

        
    </script>


    <?php 
        include './footer.php';
    ?>
    </body>
</html>
