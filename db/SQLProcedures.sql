/* Create a new database or schema */

USE ISCON;
-- select * from ISC_supervisor_answer;
-- select * from isc;
-- set @varNew = -1;
-- call CreateNewISC ('undergraudate', 'new', 'tony', 'tieu ha phong', '234', 'tieuhaphong91@gmail.com', '234234', 'no', 'no', @varNew);
-- # Create procedure for inserting new ISC
Delimiter //

CREATE PROCEDURE CreateNewISC (
								IN newApplicationType	varchar(20),
								IN newApplicationStatus	varchar(50),
								IN newSurname			varchar(30),
								IN newGivenName 		varchar(30),
								IN newStudentNo			char(10),
								IN newEmail				varchar(50),
								IN newPhoneNo			char(15),
								IN newConfirmMaximumISC	varchar(10),
								IN newEnrollInPHD		varchar(10),
								OUT ISCID 				int
							)
BEGIN
	Declare varNewID int;
	Declare varItemID varchar(10);
	Declare done	Int 	default 0;
	Declare ISCSupervisorCursor	cursor for
				select ItemID
				from ISC_SUPERVISOR;
	Declare continue 	HANDLER FOR NOT FOUND SET done = 1;
	
	INSERT INTO `ISCON`.`ISC` (`ApplicationType`, `ApplicationStatus`, `CreatedDate`, `Surname`, `GivenName`, `StudentNo`, `Email`, `PhoneNo`, `ConfirmMaximumISC`, `EnrollInPHD`) 
			VALUES (newApplicationType, newApplicationStatus, CURDATE(), newSurname, newGivenName, newStudentNo, newEmail, newPhoneNo, newConfirmMaximumISC, newEnrollInPHD);

	#Get the customerID surrogate key value
	SET varNewID = last_insert_id();
	SET ISCID = varNewID;

	INSERT INTO `ISCON`.`ISC_DETAIL` (`ISCID`) values (varNewID);
	INSERT INTO `ISCON`.`SUPERVISOR` (`ISCID`) values (varNewID);
	INSERT INTO `ISCON`.`ASSOCIATE_SUPERVISOR` (`ISCID`) values (varNewID);
	INSERT INTO `ISCON`.`SCHOOL_DEAN` (`ISCID`) values (varNewID);
	INSERT INTO `ISCON`.`ACADEMIC_CHAIR` (`ISCID`) values (varNewID);

	OPEN ISCSupervisorCursor;

		while (done != 1) DO
			
			FETCH ISCSupervisorCursor into varItemID;
				if (not done) then
					INSERT INTO `ISCON`.`ISC_SUPERVISOR_ANSWER`(`ISCID`, `ItemID`) 
						VALUES(varNewID, varItemID);
				end if;
		END WHILE;
	
	CLOSE ISCSupervisorCursor;
	
END
//

DELIMITER ;

# Create procedure for updating ISC
Delimiter //

CREATE PROCEDURE UpdateISC (
							IN ISCID 				int,
							IN newApplicationType	varchar(20),
							IN newApplicationStatus	varchar(50),
							IN newSurname			varchar(30),
							IN newGivenName 		varchar(30),
							IN newStudentNo			char(10),
							IN newEmail				varchar(50),
							IN newPhoneNo			char(15),
							IN newConfirmMaximumISC	varchar(10),
							IN newEnrollInPHD		varchar(10)
							)
BEGIN
	UPDATE ISC as I
	SET I.ApplicationType = newApplicationType, 
		I.ApplicationStatus = newApplicationStatus, 
		I.CreatedDate = CURDATE(),
		I.Surname = newSurname, 
		I.GivenName = newGivenName, 
		I.StudentNo = newStudentNo, 
		I.Email = newEmail, 
		I.PhoneNo = newPhoneNo, 
		I.ConfirmMaximumISC = newConfirmMaximumISC, 
		I.EnrollInPHD = newEnrollInPHD
	WHERE I.ISCID = ISCID;
END
//

DELIMITER ;

# Create procedure for updating ISC supervisor
Delimiter //

CREATE PROCEDURE UpdateISCSupervisor (
								IN ISCID	int,
								IN Title				varchar(50),
								IN Surname				varchar(50),
								IN GivenName			varchar(50),
								IN Position			varchar(50),
								IN School				varchar(50),
								IN SupervisorEmail		varchar(50)
								)
BEGIN

	UPDATE SUPERVISOR as S
	SET S.Title = Title, 
		S.Surname = Surname, 
		S.GivenName = GivenName, 
		S.Position = Position,
		S.School = School,
		S.SupervisorEmail = SupervisorEmail
	WHERE S.ISCID = ISCID;

END
//

DELIMITER ;

#call UpdateISCSupervisor(3, 'suptit', 'surname', 'givenname', 'position', 'school', 'email');

# Create procedure for updating ISC associate supervisor
Delimiter //

CREATE PROCEDURE UpdateISCAssociateSupervisor (
								IN ISCID	int,
								IN Title				varchar(50),
								IN Surname				varchar(50),
								IN GivenName			varchar(50),
								IN Position			varchar(50),
								IN School				varchar(50),
								IN AssociateEmail		varchar(50)
								)
BEGIN

	UPDATE ASSOCIATE_SUPERVISOR as A
	SET A.Title = Title, 
		A.Surname = Surname, 
		A.GivenName = GivenName, 
		A.Position = Position,
		A.School = School,
		A.AssociateEmail = AssociateEmail
	WHERE A.ISCID = ISCID;

END
//

DELIMITER ;

# Create procedure for updating ISC school dean
Delimiter //

CREATE PROCEDURE UpdateISCSchoolDean (
								IN ISCID	int,
								IN Surname				varchar(50),
								IN GivenName			varchar(50),
								IN School				varchar(50),
								IN SchoolDeanEmail		varchar(50)
								)
BEGIN

	UPDATE SCHOOL_DEAN as S
	SET S.Surname = Surname, 
		S.GivenName = GivenName, 
		S.School = School,
		S.SchoolDeanEmail = SchoolDeanEmail
	WHERE S.ISCID = ISCID;

END
//

DELIMITER ;

# Create procedure for updating ISC academic chair
Delimiter //
	
CREATE PROCEDURE UpdateISCAcademicChair (
								IN ISCID	int,
								IN Surname				varchar(50),
								IN GivenName			varchar(50),
								IN UnitCode			varchar(10),
								IN AcademicChairEmail	varchar(50)
								)
BEGIN

	UPDATE ACADEMIC_CHAIR as AC
	SET AC.Surname = Surname, 
		AC.GivenName = GivenName, 
		AC.UnitCode = UnitCode,
		AC.AcademicChairEmail = AcademicChairEmail
	WHERE AC.ISCID = ISCID;

END
//

DELIMITER ;

# procedure for deleting old ISC expected activities
Delimiter //

CREATE PROCEDURE DeleteOldISCExpectedActivity ( IN 	ISCID	int )
BEGIN
	delete from ISC_EXPECTED_ACTIVITY where ISC_EXPECTED_ACTIVITY.ISCID = ISCID;

END
//

DELIMITER ;

# create procedure for adding 
Delimiter //

CREATE PROCEDURE UpdateISCExpectedActivity (
								IN ISCID	int,
								IN Name                VARCHAR(100),
								IN Description         VARCHAR(200)
								)
label:BEGIN
	Declare varActivityID int;
	Declare varNewActivityID int;
	Declare varCount int;

	set varActivityID = -1;
		
	select ActivityID into varActivityID
	from EXPECTED_ACTIVITY as EA
	where EA.Name = Name
	and   EA.Description = Description;

	# if the activity already exists
	if (varActivityID != -1) then
		# check if a record in ISC_Expected_Activity already exists
		select count(*) into varCount
		from ISC_EXPECTED_ACTIVITY as IEA
		where IEA.ISCID = ISCID and IEA.ActivityID = varActivityID;
		
		# if the recored does not exist
		if(	varCount = 0) then
			INSERT INTO `ISCON`.`ISC_EXPECTED_ACTIVITY` (`ActivityID`, `ISCID`)
					VALUES (varActivityID, ISCID);
		end if;

		leave label;
	end if;
	
	# if not exist
	INSERT INTO `ISCON`.`EXPECTED_ACTIVITY` (`Name`, `Description`)
			VALUES (Name, Description);

	set varNewActivityID = last_insert_id();

	select count(*) into varCount
	from ISC_Expected_Activity as IEA
	where IEA.ISCID = ISCID and IEA.ActivityID = varNewActivityID;

	if(	varCount = 0) then
		INSERT INTO `ISCON`.`ISC_EXPECTED_ACTIVITY` (`ActivityID`, `ISCID`)
				VALUES (varNewActivityID, ISCID);
	end if;

END label
//

DELIMITER ;


# procedure for deleting old ISC reading list
Delimiter //

CREATE PROCEDURE DeleteOldISCReadingList ( IN 	ISCID	int )
BEGIN
	delete from READING_LIST where READING_LIST.ISCID = ISCID;

END
//

DELIMITER ;

# create procedure for adding reading list
Delimiter //

CREATE PROCEDURE UpdateISCReadingList (
								IN ISCID			int,
								IN Author              VARCHAR(50),
								IN Title               VARCHAR(50),
								IN PublicationDate     DATE
								)
label:BEGIN
		INSERT INTO `ISCON`.`READING_LIST` (`Author`, `Title`, `PublicationDate`, `ISCID`)
			VALUES (Author, Title, PublicationDate, ISCID);

END label
//

DELIMITER ;

# procedure for deleting old ISC replacement
Delimiter //

CREATE PROCEDURE DeleteOldISCReplacement ( IN 	ISCID	int )
BEGIN
	delete from REPLACEMENT where REPLACEMENT.ISCID = ISCID;

END
//

DELIMITER ;

# create procedure for adding replacement Unit
Delimiter //

CREATE PROCEDURE UpdateISCReplacement (
								IN ISCID           int ,
								IN UnitCode        VARCHAR(8),
								IN Title           VARCHAR(50),
								IN CoreOrElective  VARCHAR(10)
								)
label:BEGIN
		INSERT INTO `ISCON`.`REPLACEMENT` (`ISCID`, `UnitCode`, `Title`, `CoreOrElective`)
			VALUES (ISCID, UnitCode, Title, CoreOrElective);

END label
//

DELIMITER ;

# procedure for deleting old ISC replacement
Delimiter //

CREATE PROCEDURE DeleteOldISCAssessmentComponent ( IN 	ISCID	int )
BEGIN
	delete from ASSESSMENT_COMPONENT where ASSESSMENT_COMPONENT.ISCID = ISCID;

END
//

DELIMITER ;

# create procedure for adding replacement Unit
Delimiter //

CREATE PROCEDURE UpdateISCAssessmentComponent (
								IN ISCID               INT,
								IN Description         VARCHAR(1000),
								IN WordLength          INT,
								IN Percentage          INT,
								IN DueDate				DATE
								)
label:BEGIN
		INSERT INTO `ISCON`.`ASSESSMENT_COMPONENT` (`ISCID`, `Description`, `WordLength`, `Percentage`, `DueDate`)
			VALUES (ISCID, Description, WordLength, Percentage, DueDate);

END label
//

DELIMITER ;

# create procedure for adding ISC detail
Delimiter //

CREATE PROCEDURE UpdateISCDetails (
								ISCID               int,
								CourseName          VARCHAR(20),
								CreditPoint         INT,
								ContractTitle       VARCHAR(50),
								IsAReplacement      VARCHAR(45),
								LearningObjectives  VARCHAR(1000),
								ProjectOutline      VARCHAR(1000),
								PreviousStudy       VARCHAR(100),
								PreviousExperience  VARCHAR(1000),
								ContractLevel       INT(3),
								StudyMode           VARCHAR(20),
								CampusLocation      VARCHAR(50),
								TeachingPeriod      VARCHAR(30)
								)
label:BEGIN
	UPDATE `ISCON`.`ISC_DETAIL` as I
	SET I.CourseName =  CourseName,
		I.CreditPoint =  CreditPoint, 
		I.ContractTitle =  ContractTitle, 
		I.IsAReplacement =  IsAReplacement, 
		I.LearningObjectives =  LearningObjectives, 
		I.ProjectOutline =  ProjectOutline, 
		I.PreviousStudy =  PreviousStudy, 
		I.PreviousExperience =  PreviousExperience, 
		I.ContractLevel =  ContractLevel, 
		I.StudyMode =  StudyMode, 
		I.CampusLocation =  CampusLocation, 
		I.TeachingPeriod =  TeachingPeriod
	WHERE I.ISCID = ISCID;
		
END label
//

DELIMITER ;

#call UpdateISCDetails(27, 'courename', 3, 'title', 'no', 'learning objectives', 'project outline', 'previous study', 'previous experience', 700, 'mode', 'campus', 'period');

# create procedure for adding ISC Supervisor Answer
-- Delimiter //
-- 
-- CREATE PROCEDURE AddISCSupervisorAnswer (
-- 									IN ISCID            int,
-- 									IN ItemID			varchar(10),
-- 									IN YesNoAnswer		varchar(10),
-- 									IN TextAnswer		varchar(1000),
-- 									IN Comment			varchar(1000)
-- 									)
-- label:BEGIN
-- 	INSERT INTO `ISCON`.`ISC_SUPERVISOR_ANSWER`(`ISCID`, `ItemID`, `YesNoAnswer`, `TextAnswer`, `Comment`)
-- 		VALUES(ISCID, ItemID, YesNoAnswer, TextAnswer, Comment);
-- END label
-- //
-- 
-- DELIMITER ;
-- 
# create procedure for adding ISC Supervisor Answer
Delimiter //

CREATE PROCEDURE UpdateISCSupervisorAnswer (
									IN ISCID            int,
									IN ItemID			varchar(10),
									IN YesNoAnswer		varchar(10),
									IN TextAnswer		varchar(1000),
									IN Comment			varchar(1000)
									)
label:BEGIN
	UPDATE `ISCON`.`ISC_SUPERVISOR_ANSWER` AS I
	SET I.YesNoAnswer = YesNoAnswer, 
		I.TextAnswer = TextAnswer, 
		I.Comment = Comment
	WHERE I.ISCID = ISCID and I.ItemID = ItemID;
END label
//

DELIMITER ;
call UpdateISCSupervisorAnswer (28, 'item9', 'yes', '', '');
select * from ISC_SUPERVISOR_ANSWER;

-- INSERT INTO `iscon`.`ISC_SUPERVISOR_ANSWER`(`ISCID`, `ItemID`, `YesNoAnswer`, `TextAnswer`, `Commment`)
-- 	VALUES(30, 'item1', 'yes', '', '');