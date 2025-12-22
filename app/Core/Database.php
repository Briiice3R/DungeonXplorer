<?php

namespace App\Core;
use \PDO;
use \PDOException;



class Database{
    private static $instance = null;
    private $db;

    private function __construct()
    {
        $envFile = __DIR__ . '/../../.env';
        if (!file_exists($envFile)) {
            die("Le fichier .env n'existe pas.");
        }

        $env = parse_ini_file($envFile);

        // Récupération des variables d'environnement
        $dbHost = $env['DB_HOST'];
        $dbName = $env['DB_NAME'];
        $dbUser = $env['DB_USER'];
        $dbPassword = $env['DB_PASSWORD'];
        try {
            $this->db = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
            exit;
        }
    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance->db;
    }
}