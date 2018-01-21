<?php
class conn {
    private $mysql_conf = array(
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'dbname' => 'buaalib',
    );

	private $conn;
	private $result;
    public $sql;
    
	function __construct($sql) {
		$this->sql = $sql;
		$this->connect();
	}
	function connect() {
		$this->conn = new mysqli($this->mysql_conf['host'], $this->mysql_conf['username'], $this->mysql_conf['password'], $this->mysql_conf['dbname']);
        // mysqli_connect_errno()
        if ($this->conn->connect_error) {
			die("Could not connect to the database");
		}
	}

	function fetch_res() {
		$result = $this->conn->query($this->sql);
		while ($row = $result->fetch_assoc()) {
			$res_array[] = $row;
		}
		return $res_array;
	}
	function execute_sql() {
		$x = $this->conn->query($this->sql);
		return $x;
	}
	
    function execute_sql_with_params($params) {
		$stmt = $this->conn->prepare($this->sql);
		//$stmt->bind_param("d", $params[]);
        foreach($params as $key => $value)
        {
			switch(gettype($value))
			{
				case 'string':
					$stmt->bind_param("s", $value);
				case 'integer':
					$stmt->bind_param("i", $value);
				case 'double':
					$stmt->bind_param("d", $value);
				default:$stmt->bind_param("s", $value);
			}
            
		}
        $stmt->execute();
        $stmt->close();
    }

	function setsql($value) {
		$this->sql = $value;
	}
	function __destruct() {
		if (!empty($result)) {
			$result->free();
		}
		$this->conn->close();
    }
}
?>