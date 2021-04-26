<?php
class Db
{
    //connect 
    public $con;
    private $servername = "127.0.0.1" ?? "localhost";
    private $username = "root";
    private $passw = "";
    private $db = "test";
    public function __construct()
    {
        if ($this->con = new mysqli($this->servername, $this->username, $this->passw, $this->db)) {
        } else {
            return $this->con->connect_error;
        }
    }


    // get data
    public function get($need = null, $table = null, $id = null)
    {

        if ($need ===  "full") {
            $sq = "SELECT * FROM $table";

            $result = $this->con->query($sq);
            if ($result->num_rows > 0) {
                $row = $result->fetch_all(MYSQLI_ASSOC);
            }
        }

        if ($need === "one") {
            $sq = "SELECT * FROM $table WHERE $id ";
            $result = $this->con->query($sq);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            }
        }
        return $row;
    }

    // insert data
    public function insert($table = null, $data = null)
    {
        $key = array_keys($data);

        $value = array_values($data);

        $sq = " INSERT INTO $table ( " . implode(',', $key) . ") VALUES('" . implode("','", $value) . "')";

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
        $sq = "DELETE FROM $table WHERE id=$id";
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
        }

        $sq = "UPDATE  $table SET  " . $updateString . " WHERE id=$id";

        if ($this->con->query($sq) === TRUE) {
            return true;
            // echo 'pos';
        } else {
            return false;
            // echo 'neg';
        }
    }
}
