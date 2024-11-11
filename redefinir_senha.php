<?php
require_once 'php/connection.php'; // Inclusão da classe de conexão

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    try {
        // Conexão com o banco de dados
        $pdo = Conexao::getConn();

        // Verifica se o token existe no banco e se ainda não expirou
        $stmt = $pdo->prepare("SELECT * FROM funcionarios WHERE reset_token = :token AND expira_em > NOW()");
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        // Se o token não for encontrado ou já expirado
        if ($stmt->rowCount() == 0) {
            echo "Token inválido ou expirado.";
            exit;
        }

        // Token válido, permite redefinir a senha
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nova_senha = $_POST['senha'];

            // Atualiza a senha no banco de dados
            $stmt = $pdo->prepare("UPDATE funcionarios SET senha = :senha, reset_token = NULL, expira_em = NULL WHERE reset_token = :token");
            $stmt->bindParam(':senha', password_hash($nova_senha, PASSWORD_DEFAULT)); // Armazena a senha de forma segura
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            echo "Senha alterada com sucesso!";
        }

    } catch (PDOException $e) {
        echo 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
    }
} else {
    echo "Token não fornecido.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
</head>
<body>
    <h2>Redefinir sua senha</h2>

    <form action="redefinir_senha.php?token=<?php echo $token; ?>" method="POST">
        <label for="senha">Nova Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <button type="submit">Alterar Senha</button>
    </form>

</body>
</html>
