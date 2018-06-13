<?

class Database2 {
	private $connection;

	public function Database2() {
		$this->connection = new mysqli('localhost', $user='casalind_api', $pass='Diaz1242', $db='casalind_api');
		/* check connection */
		if (mysqli_connect_errno()) {
			Logger::logEvent(Logger::LOG_ERROR, basename(__FILE__), __LINE__, "Database Connect failed: ".mysqli_connect_error());
			exit(-1);
		}
	}



	// Escape a field
	public function myesc($string) {
		$string_clean=trim($string);
		return $this->connection->real_escape_string($string_clean);
	}

	// Executes a Result Query and returns an associative array of the resultant recordset
	public function query($sql) {
//echo $sql."\n";
		if ($result = $this->connection->query($sql)) {
			$recordset = array();
			while ($row = $result->fetch_assoc()) {
				array_push($recordset, $row);
			}
			// Free the result set
			$result->close();
			// Return the recordset
			return $recordset;
		} else {
//echo "\n\n!!! ";
			Logger::logEvent(Logger::LOG_ERROR, basename(__FILE__), __LINE__, "Query failed: ".$this->connection->errno.":".$this->connection->error);
			return false;
		}
	}

	// Executes a Command Query
	public function execute($sql) {
		if ($this->connection->query($sql)) {
			return true;
		} else {
			Logger::logEvent(Logger::LOG_ERROR, basename(__FILE__), __LINE__, "Query failed: ".$this->connection->errno.":".$this->connection->error);
			return false;
		}
	}

	// Gets the last insertion Id
	public function getInsertId() {
	//Note: Because mysql_insert_id() acts on the last performed query, be sure to call mysql_insert_id() immediately after the query that generates the value.
	//Note: The value of the MySQL SQL function LAST_INSERT_ID() always contains the most recently generated AUTO_INCREMENT value, and is not reset between queries.
	return $this->connection->insert_id;
	}

	// Gets the number of rows affected by the last query
	public function getAffectedRows() {
		return $this->connection->affected_rows;
	}

	function __destruct(){
		//return $this->connection->close();
		$this->connection->close();
	}
}

?>