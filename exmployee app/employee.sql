DROP DATABASE IF EXISTS EMPLOYEE;
CREATE DATABASE EMPLOYEE;
USE EMPLOYEE;

CREATE TABLE Branch
(
     branch_id VARCHAR(15),
     name VARCHAR(30) NOT NULL,
     asset INT UNSIGNED NOT NULL,
     PRIMARY KEY(branch_id)
);
ALTER TABLE Branch ENGINE = INNODB;



CREATE TABLE Customer
(
     customer_id VARCHAR(15),
     name VARCHAR(30) NOT NULL,
     address TEXT,
     PRIMARY KEY(customer_id)
);
ALTER TABLE Customer ENGINE = INNODB;


CREATE TABLE Account
(
     account_id VARCHAR(15) NOT NULL,
     branch_id VARCHAR(15) NOT NULL,
     balance INT UNSIGNED NOT NULL,
     PRIMARY KEY(account_id)
);
ALTER TABLE Account ENGINE = INNODB;
ALTER TABLE Account ADD FOREIGN KEY(branch_id) REFERENCES Branch(branch_id);

CREATE TABLE Owner
(
     customer_id VARCHAR(15),
     account_id VARCHAR(15),
     PRIMARY KEY(customer_id, account_id),
     FOREIGN KEY(customer_id) REFERENCES Customer(customer_id),
     FOREIGN KEY(account_id) REFERENCES Account(account_id)
);
ALTER TABLE Owner ENGINE = INNODB;



CREATE TABLE Loan
(
     loan_id VARCHAR(15),
     branch_id VARCHAR(15),
     amount INT UNSIGNED NOT NULL,
     PRIMARY KEY(loan_id),
     FOREIGN KEY(branch_id) REFERENCES Branch(branch_id)
) ;
ALTER TABLE Loan ENGINE = INNODB;



CREATE TABLE Borrower
(
     loan_id VARCHAR(15),
     customer_id VARCHAR(15),
     PRIMARY KEY(loan_id, customer_id),
     FOREIGN KEY(loan_id) REFERENCES Loan(loan_id),
     FOREIGN KEY(customer_id) REFERENCES Customer(customer_id)
);
ALTER TABLE Borrower ENGINE = INNODB;



ALTER TABLE Loan 
ADD FOREIGN KEY (branch_id) REFERENCES Branch(branch_id);
ALTER TABLE Borrower 
ADD FOREIGN KEY (loan_id) REFERENCES Loan(loan_id);
ALTER TABLE Borrower 
ADD FOREIGN KEY (customer_id) REFERENCES Customer(customer_id);
ALTER TABLE Account 
ADD FOREIGN KEY (branch_id) REFERENCES Branch(branch_id);
ALTER TABLE Owner 
ADD FOREIGN KEY (account_id) REFERENCES Account(account_id);
ALTER TABLE Owner 
ADD FOREIGN KEY (customer_id) REFERENCES Customer(customer_id);





INSERT INTO Branch VALUES ('B1', 'Central', 7100000);
INSERT INTO Branch VALUES ('B2', 'Causeway Bay', 9000000);
INSERT INTO Branch VALUES ('B3', 'Aberdeen', 400000);
INSERT INTO Branch VALUES ('B4', 'North Point', 3700000);


INSERT INTO Account VALUES ('A1', 'B1', 500);
INSERT INTO Account VALUES ('A2', 'B2', 400);
INSERT INTO Account VALUES ('A3', 'B2', 900);
INSERT INTO Account VALUES ('A4', 'B1', 700);

INSERT INTO Customer VALUES ('C1', 'Kit', 'CB320');
INSERT INTO Customer VALUES ('C2', 'Ben', 'CB326');
INSERT INTO Customer VALUES ('C3', 'Jolly', 'CB311');
INSERT INTO Customer VALUES ('C4', 'Ernest', 'CB415');

INSERT INTO Owner VALUES ('C1', 'A1');
INSERT INTO Owner VALUES ('C2', 'A1');
INSERT INTO Owner VALUES ('C1', 'A2');
INSERT INTO Owner VALUES ('C4', 'A3');
INSERT INTO Owner VALUES ('C4', 'A4');



INSERT INTO Loan VALUES ('L1', 'B3', 900);
INSERT INTO Loan VALUES ('L2', 'B1', 1500);
INSERT INTO Loan VALUES ('L3', 'B1', 1000);


INSERT INTO Borrower VALUES ('L3', 'C1');
INSERT INTO Borrower VALUES ('L2', 'C4');
INSERT INTO Borrower VALUES ('L1', 'C2');
