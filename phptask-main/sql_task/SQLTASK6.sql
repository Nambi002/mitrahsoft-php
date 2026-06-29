USE nambivel;


DROP PROCEDURE IF EXISTS sp_insert
DROP PROCEDURE IF EXISTS sp_update
DROP PROCEDURE IF EXISTS sp_delete


--Insert--

CREATE OR ALTER PROCEDURE sp_insert(
@TaskId INT,
@TaskName VARCHAR(50),
@ProjectId INT,
@Description VARCHAR(100) ,
@StartDate DATE ,
@DueDate DATE,
@Priority VARCHAR(20),
@Status VARCHAR(25))
AS
		 BEGIN
	 		INSERT INTO Task(TaskName,ProjectId,Description,StartDate,DueDate,Priority,Status)
	 		VALUES(@TaskName,@ProjectId,@Description,@StartDate,@DueDate,@Priority,@Status)
		 END

		 EXEC sp_insert 12,'msd',2,'hello Csk fans','2024-06-13','2024-07-16','High','Completed';

		
		 select*from Task;


--Update--

CREATE OR ALTER PROCEDURE sp_update(
@TaskId INT=null,
@TaskName VARCHAR(50)=null,
@ProjectId INT =null,
@Description VARCHAR(100) =null,
@StartDate DATE=null ,
@DueDate DATE=null,
@Priority VARCHAR(20)=null,
@Status VARCHAR(25)=null)
AS
		  BEGIN
			UPDATE Task SET TaskName=@TaskName,Description=@Description,ProjectId=@ProjectId
			WHERE TaskId=@TaskId;
		 END

		 EXEC sp_update 12,'nambivelnathan',2,'hello everyone!','2024-06-12','2024-07-15','High','Pending';

		 select*from Task;


--Delete--

CREATE OR ALTER PROCEDURE sp_delete(
@TaskId INT=null,
@TaskName VARCHAR(50)=null,
@ProjectId INT =null,
@Description VARCHAR(100) =null,
@StartDate DATE=null ,
@DueDate DATE=null,
@Priority VARCHAR(20)=null,
@Status VARCHAR(25)=null)
AS
		   BEGIN
			DELETE FROM Task WHERE TaskId=@TaskId;
		   END

           EXEC  sp_delete 12;

           select*from Task;
	

		 

			  




