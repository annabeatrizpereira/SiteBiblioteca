<?php
    // including the database connection
    include_once("conexao.php");

    // getting the data informed by the user on the input
    $buscas = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);

    // selecting the data informed
    $result_buscas = "select u.nome_user, l.nome_liv, r.ID_res from reservas as r join usuario as u on r.ID_user = u.ID_user ";
    $result_buscas .= "join livros as l on r.ID_liv = l.ID_liv where l.nome_liv like '%$buscas%'";
    $resultado_buscas = mysqli_query($conexao, $result_buscas);

    // if the data exists, display it on the screen
    if(($resultado_buscas) and ($resultado_buscas->num_rows != 0)){
        while($row_buscas = mysqli_fetch_assoc($resultado_buscas)){
            echo '<tr>
                    <td class="td-reserves">'.$row_buscas['nome_liv'].'</td>
                    <td class="td-reserves">'.$row_buscas['nome_user'].'</td>
                    <td class="td-reserves">
                        <a href="delete.php?id='.$row_buscas['ID_res'].'" class="reserve">EXCLUIR</a>
                    </td>
                </tr>';
        }
    
    // if it doesn't, show a message informing the user
    }else{
        echo "<tr>
        <td class='no-book' colspan='3'>Livro liberado.</td>
    </tr>";
    }

?>