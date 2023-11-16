
<?php

/*aqui vamos conectar 
com o banco 
de dados*/
$servername = "localhost";
//você deu nome ao banco de dados
$database = "func2c"; //func2c ou func2d
$username = "root";
$password = "";


$conexao = mysqli_connect(
    $servername, $username, 
    $password,$database
);

if (!$conexao){
    die("Falha na conexão".mysqli_connect_error());
}
//echo "conectado com sucesso";

$id = $_POST["id"];
$nome = $_POST["nome"];
$cpf = $_POST["cpf"];
$botao = $_POST["botao"];
$pesquisa = $_POST["pesquisa"];

if(empty($botao)){

}else if($botao == "Cadastrar"){
    $sql = "INSERT INTO funcionarios 
    (id, nome, cpf) VALUES('','$nome', '$cpf')";
}else if($botao == "Excluir"){
    $sql = "DELETE FROM funcionarios WHERE id = '$id'";
}else if($botao == "Recuperar"){
    $sql_mostra_cad = "SELECT * FROM funcionarios WHERE nome like '%$pesquisa%'"; // %% busca por partes de um nome
}else if($botao == "Alterar"){
    $sql = "UPDATE funcionarios SET nome = '$nome', cpf = '$cpf' WHERE id = '$id'";
}
//aqui vou tratar erros nas operações C.E.R.A
if(!empty($sql)){
    if(mysqli_query($conexao, $sql)){
        echo "Operação realizada com sucesso";
    }else{
        echo "Houve um erro na operação: <br />";
        echo  mysqli_error($conexao);
    }
}

$selecionado = $_GET["id"];

if(!empty($selecionado)){
    $sql_selecionado = "SELECT * FROM funcionarios WHERE id = $selecionado";

    $resultado = mysqli_query($conexao, $sql_selecionado);

    while($linha = mysqli_fetch_assoc($resultado)){
        $id = $linha["id"];
        $nome = $linha["nome"];
        $cpf = $linha["cpf"];
    }
}

//echo $id." ".$nome." ".$cpf." ".$botao;



?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>System CERA</title>  
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

        <style>
        body{
            font-family: 'Montserrat', 'sans-serif';
            background-color: #EFE6DD;
        }
        .sistema{
            font-weight: bold;
            font-size: 22px;
            text-decoration: none;
            color: #231F20;
        }
        .cadastro{
            font-weight: bold;
            font-size: 16px;
            text-decoration: none;
            color: #231F20;
        }
        .selecionar{
            color: #BB4430;
        }
    </style>
    </head>
    <body>
        <h1 class="sistema">Sistema CERA</h1>
        <h2 class="cadastro">Cadastro de funcionários</h2>
    <form name = "func" method = "post" class="form">
        <label class="idlabel">ID</label>
        <input type ="text" name = "idi" value="<?php echo $id; ?>" disabled /><br />
        <input type ="hidden" name = "id" value="<?php echo $id; ?>"/>
        <label class="nomelabel">NOME</label>
        <input type ="text" name = "nome" value="<?php echo $nome; ?>"/><br />
        <label class="cpflabel">CPF</label>
        <input type ="text" name = "cpf" value="<?php echo $cpf; ?>" /><br />

        <div class="botao">
        <input type ="submit" name = "botao" value = "Cadastrar" class="botaocad"/>
        <input type ="submit" name = "botao" value = "Excluir" class="botaoexc"/>
        <br/>
        </div>

        <input type="text" name ="pesquisa" /> <input type="submit" name="botao" value="Recuperar" class="botaorec"/>
        
    </form>
    <table>
        <tr>
            <td>-</td><td>ID</td><td>Nome</td>
            <td>CPF</td>
        </tr>
        <?php
        if(empty($pesquisa)){
            $sql_mostra_cad = "SELECT * FROM funcionarios ORDER BY id desc limit 0,10";
        }
        
        $resultado = mysqli_query($conexao, $sql_mostra_cad);

        while($linha = mysqli_fetch_assoc($resultado)){
            echo "
            <tr>
                <td>
                    <a href='?id=".$linha["id"]."'>Selecionar</a>
                </td>
                <td>".$linha["id"]."</td>
                <td>".$linha["nome"]."</td>
                <td>".$linha["cpf"]."</td>
            </tr>
            ";
        }
        ?>
    </table>
    </body>

</html>