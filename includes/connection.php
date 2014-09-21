<?PHP
	/* 
	   Murdoch University - ICT333 - F03 - ISCon - TSA14
	
	   Author: Tony
	   Date: 22 September 2014
	   Purpose: Connect to a database
	   Return: a connection if connected, null otherwise
   */

	$host = '127.0.0.1';
	$user = 'root';
	$pass = '';
	$dbName = 'ISCON';
	
	try {
	    $PDOConn = new PDO('mysql:host='. $host .';dbname=' . $dbName, $user, $pass);
	    
	    //$dbh = mysqli_connect($host, $user, $pass, $dbName);
	    
	} catch (PDOException $e) {
	    print "Error!: " . $e->getMessage() . "<br/>";
	    die();
	};
?>