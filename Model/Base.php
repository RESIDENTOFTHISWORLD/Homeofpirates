<?php

namespace Homeofpirates\Model;

use PDO;
use Homeofpirates\Class\Database;
class Base extends \stdClass {
    public $tablename = false;

    public $dbc = false;

    public function __construct()
    {
        $db =  Database::getInstance();
        $this->dbc = $db->con;
    }

    public function getTableName()
    {
        return $this->tablename;
    }

    public function loadList($sAdditionalWhere = false, $orderBy = false, $additionalValues = false, $limit = 0, $offset = false)
    {
        $rows = array();
        $query = "SELECT * FROM " . $this->getTableName();
        if ($sAdditionalWhere != false) {
            $query .= " WHERE " . $sAdditionalWhere;
        }
        if ($orderBy != false) {
            $query .= " ORDER BY " . $orderBy;
        }
        if ($limit != 0 && $limit != "false") {
            $query .= " LIMIT " . $limit;
        }
        if ($offset != false && $offset != "false" && $offset != 0) {
            $iLimit = (int)$limit;
            $iOffset = (int)$offset;
            if ($limit != 0 && $limit != "false") {
                 $iOffset;
            }else{
                $iOffset = 0;
            }
            $query .= " OFFSET " . $iOffset;
        }
        error_log($query);
        $stmt = $this->dbc->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetchObject()) {
            $dataset = new $this;
            $dataset->loadByID($row->id, $additionalValues);
            $rows[] = $dataset;
        }
        return $rows;
    }

    public function loadById($id = false, $additionalValues = false)
    {
        $success = false;

        $query = "SELECT * FROM " . $this->getTableName();
        if (!$id) {
            return null;
        } else {
            $query .= " WHERE id = :id";
            $query .= " LIMIT 1";
            $stmt = $this->dbc->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchObject();
        }

        if (is_object($result)) {
            $this->assign($result);
            $success = true;
        } else {
            echo "ERROR: Could not load " . $this->getTableName() . " with given id: " . $id . "!";
            exit;
        }

        return $success;
    }

    public function save()
    {
        if (isset($this->id) && $this->id) {
            if($this->update()){
                return true;
            }
        } else {
            if($this->insert()){
                return true;
            }
        }
        return false;
    }

    /**
     * Insert new row
     *
     * @return
     */
    protected function insert()
    {
        $param = array();
        $first = true;
        $keys = "";
        $sValues = "";
        foreach ($this as $key => $value) {
            if ($key != "tablename" && $key != "dbc") {
                if ($first) {
                    $first = false;
                } else {
                    $keys .= ", ";
                    $sValues .= ", ";
                }
                $keys .= $key;
                $sValues .= ":" . $key;
                $param[$key] = $value;
            }
        }
        $query = "INSERT INTO " . $this->getTableName() . " (" . $keys . ") VALUES (" . $sValues . ")";
//        error_log($query);
        $stmt = $this->dbc->prepare($query);
        if($stmt->execute($param)){
          $this->id = $this->dbc->lastInsertId();

          return true;
        }
        return false;
    }

    /**
     * Update a row
     *
     * @return bool
     */
    protected function update()
    {
        $param = array();
        $query = "UPDATE " . $this->getTableName() . " SET";
        $first = true;
        foreach ($this as $property => $value) {
            if ($property != "tablename" && $property != "dbc") {
                if ($first) {
                    $first = false;
                    $query .= " $property=:$property";
                } else {
                    $query .= ", $property=:$property";
                }
                $param[":$property"] = $value;
            }
        }
        $query .= " WHERE id = :id";
        $param[":id"] = $this->id;


        $stmt = $this->dbc->prepare($query);
        if($stmt->execute($param)){
            return true;
        }
        return false;
    }

    /**
     * Delete a row for a ID
     *
     * @param $id int
     *
     * @return void
     */
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->getTableName() . " WHERE id = :id";
        $stmt = $this->dbc->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @param $arrayOrObject
     * @return void
     */
    public function assign($arrayOrObject)
    {
        if (is_array($arrayOrObject) || is_object($arrayOrObject)) {
            foreach ($arrayOrObject as $key => $value) {
                $this->{$key} = $value;
            }
        }
    }
}