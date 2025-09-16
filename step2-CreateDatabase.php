Table Fields (tbl_users)

ID → INT(11) (Primary Key)

FIRSTNAME → VARCHAR(255)

MI → VARCHAR(255)

LASTNAME → VARCHAR(255)

DESIGNATION → VARCHAR(255)

USERNAME → VARCHAR(255)

PASSWORD → VARCHAR(255)

ROLE → VARCHAR(255)

STATUS → INT(11)

///----------------------------------------------------------///

-- Create table
CREATE TABLE tbl_users (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    FIRSTNAME VARCHAR(255) NOT NULL,
    MI VARCHAR(255),
    LASTNAME VARCHAR(255) NOT NULL,
    DESIGNATION VARCHAR(255),
    USERNAME VARCHAR(255) NOT NULL,
    PASSWORD VARCHAR(255) NOT NULL,
    ROLE VARCHAR(255),
    STATUS INT(11) DEFAULT 1,
    PRIMARY KEY (ID)
);
///----------------------------------------------------------///

-- Insert sample data
INSERT INTO users (FIRSTNAME, MI, LASTNAME, DESIGNATION, USERNAME, PASSWORD, ROLE, STATUS)
VALUES 
('John', 'A', 'Doe', 'Instructor', 'admin@gmail.com', 'admin', 'admin', 1),
('Jane', 'B', 'Smith', 'Clerk', 'janesmith', 'securepass', 'staff', 1),
('Michael', 'C', 'Johnson', 'Dean', 'mjohnson', 'mypassword', 'Manager', 0);
