<?php 
    /* including the files and starting the session */
    session_start();
    include('conexao.php');
    require_once('src/PHPMailer.php');
    require_once('src/SMTP.php');
    require_once('src/Exception.php');
    
    /* using the classes */
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    /* selecting on the database and returning the values */
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $_SESSION['email'] = $email;

    $sql = "select email_user, senha_user from usuario where email_user = '$email'";
    $result = mysqli_query($conexao, $sql);
    $lines = mysqli_num_rows($result);

    /* showing a message if the email doesn't exists */
    if($lines == 0){
        $_SESSION['no-email'] = true;
        header("Location: forgotpass.php");
        exit;
    }elseif($lines == 1){
        $_SESSION['email-sent'] = true;
        header("Location: forgotpass.php");

        $mail = new PHPMailer(true);
    
            try {
                // defining the parameters to the connection to the gmail  
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'yourgmail@gmail.com';
                $mail->Password = 'yourpassword';
                $mail->Port = 587;

                // who's senting the email to who 
                $mail->setFrom('yourgmail@gmail.com');
                $mail->addAddress($email);

                // content of the email 
                $mail->isHTML(true);
                $mail->Subject = utf8_decode('Pedido de reformulação de senha');
                $mail->Body = "Recentemente foi acionado um pedido de reformulação de senha 
                para o site da biblioteca Etec de Araçatuba. Se você acredita que foi um engano, 
                por favor ignore esta mensagem, sua conta não está em perigo. Caso contrário, acesse: 
                <a href='localhost/tcc/newpass.php'>CLIQUE AQUI</a>";
                //$mail->AltBody = '';

                if($mail->send()) {
                    echo 'Email enviado com sucesso';
                } else {
                    echo 'Email nao enviado';
                }
            } catch (Exception $e) {
                echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
            }
    }
    
    