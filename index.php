<?php session_start(); ?>
    <!doctype html>
    <html class="no-js" lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>The Skin Shop - Login</title>
        <link rel="stylesheet" href="css/foundation.css">
        <link rel="stylesheet" href="css/app.css">
    </head>

    <body>
        <div class='grid-container'>
            <div class='grid-x'>
                <div class='cell'>
                    <h4>The Skin Shop</h4>
                </div>
                <div class='cell'>
                    Username:
                    <input type='text' id='username'>
                </div>
                <div class='cell'>
                    Password:
                    <input type='password' id='password'>
                </div>
                <div class='cell'>
                    <a href="#" id='loginBtn' class="expanded button">Login</a>
                </div>
            </div>
        </div>


        <?php require_once('./_footer.php'); ?>