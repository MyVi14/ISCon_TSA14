/* Create a new database or schema */

USE ISCON;
set @newVariable = -1;
call CreateNewISC('Undergraduate', 'new', 'Tony', 'Tieu Ha Phong', '2342342', 'tieuhaphong91@gmail.com', '81090025', 'no', 'yes', @newVariable);
select * from ISC;

select * from isc;
select * from isc_detail;
drop procedure CreateNewISC;
# Create procedure for inserting new ISC
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
	
	INSERT INTO `iscon`.`isc` (`ApplicationType`, `ApplicationStatus`, `CreatedDate`, `Surname`, `GivenName`, `StudentNo`, `Email`, `PhoneNo`, `ConfirmMaximumISC`, `EnrollInPHD`) 
			VALUES (newApplicationType, newApplicationStatus, CURDATE(), newSurname, newGivenName, newStudentNo, newEmail, newPhoneNo, newConfirmMaximumISC, newEnrollInPHD);

	#Get the customerID surrogate key value
	SET varNewID = last_insert_id();
	SET ISCID = varNewID;

	INSERT INTO `iscon`.`ISC_Detail` (`ISCID`) values (varNewID);
	INSERT INTO `iscon`.`Supervisor` (`ISCID`) values (varNewID);
	INSERT INTO `iscon`.`Associate_Supervisor` (`ISCID`) values (varNewID);
	INSERT INTO `iscon`.`School_Dean` (`ISCID`) values (varNewID);
	INSERT INTO `iscon`.`Academic_Chair` (`ISCID`) values (varNewID);
END
//

DELIMITER ;
drop procedure UpdateISC;

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
select * from supervisor;
insert into supervisor (ISCID) VALUES (3);
call UpdateISCSupervisor(3, 'suptit', 'surname', 'givenname', 'position', 'school', 'email');

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
drop procedure DeleteOldISCExpectedActivity;
select * from ISC_expected_activity;
call DeleteOldISCExpectedActivity(30);
select * from Expected_activity;
call UpdateISCExpectedActivity(28, 'Interviews', '');

# procedure for deleting old ISC expected activities
Delimiter //

CREATE PROCEDURE DeleteOldISCExpectedActivity ( IN 	ISCID	int )
BEGIN
	delete from ISC_expected_activity where ISC_expected_activity.ISCID = ISCID;

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
	from Expected_Activity as EA
	where EA.Name = Name
	and   EA.Description = Description;

	# if the activity already exists
	if (varActivityID != -1) then
		# check if a record in ISC_Expected_Activity already exists
		select count(*) into varCount
		from ISC_Expected_Activity as IEA
		where IEA.ISCID = ISCID and IEA.ActivityID = varActivityID;
		
		# if the recored does not exist
		if(	varCount = 0) then
			INSERT INTO `iscon`.`ISC_Expected_Activity` (`ActivityID`, `ISCID`)
					VALUES (varActivityID, ISCID);
		end if;

		leave label;
	end if;
	
	# if not exist
	INSERT INTO `iscon`.`Expected_Activity` (`Name`, `Description`)
			VALUES (Name, Description);

	set varNewActivityID = last_insert_id();

	select count(*) into varCount
	from ISC_Expected_Activity as IEA
	where IEA.ISCID = ISCID and IEA.ActivityID = varNewActivityID;

	if(	varCount = 0) then
		INSERT INTO `iscon`.`ISC_Expected_Activity` (`ActivityID`, `ISCID`)
				VALUES (varNewActivityID, ISCID);
	end if;

END label
//

DELIMITER ;

delete
from Expected_Activity
where ActivityID = 7;

delete
from ISC_Expected_Activity
where ActivityID = 7 and ISCID = 3;
 

call AddISCExpectedActivity(4, 'Library Research', '');
select * from expected_activity;
select * from isc_expected_activity;

# procedure for deleting old ISC reading list
Delimiter //

CREATE PROCEDURE DeleteOldISCReadingList ( IN 	ISCID	int )
BEGIN
	delete from Reading_List where Reading_List.ISCID = ISCID;

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
		INSERT INTO `iscon`.`Reading_List` (`Author`, `Title`, `PublicationDate`, `ISCID`)
			VALUES (Author, Title, PublicationDate, ISCID);

END label
//

DELIMITER ;
drop procedure AddISCReadingList;
call AddISCReadingList(3, 'author', 'title', '2012-12-3');
select * from reading_list;

# procedure for deleting old ISC replacement
Delimiter //

CREATE PROCEDURE DeleteOldISCReplacement ( IN 	ISCID	int )
BEGIN
	delete from Replacement where Replacement.ISCID = ISCID;

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
		INSERT INTO `iscon`.`Replacement` (`ISCID`, `UnitCode`, `Title`, `CoreOrElective`)
			VALUES (ISCID, UnitCode, Title, CoreOrElective);

END label
//

DELIMITER ;

call AddISCReplacement(3, 'ICt33', 'adsf', 'core');

drop procedure UpdateISCAssessmentComponent;
select * from assessment_component;
select * from replacement;

# procedure for deleting old ISC replacement
Delimiter //

CREATE PROCEDURE DeleteOldISCAssessmentComponent ( IN 	ISCID	int )
BEGIN
	delete from Assessment_Component where Assessment_Component.ISCID = ISCID;

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
		INSERT INTO `iscon`.`Assessment_Component` (`ISCID`, `Description`, `WordLength`, `Percentage`, `DueDate`)
			VALUES (ISCID, Description, WordLength, Percentage, DueDate);

END label
//

DELIMITER ;
select * from ISC_Detail;
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
	UPDATE `iscon`.`ISC_DETAIL` as I
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
drop procedure UpdateISCDetails;
call UpdateISCDetails(27, 'courename', 3, 'title', 'no', 'learning objectives', 'project outline', 'previous study', 'previous experience', 700, 'mode', 'campus', 'period');

select * from ISC_Detail;
select * from supervisor;
select * from associate_supervisor;
select * from school_dean;