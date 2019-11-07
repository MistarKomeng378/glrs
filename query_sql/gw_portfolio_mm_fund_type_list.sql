USE [GLRS_New]
GO
/****** Object:  StoredProcedure [dbo].[gw_portfolio_mm_fund_type_list]    Script Date: 10/25/2019 00:53:06 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER procedure   [dbo].[gw_portfolio_mm_fund_type_list] 
	
as
set nocount on
begin	
	SELECT     mm_id, mm_name
	FROM         MMFundType
	ORDER BY mm_id
end