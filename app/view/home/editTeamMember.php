<?PHP
    include($headerLink);
?>


    <script>
        $(document).ready(function(){
            $('[name="edit"]').click(function(){
                var url = $("#editTeamMemberForm").attr("action");
                url += $(this).attr("data-memberid");

                // set new action attribute
                $("#editTeamMemberForm").attr("action", url);
                //alert($("#editTeamMemberForm").attr("action"));
                //$("#memberListForm").submit();
            });
        });
    </script>
    
        
    <form id="editTeamMemberForm" action="<?PHP echo $urlPrefix; ?>/public/team/saveTeamMember/" method="POST">
        Full Name: <input type="text" name="fullName" value="<?php echo $data->getFullName();?>" /> <br/>
        Student No: <input type="text" name="studentNo" value="<?php echo $data->getStudentNo();?>" /><br />
        Email: <input type="text" name="email" value="<?php echo $data->getEmail(); ?>" /><br />
        Phone No: <input type="text" name="phoneNo" value="<?php echo $data->getPhoneNo(); ?>" /><br />
        
        <button name="edit" data-memberid="<?php echo $data->getMemberID();?>" > Submit </button>
    </form>
        
        
<?PHP
    include($footerLink);
?>
