<?php session_start(); 

if(!$_SESSION['logged_in']){
   header("Location: ./"); 
}

?>


<!doctype html>
<html class="no-js" lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Basic Timeclock</title>
        <link rel="stylesheet" href="css/foundation.css">
        <link rel="stylesheet" href="css/app.css">
    </head>
    
    <body>   

   
   <div class="title-bar" data-responsive-toggle="responsive-menu" data-hide-for="medium">
    <button class="menu-icon" type="button" data-toggle="responsive-menu"></button>
    <div class="title-bar-title">Menu</div>
</div>

<div class="top-bar" id="responsive-menu">
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text">Basic Timeclock</li>
            <li><a href="./home.php">Timeclock</a></li>
            <li><a href="./manageProjects.php">Manage Projects</a></li>
            <li><a href="./reports.php">Reports</a></li>
            <li><a href="./edit.php">Edit</a></li>
            <li><a href="./logout.php">Logout</a></li>
        </ul>
    </div>
</div>