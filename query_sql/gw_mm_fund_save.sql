USE [GLRS_New]
GO
/****** Object:  StoredProcedure [dbo].[gw_mm_fund_save]    Script Date: 10/24/2019 19:58:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER procedure  [dbo].[gw_mm_fund_save]
	@mm_id varchar(10), 
	@type_name varchar(100)
as
set nocount on
begin	
	if not exists(select [mm_id] from MMFundType where [mm_id]=@mm_id)
	begin
		--select @type_id = coalesce((select MAX(type_id)+1 from OrchidTypeTB),1)
		
		insert into MMFundType ([mm_id],[mm_name])
		values(@mm_id,@type_name)
	end
	
	else
	begin
		update MMFundType set [mm_name]=@type_name		
		where  [mm_id]=@mm_id
	end
end
