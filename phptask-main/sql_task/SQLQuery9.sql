USE nambivel;


---- Query 1----


BEGIN TRY
	BEGIN TRANSACTION
	DECLARE @NewprojectID INT
		INSERT INTO Project(ProjectName,StartDate,EndDate,Budget,Status,ParentProjectId)
		VALUES  ('Website Redesigned', GETDATE(),NULL, 15000.00, 'Pending',NULL);
		SET @NewprojectID=SCOPE_IDENTITY();

		INSERT INTO Task(TaskName,Description,StartDate,DueDate,Priority,Status,ProjectId) 
		VALUES   ('Initial Design', 'Design phase for the new website', '2024-01-02', '2024-02-28', 'High', 'Completed', 1)
		COMMIT
	PRINT 'Transaction complete';
END TRY

BEGIN CATCH
	ROLLBACK;
	PRINT 'Transcation failed'+Error_message();
END CATCH




---- Query 2 ----


BEGIN TRY 
	BEGIN TRANSACTION
	DECLARE @TargetProjectId int=1
	DECLARE @NewBudget decimal(10,2)=30000
	 
		UPDATE Project SET Budget=@NewBudget WHERE ProjectId=@TargetProjectId;
	    UPDATE Task SET priority='High' WHERE ProjectId=@TargetProjectId;
		COMMIT
    PRINT 'Transaction complete ';
END TRY

BEGIN CATCH
	ROLLBACK;
    PRINT 'ERROR OCCUR ' + Error_message();
END CATCH



SELECT*FROM TASK;
SELECT*FROM PROJECT;


---- Query 3-----


CREATE or ALTER PROCEDURE Transact(
	@TaskId INT=null,
	@TaskName VARCHAR(50)= NULL,
	@ProjectId INT =null,
	@Description VARCHAR(100) =null,
	@StartDate DATE =null,
	@DueDate DATE =null,
	@Priority VARCHAR(20)=null,
	@Status VARCHAR(25)=null,
	@Action NVARCHAR(20)='')

AS
BEGIN
	 IF @Action ='Insert'
	 BEGIN
	 BEGIN TRY
	     IF(@TaskName IS NOT NULL AND @TaskId='')
		    PRINT('Task name should not be null and empty value')
		 ELSE IF(@ProjectId='')
		    PRINT('project id shoud not null')
		 ELSE IF(@StartDate>@DueDate)  
		    PRINT('due date is always greater than the start date')
		 ELSE IF(@Priority not in ('high','low','medium'))
		    PRINT('priority always in high,low and medium')

		 BEGIN TRANSACTION
	 		INSERT INTO Task(TaskName,ProjectId,Description,StartDate,DueDate,Priority,Status)
	 		VALUES(@TaskName,@ProjectId,@Description,@StartDate,@DueDate,@Priority,@Status)
			COMMIT;

	 END TRY
	 BEGIN CATCH
			ROLLBACK;
			PRINT 'Insert Error'+Error_message();
	 END CATCH                              
END;
 
	 IF @Action='Update'
BEGIN
	 BEGIN TRY
	 	 IF(@TaskName IS NOT NULL AND @TaskId='')
		    PRINT('Task name should not be null and empty value')
		 ELSE IF(@ProjectId='')
		    PRINT('project id shoud not null')

		 BEGIN TRANSACTION
			 UPDATE Task SET TaskName=@TaskName,Description=@Description,ProjectId=@ProjectId
			 WHERE TaskId=@TaskId;
			 COMMIT;
	 END TRY
	 BEGIN CATCH
			 ROLLBACK;
			 PRINT 'Update Error'+Error_message();
	 END CATCH
END;

	 IF @Action='Delete'
BEGIN    
	 BEGIN TRY
	     IF(@TaskId='')
	        PRINT('Task name should not be null and empty value')

		 BEGIN TRANSACTION
			DELETE FROM Task WHERE TaskId=@TaskId;
			COMMIT;
	 END TRY
	 BEGIN CATCH
			ROLLBACK;
			PRINT 'Delete Error'+Error_message();
	 END CATCH
END;

	 IF @Action='Select'
BEGIN
	 BEGIN TRY
		 BEGIN TRANSACTION
			SELECT * FROM Task;
		    COMMIT;
	 END TRY
	 BEGIN CATCH
		 ROLLBACK;
		 PRINT 'Select Error'+Error_message();
	 END CATCH
 END
END

EXEC Transact 21,'NAMBI',1,'GOOD','2026-01-11','2026-01-11','High','Good','Insert';

EXEC Transact 18,'NAMBIVEL',1,'WELCOME','2026-01-10','2026-02-11','Low','In Progress','Update';

EXEC Transact 19,'NAMBIVEL',1,'WELCOME','2026-01-10','2026-02-11','Low','In Progress','Delete';


Transact
    @Action ='Select'
	


