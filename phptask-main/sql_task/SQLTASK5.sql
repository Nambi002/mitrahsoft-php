USE nambivel;

DROP TABLE IF EXISTS #LocalTempTable ;


SELECT * FROM #LocalTempTable;


CREATE TABLE #LocalTempTable(
	Id INT IDENTITY(1,1),
	Name VARCHAR(100),
	StartDate DATE,
	Priority NVARCHAR(20)
);


INSERT INTO #LocalTempTable(Name,StartDate,Priority) 
SELECT  TaskName,StartDate,Priority 
FROM	Task 
WHERE	Priority='LOW';


SELECT * FROM #LocalTempTable;


DROP TABLE IF EXISTS ##GlobalTempTable ;


CREATE TABLE ##GlobalTempTable(
	Id INT IDENTITY(1,1),
	ProjectName VARCHAR(100),
	Budget DECIMAL(18,2),
	Priority NVARCHAR(20)
);


INSERT INTO ##GlobalTempTable(ProjectName,Budget,Priority)
SELECT TaskName,Budget,Priority
FROM   Task  
JOIN   Project ON  Task.ProjectId =Project.ProjectId  
WHERE  Priority='medium';

SELECT * FROM #LocalTempTable;
SELECT * FROM ##GlobalTempTable;


DECLARE @TableVariable AS TABLE(
	TaskId INT IDENTITY(1,1),
	TaskName VARCHAR(100),
	DueDate DATE,
	Priority NVARCHAR(20)
);

INSERT INTO @TableVariable (TaskName,DueDate,Priority) 
SELECT TaskName,DueDate,Priority
FROM   Task
WHERE  Priority='High';

SELECT * FROM @TableVariable;