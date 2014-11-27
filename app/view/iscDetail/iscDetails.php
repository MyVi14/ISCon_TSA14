<!-- This page use an object called $ISCObj to set up data, if no such object is found, no data is printed -->
<div id="iscDetails" style="margin-left: 10px">
    <h1 class="bg-warning"> Section B - ISC Details </h1>
    
    <h3 style="display: inline;">1. Course </h3>
    <input type="text" size="50" name="courseName" value="<?PHP if(isset($ISCObj)) echo $ISCObj->getCourseName(); ?>" placeholder="course name"/>
    
    <hr />
    
    <h3>2. How will the contract be studied? </h3>
    <p><input type="radio" name="studyMode" value="internally" <?PHP if(isset($ISCObj) && (strtolower($ISCObj->getStudyMode()) == 'internally')) echo 'checked="checked"'; ?> /> Internally &nbsp;&nbsp;&nbsp;
        <input type="radio" name="studyMode" value="externally" <?PHP if(isset($ISCObj) && (strtolower($ISCObj->getStudyMode()) == 'externally')) echo 'checked="checked"'; ?> /> Externally</p>
    <p>Note: If the contract is to be studied externally, regular contact with your supervisor is still required.</p>
    
    <hr />
    
    <?PHP if(isset($ISCObj)) $supervisor = $ISCObj->getSupervisor(); ?>
    <h3> 3. Supervisor - must be a Murdoch University academic staff member </h3>
    <table name="supervisor" class="table">
      <tr>
        <th>Title</th>
        <th>Surname</th> 
        <th>Given Name</th> 
        <th>Position</th>
        <th>School</th>
        <th>Email</th>
      </tr>

      <tr>
          <td><input type="text" name="supervisorTitle" value="<?PHP if(isset($supervisor["title"])) echo $supervisor["title"] ?>" placeholder="title"/></td>
          <td><input type="text" name="supervisorSurname" value="<?PHP if(isset($supervisor["surname"])) echo $supervisor["surname"] ?>" placeholder="surname"/></td>
          <td><input type="text" name="supervisorGivenName" value="<?PHP if(isset($supervisor["givenName"])) echo $supervisor["givenName"] ?>" placeholder="given name"/></td> 
          <td><input type="text" name="supervisorPosition" value="<?PHP if(isset($supervisor["position"])) echo $supervisor["position"] ?>" placeholder="position"/></td>
          <td><input type="text" name="supervisorSchool" value="<?PHP if(isset($supervisor["school"])) echo $supervisor["school"] ?>" placeholder="school"/></td>
          <td><input type="email" name="supervisorEmail" value="<?PHP if(isset($supervisor["email"])) echo $supervisor["email"] ?>" placeholder="email address" pattern="^\w[-._\w]*\w@\w[-._\w]*\w\.\w{2,8}$" title="Email address" /></td>
      </tr>
    </table>
    
    <hr />
    
    <?PHP if(isset($ISCObj)) $associate = $ISCObj->getAssociateSupervisor(); ?>
    <h3> 4. Associate supervisor (if applicable) </h3>
    <p> If not a Murdoch staff member please attach confirmation of their availability. </p>

    <table name="associateSupervisor"  class="table">
      <tr>
        <th>Title</th>
        <th>Surname</th>
        <th>Given Name</th> 
        <th>Position</th>
        <th>School</th>
        <th>Email</th>
      </tr>

      <tr>
          <td><input type="text" name="associateTitle" value="<?PHP if(isset($associate["title"])) echo $associate["title"] ?>" placeholder="title" /></td>
          <td><input type="text" name="associateSurname" value="<?PHP if(isset($associate["surname"])) echo $associate["surname"] ?>" placeholder="surname"/></td> 
          <td><input type="text" name="associateGivenName" value="<?PHP if(isset($associate["givenName"])) echo $associate["givenName"] ?>" placeholder="given name" /></td> 
          <td><input type="text" name="associatePosition" value="<?PHP if(isset($associate["position"])) echo $associate["position"] ?>" placeholder="position"/></td>
          <td><input type="text" name="associateSchool" value="<?PHP if(isset($associate["school"])) echo $associate["school"] ?>" placeholder="school"/></td>
          <td><input type="text" name="associateEmail" value="<?PHP if(isset($associate["email"])) echo $associate["email"] ?>" placeholder="email address" pattern="^\w[-._\w]*\w@\w[-._\w]*\w\.\w{2,8}$" title="Email address"/></td>
      </tr>
    </table>
    
    <hr />
    
    <h3> 5. Study Period and Campus </h3>
    <label>Tick the boxes to indicate the teaching period in which you will undertake the ISC, and the appropriate campus.</label>

    <table class="table table-hover">
      <tr>
        <th>Teaching Period</th>
        <th>Contract Starts</th> 
        <th>Completion Date</th>
        <th>Select Teaching Period</th>

      </tr>
      <tr>
        <td>Semester 1</td>
        <td>Monday Week 1</td> 
        <td>First day of assessment period</td>
        <td><input type="radio" name="teachingPeriod" value="Semester1" <?PHP if(isset($ISCObj) && ($ISCObj->getTeachingPeriod() == 'Semester1')) echo 'checked="checked"'; ?> /></td>

      </tr>
      <tr>
        <td>Semester 2</td>
        <td>Monday Week 1</td> 
        <td>First day of assessment period</td>
        <td><input type="radio" name="teachingPeriod" value="Semester2" <?PHP if(isset($ISCObj) && ($ISCObj->getTeachingPeriod() == 'Semester2')) echo 'checked="checked"'; ?> /></td>
      </tr>

      <tr>
        <td>Full Year (Feb - Nov)</td>
        <td>Monday Week 1</td> 
        <td>First day of Semester 2 <p>assessment period</p></td>
        <td><input type="radio" name="teachingPeriod" value="FullYear (Feb - Nov)" <?PHP if(isset($ISCObj) && ($ISCObj->getTeachingPeriod() == 'FullYear (Feb - Nov)')) echo 'checked="checked"'; ?> ></td>
      </tr>

      <tr>
        <td>Winter</td>
        <td>First Monday after the end of Semester 1 </td> 
        <td>Monday before the start of Semester 2</td>
            <td><input type="radio" name="teachingPeriod" value="Winter" <?PHP if(isset($ISCObj) && ($ISCObj->getTeachingPeriod() == 'Winter')) echo 'checked="checked"'; ?> ></td>

      </tr>
      <tr>
        <td>Summer</td>
        <td>First Monday after the end of Semester 2 </td> 
        <td>Monday before the start of Semester 1 </td>
        <td><input type="radio" name="teachingPeriod" value="Summer" <?PHP if(isset($ISCObj) && ($ISCObj->getTeachingPeriod() == 'Summer')) echo 'checked="checked"'; ?> ></td>
      </tr>
      <tr>
        <td>Full Year H Option (July - June) </td>
        <td>Monday Week 1 of Semester 2 </td> 
        <td>First day of Semester 1 assessment period </td>
        <td><input type="radio" name="teachingPeriod" value="FullYear H Option (July - June)" <?PHP if(isset($ISCObj) && ($ISCObj->getTeachingPeriod() == 'FullYear H Option (July - June)')) echo 'checked="checked"'; ?> ></td>
      </tr>
    </table>
    
    <h3 style="display: inline;"> Select campus: </h3>
    
    <input type="radio" name="campusLocation" value="SouthSt" <?PHP if(isset($ISCObj) && ($ISCObj->getCampusLocation() == 'SouthSt')) echo 'checked="checked"'; ?> > SouthSt &nbsp;&nbsp;&nbsp;
    <input type="radio" name="campusLocation" value="Rockingham" <?PHP if(isset($ISCObj) && ($ISCObj->getCampusLocation() == 'Rockingham')) echo 'checked="checked"'; ?> > Rockingham &nbsp;&nbsp;&nbsp;
    <input type="radio" name="campusLocation" value="Peel" <?PHP if(isset($ISCObj) && ($ISCObj->getCampusLocation() == 'Peel')) echo 'checked="checked"'; ?> > Peel
        
    <p> Note:The ISC must be completed by the dates indicated above, unless deferred assessment is approved. </p>
    
    <hr />
    
    <h3> 6. Level of Contract </h3>
    <p>Part I students can only take contracts at the 100 level.  
        Part II students can take a 100 level contract, but the 30 points at Part I rule will still apply.</p>
    <label>If this is an Undergraduate ISC please indicate its level:</label>
    <input type="radio" name="contractLevel" value="100" <?PHP if(isset($ISCObj) && ($ISCObj->getContractLevel() == '100')) echo 'checked="checked"'; ?> />100 &nbsp;&nbsp;&nbsp;
    <input type="radio" name="contractLevel" value="200" <?PHP if(isset($ISCObj) && ($ISCObj->getContractLevel() == '200')) echo 'checked="checked"'; ?> />200 &nbsp;&nbsp;&nbsp;
    <input type="radio" name="contractLevel" value="300" <?PHP if(isset($ISCObj) && ($ISCObj->getContractLevel() == '300')) echo 'checked="checked"'; ?> />300 &nbsp;&nbsp;&nbsp;
    <input type="radio" name="contractLevel" value="400" <?PHP if(isset($ISCObj) && ($ISCObj->getContractLevel() == '400')) echo 'checked="checked"'; ?> />400 <br />

    <label>If this is a Postgraduate ISC please indicate its level:</label>
    <input type="radio" name="contractLevel" value="500" <?PHP if(isset($ISCObj) && ($ISCObj->getContractLevel() == '500')) echo 'checked="checked"'; ?> />500 &nbsp;&nbsp;&nbsp;
    <input type="radio" name="contractLevel" value="600" <?PHP if(isset($ISCObj) && ($ISCObj->getContractLevel() == '600')) echo 'checked="checked"'; ?> />600 &nbsp;&nbsp;&nbsp;
    <input type="radio" name="contractLevel" value="700" <?PHP if(isset($ISCObj) && ($ISCObj->getContractLevel() == '700')) echo 'checked="checked"'; ?> />700 &nbsp;&nbsp;&nbsp;
    <input type="radio" name="contractLevel" value="800" <?PHP if(isset($ISCObj) && ($ISCObj->getContractLevel() == '800')) echo 'checked="checked"'; ?> />800 <br />
    
    <hr />
    
    <h3> 7. Credit Point (maximum of 3 points per ISC) </h3>
    The credit point value of an ISC should reflect the workload involved, and the depth and extent of the learning objectives and content.  
    ISCs can have a value of 2 or 3 points. <br />
    
    <label>What is the credit point value of this ISC?
        <input type="text" size="2" maxlength="2" name="creditPoint" placeholder="0" value="<?PHP if(isset($ISCObj)) echo $ISCObj->getCreditPoint(); ?>"/>
     points
    </label> 
    
    <hr />
    
    <h3> 8. Contract Title </h3>
    <p>This title will appear on your academic transcript, so it cannot exceed 
    70 characters (including spaces between words).  
    It should be a specific topic (not a whole discipline) and be informative 
    so that anyone who sights your academic transcript will know both your topic and
    the discipline involved. Please leave out redundant words such as "A study of".</p>

    <textarea rows="4" cols="100" name="contractTitle" placeholder="contract title"><?PHP if(isset($ISCObj)) echo $ISCObj->getContractTitle(); ?></textarea>
    
    <hr />
    
    <h3> 9. Is this ISC a replacement for a Core or Specified Elective unit? </h3>

    <input type="radio" name="isAReplacement" value="yes" <?PHP if(isset($ISCObj) && (strtolower($ISCObj->getIsAReplacement()) == 'yes')) echo 'checked="checked"'; ?> /> Yes &nbsp;&nbsp;&nbsp;
    <input type="radio" name="isAReplacement" value="no" <?PHP if(isset($ISCObj) && (strtolower($ISCObj->getIsAReplacement()) == 'no')) echo 'checked="checked"'; ?> /> No <br /><br />
    <div id="replacement">
    <p>If YES, please provide the following information on the unit it will replace.</p>
    
    <?PHP if(isset($ISCObj)) $replacementUnit = $ISCObj->getReplacement(); ?>
    <table name="replacementUnit" class="table">
     <tr>
        <th>Unit Code</th>
        <th>Unit Title</th>
        <th>Core or Specified Elective unit</th>
      </tr>
      <tr>
          <td><input type="text" name="replacementUnitCode" value="<?PHP if(isset($replacementUnit["unitCode"])) echo $replacementUnit["unitCode"] ?>" /></td>
          <td><input type="text" name="replacementUnitTitle" value="<?PHP if(isset($replacementUnit["title"])) echo $replacementUnit["title"] ?>" /></td>
          <td><input type="text" name="replacementCoreOrElective" value="<?PHP if(isset($replacementUnit["coreOrElective"])) echo $replacementUnit["coreOrElective"] ?>" /></td>
      </tr>
    </table>
    
    <?PHP if(isset($ISCObj)) $academicChair = $ISCObj->getAcademicChair(); ?>
    <label>Note: Your Academic Chair will consider the variation of the course requirements for approval.</label><br>
    <table class="table">
    <tr>
        <th>Surname</th>
        <th>Given name</th>
        <th>Unit Code</th>
        <th>Email</th>
      </tr>

      <tr>
          <td><input type="text" name="academicChairSurname" value="<?PHP if(isset($academicChair["surname"])) echo $academicChair["surname"] ?>"></td>
          <td><input type="text" name="academicChairGivenName" value="<?PHP if(isset($academicChair["givenName"])) echo $academicChair["givenName"] ?>"></td>
          <td><input type="text" name="academicChairUnitCode" value="<?PHP if(isset($academicChair["unitCode"])) echo $academicChair["unitCode"] ?>"></td>
          <td><input type="email" name="academicChairEmail" value="<?PHP if(isset($academicChair["email"])) echo $academicChair["email"] ?>" placeholder="email address" pattern="^\w[-._\w]*\w@\w[-._\w]*\w\.\w{2,8}$" title="Email address"></td>
      </tr>
    </table>
    </div>
    <script>
        $(document).ready(function() {
            $("#replacement").hide();
            $('[name="isAReplacement"]').click(function(e){
                if ($(this).attr("value") == "yes") {
                    $("#replacement").show();
                } else
                    $("#replacement").hide();
            });
        });
    </script>
    
    <hr />
    
    <h3>10. Specific learning objectives </h3>
    <p>These are the knowledge, attitudes, skills or abilities you wish to develop during 
    this ISC. Give a clear concise statement, preferably in point form, of the objectives 
    or aims of the contract.  The objectives will depend on the purpose of the contract,
     what is to be learned, and whether or not the contract leads to more advanced studies.
     A contract, for example, may aim to examine a topic in depth, to acquire specific skills, 
     to survey an area, to pursue an aspect not covered by the curriculum or to place some other 
     topic in context.</p>

    <textarea rows="5" cols="100" name="learningObjectives"><?PHP if(isset($ISCObj)) echo $ISCObj->getLearningObjectives(); ?></textarea>
     
    <hr />
     
     <h3> 11. Project outline </h3>
    <p> Summarize the subject matter to be covered, and outline your proposal of how it will be covered.  
    This should be explained in sufficient detail to also indicate the depth and breadth of the contract.  
    A vague outline is not sufficient. Your outline must be clearly focused on particular topics.   
    Note: An ISC cannot duplicate a Murdoch unit, or use a unit from another institution.
    </p>

    <textarea rows="5" cols="100" name="projectOutline"><?PHP if(isset($ISCObj)) echo $ISCObj->getProjectOutline(); ?></textarea>
    
    <hr />
    
    <h3> 12. Indicate any previous study related to the Topic </h3>
    <textarea rows="2" cols="100" name="previousStudy"><?PHP if(isset($ISCObj)) echo $ISCObj->getPreviousStudy(); ?></textarea>
    
    <hr />
    
    <?PHP if(isset($ISCObj)) $expectedActivities = $ISCObj->getExpectedActivities(); ?>
    <h3> 13. Expected activities (please be as specific as possible) </h3>
    <p>If your ISC involves work with human subjects or animals, you should discuss any 
    potential ethical issues and how these are to be addressed with your supervisor. 
    If ethics approval has been obtained evidence of this must be attached.</p>
    <?PHP    
        echo '<input type="checkbox" name="expectedActivities[]" value="Library Research"';
        if(isset($expectedActivities)) {
            foreach($expectedActivities as $array)
                if ($array["name"] == "Library Research")
                    echo 'checked="checked"';
        }
        echo '/>Library Research';
        echo '&nbsp;&nbsp;&nbsp;';
        
        echo '<input type="checkbox" name="expectedActivities[]" value="Field Work"';
        if(isset($expectedActivities)) {
            foreach($expectedActivities as $array)
                if ($array["name"] == "Field Work")
                    echo 'checked="checked"';
        }
        echo '/>Field Work';
        echo '&nbsp;&nbsp;&nbsp;';
        
        echo '<input type="checkbox" name="expectedActivities[]" value="Laboratory Experiments"';
        if(isset($expectedActivities)) {
            foreach($expectedActivities as $array)
                if ($array["name"] == "Laboratory Experiments")
                    echo 'checked="checked"';
        }
        echo '/>Laboratory Experiments';
        echo '&nbsp;&nbsp;&nbsp;';
        
        echo '<input type="checkbox" name="expectedActivities[]" value="Interviews"';
        if(isset($expectedActivities)) {
            foreach($expectedActivities as $array)
                if ($array["name"] == "Interviews")
                    echo 'checked="checked"';
        }
        echo '/>Interviews';
        echo '&nbsp;&nbsp;&nbsp;';
        
        echo '<input type="checkbox" name="expectedActivities[]" value="Data Collections"';
        if(isset($expectedActivities)) {
            foreach($expectedActivities as $array)
                if ($array["name"] == "Data Collections")
                    echo 'checked="checked"';
        }
        echo '/>Data Collections';
        echo '&nbsp;&nbsp;&nbsp;';
        
        echo '<input type="checkbox" name="expectedActivities[]" value="Writing"';
        if(isset($expectedActivities)) {
            foreach($expectedActivities as $array)
                if ($array["name"] == "Writing")
                    echo 'checked="checked"';
        }
        echo '/> Writing';
        echo '&nbsp;&nbsp;&nbsp;';
    
    ?>
<!--    <input type="checkbox" name="expectedActivities[]" value="Library Research" checked="checked" />Library Research
    <input type="checkbox" name="expectedActivities[]" value="Field Work" checked="checked" />Field Work
    <input type="checkbox" name="expectedActivities[]" value="Laboratory Experiments" />Laboratory Experiments<br>
    <input type="checkbox" name="expectedActivities[]" value="Interviews" />Interviews
    <input type="checkbox" name="expectedActivities[]" value="Data Collections" /> Data Collections
    <input type="checkbox" name="expectedActivities[]" value="Writing" />Writing <br>-->
    <input type="checkbox" name="other" />Other <br>
    <div id="expectedActivitiesOther">
        <label>Please provide details below </label><br>
        <textarea rows="4" cols="100" name="expectedActivities[]" placeholder="Examples - surveys, radio, drama, theatre or video production, performance, work placement"></textarea>
    </div>
    <script>
        $(document).ready(function() {
            $("#expectedActivitiesOther").hide();
            
            $('[name="other"]').click(function(){
                $("#expectedActivitiesOther").toggle();
            });
        });
    </script>
    
    <hr />
    
    <?PHP  ?>
    <h3> 14. Provisional Reading List </h3>
    <table id="readingList" class="table">
        <tr>
           <th>Author</th>
           <th>Title</th>
           <th>Publication Date</th>
         </tr>
        <?PHP
        if(isset($ISCObj)) {
            foreach( $ISCObj->getReadingList() as $reading ) {
                echo '<tr>';
                    echo '<td><input type="text" name="readingListAuthor[]" value="'.$reading["author"].'"></td>';
                    echo '<td><input type="text" name="readingListTitle[]" value="'.$reading["title"].'"></td>';
                    echo '<td><input type="text" name="readingListPublicationDate[]" value="'.$reading["publicationDate"].'" placeholder="yyyy-mm-dd"></td>';
                echo '</tr>';
            }
        }
        ?>
        
    </table>
    <script>
        $(document).ready(function() {
            $('[name="addReadingList"]').click(function(e){
                readingRow = '<tr>';
                readingRow += '<td><input type="text" name="readingListAuthor[]" value=""></td>';
                readingRow += '<td><input type="text" name="readingListTitle[]" value=""></td>';
                readingRow += '<td><input type="date" name="readingListPublicationDate[]" value="" placeholder="yyyy-mm-dd"></td>';
                readingRow += '</tr>';        
                
                $("#readingList tr:last").after(readingRow);
                e.preventDefault();
            });
        });
    </script>
    <button name="addReadingList" >Click here to add more readings</button>
    
    <hr />
    
    <h3> 15. Methods and frequency of assessment </h3>
    <p> Each contract is expected to require approximately 1,500 words of written work per point 
        (i.e. 4,500 words for a 3 point ISC) though this may vary depending on the discipline, and other 
        types of assessment may be appropriate.  More than one piece of assessment is required, 
        e.g. a 1000 word preliminary and 3500 word final report.
    </p>
    <p> The assessment must reflect your specific learning objectives, be appropriate for the points 
        value of the contract, have more than one piece of work and specific due dates 
        ("last week of June" is not explicit enough).
    </p>
    <table id="assessmentComponentsTable" class="table">
     <tr>
        <th>Number</th>
        <th>Description</th>
        <th>Word Length</th>
        <th>Percentage</th>
        <th>Due Date</th>
      </tr>
      <?PHP 
        if(isset($ISCObj)) {
            $count = 0;
            foreach( $ISCObj->getAssessmentComponents() as $component ) {
                echo '<tr>';
                echo '<td><input type="text" name="number[]" value="'. ++$count .'"/></td>';
                echo '<td><input type="text" name="componentDescription[]" value="'.$component["description"].'"/></td>';
                echo '<td><input type="number" name="componentWordLength[]" min="0" value="'.$component["wordLength"].'"/></td>'; 
                echo '<td><input type="number" name="componentPercentage[]" min="0" value="'.$component["percentage"].'" /></td>';
                echo '<td><input type="date" name="componentDueDate[]" value="'.$component["dueDate"].'" placeholder="yyyy-mm-dd" /></td>';
                echo '</tr>';
            }
        }
      ?>
<!--      <tr>
        <td><input type="text" name="componentDescription[]" value="" /></td>
        <td><input type="text" name="componentWordLength[]" value="" /></td>
        <td><input type="text" name="componentPercentage[]" value="" /></td>
        <td><input type="text" name="componentDueDate[]" value="" /></td>
      </tr>-->
    </table>
    <script>
        $(document).ready(function() {
            $('[name="addAssessmentComponent"]').click(function(e){
                componentRow = '<tr>';
                componentRow += '<td><input type="number" name="number[]" value="" /></td>';
                componentRow += '<td><input type="text" name="componentDescription[]" value="" /></td>';
                componentRow += '<td><input type="number" name="componentWordLength[]" min="0" value="" /></td>';
                componentRow += '<td><input type="number" name="componentPercentage[]" min="0" value="" /></td>';
                componentRow += '<td><input type="date" name="componentDueDate[]" value="" placeholder="yyyy-mm-dd" /></td>';
                componentRow += '</tr>';        
                
                $("#assessmentComponentsTable tr:last").after(componentRow);
                e.preventDefault();
            });
        });
        
        
    </script>
    <button name="addAssessmentComponent" >Click here to add more assessment components</button>
    
    <hr />
    
    <h3> 16. Previous Experience, if any, of Independent Study </h3>
    <p>If this includes previous ISCs, please list the title, credit point value, supervisor and 
        final grade of each contract.</p>

    <textarea rows="4" cols="100" name="previousExperience"><?PHP if(isset($ISCObj)) echo $ISCObj->getPreviousExperience(); ?></textarea>
    
    <hr />
    
    <h3> 17. School Dean Information </h3>
    <p> Note: School Dean will be the one who gives final decision</p>
    
    <?PHP if(isset($ISCObj)) $schoolDean = $ISCObj->getSchoolDean(); ?>
    <table name="schoolDeanInformation" class="table">
    <tr>
        <th>Surname</th>
        <th>Given name</th>
        <th>School</th>
        <th>Email</th>
      </tr>
      <tr>
          <td><input type="text" name="schoolDeanSurname" value="<?PHP if(isset($schoolDean["surname"])) echo $schoolDean["surname"] ?>"></td>
          <td><input type="text" name="schoolDeanGivenName" value="<?PHP if(isset($schoolDean["givenName"])) echo $schoolDean["givenName"] ?>"></td>
          <td><input type="text" name="schoolDeanSchool" value="<?PHP if(isset($schoolDean["school"])) echo $schoolDean["school"] ?>"></td>
          <td><input type="email" name="schoolDeanEmail" value="<?PHP if(isset($schoolDean["email"])) echo $schoolDean["email"] ?>" 
                     pattern="^\w[-._\w]*\w@\w[-._\w]*\w\.\w{2,8}$" title="Email address" ></td>
      </tr>
    </table>
</div>
