USE [Experiment]
GO

INSERT INTO [Experiment].[dbo].[user] ([name]) VALUES ('Dwayne')
GO
INSERT INTO [Experiment].[dbo].[user] ([name]) VALUES ('Nathan')
GO
INSERT INTO [Experiment].[dbo].[user] ([name]) VALUES ('David')
GO
INSERT INTO [Experiment].[dbo].[user] ([name]) VALUES ('Jeremy')
GO

INSERT INTO [Experiment].[dbo].[timeSlot] ([user_id], [year], [month], [day], [hour]) VALUES (1,2012,6,13,16)
GO
INSERT INTO [Experiment].[dbo].[timeSlot] ([user_id], [year], [month], [day], [hour]) VALUES (3,2012,6,13,16)
GO
INSERT INTO [Experiment].[dbo].[timeSlot] ([user_id], [year], [month], [day], [hour]) VALUES (3,2012,6,15,15)
GO
INSERT INTO [Experiment].[dbo].[timeSlot] ([user_id], [year], [month], [day], [hour]) VALUES (3,2012,6,15,16)
GO
INSERT INTO [Experiment].[dbo].[timeSlot] ([user_id], [year], [month], [day], [hour]) VALUES (2,2012,6,13,17)
GO
INSERT INTO [Experiment].[dbo].[timeSlot] ([user_id], [year], [month], [day], [hour]) VALUES (2,2012,6,14,10)
GO
INSERT INTO [Experiment].[dbo].[timeSlot] ([user_id], [year], [month], [day], [hour]) VALUES (2,2012,6,14,11)
GO
INSERT INTO [Experiment].[dbo].[timeSlot] ([user_id], [year], [month], [day], [hour]) VALUES (2,2012,6,15,10)
GO
INSERT INTO [Experiment].[dbo].[timeSlot] ([user_id], [year], [month], [day], [hour]) VALUES (2,2012,6,30,17)
GO
INSERT INTO [Experiment].[dbo].[timeSlot] ([user_id], [year], [month], [day], [hour]) VALUES (4,2012,6,14,9)
GO
INSERT INTO [Experiment].[dbo].[timeSlot] ([user_id], [year], [month], [day], [hour]) VALUES (4,2012,6,16,11)
GO
INSERT INTO [Experiment].[dbo].[timeSlot] ([user_id], [year], [month], [day], [hour]) VALUES (1,2012,6,15,11)
GO
INSERT INTO [Experiment].[dbo].[timeSlot] ([user_id], [year], [month], [day], [hour]) VALUES (1,2012,6,15,12)
GO
INSERT INTO [Experiment].[dbo].[timeSlot] ([user_id], [year], [month], [day], [hour]) VALUES (1,2012,6,15,14)
GO
INSERT INTO [Experiment].[dbo].[timeSlot] ([user_id], [year], [month], [day], [hour]) VALUES (1,2012,6,16,10)
GO
INSERT INTO [Experiment].[dbo].[timeSlot] ([user_id], [year], [month], [day], [hour]) VALUES (1,2012,6,17,10)
GO