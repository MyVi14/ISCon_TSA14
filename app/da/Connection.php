<?PHP
/* 
   Murdoch University - ICT333 - F03 - ISCon - TSA14

   Author: MyVi14
   Date: 22 September 2014
   Purpose: Connect to a database
*/
class Connection {
    private $host = '127.0.0.1';
    private $user = 'root';
    private $pass = '';
    private $dbName = 'ISCON';
    private $PDOConn = NULL;
    
    public function getConnection() {
        if ($this->PDOConn == NULL) {
            $this->connectToDb();
        }
        
        return $this->PDOConn;
    }
    
    private function connectToDb() {
        try {
	    $this->PDOConn = new PDO('mysql:host='. $this->host .';dbname=' . $this->dbName, $this->user, $this->pass);
	    $this->PDOConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$dbh = mysqli_connect($host, $user, $pass, $dbName);
	    
	} catch (PDOException $e) {
	    print "Error!: " . $e->getMessage() . "<br/>";
	    $this->PDOConn = NULL;
	};
        
    }

} // end Connection class
	
	
	