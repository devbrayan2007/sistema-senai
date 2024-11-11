<?php
require_once 'connection.php';

// Inicie a sessão antes de qualquer saída
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['cod_func'])) {
    // Redireciona para a página de login, se não autenticado
    header("Location: login.php");
    exit();
}

// Código do painel para usuários autenticados
$cod = $_SESSION['cod_func'];
$conn = Conexao::getConn();

// Consulta o nome do usuário autenticado
$sql = $conn->prepare("SELECT nome FROM funcionarios WHERE cod_func = :cod_func");
$sql->bindParam(':cod_func', $cod, PDO::PARAM_INT);
$sql->execute();

$usuario = $sql->fetch(PDO::FETCH_ASSOC);
$nome_usuario = $usuario['nome'] ?? 'Usuário';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHAMARCY</title>
    <link rel="shortcut icon" href="/sistema-senai/images/logo-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilos */
        body {
            background-color: #2c2c2c;
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            height: 100vh;
            transition: background-color 0.3s;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #4CAF50;
            padding-top: 20px;
            position: fixed;
            height: 100%;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
            transition: width 0.3s;
            overflow: hidden;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: white;
            text-align: left;
            padding: 14px 20px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            margin: 5px 0;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #45a049;
            color: #fff;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        /* Submenu para Medicamentos */
        .submenu {
            display: none;
            background-color: #3e8e41;
            padding-left: 20px;
            border-radius: 5px;
        }

        .submenu a {
            font-weight: normal;
        }

        .main {
            margin-left: 250px;
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow-y: auto;
        }

        .greeting {
            width: 100%;
            text-align: right;
            color: #4CAF50;
            font-size: 14px;
            padding: 10px 20px;
            box-sizing: border-box;
            position: relative;
        }

        .user-menu {
            position: absolute;
            right: 0;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: none;
            z-index: 10;
        }

        .user-menu a {
            color: #333;
            padding: 10px 20px;
            display: block;
            text-decoration: none;
        }

        .user-menu a:hover {
            background-color: #f0f0f0;
        }

        h1 {
            color: #ffffff;
            text-align: center;
            margin: 20px 0;
            font-size: 2em;
        }

        footer {
            color: #4CAF50;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
            font-size: 0.9em;
        }

        .logo {
            width: 150px;
            max-width: 25%;
            margin-top: 30px;
            margin-bottom: 15px;
            animation: fadeIn 1.2s ease-in-out;
            filter: drop-shadow(2px 4px 6px rgba(0, 0, 0, 0.3));
        }
    </style>
    <script>
        function toggleSubmenu() {
            const submenu = document.getElementById('medicamentos-submenu');
            submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
        }

        function showAlert(message) {
            alert(message);
        }

        function toggleUserMenu() {
            const userMenu = document.getElementById('user-menu');
            userMenu.style.display = userMenu.style.display === 'block' ? 'none' : 'block';
        }

        window.onclick = function(event) {
            const userMenu = document.getElementById('user-menu');
            if (!event.target.matches('.greeting') && !event.target.matches('.greeting *')) {
                userMenu.style.display = 'none';
            }
        }

        function logout() {
            alert("Você saiu da conta!");
            window.location.href = "/sistema-senai/index.html";
        }

        function switchAccount() {
            alert("Entrando com outra conta...");
            window.location.href = "/sistema-senai/index.html";
        }
    </script>
</head>
<body>
    <div class="sidebar">
        <div>
            <a href="javascript:void(0);" onclick="toggleSubmenu()"><i class="fas fa-pills"></i> Medicamentos</a>
            <div id="medicamentos-submenu" class="submenu">
                <a href="/sistema-senai/consultar-produtos.php" onclick="showAlert('Consultando medicamentos!')"><i class="fas fa-search"></i> Consultar Medicamentos</a>
                <a href="/sistema-senai/cadastro-produtos.html" onclick="showAlert('Cadastrando medicamentos!')"><i class="fas fa-plus"></i> Cadastrar Medicamentos</a>
            </div>
        </div>
    </div>

    <div class="main">
        <div class="greeting" onclick="toggleUserMenu()">Bem-vindo, <?php echo htmlspecialchars($nome_usuario); ?>
            <div id="user-menu" class="user-menu">
                <a href="javascript:void(0);" onclick="switchAccount()">Entrar com outra conta</a>
                <a href="javascript:void(0);" onclick="logout()">Sair</a>
            </div>
        </div>
        <img src="/sistema-senai/images/logo-removebg-preview.png" alt="PHAMARCY LOGO" class="logo">
        <h1>BRASIL PHAMARCY</h1>
        <footer>
        <p>&copy; GRUPO DE DESENVOLVEDORES DE SISTEMA DO FIRJAN SENAI - DUQUE DE CAXIAS/RJ - 2024</p>
        </footer>
    </div>
</body>
</html>
