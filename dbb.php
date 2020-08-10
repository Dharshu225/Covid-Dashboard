<?php
define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','covid');

class dbb
{
    public $db;

    public function __construct()
    {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    }

    public function Select($table, $columns,$where=null) {
        $sql = "SELECT ".$columns;
        $sql.=" FROM ".$table;
        if($where!=null) {
            $sql.=" WHERE ".$where;
        }
        $result = $this->db->query($sql);
        if($result)
        {
            while($output = $result->fetch_assoc())
            {
                $array[] = $output;
            }
        }
        if(!empty($array))
        {
            return $array;
        }
        else
        {
            return false;
        }
    }

    public function Insert($table, $columns, $values)
    {
        $sql = "INSERT INTO ".$table;
        $sql .="(".$columns.")";
        $sql .=" VALUES (".$values.")";
        $result = $this->db->query($sql);
        $this->db->close();
        if($result)
        {
         return $result;
        }
        else
        {
         return false;
        }
    }

    public function Update($table,$columns,$where)
    {
        $sql = "UPDATE ".$table;
        $sql .=" SET ".$columns;
        $sql .=" WHERE ".$where;
        $result = $this->db->query($sql);
        if($result)
        {
         return $result;
        }
        else
        {
         return false;
     }
    }

    public function Delete($table,$where)
    {
        $sqlQuery = "DELETE FROM ".$table;
        $sqlQuery.=" WHERE ".$where;
        $result = $this->db->query($sqlQuery);
        $result = $this->db->query($sqlQuery);
        if($result)
        {
         return $result;
        }
        else
        {
         return false;
        }
        $this->db->close();
    }
    
}

?>