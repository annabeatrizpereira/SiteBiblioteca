<?php
    /* including files and starting session */
    session_start();
    include("conexao.php");
    
    /* getting the id and deleting it on the database */
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $sql = "delete from reservas where ID_res='$id'";
    $query = mysqli_query($conexao, $sql);

    /* redirecting the page */
    if(mysqli_affected_rows($conexao)){
        header("Location: reservas.php");
    }else{
        header("Location: reservas.php");
    }
?>