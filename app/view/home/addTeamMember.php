<?PHP
$urlPrefix = $this->getURL();
    //$json = '{"name":"tony","studentNo":"123","email":"tieuhaphong@gmail.com","phoneNo":"1293123"}';
    //$json = 'name=tony&studentNo=123&email=tieuhaphong91@gmail.com&phoneNo=123123';

    //var_dump($json);
    //var_dump(json_decode($json, true));
    //$arr = json_decode($json, true);
    
    //echo $arr!=NULL;
    
//    foreach ($arr as $key => $value) {
//        echo $key;
//    }
    
    //echo '<br />';

//    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//            $arr = file_get_contents('php://input');
//            var_dump($_POST);
//        }
    include $headerLink;
?>
        <script>
//            (function($) {
//                $.fn.serializeFormJSON = function() {
//                    var json = {};
//                    var arr = this.serializeArray();
//                    $.each(arr, function() {
//                        if (json[this.name]) {
//                            if (!json[this.name].push) {
//                                json[this.name] = [json[this.name]];
//                            }
//
//                            json[this.name].push(this.value || '');
//
//                        } else {
//                            json[this.name] = this.value || '';
//                        }
//                    });
//                    return json;
//                };
//            })(jQuery);
//            
//            $(document).ready(function(){
//                $( "#addTeamMemberForm" ).submit(function( event ) {
//                    var $form = $(this);
//                    var jsonObject = $form.serializeFormJSON();
//                    
//                    //console.log(JSON.stringify(jsonObject));
//                    
//                    var jsonString = JSON.stringify(jsonObject);
//                    //var myVar = JSON.parse(formData);
//                    
//                    //console.log(jsonString);
//                    
//                    $.post(window.location.href, jsonString, function(output) {
//                        console.log(output);
//                    });
//                    
//                    event.preventDefault();
//                });
//                
//                
//            });
        </script>
    

    
        <?PHP 
            // $data from Controller class
            if ($data != NULL) {
                echo $data[result] . " record is created";
            } else {
        ?>
            <form id="addTeamMemberForm" action="<?PHP echo $urlPrefix; ?>/public/team/addTeamMember/form" method="post">
                Full Name: <input type="text" name="fullName" value="tony" ><br>
                Student No: <input type="text" name="studentNo" value="32334324"><br>
                Email: <input type="text" name="email" value="tieuhaphong@gmail.com"><br>
                Phone No: <input type="text" name="phoneNo" value="81090025"><br>
                <input type="submit" value="Submit" />
            </form>
        
        <?PHP } ?>
        
<?PHP include $footerLink; ?>