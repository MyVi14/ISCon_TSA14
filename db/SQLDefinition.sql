/* Create a new database or schema */
CREATE DATABASE `ISCON` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE ISCON;

/* Create new tables */






/* Create a new table for team member information. This table is used to test */
CREATE TABLE TeamMember
(
	MemberID	int				not null 	auto_increment,
	FullName	varchar(50)		not null,
	StudentNo	char(10)		not null,
	Email		varchar(50)		not null,
	PhoneNo		char(10)		not null,
	CONSTRAINT 	TeamMemberPK	primary key (MemberID)
);

/* Insert data */
INSERT INTO TeamMember(FullName, StudentNo, Email, PhoneNo) values ("Tieu Ha Phong", "32378757", "tieuhaphong91@gmail.com", "81090025");
INSERT INTO TeamMember(FullName, StudentNo, Email, PhoneNo) values ("Phyu Sin Htet", "32366484", "phyusinhtet2009@gmail.com", "92318580");
INSERT INTO TeamMember(FullName, StudentNo, Email, PhoneNo) values ("Hnin Moet Moet Htun", "32321356", "hninmmhtun@gmail.com", "98806010");
INSERT INTO TeamMember(FullName, StudentNo, Email, PhoneNo) values ("Kaung Hla", "32380427", "babymilo.2019@gmail.com", "92391925");
INSERT INTO TeamMember(FullName, StudentNo, Email, PhoneNo) values ("Thiri Kywe", "32378327", "thirikywe@gmail.com", "93910211");
INSERT INTO TeamMember(FullName, StudentNo, Email, PhoneNo) values ("Min Khant Zyn", "32378318", "m.khant90@gmail.com", "94831054");
