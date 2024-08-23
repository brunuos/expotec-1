<?php
session_start(); // Start the session

include('conexao.php'); // Include the database connection

if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $mysql->real_escape_string($_POST['email']);
    $senha = $mysql->real_escape_string($_POST['senha']);

    if (empty($email)) {
        echo "Preencha seu email";
    } elseif (empty($senha)) {
        echo "Preencha sua senha";
    } else {
        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysql->query($sql_code) or die ("Falha na execução do código SQL: " . $mysql->error);

        $quantidade = $sql_query->num_rows;

        if ($quantidade == 1) {
            $usuario = $sql_query->fetch_assoc();

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header('Location: http://localhost:85/expotec/estudos/home.html');
            exit();
        } else {
            header("Location: http://localhost:85/expotec/login/index.php");
            exit();
        }
    }
}
?>
