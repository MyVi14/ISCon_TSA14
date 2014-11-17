/* Create a new database or schema */
CREATE DATABASE `ISCON` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE ISCON;

# Create Reference Tables
CREATE TABLE QUESTION_TYPE
(
	QuestionType		varchar(50)		Not Null,
	Description			varchar(1000),

	CONSTRAINT 	QuestionType_PK	primary key (QuestionType)
);

CREATE TABLE DECISION_TYPE 
(
	DecisionType		varchar(50)		Not Null,
	Description			varchar(1000),

	CONSTRAINT 	DecisionType_PK	primary key (DecisionType)
);


CREATE TABLE APPLICATION_STATUS
(
	ApplicationStatus		varchar(50)		Not Null,
	Description				varchar(1000),

	CONSTRAINT 	ApplicationStatus_PK	primary key (ApplicationStatus)
);

CREATE TABLE STUDY_PERIOD 
(
	TeachingPeriod		varchar(50)		Not Null,
	ContractStart		varchar(100),
	CompletionDate		varchar(100),
	Description			varchar(1000),

	CONSTRAINT 	TeachingPeriod_PK	primary key (TeachingPeriod)
);

CREATE TABLE CAMPUS
(
	Location		varchar(50)		Not Null,
	Description		varchar(1000),

	CONSTRAINT 	Location_PK	primary key (Location)
);

CREATE TABLE STUDY_MODE
(
	StudyMode		varchar(50)		Not Null,
	Description		varchar(1000),

	CONSTRAINT 	StudyMode_PK	primary key (StudyMode)
);

# Create table for ISC Section A
CREATE TABLE ISC
(
	ISCID				int				not null 	auto_increment,
	ApplicationType		varchar(50),
	ApplicationStatus	varchar(20),
	CreatedDate			date,
	Surname				varchar(30),
	GivenName			varchar(30),
	StudentNo			char(10),
	Email				varchar(50),
	PhoneNo				char(15),

	CONSTRAINT 	ISC_PK	primary key (ISCID)
);

CREATE TABLE SUPERVISOR
(
	ISCID				int				not null,
	Title				varchar(50),
	Surname				varchar(50),
	GivenName			varchar(50),
	Position			varchar(50),
	School				varchar(50),
	SupervisorEmail		varchar(50),
	Decision			bool,
	DecisionDate		date,

	CONSTRAINT 	Supervisor_PK	primary key (ISCID),
	CONSTRAINT 	SUPERVISOR_ISCFK	foreign key (ISCID)
	references ISC(ISCID)
);

CREATE TABLE ASSOCIATE_SUPERVISOR
(
	ISCID				int				not null,
	Title				varchar(50),
	Surname				varchar(50),
	GivenName			varchar(50),
	Position			varchar(50),
	School				varchar(50),
	AssociateEmail		varchar(50),
	Decision			bool,
	DecisionDate		date,

	CONSTRAINT 	ASSOCIATE_SUPERVISOR_PK	primary key (ISCID),
	CONSTRAINT 	ASSOCIATE_SUPERVISOR_ISCFK	foreign key (ISCID)
	references ISC(ISCID)
);

CREATE TABLE SCHOOL_DEAN
(
	ISCID				int				not null,
	Surname				varchar(50),
	GivenName			varchar(50),
	School				varchar(50),
	SchoolDeanEmail		varchar(50),
	Decision			bool,
	DecisionDate		date,
	AdditionalComment	varchar(50),

	CONSTRAINT 	SCHOOL_DEAN_PK	primary key (ISCID),
	CONSTRAINT 	SCHOOL_DEAN_ISCFK	foreign key (ISCID)
	references ISC(ISCID)
);

CREATE TABLE ACADEMIC_CHAIR
(
	ISCID				int				not null,
	Surname				varchar(50),
	GivenName			varchar(50),
	UnitCode			varchar(10),
	AcademicChairEmail	varchar(50),
	Decision			bool,
	DecisionDate		date,

	CONSTRAINT 	ACADEMIC_CHAIR_PK	primary key (ISCID),
	CONSTRAINT 	ACADEMIC_CHAIR_ISCFK	foreign key (ISCID)
	references ISC(ISCID)
);

# Create table for ISC Section B

CREATE TABLE ISC_DETAIL
(
	ISCID	int	not null,
	CourseCode VARCHAR(8) NULL,
	CreditPoint INT NULL,
	ContractTitle VARCHAR(50) NULL,
	IsAReplacement VARCHAR(45) NULL,
	LearningObjectives VARCHAR(1000) NULL,
	ProjectOutline VARCHAR(1000) NULL,
	PreviousStudy VARCHAR(100) NULL,
	PreviousExperience VARCHAR(1000) NULL,
	ContractLevel INT(3) NULL,
	StudyMode VARCHAR(20) NULL,
	CampusLocation VARCHAR(50) NULL,
	TeachingPeriod VARCHAR(30) NULL,

	CONSTRAINT 	ISC_DETAIL_PK	primary key (ISCID),
	CONSTRAINT 	ISC_DETAIL_ISCFK	foreign key (ISCID)
	references ISC(ISCID)
);

CREATE TABLE REPLACEMENT 
(
	ISCID	int	not null,
	UnitCode VARCHAR(8) NOT NULL,
	Title VARCHAR(50) NULL,
	CoreOrElective VARCHAR(10) NULL,

	CONSTRAINT 	REPLACEMENT_PK	primary key (ISCID),
	CONSTRAINT 	REPLACEMENT_ISCFK	foreign key (ISCID)
	references ISC(ISCID)
);


CREATE TABLE ASSESSMENT_COMPONENT
(
	ComponentID INT NOT NULL,
	Description VARCHAR(1000) NULL,
	WordLength INT NULL,
	Percentage INT NULL,
	DueDate DATE NULL,
	Mark INT NULL,
	Comment	varchar(50),
	ISCID INT NULL,

	CONSTRAINT ComponentID_PK PRIMARY KEY (ComponentID),
	CONSTRAINT 	ASSESSMENT_COMPONENT_ISCFK foreign key (ISCID)
	references ISC(ISCID)
);


CREATE TABLE  READING_LIST
(
	ReadingID INT NOT NULL,
	Author VARCHAR(50) NULL,
	Title VARCHAR(50) NULL,
	PublicationDate DATE NULL,
	ISCID INT NULL,

	CONSTRAINT ReadingID_PK PRIMARY KEY (ReadingID),
	CONSTRAINT 	READING_LIST_ISCFK foreign key (ISCID)
	references ISC(ISCID)
);

CREATE TABLE EXPECTED_ACTIVITY 
(
	ActivityID INT NOT NULL,
	Name VARCHAR(100) NULL,
	Description VARCHAR(200) NULL,

	CONSTRAINT ActivityID_PK PRIMARY KEY (ActivityID)
);


CREATE TABLE ISC_EXPECTED_ACTIVITY 
(
	ActivityID INT NOT NULL,
	ISCID INT NOT NULL,

	CONSTRAINT ActivityID_ISC_PK PRIMARY KEY (ActivityID, ISCID),
	

	CONSTRAINT 	ISC_EXPECTED_ACTIVITY_ACTIVITYFK foreign key (ActivityID)
	references EXPECTED_ACTIVITY(ActivityID),

	CONSTRAINT 	ISC_EXPECTED_ACTIVITY_ISCFK foreign key (ISCID)
	references ISC(ISCID)
);
  

# Create table for ISC Section C

CREATE TABLE ISC_SUPERVISOR
(
	ItemID				int				not null,
	Description			varchar(1000),
	QuestionType		varchar(50),
	YesNoAnswer			bool,
	TextAnswer			varchar(1000),

	CONSTRAINT 	ISCSupervisor_PK	primary key (ItemID)
);

CREATE TABLE ISC_SUPERVISOR_ANSWER
(
	ISCID				int			not null,
	ItemNumber			int			not null,
	ItemID				int			not null,

	CONSTRAINT 	ISCSupervisor_PK		primary key (ISCID, ItemNumber),

	CONSTRAINT 	ISCSupervisor_FK		foreign key (ItemID)
	references ISC_Supervisor(ItemID),

	CONSTRAINT 	ISC_SUPERVISOR_ANSWER_FK		foreign key (ISCID)
	references ISC(ISCID)
);


#Create a new table for team member information. This table is used to test
CREATE TABLE TeamMember
(
	MemberID	int				not null 	auto_increment,
	FullName	varchar(50)		not null,
	StudentNo	char(10)		not null,
	Email		varchar(50)		not null,
	PhoneNo		char(10)		not null,
	CONSTRAINT 	TeamMemberPK	primary key (MemberID)
);

