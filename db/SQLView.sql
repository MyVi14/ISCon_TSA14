/* Create a new database or schema */

USE ISCON;

/* Create Views */
create view ISCView
as select I.ISCID, I.ApplicationType, I.ApplicationStatus, I.CreatedDate,
	I.Surname, I.GivenName, I.StudentNo, I.Email, I.PhoneNo, I.ConfirmMaximumISC, I.EnrollInPHD,
	ISCD.CourseName, ISCD.CreditPoint, ISCD.ContractTitle, ISCD.IsAReplacement, ISCD.LearningObjectives,
    ISCD.ProjectOutline, ISCD.PreviousStudy, ISCD.PreviousExperience, ISCD.ContractLevel,
    ISCD.StudyMode, ISCD.CampusLocation, ISCD.TeachingPeriod, SD.AdditionalComment
	from ISC as I
	join ISC_DETAIL as ISCD 
		on I.ISCID = ISCD.ISCID
	join SCHOOL_DEAN as SD
		on I.ISCID = SD.ISCID;

CREATE VIEW ISCExpectedActivityView 
as select IEA.ActivityID, ISCID, Name, Description 
	from EXPECTED_ACTIVITY as EA
	join ISC_EXPECTED_ACTIVITY as IEA 
		on EA.ActivityID = IEA.ActivityID;

create view ISCReadingListView
as select * from READING_LIST;

create view ISCSupervisorAnswerView
as select * from ISC_SUPERVISOR_ANSWER;

create view ApplicationStatusView
as select * from APPLICATION_STATUS;




