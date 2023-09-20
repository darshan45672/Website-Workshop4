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

        // paste the error check code here

        $unauthorised = false;
        if(isset($_REQUEST['failed'])){
            $unauthorised = true;
        }


    ?>

    <!-- Paste Login Form content below-->

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


    <?php 
        include './footer.php';
    ?>
    </body>
</html>
