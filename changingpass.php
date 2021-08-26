<?php 
  // starting the session and including the database connection
  session_start();
  include("conexao.php");

  // getting the data thru the session
  $email = $_SESSION['email'];

  // getting the data thru the input
  $senha_nova = filter_input(INPUT_POST, 'newpass', FILTER_SANITIZE_STRING);
  $confirmar_senha = filter_input(INPUT_POST, 'confirm', FILTER_SANITIZE_STRING);

  // hashing the password informed
  $senha_segura = password_hash($senha_nova, PASSWORD_DEFAULT);

  // if the passwords in the inputs are different, show a message informing the user
  if($senha_nova != $confirmar_senha){
    $_SESSION['blue'] = true;
    header('Location: newpass.php');
    exit;

  }elseif($senha_nova == $confirmar_senha){
    // updating the password in the database
    $sql = "update usuario set senha_user = '$senha_segura' where email_user = '$email'";
    $query = mysqli_query($conexao, $sql);

    // if everything went well, show a message
    if($query){
      $_SESSION['green'] = true;
      header('Location: newpass.php');
      exit;

    // if something went wrong, show a message too
    }elseif(!$query){
      $_SESSION['red'] = true;
      header('Location: newpass.php');
      exit;
    }

  }  