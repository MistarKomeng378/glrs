USE [GLRS_New]
GO
/****** Object:  StoredProcedure [dbo].[gw_mm_fund_list]    Script Date: 10/24/2019 18:29:37 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER procedure  [dbo].[gw_mm_fund_list]
	@type tinyint=0
as
set nocount on
begin	
	if @type=0
		SELECT [mm_id] tpcode, [mm_name] tpname
		FROM MMFundType
		order by [mm_id]
		
	else
		
		SELECT [mm_id] tpcode, [mm_name] tpname
		FROM MMFundType
		order by [mm_id]
	
end
