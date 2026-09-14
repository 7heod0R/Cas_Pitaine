<?php
/**
 * Classe Database
 * Fournit une connexion PDO unique (singleton) à la base "dbBat".
 * Ajuste les constantes ci-dessous selon ton environnement XAMPP/WAMP.
 */
class Database
{
    private const HOST   = 'localhost';
    private const DBNAME = 'dbBat';
    private const USER   = 'root';
    private const PASS   = ''; // vide par défaut sous XAMPP/WAMP

    private static ?PDO $connexion = null;

    public static function getConnection(): PDO
    {
        if (self::$connexion === null) {
            $dsn = 'mysql:host=' . self::HOST . ';dbname=' . self::DBNAME . ';charset=utf8';
            try {
                self::$connexion = new PDO($dsn, self::USER, self::PASS);
                self::$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erreur de connexion à la base dbBat : ' . $e->getMessage());
            }
        }
        return self::$connexion;
    }
}
