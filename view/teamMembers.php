<?PHP
	include(__DIR__ . '/../includes/header.php');
?>

<?PHP
	/* 
	   Murdoch University - ICT333 - F03 - ISCon - TSA14
	
	   Author: Tony
	   Date: 22 September 2014
	   Purpose: Getting information of team members and represent on a webpage
   */
   
	include(__DIR__ . '/../includes/connection.php');
	
	// execute query and store each as in the variable $row
	foreach($PDOConn->query('SELECT * from TeamMember') as $row) {
       
       // build a div to contain data. add margin-left
        echo '<div class="promo" style="margin-left: 50px">';
			echo '<h2>' . $row['FullName'] . '</h2>';
			echo '<a alt="team member" href="#">';
				echo '<span>';
					echo '<img height="111" border="0" width="228" title="" alt="" src="#" />';
				echo '</span>';
			echo '</a>';
			echo '<p> StudentNo: ' . $row['StudentNo'] . ' </p>';
			echo '<p> Email: ' . $row['Email'] . ' </p>';
			echo '<p> PhoneNo: ' . $row['PhoneNo'] . ' </p>';
		echo '</div>';

    }
    
    // close the connection
    $dbh = null;
		
?>

<?PHP
	include(__DIR__ . '/../includes/footer.php');
?>