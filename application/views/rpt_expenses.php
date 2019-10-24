<hr />
<table width="100%">                                         
    <tr>
        <td><b><?php echo $r_pf[0]["pfname"];?></b></td>
        <td align="right"><b><?php echo $r_pf[0]["fmname"];?></b></td>
    </tr>
    <tr>            
        <td colspan="2">
            <table width="100%">
                <tr>
                    <td width="60" align="left"><?php echo $r_pf[0]["pfcode"];?></td>
                    <td align="center"><b>DAILY EXPENSES PAYABLE REPORT</b></td>
                    <td width="60" align="right"><?php echo $r_pf[0]["time"];?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>                                                                 
        <td colspan="2" align="center"><?php echo  date_format(date_create($dt),'F d, Y');
            echo isset($r_data[0])?$r_data[0]['APPROVED']==1?"<br />(<i>NAV Approved</i>)":"<br />(<i>NAV Not Approved</i>)":"";?></td>
    </tr>
</table>
<table width="100%">
    <tr>
        <td colspan="6" style="border-bottom: 1px double #000000; border-top: 1px solid #000000;">
            <table width="100%">
                <tr >
                    <td width="50%"><b>Expense Type</b></td>
                    <td width="50%" align="right"><b>Amount</b></td>
                </tr>
            </table>
        </td>
    </tr>    
    <?php $t1=0;$t2=0;$t3=0; foreach($r_data as $xitem) { $t1+=$xitem['TOTALUNTILLASTDATE'];$t2+=$xitem['TODAYSACCRUAL'];$t3+=$xitem['TOTALFROMSTARTOFMONTH']; ?>
    <tr>
        <td width="15">~</td>
        <td><?php echo $xitem['FEEDESCRIPTION'];?></td>
        <td width="15"></td>
        <td align="right" width="120"></td>
        <td width="15" align="right">Rp.</td>
        <td align="right" width="120"><?php echo number_format($xitem['TOTALFROMSTARTOFMONTH'],2,'.',',');?></td>
    </tr>
    <tr>
        <td></td>
        <td>Total accrued until the last date</td>
        <td align="right">Rp.</td>
        <td align="right" ><?php echo number_format($xitem['TOTALUNTILLASTDATE'],2,'.',',');?></td>
        <td></td>
        <td align="right"></td>
    </tr>
    <tr>
        <td></td>
        <td>This day accrual - <i><?php echo $xitem['NUMBEROFDAYS'];?> days </i></td>
        <td align="right">Rp.</td>
        <td align="right" ><?php echo number_format($xitem['TODAYSACCRUAL'],2,'.',',');?></td>
        <td ></td>
        <td align="right"></td>
    </tr>
    <?php } ?>
    <tr>
        <td colspan="6" style="border-bottom: 1px solid #000000;">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2"><b>Total until last date</b></td>
        <td ></td>
        <td align="right" ></td>
        <td align="right"><b>Rp.</b></td>
        <td align="right"><b><?php echo number_format($t1,2,'.',',');?></b></td>
    </tr>
    <tr>
        <td colspan="2"><b>Total this day accrual</b></td>
        <td ></td>
        <td align="right" ></td>
        <td align="right"><b>Rp.</b></td>
        <td align="right"><b><?php echo number_format($t2,2,'.',',');?></b></td>
    </tr>
    <tr>
        <td colspan="6" style="border-top: 1px solid #000000;">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2"><b>Total until last date</b></td>
        <td ></td>
        <td align="right" ></td>
        <td align="right"><b>Rp.</b></td>
        <td align="right"><b><?php echo number_format($t3,2,'.',',');?></b></td>
    </tr>
</table>
