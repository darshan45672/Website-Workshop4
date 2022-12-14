# Logout Creation

## 1. Developing Logout functionality

- Paste the below code in `logout.php` file withing the views.

```php

<?php
    session_start();
    unset($_SESSION["userName"]);
    unset($_SESSION["userId"]);

    header('Refresh: 2; URL = index.php');
?>

```

## 2. Add the Logout menu option

- Paste the below code in `header.php` within views where its mentioned as `paste the menu options below`.
- Below code will add `Logout`, `Login`, `User Name` and `Signup` options.

```html

                    <?php if(isset($_SESSION['userId'])) : ?>
                        <a class="navbar-item is-active" href="user-info.php"><?php echo $_SESSION['userName'] ?></a>
                        <a class="navbar-item is-active" href="logout.php">Logout</a>
                    <?php else : ?>
                        <a class="navbar-item is-active" href="login.php">Login</a>
                        <a class="navbar-item is-active" href="signup.php">Signup</a>
                    <?php endif ?>

```
