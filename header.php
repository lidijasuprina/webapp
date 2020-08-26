<?php
include("database.php");
if(session_id()=="")session_start();

$current=basename($_SERVER["PHP_SELF"]);
$path=$_SERVER["REQUEST_URI"];
$active_user=0;
$active_user_type=-1;


if(isset($_SESSION["active_user"])){
    $active_user=$_SESSION["active_user"];
    $active_user_email=$_SESSION["active_user_email"];
    $active_user_type=$_SESSION["active_user_type"];
    $active_user_id=$_SESSION["active_user_id"];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>SRA FIT</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="design.css">
    <link rel="stylesheet" type="text/css" href="gallery.css">
    <script src="gallery.js"></script>

</head>

<body>

<header>
    <ul>
        <?php

        if($active_user_type==2){
            echo '<li><a href="coach.php"';
            if($current=="coach.php")echo ' class="active"';
            echo ">HOME</a></li>";
        }
        else if($active_user_type==3){
            echo '<li><a href="member.php"';
            if($current=="member.php")echo ' class="active"';
            echo ">HOME</a></li>";
        }

        else {
            echo '<li><a href="index.php"';
            if($current=="index.php")echo ' class="active"';
            echo ">HOME</a></li>";
        }

        ?>


        <li><a href="gallery.php" class="link">PHOTO GALLERY</a></li>
        <li><a href="https://www.facebook.com/SRUFIT" class="link" target="_blank">FACEBOOK</a></li>

        <?php
        if($active_user===0){
            echo "<li><a class='link' href='registration.php'>REGISTRATION</a></li>";
            echo "<li><a class='link' href='login.php'>LOGIN</a></li>";
        }
        else{
            echo "
                  <li><a class='link' href='login.php?logout=1'>LOGOUT</a></li>";
        }
        ?>
    </ul>

    <table class="header_table">
        <tr>
            <td>
                <img src="images/logo.jpg" alt="SRA FIT Logo" style="border-radius: 50%; width:150px; height:150px;" class="header_table"><br>
            </td>
            <td>
                <h1><strong>SRA FIT</strong></h1>
                <h2><strong>Sports and Recreational Association FIT</strong></h2>
            </td>
        </tr>
    </table>
</header>


<section class="content">