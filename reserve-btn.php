<?php
    /* includint the database connection */
    session_start();
    include("conexao.php");

    /* getting the book id thru the input */
    $book = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    /* getting the user id thru the session */
    $email = $_SESSION['email_user'];
    $sql = "select ID_user from usuario where email_user = '$email'";
    $query = mysqli_query($conexao, $sql);
    $result = mysqli_fetch_assoc($query);
    $user = $result['ID_user'];

    /* checking if the book is already reserved */
    $sql_two = "select ID_liv from reservas where ID_liv = '$book'";
    $query_two = mysqli_query($conexao, $sql_two);
    $num_rows = mysqli_num_rows($query_two);
    echo $num_rows, "<br>";

    /* checking if the user already made more than three reserves */
    $sql_three = "select ID_user from reservas where ID_user = '$user'";
    $query_three = mysqli_query($conexao, $sql_three);
    $num_rows_two = mysqli_num_rows($query_three);
    echo $num_rows_two, "<br>";

    /* checking if the book is already reserved by the same user */
    $sql_four = "select ID_liv, ID_user from reservas where ID_liv = '$book' and ID_user = '$user'";
    $query_four = mysqli_query($conexao, $sql_four);
    $num_rows_three = mysqli_num_rows($query_four);
    echo $num_rows_three, "<br>";

    if(($num_rows == 0) && ($num_rows_two < 3) && ($num_rows_three == 0)){
        /* reservetion concluced */
        $sql_five = "insert into reservas (ID_res, ID_liv, ID_user, data_res) values (default, '$book', '$user', now())";
        $query_five = mysqli_query($conexao, $sql_five);

        $_SESSION['green'] = true;
        header("Location: collection.php");
        exit;

    }elseif(($num_rows != 0) && ($num_rows_three == 0)){
        /* book already reserved by other user */
        $_SESSION['red'] = true;
        header("Location: collection.php");
        exit;

    }elseif(($num_rows_two >= 3) && ($num_rows_three == 0)){
        /* user already made more than 3 reserves */
        $_SESSION['purple'] = true;
        header("Location: collection.php");
        exit;

    }elseif($num_rows_three != 0){
        /* user already reserved this same book */
        $_SESSION['blue'] = true;
        header("Location: collection.php");
        exit;

    }else{
        /* error unexpected */
        echo 'Ocorreu um erro. Por favor, retorne e recarregue a página anterior.';
    }


?>

