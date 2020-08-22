<?php
include("database.php");
if(session_id()=="")session_start();

$current=basename($_SERVER["PHP_SELF"]);
$path=$_SERVER['REQUEST_URI'];
$active_user=0;
$active_user_type=-1;


if(isset($_SESSION['active_user'])){
    $active_user=$_SESSION['active_user'];
    $active_user_email=$_SESSION["active_user_email"];
    $active_user_type=$_SESSION['active_user_type'];
    $active_user_id=$_SESSION["active_user_id"];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>SRA FIT</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="design.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="gallery.css">
    <script src="gallery.js"></script>

</head>

<body>

<header>
    <table class="header_table">
        <tr>
            <nav id="navigation" class="menu">
                <th class="menu_align">
                    <?php

                    if($active_user_type==2){
                        echo '<a href="coach.php"';
                        if($current=="coach.php")echo ' class="active"';
                        echo ">HOME</a>";
                    }
                    else if($active_user_type==3){
                        echo '<a href="member.php"';
                        if($current=="member.php")echo ' class="active"';
                        echo ">HOME</a>";
                    }

                    else {
                        echo '<a href="index.php"';
                        if($current=="index.php")echo ' class="active"';
                        echo ">HOME</a>";
                    }

                    ?>
                </th>

            <th class="menu_align"><a href="gallery.php"class="link">PHOTO GALLERY</a></th>
            <th class="menu_align"><a href="https://www.facebook.com/SRUFIT" class="link">FACEBOOK</a></th>

            <?php
            if($active_user===0){
                echo "<th class='menu_align'><a class='link' href='registration.php'>REGISTRATION</a></th>";
                echo "<th class='menu_align'><a class='link' href='login.php'>LOGIN</a></th>";
            }
            else{
                echo "<th></th>
                      <th><a class='link' href='login.php?logout=1'>LOGOUT</a></th>";
            }
            ?>

            </nav>
        </tr>
    </table>
    <table>
        <tr>
            <td class="adjust"></td>
            <td class="header_h1">
                <img src="images/logo.jpg" style="border-radius: 50%; width:150px; height:150px;" class="header_table"><br>
            </td>
            <td style="width: 50px"></td>
            <td class="header_h2">
                <h1><strong>SRA FIT</strong></h1>
                <h2><strong>Sports and Recreational Association FIT</strong></h2>
            </td>
            <td class="adjust"></td>
        </tr>
    </table>
</header>


<section id="content">