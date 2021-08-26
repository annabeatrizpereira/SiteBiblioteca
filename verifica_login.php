<?php
    // starting the session which is used to get values saved in the '$_SESSION' variable. 
    // this variable were used during the whole project.
    session_start();

    // checking if the user is logged. the autentication were made on 'login.php'.
    if(!$_SESSION['email_user']){
        header('Location: login_page.php');
        exit();
    }

