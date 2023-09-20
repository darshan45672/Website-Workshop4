
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
