<?php

namespace Homeofpirates\Class;

use Homeofpirates\Config\Config;
use PDO;

class Database
{
    /**
     * @var PDO
     */
    public $con = null;

    /**
     * benutzt Datenbank login daten, um eine verbindung zu erstellen
     *
     * @return void
     */
    public function __construct()
    {
        $config = new Config();
        $sDsn = "mysql:dbname=" . $config->db_databasename . ";host=" . $config->db_host . ";port=3306";

        $this->connect($sDsn, $config->db_user, $config->db_pass);
    }

    /**
     * führt die verbindung zur Datenbank durch und gibt diese als PDO Objekt zurück
     *
     * @param string $sDsn
     * @param string $sUser
     * @param string $sPassword
     *
     * @return PDO
     */
    protected function connect($sDsn, $sUser, $sPassword)
    {
        try {
            $dbc = new PDO($sDsn, $sUser, $sPassword);
            $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $sMessage = 'MySQL Verbindung fehlgeschlagen: ' . $e->getMessage();
            echo $sMessage;
            error_log($sMessage);
        }
        $this->con = $dbc;
    }


    private static $instance = null;

    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function setInstance($instance)
    {
        self::$instance = $instance;
    }
}
