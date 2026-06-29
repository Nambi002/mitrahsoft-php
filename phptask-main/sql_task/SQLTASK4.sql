
USE nambivel;


-- QUERY-1
SELECT * FROM Task JOIN Project ON Task.ProjectId=Project.ProjectId;

-- QUERY-2
SELECT Project.*,Task.TaskName,Task.StartDate,Task.DueDate
FROM   Project LEFT JOIN Task 
ON     Project.ProjectId=Task.ProjectId;


-- QUERY-3
SELECT Task.*,Project.ProjectName,Project.StartDate,Project.EndDate 
FROM   Task RIGHT JOIN Project
ON     Project.ProjectId=Task.ProjectId;



-- QUERY-4
ALTER TABLE Project ADD ParentProjectId INT Null;


UPDATE Project SET ParentProjectId=3 WHERE ProjectId=4;


SELECT c.ProjectId AS childProjectId,
c.ProjectName AS childProjectName,
P.ProjectId,P.ProjectName AS ParentProjectName FROM Project P
LEFT  JOIN  Project c  ON c.ParentProjectId = P.ProjectId 



-- QUERY-5
SELECT CURRENT_TIMESTAMP AS CurrentDateAndTime;
SELECT SYSDATETIME() AS SystemDateTime;
SELECT GETDATE()As GetDate;


-- QUERY-6
SELECT ProjectName, YEAR(StartDate)AS [YEAR],
Month(EndDate) AS [MONTH],
DATENAME(month, EndDate)AS [MONTH_NAME],
DATEPART(WEEK,EndDate)AS[WEEK],
DAY(EndDate)AS [DAY],
DATENAME(WEEKDAY,EndDate)AS [DAY_NAME]
FROM  Project;


-- QUERY-7
SELECT ProjectName,StartDate,
EndDate,
DATEDIFF(DAY,StartDate,EndDate)AS DifferenceBetweenTwoDates
FROM  Project;


-- QUERY-8
SELECT  CONVERT(VARCHAR(50),StartDate,120) AS DATE FROM Project;


-- QUERY-9
SELECT * FROM Task  
CROSS APPLY (SELECT * FROM Project WHERE Task.ProjectId=Project.ProjectId)AS CROS;











