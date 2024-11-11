<?php
// Inclui a classe de conexão com o banco de dados
require_once 'php/connection.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHAMARCY</title>
    <link rel="shortcut icon" href="images/logo-removebg-preview.png" type="image/x-icon">
    <style>
        body {
            background-color: rgb(20, 60, 35);
            font: normal 15pt Arial;
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        h2 {
            color: whitesmoke;
        }
        .form-container {
            width: 90%;
            max-width: 1050px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="text"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button, .back-button, .edit-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 220px;
            padding: 10px 12px;
            margin-top: 15px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
            text-decoration: none;
        }
        #btn-editar { background-color: #FFA500; color: white; }
        #btn-excluir { background-color: #f44336; color: white; }
        #btn-consultar { background-color: #2196F3; color: white; }
        .back-button { background-color: #4CAF50; color: white; text-decoration: none; }
        button img, .edit-link img { height: 18px; margin-right: 8px; }
        button:hover, .edit-link:hover { box-shadow: 0 5px 8px rgba(0, 0, 0, 0.3); }
        #btn-editar:hover { background-color: #FF8C00; }
        #btn-excluir:hover { background-color: #d32f2f; }
        #btn-consultar:hover { background-color: #1E88E5; }
        .back-button:hover { background-color: #45a049; }
        button:active, .edit-link:active { transform: scale(0.97); }
        .table-container {
            width: 100%;
            max-height: 400px;
            overflow-y: auto;
            margin-top: 20px;
        }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; font-weight: bold; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        footer { text-align: center; color: white; font-size: 0.9em; padding: 10px 0; }
        .logo { width: 150px; max-width: 25%; margin-top: 30px; margin-bottom: 15px; animation: fadeIn 1.2s ease-in-out; filter: drop-shadow(2px 4px 6px rgba(0, 0, 0, 0.3)); }
    </style>
</head>
<body>
    <img src="images/logo-removebg-preview.png" alt="PHAMARCY LOGO" class="logo">
    <h2>Consulta de Medicamentos</h2>
    <div class="form-container">
        <form action="" method="post">
            <label for="medicamento">Medicamento:</label>
            <input type="text" name="medicamento" placeholder="Digite qual produto deseja consultar" required>

            <button type="submit" name="consultar" id="btn-consultar">
                <img src="images/relatorio-de-negocios-removebg-preview.png" alt="Consultar produto"> Consultar
            </button>

            <a href="listar_medicamentos.php" class="edit-link" id="btn-editar">
                <img src="images/usuario-confirmado-removebg-preview.png" alt="Editar produto"> Editar Medicamento
            </a>
            <a href="php/painel.php" class="back-button">Voltar ao painel</a>
        </form>

        <?php
        if (isset($_POST['consultar'])) {
            try {
                $conn = Conexao::getConn();
                $nome_medicamento = $_POST['medicamento'];

                $sql = "SELECT * FROM medicamentos WHERE nome_medicamento = :nome_medicamento";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nome_medicamento', $nome_medicamento, PDO::PARAM_STR);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo "<div class='table-container'>";
                    echo "<table>";
                    echo "<tr>
                            <th>Nome do Medicamento</th>
                            <th>Tipo</th>
                            <th>Preço</th>
                            <th>Fabricante</th>
                            <th>Data de Validade</th>
                            <th>Unidades</th>
                          </tr>";

                    while ($medicamento = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                        <td>{$medicamento['nome_medicamento']}</td>
                        <td>{$medicamento['tipo']}</td>
                        <td>R$ " . number_format($medicamento['preco'], 2, ',', '.') . "</td>
                        <td>{$medicamento['fabricante']}</td>
                        <td>{$medicamento['data_validade']}</td>
                        <td>{$medicamento['unidade']}</td>
                      </tr>";
                    }
                    echo "</table>";
                    echo "</div>";
                } else {
                    echo "<p>Nenhum medicamento encontrado.</p>";
                }
            } catch (PDOException $e) {
                echo "<p>Erro ao consultar medicamentos: " . $e->getMessage() . "</p>";
            }
        }
        ?>
    </div>
    <footer>
    <p>&copy; GRUPO DE DESENVOLVEDORES DE SISTEMA DO FIRJAN SENAI - DUQUE DE CAXIAS/RJ - 2024</p>
    </footer>
</body>
</html>
