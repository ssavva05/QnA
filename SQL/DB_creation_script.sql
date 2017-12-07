/*Here will put all thesql creation script after export from php my admin*/
CREATE DATABASE IF NOT EXISTS qnaDB;
CREATE TABLE IF NOT EXISTS members (
  memberID int(11) NOT NULL AUTO_INCREMENT,
  username varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  active varchar(255) NOT NULL,
  PRIMARY KEY (memberID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;


CREATE TABLE IF NOT EXISTS Course(
    cname varchar(10),
    memberID int(11), 
    dateof date,
    PRIMARY KEY(cname,dateof),
    CONSTRAINT FOREIGN KEY (memberID) REFERENCES members(memberID)
    ON DELETE CASCADE
	ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

CREATE TABLE IF NOT EXISTS Lecture(
    lid int(11) NOT NULL AUTO_INCREMENT,
	lname varchar(20),
    cname varchar(10),
    qcounter int DEFAULT '0',
	dateof date,
	enroll_key varchar(20),
	active BIT NOT NULL DEFAULT b'1',
	mod_timestamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	UNIQUE KEY enrollKey_UNIQUE (enroll_key),
    PRIMARY KEY(lid),
    CONSTRAINT FOREIGN KEY (cname,dateof) REFERENCES Course(cname,dateof)
        ON DELETE CASCADE
		ON UPDATE CASCADE
	
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

CREATE TABLE IF NOT EXISTS Question(
    qid int ,
    qidd int NOT NULL AUTO_INCREMENT,
    lid int,
    seen int DEFAULT '0',
    textofquestion text,
    acounter int,
    textofanswer	text,
UNIQUE KEY UNIQUE3 (qidd),
    PRIMARY KEY(qid,lid),
    FOREIGN KEY (lid) REFERENCES Lecture(lid)
        ON DELETE CASCADE
		ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

CREATE TABLE IF NOT EXISTS Answer(
    aid int,
    qidd int,
    aidd int NOT NULL AUTO_INCREMENT,
    qid int,
    lid int,
    textofanswer text,
    counter int DEFAULT '0',
    PRIMARY KEY(aid,qid,lid),
UNIQUE KEY UNIQUE2 (aidd),
    FOREIGN KEY (qid) REFERENCES Question(qid)
        ON DELETE CASCADE
		ON UPDATE CASCADE,
 FOREIGN KEY (lid) REFERENCES Lecture(lid)
        ON DELETE CASCADE
		ON UPDATE CASCADE,
 FOREIGN KEY (qidd) REFERENCES Question(qidd)
        ON DELETE CASCADE
		ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

CREATE TABLE IF NOT EXISTS `loginAttemptsStudents` (
  `IP` varchar(20) NOT NULL,
  `Attempts` int(11) NOT NULL,
  `LastLogin` datetime NOT NULL,
  `enroll_key` varchar(20) DEFAULT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
