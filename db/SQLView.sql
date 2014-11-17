/* Create a new database or schema */

USE ISCON;

/* Create Views */

create view ISCView
as select I.ISCID, I.ApplicationType, I.ApplicationStatus, I.CreatedDate,
	I.Surname, I.GivenName, I.StudentNo, I.Email, I.PhoneNo, I.ConfirmMaximumISC, I.EnrollInPHD,
	ISCD.CourseName, ISCD.CreditPoint, ISCD.ContractTitle, ISCD.IsAReplacement, ISCD.LearningObjectives,
    ISCD.ProjectOutline, ISCD.PreviousStudy, ISCD.PreviousExperience, ISCD.ContractLevel,
    ISCD.StudyMode, ISCD.CampusLocation, ISCD.TeachingPeriod
	from ISC as I
	join ISC_Detail as ISCD 
		on I.ISCID = ISCD.ISCID;

create view ISCExpectedActivityView 
as select IEA.ActivityID, ISCID, Name, Description 
	from Expected_Activity as EA
	join ISC_Expected_Activity as IEA 
		on EA.ActivityID = IEA.ActivityID;

create view ISCReadingListView
as select * from Reading_List;

create view ISCSupervisorAnswerView
as select * from ISC_Supervisor_Answer;





