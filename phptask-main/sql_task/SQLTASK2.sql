USE nambivel;

ALTER TABLE Project ADD  Description VARCHAR(150) NOT NULL Default '';



EXEC sp_rename 'Project.Description',  'ProjectDescription', 'COLUMN';



ALTER TABLE Project ALTER COLUMN ProjectDescription VARCHAR(150) Null;

SELECT*FROM Project; 




