<?php
require_once 'php/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cod-medicamento'])) {
    $cod_medicamento = $_POST['cod-medicamento'];
    $nome_medicamento = $_POST['medicamento'];
    $tipo_produto = $_POST['tipo-produto'];
    $preco_produto = $_POST['preco-produto'];
    $descricao_produto = $_POST['descricao-produto'];
    $data_validade = $_POST['data-validade'];
    $unidades = $_POST['unidades'];

    try {
        $conn = Conexao::getConn();
        $sql = "UPDATE medicamentos SET 
                    nome_medicamento = ?, 
                    tipo = ?, 
                    preco = ?, 
                    descricao = ?, 
                    data_validade = ?, 
                    unidade = ? 
                WHERE cod_medicamento = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nome_medicamento, $tipo_produto, $preco_produto, $descricao_produto, $data_validade, $unidades, $cod_medicamento]);

        header("Location: /sistema-senai/sucessao_editar.php?cod_medicamento=$cod_medicamento");
        exit;
    } catch (PDOException $e) {
        echo "Erro ao atualizar o medicamento: " . $e->getMessage();
    }
} else if (isset($_GET['cod_medicamento'])) {
    $cod_medicamento = $_GET['cod_medicamento'];
    $conn = Conexao::getConn();

    $stmt = $conn->prepare("SELECT * FROM medicamentos WHERE cod_medicamento = ?");
    $stmt->execute([$cod_medicamento]);
    $medicamento = $stmt->fetch();

    if (!$medicamento) {
        echo "Medicamento não encontrado.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Medicamento - PHAMARCY</title>
    <link rel="shortcut icon" href="images/logo-removebg-preview.png" type="image/x-icon">
    <style>
        body {
            background-color: #1c3b29;
            font-family: 'Arial', sans-serif;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        h2 {
            color: #fff;
            font-size: 2em;
            margin: 20px 0;
        }
        .form-container {
            width: 90%;
            max-width: 900px;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 15px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"], input[type="date"], input[type="number"], select {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 1em;
        }
        input[type="text"]:focus, input[type="date"]:focus, input[type="number"]:focus, select:focus {
            border-color: #4CAF50;
            outline: none;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            margin-top: 20px;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }
        button:hover {
            background-color: #45a049;
        }
        button:active {
            transform: scale(0.98);
        }
        .back-button {
            background-color: #f44336;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            font-weight: bold;
            border-radius: 8px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s;
            margin-top: 15px;
            display: inline-block;
            text-align: center;
        }
        .back-button:hover {
            background-color: #e53935;
            box-shadow: 0 5px 8px rgba(0, 0, 0, 0.3);
        }
        footer {
            text-align: center;
            color: white;
            font-size: 0.9em;
            padding: 10px 0;
        }
        .logo {
            width: 100px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <img src="images/logo-removebg-preview.png" alt="PHAMARCY LOGO" class="logo">
    <h2>Editar Medicamento</h2>
    <div class="form-container">
        <form action="editar_medicamentos.php" method="POST">
            <input type="hidden" name="cod-medicamento" value="<?php echo htmlspecialchars($medicamento['cod_medicamento']); ?>">
            <label>Nome do Medicamento</label>
            <input type="text" name="medicamento" value="<?php echo htmlspecialchars($medicamento['nome_medicamento']); ?>" required>

            <label>Tipo do Medicamento</label>
            <select name="tipo-produto" required>
                <option value="comprimido" <?php echo ($medicamento['tipo'] == 'comprimido') ? 'selected' : ''; ?>>Comprimido</option>
                <option value="suspensao" <?php echo ($medicamento['tipo'] == 'suspensao') ? 'selected' : ''; ?>>Suspensão</option>
                <option value="creme" <?php echo ($medicamento['tipo'] == 'creme') ? 'selected' : ''; ?>>Creme</option>
                <option value="pomada" <?php echo ($medicamento['tipo'] == 'pomada') ? 'selected' : ''; ?>>Pomada</option>
                <option value="injetavel" <?php echo ($medicamento['tipo'] == 'injetavel') ? 'selected' : ''; ?>>Injetável</option>
            </select>

            <label>Preço (R$)</label>
            <input type="number" name="preco-produto" value="<?php echo htmlspecialchars($medicamento['preco']); ?>" step="0.01" required>

            <label>Descrição</label>
            <input type="text" name="descricao-produto" value="<?php echo htmlspecialchars($medicamento['descricao']); ?>" required>

            <label>Data de Validade</label>
            <input type="date" name="data-validade" value="<?php echo htmlspecialchars($medicamento['data_validade']); ?>" required>

            <label>Unidades</label>
            <input type="text" name="unidades" value="<?php echo htmlspecialchars($medicamento['unidade']); ?>" required>

            <button type="submit">Salvar Alterações</button>

            <a href="php/painel.php" class="back-button">Voltar ao painel</a>
        </form>
    </div>
    <footer>  <p>&copy; GRUPO DE DESENVOLVEDORES DE SISTEMA DO FIRJAN SENAI - DUQUE DE CAXIAS/RJ - 2024</p></footer>
</body>
</html>
