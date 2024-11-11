<?php
require_once 'php/connection.php';

if (isset($_GET['cod_medicamento'])) {
    $cod_medicamento = $_GET['cod_medicamento'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sucesso - Edição</title>
    <style>
        /* Mesmo estilo da página de edição */
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
        .success-container {
            width: 90%;
            max-width: 1050px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
        }
        .back-button {
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 5px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s;
            margin-top: 15px;
            margin-left: 15px;
            align-self: flex-start;
        }
        .back-button:hover { background-color: #45a049; box-shadow: 0 5px 8px rgba(0, 0, 0, 0.3); }

        .logo { width: 150px; max-width: 25%; margin-top: 30px; margin-bottom: 15px; animation: fadeIn 1.2s ease-in-out; filter: drop-shadow(2px 4px 6px rgba(0, 0, 0, 0.3)); }

    </style>
</head>
<body>
<img src="images/logo-removebg-preview.png" alt="PHAMARCY LOGO" class="logo">
    <h2>Medicamento editado com sucesso!</h2>
    <a href="listar_medicamentos.php">Voltar à Listagem de Medicamentos</a>
    <footer>
    <p>&copy; GRUPO DE DESENVOLVEDORES DE SISTEMA DO FIRJAN SENAI - DUQUE DE CAXIAS/RJ - 2024</p>
    </footer>
</body>
</html>
