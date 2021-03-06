USE [GLRS_New]
GO
/****** Object:  StoredProcedure [dbo].[gw_portfolio_list]    Script Date: 10/27/2019 15:02:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

ALTER procedure   [dbo].[gw_portfolio_list]
	@fm_code  varchar(6)='ALL',
	@type tinyint=0
as
set nocount on
begin	
	
	if @type=0
		SELECT     a.PortfolioCode pfcode, a.PortfolioName pfname, a.FundManagerCode fmcode, a.CurrentYear curryear, a.GLCurrency cur, 
			 a.ActiveFlag flag, a.PricingHour time, a.MMFund mm,a.PORTFOLIOTYPE t,
			 a.PRICEDECIMAL pdec, a.NAVDECIMAL ndec, a.UNITDECIMAL udec, 
			 b.FundManagerName fmname,a.MAILFLAG mail, a.filecode filecode,
			 FUNDKIND_ORCHID fkind, FUNDTYPE_ORCHID ftype,
			 c.[type_name] ftypename,
			 d.kind_name fkindname,
			 e.mm_name mmname,
			 a.SINVESTCODE,a.CREATE_REPORT crpt,a.CREATE_NAV cnav,coalesce(MAILFLAGXLS_TB,0) mailtb,coalesce(MAILFLAGXLS_VAL,0) mailval
		FROM         PortfolioTB AS a LEFT OUTER JOIN
						  FundManagerTB AS b ON a.FundManagerCode = b.FundManagerCode
		left outer join OrchidTypeTB c on a.FUNDTYPE_ORCHID=c.[type_id]
		left outer join OrchidKindTB d on a.FUNDKIND_ORCHID=d.[kind_id]
		left outer join MMFundType e on a.PORTFOLIOTYPE=e.mm_id
		where @fm_code='ALL' or a.FundManagerCode=@fm_code
		ORDER BY a.FundManagerCode,flag desc,a.PortfolioCode                
	else
	begin
		--if @fm_code = '_*_M'
		--begin
			
			SELECT     a.PortfolioCode pfcode, a.PortfolioName pfname,a.FundManagerCode fmcode
			FROM         PortfolioTB AS a 
			ORDER BY a.FundManagerCode,a.PortfolioCode
		--end
		--else
		--	SELECT     a.PortfolioCode pfcode, a.PortfolioName pfname,a.FundManagerCode fmcode
		--	FROM         PortfolioTB AS a 
		--	where @fm_code='ALL' or a.FundManagerCode=@fm_code
		--	ORDER BY a.PortfolioCode
	end
end


