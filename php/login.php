<?php
session_start();
require_once 'connection.php';

class Login {
    private $nome;
    private $email;
    private $senha;

    public function inserirDados($nome, $email, $senha) {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }   

    public function setNome($n) {
        $this->nome = $n;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setEmail($e) {
        $this->email = $e;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setSenha($s) {
        $this->senha = $s;
    }

    public function getSenha() {
        return $this->senha;
    }
}

class Autenticar extends Login {
    public function Entrar(Login $l) {
        $pdo = Conexao::getConn(); // Usa o método getConn() da classe Conexao diretamente

        $stmt = $pdo->prepare("SELECT cod_func, nome, email, senha FROM funcionarios WHERE email = :email");
        $stmt->bindParam(':email', $l->getEmail(), PDO::PARAM_STR);

        try {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && password_verify($l->getSenha(), $result['senha'])) {
                $_SESSION['cod_func'] = $result['cod_func'];
                header('Location: painel.php');
                exit();
            } else {
                echo "<h4>Email ou senha incorreta!</h4>";
            }
        } catch (PDOException $e) {
            echo "Erro de banco de dados: " . $e->getMessage();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = new Login();
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $senha = isset($_POST['senha']) ? trim($_POST['senha']) : null;

    $login->setEmail($email);
    $login->setSenha($senha);

    $aut = new Autenticar();
    $aut->Entrar($login);
} else {
    echo "<h4>Método de requisição inválido!</h4>";
}
