use nambivel;


----Views1----

CREATE VIEW vw_ActiveProjects

AS
SELECT * FROM Project WHERE  EndDate IS NULL ;

SELECT * FROM vw_ActiveProjects;


----Views2----

CREATE VIEW  vw_HighPriorityTasks

AS
SELECT * FROM Task where priority='High';

SELECT * FROM vw_HighPriorityTasks;


----CURSORS1----

BEGIN 
DECLARE @ProjectName VARCHAR(100)

DECLARE cursor_products CURSOR FOR SELECT ProjectName FROM Project ;
BEGIN

OPEN cursor_products;

FETCH NEXT FROM cursor_products INTO @ProjectName
 
    WHILE @@FETCH_STATUS = 0
    BEGIN
       SELECT @ProjectName AS ProjectName 
       
        FETCH NEXT FROM cursor_products INTO  @ProjectName
          
    END

    CLOSE cursor_products;
    DEALLOCATE cursor_products;
END
END 

----CURSORS2----

DECLARE @TaskId INT,@DueDate DATE,@Status varchar(20)

DECLARE OverDue_task CURSOR 
FOR SELECT TaskId,DueDate,Status FROM Task


OPEN OverDue_task;

FETCH NEXT FROM OverDue_task INTO @TaskId,@DueDate,@Status
   
    WHILE @@FETCH_STATUS = 0
    BEGIN
   
        IF  GETDATE()>@DueDate
        
        BEGIN
        Update Task SET Status = 'overdue' WHERE TaskId=@TaskId;

        END

        SELECT @TaskId as TaskId,@DueDate as DueDate,@Status as Status

        FETCH NEXT FROM OverDue_task INTO @TaskId,@DueDate,@Status
          
    END

    CLOSE OverDue_task;
    DEALLOCATE OverDue_task;


