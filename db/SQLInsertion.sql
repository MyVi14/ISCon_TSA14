/* Create a new database or schema */

USE ISCON;

/* Insert into tables */

# Insert data into TeamMember
INSERT INTO TeamMember(FullName, StudentNo, Email, PhoneNo) values ("Tieu Ha Phong", "32378757", "tieuhaphong91@gmail.com", "81090025");
INSERT INTO TeamMember(FullName, StudentNo, Email, PhoneNo) values ("Phyu Sin Htet", "32366484", "phyusinhtet2009@gmail.com", "92318580");
INSERT INTO TeamMember(FullName, StudentNo, Email, PhoneNo) values ("Hnin Moet Moet Htun", "32321356", "hninmmhtun@gmail.com", "98806010");
INSERT INTO TeamMember(FullName, StudentNo, Email, PhoneNo) values ("Kaung Hla", "32380427", "babymilo.2019@gmail.com", "92391925");
INSERT INTO TeamMember(FullName, StudentNo, Email, PhoneNo) values ("Thiri Kywe", "32378327", "thirikywe@gmail.com", "93910211");
INSERT INTO TeamMember(FullName, StudentNo, Email, PhoneNo) values ("Min Khant Zyn", "32378318", "m.khant90@gmail.com", "94831054");


# Insert data into Reference Tables
INSERT INTO `ISCON`.`QUESTION_TYPE` (`QuestionType`, `Description`) VALUES ('YesNo ', 'Yes No Questions');
INSERT INTO `ISCON`.`QUESTION_TYPE` (`QuestionType`, `Description`) VALUES ('Text', 'Questions require written anwsers');

INSERT INTO DECISION_TYPE (`DecisionType`, `Description`) VALUES ('Approved', 'Approved. The ISC can proceed');
INSERT INTO DECISION_TYPE (`DecisionType`, `Description`) VALUES ('Not Approved', 'Rejected becaused of some reasons');

INSERT INTO `ISCON`.`APPLICATION_STATUS` (`ApplicationStatus`, `Description`) VALUES ('New', 'Application is newly created and not formally submitted');
INSERT INTO `ISCON`.`APPLICATION_STATUS` (`ApplicationStatus`, `Description`) VALUES ('Processing', 'Application is submitted and processing');
INSERT INTO `ISCON`.`APPLICATION_STATUS` (`ApplicationStatus`, `Description`) VALUES ('Canceled', 'Application is canceled');
INSERT INTO `ISCON`.`APPLICATION_STATUS` (`ApplicationStatus`, `Description`) VALUES ('Supervisor Approved', 'Supervisor agrees to supervise the application');
INSERT INTO `ISCON`.`APPLICATION_STATUS` (`ApplicationStatus`, `Description`) VALUES ('Supervisor Not Approved', 'Supervisor does not agree to supervise the application');
INSERT INTO `ISCON`.`APPLICATION_STATUS` (`ApplicationStatus`, `Description`) VALUES ('AC Approved', 'Academic chair approves');
INSERT INTO `ISCON`.`APPLICATION_STATUS` (`ApplicationStatus`, `Description`) VALUES ('AC Not Approved', 'Academic chair does not approve');
INSERT INTO `ISCON`.`APPLICATION_STATUS` (`ApplicationStatus`, `Description`) VALUES ('SD Approved', 'School dean approves');
INSERT INTO `ISCON`.`APPLICATION_STATUS` (`ApplicationStatus`, `Description`) VALUES ('SD Not Approved', 'School dean does not approve');

INSERT INTO `ISCON`.`STUDY_PERIOD` (`TeachingPeriod`, `ContractStart`, `CompletionDate`) VALUES ('Semester1', 'Monday_Week1', 'First day of assessment period');
INSERT INTO `ISCON`.`STUDY_PERIOD` (`TeachingPeriod`, `ContractStart`, `CompletionDate`) VALUES ('Semester2', 'Monday_Week1', 'First day of assessment period');
INSERT INTO `ISCON`.`STUDY_PERIOD` (`TeachingPeriod`, `ContractStart`, `CompletionDate`) VALUES ('FullYear (Feb - Nov)', 'Monday_Week1', 'First day of Semester 2 assessment period');
INSERT INTO `ISCON`.`STUDY_PERIOD` (`TeachingPeriod`, `ContractStart`, `CompletionDate`) VALUES ('Winter', 'First Monday after the end of Semester 1', 'Monday before the start of Semester 2');
INSERT INTO `ISCON`.`STUDY_PERIOD` (`TeachingPeriod`, `ContractStart`, `CompletionDate`) VALUES ('Summer', 'First Monday after the end of Semester 2', 'Monday before the start of Semester 1');
INSERT INTO `ISCON`.`STUDY_PERIOD` (`TeachingPeriod`, `ContractStart`, `CompletionDate`) VALUES ('FullYear H Option (July-June)', 'Monday Week 1 of Semester 2', 'First day of Semester 1 assessment period');

INSERT INTO `ISCON`.`CAMPUS` (`Location`, `Description`) VALUES ('SouthSt', '');
INSERT INTO `ISCON`.`CAMPUS` (`Location`, `Description`) VALUES ('Rockingham', '');
INSERT INTO `ISCON`.`CAMPUS` (`Location`, `Description`) VALUES ('Peel', '');

INSERT INTO `ISCON`.`STUDY_MODE` (`StudyMode`, `Description`) VALUES ('Internally', '');
INSERT INTO `ISCON`.`STUDY_MODE` (`StudyMode`, `Description`) VALUES ('Externally', '');

# Insert data for ISC
INSERT INTO `ISCON`.`EXPECTED_ACTIVITY` (`Name`, `Description`) VALUES ('Library Research', '');
INSERT INTO `ISCON`.`EXPECTED_ACTIVITY` (`Name`, `Description`) VALUES ('Field Work', '');
INSERT INTO `ISCON`.`EXPECTED_ACTIVITY` (`Name`, `Description`) VALUES ('Laboratory  Experiments', '');
INSERT INTO `ISCON`.`EXPECTED_ACTIVITY` (`Name`, `Description`) VALUES ('Interviews', '');
INSERT INTO `ISCON`.`EXPECTED_ACTIVITY` (`Name`, `Description`) VALUES ('Data Collections', '');
INSERT INTO `ISCON`.`EXPECTED_ACTIVITY` (`Name`, `Description`) VALUES ('Writing', '');

# Insert data for ISC_Supervisor
INSERT INTO `ISCON`.`ISC_SUPERVISOR` (`ItemID`, `Description`, `QuestionType`) 
	VALUES ('item1', 'Apart from your time and normal library facilities, 
                    are any facilities or resources required for the contract 
                    (e.g. special literature, equipment, technical assistance, transport, 
                    maintenance costs, laboratory space)?' ,'YesNo');
INSERT INTO `ISCON`.`ISC_SUPERVISOR` (`ItemID`, `Description`, `QuestionType`) 
	VALUES ('item2', 'Apart from associate supervision, does the contract involve other institutions, organisations or persons?' ,'YesNo');
INSERT INTO `ISCON`.`ISC_SUPERVISOR` (`ItemID`, `Description`, `QuestionType`) 
	VALUES ('item3', 'Does the contract involve overseas travel?' ,'YesNo');
INSERT INTO `ISCON`.`ISC_SUPERVISOR` (`ItemID`, `Description`, `QuestionType`) 
	VALUES ('item4', 'Are there any confidentiality restrictions on publication of the results of this contract?' ,'YesNo');
INSERT INTO `ISCON`.`ISC_SUPERVISOR` (`ItemID`, `Description`, `QuestionType`) 
	VALUES ('item5a', 'Does the contract involve: Research with human subjects (e.g. experimental work, interviews, surveys or observation)?' ,'YesNo');
INSERT INTO `ISCON`.`ISC_SUPERVISOR` (`ItemID`, `Description`, `QuestionType`) 
	VALUES ('item5b', 'Does the contract involve: Work with animals or animal materials?' ,'YesNo');
INSERT INTO `ISCON`.`ISC_SUPERVISOR` (`ItemID`, `Description`, `QuestionType`) 
	VALUES ('item5c', 'Does the contract involve: Work with flora?' ,'YesNo');
INSERT INTO `ISCON`.`ISC_SUPERVISOR` (`ItemID`, `Description`, `QuestionType`) 
	VALUES ('item5d', 'Does the contract involve: Matters of a hazardous nature (e.g. potentially biohazardous procedures and situations the use and disposal of hazardous chemicals, or the use of ionising radiation)?' ,'YesNo');
INSERT INTO `ISCON`.`ISC_SUPERVISOR` (`ItemID`, `Description`, `QuestionType`) 
	VALUES ('item5e', 'Does the contract involve: Research on a matter of special political or social sensitivity?' ,'YesNo');
INSERT INTO `ISCON`.`ISC_SUPERVISOR` (`ItemID`, `Description`, `QuestionType`) 
	VALUES('item6', 'Please comment upon the student capacity to undertake the contract and your assessment of the quality of the proposed ISC.', 'Text');
INSERT INTO `ISCON`.`ISC_SUPERVISOR` (`ItemID`, `Description`, `QuestionType`) 
	VALUES('item7', 'Outline the nature and frequency of expected contact with the student. (If contract is to be studied externally, specific detail is required).', 'Text');
INSERT INTO `ISCON`.`ISC_SUPERVISOR` (`ItemID`, `Description`, `QuestionType`) 
	VALUES('item8', 'How many other Independent Study Contracts have you agreed to supervise during the same period as this contract?', 'Text');
INSERT INTO `ISCON`.`ISC_SUPERVISOR` (`ItemID`, `Description`, `QuestionType`) 
	VALUES('item9', 'Does the nature of the contract involve any problems relating to personal and commercial confidentiality?', 'YesNo');


