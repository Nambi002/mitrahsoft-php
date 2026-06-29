use nambivel;
 
  
 
CREATE TRIGGER trg_UpdateProjectStatus 
ON Project 
AFTER UPDATE 
AS 
BEGIN
		UPDATE Project SET Status='Completed'
		FROM   Project JOIN inserted 
		ON     Project.ProjectId=inserted.ProjectId
		WHERE  inserted.EndDate is not null
END; 
 
update Project set EndDate = '2024-06-30' where ProjectId=1;  
 
  
  
-->Create Audit Table 

CREATE TABLE AuditTable( 
	AuditId Int IDENTITY(1,1) PRIMARY KEY, 
	TaskId INT, 
	OldStatus VARCHAR(20),
	NewStatus VARCHAR(20),
	Action DATETIME DEFAULT GETDATE() 
); 
update Task set Status=' NOT Completed' where TaskId = 2; 
  
 
  
  
CREATE TRIGGER trg_AuditTaskChanges 
ON Task 
AFTER UPDATE 
AS  
BEGIN
		INSERT INTO AuditTable(TaskId,OldStatus,NewStatus)
		SELECT d.TaskId,d.Status,i.Status
	    from deleted d inner join inserted i on d.TaskID=i.TaskID		
End; 
 
  
select*from AuditTable; 
 
select*from project; 
select*from task; 




DROP TRIGGER IF EXISTS trg_UpdateProjectStatus ;
DROP TABLE IF EXISTS AuditTable ;
DROP TRIGGER IF EXISTS trg_AuditTaskChanges ; 
 