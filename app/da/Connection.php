<?PHP
/* 
   Murdoch University - ICT333 - F03 - ISCon - TSA14

   Author: MyVi14
   Date: 22 September 2014
   Purpose: Connect to a database
*/
class Connection {
//    private $host = '127.0.0.1';
//    private $user = 'root';
//    private $pass = '';
//    private $dbName = 'ISCON';
//    private $PDOConn = NULL;
    
    public static function getConnection() {
        try {
	    $PDOConn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PASS);
	    $PDOConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$dbh = mysqli_connect($host, $user, $pass, $dbName);
	    
	} catch (PDOException $e) {
	    print "Error!: " . $e->getMessage() . "<br/>";
	    $PDOConn = NULL;
	}

        return $PDOConn;
    }

} // end Connection class
	
	
	