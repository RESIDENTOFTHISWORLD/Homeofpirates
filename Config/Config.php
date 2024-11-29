<?php

namespace Homeofpirates\Config;

class Config
{
    /**
     * @var string
     */
    public $domain = "localhost/Homeofpirates";
    public $protocol = "http://";
//todo change when put on server
    /**
     * @var null|string
     */
    public $projectPath = null;

    /**
     * @var string
     */
    public $db_host = "127.0.0.1";
//todo change when put on server

    /**
     * @var string
     */
    public $db_databasename = "pirates";

    /**
     * @var string
     */
    public $db_user = "root";

    /**
     * @var string
     */
    public $db_pass = "";

    /**
     * @var string
     */
    public $sessionLifeTime = 99999;//1800

    /**
     * der Konstruktor führt die setProjectPath methode aus
     * @return void
     */
    public function __construct()
    {
        $this->setProjectPath();
    }

    /**
     * Setzt den projektpath auf den aktuellen root Ordner
     * @return void
     */
    public function setProjectPath()
    {
        $this->projectPath = dirname(__FILE__) . '\..\\';
    }

    /**
     * Gibt den projektpath zurück
     * @return void
     */
    public function getProjectPath()
    {
        return $this->projectPath;
    }
}