<?PHP
    include($headerLink);
?>

        <script>
            $(document).ready(function(){
                $('[name="editTeamMember"]').click(function(e){         
                    var url = $("#memberListForm").attr("action");
                    url += $(this).attr("data-memberid");

                    // set new action attribute
                    $("#memberListForm").attr("action", url);

                    //$("#memberListForm").submit();
                    
                        
                });
                
                $('[name="deleteTeamMember"]').click(function(e){
                    //e.preventDefault();

                    // set new action attribute
                    $("#memberListForm").attr("action", "deleteTeamMember/" + $(this).attr("data-memberid"));
                    //console.log($("#memberListForm").attr("action"));
                    //$("#memberListForm").submit();
                    
                });
            });
        </script>
    </head>
    <body>

<form method="POST" action="<?PHP echo $urlPrefix; ?>public/team/getTeamMember/" id="memberListForm">

<?PHP
	/* 
	   Murdoch University - ICT333 - F03 - ISCon - TSA14
	
	   Author: Tony
	   Date: 22 September 2014
	   Purpose: Getting information of team members and represent on a webpage
   */

        // $data array from Home controller
	foreach ($data as $row) {
//          build a div to contain data. add margin-left
            echo '<div class="promo" style="margin-left: 50px">';
                echo '<h2>' . $row->getFullName() . '</h2>';
                echo '<a alt="team member" href="#">';
                        echo '<span>';
                                echo '<img height="111" border="0" width="228" title="" alt="" src="#" />';
                        echo '</span>';
                echo '</a>';
                echo '<p> StudentNo: ' . $row->getStudentNo() . ' </p>';
                echo '<p> Email: ' . $row->getEmail() . ' </p>';
                echo '<p> PhoneNo: ' . $row->getPhoneNo() . ' </p>';
                echo '<button name="editTeamMember" data-memberid="'.$row->getMemberID().'">Click here to edit</button>';
                echo '<button name="deleteTeamMember" data-memberid="'.$row->getMemberID().'">Click here to delete</button>';
            echo '</div>';
        }	
?>

    <p> <button><a href="addTeamMember"> Click here to add new team member </a> </button> </p>

</form>
        
<?PHP
    include($footerLink);
?>