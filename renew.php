<?php
    /* including the database connection */
    session_start();
    include("conexao.php");

    /* getting the id value */
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    /* selecting the data */
    $select = "select devolucao_emp, renovacao_emp from emprestimos where ID_emp = '$id'";
    $query = mysqli_query($conexao, $select);
    $result = mysqli_fetch_assoc($query);
    
    /* to get things easier */
    $devolucao = $result['devolucao_emp'];
    $renovado = $result['renovacao_emp'];

    /* setting the limit */
    $limit = new DateTime($result['devolucao_emp']);
    $limit->add(new DateInterval('P21D'));
    $result_limit = $limit->format('Y-m-d');

    /* if the user already renoved more than three times */
    if($renovado == $result_limit){
        // displaying a message
        $_SESSION['blue'] = true;
        header('Location: profile.php');
        exit;
    }

    /* both statements do the same thing, but they save the data in different places in the database */
    if(($renovado != $result_limit) && ($renovado == 0)){
        // adding seven days to the date
        $new_date = new DateTime($devolucao);
        $new_date->add(new DateInterval('P7D'));
        $new_number = $new_date->format('Y-m-d');

        $insert = "update emprestimos set renovacao_emp = '$new_number' where ID_emp = '$id'";
        $query = mysqli_query($conexao, $insert);

        if(mysqli_affected_rows($conexao)){
            // if everything went fine
            $_SESSION['green'] = true;
            header('Location: profile.php');
            exit;

        }else{
            // if something went wrong
            $_SESSION['red'] = true;
            header('Location: profile.php');
            exit;
        }

    }elseif(($renovado != $result_limit) && ($renovado != 0)){
        $new_date = new DateTime($renovado);
        $new_date->add(new DateInterval('P7D'));
        $new_number = $new_date->format('Y-m-d');

        $update = "update emprestimos set renovacao_emp = '$new_number' where ID_emp = '$id'";
        $query = mysqli_query($conexao, $update);

        if(mysqli_affected_rows($conexao)){
            $_SESSION['green'] = true;
            header('Location: profile.php');
            exit;
            
        }else{
            $_SESSION['red'] = true;
            header('Location: profile.php');
            exit;
        } 

    }else{
        $_SESSION['red'] = true;
        header('Location: profile.php');
        exit;
    }


?>
