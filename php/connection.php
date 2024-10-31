<?php

class Conexao {
    private static $instancia;

    public static function getConn() {
        if (!isset(self::$instancia)) {
            self::$instancia = new PDO('mysql:host=localhost; dbname=sistema_farmacia', 'root', '23012007');
        }
        return self::$instancia;
    }
}