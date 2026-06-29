
USE nambivel;


-- QUERY-1
SELECT * FROM Task ORDER BY StartDate;

-- QUERY-2
SELECT ProjectId ,COUNT(*) AS TASKCOUNT
FROM   Task GROUP BY ProjectId ORDER BY TASKCOUNT desc;


-- QUERY-3
SELECT Project.ProjectId,Project.ProjectName,COUNT(TaskId)AS TotalCount,Project.Budget AS TotalBudget
FROM   Project  
LEFT JOIN  Task ON Project.ProjectId=Task.ProjectId GROUP BY Project.ProjectId,Project.ProjectName,Project.Budget ORDER BY TotalBudget;


-- QUERY-4
SELECT * FROM Project 
WHERE Status='In Progress' AND Budget BETWEEN 10000.00 and 50000.00 ;


-- QUERY-5
SELECT * FROM Task
WHERE YEAR(StartDate)= '2024' AND Status='Completed';


-- QUERY-6
SELECT * FROM Task 
WHERE MONTH(DueDate)=MONTH(GETDATE())+1 AND Status='Pending';


-- QUERY-7
SELECT * FROM Task 
Join   Project  ON Task.ProjectId = Project.ProjectId 
where  ProjectName='Website Redesign' AND Task.Priority='high';


-- QUERY-8
SELECT * FROM Project
WHERE ProjectId IN (SELECT ProjectId FROM Task WHERE DueDate<GETDATE() AND Status !='COMPLETED');


-- QUERY-9
SELECT  * FROM Task 
WHERE ProjectId IN(SELECT TOP 1 ProjectId from Project ORDER BY StartDate DESC );


-- QUERY-10

SELECT*FROM Project WHERE ProjectId IN ( SELECT ProjectId FROM Task WHERE Priority='High') 
SELECT*FROM Project WHERE ProjectId IN (SELECT ProjectId FROM Task WHERE Priority='Low');


-- QUERY-11
SELECT * FROM Task WHERE TaskName LIKE '%Design%';


-- QUERY-12
SELECT * FROM Task WHERE TaskName LIKE '%Review%' AND TaskName NOT LIKE '%Pre%';


-- QUERY-13
SELECT * FROM Task WHERE TaskName LIKE '%[A-M]___%';




