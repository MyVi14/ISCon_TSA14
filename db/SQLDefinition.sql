/* Create a new database or schema */
CREATE DATABASE `ISCON` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE ISCON;

# Create Reference Tables
CREATE TABLE QUESTION_TYPE
(
	QuestionType		varchar(50)		Not Null,
	Description			varchar(1000)
);

CREATE TABLE DECISION_TYPE 
(
	DecisionType		varchar(50)		Not Null,
	Description			varchar(1000)
);

CREATE TABLE APPLICATION_STATUS
(
	ApplicationStatus		varchar(50)		Not Null,
	Description				varchar(1000)
);

CREATE TABLE STUDY_PERIOD 
(
	TeachingPeriod		varchar(50)		Not Null,
	ContractStart		date,
	CompletionDate		date,
	Description			varchar(1000)
);

CREATE TABLE CAMPUS
(
	Location		varchar(50)		Not Null,
	Description		varchar(1000)
);

CREATE TABLE STUDY_MODE
(
	StudyMode		varchar(50)		Not Null,
	Description		varchar(1000)
);

# Create table for ISC Section A
CREATE TABLE ISC
(
	ISCID				int				not null 	auto_increment,
	ApplicationType		varchar(15),
	ApplicationStatus	varchar(10),
	CreatedDate			date,
	Surname				varchar(30),
	GivenName			varchar(30),
	StudentNo			char(10),
	Email				varchar(50),
	PhoneNo				char(15),
	CONSTRAINT 	ISCPK	primary key (ISCID)
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
	CONSTRAINT 	SupervisorPK	primary key (ISCID),
	CONSTRAINT 	ISCFK	foreign key (ISCID)
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
	CONSTRAINT 	AssociatePK	primary key (ISCID),
	CONSTRAINT 	ISCFK	foreign key (ISCID)
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
	CONSTRAINT 	SchoolDeanPK	primary key (ISCID),
	CONSTRAINT 	ISCFK	foreign key (ISCID)
			references ISC(ISCID)
);

CREATE TABLE Academic_Chair
(
	ISCID				int				not null,
	Surname				varchar(50),
	GivenName			varchar(50),
	UnitCode			varchar(10),
	AcademicChairEmail	varchar(50),
	Decision			bool,
	DecisionDate		date,
	CONSTRAINT 	AcademicChairPK	primary key (ISCID),
	CONSTRAINT 	ISCFK	foreign key (ISCID)
			references ISC(ISCID)
);

# Create table for ISC Section B

CREATE TABLE ISC_DETAIL
(
	ISCID				int				not null,
	

	CONSTRAINT 	ISCPK		foreign key (ISCID)
								references ISC(ItemID)
);

# Create table for ISC Section C

CREATE TABLE ISC_SUPERVISOR
(
	ItemID				int				not null,
	Description			varchar(1000),
	QuestionType		varchar(50),
	YesNoAnswer			bool,
	TextAnswer			varchar(1000),
	CONSTRAINT 	ISCSupervisorPK	primary key (ItemID)
);

CREATE TABLE ISC_SUPERVISOR
(
	ISCID				int			not null,
	ItemNumber			int			not null,
	ItemID				int			not null,
	CONSTRAINT 	ISCSupervisorPK		primary key (ISCID, ItemNumber),
	CONSTRAINT 	ISCSupervisorFK		foreign key (ItemID)
						references ISC_Supervisor(ItemID),
	CONSTRAINT 	ISCPK		foreign key (ISCID)
								references ISC(ItemID)
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

