<?php

/*aqui vamos conectar 
com o banco 
de dados*/
$servername = "localhost";
//você deu nome ao banco de dados
$database = "func2c";
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
$cpf = $_POST["CPF"];
$botao = $_POST["botao"];

//echo $id."  ".$nome."  ".$cpf."  ".$botao; 

$sql = "INSERT INTO funcionarios (id, nome, cpf)
    VALUES ('', '$nome', '$cpf')";

if($botao == "Cadastrar"){
    if(mysqli_query($conexao, $sql)){
        echo "salvo com sucesso";
    }else{
        echo "falha ao cadastrar";
    }
}
?>

<html> <body> 
    <form name="func" method = "post">
        <label>ID</label><input type="text" name = "id"/> </br>
        <label>Nome</label><input type="text" name = "nome"/> </br>
        <label>CPF</label><input type="text" name = "CPF"/> </br>
        <input type = "submit" name = "botao" value = "Cadastrar"/>
        <input type = "reset" name = "botao" value = "Cancelar"/>
    </form>

</body> </html> 
