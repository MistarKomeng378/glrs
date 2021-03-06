USE [GLRS_New]
GO
/****** Object:  StoredProcedure [dbo].[gw_portfolio_get]    Script Date: 10/27/2019 15:02:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

ALTER procedure  [dbo].[gw_portfolio_get]
	@PortfolioCode  varchar(6)
as
set nocount on
begin	
	SELECT     a.PortfolioCode pfcode, a.PortfolioName pfname, a.FundManagerCode fmcode, a.CurrentYear curryear, a.GLCurrency cur, 
		 a.ActiveFlag flag, a.PricingHour time, a.MMFund mm,a.PORTFOLIOTYPE t,
		 a.PRICEDECIMAL pdec, a.NAVDECIMAL ndec, a.UNITDECIMAL udec,a.MAILFLAG mail, filecode filecode,
		 b. FundManagerName fmname, FUNDKIND_ORCHID fkind, FUNDTYPE_ORCHID ftype,
		 c.[type_name] ftypename,
		 d.kind_name fkindname,
		 e.mm_name mmname,
		 
		 a.SINVESTCODE,CREATE_REPORT crpt, coalesce(a.MAILFLAGXLS_TB,0) mailtb,coalesce(a.MAILFLAGXLS_VAL,0) mailval
	
	FROM         PortfolioTB AS a  left outer join FundManagerTB b on a.FundManagerCode=b.FundManagerCode
	left outer join OrchidTypeTB c on a.FUNDTYPE_ORCHID=c.[type_id]
	left outer join OrchidKindTB d on a.FUNDKIND_ORCHID=d.[kind_id]
	left outer join MMFundType e on a.PORTFOLIOTYPE=e.mm_id
	where a.PortfolioCode=@PortfolioCode
		
end

