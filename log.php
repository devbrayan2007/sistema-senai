<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHAMARCY</title>
    <link rel="shortcut icon" href="images/logo-removebg-preview.png" type="image/x-icon">
    <style>
        /* Estilos CSS do arquivo HTML original */
        body {
            background-color: rgb(5, 90, 47);
            font: normal 15pt Arial;
            color: black;
            background-image: url('papel-de-parede.jpg');
            background-size: cover;
            background-position: center 0.5px;
            background-attachment: fixed;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        h2 {
            margin-top: 150px;
            font-size: 2em;
        }

        p {
            font-size: 1em;
            margin-bottom: 20px;
            color: darkkhaki;
        }

        form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 20px;
            box-sizing: border-box;
            text-align: center;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            background-color: rgb(60, 60, 194);
            color: white;
            font: bold 12pt Arial;
            transition: background-color 0.3s, color 0.3s;
        }

        button:hover {
            background-color: rgb(30, 30, 150);
        }
        footer {
            margin-top: 20px;
            padding: 20px;
            text-align: center;
            color: white;
            font-size: 0.9em;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            h2 {
                margin-top: 100px;
                font-size: 1.8em;
            }

            form {
                width: 90%;
            }

            button {
                font-size: 1em;
            }
        }

        @media (max-width: 480px) {
            h2 {
                margin-top: 80px;
                font-size: 1.5em;
            }

            form {
                width: 95%;
                padding: 15px;
            }

            input[type="email"] {
                padding: 8px;
                font-size: 0.9em;
            }

            button {
                font-size: 0.9em;
                padding: 8px;
            }
        }

        a {
            color: white;
        }

        .logo {
            width: 150px; /* Tamanho padrão */
            max-width: 25%; /* Ajustável em telas pequenas */
            margin-top: 30px; /* Espaçamento acima do h1 */
            margin-bottom: 15px; /* Espaçamento abaixo */
            animation: fadeIn 1.2s ease-in-out;
            filter: drop-shadow(2px 4px 6px rgba(0, 0, 0, 0.3)); /* Sombra elegante */
        }

    </style>
</head>
<body>
    <img src="images/logo-removebg-preview.png" alt="PHAMARCY LOGO" class="logo">
    <h2>Esqueceu sua senha?</h2>
    <p>Não se preocupe! Nós te ajudamos! ;)</p>

    <!-- Exibe a mensagem de erro ou sucesso -->
    <?php if (isset($mensagem)) : ?>
        <p style="color: <?php echo ($mensagem == 'E-mail enviado com sucesso!' ? 'green' : 'red'); ?>;"><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <!-- Formulário de recuperação de senha -->
    <form action="" method="post">
        <label for="email">Informe seu email para redefinir sua senha:</label>
        <input type="email" name="email" id="email" placeholder="example@gmail.com" required>
        <button type="submit">Enviar código</button>
    </form>

    <footer>
        <p>SITE EM MANUTENÇÃO</p>
        <p>&copy; 2024 FIRJAN SENAI - DUQUE DE CAXIAS/RJ - Todos os direitos reservados.</p>
        <p>Criador do site: <a href="https://github.com/devbrayan2007">Brayan R Campos.</a></p>
    </footer>
</body>
</html>
