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
            width: 80%;
            max-width: 600px;
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
        button, .back-button {
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
        }
        #btn-editar { background-color: #FFA500; color: white; }
        #btn-excluir { background-color: #f44336; color: white; }
        #btn-relatorio { background-color: #2196F3; color: white; }
        .back-button { background-color: #4CAF50; color: white; text-decoration: none; }
        button img { height: 18px; margin-right: 8px; }
        button:hover { box-shadow: 0 5px 8px rgba(0, 0, 0, 0.3); }
        #btn-salvar:hover { background-color: #45a049; }
        #btn-excluir:hover { background-color: #d32f2f; }
        #btn-relatorio:hover { background-color: #1E88E5; }
        .back-button:hover { background-color: #45a049; }
        button:active { transform: scale(0.97); }
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
            <input type="text" name="medicamento" placeholder="Digite qual produto deseja cadastrar" required>

            <label for="cod-produto">Código Produto:</label>
            <input type="text" name="cod-produto" placeholder="Digite qual o código do produto" required>

            <label for="tipo-produto">Tipo:</label>
            <select name="tipo-produto" id="produto" required>
                <option value="">Selecione o tipo</option>
                <option value="tipo1">Tipo 1</option>
                <option value="tipo2">Tipo 2</option>
                <option value="tipo3">Tipo 3</option>
            </select>

            <label for="preco-produto">Preço: R$</label>
            <input type="text" name="preco-produto" placeholder="Digite o preço do produto" required>

            <label for="descricao-produto">Descrição:</label>
            <input type="text" name="descricao-produto" placeholder="Digite a descrição do produto" required>

            <label for="data-validade">Data Validade:</label>
            <input type="date" name="data-validade" required>

            <label for="unidades">Unidades:</label>
            <input type="text" name="unidades" placeholder="Digite quantas unidades" required>

            <button type="submit" name="gerar_relatorio" id="btn-relatorio">
                <img src="images/relatorio-de-negocios-removebg-preview.png" alt="Visualizar relatório"> Gerar Relatório
            </button>
            <button type="submit" id="btn-editar">
                <img src="images/usuario-confirmado-removebg-preview.png" alt="Salvar produto"> Editar
            </button>
            <button type="submit" id="btn-excluir">
                <img src="images/excluir-removebg-preview.png" alt="Excluir produto"> Excluir
            </button>
            <a href="painel.html" class="back-button">Voltar ao painel</a>
        </form>

        <?php
        // Verifica se o botão "Gerar Relatório" foi clicado
        if (isset($_POST['gerar_relatorio'])) {
            try {
                // Conecta ao banco de dados usando o método getConn() da classe Conexao
                $conn = Conexao::getConn();

                // Obtém o valor do medicamento a ser consultado
                $nome_medicamento = $_POST['medicamento'];

                // Prepara a consulta SQL para selecionar o medicamento específico
                $sql = "SELECT * FROM medicamentos WHERE nome_medicamento = :nome_medicamento";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nome_medicamento', $nome_medicamento, PDO::PARAM_STR);
                $stmt->execute();

                // Verifica se há registros retornados
                if ($stmt->rowCount() > 0) {
                    // Exibe o medicamento em uma tabela
                    echo "<div class='table-container'>";
                    echo "<table>";
                    echo "<tr>
                            <th>Nome do Medicamento</th>
                            <th>Tipo do Medicamento</th>
                            <th>Preço</th>
                            <th>Fabricante</th>
                            <th>Data de Chegada</th>
                            <th>Categoria</th>
                            <th>Descrição</th>
                            <th>Data de Validade</th>
                            <th>Unidades</th>
                          </tr>";

                    // Itera sobre os resultados e exibe o medicamento
                    while ($medicamento = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                                <td>{$medicamento['nome_medicamento']}</td>
                                <td>{$medicamento['tipo']}</td>
                                <td>R$ " . number_format($medicamento['preco'], 2, ',', '.') . "</td>
                                <td>{$medicamento['fabricante']}</td>
                                <td>{$medicamento['data_chegada']}</td>
                                <td>{$medicamento['categoria']}</td>
                                <td>{$medicamento['descricao']}</td>
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
    </div[_{{{CITATION{{{_1{](https://github.com/pedroinbezerra/serapys/tree/c5cd76785f56f345b8d9d8e5835af4acb2ce0097/index.php)