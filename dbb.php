<?php
define('DB_SERVER','kf3k4aywsrp0d2is.cbetxkdyhwsb.us-east-1.rds.amazonaws.com');
define('DB_USERNAME','gux5fvna6rg9ojtw');
define('DB_PASSWORD','ilbs5whcyuonzg09');
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
