CREATE DATABASE nambivel;

USE nambivel;

CREATE TABLE Project(

	ProjectID INT IDENTITY(1,1) PRIMARY KEY,
	ProjectName VARCHAR(50) UNIQUE,
	StartDate DATE,
	EndDate DATE Null,
	Budget DECIMAL(7,2),
	Status VARCHAR(25) DEFAULT 'Not Started' NOT NULL,
	CHECK(StartDate<EndDate)
);


INSERT INTO Project(ProjectName,StartDate,EndDate,Budget,Status) VALUES  ('Website Redesign', '2024-01-01', '2024-06-30', 15000.00, 'In Progress'),
																			 ('Mobile App Development', '2024-02-15', '2024-07-15', 25000.00, 'Not Started'),
																			 ('Market Research', '2025-03-01', '2025-09-21', 10000.00, 'Completed'),
																			 ('Annual Report Preparation', '2024-04-01', '2024-12-31', 12000.00, 'In Progress');


CREATE TABLE Task(

	TaskID INT IDENTITY(1,1) PRIMARY KEY,
	TaskName VARCHAR(50) NOT NULL,
	ProjectID INT FOREIGN KEY REFERENCES Project(ProjectID),
	Description VARCHAR(150),
	StartDate DATE,
	DueDate DATE Null,
	Priority VARCHAR(20) NOT NULL,
	Status VARCHAR (20) DEFAULT 'Pending' NOT NULL,
	CHECK(StartDate<DueDate),
	CHECK(Priority IN ('Low','High','Medium'))

);

INSERT INTO Task(TaskName,Description,StartDate,DueDate,Priority,Status,ProjectID) VALUES   ('Initial Design', 'Design phase for the new website', '2024-01-02', '2024-02-28', 'High', 'Completed', 1),
																								('UI Development', 'Development of user interface components', '2024-03-01', '2024-05-15', 'Medium', 'In Progress', 1),
																								('Quality Assurance', 'Testing and quality assurance', '2024-05-16', '2024-06-15', 'High', 'Pending', 1),
																								('API Development', 'Developing APIs for the mobile app', '2024-02-16', '2024-04-30', 'Medium', 'Completed', 2),
																								('Beta Testing', 'Conducting beta testing for the mobile app', '2024-05-01', '2024-06-30', 'High', 'In Progress', 2),
																								('Survey Analysis', 'Analyzing market research surveys', '2024-03-02', '2024-04-15', 'Low', 'Completed', 3),
																								('Report Drafting', 'Drafting the final report based on research', '2024-04-16', '2024-05-30', 'Medium', 'Pending', 3),
																								('Financial Statements', 'Preparing financial statements for the annual report', '2024-04-02', '2024-09-15', 'High', 'In Progress', 4),
																								('Final Review', 'Final review and submission of the annual report', '2024-07-16', '2024-12-15', 'High', 'Pending', 4),
																								('Client Feedback Incorporation', 'Incorporating feedback from the client into the project', '2024-02-01', '2024-03-15', 'Medium', 'In Progress', 1),
																								('Launch Preparation', 'Preparing for the official launch of the mobile app', '2024-06-01', '2024-07-01', 'High', 'Pending', 2);




SELECT*FROM Project;

SELECT*FROM Task;


