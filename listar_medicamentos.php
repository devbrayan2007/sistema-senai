<?php
require_once 'php/connection.php';

$conn = Conexao::getConn();
$sql = "SELECT * FROM medicamentos";
$stmt = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Medicamentos - PHAMARCY</title>
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
            padding: 20px;
        }
        h2 {
            color: #fff;
            font-size: 2em;
            margin: 20px 0;
        }
        .table-container {
            width: 90%;
            max-width: 900px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 1em;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #d1e7dd;
        }
        a.edit-link {
            color: #4CAF50;
            font-weight: bold;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.2s;
            display: inline-block;
        }
        a.edit-link:hover {
            background-color: #45a049;
            color: #fff;
        }

        .logo { width: 150px; max-width: 25%; margin-top: 30px; margin-bottom: 15px; animation: fadeIn 1.2s ease-in-out; filter: drop-shadow(2px 4px 6px rgba(0, 0, 0, 0.3)); }
    </style>
</head>
<body>
<img src="images/logo-removebg-preview.png" alt="PHAMARCY LOGO" class="logo">
    <h2>Listagem de Medicamentos</h2>
    <div class="table-container">
        <table>
            <tr>
                <th>Código do Medicamento</th>
                <th>Nome do Medicamento</th>
                <th>Ação</th>
            </tr>
            <?php while ($medicamento = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($medicamento['cod_medicamento']); ?></td>
                    <td><?php echo htmlspecialchars($medicamento['nome_medicamento']); ?></td>
                    <td>
                        <a href="editar_medicamentos.php?cod_medicamento=<?php echo $medicamento['cod_medicamento']; ?>" class="edit-link">Editar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <footer>
    <p>&copy; GRUPO DE DESENVOLVEDORES DE SISTEMA DO FIRJAN SENAI - DUQUE DE CAXIAS/RJ - 2024</p>
    </footer>
</body>
</html>
