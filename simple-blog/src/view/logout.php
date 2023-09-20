
<?php
if (isset($_SESSION)){
    session_start();

    unset($_SESSION["userName"]);
    unset($_SESSION["userId"]);

    header("Refresh: 2; URL = index.php");
}
?>
