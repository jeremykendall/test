USE [Experiment]
GO
/****** Object:  Table [dbo].[timeSlot]    Script Date: 06/14/2012 08:40:12 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[timeSlot](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[user_id] [int] NOT NULL,
	[year] [int] NOT NULL,
	[month] [int] NOT NULL,
	[day] [int] NULL,
	[hour] [int] NOT NULL
) ON [PRIMARY]


