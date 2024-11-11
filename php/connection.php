<?php
class Conexao {
    private static $conn;

    public static function getConn() {
        if (self::$conn === null) {
            try {
                $host = 'localhost';
                $db = 'sistema_farmacia';
                $user = 'root';
                $pass = '';
                $charset = 'utf8mb4';

                $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];
                self::$conn = new PDO($dsn, $user, $pass, $options);
            } catch (PDOException $e) {
                echo 'Conexão falhou: ' . $e->getMessage();
                exit;
            }
        }
        return self::$conn;
    }
}
?>
