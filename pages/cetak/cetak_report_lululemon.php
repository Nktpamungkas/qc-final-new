<?php
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";
$idkk=$_GET['idkk'];
$noitem=$_GET['noitem'];
$nohanger=$_GET['nohanger'];
$now=date("Y-m-d");
$data=mysqli_query($con,"SELECT 
                                *,
	                            CONCAT_WS(' ',fc_note,ph_note, abr_note, bas_note, fla_note, fwe_note, fwi_note, burs_note,repp_note,apper_note,fiber_note,pillb_note,pillm_note,pillr_note,thick_note,growth_note,recover_note,stretch_note,sns_note,snab_note,snam_note,snap_note,wash_note,water_note,acid_note,alkaline_note,crock_note,phenolic_note,cm_printing_note,cm_dye_note,light_note,light_pers_note,saliva_note,h_shrinkage_note,fibre_note,pilll_note,soil_note,apperss_note,bleeding_note,chlorin_note,dye_tf_note) AS note_g 
                            FROM tbl_tq_test 
                                WHERE id_nokk='$idkk' 
                            ORDER BY id DESC LIMIT 1");
$rcek1=mysqli_fetch_array($data);
$databs=mysqli_query($con,"SELECT 
                                *,
                                CONCAT_WS(' ',bas_note) AS note_bs 
                            FROM tbl_tq_test 
                                WHERE id_nokk='$idkk' 
                            ORDER BY id DESC LIMIT 1");
$rcekbs=mysqli_fetch_array($databs);
$sqlCekR=mysqli_query($con,"SELECT *,
	CONCAT_WS(' ',rfc_note,rph_note, rabr_note, rbas_note, rfla_note, rfwe_note, rfwi_note, rburs_note,rrepp_note,rapper_note,rfiber_note,rpillb_note,rpillm_note,rpillr_note,rthick_note,rgrowth_note,rrecover_note,rstretch_note,rsns_note,rsnab_note,rsnam_note,rsnap_note,rwash_note,rwater_note,racid_note,ralkaline_note,rcrock_note,rphenolic_note,rcm_printing_note,rcm_dye_note,rlight_note,rlight_pers_note,rsaliva_note,rh_shrinkage_note,rfibre_note,rpilll_note,rsoil_note,rapperss_note,rbleeding_note,rchlorin_note,rdye_tf_note) AS rnote_g FROM tbl_tq_randomtest WHERE no_item='$noitem' OR no_hanger='$nohanger'");
$rcekR=mysqli_fetch_array($sqlCekR);
$sqlCekD=mysqli_query($con,"SELECT *,
	CONCAT_WS(' ',dfc_note,dph_note, dabr_note, dbas_note, dfla_note, dfwe_note, dfwi_note, dburs_note,drepp_note,dapper_note,dfiber_note,dpillb_note,dpillm_note,dpillr_note,dthick_note,dgrowth_note,drecover_note,dstretch_note,dsns_note,dsnab_note,dsnam_note,dsnap_note,dwash_note,dwater_note,dacid_note,dalkaline_note,dcrock_note,dphenolic_note,dcm_printing_note,dcm_dye_note,dlight_note,dlight_pers_note,dsaliva_note,dh_shrinkage_note,dfibre_note,dpilll_note,dsoil_note,dapperss_note,dbleeding_note,dchlorin_note,ddye_tf_note) AS dnote_g FROM tbl_tq_disptest WHERE id_nokk='$idkk' ORDER BY id DESC LIMIT 1");
$rcekD=mysqli_fetch_array($sqlCekD);
$sqlCekM=mysqli_query($con,"SELECT *,
	CONCAT_WS(' ',mfc_note,mph_note, mabr_note, mbas_note, mdry_note, mfla_note, mfwe_note, mfwi_note, mburs_note,mrepp_note,mwick_note,mabsor_note,mapper_note,mfiber_note,mpillb_note,mpillm_note,mpillr_note,mthick_note,mgrowth_note,mrecover_note,mstretch_note,msns_note,msnab_note,msnam_note,msnap_note,mwash_note,mwater_note,macid_note,malkaline_note,mcrock_note,mphenolic_note,mcm_printing_note,mcm_dye_note,mlight_note,mlight_pers_note,msaliva_note,mh_shrinkage_note,mfibre_note,mpilll_note,msoil_note,mapperss_note,mbleeding_note,mchlorin_note,mdye_tf_note,mhumidity_note,modour_note) AS mnote_g FROM tbl_tq_marginal WHERE id_nokk='$idkk' ORDER BY id DESC LIMIT 1");
$rcekM=mysqli_fetch_array($sqlCekM);
$data1=mysqli_query($con,"SELECT nokk FROM tbl_tq_nokk WHERE id='$idkk'");
$rd=mysqli_fetch_array($data1);
$data2=mysqli_query($con,"SELECT 
                                n.*,
                                t.running_color,
                                t.running_quality
                            FROM tbl_tq_nokk n
                                LEFT JOIN tbl_tq_nokk2 t on t.id_tq2 = n.id
                            WHERE id='$idkk'");
$rd2=mysqli_fetch_array($data2);

$id_tq_test_2 = $rcek1['id_nokk'];

$tq_test_2_sql = mysqli_query($con, "select id_nokk, spirality_status, bleeding_root, wrinkle, wrinkle1, wrinkle2, stat_wrinkle, stat_wrinkle1, wrinkle_note from tbl_tq_test_2 where id_nokk = '$id_tq_test_2'");
$tq_test_2_array = mysqli_fetch_array($tq_test_2_sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles_cetak.css" rel="stylesheet" type="text/css">
<title>Print Report Lululemon</title>
<style>
.hurufvertical {
 writing-mode:tb-rl;
    -webkit-transform:rotate(-90deg);
    -moz-transform:rotate(-90deg);
    -o-transform: rotate(-90deg);
    -ms-transform:rotate(-90deg);
    transform: rotate(180deg);
    white-space:nowrap;
    float:left;
}	

input{
text-align:center;
border:hidden;
}

@media print {
  ::-webkit-input-placeholder { /* WebKit browsers */
      color: transparent;
  }
  :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
      color: transparent;
  }
  ::-moz-placeholder { /* Mozilla Firefox 19+ */
      color: transparent;
  }
  :-ms-input-placeholder { /* Internet Explorer 10+ */
      color: transparent;
  }
  .pagebreak { page-break-before:always; }
  .header {display:block}
  table thead 
   {
    display: table-header-group;
   }
   body {
        -webkit-print-color-adjust: exact !important; /* Chrome, Safari */
        color-adjust: exact !important; /*Firefox*/
        }
 select {
    display: none; /* sembunyikan select saat print */
  }
  .print-value {
    display: inline; /* tampilkan span pengganti */
    color: black;
    font-size: 11px;
  }
}
  
  select {
      border: none;
      background: none;
      appearance: none;
  }
  select:after {
      content: attr(value); /* tampilkan value terpilih */
      color: black;
      font-size: 11px;
  }

textarea { 
    border-style: none; 
    border-color: Transparent; 
    overflow: auto;        
  }
</style>
</head>
<body>
    <table width="100%">
        <!-- Page 1 Begin -->
        <tr>
            <td><table width="100%" border="0" class="table-list1"> 
                <tr>
                    <td width="10%" align="right" 
                    style="border-top:0px #000000 solid; 
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid;"><img src="ITTI_Logo.png" width="60" height="59" alt=""/></td>
                    <td align="center" style="font-size: 60px; border-top:0px #000000 solid; 
                    border-left:0px #000000 solid; 
                    border-right:0px #000000 solid; font-family: Times New Roman;" width="90%"><strong>REPORT</strong></td>
                </tr>
            </table></td>
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>  
        <tr>
            <td align="right" style="font-size: 12px;"><?php echo $rd2['no_rptlulu'];?><?php if($rd2['sts_rev']=="1" AND $rd2['revisi']!=""){echo "-".$rd2['revisi'];}?></td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">Page 1 of 9</td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;"><?php echo date("F j, Y", strtotime($rd2['date_out1']));?></td> 
        </tr>
        <tr>
            <!-- <td align="right" style="font-size: 12px;">&nbsp;</td>  -->
            <td align="right" style="font-size: 12px;" colspan="4">
                <table width="35%" style="border: 3px solid #555;">
                    <tr>
                        <td align="center" style="font-size: 12px;" colspan="2"><u>OVERALL RATING</u></td>
                    </tr>
                    <tr>
                        <td align="center" style="font-size: 12px;">PASS</td>
                        <td align="center" style="font-size: 12px;"><u><?php if($rcek1['status']=="Pass"){echo "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; X &nbsp; &nbsp; &nbsp; &nbsp;";}else{echo "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";}?></u></td>
                    </tr>
                    <tr>
                        <td align="center" style="font-size: 12px;">ESS PASS</td>
                        <td align="center" style="font-size: 12px;"><u><?php if($rcek1['status']=="Marginal Pass"){echo "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; X &nbsp; &nbsp; &nbsp; &nbsp;";}else{echo "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";}?></u></td>
                    </tr>
                    <tr>
                        <td align="center" style="font-size: 12px;">FAIL</td>
                        <td align="center" style="font-size: 12px;"><u><?php if($rcek1['status']=="Fail"){echo "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; X &nbsp; &nbsp; &nbsp; &nbsp;";}else{echo "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";}?></u></td>
                    </tr>
                </table>
            </td> 
        </tr>  
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>  
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>  
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;"><img src="../../dist/img-rptlulu/<?php echo $rd2['cover'];?>" style="border: 4px solid #555;" height="400" alt=""/></td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>  
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>  
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>  
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="center" style="font-size: 15px;"><strong>PT. INDO TAICHEN TEXTILE INDUSTRY</strong></td> 
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;">Knitting, Dyeing, Finishing, Printing</td> 
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;">Jl. Gatot Subroto KM. 3 Kel. Uwung Jaya, Cibodas, Tangerang, Banten, 15138, P.O BOX 487</td> 
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;">Phone : (021) 5520920 (Hunting), FAX : (021) 5523763, 55790329, 5520035</td> 
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;">E-mail : qcf@indotaichen.com | Website: www.indotaichen.com</td> 
        </tr>
    </table>
    <div class="pagebreak"></div>
        <!-- Page 1 End -->
        <!-- Page 2 Begin -->        
    <table width="100%">
        <tr>
            <td align="right" style="font-size: 23px; font-family: Times New Roman;" colspan="4">TEST REPORT</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="50%" rowspan="3"><img src="ITTI_Logo.png" width="60" height="59" alt=""/></td> 
            <td align="right" style="font-size: 12px;" width="35%">DATE OUT</td> 
            <td align="right" style="font-size: 12px;" width="3%">:</td> 
            <td align="right" style="font-size: 12px;" width="25%"><?php echo date("F j, Y", strtotime($rd2['date_out1']));?></td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;" width="35%">REPORT NO</td> 
            <td align="right" style="font-size: 12px;" width="3%">:</td> 
            <td align="right" style="font-size: 12px;" width="25%"><?php echo $rd2['no_rptlulu'];?><?php if($rd2['sts_rev']=="1" AND $rd2['revisi']!=""){echo "-".$rd2['revisi'];}?></td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;" width="35%">DATE IN</td> 
            <td align="right" style="font-size: 12px;" width="3%">:</td> 
            <td align="right" style="font-size: 12px;" width="25%"><?php echo date("F j, Y", strtotime($rd2['date_in']));?></td> 
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;" colspan="4">&nbsp;</td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;" colspan="4">
                <!-- <table width="35%" style="border: 3px solid #555;">
                    <tr>
                        <td align="center" style="font-size: 12px;" colspan="2"><u>OVERALL RATING</u></td>
                    </tr>
                    <tr>
                        <td align="center" style="font-size: 12px;">PASS</td>
                        <td align="center" style="font-size: 12px;"><u><?php if($rcek1['status']=="Pass"){echo "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; X &nbsp; &nbsp; &nbsp; &nbsp;";}else{echo "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";}?></u></td>
                    </tr>
                    <tr>
                        <td align="center" style="font-size: 12px;">MARGINAL PASS</td>
                        <td align="center" style="font-size: 12px;"><u><?php if($rcek1['status']=="Marginal Pass"){echo "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; X &nbsp; &nbsp; &nbsp; &nbsp;";}else{echo "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";}?></u></td>
                    </tr>
                    <tr>
                        <td align="center" style="font-size: 12px;">FAIL</td>
                        <td align="center" style="font-size: 12px;"><u><?php if($rcek1['status']=="Fail"){echo "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; X &nbsp; &nbsp; &nbsp; &nbsp;";}else{echo "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";}?></u></td>
                    </tr>
                </table> -->
            </td> 
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;" colspan="4">&nbsp;</td> 
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;" colspan="4">&nbsp;</td> 
        </tr>
    </table>
    <!-- <table width="100%" border="1" class="table-list1">
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Vendor Name:</td>
            <td align="left" style="font-size: 12px;" width="25%">PT INDOTAICHEN</td>
            <td align="left" style="font-size: 12px;" width="25%">Vendor Code:</td>
            <td align="left" style="font-size: 12px;" width="25%">/</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Factory Name:</td>
            <td align="left" style="font-size: 12px;" width="25%">/</td>
            <td align="left" style="font-size: 12px;" width="25%">Factory Code:</td>
            <td align="left" style="font-size: 12px;" width="25%">/</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Fabric Mill Name:</td>
            <td align="left" style="font-size: 12px;" width="25%">INDOTAICHEN</td>
            <td align="left" style="font-size: 12px;" width="25%">Fabric Mill Code:</td>
            <td align="left" style="font-size: 12px;" width="25%">INDO01</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Trim Supplier Name:</td>
            <td align="left" style="font-size: 12px;" width="25%">/</td>
            <td align="left" style="font-size: 12px;" width="25%">Trim Supplier Code:</td>
            <td align="left" style="font-size: 12px;" width="25%">/</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Sample Name &amp; Description:</td>
            <td align="left" style="font-size: 12px;" width="25%"><?php echo $rd2['jenis_kain'];?></td>
            <td align="left" style="font-size: 12px;" width="25%">Protocol(s) used:</td>
            <td align="left" style="font-size: 12px;" width="25%">Apparel Fabric Performance Std - <?php echo $rd2['protocol']; ?></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Phase:</td>
            <td align="left" style="font-size: 12px;" width="25%">BULK FABRIC</td>
            <td align="left" style="font-size: 12px;" width="25%">Color Description:</td>
            <td align="left" style="font-size: 12px;" width="25%"><?php echo $rd2['warna'];?></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Color Code:</td>
            <td align="left" style="font-size: 12px;" width="25%">/</td>
            <td align="left" style="font-size: 12px;" width="25%">Color Abbreviation:</td>
            <td align="left" style="font-size: 12px;" width="25%"><?php echo $rd2['color_abbrev'];?></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Brand:</td>
            <td align="left" style="font-size: 12px;" width="25%">LULULEMON</td>
            <td align="left" style="font-size: 12px;" width="25%">PO#:</td>
            <td align="left" style="font-size: 12px;" width="25%"><?php echo $rd2['no_po'];?></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Style No:</td>
            <td align="left" style="font-size: 12px;" width="25%"><?php echo $rd2['style'];?></td>
            <td align="left" style="font-size: 12px;" width="25%">Category:</td>
            <td align="left" style="font-size: 12px;" width="25%">/</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">First Hand Over Date:</td>
            <td align="left" style="font-size: 12px;" width="25%">/</td>
            <td align="left" style="font-size: 12px;" width="25%">Season:</td>
            <td align="left" style="font-size: 12px;" width="25%"><?php echo $rd2['season'];?></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Countries of Distribution:</td>
            <td align="left" style="font-size: 12px;" width="25%">/</td>
            <td align="left" style="font-size: 12px;" width="25%">Country of Origin:</td>
            <td align="left" style="font-size: 12px;" width="25%">INDONESIA</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Trim(s) Article No:</td>
            <td align="left" style="font-size: 12px;" width="25%">/</td>
            <td align="left" style="font-size: 12px;" width="25%">Supplier Article No:</td>
            <td align="left" style="font-size: 12px;" width="25%"><?php echo $rd2['no_item'];?></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Weight:</td>
            <td align="left" style="font-size: 12px;" width="25%"><?php echo $rd2['gramasi']." G/M2";?></td>
            <td align="left" style="font-size: 12px;" width="25%">Lot#:</td>
            <td align="left" style="font-size: 12px;" width="25%"><?php echo $rd2['lot'];?></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Intent Fabric Use</td>
            <td align="left" style="font-size: 12px;" width="25%">/</td>
            <td align="left" style="font-size: 12px;" width="25%">Fabric Count:</td>
            <td align="left" style="font-size: 12px;" width="25%">/</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">(shell/lining)</td>
            <td align="left" style="font-size: 12px;" width="25%">/</td>
            <td align="left" style="font-size: 12px;" width="25%">&nbsp;</td>
            <td align="left" style="font-size: 12px;" width="25%">/</td>
        </tr>
        <tr>
            <?php
                $sqljk = "SELECT jenis_kain From tbl_tq_nokk WHERE id='$idkk'";
                $resultjk=mysqli_query($con,$sqljk);
                while($rowjk=mysqli_fetch_array($resultjk)){ 
                $detailjk=explode(",",$rowjk['jenis_kain']);?>
            <td align="left" style="font-size: 12px;" width="25%">Fabric Construction:</td>
            <td align="left" style="font-size: 12px;" width="25%"><?php if($detailjk[0]!=""){echo $detailjk[0];}else{echo "";}?></td>
            <td align="left" style="font-size: 12px;" width="25%">Fabric Type:</td>
            <td align="left" style="font-size: 12px;" width="25%"><?php if($detailjk[1]!=""){echo $detailjk[1];}else{echo "";}?></td>
            <?php }?>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Special Claim(s):</td>
            <td align="left" style="font-size: 12px;" width="25%">/</td>
            <td align="left" style="font-size: 12px;" width="25%">Fabric Finish:</td>
            <td align="left" style="font-size: 12px;" width="25%"><?php echo $rd2['fabric_finish'];?></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Delivery Date:</td>
            <td align="left" style="font-size: 12px;" width="25%"><?php echo $rd2['tgl_kirim'];?></td>
            <td align="left" style="font-size: 12px;" width="25%">End Use:</td>
            <td align="left" style="font-size: 12px;" width="25%"><?php echo $rd2['enduse'];?></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Test Package:</td>
            <td align="left" style="font-size: 12px;" width="25%"><?php echo $rd2['test_package'];?></td>
            <td align="left" style="font-size: 12px;" width="25%">Others:</td>
            <td align="left" style="font-size: 12px;" width="25%">/</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Previous Report no(s):</td>
            <td align="left" style="font-size: 12px;" width="25%"><?php echo $rd2['prev_report'];?></td>
            <td align="left" style="font-size: 12px;" width="25%">Retest Report No:</td>
            <td align="left" style="font-size: 12px;" width="25%">/</td>
        </tr>
    </table>
    <table width="100%" border="1" class="table-list1">
        <tr>
            <?php
                $sqljk1 = "SELECT jenis_kain From tbl_tq_nokk WHERE id='$idkk'";
                $resultjk1=mysqli_query($con,$sqljk1);
                while($rowjk1=mysqli_fetch_array($resultjk1)){ 
                $detailjk1=explode(",",$rowjk1['jenis_kain']);?>
            <td align="left" style="font-size: 12px;" width="25%">Submitted Fiber Content</td>
            <td align="left" style="font-size: 12px;" width="75%"><?php if($detailjk1[0]!=""){echo $detailjk1[0];}else{echo "";}?></td>
            <?php }?>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Actual Fiber Content</td>
            <td align="left" style="font-size: 12px;" width="75%">/</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Suggested Fiber Content</td>
            <td align="left" style="font-size: 12px;" width="75%">/</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Submitted Care Instruction(s)</td>
            <td align="left" style="font-size: 12px;" width="75%">MACHINE WASH COLD, DO NOT BLEACH, TUMBLE DRY LOW, DO NOT IRON, DO NOT DRY CLEAN</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Targeted Care Instruction</td>
            <td align="left" style="font-size: 12px;" width="75%">/</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="25%">Suggested Care Instruction(s)</td>
            <td align="left" style="font-size: 12px;" width="75%">/</td>
        </tr>
    </table> -->
    
    <!-- Additional Information -->
    <table class="table-list1">
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Applicant Name:</td>
            <td>PT INDOTAICHEN TEXTILE INDUSTRY </td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Sample Description:</td>
            <td><?php if($rd2['test_package']=='Full Package'){
                echo 'SAMPLE FABRIC FOR FULLTEST';
            }else if($rd2['test_package']=='Additional Color Package'){
                echo 'SAMPLE FABRIC FOR ADDITIONAL COLOR';
            }else if($rd2['test_package']=='Bulk Production'){
                echo 'SAMPLE FABRIC FOR BULK PRODUCTION';
            } else if ($rd2['test_package'] == 'Partial Test') {
                echo 'SAMPLE FABRIC FOR ONSITE AUDIT';
            }
            ?></td>
            <!-- <td>SAMPLE FABRIC FOR ADDITIONAL COLOR</td> -->
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Brand:</td>
            <td>LULULEMON</td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">TRF number:</td>
            <td><?php echo $rd2['no_trf']; ?></td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Supplier Article No:</td>
            <td><?php echo $rd2['no_item'];?></td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Phase:</td>
            <td>BULK FABRIC</td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Test package:</td>
            <!-- <td>ADDITIONAL COLOR PACKAGE</td> -->
             <td><?= strtoupper($rd2['test_package']);?></td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Product type:</td>
            <td>
                <?php
                $protocolText = $rd2['protocol'] ?? '';

                if ($protocolText == "Predominanly Synthetic" || $protocolText == "Predominanly Natural") {
                    $protocolText = "Knit " . $protocolText;
                }

                echo $protocolText;
                ?>
                - <?php echo $rd2['enduse'] ?? ''; ?>
            </td>
            </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Season/Year:</td>
            <td><?php echo $rd2['season']; ?></td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Lululemon Vendor Code:</td>
            <td>INDO01</td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">LLL Material Name:</td>
            <?php 
                $query = mysqli_query($con,"select * from master_matrialname where item='$rd2[no_item]'");
                $datamatrial = mysqli_fetch_array($query);
            ?>
            <td><?php echo $datamatrial['matrial_name'];?></td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Material Weight:</td>
            <td><?php echo $rd2['gramasi']; ?></td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Special Performance Claim:</td>
            <td><?php echo $rd2['fabric_finish']; ?></td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Fabric Type:</td>
            <td> Weft knit</td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Color:</td>
            <td><?php echo $rd2['warna']; ?></td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Is this Sensitif Color:</td>
            <td><?php echo $rd2['sensitif_color']; ?></td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Lot#:</td>
            <td><?php echo $rd2['lot']; ?></td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Latest Development Test Report Number:</td>
            <td>-</td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Latest Full Package Test Report Number:</td>
            <td><?php echo $rd2['prev_report']; ?></td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Latest Fail Test Report Number:</td>
            <td>-</td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Provide Report#(s) below for Accredited Supplier/Mill Partial Report:</td>
            <td>-</td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Submitted Fiber Content:</td>
            <td><?php echo explode(",", $rd2['jenis_kain'])[0]; ?></td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Restricted Substance Testing (By Material Type):</td>
            <td><?php echo $rd2['restricted_substance']; ?></td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Exmill date (MM/DD/YYYY):</td>
            <td><?php echo date("m/d/Y", strtotime($rd2['tgl_kirim'])); ?></td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Test Protocol:</td>
             <td>
                <?php
                $protocolText = $rd2['protocol'] ?? '';

                if ($protocolText == "Predominanly Synthetic" || $protocolText == "Predominanly Natural") {
                    $protocolText = "Knit " . $protocolText;
                }

                echo $protocolText;
                ?>
                - <?php echo $rd2['enduse'] ?? ''; ?>
            </td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">FGV :</td>
            <td><?php echo $rd2['pelanggan']; ?></td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">QTY:</td>
            <td><?php echo $rd2['qty']; ?></td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">New/Running Quality:</td>
            <td><?= $rd2['running_quality']?></td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">New/Running Color:</td>
            <td><?= $rd2['running_color']?></td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Root Cause (for retest order):</td>
            <td>N/A</td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Action Plan(for retest order):</td>
            <td>N/A</td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Style:</td>
            <td><?php echo $rd2['style']; ?></td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Test Performing Date:</td>
            <td><?php echo date("m/d/Y", strtotime($rd2['date_in'])); ?> - <?php echo date("m/d/Y", strtotime($rd2['date_out1'])); ?></td> <!-- ganti date_out dari input depan halaman -->
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Applicant's Submitted Care Instruction</td>
            <td>MACHINE WASH COLD, TUMBLE DRY LOW</td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Suggested Care Instruction</td>
            <td>-</td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Test Result(S)</td>
            <td>Unless otherwise stated the results shown in this test report refer only to the sample (s) tested, for further details, please refer to the folllowing page(s)</td>
        </tr>
        <tr>
            <td class="narrow-column" style="font-size: 12px;">Report Expiration Date</td>
            <td>
                <?php
                if (!empty($rd2['date_out1'])) {
                    $dt = new DateTime($rd2['date_out1']);
                    $dt->modify('+1 year');
                    $dt->modify('-1 day');
                    echo $dt->format('m/d/Y');
                } else {
                    echo '';
                }
                ?>
            </td>
        </tr>
    </table>
    <div class="pagebreak"></div>
    <!-- Page 2 End -->
    <!-- Page 3 Begin -->
    <table width="100%">
        <tr>
            <td align="right" style="font-size: 12px;"><?php echo $rd2['no_rptlulu'];?><?php if($rd2['sts_rev']=="1" AND $rd2['revisi']!=""){echo "-".$rd2['revisi'];}?></td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">Page 3 of 9</td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;"><?php echo date("F j, Y", strtotime($rd2['date_out1']));?></td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>
    </table>
    <table width="100%" border="1" class="table-list1">
        <!-- <thead>
            <tr>
                <td align="center" style="font-size: 12px;" width="30%"><strong>TEST PROPERTY</strong></td>
                <td align="center" style="font-size: 12px;" width="10%"><strong>PASS</strong></td>
                <td align="center" style="font-size: 12px;" width="15%"><strong>ESS PASS</strong></td>
                <td align="center" style="font-size: 12px;" width="10%"><strong>FAIL</strong></td>
                <td align="center" style="font-size: 12px;" width="10%"><strong>DATA</strong></td>
                <td align="center" style="font-size: 12px;" width="15%"><strong>COMMENTS</strong></td>
            </tr>
        </thead> -->
        <tbody>
            <tr>
                <td align="left" style="font-size: 12px;" colspan="1"><strong>TEST PROTOCOL</strong></td>
                <td align="left" style="font-size: 12px;" colspan="2">
                   <strong><?php
                   $protocolText = $rd2['protocol'] ?? '';

                   if ($protocolText == "Predominanly Synthetic" || $protocolText == "Predominanly Natural") {
                       $protocolText = "Knit " . $protocolText;
                   }

                   echo $protocolText;
                   ?></strong> 
                </td>
            </tr>           
            <tr>
                <td align="left" style="font-size: 12px;" colspan="1"><strong>TEST NAME</strong></td>
                <td align="center" style="border-left:0; border-right:0; border-top:0; border-bottom:0;"></td>  
                <td align="center" style="font-size: 12px; border-left:0;" colspan="2"><strong> OVERALL RATING</strong></td>    
            </tr>
            <tr>
                <td align="left" style="font-size: 12px;">PH VALUE<!--PH Value in textile--></td>
                <td align="left" style="font-size: 12px;" >AATCC TM81-2022</td>
                <td align="left" style="font-size: 12px;"><?php if ($rcek1['stat_ph'] == "PASS") {
                    echo "PASS";
                } else if ($rcek1['stat_ph'] == "ESS PASS") {
                    echo "ESS PASS";
                } else if ($rcek1['stat_ph'] == "FAIL") {
                    echo "FAIL";
                } elseif ($rcek1['stat_ph'] == "DATA") {
                    echo "DATA";
                } else if ($rcek1['stat_ph'] == "") {
                    echo "N/A";
                } else if ($rcek1['stat_ph'] != "") {
                    echo $rcekM['mph_note'];
                } else {
                    echo "N/A";
                }?>                
                </td>
            </tr>            
            <tr>
                <td align="left" style="font-size: 12px;">FABRIC WEIGHT PER UNIT AREA</td>
                <td align="left" style="font-size: 12px;" >ASTM D3776/D3776M OPTION C-20 (REAPPROVED 2025)</td>
                <td align="left" style="font-size: 12px;">
                    <?php 
                    if($rcek1['stat_fwss2']=="PASS"){echo "PASS";}
                    else if($rcek1['stat_fwss2']=="ESS PASS"){echo "ESS PASS";}
                    else if ($rcek1['stat_fwss2'] == "FAIL") {echo "FAIL";}
                    else if ($rcek1['stat_fwss2'] == "DATA") {echo "DATA ONLY";} 
                    elseif ($rcek1['stat_fwss2'] == "") {
                        echo "N/A";
                    } else if ($rcek1['stat_fwss2'] != "") {
                        echo $rcekM['mfwe_note'];
                    } else {
                        echo "N/A";
                    }
                    ?>
                </td>
            </tr>
            <tr>`
                <td align="left" style="font-size: 12px;">FABRIC WIDTH</td>
                <td align="left" style="font-size: 12px;" >ASTM D3774 OPTION B-18 (REAPPROVED 2024)</td>
                <td align="left" style="font-size: 12px;<?php echo (($rcek1['stat_fwss3'] ?? '') == 'FAIL') ? 'color:red;font-weight:bold;' : ''; ?>">
                    <?php if($rcek1['stat_fwss3']=="PASS"){echo "PASS";}                    
                    else if ($rcek1['stat_fwss3'] == "ESS PASS") {
                        echo "ESS PASS";
                    } else if ($rcek1['stat_fwss3'] == "FAIL") {
                        echo "FAIL";
                    } else if ($rcek1['stat_fwss3'] == "DATA") {
                        echo "DATA ONLY";
                    } else if ($rcek1['stat_fwss3'] == "") {
                        echo "N/A";
                    } else if ($rcek1['stat_fwss3'] != "" && $rcekM['mfwi_note']=="") {
                        echo $rcekM['mfwi_note'] . 'DATA ONLY';
                    }else if ($rcek1['stat_fwss3'] != "" && $rcekM['mfwi_note'] != "") {
                        echo $rcekM['mfwi_note'];
                    }else {
                        echo "N/A";
                    } ?>                
                </td>                
            </tr>
            <tr>
                <td align="left" style="font-size: 12px;">DIMENSIONAL STABILITY TO WASHING</td>
                <td align="left" style="font-size: 12px;" >AATCC TM135-2018T</td>
                <td align="left" style="font-size: 12px;<?php echo (($rcek1['stat_fwss'] ?? '') == 'FAIL') ? 'color:red;font-weight:bold;' : ''; ?>">
                    <?php if($rcek1['stat_fwss']=="PASS"){echo "PASS";}
                    else if ($rcek1['stat_fwss'] == "ESS PASS") {
                        echo "ESS PASS";
                    }else if($rcek1['stat_fwss']=="FAIL"){echo "FAIL";}
                    else if ($rcek1['stat_fwss'] == "DATA") {
                        echo "DATA ONLY";
                    } else if ($rcek1['stat_fwss'] == "") {
                        echo "N/A";
                    } else if ($rcek1['stat_fwss'] != "") {
                        echo $rcekM['msns_note'];
                    } else {
                        echo "N/A";
                    }?>                
                </td>
              </tr>
            <tr>
                <td align="left" style="font-size: 12px;">SKEWNESS / TWIST AFTER WASHING <!--FROM HOME LAUNDERING--></td>
                <td align="left" style="font-size: 12px;" >AATCC TM179-2023</td>
                <td align="left" style="font-size: 12px;<?php echo (($rcek1['stat_fwss'] ?? '') == 'FAIL') ? 'color:red;font-weight:bold;' : ''; ?>">
                    <?php if($rcek1['stat_fwss']!=""){echo "PASS";}
                    else if ($rcek1['stat_fwss'] == "") {
                        echo "N/A";
                    } else{echo "N/A";}?></td>
            </tr>
            <tr>
                <td align="left" style="font-size: 12px;">BOW &amp; SKEW</td>
                <td align="left" style="font-size: 12px;" >ASTM D3882-08-2025</td>
                <td align="left" style="font-size: 12px;<?php echo (($rcek1['stat_bsk'] ?? '') == 'FAIL') ? 'color:red;font-weight:bold;' : ''; ?>">
                    <?php if($rcek1['stat_bsk']=="PASS"){echo "PASS";}
                    else if ($rcek1['stat_bsk'] == "ESS PASS") {
                        echo "ESS PASS";
                    } else if ($rcek1['stat_bsk'] == "FAIL") {
                        echo "FAIL";
                    } else if ($rcek1['stat_bsk'] == "DATA") {
                        echo "DATA ONLY";
                    } else if ($rcek1['stat_bsk'] == "") {
                        echo "N/A";
                    } else if ($rcek1['stat_bsk'] != "") {
                        echo $rcekM['mbas_note'];
                    } else {
                        echo "N/A";
                    }                    
                    ?>
                </td>
            </tr>
            <tr>
                <td align="left" style="font-size: 12px;" rowspan="3">PILLING RESISTANCE</td>
                <td align="left" style="font-size: 12px;" >ASTM D4970/D4970M-2022</td>
                <td align="left" style="font-size: 12px; <?php echo (($rcek1['stat_pm'] ?? '') == 'FAIL') ? 'color:red;font-weight:bold;' : ''; ?>">
                    <?php if($rcek1['stat_pm']=="PASS"){echo "PASS";}
                    else if ($rcek1['stat_pm'] == "ESS PASS") {
                        echo "ESS PASS";
                    } else if ($rcek1['stat_pm'] == "FAIL") {
                        echo "FAIL";
                    } else if ($rcek1['stat_pm'] == "DATA") {
                        echo "DATA ONLY";
                    } else if ($rcek1['stat_pm'] == "") {
                        echo "N/A";
                    } else if ($rcek1['stat_pm'] != "") {
                        echo $rcekM['mpillm_note'];
                    } else {
                        echo "N/A";
                    }                    
                    ?>
                    
                </td>
                </tr>
            <tr>
                <!-- <td align="left" style="font-size: 12px;">PILLING RESISTANCE: TUMBLE PILLING METHOD</td> -->
                 <td align="left" style="font-size: 12px;" >BS EN ISO 12945-1-2020</td>
                <td align="left" style="font-size: 12px; <?php echo (($rcek1['stat_prt'] ?? '') == 'FAIL') ? 'color:red;font-weight:bold;' : ''; ?>">
                    <?php if($rcek1['stat_prt']=="PASS"){echo "PASS";}
                    else if ($rcek1['stat_prt'] == "ESS PASS") {
                        echo "ESS PASS";
                    } else if ($rcek1['stat_prt'] == "FAIL") {
                        echo "FAIL";
                    } else if ($rcek1['stat_prt'] == "DATA") {
                        echo "DATA ONLY";
                    } else {
                        echo "N/A";
                    }?></td>
               </tr>
            <tr>
                <!-- <td align="left" style="font-size: 12px;">PILLING RESISTANCE: ICI PILLING METHOD</td> -->
                <td align="left" style="font-size: 12px;">ASTM D3512/D3512M-2022</td>
                <td align="left" style="font-size: 12px;<?php echo (($rcek1['stat_pb'] ?? '') == 'FAIL') ? 'color:red;font-weight:bold;' : ''; ?>">
                    <?php if($rcek1['stat_pb']=="PASS"){echo "PASS";}
                    else if ($rcek1['stat_pb'] == "ESS PASS") {
                        echo "ESS PASS";
                    } else if ($rcek1['stat_pb'] == "FAIL") {
                        echo "FAIL";
                    } else if ($rcek1['stat_pb'] == "DATA") {
                        echo "DATA ONLY";
                    } else {
                        echo "N/A";
                    }?></td>
              </tr>
            <tr>
                <td align="left" style="font-size: 12px;">SNAGGING RESISTANCE</td>
                <td align="left" style="font-size: 12px;" >ASTM D5362-13 (REAPPROVED 2018)</td>
                <td align="left" style="font-size: 12px; <?php echo (($rcek1['stat_sb'] ?? '') == 'FAIL') ? 'color:red;font-weight:bold;' : ''; ?>">
                    <?php if($rcek1['stat_sb']=="PASS"){echo "PASS";}
                    else if ($rcek1['stat_sb'] == "ESS PASS") {
                        echo "ESS PASS";
                    } else if ($rcek1['stat_sb'] == "FAIL") {
                        echo "FAIL";
                    } else if ($rcek1['stat_sb'] == "DATA") {
                        echo "DATA ONLY";
                    } else {
                        echo "N/A";
                    }?></td>
            </tr>
            <tr>
                <td align="left" style="font-size: 12px;">BURSTING STRENGTH</td>
                <td align="left" style="font-size: 12px;" >ASTM D6797-2024</td>
                <td align="left" style="font-size: 12px; <?php echo (($rcek1['stat_bs2'] ?? '') == 'FAIL') ? 'color:red;font-weight:bold;' : ''; ?>">
                    <?php if($rcek1['stat_bs2']=="PASS"){echo "PASS";}else if ($rcek1['stat_bs2'] == "ESS PASS") {
                        echo "ESS PASS";
                    } else if ($rcek1['stat_bs2'] == "FAIL") {
                        echo "FAIL";
                    } else if ($rcek1['stat_bs2'] == "DATA") {
                        echo "DATA ONLY";
                    } else if ($rcek1['stat_bs2'] == "") {
                        echo "N/A";
                    } else if ($rcek1['stat_bs2'] != "") {
                        echo $rcekM['mburs_note'];
                    } else {
                        echo "N/A";
                    }?></td>
             </tr>
              <tr>
                <td align="left" style="font-size: 12px;" rowspan="2">ELONGATION, MODULUS & RECOVERY</td>
                <td align="left" style="font-size: 12px;" >BS EN ISO 20932 1:2020+A1:2021(MODIFIED)</td>
                <td align="left" style="font-size: 12px; <?php echo (($rcek1['stat_sr'] ?? '') == 'FAIL') ? 'color:red;font-weight:bold;' : ''; ?>">
                    <?php if ($rcek1['stat_sr'] == "PASS" OR $rcek1['stat_sr'] == "DISPOSISI") {
                        echo "PASS";
                    } else if ($rcek1['stat_sr'] == "ESS PASS") {
                    echo "ESS PASS";
                    } else {
                        echo "";
                    }if ($rcek1['stat_sr'] == "FAIL") {
                        echo "FAIL";
                    } elseif ($rcek1['stat_sr'] == "DATA") {
                        echo "DATA ONLY";
                    } else if ($rcek1['stat_sr'] == "") {
                        echo "N/A";
                    } else if ($rcek1['stat_sr'] != "") {
                        echo $rcekM['mapper_note'];
                    } else {
                        echo "N/A";
                    } ?>
                </td>
              </tr>
              <tr>
                <td align="left" style="font-size: 12px;" >BS 4952-1992</td>
                <td align="left" style="font-size: 12px;">N/A</td>
            </tr>
             <tr>
                <td align="left" style="font-size: 12px;">APPEARANCE AFTER WASHING</td>
                <td align="left" style="font-size: 12px;" >AATCC TS-008(MODIFIED)</td>
                <td align="left" style="font-size: 12px; <?php echo (($rcek1['stat_ap'] ?? '') == 'FAIL') ? 'color:red;font-weight:bold;' : ''; ?>">
                    <?php if ($rcek1['stat_ap'] == "PASS") {
                    echo "PASS";
                } else if ($rcek1['stat_ap'] == "ESS PASS") {
                        echo "ESS PASS";
                    } else if ($rcek1['stat_ap'] == "FAIL") {
                        echo "FAIL";
                    } else if ($rcek1['stat_ap'] == "DATA") {
                        echo "DATA ONLY";
                    } else if ($rcek1['stat_ap'] == "") {
                        echo "N/A";
                    } else if ($rcek1['stat_ap'] != "") {
                        echo $rcekM['mapper_note'];
                    } else {
                        echo "N/A";
                    } ?>
                </td>                
            </tr>
            <tr>
                <td align="left" style="font-size: 12px;">COLORFASTNESS TO WASHING</td>
                <td align="left" style="font-size: 12px;" >AATCC TM61-2013e2(2020)</td>
                <td align="left" style="font-size: 12px;<?php echo (($rcek1['stat_wf'] ?? '') == 'FAIL') ? 'color:red;font-weight:bold;' : ''; ?>">
                    <?php if($rcek1['stat_wf']=="PASS"){echo "PASS";}
                    else if ($rcek1['stat_wf'] == "ESS PASS") {
                        echo "ESS PASS";
                    } else if ($rcek1['stat_wf'] == "FAIL") {
                        echo "FAIL";
                    } else if ($rcek1['stat_wf'] == "DATA") {
                        echo "DATA ONLY";
                    } else if ($rcek1['stat_wf'] == "") {
                        echo "N/A";
                    } else if ($rcek1['stat_wf'] != "") {
                        echo $rcekM['mwash_note'];
                    } else {
                        echo "N/A";
                    }?></td>
            </tr>
            <tr>
                <td align="left" style="font-size: 12px;">COLORFASTNESS TO CROCKING</td>
                <td align="left" style="font-size: 12px;" >AATCC TM8-2016e(2022)e</td>
                <td align="left" style="font-size: 12px;<?php echo (($rcek1['stat_cr'] ?? '') == 'FAIL') ? 'color:red;font-weight:bold;' : ''; ?>">
                    <?php if($rcek1['stat_cr']=="PASS"){echo "PASS";}
                    else if ($rcek1['stat_cr'] == "ESS PASS") {
                        echo "ESS PASS";
                    } else if ($rcek1['stat_cr'] == "FAIL") {
                        echo "FAIL";
                    } else if ($rcek1['stat_cr'] == "DATA") {
                        echo "DATA ONLY";
                    } else if ($rcek1['stat_cr'] == "") {
                        echo "N/A";
                    } else if ($rcek1['stat_cr'] != "") {
                        echo $rcekM['mcrock_note'];
                    } else {
                        echo "N/A";
                    }?></td>
            </tr>
            <tr>
                <td align="left" style="font-size: 12px;">COLORFASTNESS TO WATER</td>
                <td align="left" style="font-size: 12px;" >AATCC TM107-2022</td>
                <td align="left" style="font-size: 12px;<?php echo (($rcek1['stat_wtr'] ?? '') == 'FAIL') ? 'color:red;font-weight:bold;' : ''; ?>">
                    <?php if($rcek1['stat_wtr']=="PASS"){echo "PASS";}
                    else if ($rcek1['stat_wtr'] == "ESS PASS") {
                        echo "ESS PASS";
                    } else if ($rcek1['stat_wtr'] == "FAIL") {
                        echo "FAIL";
                    } else if ($rcek1['stat_wtr'] == "DATA") {
                        echo "DATA ONLY";
                    } else if ($rcek1['stat_wtr'] == "") {
                        echo "N/A";
                    } else if ($rcek1['stat_wtr'] != "") {
                        echo $rcekM['mwater_note'];
                    } else {
                        echo "N/A";
                    }?></td>
            </tr>
            <tr>
                <td align="left" style="font-size: 12px;">COLORFASTNESS TO PERSPIRATION</td>
                <td align="left" style="font-size: 12px;">AATCC TM15-2021e</td>
                <td align="left" style="font-size: 12px;<?php echo (($rcek1['stat_pac'] ?? '') == 'FAIL') ? 'color:red;font-weight:bold;' : ''; ?>">
                    <?php if($rcek1['stat_pac']=="PASS" AND $rcek1['stat_pal']=="PASS"){echo "PASS";}
                    else if (($rcek1['stat_pac'] == "ESS PASS" AND $rcek1['stat_pal'] == "PASS") OR ($rcek1['stat_pal'] == "ESS PASS" AND $rcek1['stat_pac'] == "PASS")) {
                        echo "ESS PASS";
                    } else if ($rcek1['stat_pac'] == "FAIL" AND $rcek1['stat_pal'] == "FAIL") {
                        echo "FAIL";
                    } else if ($rcek1['stat_pac'] == "DATA" AND $rcek1['stat_pal'] == "DATA") {
                        echo "DATA ONLY";
                    } else if ($rcek1['stat_pac'] == "") {
                        echo "N/A";
                    } else if ($rcek1['stat_pac'] != "" AND $rcek1['stat_pal'] != "") {
                        echo $rcekM['macid_note'] . " " . $rcekM['malkaline_note'];
                    } else {
                        echo "N/A";
                    }?></td>
        </tr>
            <tr>
                <td align="left" style="font-size: 12px;">COLORFASTNESS TO DYE TRANSFER IN STORAGE</td>
                <td align="left" style="font-size: 12px;" >AATCC TM163-2013(2020)e3(MODIFIED)</td>
                <td align="left" style="font-size: 12px;<?php echo (($rcek1['stat_dye'] ?? '') == 'FAIL') ? 'color:red;font-weight:bold;' : ''; ?>">
                    <?php if($rcek1['stat_dye']=="PASS"){echo "PASS";}
                    else if ($rcek1['stat_dye'] == "ESS PASS") {
                        echo "ESS PASS";
                    } else if ($rcek1['stat_dye'] == "FAIL") {
                        echo "FAIL";
                    } else if ($rcek1['stat_dye'] == "DATA") {
                        echo "DATA ONLY";
                    } else if ($rcek1['stat_dye'] == "") {
                        echo "N/A";
                    } else if ($rcek1['stat_dye'] != "") {
                        echo $rcekM['mdye_tf_note'];
                    } else {
                        echo "N/A";
                    }?></td>
            </tr>
            <tr>
                <td align="left" style="font-size: 12px;">COLORFASTNESS TO LIGHT</td>
                 <td align="left" style="font-size: 12px;" >AATCC TM16.3-2020 OPTION 3</td>
                <td align="left" style="font-size: 12px;<?php echo (($rcek1['stat_lg'] ?? '') == 'FAIL') ? 'color:red;font-weight:bold;' : ''; ?>">
                    <?php if($rcek1['stat_lg']=="PASS"){echo "PASS";}
                    else if($rcek1['stat_lg']=="ESS PASS"){echo "ESS PASS";}
                    elseif ($rcek1['stat_lg'] == "FAIL") {
                        echo "FAIL";
                    } else if ($rcek1['stat_lg'] == "DATA") {
                        echo "DATA ONLY";
                    } else if ($rcek1['stat_lg'] == "") {
                        echo "N/A";
                    } else if ($rcek1['stat_lg'] != "") {
                        echo $rcekM['mlight_note'];
                    } else {
                        echo "N/A";
                    }?></td>
             </tr>
            <tr>
                <td align="left" style="font-size: 12px;">COLORFASTNESS TO PHENOLIC YELLOWING</td>
                <td align="left" style="font-size: 12px;" >ISO 105-X18:2017</td>
                <td align="left" style="font-size: 12px;<?php echo (($rcek1['stat_py'] ?? '') == 'FAIL') ? 'color:red;font-weight:bold;' : ''; ?>">
                    <?php if($rcek1['stat_py']=="PASS"){echo "PASS";}
                    else if ($rcek1['stat_py'] == "ESS PASS") {
                        echo "ESS PASS";
                    } else if ($rcek1['stat_py'] == "FAIL") {
                        echo "FAIL";
                    } else if ($rcek1['stat_py'] == "DATA") {
                        echo "DATA ONLY";
                    } else if ($rcek1['stat_py'] == "") {
                        echo "N/A";
                    } else if ($rcek1['stat_py'] != "") {
                        echo $rcekM['mphenolic_note'];
                    } else {
                        echo "N/A";
                    }?></td>
                </tr>           
            <!-- <tr>
                <td align="left" style="font-size: 12px;">EXTENSION AND RECOVERY TEST FOR ELASTIC FABRICS</td>
                <td align="center" style="font-size: 12px;"><?php if($rcek1['stat_sr']=="PASS" OR $rcek1['stat_sr']=="DISPOSISI"){echo "X";}else{echo "&nbsp;";}?></td>
                <td align="center" style="font-size: 12px;"><?php if($rcek1['stat_sr']=="ESS PASS"){echo "X";}else{echo "&nbsp;";}?></td>
                <td align="center" style="font-size: 12px;"><?php if($rcek1['stat_sr']=="FAIL"){echo "X";}else{echo "&nbsp;";}?></td>
                <td align="center" style="font-size: 12px;"><?php if($rcek1['stat_sr']=="DATA"){echo "X";}else{echo "&nbsp;";}?></td>
                <td align="center" style="font-size: 12px;">N/A</td>
            </tr> -->           
            <tr>
                <td align="left" style="font-size: 12px;">VERTICAL WICKING TEST</td>
                <td align="left" style="font-size: 12px;" >LLL-10197-2018</td>
                <td align="left" style="font-size: 12px;<?php echo (($rcek1['stat_wic'] ?? '') == 'FAIL') ? 'color:red;font-weight:bold;' : ''; ?>">
                    <?php if($rcek1['stat_wic']=="PASS" OR $rcek1['stat_wic1']=="PASS" OR $rcek1['stat_wic2']=="PASS" OR $rcek1['stat_wic3']=="PASS"){echo "PASS";}
                    else if ($rcek1['stat_wic'] == "ESS PASS" OR $rcek1['stat_wic1'] == "ESS PASS" OR $rcek1['stat_wic2'] == "ESS PASS" OR $rcek1['stat_wic3'] == "MARGINAL PASS") {
                        echo "ESS PASS";
                    } else if ($rcek1['stat_wic'] == "DATA" OR $rcek1['stat_wic1'] == "DATA" OR $rcek1['stat_wic2'] == "DATA" OR $rcek1['stat_wic3'] == "DATA") {
                        echo "DATA ONLY";
                    } else if ($rcek1['stat_wic'] == "") {
                        echo "N/A";
                    } else if ($rcek1['stat_wic'] != "" OR $rcek1['stat_wic1'] != "" OR $rcek1['stat_wic2'] != "" OR $rcek1['stat_wic3'] != "") {
                        echo $rcekM['mwick_note'];
                    } else {
                        echo "N/A";
                    }?></td>
        </tr>
            <!--<tr>
                <td align="left" style="font-size: 12px;">QUICK DRY</td>
                <td align="center" style="font-size: 12px;"><?php if($rcek1['stat_dry']=="PASS" AND $rcek1['stat_dry1']=="PASS"){echo "X";}else{echo "&nbsp;";}?></td>
                <td align="center" style="font-size: 12px;"><?php if(($rcek1['stat_dry']=="MARGINAL PASS" AND $rcek1['stat_dry1']=="PASS") OR ($rcek1['stat_dry1']=="MARGINAL PASS" AND $rcek1['stat_dry']=="PASS")){echo "X";}else{echo "&nbsp;";}?></td>
                <td align="center" style="font-size: 12px;"><?php if($rcek1['stat_dry']=="FAIL" AND $rcek1['stat_dry1']=="FAIL"){echo "X";}else{echo "&nbsp;";}?></td>
                <td align="center" style="font-size: 12px;"><?php if($rcek1['stat_dry']=="DATA" AND $rcek1['stat_dry1']=="DATA"){echo "X";}else{echo "&nbsp;";}?></td>
                <td align="center" style="font-size: 12px;"><?php if($rcek1['stat_dry']=="" AND $rcek1['stat_dry1']==""){echo $rcek1['dry_note'];}else{echo "&nbsp;";}?></td>
            </tr>-->
        </tbody>
    </table>
    <table width="100%" border="1" class="table-list1">
        <tr>
            <td align="left" style="font-size: 12px;">Notes:</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;"><textarea style="font-size: 12px; text-align:left;" name="comments" type="text" placeholder="Ketik" size="250" rows="3" cols="120"></textarea></td>
        </tr>
    </table>
    <br><br><br><br>
    <table width="100%">
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">PT. INDO TAICHEN TEXTILE INDUSTRY</td>
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">QC LABTEST</td>
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;">CHECKED BY :</td>
            <td align="center" style="font-size: 12px;">&nbsp;</td>
            <td align="center" style="font-size: 12px;">APPROVED BY :</td>
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;"><img src="../../dist/img/Vivik Kurniawati.png" height="55" alt=""/></td>
            <td align="center" style="font-size: 12px;">&nbsp;</td>
            <td align="center" style="font-size: 12px;"><img src="../../dist/img/Ferry Wibowo.png" height="55" alt=""/></td>
        </tr>
        <!-- <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr> -->
        <tr>
            <td align="center" style="font-size: 12px;"><u>VIVIK KURNIAWATI</u></td>
            <td align="center" style="font-size: 12px;">&nbsp;</td>
            <td align="center" style="font-size: 12px;"><u>FERRY WIBOWO</u></td>
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;">SUPERVISOR QCF</td>
            <td align="center" style="font-size: 12px;">&nbsp;</td>
            <td align="center" style="font-size: 12px;">MANAGER QCF</td>
        </tr>
    </table>
    <div class="pagebreak"></div>
    <!-- Page 3 End -->
    <!-- Page 4 Begin -->
    <table width="100%">
        <tr>
            <td align="right" style="font-size: 12px;"><?php echo $rd2['no_rptlulu'];?><?php if($rd2['sts_rev']=="1" AND $rd2['revisi']!=""){echo "-".$rd2['revisi'];}?></td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">Page 4 of 9</td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;"><?php echo date("F j, Y", strtotime($rd2['date_out1']));?></td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td align="left" style="font-size: 12px;" width="33%">&nbsp;</td>
            <td align="center" style="font-size: 12px;" width="33%"><u>TEST RESULT</u></td>
            <td align="right" style="font-size: 12px;" width="33%">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="33%"><u>TEST PROPERTY</u></td>
            <td align="center" style="font-size: 12px;" width="33%">&nbsp;</td>
            <td align="right" style="font-size: 12px;" width="33%"><u>REQUIREMENT</u></td>
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <!-- PH BEGIN -->
        <tr>
            <!-- <td align="left" style="font-size: 12px;" colspan="3"><strong><u>pH IN TEXTILESPH VALUE IN TEXTILE</u></strong> (AATCC 81)</td> -->
            <td align="left" style="font-size: 12px;" colspan="3"><strong><u><!--pH IN TEXTILES-->PH VALUE</u></strong> (AATCC TM81-2022)</td>
            <!-- <td align="left" style="font-size: 12px;" ><strong>T1 (1A) R22 DARK GREEN / T3 (1B) FLEECE DARK GREEN</strong></td> -->
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">pH VALUE</td>
            <td align="center" style="font-size: 11px;" width="33%"><?php if($rcek1['ph']!=""){echo $rcek1['ph'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">
                <select name="ph" 
                        style="border:none;font-size: 11px; -webkit-appearance: none;">
                    <option value="4.0 TO 6.0">4.0 TO 6.0</option>
                    <option value="4.5 TO 8.0">4.5 TO 8.0</option>
                    <option value="4.5 TO 7.0">4.5 TO 7.0</option>
                </select>
            </td>
        </tr>
        <tr>
            <td  style="font-size: 12px;" Width="33%" ><strong> Conclusion </strong></td>
            <td align="center"  style="font-size: 12px; <?php echo (($rcek1['stat_ph'] ?? '') == 'FAIL') ? 'color:red;' : ''; ?>" Width="33%"><?php echo $rcek1['stat_ph']; ?></td>
            <td style="font-size: 12px;" Width="33%"></td>
        </tr>
      
        <!-- PH END -->
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <!-- FABRIC WEIGHT BEGIN -->
        <tr>
            <!-- <td align="left" style="font-size: 12px;" colspan="3"><strong><u>FABRIC WEIGHT</u></strong> (ASTM D3776, OPTION C)</td> -->
            <td align="left" style="font-size: 12px;" colspan="3"><strong><u>FABRIC WEIGHT PER UNIT AREA</u></strong> (ASTM D3776/D3776M OPTION C-20 (REAPPROVED 2025))</td>
            <!-- <td align="center" style="font-size: 12px;"><strong>T2 / T3 LIGHT GREEN</strong></td>
            <td align="left" style="font-size: 12px;">&nbsp; </td> -->
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">OZ / SQ.YD</td>
            <td align="center" style="font-size: 11px;" width="33%"><?php if($rcek1['fwe_note']!=""){echo number_format((float)$rcek1['fwe_note']/33.906,2);}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">-5 TO + 5 %</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">G / SQ.M</td>
            <?php 
            $batas_bawah = $rd2['gramasi'] * 0.95;
            $batas_atas  = $rd2['gramasi'] * 1.05;
            ?>
            <td align="center" style="font-size: 11px; <?php if($rcek1['fwe_note']!='' AND $rcek1['fwe_note'] < $batas_bawah){echo "color:red;";}else if($rcek1['fwe_note']!='' AND $rcek1['fwe_note'] > $batas_atas){echo "color:red;";}?>" width="33%"><?php if($rcek1['fwe_note']!=""){echo $rcek1['fwe_note'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">-5 TO + 5 %</td>
        </tr>
        <tr>
            <td  style="font-size: 12px;" Width="33%" ><strong> Conclusion </strong></td>
            <td align="center"  style="font-size: 12px;" Width="33%"><?php echo $rcek1['stat_fwss2']; ?></td>
            <td align="right" style="font-size: 11px;" colspan="3">AS CLAIM :</td>
        </tr>
        <tr>
            <td  style="font-size: 12px;" Width="33%" ><strong> Remarks : g/m2 = gram per square meter</strong></td>
            <td align="center"  style="font-size: 12px;" Width="33%"></td>
            <td align="right" style="font-size: 11px;" colspan="3"><?php echo $rd2['gramasi']." G/M2";?></td>
        </tr>
        <!-- <tr>
            <td  style="font-size: 12px;" Width="33%" ><strong> Conclusion </strong></td>
            <td align="center"  style="font-size: 12px;" Width="33%"><?php echo $rcek1['stat_fwss2']; ?></td>
            <td  style="font-size: 12px;" Width="33%"></td>
        </tr> -->
        <!-- <tr>
            <td  style="font-size: 12px;" Width="33%" ><strong> Remarks : g/m2 = gram per square meter</strong></td>
            <td align="center"  style="font-size: 12px;" Width="33%"></td>
            <td  style="font-size: 12px;" Width="33%"></td>
        </tr> -->
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        <!-- FABRIC WEIGHT END -->
        <!-- FABRIC WIDTH BEGIN -->
        <tr>
            <!-- <td align="left" style="font-size: 12px;" colspan="3"><strong><u>FABRIC WIDTH</u></strong> (ASTM D3774, OPTION B)</td> -->
            <td align="left" style="font-size: 12px;" colspan="3"><strong><u>FABRIC WIDTH</u></strong> (ASTM D3774 OPTION B-18 (REAPPROVED 2024))</td>
            <!-- <td align="center" style="font-size: 12px;"><strong>T2 / T3 GREY</strong> </td>
            <td align="left" style="font-size: 12px;">&nbsp;</td> -->
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">CUTTABLE WIDTH (INCH)</td>
            <td align="center" style="font-size: 11px;" width="33%"><?php if($rcek1['f_width']!=""){echo $rcek1['f_width'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">DATA ONLY</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">FULL WIDTH (INCH)</td>
            <td align="center" style="font-size: 11px;" width="33%"><?php if($rcek1['fwi_note']!=""){echo $rcek1['fwi_note'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">DATA ONLY</td>
        </tr>
           <tr>
            <td  style="font-size: 12px;" Width="33%" ><strong> Conclusion </strong></td>
            <td align="center"  style="font-size: 12px; <?php echo (($rcek1['stat_fwss3'] ?? '') == 'FAIL') ? 'color:red;' : ''; ?>" Width="33%"><?php echo $rcek1['stat_fwss3'].' ONLY'; ?></td>
            <td  style="font-size: 12px;" Width="33%"></td>
        </tr>
        <!-- FABRIC WIDTH END -->
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <!-- DIMENSIONAL CHANGE BEGIN -->
        <tr>
            <td align="left" style="font-size: 12px;" colspan="3"><strong><u>DIMENSIONAL STABILITY TO WASHING</u></td>
        </tr>
        <tr>
            <!-- <td align="left" style="font-size: 11px;" colspan="3">AATCC 1993 WOB STANDARD REFERENCE DETERGENT, NORMAL CYCLE AT 27 &#177; 3 DEGREE CELCIUS</td> -->
            <td align="left" style="font-size: 11px;" colspan="3">AATCC TM135-2018T, MACHINE WASH AT 80&#177;5&deg;F WITH 1.8 KG TOTAL LOADING (TYPE 3 BALLAST + SPECIMEN) </td>
        </tr>
        <tr>
            <!-- <td align="left" style="font-size: 11px;" colspan="3">(80 FAHRENHEIT), TUMBLE DRY LOW, MEASURE AT 10 INCHES, (1 WASH) UNRESTORED</td> -->
            <td align="left" style="font-size: 11px;" colspan="3">AND 66&#177;1G OF 1993 AATCC STANDARD REFERENCE DETERGEN WOB, NORMAL CYCLE, TUMBLE DRY LOW
            </td>
        </tr>
        <!-- <tr>
            <td align="left" style="font-size: 11px;"> UNRESTORED</td>
            <td align="center" style="font-size: 11px;"> <strong>T4 / T6 LIGHT GREEN</strong></td>
            <td align="left" style="font-size: 11px;"> &nbsp;</td>
        </tr> -->
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">AFTER 1 WASH</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">LENGTHWISE (%)</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['stat_fwss']=="MARGINAL PASS" AND $rcekM['mshrinkage_l1']!='' AND $rcekM['mshrinkage_l1'] < -7){echo "color:red;";}else if($rcek1['stat_fwss']=="MARGINAL PASS" AND $rcekM['mshrinkage_l1']!='' AND $rcekM['mshrinkage_l1'] > 5){echo "color:red;";}else if($rcek1['shrinkage_l1']!='' AND $rcek1['shrinkage_l1'] < -7){echo "color:red;";}else if($rcek1['shrinkage_l1']!='' AND $rcek1['shrinkage_l1'] > 5){echo "color:red;";}?>" width="33%"><?php if($rcekM['mshrinkage_l1']=="" AND $rcek1['shrinkage_l1']==""){echo "N/A";}else if($rcek1['stat_fwss']=="MARGINAL PASS"){echo $rcekM['mshrinkage_l1'];}else if($rcek1['stat_fwss']=="MARGINAL PASS" AND $rcekM['mshrinkage_l1']==""){echo "N/A";}else{echo $rcek1['shrinkage_l1'];}?></td>
            <!-- <td align="right" style="font-size: 11px;" width="33%">-5 TO + 5 %</td> -->
            <td align="right" style="font-size: 11px;" width="44%"><input style="font-size: 11px; text-align:right" name="notedc" type="text" placeholder="Ketik" size="50" /></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">WIDTHWISE (%)</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['stat_fwss']=="MARGINAL PASS" AND $rcekM['mshrinkage_w1']!='' AND $rcekM['mshrinkage_w1'] < -7){echo "color:red;";}else if($rcek1['stat_fwss']=="MARGINAL PASS" AND $rcekM['mshrinkage_w1']!='' AND $rcekM['mshrinkage_w1'] > 5){echo "color:red;";}else if($rcek1['shrinkage_w1']!='' AND $rcek1['shrinkage_w1'] < -7){echo "color:red;";}else if($rcek1['shrinkage_w1']!='' AND $rcek1['shrinkage_w1'] > 5){echo "color:red;";}?>" width="33%"><?php if($rcekM['mshrinkage_w1']=="" AND $rcek1['shrinkage_w1']==""){echo "N/A";}else if($rcek1['stat_fwss']=="MARGINAL PASS"){echo $rcekM['mshrinkage_w1'];}else if($rcek1['stat_fwss']=="MARGINAL PASS" AND $rcekM['mshrinkage_w1']==""){echo "N/A";}else{echo $rcek1['shrinkage_w1'];}?></td>
            <!-- <td align="right" style="font-size: 11px;" width="33%">-5 TO + 5 %</td> -->
            <td align="right" style="font-size: 11px;" width="44%"><input style="font-size: 11px; text-align:right" name="notedc" type="text" placeholder="Ketik" size="50" /></td>
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">AFTER 5 WASH</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">LENGTHWISE (%)</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['stat_fwss']=="MARGINAL PASS" AND $rcekM['mshrinkage_l2']!='' AND $rcekM['mshrinkage_l2'] < -7){echo "color:red;";}else if($rcek1['stat_fwss']=="MARGINAL PASS" AND $rcekM['mshrinkage_l2']!='' AND $rcekM['mshrinkage_l2'] > 5){echo "color:red;";}else if($rcek1['shrinkage_l2']!='' AND $rcek1['shrinkage_l2'] < -7){echo "color:red;";}else if($rcek1['shrinkage_l2']!='' AND $rcek1['shrinkage_l2'] > 5){echo "color:red;";}?>" width="33%"><?php if($rcekM['mshrinkage_l2']=="" AND $rcek1['shrinkage_l2']==""){echo "N/A";}else if($rcek1['stat_fwss']=="MARGINAL PASS"){echo $rcekM['mshrinkage_l2'];}else if($rcek1['stat_fwss']=="MARGINAL PASS" AND $rcekM['mshrinkage_l2']==""){echo "N/A";}else{echo $rcek1['shrinkage_l2'];}?></td>
            <!-- <td align="right" style="font-size: 11px;" width="33%">-5 TO + 5 %</td> -->
            <td align="right" style="font-size: 11px;" width="33%"><input style="font-size: 11px; text-align:right" name="notedc" type="text" placeholder="Ketik" size="50" /></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">WIDTHWISE (%)</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['stat_fwss']=="MARGINAL PASS" AND $rcekM['mshrinkage_w2']!='' AND $rcekM['mshrinkage_w2'] < -7){echo "color:red;";}else if($rcek1['stat_fwss']=="MARGINAL PASS" AND $rcekM['mshrinkage_w2']!='' AND $rcekM['mshrinkage_w2'] > 5){echo "color:red;";}else if($rcek1['shrinkage_w2']!='' AND $rcek1['shrinkage_w2'] < -7){echo "color:red;";}else if($rcek1['shrinkage_w2']!='' AND $rcek1['shrinkage_w2'] > 5){echo "color:red;";}?>" width="33%"><?php if($rcekM['mshrinkage_w2']=="" AND $rcek1['shrinkage_w2']==""){echo "N/A";}else if($rcek1['stat_fwss']=="MARGINAL PASS"){echo $rcekM['mshrinkage_w2'];}else if($rcek1['stat_fwss']=="MARGINAL PASS" AND $rcekM['mshrinkage_w2']==""){echo "N/A";}else{echo $rcek1['shrinkage_w2'];}?></td>
            <!-- <td align="right" style="font-size: 11px;" width="33%">-5 TO + 5 %</td> -->
            <td align="right" style="font-size: 11px;" width="33%"><input style="font-size: 11px; text-align:right" name="notedc" type="text" placeholder="Ketik" size="50" /></td>
        </tr>
        <!-- data belum tau di tarik di mana -->
        <tr> 
            <td  style="font-size: 12px;" Width="33%" ><strong> Conclusion </strong></td>
            <td align="center"  style="font-size: 12px; <?php echo (($rcek1['stat_fwss'] ?? '') == 'FAIL') ? 'color:red;' : ''; ?>" Width="33%"><?php echo $rcek1['stat_fwss']; ?></td>
            <td  style="font-size: 12px;" Width="33%"></td>
        </tr>
        <tr></tr>
        <!-- <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr> -->
        <tr>
            <!-- <td align="left" style="font-size: 11px;" width="33%" colspan="2">(+) DENOTES ELONGATION &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (-) SHRINKAGE</td> -->
             <td  style="font-size: 12px;" colspan="3"><strong> Remarks : </strong>(+) MEANS GROWTH  (-) MEANS SHRINKAGE</td>
            <!-- <td align="left" style="font-size: 11px;" width="33%" colspan="2">(+) MEANS GROWTH &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (-) MEANS SHRINKAGE</td> -->
            <td align="center" style="font-size: 12px;" width="23%">&nbsp;</td>
        </tr>
        <!-- DIMENSIONAL CHANGE END -->
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <!-- SKEWNESS BEGIN -->
        <tr>
            <!-- <td align="left" style="font-size: 12px;" colspan="3"><strong><u>SKEWING  -->
                <!--FROM HOME LAUNDERING-->
            <!-- </u></strong> (AATCC 179)</td> -->
            <td align="left" style="font-size: 12px;" colspan="3"><strong><u>SKEWNESS / TWIST AFTER WASHING  <!--FROM HOME LAUNDERING--></u></strong> (AATCC TM179-2023)</td>
        </tr>
        <!-- <tr>
            <td align="left" style="font-size: 11px;">&nbsp;</td>
            <td align="center" style="font-size: 11px;"><strong>T4 / T6 BLACK</strong></td>
            <td align="left" style="font-size: 11px;">&nbsp;</td>
        </tr> -->
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">AFTER 1 WASH</td>
        </tr>
        <tr>
            <!-- <td align="left" style="font-size: 11px;" width="33%">SKEWNESS (%)</td> -->
            <td align="left" style="font-size: 11px;" width="33%">SKEWNESS/TWIST (%)</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['stat_fwss']=="MARGINAL PASS" AND $rcekM['mspirality1']!='' AND $rcekM['mspirality1'] < -5){echo "color:red;";}else if($rcek1['stat_fwss']=="MARGINAL PASS" AND $rcekM['mspirality1']!='' AND $rcekM['mspirality1'] > 5){echo "color:red;";}else if($rcek1['spirality1']!='' AND $rcek1['spirality1'] < -5){echo "color:red;";}else if($rcek1['spirality1']!='' AND $rcek1['spirality1'] > 5){echo "color:red;";}?>" width="33%"><?php if($rcekM['mspirality1']=="" AND $rcek1['spirality1']==""){echo "N/A";}else if($rcek1['stat_fwss']=="MARGINAL PASS"){echo $rcekM['mspirality1'];}else if($rcek1['stat_fwss']=="MARGINAL PASS" AND $rcekM['mspirality1']==""){echo "N/A";}else{echo $rcek1['spirality1'];}?></td>
            <td align="right" style="font-size: 11px;" width="33%">-3 TO + 3 %</td>
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">AFTER 5 WASH</td>
        </tr>
        <tr>
            <!-- <td align="left" style="font-size: 11px;" width="33%">SKEWNESS (%)</td> -->
            <td align="left" style="font-size: 11px;" width="33%">SKEWNESS/TWIST (%)</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['stat_fwss']=="MARGINAL PASS" AND $rcekM['mspirality2']!='' AND $rcekM['mspirality2'] < -5){echo "color:red;";}else if($rcek1['stat_fwss']=="MARGINAL PASS" AND $rcekM['mspirality2']!='' AND $rcekM['mspirality2'] > 5){echo "color:red;";}else if($rcek1['spirality2']!='' AND $rcek1['spirality2'] < -5){echo "color:red;";}else if($rcek1['spirality2']!='' AND $rcek1['spirality2'] > 5){echo "color:red;";}?>" width="33%"><?php if($rcekM['mspirality2']=="" AND $rcek1['spirality2']==""){echo "N/A";}else if($rcek1['stat_fwss']=="MARGINAL PASS"){echo $rcekM['mspirality2'];}else if($rcek1['stat_fwss']=="MARGINAL PASS" AND $rcekM['mspirality2']==""){echo "N/A";}else{echo $rcek1['spirality2'];}?></td>
            <td align="right" style="font-size: 11px;" width="33%">-3 TO + 3 %</td>
        </tr>
        <!-- <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr> -->
        <tr>
            <td style="font-size: 12px;" Width="33%" ><strong> Conclusion </strong></td>
            <td align="center"  style="font-size: 12px; <?php echo (($rcek1['spirality_status'] ?? '') == 'FAIL') ? 'color:red;' : ''; ?>" Width="33%"><?php if($tq_test_2_array['spirality_status'] !=''){echo $tq_test_2_array['spirality_status'];}else{echo "N/A";}; ?> </td> 
            <td style="font-size: 12px;" Width="33%"></td>
        </tr> 
        <tr>
            <td style="font-size: 12px;" Width="33%" ><strong> Washing Procedure: Same as Washing Shrinkage </strong></td>
            <td align="center"  style="font-size: 12px;" Width="33%"></td>
            <td style="font-size: 12px;" Width="33%"></td>
        </tr>
        <!-- SKEWNESS END -->
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <!-- BOW & SKEW BEGIN -->
        <tr>
            <td align="left" style="font-size: 12px;" colspan="3"><strong><u>BOW & SKEW</u></strong> (ASTM D3882-08-2025)</td>
        </tr>
        <!-- <tr>
            <td align="left" style="font-size: 12px;">&nbsp;</td>
            <td align="center" style="font-size: 12px;"><strong>T2 / T3 BLACK-WHITE (STRIPE)</strong></td>
            <td align="left" style="font-size: 12px;">&nbsp;</td>
        </tr>  -->
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">BOW</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['bow']!='' AND $rcek1['bow'] < -3){echo "color:red;";}else if($rcek1['bow']!='' AND $rcek1['bow'] > 3){echo "color:red;";}?>" width="33%"><?php if($rcek1['bow']!=""){echo $rcek1['bow'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">+/- 3%</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">SKEW</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['skew']!='' AND $rcek1['skew'] < -3){echo "color:red;";}else if($rcek1['skew']!='' AND $rcek1['skew'] > 3){echo "color:red;";}?>" width="33%"><?php if($rcek1['skew']!=""){echo $rcek1['skew'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">+/- 3%</td>
        </tr>
        <tr>
            <td style="font-size: 12px; <?php echo (($rcek1['stat_bsk'] ?? '') == 'FAIL') ? 'color:red;' : ''; ?>" Width="33%" ><strong> Conclusion </strong></td>
            <td align="center"  style="font-size: 12px;" Width="33%"><?php if($rcek1['stat_bsk']!=""){echo $rcek1['stat_bsk'];} else {echo "N/A";} ?></td>
            <td style="font-size: 12px;" Width="33%"></td>
        </tr>
        <!-- BOW & SKEW END -->
    </table>
    <div class="pagebreak"></div>
    <!-- Page 4 End -->
    <!-- Page 5 Begin -->
        <table width="100%">
            <tr>
                <td align="right" style="font-size: 12px;"><?php echo $rd2['no_rptlulu'];?><?php if($rd2['sts_rev']=="1" AND $rd2['revisi']!=""){echo "-".$rd2['revisi'];}?></td> 
            </tr>
            <tr>
                <td align="right" style="font-size: 12px;">Page 5 of 9</td> 
            </tr>
            <tr>
                <td align="right" style="font-size: 12px;"><?php echo date("F j, Y", strtotime($rd2['date_out1']));?></td> 
            </tr>
            <tr>
                <td align="right" style="font-size: 12px;">&nbsp;</td> 
            </tr>
        </table>
        <table width="100%">
                <tr>
                    <td align="left" style="font-size: 12px;" width="33%">&nbsp;</td>
                    <td align="center" style="font-size: 12px;" width="33%"><u>TEST RESULT</u></td>
                    <td align="right" style="font-size: 12px;" width="33%">&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 12px;" width="33%"><u>TEST PROPERTY</u></td>
                    <td align="center" style="font-size: 12px;" width="33%">&nbsp;</td>
                    <td align="right" style="font-size: 12px;" width="33%"><u>REQUIREMENT</u></td>
                </tr>
                <tr>
                    <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
                </tr>
            <!-- PILLING MARTINDALE BEGIN -->
                <tr>
                    <td align="left" style="font-size: 12px;" colspan="3"><strong><u>PILLING RESISTANCE: MARTINDALE PRESSURE TESTER METHOD</u></strong> (ASTM D4970/D470 M-2022)</td>
                </tr>
            <!-- <tr>
                <td align="left" style="font-size: 11px;" width="33%">&nbsp;</td>
                <td align="center" style="font-size: 11px;" width="33%"><strong>T2 / T6 WHITE OPAL</strong></td>
                <td align="right" style="font-size: 11px;" width="33%">&nbsp;</td>
            </tr> -->
                <tr>
                    <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 11px;" width="33%"><strong>ORIGINAL @100 CYCLES</strong></td>
                    <td align="center" style="font-size: 11px; <?php if($rcek1['stat_pm']=="MARGINAL PASS" AND $rcekM['mpm_f1']!='' AND $rcekM['mpm_f1'] < 4){echo "color:black;";}else if($rcek1['pm_f1']!='' AND $rcek1['pm_f1'] < 4){echo "color:black;";}?>" width="33%"><?php if($rcekM['mpm_f1']=="" AND $rcek1['pm_f1']==""){echo "N/A";}else if($rcek1['stat_pm']=="MARGINAL PASS"){echo $rcekM['mpm_f1'];}else if($rcek1['stat_pm']=="MARGINAL PASS" AND $rcekM['mpm_f1']==""){echo "N/A";}else{echo $rcek1['pm_f1'];}?></td>
                    <td align="right" style="font-size: 11px;" width="33%"><input style="font-size: 11px; text-align:right" name="notepm" type="text" placeholder="Ketik" size="50" /></td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 11px;" width="33%">AFTER 1 WASH @2500 CYCLES</td>
                    <td align="center" style="font-size: 11px; <?php if($rcek1['stat_pm']=="MARGINAL PASS" AND $rcekM['mpm_f2']!='' AND $rcekM['mpm_f2'] < 4){echo "color:black;";}else if($rcek1['pm_f2']!='' AND $rcek1['pm_f2'] < 4){echo "color:back;";}?>" width="33%"><?php if($rcekM['mpm_f2']=="" AND $rcek1['pm_f2']==""){echo "N/A";}else if($rcek1['stat_pm']=="MARGINAL PASS"){echo $rcekM['mpm_f2'];}else if($rcek1['stat_pm']=="MARGINAL PASS" AND $rcekM['mpm_f2']==""){echo "N/A";}else{echo $rcek1['pm_f2'];}?></td>
                    <td align="right" style="font-size: 11px;" width="33%"><input style="font-size: 11px; text-align:right" name="notepm" type="text" placeholder="Ketik" size="50" /></td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 11px;" width="33%">AFTER 2 WASH @5000 CYCLES</td> 
                    <td align="center" style="font-size: 11px; <?php if($rcek1['stat_pm']=="MARGINAL PASS" AND $rcekM['mpm_f3']!='' AND $rcekM['mpm_f3'] < 4){echo "color:black;";}else if($rcek1['pm_f3']!='' AND $rcek1['pm_f3'] < 4){echo "color:black;";}?>" width="33%"><?php if($rcekM['mpm_f3']=="" AND $rcek1['pm_f3']==""){echo "N/A";}else if($rcek1['stat_pm']=="MARGINAL PASS"){echo $rcekM['mpm_f3'];}else if($rcek1['stat_pm']=="MARGINAL PASS" AND $rcekM['mpm_f3']==""){echo "N/A";}else{echo $rcek1['pm_f3'];}?></td>
                    <td align="right" style="font-size: 11px;" width="33%"><input style="font-size: 11px; text-align:right" name="notepm" type="text" placeholder="Ketik" size="50" /></td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 11px;" width="33%">AFTER 3 WASH @7500 CYCLES</td>
                    <td align="center" style="font-size: 11px; <?php if($rcek1['stat_pm']=="MARGINAL PASS" AND $rcekM['mpm_f4']!='' AND $rcekM['mpm_f4'] < 4){echo "color:black;";}else if($rcek1['pm_f4']!='' AND $rcek1['pm_f4'] < 4){echo "color:black;";}?>" width="33%"><?php if($rcekM['mpm_f4']=="" AND $rcek1['pm_f4']==""){echo "N/A";}else if($rcek1['stat_pm']=="MARGINAL PASS"){echo $rcekM['mpm_f4'];}else if($rcek1['stat_pm']=="MARGINAL PASS" AND $rcekM['mpm_f4']==""){echo "N/A";}else{echo $rcek1['pm_f4'];}?></td>
                    <td align="right" style="font-size: 11px;" width="33%"><input style="font-size: 11px; text-align:right" name="notepm" type="text" placeholder="Ketik" size="50" /></td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 11px;" width="33%">AFTER 4 WASH @10000 CYCLES</td>
                    <td align="center" style="font-size: 11px; <?php if($rcek1['stat_pm']=="MARGINAL PASS" AND $rcekM['mpm_f5']!='' AND $rcekM['mpm_f5'] < 4){echo "color:black;";}else if($rcek1['pm_f5']!='' AND $rcek1['pm_f5'] < 4){echo "color:black;";}?>" width="33%"><?php if($rcekM['mpm_f5']=="" AND $rcek1['pm_f5']==""){echo "N/A";}else if($rcek1['stat_pm']=="MARGINAL PASS"){echo $rcekM['mpm_f5'];}else if($rcek1['stat_pm']=="MARGINAL PASS" AND $rcekM['mpm_f5']==""){echo "N/A";}else{echo $rcek1['pm_f5'];}?></td>
                    <td align="right" style="font-size: 11px;" width="33%"><input style="font-size: 11px; text-align:right" name="notepm" type="text" placeholder="Ketik" size="50" /></td>
                </tr>
                <tr>
                    <td style="font-size: 12px;" Width="33%" ><strong> Conclusion </strong></td>
                    <td align="center"  style="font-size: 12px; <?php echo (($rcek1['stat_pm'] ?? '') == 'FAIL') ? 'color:red;' : ''; ?>" Width="33%"><?php echo $rcek1['stat_pm']; ?></td>
                    <td style="font-size: 12px;" Width="33%"></td>
                </tr>
                <tr>
                    <td colspan="3" style="font-size: 12px;">
                        <strong>Remarks :</strong><br />
                            <table style="font-size: 11px;">
                                <tr>
                                    <td><strong>For Pilling</strong></td>
                                    <td><strong>For Fuzzing</strong></td>
                                </tr>
                                <tr>
                                    <td>5 No pilling</td>
                                    <td>5 No fuzzing</td>
                                </tr>
                                <tr>
                                    <td>4 Slight pilling</td>
                                    <td>4 Slight fuzzing</td>
                                </tr>
                                <tr>
                                    <td>3 Moderate pilling</td>
                                    <td>3 Moderate fuzzing</td>
                                </tr>
                                <tr>
                                    <td>2 Severe pilling</td>
                                    <td>2 Severe fuzzing</td>
                                </tr>
                                <tr>
                                    <td>1 Very severe pilling</td>
                                    <td>1 Very severe fuzzing</td>
                                </tr>
                            </table>
                    </td>
                </tr>
            <!-- PILLING MARTINDALE END -->
                <tr>
                    <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
                </tr>
            <!-- ICI PILLING BEGIN -->
                <tr>
                    <td align="left" style="font-size: 12px;" colspan="3"><strong><u>PILLING RESISTANCE: ICI PILLING METHOD</u></strong> (BS EN ISO 12945-1-2020) 4 HOURS</td>
                </tr>
            <!-- <tr>
                <td align="left" style="font-size: 11px;" width="33%">&nbsp;</td>
                <td align="center" style="font-size: 11px;" width="33%"><strong>T2 / T6 CREAM</strong></td>
                <td align="right" style="font-size: 11px;" width="33%">&nbsp;</td>
            </tr> -->
                <tr>
                    <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 11px;" colspan="3"><strong>ORIGINAL</strong></td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 11px;" width="33%">PILLING</td>
                    <td align="center" style="font-size: 11px;" width="33%">N/A</td>
                    <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 11px;" width="33%">FUZZING</td>
                    <td align="center" style="font-size: 11px;" width="33%">N/A</td>
                    <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 11px;" width="33%">MATTING</td>
                    <td align="center" style="font-size: 11px;" width="33%">N/A</td>
                    <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
                </tr>
                <tr>
                    <td style="font-size: 12px;" Width="33%" ><strong> Conclusion </strong></td>
                    <td align="center"  style="font-size: 12px; <?php echo (($rcek1['stat_pb'] ?? '') == 'FAIL') ? 'color:red;' : ''; ?>" Width="33%"><?php if($rcek1['stat_pb']!=""){echo $rcek1['stat_pb'];}else{echo "N/A";}?></td>
                    <td style="font-size: 12px;" Width="33%"></td>
                </tr>
            <!-- ICI PILLING END -->
                <tr>
                    <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
                </tr>
            <!-- BURSTING STRENGTH BEGIN -->
                <tr>
                    <td align="left" style="font-size: 12px;" colspan="3"><strong><u>BURSTING STRENGTH
                        <!--: BALL BURST METHOD-->
                    <!-- </u></strong> (ASTM D6797)</td> -->
                    </u></strong> (ASTM D6797-2024)</td>
                </tr>
                <!-- <tr>
                    <td align="left" style="font-size: 11px;" width="33%">&nbsp;</td>
                    <td align="center" style="font-size: 11px;" width="33%"><strong>T2 / T3 SILVER BLUE</strong></td>
                    <td align="right" style="font-size: 11px;" width="33%">&nbsp;</td>
                </tr> -->
                <tr>
                    <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 11px;" width="33%">BURSTING STRENGTH (<?php echo $kode_LBF = 'Lbs'; ?>.)</td>
                    <td align="center" style="font-size: 11px; <?php if($rcek1['bs_instron']!="" AND $rd2['gramasi'] >= 200 AND $rcek1['bs_instron'] < 50){echo "color:red;";}else if($rcek1['bs_instron']!="" AND $rd2['gramasi'] < 200 AND $rcek1['bs_instron'] < 35){echo "color:red;";}?>" width="33%"><?php if($rcek1['bs_instron']!=""){echo $rcek1['bs_instron'];}else{echo "N/A";}?></td>
                    <!-- <td align="right" style="font-size: 11px;" width="33%">
                    <select name="burs" style="border:none;font-size: 11px;-webkit-appearance: none;">
                        <option value="MIN 50.0 LBS">MIN 50.0 LBS</option>
                        <option value="MIN 35.0 LBS">MIN 35.0 LBS</option>
                    </select></td> -->
                    <td align="right" style="font-size: 11px;" width="33%"><?php if($rd2['gramasi'] >= 200){echo "MIN 50.0 $kode_LBF";}else if($rd2['gramasi'] < 200){echo "MIN 35.0 $kode_LBF";}?></td>
                </tr>
                <tr>
                    <td style="font-size: 12px;" Width="33%" ><strong> Conclusion </strong></td>
                    <td align="center"  style="font-size: 12px; <?php echo (($rcek1['stat_bs2'] ?? '') == 'FAIL') ? 'color:red;' : ''; ?>" Width="33%"><?php if($rcek1['stat_bs2']!=""){echo $rcek1['stat_bs2'];}else{echo "N/A";}?></td>
                    <td style="font-size: 12px;" Width="33%"></td>
                </tr>
                <tr>
                    <td style="font-size: 12px;" Width="33%" ><strong>Remarks : Lbs = Pounds</strong></td>
                    <td align="center"  style="font-size: 12px;" Width="33%"></td>
                    <td style="font-size: 12px;" Width="33%"></td>
                </tr>
                <tr>
                    <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 12px;" colspan="3"><strong><u>SNAGGING RESISTANCE</u></strong> (ASTM D5362-13(REAPPROVED 2018); OPTION A, BEAN BAG SNAG TEST)</td>
                </tr>
            <!-- BURSTING STRENGTH END -->
                <tr>
                    <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 11px;" width="33%">AS RECEIVED RATING</td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 11px;" width="33%">AFTER 50 CYCLES</td>
                    <td align="center" style="font-size: 11px; <?php if($rcek1['sb_l1']!="" AND $rcek1['sb_l1'] < 3){echo "color:red;";}?>" width="33%"><?php if($rcek1['sb_l1']!=""){echo $rcek1['sb_l1'];}else{echo "N/A";}?></td>
                    <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 11px;" width="33%">AFTER 75 CYCLES</td>
                    <td align="center" style="font-size: 11px; <?php if($rcek1['sb_w1']!="" AND $rcek1['sb_w1'] < 3){echo "color:red;";}?>" width="33%"><?php if($rcek1['sb_w1']!=""){echo $rcek1['sb_w1'];}else{echo "N/A";}?></td>
                    <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 3.5</td>
                </tr>
                <tr>
                    <td style="font-size: 12px;" Width="33%" ><strong> Conclusion </strong></td>
                    <td align="center"  style="font-size: 12px; <?php echo (($rcek1['stat_sb'] ?? '') == 'FAIL') ? 'color:red;' : ''; ?>" Width="33%"><?php if($rcek1['stat_sb']!=""){echo $rcek1['stat_sb'];}else{echo "N/A";}?></td>
                    <td style="font-size: 12px;" Width="33%"></td>
                </tr>

                <td colspan="3" style="font-size: 12px;">
                    <strong>Remarks :</strong> (for Option A, Photographic Standards)<br />
                    <table style="font-size: 11px;">
                        <tr>
                            <td><strong>Rating 5</strong>: No or insignificant snagging</td>
                        </tr>
                        <tr>
                            <td><strong>Rating 4</strong>: Slight snagging</td>
                        </tr>
                        <tr>
                            <td><strong>Rating 3</strong>: Moderate snagging</td>
                        </tr>
                        <tr>
                            <td><strong>Rating 2</strong>: Severe snagging</td>
                        </tr>
                        <tr>
                            <td><strong>Rating 1</strong>: Very severe snagging</td>
                        </tr>
                    </table>
                </td>
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <!-- WASHING BEGIN -->
        <tr>
            <!-- <td align="left" style="font-size: 12px;" colspan="3"><strong><u>COLORFASTNESS TO LAUNDERING: ACCELERATED</u></strong> (AATCC 61, MODIFIED, TEST NO.2A (40 DEGREE CELCIUS),</td> -->
            <td align="left" style="font-size: 12px;" colspan="3"><strong><u>COLORFASTNESS TO WASHING</u></strong> (AATCC TM 61-2013E2(2020); TEST NO 2A; (MODIFIED)</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" colspan="3">AATCC DETERGENT WOB (POWDER), MULTIFIBER NO.10)</td>
        </tr>
        <!-- <tr>
            <td align="left" style="font-size: 11px;" width="33%">&nbsp;</td>
            <td align="center" style="font-size: 11px;" width="33%"><strong>T1 (2A) NAVY / T5 (2B) BLACK</strong></td>
            <td align="right" style="font-size: 11px;" width="33%">&nbsp;</td>
        </tr> -->
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">CHANGE IN SHADE</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['wash_colorchange']!="" AND $rcek1['wash_colorchange'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['wash_colorchange']!=""){echo $rcek1['wash_colorchange'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">SELF - STAINING</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['wash_staining']!="" AND $rcek1['wash_staining'] < 4.5){echo "color:red;";}?>" width="33%"><?php if($rcek1['wash_staining']!=""){echo $rcek1['wash_staining'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.5</td>
        </tr>
        <tr>
            <!-- <td align="left" style="font-size: 11px;" colspan="3"><u>COLOR STAINING ON</u></td> -->
            <td align="left" style="font-size: 11px;" colspan="3"><u> STAINING ON MULTI-FIBER STRIPE</u></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">ACETATE</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['wash_acetate']!="" AND $rcek1['wash_acetate'] < 3){echo "color:red;";}?>" width="33%"><?php if($rcek1['wash_acetate']!=""){echo $rcek1['wash_acetate'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 3.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">COTTON</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['wash_cotton']!="" AND $rcek1['wash_cotton'] < 3){echo "color:red;";}?>" width="33%"><?php if($rcek1['wash_cotton']!=""){echo $rcek1['wash_cotton'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 3.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">NYLON</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['wash_nylon']!="" AND $rcek1['wash_nylon'] < 3){echo "color:red;";}?>" width="33%"><?php if($rcek1['wash_nylon']!=""){echo $rcek1['wash_nylon'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 3.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">POLYESTER</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['wash_poly']!="" AND $rcek1['wash_poly'] < 3){echo "color:red;";}?>" width="33%"><?php if($rcek1['wash_poly']!=""){echo $rcek1['wash_poly'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 3.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">ACRYLIC</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['wash_acrylic']!="" AND $rcek1['wash_acrylic'] < 3){echo "color:red;";}?>" width="33%"><?php if($rcek1['wash_acrylic']!=""){echo $rcek1['wash_acrylic'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 3.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">WOOL</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['wash_wool']!="" AND $rcek1['wash_wool'] < 3){echo "color:red;";}?>" width="33%"><?php if($rcek1['wash_wool']!=""){echo $rcek1['wash_wool'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 3.0</td>
        </tr>
        <!-- WASHING END -->
        <!-- <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr> -->
        <!-- CROCKING BEGIN -->
        <tr>
           <td style="font-size: 12px;" Width="33%" ><strong> Conclusion </strong></td>
           <td align="center"  style="font-size: 12px;<?php echo (($rcek1['stat_wf'] ?? '') == 'FAIL') ? 'color:red;' : ''; ?> " Width="33%"><?php if($rcek1['stat_wf']!=""){echo $rcek1['stat_wf'];}else{echo "N/A";}?></td>
           <td style="font-size: 12px;" Width="33%"></td>
       </tr>
        <!-- <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr> -->
                </table>
                <div class="pagebreak"></div>
    <!-- Page 5 End -->
    <!-- Page 6 Start --> 
        <table width="100%">
            <tr>
                <td align="right" style="font-size: 12px;"><?php echo $rd2['no_rptlulu'];?><?php if($rd2['sts_rev']=="1" AND $rd2['revisi']!=""){echo "-".$rd2['revisi'];}?></td> 
            </tr>
            <tr>
                <td align="right" style="font-size: 12px;">Page 6 of 9</td> 
            </tr>
            <tr>
                <td align="right" style="font-size: 12px;"><?php echo date("F j, Y", strtotime($rd2['date_out1']));?></td> 
            </tr>
            <tr>
                <td align="right" style="font-size: 12px;">&nbsp;</td> 
            </tr>
        
        </table>
    
            <table width="100%">
            <tr>
                <td align="left" style="font-size: 12px;" width="33%">&nbsp;</td>
                <td align="center" style="font-size: 12px;" width="33%"><u>TEST RESULT</u></td>
                <td align="right" style="font-size: 12px;" width="33%">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" style="font-size: 12px;" width="33%"><u>TEST PROPERTY</u></td>
                <td align="center" style="font-size: 12px;" width="33%">&nbsp;</td>
                <td align="right" style="font-size: 12px;" width="33%"><u>REQUIREMENT</u></td>
            </tr>
            <tr>
                <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <!-- <td align="left" style="font-size: 12px;" colspan="3"><strong><u>COLORFASTNESS TO CROCKING</u></strong> (AATCC 8)</td> -->
                <td align="left" style="font-size: 12px;" colspan="3"><strong><u>COLORFASTNESS TO CROCKING</u></strong> (AATCC TM 8-2016E(2022)E)</td>
            </tr>
            <!-- <tr>
                <td align="left" style="font-size: 11px;" width="33%">&nbsp;</td>
                <td align="center" style="font-size: 11px;" width="33%"><strong>T1 (4A) DARK GREEN / T5 (4B) RED</strong></td>
                <td align="right" style="font-size: 11px;" width="33%">&nbsp;</td>
            </tr> -->
            <tr>
                <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <!-- <td align="left" style="font-size: 11px;" width="33%">DRY (COLOR STAIN)</td> -->
                <td align="left" style="font-size: 11px;" width="33%">DRY STAINING</td>
                <td align="center" style="font-size: 11px; <?php if($rcek1['stat_cr']=="MARGINAL PASS" AND $rcekM['mcrock_len1']!="" AND $rcekM['mcrock_len1'] < 4){echo "color:red;";}else if($rcek1['crock_len1']!="" AND $rcek1['crock_len1'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcekM['mcrock_len1']=="" AND $rcek1['crock_len1']==""){echo "N/A";}else if($rcek1['stat_cr']=="MARGINAL PASS"){echo $rcekM['mcrock_len1'];}else if($rcek1['stat_cr']=="MARGINAL PASS" AND $rcekM['mcrock_len1']==""){echo "N/A";}else{echo $rcek1['crock_len1'];}?></td>
                <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
            </tr>
            <tr>
                <!-- <td align="left" style="font-size: 11px;" width="33%">WET (COLOR STAIN)</td> -->
                <td align="left" style="font-size: 11px;" width="33%">WET STAINING</td>
                <td align="center" style="font-size: 11px; <?php if($rcek1['stat_cr']=="MARGINAL PASS" AND $rcekM['mcrock_len2']!="" AND $rcekM['mcrock_len2'] < 3.5){echo "color:red;";}else if($rcek1['crock_len2']!="" AND $rcek1['crock_len2'] < 3.5){echo "color:red;";}?>" width="33%"><?php if($rcekM['mcrock_len2']=="" AND $rcek1['crock_len2']==""){echo "N/A";}else if($rcek1['stat_cr']=="MARGINAL PASS"){echo $rcekM['mcrock_len2'];}else if($rcek1['stat_cr']=="MARGINAL PASS" AND $rcekM['mcrock_len2']==""){echo "N/A";}else{echo $rcek1['crock_len2'];}?></td>
                <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 3.5</td>
            </tr>
            <tr>
                <td style="font-size: 12px;" Width="33%" ><strong> Conclusion </strong></td>
                <td align="center"  style="font-size: 12px; <?php echo (($rcek1['stat_cr'] ?? '') == 'FAIL') ? 'color:red;' : ''; ?>" Width="33%"><?php if ($rcek1['stat_cr']!=""){echo $rcek1['stat_cr'];}else{echo "N/A";}?></td>
                <td style="font-size: 12px;" Width="33%"></td>
            </tr>
            <tr>
                <td style="font-size: 12px;" Width="33%" ><strong> Remarks : Grey Scale Rating is based on the 5-step scale of 1 to 5, where 1 is worst and 5 is best </strong></td>
                <td align="center"  style="font-size: 12px;" Width="33%"></td>
                <td style="font-size: 12px;" Width="33%"></td>
            </tr>
            <!-- CROCKING END -->
            <tr>
                <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
            </tr>
            <!-- WATER BEGIN -->
            <tr>
                <!-- <td align="left" style="font-size: 12px;" colspan="3"><strong><u>COLORFASTNESS TO WATER</u></strong> (AATCC 107, MULTIFIBER NO.10)</td> -->
                <td align="left" style="font-size: 12px;" colspan="3"><strong><u>COLORFASTNESS TO WATER</u></strong> (AATCC TM 107-2022)</td>
            </tr>
            <!-- <tr>
                <td align="left" style="font-size: 11px;" width="33%">&nbsp;</td>
                <td align="center" style="font-size: 11px;" width="33%"><strong>T1 (7A) NAVY / T5 (7B) BLACK</strong></td>
                <td align="right" style="font-size: 11px;" width="33%">&nbsp;</td>
            </tr> -->
            <tr>
                <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" style="font-size: 11px;" width="33%">COLOR CHANGE</td>
                <td align="center" style="font-size: 11px; <?php if($rcek1['water_colorchange']!="" AND $rcek1['water_colorchange'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['water_colorchange']!=""){echo $rcek1['water_colorchange'];}else{echo "N/A";}?></td>
                <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
            </tr>
            <tr>
                <td align="left" style="font-size: 11px;" width="33%">SELF - STAINING</td>
                <td align="center" style="font-size: 11px; <?php if($rcek1['water_staining']!="" AND $rcek1['water_staining'] < 4.5){echo "color:red;";}?>" width="33%"><?php if($rcek1['water_staining']!=""){echo $rcek1['water_staining'];}else{echo "N/A";}?></td>
                <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.5</td>
            </tr>
            <!-- <tr>
                <td align="left" style="font-size: 11px;" colspan="3"><u>COLOR STAINING ON</u></td>
            </tr> -->
            <tr>
                <td align="left" style="font-size: 11px;" colspan="3"><u> STAINING ON MULT-FIBER STRIPE</u></td>
            </tr>
            <tr>
                <td align="left" style="font-size: 11px;" width="33%">ACETATE</td>
                <td align="center" style="font-size: 11px; <?php if($rcek1['water_acetate']!="" AND $rcek1['water_acetate'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['water_acetate']!=""){echo $rcek1['water_acetate'];}else{echo "N/A";}?></td>
                <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
            </tr>
            <tr>
                <td align="left" style="font-size: 11px;" width="33%">COTTON</td>
                <td align="center" style="font-size: 11px; <?php if($rcek1['water_cotton']!="" AND $rcek1['water_cotton'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['water_cotton']!=""){echo $rcek1['water_cotton'];}else{echo "N/A";}?></td>
                <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
            </tr>
            <tr>
                <td align="left" style="font-size: 11px;" width="33%">NYLON</td>
                <td align="center" style="font-size: 11px; <?php if($rcek1['water_nylon']!="" AND $rcek1['water_nylon'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['water_nylon']!=""){echo $rcek1['water_nylon'];}else{echo "N/A";}?></td>
                <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
            </tr>
            <tr>
                <td align="left" style="font-size: 11px;" width="33%">POLYESTER</td>
                <td align="center" style="font-size: 11px; <?php if($rcek1['water_poly']!="" AND $rcek1['water_poly'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['water_poly']!=""){echo $rcek1['water_poly'];}else{echo "N/A";}?></td>
                <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
            </tr>
            <tr>
                <td align="left" style="font-size: 11px;" width="33%">ACRYLIC</td>
                <td align="center" style="font-size: 11px; <?php if($rcek1['water_acrylic']!="" AND $rcek1['water_acrylic'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['water_acrylic']!=""){echo $rcek1['water_acrylic'];}else{echo "N/A";}?></td>
                <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
            </tr>
            <tr>
                <td align="left" style="font-size: 11px;" width="33%">WOOL</td>
                <td align="center" style="font-size: 11px; <?php if($rcek1['water_wool']!="" AND $rcek1['water_wool'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['water_wool']!=""){echo $rcek1['water_wool'];}else{echo "N/A";}?></td>
                <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
            </tr>
            <tr>
                <td style="font-size: 12px;" Width="33%" ><strong> Conclusion </strong></td>
                <td align="center"  style="font-size: 12px; <?php echo (($rcek1['stat_wtr'] ?? '') == 'FAIL') ? 'color:red;' : ''; ?>" Width="33%"><?php if($rcek1 !=""){echo $rcek1['stat_wtr'];}else{echo "N/A";}?></td>
                <td style="font-size: 12px;" Width="33%"></td>
            </tr>
            <tr>
                <td style="font-size: 12px;" Width="33%" ><strong> Remarks : Grey Scale Rating is based on the 5-step scale of 1 to 5, where 1 is worst and 5 is best </strong></td>
                <td align="center"  style="font-size: 12px;" Width="33%"></td>
                <td style="font-size: 12px;" Width="33%"></td>
            </tr>
            <!-- WATER END -->
            <tr>
                <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
            </tr>
            <!-- LIGHT FASTNESS BEGIN -->
            <tr>
                <!-- <td align="left" style="font-size: 12px;" colspan="3"><strong><u>COLORFASTNESS TO LIGHT</u></strong> (AATCC 16.3, OPTION 3, WATER COOLED XENON-ARC LAMP, 20 AFU)</td> -->
                <td align="left" style="font-size: 12px;" colspan="3"><strong><u>COLORFASTNESS TO LIGHT</u></strong> (AATCC 16.3-2020, OPTION 3, WATER COOLED XENON-ARC LAMP, 20 AFU)</td>
            </tr>
            <!-- <tr>
                <td align="left" style="font-size: 11px;" width="33%">&nbsp;</td>
                <td align="center" style="font-size: 11px;" width="33%"><strong>T4 (5A) GREEN / T6 (5B) LIGHT GREEN</strong></td>
                <td align="right" style="font-size: 11px;" width="33%">&nbsp;</td>
            </tr> -->
            <!-- <tr>
                <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
            </tr> -->
            <tr>
                <td align="left" style="font-size: 11px;" width="33%">AFTER 20 HOURS</td>
                <td align="center" style="font-size: 11px; <?php if($rcek1['stat_lg']=="MARGINAL PASS" AND $rcekM['mlight_rating1']!="" AND $rcekM['mlight_rating1'] < 4){echo "color:red;";}else if($rcek1['light_rating1']!="" AND $rcek1['light_rating1'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcekM['mlight_rating1']=="" AND $rcek1['light_rating1']==""){echo "N/A";}else if($rcek1['stat_lg']=="MARGINAL PASS"){echo $rcekM['mlight_rating1'];}else if($rcek1['stat_lg']=="MARGINAL PASS" AND $rcekM['mlight_rating1']==""){echo "N/A";}else{echo $rcek1['light_rating1'];}?></td>
                <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
            </tr>
            <tr>
                <td align="left" style="font-size: 11px;" width="33%">CHANGE IN SHADE</td>
            </tr>
            <tr>
                <td style="font-size: 12px;" Width="33%" ><strong> Conclusion </strong></td>
                <td align="center"  style="font-size: 12px; <?php echo (($rcek1['stat_lg'] ?? '') == 'FAIL') ? 'color:red;' : ''; ?>" Width="33%"><?php if($rcek1['stat_lg'] !=""){echo $rcek1['stat_lg'];}else{echo "N/A";}?></td>
                <td style="font-size: 12px;" Width="33%"></td>
            </tr>
            <tr>
                <td style="font-size: 12px;" Width="33%" ><strong> Remaks : Grey Scale Rating is based on the 5-step scale of 1 to 5, where 1 is worst and 5 is best</strong></td>
                <td align="center"  style="font-size: 12px;" Width="33%"></td>
                <td style="font-size: 12px;" Width="33%"></td>
            </tr>
            <!-- LIGHT PERSPIRATION END -->
            <tr>
                <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
            </tr>
            <!-- PHENOLIC YELLOWING BEGIN -->
            <tr>
                <td align="left" style="font-size: 12px;" colspan="3"><strong><u>COLORFASTNESS TO PHENOLIC YELLOWING </u></strong> (ISO 105-X18:2017)</td>
            </tr>
            <!-- <tr>
                <td align="left" style="font-size: 11px;" width="33%">&nbsp;</td>
                <td align="center" style="font-size: 11px;" width="33%"><strong>T1 / T2 WHITE STRIPE</strong></td>
                <td align="right" style="font-size: 11px;" width="33%">&nbsp;</td>
            </tr> -->
            <!-- <tr>
                <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
            </tr> -->
            <tr>
                <td align="left" style="font-size: 11px;" width="33%">COLOR STAINING</td>
                <td align="center" style="font-size: 11px; <?php if($rcek1['phenolic_colorchange']!="" AND $rcek1['phenolic_colorchange'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['phenolic_colorchange']!=""){echo $rcek1['phenolic_colorchange'];}else{echo "N/A";}?></td>
                <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
            </tr>
            <tr>
                <td style="font-size: 12px;" Width="33%" ><strong> Conclusion </strong></td>
                <td align="center"  style="font-size: 12px; <?php echo (($rcek1['stat_py'] ?? '') == 'FAIL') ? 'color:red;' : ''; ?>" Width="33%"><?php if($rcek1['stat_py'] !=""){echo $rcek1['stat_py'];}else{echo "N/A";}?></td>
                <td style="font-size: 12px;" Width="33%"></td>
            </tr>
            <tr>
                <td style="font-size: 12px;" Width="33%" ><strong> Remaks : Grey Scale Rating is based on the 5-step scale of 1 to 5, where 1 is worst and 5 is best</strong></td>
                <td align="center"  style="font-size: 12px;" Width="33%"></td>
                <td style="font-size: 12px;" Width="33%"></td>
            </tr>
            <!-- PHENOLIC YELLOWING END -->
            <tr>
                <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
            </tr>
            <!-- PILLING TUMBLE BEGIN -->
            <tr>
                <td align="left" style="font-size: 12px;" colspan="3"><strong><u>PILLING RESISTANCE : TUMBLE PILLING METHOD</u></strong> (ASTM D3512/D3512M-2022)</td>
            </tr>
            <tr>
                <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" style="font-size: 11px;" width="33%">30 MIN</td>
                <td align="center" style="font-size: 11px;" width="33%">&nbsp;</td>
                <td align="right" style="font-size: 11px;" width="33%">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" style="font-size: 11px;" width="33%">FACE</td>
                <td align="center" style="font-size: 11px;" width="33%"><?php if($rcek1['prt_f1']!=""){echo $rcek1['prt_f1'];}else{echo "N/A";}?></td>
                <td align="right" style="font-size: 11px;" width="33%"><input style="font-size: 11px; text-align:right" name="notepm" type="text" placeholder="Ketik" size="50" /></td>
            </tr>
            <!--
            <tr>
                <td align="left" style="font-size: 11px;" width="33%">BACK</td>
                <td align="center" style="font-size: 11px;" width="33%"><?php if($rcek1['prt_b1']!=""){echo $rcek1['prt_b1'];}else{echo "N/A";}?></td>
                <td align="right" style="font-size: 11px;" width="33%"><input style="font-size: 11px; text-align:right" name="notepm" type="text" placeholder="Ketik" size="15" /></td>
            </tr>-->
            <tr>
                <td align="left" style="font-size: 11px;" colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" style="font-size: 11px;" width="33%">60 MIN</td>
                <td align="center" style="font-size: 11px;" width="33%">&nbsp;</td>
                <td align="right" style="font-size: 11px;" width="33%">&nbsp;</td>
            </tr>
        
            <tr>
                <td align="left" style="font-size: 11px;" width="33%">FACE</td>
                <td align="center" style="font-size: 11px;" width="33%"><?php if($rcek1['prt_f2']!=""){echo $rcek1['prt_f2'];}else{echo "N/A";}?></td>
                <td align="right" style="font-size: 11px;" width="33%"><input style="font-size: 11px; text-align:right" name="notepm" type="text" placeholder="Ketik" size="50" /></td>
            </tr>
            <!--
            <tr>
                <td align="left" style="font-size: 11px;" width="33%">BACK</td>
                <td align="center" style="font-size: 11px;" width="33%"><?php if($rcek1['prt_b2']!=""){echo $rcek1['prt_b2'];}else{echo "N/A";}?></td>
                <td align="right" style="font-size: 11px;" width="33%"><input style="font-size: 11px; text-align:right" name="notepm" type="text" placeholder="Ketik" size="15" /></td>
            </tr>
            -->
            <!-- WATER END -->
        </table>
        <div class="pagebreak"></div>
    <!-- Page 6 End -->
    <!-- Page 7 Begin -->
    <table width="100%">
        <tr>
            <td align="right" style="font-size: 12px;"><?php echo $rd2['no_rptlulu'];?><?php if($rd2['sts_rev']=="1" AND $rd2['revisi']!=""){echo "-".$rd2['revisi'];}?></td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">Page 7 of 9</td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;"><?php echo date("F j, Y", strtotime($rd2['date_out1']));?></td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td align="left" style="font-size: 12px;" width="33%">&nbsp;</td>
            <td align="center" style="font-size: 12px;" width="33%"><u>TEST RESULT</u></td>
            <td align="right" style="font-size: 12px;" width="33%">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="33%"><u>TEST PROPERTY</u></td>
            <td align="center" style="font-size: 12px;" width="33%">&nbsp;</td>
            <td align="right" style="font-size: 12px;" width="33%"><u>REQUIREMENT</u></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" colspan="3">&nbsp;</td> 
        </tr>
        <!-- PERSPIRATION ACID BEGIN -->
        <tr>
            <!-- <td align="left" style="font-size: 12px;" colspan="3"><strong><u>COLORFASTNESS TO PERSPIRATION</u></strong> (AATCC 15, AATCC GRAY SCALE, MULTIFIBER NO.10)</td> -->
            <td align="left" style="font-size: 12px;" colspan="3"><strong><u>COLORFASTNESS TO PERSPIRATION</u></strong> (AATCC TM 15-2021E)</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <!-- <td align="left" style="font-size: 11px;" width="33%">ACIDIC</td> -->
            <td align="left" style="font-size: 11px;" width="33%">ACID PERSPIRATION SOLUTION</td>
            <!-- <td align="center" style="font-size: 11px;" width="33%"><strong>T1 (6A) BLACK / T5 (6B) NAVY</strong></td> -->
            <td align="center" style="font-size: 11px;" width="33%">&nbsp;</td>
            <td align="right" style="font-size: 11px;" width="33%">&nbsp;</td>
        </tr>
        <tr>
            <!-- <td align="left" style="font-size: 11px;" width="33%">COLOR CHANGE</td> -->
            <td align="left" style="font-size: 11px;" width="33%">CHANGE IN SHADE</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['acid_colorchange']!="" AND $rcek1['acid_colorchange'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['acid_colorchange']!=""){echo $rcek1['acid_colorchange'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">SELF - STAINING</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['acid_staining']!="" AND $rcek1['acid_staining'] < 4.5){echo "color:red;";}?>" width="33%"><?php if($rcek1['acid_staining']!=""){echo $rcek1['acid_staining'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.5</td>
        </tr>
        <tr>
            <!-- <td align="left" style="font-size: 11px;" colspan="3"><u>COLOR STAINING ON</u></td> -->
            <td align="left" style="font-size: 11px;" colspan="3"><u>STAINING ON MULTI-FIBER STRIPE</u></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">ACETATE</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['acid_acetate']!="" AND $rcek1['acid_acetate'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['acid_acetate']!=""){echo $rcek1['acid_acetate'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">COTTON</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['acid_cotton']!="" AND $rcek1['acid_cotton'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['acid_cotton']!=""){echo $rcek1['acid_cotton'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">NYLON</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['acid_nylon']!="" AND $rcek1['acid_nylon'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['acid_nylon']!=""){echo $rcek1['acid_nylon'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">POLYESTER</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['acid_poly']!="" AND $rcek1['acid_poly'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['acid_poly']!=""){echo $rcek1['acid_poly'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">ACRYLIC</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['acid_acrylic']!="" AND $rcek1['acid_acrylic'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['acid_acrylic']!=""){echo $rcek1['acid_acrylic'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">WOOL</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['acid_wool']!="" AND $rcek1['acid_wool'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['acid_wool']!=""){echo $rcek1['acid_wool'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
        </tr>
        <!-- PERSPIRATION ACID END -->
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <!-- PERSPIRATION ALKALINE BEGIN -->
        <tr>
            <!-- <td align="left" style="font-size: 11px;" width="33%">ALKALINE</td> -->
            <td align="left" style="font-size: 11px;" width="33%">ALKALINE PERSPIRATION SOLUTION</td>
            <!-- <td align="center" style="font-size: 11px;" width="33%"><strong>T1 (6A) BLACK / T5 (6B) NAVY</strong></td> -->
            <td align="right" style="font-size: 11px;" width="33%">&nbsp;</td>
            <td align="right" style="font-size: 11px;" width="33%">&nbsp;</td>
        </tr>
        <tr>
            <!-- <td align="left" style="font-size: 11px;" width="33%">COLOR CHANGE</td> -->
            <td align="left" style="font-size: 11px;" width="33%">CHANGE IN SHADE</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['alkaline_colorchange']!="" AND $rcek1['alkaline_colorchange'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['alkaline_colorchange']!=""){echo $rcek1['alkaline_colorchange'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">SELF - STAINING</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['alkaline_staining']!="" AND $rcek1['alkaline_staining'] < 4.5){echo "color:red;";}?>" width="33%"><?php if($rcek1['alkaline_staining']!=""){echo $rcek1['alkaline_staining'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.5</td>
        </tr>
        <tr>
            <!-- <td align="left" style="font-size: 11px;" colspan="3"><u>COLOR STAINING ON</u></td> -->
            <td align="left" style="font-size: 11px;" colspan="3"><u>STAINING ON MULTI-FIBER STRIPE</u></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">ACETATE</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['alkaline_acetate']!="" AND $rcek1['alkaline_acetate'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['alkaline_acetate']!=""){echo $rcek1['alkaline_acetate'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">COTTON</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['alkaline_cotton']!="" AND $rcek1['alkaline_cotton'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['alkaline_cotton']!=""){echo $rcek1['alkaline_cotton'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">NYLON</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['alkaline_nylon']!="" AND $rcek1['alkaline_nylon'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['alkaline_nylon']!=""){echo $rcek1['alkaline_nylon'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">POLYESTER</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['alkaline_poly']!="" AND $rcek1['alkaline_poly'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['alkaline_poly']!=""){echo $rcek1['alkaline_poly'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">ACRYLIC</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['alkaline_acrylic']!="" AND $rcek1['alkaline_acrylic'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['alkaline_acrylic']!=""){echo $rcek1['alkaline_acrylic'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">WOOL</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['alkaline_wool']!="" AND $rcek1['alkaline_wool'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['alkaline_wool']!=""){echo $rcek1['alkaline_wool'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.0</td>
        </tr>
           <tr>
            <td style="font-size: 12px;" Width="33%" ><strong> Conclusion </strong></td>
            <td align="center"  style="font-size: 12px; <?php echo (($rcek1['stat_pal'] ?? '') == 'FAIL') ? 'color:red;' : ''; ?>"  Width="33%"><?php if($rcek1['stat_pal'] !=""){echo $rcek1['stat_pal'];}else{echo "N/A";}?></td></td>
            <td style="font-size: 12px;" Width="33%"></td>
        </tr>
         <tr>
            <td style="font-size: 12px;" Width="33%" ><strong> Remaks : Grey Scale Rating is based on the 5-step scale of 1 to 5, where 1 is bad and 5 is good </strong></td>
            <td align="center"  style="font-size: 12px;" Width="33%"></td>
            <td style="font-size: 12px;" Width="33%"></td>
        </tr>
        <!-- PERSPIRATION ALKALINE END -->
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <!-- DYE TRANSFER BEGIN -->
    </table>
    <table width="100%">
        <tr>
            <td align="left" style="font-size: 12px;" colspan="3"><strong><u>COLORFASTNESS TO DYE TRANSFER IN STORAGE</u></strong> (AATCC 163 -2013(2020) E3 (MODIFIED) MULTIFIBER NO.10, 4 HOURS, 70 DEGREE CELCIUS)</td>
        </tr>
        <!-- <tr>
            <td align="left" style="font-size: 11px;" width="33%">&nbsp;</td>
            <td align="center" style="font-size: 11px;" width="33%"><strong>T1 (3A) BLACK / T5 (3B) NAVY</strong></td>
            <td align="right" style="font-size: 11px;" width="33%">&nbsp;</td>
        </tr> -->
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">SELF STAINING (WHITE FABRIC)</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['dye_tf_sstaining']!="" AND $rcek1['dye_tf_sstaining'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['dye_tf_sstaining']==""){echo "N/A";}else{echo $rcek1['dye_tf_sstaining'];}?></td>
            <td align="right" style="font-size: 11px;" width="33%" colspan="2">MIN GRADE 4.0</td>
        </tr>
        <tr>
            <!-- <td align="left" style="font-size: 11px;" width="33%">COLOR CHANGE</td> -->
            <td align="left" style="font-size: 11px;" width="33%">CHANGE IN SHADE</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['dye_tf_cstaining']!="" AND $rcek1['dye_tf_cstaining'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['dye_tf_cstaining']==""){echo "N/A";}else{echo $rcek1['dye_tf_cstaining'];}?></td>
            <td align="right" style="font-size: 11px;" width="33%" colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <!-- <td align="left" style="font-size: 11px;" colspan="3">COLOR STAINING ON</td> -->
            <td align="left" style="font-size: 11px;" colspan="3">STAINING ON MULTI-FIBER STRIPE</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">ACETATE</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['dye_tf_acetate']!="" AND $rcek1['dye_tf_acetate'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['dye_tf_acetate']==""){echo "N/A";}else{echo $rcek1['dye_tf_acetate'];}?></td>
            <td align="right" style="font-size: 11px;" width="33%" colspan="2">MIN GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">COTTON</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['dye_tf_cotton']!="" AND $rcek1['dye_tf_cotton'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['dye_tf_cotton']==""){echo "N/A";}else{echo $rcek1['dye_tf_cotton'];}?></td>
            <td align="right" style="font-size: 11px;" width="33%" colspan="2">MIN GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">NYLON</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['dye_tf_nylon']!="" AND $rcek1['dye_tf_nylon'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['dye_tf_nylon']==""){echo "N/A";}else{echo $rcek1['dye_tf_nylon'];}?></td>
            <td align="right" style="font-size: 11px;" width="33%" colspan="2">MIN GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">POLYESTER</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['dye_tf_poly']!="" AND $rcek1['dye_tf_poly'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['dye_tf_poly']==""){echo "N/A";}else{echo $rcek1['dye_tf_poly'];}?></td>
            <td align="right" style="font-size: 11px;" width="33%" colspan="2">MIN GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">ACRYLIC</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['dye_tf_acrylic']!="" AND $rcek1['dye_tf_acrylic'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['dye_tf_acrylic']==""){echo "N/A";}else{echo $rcek1['dye_tf_acrylic'];}?></td>
            <td align="right" style="font-size: 11px;" width="33%" colspan="2">MIN GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">WOOL</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['dye_tf_wool']!="" AND $rcek1['dye_tf_wool'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['dye_tf_wool']==""){echo "N/A";}else{echo $rcek1['dye_tf_wool'];}?></td>
            <td align="right" style="font-size: 11px;" width="33%" colspan="2">MIN GRADE 4.0</td>
        </tr>
    </table>
        <table width="100%">
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">COLORFASTNESS RATING</td>
            <td align="left" style="font-size: 11px;"  >COLORFASTNESS RATING</td>
       

        </tr>
        <tr>
            <td align="left" style="font-size: 11px;"width="33%" >COLOR CHANGE</td>
            <td align="left" style="font-size: 11px;"width="33%" >COLOR STAIN AND SELF-STAINING</td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <!-- <td></td> -->
            <td align="center" style="font-size: 11px;" >5</td>
            <td align="left" style="font-size: 11px;" >NEGLIGIBLE OR NO CHANGE</td>
            <td align="center" style="font-size: 11px;">5</td>
            <td align="left" style="font-size: 11px;">NEGLIGIBLE OR NO STAINING</td>
        </tr>
        <tr>
            <td align="center" style="font-size: 11px;">4</td>
            <td align="left" style="font-size: 11px;">SLIGHTLY CHANGED</td>
            <td align="center" style="font-size: 11px;">4</td>
            <td align="left" style="font-size: 11px;">SLIGHTLY STAINED</td>
        </tr>
        <tr>
            <td align="center" style="font-size: 11px;">3</td>
            <td align="left" style="font-size: 11px;">NOTICEABLY CHANGED</td>
            <td align="center" style="font-size: 11px;">3</td>
            <td align="left" style="font-size: 11px;">NOTICEABLY STAINED</td>
        </tr>
        <tr>
            <td align="center" style="font-size: 11px;">2</td>
            <td align="left" style="font-size: 11px;">CONSIDERABLY CHANGED</td>
            <td align="center" style="font-size: 11px;">2</td>
            <td align="left" style="font-size: 11px;">CONSIDERABLY STAINED</td>
        </tr>
        <tr>
            <td align="center" style="font-size: 11px;">1</td>
            <td align="left" style="font-size: 11px;">MUCH CHANGED</td>
            <td align="center" style="font-size: 11px;">1</td>
            <td align="left" style="font-size: 11px;">MUCH STAINED</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" colspan="4">* INDICATES DOES NOT MEET THE REQUIREMENT</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" colspan="4">** MARGINAL PASS</td>
        </tr>
    </table>
    <table width="100%">
        <!-- <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr> -->
        <!-- DYE TRANSFER END -->
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td style="font-size: 12px;" Width="33%" ><strong> Conclusion </strong></td>
            <td align="center"  style="font-size: 12px; <?php echo (($rcek1['stat_dye'] ?? '') == 'FAIL') ? 'color:red;' : ''; ?>" Width="33%"><?php if($rcek1['stat_dye']!=""){echo $rcek1['stat_dye'].' ONLY';}else{echo 'N/A';}?></td>
            <td style="font-size: 12px;" Width="33%"></td>
        </tr>
        <tr>
            <td style="font-size: 12px;" Width="33%" ><strong> Remaks : Grey Scale Rating is based on the 5-step scale of 1 to 5, where 1 is bad and 5 is good </strong></td>
            <td align="center"  style="font-size: 12px;" Width="33%"></td>
            <td style="font-size: 12px;" Width="33%"></td>
        </tr>
    </table>
    <div class="pagebreak"></div>
    <!-- Page 6 End -->
    <!-- Page 7 Begin -->
    <table width="100%">
        <tr>
            <td align="right" style="font-size: 12px;"><?php echo $rd2['no_rptlulu'];?><?php if($rd2['sts_rev']=="1" AND $rd2['revisi']!=""){echo "-".$rd2['revisi'];}?></td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">Page 8 of 9</td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;"><?php echo date("F j, Y", strtotime($rd2['date_out1']));?></td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td align="left" style="font-size: 12px;" width="33%">&nbsp;</td>
            <td align="center" style="font-size: 12px;" width="33%"><u>TEST RESULT</u></td>
            <td align="right" style="font-size: 12px;" width="33%">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="33%"><u>TEST PROPERTY</u></td>
            <td align="center" style="font-size: 12px;" width="33%">&nbsp;</td>
            <td align="right" style="font-size: 12px;" width="33%"><u>REQUIREMENT</u></td>
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
       
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <!-- APPEARANCE BEGIN -->
        <tr>
            <td align="left" style="font-size: 12px;" colspan="3"><strong><u>APPEARANCE AFTER WASHING<!--LAUNDERING-->(TS-008)</u></strong> (MODIFIED)(WASHING PROCEDURE SAME AS WASHING SHRINKAGE)</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" ><u>AFTER 1 WASH</u></td>
            <td align="center" style="font-size: 11px;" >&nbsp;</td>
            <td align="left" style="font-size: 11px;" >&nbsp;</td>
        </tr>
        <tr>
            <!-- <td align="left" style="font-size: 11px;" width="33%">APPEARANCE EVALUATION</td> -->
            <td align="left" style="font-size: 11px;" width="33%">OBSERVATION ON WASHED SAMPLE</td>
            <td align="left" style="font-size: 11px;" width="33%">&nbsp;</td>
            <td align="right" style="font-size: 11px;" width="33%">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">COLOR CHANGE</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['apper_cc1']!="" AND $rcek1['apper_cc1'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['apper_cc1']!=""){echo $rcek1['apper_cc1'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN. GRADE 4.0</td>
        </tr>
        <!-- HERE -->
        <tr>
            <!-- <td align="left" style="font-size: 11px;" width="33%">SELF - STAINING</td> -->
            <td align="left" style="font-size: 11px;" width="33%">CROSS - STAINING</td>
            <!-- <td align="center" style="font-size: 11px; <?php if($rcek1['apper_st']!="" AND $rcek1['apper_st'] < 4.5){echo "color:red;";}?>" width="33%"><?php if($rcek1['apper_st']!=""){echo $rcek1['apper_st'];}else{echo "N/A";}?></td> -->
            <td align="center" style="font-size: 11px;" width="33%"><?php echo "N/A";?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN. GRADE 4.5</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">FABRIC WRINKLING</td>
            <td align="center" style="font-size: 11px;" width="33%">SLIGHT</td>
            <td align="right" style="font-size: 11px;" width="33%">SLIGHT</td>
        </tr>
        <tr>
            <!-- <td align="left" style="font-size: 11px;" width="33%">PILLING AND FUZZING HAIR</td> -->
            <td align="left" style="font-size: 11px;" width="33%">PILLING/FUZZING</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['apper_pf1']!="" AND $rcek1['apper_pf1'] < 4){echo "color:red;";}?>" width="33%">FACE: <?php if($rcek1['apper_pf1']!=""){echo $rcek1['apper_pf1'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN. GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">&nbsp;</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['apper_pb1']!="" AND $rcek1['apper_pb1'] < 4){echo "color:red;";}?>" width="33%">BACK: <?php if($rcek1['apper_pb1']!=""){echo $rcek1['apper_pb1'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN. GRADE 4.0</td>
        </tr>
        <tr>
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">SHAPE</td>
            <td align="center" style="font-size: 11px;" width="33%">SLIGHT DISTORTION</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">FIBRILLATION</td>
            <td align="center" style="font-size: 11px;" width="33%">NEGLIGIBLE CHANGE</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">OTHER</td>
            <td align="center" style="font-size: 11px;" width="33%">NO HOLE OR OTHER</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">&nbsp;</td>
            <td align="center" style="font-size: 11px;" width="33%">SIGNS OF ABRASION</td>
        </tr>
        <tr>
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">OVERALL APPEARANCE WAS FOUND</td>
            <td align="left" style="font-size: 11px;" width="33%">
                <table width="100%" style="border-collapse: collapse;">
                    <tr>
                        <td align="center" style="<?php if($rcek1['apper_pf1'] < 4 || $rcek1['apper_pb1'] < 4 || $rcek1['apper_cc1'] < 4){echo "color:red;";}else{echo "";}?>" width="50%"><?php if($rcek1['apper_pf1'] < 4 || $rcek1['apper_pb1'] < 4 || $rcek1['apper_cc1'] < 4 ){echo "UNSATISFACTORY asdf";}else{echo "SATISFACTORY";}?></td>
                        <!-- <td align="left" width="50%">N/A</td> -->
                    </tr>
                </table>
            </td>
    
            <td align="right" style="font-size: 11px;" width="33%">SATISFACTORY</td>
        </tr>
        <!-- <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr> -->
        <tr>
            <td align="left" style="font-size: 11px;" colspan="3">CROSS STAINING</td>
        </tr>
        <!-- <tr>
            <td align="left" style="font-size: 11px;" colspan="3">COLOR STAIN ON</td>
        </tr> -->
        <tr>
            <td align="left" style="font-size: 11px;" colspan="3">COLOR STAINING AFTER 1 WASH</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">ACETATE</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['apper_acetate']!="" AND $rcek1['apper_acetate'] < 4.5){echo "color:red;";}?>" width="33%"><?php if($rcek1['apper_acetate']!=""){echo $rcek1['apper_acetate'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.5</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">COTTON</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['apper_cotton']!="" AND $rcek1['apper_cotton'] < 4.5){echo "color:red;";}?>" width="33%"><?php if($rcek1['apper_cotton']!=""){echo $rcek1['apper_cotton'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.5</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">NYLON</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['apper_nylon']!="" AND $rcek1['apper_nylon'] < 4.5){echo "color:red;";}?>" width="33%"><?php if($rcek1['apper_nylon']!=""){echo $rcek1['apper_nylon'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.5</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">POLYESTER</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['apper_poly']!="" AND $rcek1['apper_poly'] < 4.5){echo "color:red;";}?>" width="33%"><?php if($rcek1['apper_poly']!=""){echo $rcek1['apper_poly'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.5</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">ACRYLIC</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['apper_acrylic']!="" AND $rcek1['apper_acrylic'] < 4.5){echo "color:red;";}?>" width="33%"><?php if($rcek1['apper_acrylic']!=""){echo $rcek1['apper_acrylic'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.5</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">WOOL</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['apper_wool']!="" AND $rcek1['apper_wool'] < 4.5){echo "color:red;";}?>" width="33%"><?php if($rcek1['apper_wool']!=""){echo $rcek1['apper_wool'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN GRADE 4.5</td>
        </tr>
        <tr>
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" colspan="3"><strong><u>APPEARANCE AFTER WASHING<!--LAUNDERING-->(TS-008)</u></strong> (MODIFIED)</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" colspan="3"><u>AFTER 5 WASH</u></td>
        </tr>
        <tr>
            <!-- <td align="left" style="font-size: 11px;" width="33%">APPEARANCE EVALUATION</td> -->
            <td align="left" style="font-size: 11px;" width="33%">OBSERVATION ON WASHED SAMPLE</td>
            <td align="left" style="font-size: 11px;" width="33%">&nbsp;</td>
            <td align="right" style="font-size: 11px;" width="33%">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">COLOR CHANGE</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['apper_cc2']!="" AND $rcek1['apper_cc2'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['apper_cc2']!=""){echo $rcek1['apper_cc2'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN. GRADE 4.0</td>
        </tr>
        <!-- HERE -->
        <tr>
            <!-- <td align="left" style="font-size: 11px;" width="33%">SELF - STAINING</td> -->
            <td align="left" style="font-size: 11px;" width="33%">CROSS - STAINING</td>
            <!-- <td align="center" style="font-size: 11px; <?php if($rcek1['apper_st2']!="" AND $rcek1['apper_st2'] < 4.5){echo "color:red;";}?>" width="33%"><?php if($rcek1['apper_st2']!=""){echo $rcek1['apper_st2'];}else{echo "N/A";}?></td> -->
            <td align="center" style="font-size: 11px;" width="33%"><?php echo "N/A";?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN. GRADE 4.5</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">FABRIC WRINKLING</td>
            <td align="center" style="font-size: 11px;" width="33%">SLIGHT</td>
            <td align="right" style="font-size: 11px;" width="33%">SLIGHT</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">PILLING/FUZZING</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['apper_pf2']!="" AND $rcek1['apper_pf2'] < 4){echo "color:red;";}?>" width="33%">FACE: <?php if($rcek1['apper_pf2']!=""){echo $rcek1['apper_pf2'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN. GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">&nbsp;</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['apper_pb2']!="" AND $rcek1['apper_pb2'] < 4){echo "color:red;";}?>" width="33%">BACK: <?php if($rcek1['apper_pb2']!=""){echo $rcek1['apper_pb2'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN. GRADE 4.0</td>
        </tr>
        <tr>
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">SHAPE</td>
            <td align="center" style="font-size: 11px;" width="33%">SLIGHT DISTORTION</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">FIBRILLATION</td>
            <td align="center" style="font-size: 11px;" width="33%">NEGLIGIBLE CHANGE</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">OTHER</td>
            <td align="center" style="font-size: 11px;" width="33%">NO HOLE OR OTHER</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">&nbsp;</td>
            <td align="center" style="font-size: 11px;" width="33%">SIGNS OF ABRASION</td>
        </tr>
        <tr>
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">OVERALL APPEARANCE WAS FOUND</td>
            <td align="center" style="font-size: 11px; <?php if(($rcek1['apper_pb2']!="" AND $rcek1['apper_pb2'] < 4)||($rcek1['apper_pf2']!="" AND $rcek1['apper_pf2'] < 4)||($rcek1['apper_cc2']!="" AND $rcek1['apper_cc2'] < 4)){echo "color:red;";}else{echo "";}?>" width="33%"><?php if(($rcek1['apper_pb2']!="" AND $rcek1['apper_pb2'] < 4)||($rcek1['apper_pf2']!="" AND $rcek1['apper_pf2'] < 4)||($rcek1['apper_cc2']!="" AND $rcek1['apper_cc2'] < 4)){echo"UNSATISFACTORY";}else{echo"SATISFACTORY";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">SATISFACTORY</td>
        </tr>
        <tr>
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" colspan="3"><u>AFTER 10 WASH</u></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">OBSERVATION ON WASHED SAMPLE</td>
            <td align="center" style="font-size: 11px;" width="33%">&nbsp;</td>
            <td align="right" style="font-size: 11px;" width="33%">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">COLOR CHANGE</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['apper_cc3']!="" AND $rcek1['apper_cc3'] < 4){echo "color:red;";}?>" width="33%"><?php if($rcek1['apper_cc3']!=""){echo $rcek1['apper_cc3'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN. GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">CROSS - STAINING</td>
            <!-- <td align="center" style="font-size: 11px; <?php if($rcek1['apper_st3']!="" AND $rcek1['apper_st3'] < 4.5){echo "color:red;";}?>" width="33%"><?php if($rcek1['apper_st3']!=""){echo $rcek1['apper_st3'];}else{echo "N/A";}?></td> -->
            <td align="center" style="font-size: 11px;" width="33%"><?php echo "N/A";?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN. GRADE 4.5</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">FABRIC WRINKLING</td>
            <td align="center" style="font-size: 11px;" width="33%">SLIGHT</td>
            <td align="right" style="font-size: 11px;" width="33%">SLIGHT</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">PILLING/FUZZING</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['apper_pf3']!="" AND $rcek1['apper_pf3'] < 4){echo "color:red;";}?>" width="33%">FACE: <?php if($rcek1['apper_pf3']!=""){echo $rcek1['apper_pf3'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN. GRADE 4.0</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">&nbsp;</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['apper_pb3']!="" AND $rcek1['apper_pb3'] < 4){echo "color:red;";}?>" width="33%">BACK: <?php if($rcek1['apper_pb3']!=""){echo $rcek1['apper_pb3'];}else{echo "N/A";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">MIN. GRADE 4.0</td>
        </tr>
        <tr>
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">SHAPE</td>
            <td align="center" style="font-size: 11px;" width="33%">SLIGHT DISTORTION</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">FIBRILLATION</td>
            <td align="center" style="font-size: 11px;" width="33%">NEGLIGIBLE CHANGE</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">OTHER</td>
            <td align="center" style="font-size: 11px;" width="33%">NO HOLE OR OTHER</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">&nbsp;</td>
            <td align="center" style="font-size: 11px;" width="33%">SIGNS OF ABRASION</td>
        </tr>
        <tr>
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" width="33%">OVERALL APPEARANCE WAS FOUND</td>
            <td align="center" style="font-size: 11px; <?php if($rcek1['apper_cc3'] < 4||$rcek1['apper_pf3'] < 4 || $rcek1['apper_pb3'] < 4){echo "color:red;";}else{echo "";}?>" width="33%"><?php if($rcek1['apper_cc3'] < 4||$rcek1['apper_pf3'] < 4 || $rcek1['apper_pb3'] < 4){ echo "UNSATISFACTORY"; }else{echo "SATISFACTORY";}?></td>
            <td align="right" style="font-size: 11px;" width="33%">SATISFACTORY</td>
        </tr>
        <tr>
            <td style="font-size: 12px;" Width="33%" ><strong> Conclusion </strong></td>
            <td align="center"  style="font-size: 12px; <?php echo (($rcek1['stat_ap'] ?? '') == 'FAIL') ? 'color:red;' : ''; ?>" Width="33%"><?php if($rcek1['stat_ap']!=""){echo $rcek1['stat_ap'];}else{echo "N/A";}?></td>
            <td style="font-size: 12px;" Width="33%"></td>
        </tr>
        <tr>
            <td style="font-size: 12px;" Width="35%" ><strong> Remaks : Grey Scale Rating is based on the 5-step scale of 1 to 5, where 1 is worst and 5 is best <br> Note: Washing procedure: Same as shrinkage</strong></td>
            <td align="center"  style="font-size: 12px;" Width="33%"></td>
            <td style="font-size: 12px;" Width="33%"></td>
        </tr>
        <!-- APPEARANCE END -->
    </table>
    <div class="pagebreak"></div>
    <!-- Page 7 End -->
    <!-- Page 8 Begin -->
    <table width="100%">
        <tr>
            <td align="right" style="font-size: 12px;"><?php echo $rd2['no_rptlulu'];?><?php if($rd2['sts_rev']=="1" AND $rd2['revisi']!=""){echo "-".$rd2['revisi'];}?></td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">Page 9 of 9</td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;"><?php echo date("F j, Y", strtotime($rd2['date_out1']));?></td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 12px;">&nbsp;</td> 
        </tr>
    </table> 
    <table width="100%">
        <tr>
            <td align="left" style="font-size: 12px;" width="33%">&nbsp;</td>
            <td align="center" style="font-size: 12px;" width="33%"><u>TEST RESULT</u></td>
            <td align="right" style="font-size: 12px;" width="33%">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" style="font-size: 12px;" width="33%"><u>TEST PROPERTY</u></td>
            <td align="center" style="font-size: 12px;" width="33%">&nbsp;</td>
            <td align="right" style="font-size: 12px;" width="33%"><u>REQUIREMENT</u></td>
        </tr>
        <tr>
            <td align="center" style="font-size: 12px;" colspan="3">&nbsp;</td>
        </tr>
        <!-- STRETCH AND RECOVERY BEGIN -->
        <tr>
            <?php
            $ExtensionTEXT = $rd2['extension'] ?? '';

            if ($ExtensionTEXT == "BS EN ISO 20932-1 (MODIFIED)" || $ExtensionTEXT == "BS EN ISO 20932-1:2020+A1:2021 METHODE A") {
                $ExtensionTEXT = "BS EN ISO 20932-1:2020+A1:2021 METHODE A";
            }
            ?>
            <td align="left" style="font-size: 12px;" colspan="3"><strong><u>ELONGATION, MODULUS & RECOVERY</u></strong><?php echo "( " . $ExtensionTEXT . ")"; ?><?php echo "(TESTING SPEED AT 500MM/MIN; RETURNING SPEED AT 20 INCH/MIN; GAUGE LENGHT 100MM; TEST FOR 2 CYCLES)";?></td>
        </tr>
        <!-- <tr>
            <td align="left" style="font-size: 11px;" colspan="3"><?php echo "(".$rd2['extension'].")";?></td>              
        </tr>
        <tr>30 min
            <td align="center" style="font-size: 11px;" colspan="3">&nbsp;</td>
        </tr> -->
        <tr>
            <td><select name="ext" style="border:none;font-size: 11px;-webkit-appearance: none;">
                <option value="1.5 kg">1.5 kg</option>
                <option value="15N">15N</option>
                <option value="20N">20N</option>
                <option value="25N">25N</option>
                <option value="35N">35N</option>
            </select></td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">LENGTH - MODULUS @ 10% EXTENSION</td> 
            <td align="center" style="font-size: 11px;"><?php if( $rcek1['stretch_l2']!=""){echo  $rcek1['stretch_l2'];}else{echo "N/A";}?></td> 
            <!-- <td align="center" style="font-size: 11px;">N/A</td>  -->
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">LENGTH - MODULUS @ 30% EXTENSION</td> 
            <td align="center" style="font-size: 11px;"><?php if($rcek1['stretch_l3']!=""){echo $rcek1['stretch_l3'];}else{echo "N/A";}?></td> 
            <!-- <td align="center" style="font-size: 11px;">N/A</td>  -->
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">LENGTH - MODULUS @ 50% EXTENSION</td> 
            <td align="center" style="font-size: 11px;"><?php if($rcek1['stretch_l4']!=""){echo $rcek1['stretch_l4'];}else{echo "N/A";}?></td> 
            <!-- <td align="center" style="font-size: 11px;">N/A</td>  -->
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">LENGTH - MODULUS @ 80% EXTENSION</td> 
            <td align="center" style="font-size: 11px;"><?php if($rcek1['stretch_l5']!=""){echo $rcek1['stretch_l5'];}else{echo "N/A";}?></td> 
            <!-- <td align="center" style="font-size: 11px;">N/A</td>  -->
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">LENGTH - TOTAL ELONGATION</td> 
            <td align="center" style="font-size: 11px;"><?php if($rcek1['stretch_l1']!=""){echo $rcek1['stretch_l1'];}else{echo "N/A";}?></td> 
            <!-- <td align="center" style="font-size: 11px;">N/A</td>  -->
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">LENGTH - RECOVERY AFTER 1 MINUTE</td> 
            <td align="center" style="font-size: 11px;"><?php if($rcek1['recover_l1']!=""){echo $rcek1['recover_l1'];}else{echo "N/A";}?></td> 
            <!-- <td align="center" style="font-size: 11px;">N/A</td>  -->
           <td align="right" style="font-size: 11px;">
                <?php
                    $protocolText = $rd2['protocol'] ?? '';

                    if ($protocolText == "Predominanly Synthetic") {
                    echo "MIN. 90%";
                    } elseif ($protocolText == "Predominanly Natural") {
                    echo "MIN. 80%";
                    } else {
                    echo "";
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">LENGTH - RECOVERY AFTER 30 MINUTES</td> 
            <td align="center" style="font-size: 11px;"><?php if($rcek1['recover_l2']!=""){echo $rcek1['recover_l2'];}else{echo "N/A";}?></td> 
            <!-- <td align="center" style="font-size: 11px;">N/A</td>  -->
            <td align="right" style="font-size: 11px;">
                <?php
                $protocolText = $rd2['protocol'] ?? '';

                if ($protocolText == "Predominanly Synthetic") {
                    echo "MIN. 90%";
                } elseif ($protocolText == "Predominanly Natural") {
                    echo "MIN. 80%";
                } else {
                    echo "";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">WIDTH - MODULUS @ 10% EXTENSION</td> 
            <td align="center" style="font-size: 11px;"><?php if($rcek1['stretch_w2']!=""){echo $rcek1['stretch_w2'];}else{echo "N/A";}?></td> 
            <!-- <td align="center" style="font-size: 11px;">N/A</td>  -->
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">WIDTH - MODULUS @ 30% EXTENSION</td> 
            <td align="center" style="font-size: 11px;"><?php if($rcek1['stretch_w3']!=""){echo $rcek1['stretch_w3'];}else{echo "N/A";}?></td> 
            <!-- <td align="center" style="font-size: 11px;">N/A</td>  -->
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">WIDTH - MODULUS @ 50% EXTENSION</td> 
            <td align="center" style="font-size: 11px;"><?php if($rcek1['stretch_w4']!=""){echo $rcek1['stretch_w4'];}else{echo "N/A";}?></td> 
            <!-- <td align="center" style="font-size: 11px;">N/A</td>  -->
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">WIDTH - MODULUS @ 80% EXTENSION</td> 
            <td align="center" style="font-size: 11px;"><?php if($rcek1['stretch_w5']!=""){echo $rcek1['stretch_w5'];}else{echo "N/A";}?></td> 
            <!-- <td align="center" style="font-size: 11px;">N/A</td>  -->
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">WIDTH - TOTAL ELONGATION</td> 
            <td align="center" style="font-size: 11px;"><?php if($rcek1['stretch_w1']!=""){echo $rcek1['stretch_w1'];}else{echo "N/A";}?></td> 
            <!-- <td align="center" style="font-size: 11px;">N/A</td>  -->
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">WIDTH - RECOVERY AFTER 1 MINUTE</td> 
            <td align="center" style="font-size: 11px;"><?php if($rcek1['recover_w1']!=""){echo $rcek1['recover_w1'];}else{echo "N/A";}?></td> 
            <!-- <td align="center" style="font-size: 11px;">N/A</td>  -->
            <td align="right" style="font-size: 11px;">
                <?php
                $protocolText = $rd2['protocol'] ?? '';

                if ($protocolText == "Predominanly Synthetic" or $protocolText == "Knit Predominanly Synthetic") {
                    echo "MIN. 90%";
                } elseif ($protocolText == "Predominanly Natural" or $protocolText == "Knit Predominanly Natural") {
                    echo "MIN. 80%";
                } else {
                    echo "";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">WIDTH - RECOVERY AFTER 30 MINUTES</td> 
            <td align="center" style="font-size: 11px;"><?php if($rcek1['recover_w2']!=""){echo $rcek1['recover_w2'];}else{echo "N/A";}?></td> 
            <!-- <td align="center" style="font-size: 11px;">N/A</td>  -->
            <td align="right" style="font-size: 11px;">
                <?php
                $protocolText = $rd2['protocol'] ?? '';

                if ($protocolText == "Predominanly Synthetic" or $protocolText == "Knit Predominanly Synthetic") {
                    echo "MIN. 90%";
                } elseif ($protocolText == "Predominanly Natural" or $protocolText == "Knit Predominanly Natural") {
                    echo "MIN. 80%";
                } else {
                    echo "";
                }
                ?>
            </td>
        </tr>
        <!-- STRETCH AND RECOVERY END -->
        <!-- <tr>
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr> -->
        <tr>
            <td style="font-size: 12px;" Width="33%" ><strong> Conclusion </strong></td>
            <td align="center"  style="font-size: 12px; <?php echo (($rcek1['stat_sr'] ?? '') == 'FAIL') ? 'color:red;' : ''; ?>" Width="33%"><?php if($rcek1['stat_sr']!=""){echo $rcek1['stat_sr'] . ' ONLY';}else{echo "N/A";}?></td>
            <td style="font-size: 12px;" Width="33%"></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" colspan="3"></td>
        <tr>
        <!-- WICKING BEGIN -->
        <tr>
            <td align="left" style="font-size: 12px;" colspan="3"><strong><u>VERTICAL WICKING TEST(LLL-10197-2018)</u></strong></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" colspan="3"></td>
        <tr>
            <td align="left" style="font-size: 11px;" colspan="3">AFTER 15 MINS</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" colspan="3">ORIGINAL</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">LENGTH</td> 
            <td align="center" style="font-size: 11px; <?php if($rcek1['wick_l1']!="" AND $rcek1['wick_l1'] < 8){echo "color:red;";}?>"><?php if($rcek1['wick_l1']==""){echo "N/A";}else{echo $rcek1['wick_l1'];}?></td> 
            <td align="right" style="font-size: 11px;">MIN. 8 CM</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">WIDTH</td> 
            <td align="center" style="font-size: 11px; <?php if($rcek1['wick_w1']!="" AND $rcek1['wick_w1'] < 8){echo "color:red;";}?>"><?php if($rcek1['wick_w1']==""){echo "N/A";}else{echo $rcek1['wick_w1'];}?></td> 
            <td align="right" style="font-size: 11px;">MIN. 8 CM</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" colspan="3">AFTER WASH 10 WASHES</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">LENGTH</td> 
            <td align="center" style="font-size: 11px; <?php if($rcek1['wick_l2']!="" AND $rcek1['wick_l2'] < 8){echo "color:red;";}?>"><?php if($rcek1['wick_l2']==""){echo "N/A";}else{echo $rcek1['wick_l2'];}?></td> 
            <td align="right" style="font-size: 11px;">MIN. 8 CM</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">WIDTH</td> 
            <td align="center" style="font-size: 11px; <?php if($rcek1['wick_w2']!="" AND $rcek1['wick_w2'] < 8){echo "color:red;";}?>"><?php if($rcek1['wick_w2']==""){echo "N/A";}else{echo $rcek1['wick_w2'];}?></td> 
            <td align="right" style="font-size: 11px;">MIN. 8 CM</td> 
        </tr>
        <tr>
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" colspan="3">AFTER 30 MINS</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" colspan="3">ORIGINAL</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">LENGTH</td> 
            <td align="center" style="font-size: 11px;"><?php if($rcek1['wick_l3']==""){echo "N/A";}else{echo $rcek1['wick_l3'];}?></td> 
            <td align="right" style="font-size: 11px;">DATA ONLY</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">WIDTH</td> 
            <td align="center" style="font-size: 11px;"><?php if($rcek1['wick_w3']==""){echo "N/A";}else{echo $rcek1['wick_w3'];}?></td> 
            <td align="right" style="font-size: 11px;">DATA ONLY</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" colspan="3">AFTER WASH 10 WASHES</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">LENGTH</td> 
            <td align="center" style="font-size: 11px;"><?php if($rcek1['wick_l4']==""){echo "N/A";}else{echo $rcek1['wick_l4'];}?></td> 
            <td align="right" style="font-size: 11px;">DATA ONLY</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">WIDTH</td> 
            <td align="center" style="font-size: 11px;"><?php if($rcek1['wick_w4']==""){echo "N/A";}else{echo $rcek1['wick_w4'];}?></td> 
            <td align="right" style="font-size: 11px;">DATA ONLY</td>
        </tr>
        <tr>
            <td style="font-size: 12px;" Width="33%" ><strong> Conclusion </strong></td>
            <?php
            // Cek jika semua stat_wic, stat_wic1, stat_wic2, stat_wic3 adalah 'PASS'
            $wic_statuses = [
                $rcek1['stat_wic'],
                $rcek1['stat_wic1'],
                $rcek1['stat_wic2'],
                $rcek1['stat_wic3']
            ];

            // Jika semua data kosong, hasilnya N/A
            if (empty(array_filter($wic_statuses))) {
                $result = 'N/A';
            } elseif (
                count(array_filter($wic_statuses, function($v){ return $v === 'PASS'; })) === count(array_filter($wic_statuses))
            ) {
                $result = 'PASS';
            } else {
                $result = 'FAIL';
            }
            ?>
            <td align="center" style="font-size: 12px; <?php echo (($result ?? '') == 'FAIL') ? 'color:red;' : ''; ?>" Width="33%"><?php echo $result; ?></td>
            <td style="font-size: 12px;" Width="33%"></td>
        </tr>
        <!-- WICKING END -->
        <tr>
            <td align="right" style="font-size: 11px;">&nbsp;</td> 
        </tr>
        <!-- DRYING TIME BEGIN -->
        <!--<tr>
            <td align="left" style="font-size: 12px;" colspan="3"><strong><u>DRYING TIME (LL-003, 0.25 ML WATER)</u></strong></td>
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;" colspan="3">AFTER 30 MINS</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">AS RECEIVED - EVAPORATION</td> 
            <td align="center" style="font-size: 11px;"><?php if($rcek1['dry_note']=="N/A"){echo "N/A";}else{echo $rcek1['dry1'];}?></td> 
            <td align="right" style="font-size: 11px;">MIN. 90%</td> 
        </tr>
        <tr>
            <td align="left" style="font-size: 11px;">AFTER 10 WASHES</td> 
            <td align="center" style="font-size: 11px;"><?php if($rcek1['dry_note']=="N/A"){echo "N/A";}else{echo $rcek1['dryaf1'];}?></td> 
            <td align="right" style="font-size: 11px;">MIN. 90%</td> 
        </tr>-->
        <!-- DRYING TIME END -->
    </table>
    <div class="pagebreak"></div>
    <!-- Page 7 End -->
<!-- Page 8 - End -->
  <?php
    $pages_to_render = [];
    // KONDISI 1: Cek untuk data halaman reject1 dan reject4
    if (!empty($rd2['reject1'])) {
        if (!empty($rd2['reject4'])) {
            // Jika ada reject1 dan reject4 -> layout 2 gambar
            $pages_to_render[] = [
                'type'   => 'reject1_double',
                'image1' => $rd2['reject1'],
                'image2' => $rd2['reject4']
            ];
        } else {
            // Jika hanya ada reject1 -> layout 1 gambar
            $pages_to_render[] = [
                'type'   => 'reject1_single',
                'image1' => $rd2['reject1']
            ];
        }
    }

    // KONDISI 2: Cek untuk data halaman reject2 dan reject3
    if (!empty($rd2['reject2'])) { // Asumsi reject2 dan reject3 selalu berpasangan
        $pages_to_render[] = [
            'type'   => 'reject2_double',
            'image1' => $rd2['reject2'],
            'image2' => $rd2['reject3']
        ];
    }

    // KONDISI 3: Cek untuk data halaman lf_reject
    if (!empty($rd2['lf_reject'])) {
        $pages_to_render[] = [
            'type'   => 'lf_reject_single',
            'image1' => $rd2['lf_reject']
        ];
    }

    // KONDISI 4: Cek untuk data halaman wet_crocking
    if (!empty($rd2['wet_crocking'])) {
        $pages_to_render[] = [
            'type'   => 'wet_crocking_single',
            'image1' => $rd2['wet_crocking']
        ];
    }
    if (!empty($pages_to_render)) {
        $total_pages = count($pages_to_render);
        
    foreach ($pages_to_render as $index => $page_data) {
    ?>

        <table width="100%">
            <tr>
                <td align="right" style="font-size: 12px;"><?php echo $rd2['no_rptlulu']; ?><?php if ($rd2['sts_rev'] == "1" and $rd2['revisi'] != "") { echo "-" . $rd2['revisi']; } ?></td>
            </tr>
            <tr>
                <td align="right" style="font-size: 12px;"><?php echo date("F j, Y", strtotime($rd2['date_out1'])); ?></td>
            </tr>
            <tr> <td align="right" style="font-size: 12px;">&nbsp;</td> </tr>
            <tr> <td align="right" style="font-size: 12px;">&nbsp;</td> </tr>
            <tr> <td align="right" style="font-size: 12px;">&nbsp;</td> </tr>
            <tr> <td align="right" style="font-size: 12px;">&nbsp;</td> </tr>
            <tr> <td align="right" style="font-size: 12px;">&nbsp;</td> </tr>
            <tr> <td align="right" style="font-size: 12px;">&nbsp;</td> </tr>
        </table>
        
        <table width="100%">
        <?php 
            if ($page_data['type'] === 'reject1_single'): 
        ?>
            <tr>
                <td align="center"><input style="font-size: 12px;" name="notereject_<?php echo $index; ?>_1" type="text" placeholder="Ketik" size="100" /></td>
                <td align="center">&nbsp;</td>
            </tr>
            <tr>
                <td align="center" style="font-size: 12px;"><img src="../../dist/img-rptlulu/<?php echo $page_data['image1']; ?>" height="350" alt=""/></td>
                <td align="center" style="font-size: 12px;">&nbsp;</td>
            </tr>
            <tr>
                <td align="center"><input style="font-size: 12px;" name="notereject_<?php echo $index; ?>_2" type="text" placeholder="Ketik" size="70" /></td>
                <td align="center">&nbsp;</td>
            </tr>

        <?php elseif ($page_data['type'] === 'reject1_double' || $page_data['type'] === 'reject2_double'): ?>
            <tr>
                <td align="center"><textarea style="font-size: 12px; text-align:center;" name="notereject_<?php echo $index; ?>_1" type="text" placeholder="Ketik" rows="4" cols="40"></textarea></td>
                <td align="center"><textarea style="font-size: 12px; text-align:center;" name="notereject_<?php echo $index; ?>_2" type="text" placeholder="Ketik" rows="4" cols="40"></textarea></td>
            </tr>
            <tr>
                <td align="center" style="font-size: 12px;"><img src="../../dist/img-rptlulu/<?php echo $page_data['image1']; ?>" height="170" alt=""/></td>
                <td align="center" style="font-size: 12px;"><img src="../../dist/img-rptlulu/<?php echo $page_data['image2']; ?>" height="170" alt=""/></td>
            </tr>
            <tr>
                <td align="center"><textarea style="font-size: 12px; text-align:center;" name="notereject_<?php echo $index; ?>_3" type="text" placeholder="Ketik" rows="4" cols="40"></textarea></td>
                <td align="center"><textarea style="font-size: 12px; text-align:center;" name="notereject_<?php echo $index; ?>_4" type="text" placeholder="Ketik" rows="4" cols="40"></textarea></td>
            </tr>
        
        <?php elseif ($page_data['type'] === 'lf_reject_single' || $page_data['type'] === 'wet_crocking_single'): ?>
            <tr>
                <td align="center"><input style="font-size: 12px;" name="notereject_<?php echo $index; ?>_1" type="text" placeholder="Ketik" size="100" /></td>
                <td align="center">&nbsp;</td>
            </tr>
            <tr>
                <td align="center" style="font-size: 12px;"><img src="../../dist/img-rptlulu/<?php echo $page_data['image1']; ?>" height="350" alt=""/></td>
                <td align="center" style="font-size: 12px;">&nbsp;</td>
            </tr>
            <tr>
                <td align="center"><input style="font-size: 12px;" name="notereject_<?php echo $index; ?>_2" type="text" placeholder="Ketik" size="70" /></td>
                <td align="center">&nbsp;</td>
            </tr>
        <?php 
            endif; 
        ?>
        </table>
        
        <?php 
            if ($index < $total_pages - 1) {
                echo '<div class="pagebreak"></div>';
            }
        ?>
        <?php
        }
    }
    ?>
<!-- End Page -->
</body>
</html>
<script>
window.onbeforeprint = function() {
  document.querySelectorAll("select").forEach(sel => {
    let span = document.createElement("span");
    span.classList.add("print-value");
    span.textContent = sel.value;
    sel.parentNode.insertBefore(span, sel);
  });
};

window.onafterprint = function() {
  // hapus semua span setelah selesai print
  document.querySelectorAll(".print-value").forEach(span => span.remove());
};
</script>