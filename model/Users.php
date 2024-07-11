<?php

namespace homeOfPirates\Model;
use PDO;

class Users extends Base
{
    /**
     * @var string
     */
    public $tablename = "benutzer";


    public function loadByUsername($username = false, $additionalValues = false)
    {
        $success = false;

        $query = "SELECT * FROM " . $this->getTableName();
        if (!$username) {
            return null;
        } else {
            $query .= " WHERE username = :username";
            $query .= " LIMIT 1";
            $stmt = $this->dbc->prepare($query);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchObject();
        }

        if (is_object($result)) {
            $this->assign($result);
            $success = true;
        } else {
            echo "ERROR: Could not load " . $this->getTableName() . " with given username: " . $username . "!";
            return $success;
        }

        return $success;
    }
}