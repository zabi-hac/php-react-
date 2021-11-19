<?php
class Db
{
    //connect 
    public $con;
    private $servername = "localhost" ?? "127.0.0.1";

    // private $username = "u941408052_db_user";
    // private $passw = "u3&LV2#z";
    // private $db = "u941408052_gthub";


    private $username = "root";
    private $passw = "";
    private $db = "zonifo";

    public function __construct()
    {
        $this->con = new mysqli($this->servername, $this->username, $this->passw, $this->db);
        if ($this->con->connect_error) {
            die("Connection failed: " . $this->con->connect_error);
        }
    }


    // get data
    public function get($need = null, $table = null, $id = null)
    {

        if ($need ===  "full") {
            $sq = "SELECT * FROM `$table`";

            $result = $this->con->query($sq);
            if ($result->num_rows > 0) {
                $row = $result->fetch_all(MYSQLI_ASSOC);
            }
        }

        if ($need === "one") {
            $sq = "SELECT * FROM `$table` WHERE `id` =  $id ";
            $result = $this->con->query($sq);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            }
        }
        return isset($row) ? $row : [];
    }
    // get exact
    public function get_exact($table = null, $exact, $value, $column = null)
    {
        if (!$column) {
            $sq = "SELECT * FROM `$table` WHERE `$exact` =  '$value' ";
        } else {
            $sq = "SELECT $column FROM `$table` WHERE `$exact` =  '$value' ";
        }
        $result = $this->con->query($sq);
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
        }
        return isset($row) ? $row : 'no data';
    }

    // insert data
    public function insert($table = null, $data = null)
    {
        $key = array_keys($data);

        $value = array_values($data);

        $sq = " INSERT INTO `$table` ( " . implode(',', $key) . ") VALUES('" . implode("','", $value) . "')";

        if ($this->con->query($sq) === TRUE) {
            return true;
        } else {
            return false;
            // var_dump(implode(',' , $key));
            // var_dump(implode(',' , $value));
        }
    }

    // delete data

    public function delete($table = null, $id = null)
    {
        $sq = "DELETE FROM `$table` WHERE id=$id";
        if ($this->con->query($sq) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // update 

    public function update($table = null, $data = null, $id = null)
    {
        $c = 1;
        $updateString = '';
        foreach ($data as $key => $value) {
            if ($c != sizeof($data)) {
                $updateString .=  $key . ' = ' . '"' . $value . '"' . ',';
            } else {
                $updateString .=  $key . ' = ' . '"' . $value . '"';
            }
            $c++;
        }
        //UPDATE `list` SET `name` = 'boboo' WHERE `list`.`id` = 138;
        $sq = "UPDATE  `$table` SET  " . $updateString . " WHERE id= $id  ";
        if ($this->con->query($sq) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    //get column 
    public function get_column($table, $col_name, $dup = false)
    {
        if ($dup) {
            $sq = "SELECT DISTINCT $col_name FROM `$table` ";
        } else {
            $sq = "SELECT  $col_name FROM `$table` ";
        }
        $result = $this->con->query($sq);
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
            print_r($row);
            return $row;
        }
        return false;
    }
    //search any 
    public function get_search($table, $search_value, $col_name, $entire_row = true)
    {
        $sq = "SELECT * FROM `$table` WHERE `$col_name` LIKE '" . $search_value . "%'  ";
        $result = $this->con->query($sq);
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
            if ($entire_row === true) {
                return $row;
            }
            return $row[$col_name];
        }
        return false;
    }

    //search ex 
    public function get_search_ex($table, $search_value, $col_name)
    {
        //SELECT DISTINCT district FROM zones WHERE district LIKE 'c%'
        $sq = "SELECT  DISTINCT   $col_name FROM `$table` WHERE $col_name LIKE '" . $search_value . "%'  ";
        $result = $this->con->query($sq);
        return $result->fetch_row();
    }

    //auth 
    public function authenticator($table, $name, $passw)
    {

        $sq = "SELECT * FROM `$table` WHERE name = '$name' and password = $passw  ";

        $result = $this->con->query($sq);
        if (!is_object($result)) {
            return false;
        } else {
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function CountAll($table)
    {
        $count = 0;
        $sq = "SELECT COUNT(*) FROM `$table`";
        $result = mysqli_fetch_array($this->con->query($sq));
        return $result[0];
    }

    // where complete 
    public function get_wheres($table, $data, $cols = null, $dup = false, string $and_or = null)
    {
        $c = 0;
        $ex_anor = explode(',', $and_or);
        $wheres = '';
        if (!$and_or) :
            foreach ($data as $key => $value) :
                if ($c + 1 != sizeof($data)) :
                    $wheres .=  $key . ' = ' . '"' . $value . '"' . ' AND ';
                else :
                    $wheres .=  $key . ' = ' . '"' . $value . '"';
                endif;
                $c++;
            endforeach;
        elseif ($and_or) :
            foreach ($data as $key => $value) :
                if ($c + 1 != sizeof($data)) :
                    $wheres .=  $key . ' = ' . '"' . $value . '"' . ' ' . $ex_anor[$c] . ' ';
                else :
                    $wheres .=  $key . ' = ' . '"' . $value . '"';
                endif;

                $c++;
            endforeach;
        endif;

        if (!$cols) {
            if ($dup) :
                $sq = "SELECT DISTINCT * FROM `$table` WHERE  " . $wheres;
            else :
                $sq = "SELECT * FROM `$table` WHERE  " . $wheres;
            endif;
        } else {
            if ($dup) :
                $sq = "SELECT DISTINCT $cols FROM `$table` WHERE  " . $wheres;
            else :
                $sq = "SELECT $cols FROM `$table` WHERE  " . $wheres;
            endif;
        }
        $result = $this->con->query($sq);
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
        }
        // echo $sq;
        return isset($row) ? $row : 'no data';
    }

    // or where

    function get_or_where($table, $data, $cols = null)
    {
        $c = 0;

        $wheres = '';

        foreach ($data as $key => $value) :
            if ($c + 1 != sizeof($data)) :
                $wheres .=  $key . ' = ' . '"' . $value . '"' . ' OR ';
            else :
                $wheres .=  $key . ' = ' . '"' . $value . '"';
            endif;
            $c++;
        endforeach;

        if (!$cols) {
            $sq = "SELECT * FROM `$table` WHERE  " . $wheres;
        } else {
            $sq = "SELECT $cols FROM `$table` WHERE  " . $wheres;
        }
        $result = $this->con->query($sq);
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
        }
        //  echo $sq;
        return isset($row) ? $row : 'no data';
    }

    //and where
    function get_and_where($table, $data, $cols = null)
    {
        $c = 0;

        $wheres = '';

        foreach ($data as $key => $value) :
            if ($c + 1 != sizeof($data)) :
                $wheres .=  $key . ' = ' . '"' . $value . '"' . ' AND ';
            else :
                $wheres .=  $key . ' = ' . '"' . $value . '"';
            endif;
            $c++;
        endforeach;

        if (!$cols) {
            $sq = "SELECT * FROM `$table` WHERE  " . $wheres;
        } else {
            $sq = "SELECT $cols FROM `$table` WHERE  " . $wheres;
        }
        $result = $this->con->query($sq);
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
        }
        // echo $sq;
        return isset($row) ? $row : 'no data';
    }

    // master from string

    function get_flex($table, string $where, string $cols = null)
    {
        if (!$cols) {
            $sq = "SELECT * FROM `$table` WHERE  " . $where;
        } else {
            $sq = "SELECT $cols FROM `$table` WHERE  " . $where;
        }
        $result = $this->con->query($sq);
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
        }
        //  echo $sq;
        return isset($row) ? $row : 'no data';
    }
    // flexy
    // SELECT SUM(curr_cases) AS cases FROM `zones` WHERE `district` = 'calicut'
    function sum(string $col, string $as, string $table, $where)
    {
        $sq = "SELECT SUM($col) AS $as FROM `$table` WHERE $where ";
        $result = mysqli_fetch_array($this->con->query($sq));
        // echo $sq;
        return isset($result[0]) ? $result[0] : null;
    }
    function sum_where(string $col, string $as, string $table, $where)
    {
        $c = 0;

        $wheres = '';

        foreach ($where as $key => $value) :
            if ($c + 1 != sizeof($where)) :
                $wheres .=  $key . ' = ' . '"' . $value . '"' . ' AND ';
            else :
                $wheres .=  $key . ' = ' . '"' . $value . '"';
            endif;
            $c++;
        endforeach;

        $sq = "SELECT SUM($col) AS $as FROM `$table` WHERE $wheres ";
        $result = mysqli_fetch_array($this->con->query($sq));
        // echo $sq;
        return isset($result[0]) ? $result[0] : null;
    }
}
