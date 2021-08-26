<?php
    /* logging the user out by destroying his session */
    session_start();
    session_destroy();
    
    /* redirecting him to the login page */
    header('Location: login_page.php');
    exit();