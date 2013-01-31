<?php
class mysql {
	private $host = 'localhost';
	private $user = '';
	private $pass = '';
	private $dbnm = '';
	
	function __construct() {
		$connect = @mysql_connect($this->host, $this->user, $this->pass);
		$select = @mysql_select_db($this->dbnm, $connect);
		@mysql_query("SET NAMES 'utf8'");
	}
	
	function query($query) {
		$result = mysql_query($query);
		if (!$result)
			exit('Could not run query: ' . mysql_error());
		return $result;
	}
	
	function single($query) {
		$result = $this->query($query);
		return @mysql_result($result, 0, 0);
	}
	
	function row($query) {
		$result = $this->query($query);
		return mysql_fetch_assoc($result);
	}
}
?>