CREATE TABLE Member (   
	memberID int(11) NOT NULL,   
	name varchar(30) NOT NULL,  
	referrer int(11),  
	PRIMARY KEY  (memberID),  
	FOREIGN KEY(referrer) REFERENCES Member(memberID) 
) ENGINE = INNODB; 

CREATE TABLE Driver (   
	memberID int(11) NOT NULL,   
	accountNO varchar(30) NOT NULL,  
	licence int(11) NOT NULL,  
	PRIMARY KEY  (memberID),  
	FOREIGN KEY(memberID) REFERENCES Member(memberID) 
) ENGINE = INNODB; 

CREATE TABLE Passenger (   
	memberID int(11) NOT NULL,   
	creditCardNO varchar(16) NOT NULL,    
	PRIMARY KEY  (memberID),  
	FOREIGN KEY(memberID) REFERENCES Member(memberID) 
) ENGINE = INNODB;

CREATE TABLE Vehicle (   
	carPlate varchar(8) NOT NULL,   
	carType ENUM('normal', 'commercial','7-seaters') NOT NULL,
	brand varchar(30) NOT NULL,
	owner int(11) NOT NULL,
	PRIMARY KEY  (carPlate),  
	FOREIGN KEY(owner) REFERENCES Driver(memberID) 
) ENGINE = INNODB;

CREATE TABLE Trip (   
	tripID int(11) NOT NULL,   
	passengerID int(11) NOT NULL,
	startDate DATE NOT NULL,
	startTime TIME NOT NULL,
	source varchar(30) NOT NULL,
	destination varchar(30) NOT NULL,
	carPlate varchar(8) NOT NULL,
	fare DECIMAL(6,1) NOT NULL,
	PRIMARY KEY  (tripID),  
	FOREIGN KEY(carPlate) REFERENCES Vehicle(carPlate),
	FOREIGN KEY(passengerID) REFERENCES Passenger(memberID)
) ENGINE = INNODB;
