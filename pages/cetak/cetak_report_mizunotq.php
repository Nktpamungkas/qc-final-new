<?php
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles_cetak.css" rel="stylesheet" type="text/css">
<title>Print Report Kaken Mizuno</title>
<style>
	#table-atas, #table-bawah {
    /* Hanya kedua tabel ini yang akan memiliki margin 0 */
    margin: 0; 
    padding: 0;
    border-spacing: 0; 
}
	input[type="checkbox"] {
  appearance: none;             /* hilangkan style bawaan browser */
  -webkit-appearance: none;
  background-color: #fff;       /* latar putih */
  border: 1px solid #000;       /* garis kotak hitam */
  width: 8px;                  /* ukuran kotak */
  height: 8px;
  cursor: pointer;
  position: relative;
  vertical-align: middle;
}

/* Tampilan saat dicentang */
input[type="checkbox"]:checked::after {
  content: "";
  position: absolute;
  top: 1px;
  left: 2px;
  width: 3px;
  height: 4px;
  border: solid #000;           /* warna centang hitam */
  border-width: 0 1px 1px 0;
  transform: rotate(45deg);
}
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
<?php 
    $nokk = $_GET['id_nokk'];
    $notest = $_GET['no_test'];

    $query_main="SELECT * FROM tbl_kaken_mizuno t WHERE t.id_nokk ='$nokk'";
    $stmt1 = mysqli_query($con,$query_main);
    $data1 = mysqli_fetch_assoc($stmt1);
    // print_r($data1);

    $query_main2="SELECT * FROM tbl_tq_test t WHERE t.id_nokk ='$nokk'";
    $stmt2 = mysqli_query($con,$query_main2);
    $data2 = mysqli_fetch_assoc($stmt2);

    $query_main3="SELECT * FROM tbl_tq_test_2 t WHERE t.id_nokk ='$nokk'";
    $stmt3 = mysqli_query($con,$query_main3);
    $data3 = mysqli_fetch_assoc($stmt3);

    $query_main4="SELECT * FROM tbl_tq_disptest t WHERE t.id_nokk ='$nokk'";
    $stmt4 = mysqli_query($con,$query_main4);
    $data4 = mysqli_fetch_assoc($stmt4);

    $query_main5="SELECT * FROM tbl_tq_disptest_2 t WHERE t.id_nokk ='$nokk'";
    $stmt5 = mysqli_query($con,$query_main5);
    $data5 = mysqli_fetch_assoc($stmt5);
    


    
?>
    <!-- Page 4 Begin -->
<table id="table-atas" width="100%">
        <tr>
            <td height="29" colspan="2" align="left" style="font-size: 12px;">
                <table style="border: 3px solid #000; table-list1">
                    <tr>
                        <td width="220" align="center">MIZUNO QUALITY TEST REPORT</td>
                    </tr>
                </table>
            </td>
            <td width="63%" rowspan="2" align="right">
				<table width="430" style="font-size: 7px; border: 2px solid #000;  border-collapse: collapse;">
                <tr>
                  <td width="44" rowspan="2" align="center" style="border: 1px solid #000;"><?= $data1['tahun'];?></td>
                  <td width="37" align="center" style="border: 1px solid #000;"><label><input type="checkbox" name="S/S" value="1" <?php if($data1['season']=='S/S'){echo 'checked';}else{echo '';}?>>S/S</label></td>
				  <td width="54" align="center" style="border: 1px solid #000;"><label><input type="checkbox" name="Sample" value="1" <?php if($data1['jenis_report']=='Sample'){echo 'checked';}else{echo '';}?>>Sample</label></td>
                  <td width="62" rowspan="2" align="left" style="border: 1px solid #000;">Mz File </td>
                  <td width="237" rowspan="2" align="center" style="border: 1px solid #000;">&nbsp;</td>
                </tr>
                <tr>
                  <td style="border: 1px solid #000;" align="center"><label><input type="checkbox" name="A/W" value="1" <?php if($data1['season']=='A/W'){echo 'checked';}else{echo '';}?>>A/W</label></td>
				  <td style="border: 1px solid #000;" align="center"><label><input type="checkbox" name="Bulk" value="1" <?php if($data1['jenis_report']=='Bulk'){echo 'checked';}else{echo '';}?>>Bulk</label></td>
                  </tr>
                <tr>
                  <td style="border: 1px solid #000;" align="left">Brand</td>
                  <td colspan="2" style="border: 1px solid #000;" align="left">MIZUNO</td>
                  <td style="border: 1px solid #000;" align="left">Detail</td>
                  <td style="border: 1px solid #000;" align="left">
					<table border="0">
                      <tr>
                        <td colspan="2">
							<label><input type="checkbox" name="taffeta" value="1">Taffeta</label>
						</td>
					    <td colspan="2">
							<label><input type="checkbox" name="2-Way-Tricot" value="1">2-Way-Tricot</label>
						</td>
                      </tr>
                      <tr>
						<td colspan="2">
							<label><input type="checkbox" name="lamination" value="1">Lamination</label>
						</td>
						<td colspan="2">
							<label><input type="checkbox" name="bonding" value="1">Bonding</label>
						</td>
                      </tr>
                    </table>
					</td>
                </tr>
                <tr>
                  <td style="border: 1px solid #000;" align="left">Material #</td>
                  <td colspan="2" style="border: 1px solid #000;" align="left"><?= $data1['no_hanger'];?></td>
                  <td style="border: 1px solid #000;" align="left"> Fabric dyed in</td>
                  <td style="border: 1px solid #000;" align="left"><table width="200" border="0">
                    <tbody>
                      <tr>
                        <td><label><input type="checkbox" name="japan" value="1">Japan</label></td>
						            <td><label><input type="checkbox" name="other" value="1" checked>Other country</label></td>
                      </tr>
                    </tbody>
                  </table></td>
                </tr>
                <tr>
                  <td align="left" style="border: 1px solid #000;">Fiber (%)</td>
                  <td colspan="2" style="border: 1px solid #000;" align="left"><?= $data1['jenis_kain'];?></td>
                  <td style="border: 1px solid #000;" align="left"> Product codes</td>
                  <td style="border: 1px solid #000;" align="left">&nbsp;</td>
                </tr>
          </table>
			</td>
        </tr>
        <tr>
          <td  colspan="2" rowspan="4" align="left">
            <table width="537" style="border: 3px solid #000; border-spacing:0;">
              <tr>
                <th width="38" rowspan="4" valign="middle" style="border-right: 2px solid #000;" scope="row">Client</th>
                <td width="121">Name: </td>
                <td width="358" style="font-family: 'ＭＳ Ｐ明朝'; font-size: 14px;">MIZUNO CORPORATION</td>
              </tr>
              <tr>
                <td>Tel:</td>
                <td style="font-size: 11px; font-family: sans-serif, Roman, serif;"> ０６－６６１４－●●●●</td>
              </tr>
              <tr>
                <td>Person in charge:</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td height="62">
                  △△△　△△
                </td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td align="right" style="font-size: 12px;"></td>
        </tr>
        <tr>
          <td align="right" style="font-size: 12px;"></td>
        </tr>
        <tr>
          <td align="right" style="font-size: 12px;">&nbsp;</td>
        </tr>
        <tr>
          <td width="1%" align="right" style="font-size: 12px;">&nbsp;</td>
          <td width="36%" align="left" style="font-size: 12px;">&nbsp;</td>
          <td align="right">
			  <table id= "table-bawah" width="415" style="font-size: 7px; border: 2px solid #000;  border-collapse: collapse;">
            <tr></tr>
            <tr>
              <td width="57" align="left" style="border: 1px solid #000;">Batch No</td>
              <td width="80" align="center" style="border: 1px solid #000;">&nbsp;</td>
              <td width="51" align="center" style="border: 1px solid #000;">&nbsp;</td>
              <td width="51" align="center" style="border: 1px solid #000;">&nbsp;</td>
              <td width="52" align="center" style="border: 1px solid #000;">&nbsp;</td>
              <td width="51" align="center" style="border: 1px solid #000;">&nbsp;</td>
              <td width="55" align="center" style="border: 1px solid #000;">&nbsp;</td>
            </tr>
            <tr>
              <td style="border: 1px solid #000;" align="left">C/#</td>
              <td style="border: 1px solid #000;" align="center"><?= $data1['colorname']?></td>
              <td style="border: 1px solid #000;" align="center">&nbsp;</td>
              <td style="border: 1px solid #000;" align="center">&nbsp;</td>
              <td style="border: 1px solid #000;" align="center">&nbsp;</td>
              <td style="border: 1px solid #000;" align="center">&nbsp;</td>
              <td style="border: 1px solid #000;" align="center">&nbsp;</td>
            </tr>
          </table></td>
        </tr>
    </table>
	<table id="table-bawah" width="100%">
        <tr>
            <td width="43%" align="left" valign="top" style="font-size: 9px;"><table width="310" style="font-size: 7px; border: 2px solid #000;  border-collapse: collapse;">
              <tr>
                <td colspan="5" align="center" style="border: 1px solid #000;">Standard Category No.</td>
                <td colspan="3" align="center" style="border: 1px solid #000;"><?= $data1['standar_category'];?></td>
              </tr>
              <tr>
                <td colspan="5" align="center" style="border: 1px solid #000;">Testing items (/)</td>
                <td colspan="3" align="center" style="border: 1px solid #000;">Measurement</td>
              </tr>
              <tr>
                <td colspan="5" align="left" style="border: 1px solid #000;"><p>  MZP1 Dimensional stability washing (%)</p>
                  <table width="200" border="0">
                    <tbody>
                      <tr>
                        <td><input type="checkbox" name="JISL-" value="1" />
                        JIS L</td>
                        <td align="right">( )</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td align="right">（　　　　　　　）method</td>
                      </tr>
                      <tr>
                        <td height="21"><input type="checkbox" name="ISO-105-B" value="1" <?= (!empty($data4['dshrinkage_l1'])||!empty($data4['dshrinkage_w1'])||!empty($data2['shrinkage_l1'])||!empty($data2['shrinkage_w1']))? 'checked' : ''; ?>></td>
                        <td align="right">ISO 6330</td>
                      </tr>
                    </tbody>
                  </table></td>
                <td colspan="3" rowspan="3" align="center" style="border: 1px solid #000;"><table cellspacing="0" cellpadding="0">
                  <col width="26" span="11" />
                  <tr>
                    <td colspan="4" rowspan="4" width="104">Vertical           </td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="7" rowspan="2" width="182" align="left" valign="top"><table cellpadding="0" cellspacing="0">
                      <tr>
                          <td colspan="7" rowspan="2" width="182"><?php if(!empty($data4['dshrinkage_l1'])){echo $data4['dshrinkage_l1'];}else if(!empty($data2['shrinkage_l1'])){echo $data2['shrinkage_l1'];}else echo '-'; ?></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr> </tr>
                  <tr>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="4" rowspan="4" width="104">Horiz </td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="7" rowspan="3" width="182" align="left" valign="top"><table cellpadding="0" cellspacing="0">
                      <tr>
                          <td colspan="7" rowspan="3" width="182"><?php if(!empty($data4['dshrinkage_w1'])){echo $data4['dshrinkage_w1'];}else if(!empty($data2['shrinkage_w1'])){echo $data2['shrinkage_w1'];}else echo '-'; ?></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr> </tr>
                  <tr> </tr>
                </table></td>
              </tr>
              <tr>
                <td width="14" rowspan="2" align="left" style="border: 1px solid #000;">Dry</td>
                <td width="42" align="center" style="border: 1px solid #000;"><input type="checkbox" name="JISL-" value="1" /></td>
                <td colspan="3" align="left" style="border: 1px solid #000;">Line</td>
              </tr>
              <tr>
                <td style="border: 1px solid #000;" align="center"><input type="checkbox" name="JISL-" value="1" /></td>
                <td colspan="3" align="left" style="border: 1px solid #000;">Screen</td>
              </tr>
              <tr>
                <td colspan="5" align="left" style="border: 1px solid #000;">MZP2 Press dimensional stability (%)
                  <table width="200" border="0">
                    <tbody>
                      <tr>
                        <td><input type="checkbox" name="JISL-" value="1" /></td>
                        <td align="right">JISL1096H-1 method</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="JISL-" value="1" /></td>
                        <td align="right">ISO 3005 free steam（1 time）</td>
                      </tr>
                    </tbody>
                  </table></td>
                <td colspan="3" align="center" style="border: 1px solid #000;">
				 <table cellspacing="0" cellpadding="0">
                  <col width="26" span="10" />
                  <tr>
                    <td colspan="4" rowspan="5" width="104">Wp.</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                  </tr>
                  <tr>
                    <td colspan="6" rowspan="2" width="156"></td>
                  </tr>
                  <tr> </tr>
                  <tr>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                  </tr>
                  <tr>
                    <td colspan="4" rowspan="4" width="104">Wf.</td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                  </tr>
                  <tr>
                    <td colspan="6" rowspan="2" width="156"></td>
                  </tr>
                  <tr> </tr>
                  <tr>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="5" align="left" style="border: 1px solid #000;">MZP3 Tensile strength (N)
                  <table width="200" border="0">
                    <tbody>
                      <tr>
                        <td><input type="checkbox" name="JISL-" value="1" /></td>
                        <td align="right">JISL1096A method</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="ISO-C" value="1" /></td>
                        <td align="right">ISO 13934-1</td>
                      </tr>
                    </tbody>
                  </table></td>
                <td colspan="3" align="center" style="border: 1px solid #000;"><table cellspacing="0" cellpadding="0">
                  <col width="26" span="10" />
                  <tr>
                    <td colspan="4" rowspan="5" width="104">Wp.</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                  </tr>
                  <tr>
                    <td colspan="6" rowspan="2" width="156"></td>
                  </tr>
                  <tr> </tr>
                  <tr>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                  </tr>
                  <tr>
                    <td colspan="4" rowspan="4" width="104">Wf.</td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                  </tr>
                  <tr>
                    <td colspan="6" rowspan="2" width="156"></td>
                  </tr>
                  <tr> </tr>
                  <tr>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="5" align="left" style="border: 1px solid #000;">MZP4 Tearing strength (N)
                  <table width="200" border="0">
                    <tbody>
                      <tr>
                        <td><input type="checkbox" name="JISL-" value="1" /></td>
                        <td align="right">JISL1096D method</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="ISO-105-C" value="1" /></td>
                        <td align="right">ISO 13937-1</td>
                      </tr>
                    </tbody>
                  </table></td>
                <td colspan="3" align="center" style="border: 1px solid #000;"><table cellspacing="0" cellpadding="0">
                  <col width="26" span="10" />
                  <tr>
                    <td colspan="4" rowspan="5" width="104">Wp.</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                  </tr>
                  <tr>
                    <td colspan="6" rowspan="2" width="156"></td>
                  </tr>
                  <tr> </tr>
                  <tr>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                  </tr>
                  <tr>
                    <td colspan="4" rowspan="4" width="104">Wf.</td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                    <td width="26"></td>
                  </tr>
                  <tr>
                    <td colspan="6" rowspan="2" width="156"></td>
                  </tr>
                  <tr> </tr>
                  <tr>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="5" align="left" style="border: 1px solid #000;">MZP5 Bursting strength (kPa)
                  <table width="200" border="0">
                    <tbody>
                      <tr>
                        <td><input type="checkbox" name="JISL-0860B2" value="1" /></td>
                        <td align="right">JISL1096 A method</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="ISO-105-D" value="1" <?= (!empty($data4['dbs_mullen'])||!empty($data2['bs_mullen'])) ? 'checked': ''; ?>></td>
                        <td align="right">ISO 13938-1</td>
                      </tr>
                    </tbody>
                  </table></td>
                <td colspan="3" align="center" style="border: 1px solid #000;"><?php if(!empty($data4['dbs_mullen'])){echo $data4['dbs_mullen'];}else if(!empty($data2['bs_mullen'])){echo $data2['bs_mullen'];}else echo '-'; ?></td>
              </tr>
              <tr>
                <td colspan="5" align="left" style="border: 1px solid #000;">MZP6 Seam slippage (mm)
                  <table width="200" border="0">
                    <tbody>
                      <tr>
                        <td><input type="checkbox" name="JISL-0860A2" value="1" /></td>
                        <td align="right">JISL1096B method</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="ISO-105-D" value="1" /></td>
                        <td align="right">ISO 1393７-1</td>
                      </tr>
                    </tbody>
                  </table></td>
                <td colspan="3" align="center" style="border: 1px solid #000;"><table cellspacing="0" cellpadding="0">
                  <col width="26" span="10" />
                  <tr>
                    <td colspan="4" rowspan="3" width="104">Wp.</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="6" rowspan="2" width="156"></td>
                  </tr>
                  <tr> </tr>
                  <tr>
                    <td colspan="4" rowspan="3" width="104">Wf.</td>
                    <td colspan="6" rowspan="2" width="156"></td>
                  </tr>
                  <tr> </tr>
                  <tr>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="5" align="left" style="border: 1px solid #000;">MZP7・8 Snagging (degree)
                  <table width="200" border="0">
                    <tbody>
                      <tr>
                        <td><input type="checkbox" name="JISL-" value="1" <?= (!empty($data4['dsm_l1']) || !empty($data4['dsm_w1'])||!empty($data2['sm_l1']) || !empty($data2['sm_w1']))?'checked':'';?>></td>
                        <td align="right">JISL1058A・A method</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="ISO-105-X" value="1" /></td>
                        <td align="right">ASTM D3939(100 times)</td>
                      </tr>
                    </tbody>
                  </table></td>
                <td colspan="3" align="center" style="border: 1px solid #000;"><table width="79" border="0">
                  <tbody>
                    <tr>
                      <td width="31"><input type="checkbox" name="JISL-" value="1" <?= (!empty($data4['dsm_l1']) || !empty($data4['dsm_w1'])||!empty($data2['sm_l1']) || !empty($data2['sm_w1']))?'checked':'';?>></td>
                      <td width="16">A</td>
                      <td width="12"><input type="checkbox" name="JISL-" value="1" /></td>
                      <td width="10">D</td>
                    </tr>
                    <tr>
                      <td>Vertical: </td>
                      <td><?php if(!empty($data4['dsm_l1'])){echo $data4['dsm_l1'];}else if(!empty($data2['sm_l1'])){echo $data2['sm_l1'];}else echo '-'; ?></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>Horiz.    :  </td>
                      <td><?php if(!empty($data4['dsm_w1'])){echo $data4['dsm_w1'];}else if(!empty($data2['sm_w1'])){echo $data2['sm_w1'];}else echo '-'; ?></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </tbody>
                </table></td>
              </tr>
              <tr>
                <td colspan="5" align="left" style="border: 1px solid #000;">MZP9・10　 Pilling (degree)
                  <table width="200" border="0">
                    <tbody>
                      <tr>
                        <td><input type="checkbox" name="JISL-" value="1" <?= (!empty($data2['pm_f1'])||!empty($data4['dpm_f1'])) ? 'checked' : '';?>></td>
                        <td align="right">JISL1076ART/ISO 12945-2</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="ISO-105-E" value="1" /></td>
                        <td align="right">JISL1076 A /ISO 12945－1ICI</td>
                      </tr>
                    </tbody>
                  </table></td>
                <td colspan="3" align="center" style="border: 1px solid #000;"><table width="79" border="0">
                  <tbody>
                    <tr>
                      <td width="31"><input type="checkbox" name="JISL-" value="1" /></td>
                      <td width="16">ART</td>
                      <td width="12"><input type="checkbox" name="JISL-" value="1" /></td>
                      <td width="10">ICI</td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="JISL-" value="1" <?= (!empty($data2['pm_f1'])||!empty($data4['dpm_f1'])) ? 'checked' : '';?>></td>
                      <td>Martindale</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="right"><?php if(!empty($data4['dpm_f1'])){echo $data4['dpm_f1'];}else if(!empty($data2['pm_f1'])){echo $data2['pm_f1'];}else echo '-'; ?></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </tbody>
                </table></td>
              </tr>
              <tr>
                <td colspan="5" align="left" style="border: 1px solid #000;">MZP18 Washing test appearance (10HL)
                  <table width="200" border="0">
                    <tbody>
                      <tr>
                        <td><input type="checkbox" name="JISL-" value="1" /></td>
                        <td align="right">JISL0217 103 method</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="ISO-105-E" value="1" /></td>
                        <td align="right">ISO 6330 C4M</td>
                      </tr>
                    </tbody>
                  </table></td>
                <td colspan="3" align="center" style="border: 1px solid #000;">&nbsp;</td>
              </tr>
              <tr>
                <td height="28" colspan="4" rowspan="3" align="left" style="border: 1px solid #000;">MZF1 Water repellency
                  <table width="200" border="0">
                    <tbody>
                      <tr>
                        <td width="35"><input type="checkbox" name="JISL-" value="1" /></td>
                        <td width="155" align="right">JISL1092</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td align="right">Spray method</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="JISL-" value="1" /></td>
                        <td align="right">ISO 4920</td>
                      </tr>
                    </tbody>
                  </table>
                <p>&nbsp;</p></td>
                <td align="center" style="border: 1px solid #000;">Original</td>
                <td width="22" align="center" style="border: 1px solid #000;">&nbsp;</td>
                <td width="31" align="center" style="border: 1px solid #000;">&nbsp;</td>
                <td width="20" align="center" style="border: 1px solid #000;">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" style="border: 1px solid #000;">5HL</td>
                <td style="border: 1px solid #000;" align="center">&nbsp;</td>
                <td style="border: 1px solid #000;" align="center">&nbsp;</td>
                <td style="border: 1px solid #000;" align="center">&nbsp;</td>
              </tr>
              <tr>
                <td height="54" align="center" style="border: 1px solid #000;">5DL</td>
                <td style="border: 1px solid #000;" align="center">&nbsp;</td>
                <td style="border: 1px solid #000;" align="center">&nbsp;</td>
                <td style="border: 1px solid #000;" align="center">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="5" align="left" style="border: 1px solid #000;"> MZF2 Water resistance (mm)
                  <table width="200" border="0">
                    <tbody>
                      <tr>
                        <td><input type="checkbox" name="JISL-" value="1" />JISL1092A-1 method</td>
                        <td align="left"><input type="checkbox" name="JISL-" value="1" />B-1 method</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="JISL-" value="1" />    ISO 811</td>
                        <td align="right"></td>
                      </tr>
                    </tbody>
                  </table></td>
                <td colspan="3" align="center" style="border: 1px solid #000;"><table cellspacing="0" cellpadding="0">
                  <col width="26" span="10" />
                  <tr>
                    <td colspan="8" rowspan="3" width="208">Before wash</td>
                    <td width="26">&nbsp;</td>
                    <td width="26">&nbsp;</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan="4" rowspan="4">5HL</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan="6" rowspan="2"></td>
                  </tr>
                  <tr> </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="5" align="left" style="border: 1px solid #000;">MZF3 Moist. permeability (24h rated)
                  <table border="0">
                    <tbody>
                      <tr>
                        <td align="right"><input type="checkbox" name="JISL-" value="1" />
                        JISL1099A-1 method</td>
                        <td align="right"><input type="checkbox" name="JISL-" value="1" />
                        B-1 method</td>
                      </tr>
                    </tbody>
                  </table></td>
                <td colspan="3" align="right" style="border: 1px solid #000;">g/㎡ </td>
              </tr>
              <tr>
                <td colspan="4" align="left" style="border: 1px solid #000;">MZP14 W.repellency rubbing
                  <table width="200" border="0">
                    <tbody>
                      <tr>
                        <td align="right">mizuno method</td>
                      </tr>
                    </tbody>
                  </table>
				</td>
                <td width="35" align="center" style="border: 1px solid #000;">Original</td>
                <td style="border: 1px solid #000;" align="center">&nbsp;</td>
                <td style="border: 1px solid #000;" align="left">&nbsp;</td>
                <td style="border: 1px solid #000;" align="center">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="5" align="left" style="border: 1px solid #000;">MZF4 Air permeability
                <table width="200" border="0">
                    <tbody>
                      <tr>
                        <td><input type="checkbox" name="JISL-" value="1" /></td>
                        <td align="right">JISL1096</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="ISO-105-E" value="1" /></td>
                        <td align="right">ISO 9237</td>
                      </tr>
                    </tbody>
                  </table></td>
                <td colspan="3" align="center" style="border: 1px solid #000;">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="5" align="left" style="border: 1px solid #000;">MZP12 Peel off resistance
                  <table width="234" border="0">
                    <tbody>
                      <tr>
                        <td width="228" align="right">Mizuno method</td>
                      </tr>
                    </tbody>
                  </table>
                </td>
                <td colspan="3" align="center" style="border: 1px solid #000;">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="5" align="left" style="border: 1px solid #000;">MZO１ Fiber composition (%)
                <table width="200" border="0">
                    <tbody>
                      <tr>
                        <td><input type="checkbox" name="JISL-" value="1" /></td>
                        <td align="right"> JISL1030</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="ISO-105-E" value="1" /></td>
                        <td align="right">ISO 1833</td>
                      </tr>
                    </tbody>
                  </table></td>
                <td colspan="3" align="center" style="border: 1px solid #000;">&nbsp;</td>
              </tr>
              <tr>
                <td align="left">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td width="133" align="center">&nbsp;</td>
                <td width="3" align="center">&nbsp;</td>
                <td style="border-right: 1px solid #000;" align="center">&nbsp;</td>
                <td colspan="3" align="center" style="border-right: 1px solid #000;">&nbsp;</td>
              </tr>
            </table>
			</td>
            <td width="57%" align="right" valign="top" style="font-size: 12px;">
				<table width="626" style="font-size: 7px; border: 2px solid #000;  border-collapse: collapse;">
                <tr>
                  <td width="202" align="center" style="border: 1px solid #000;">Testing Items</td>
				  <td width="55" align="center" style="border: 1px solid #000;">MZ C/#</td>
                  <td width="77" align="center" style="border: 1px solid #000;"><?= $data1['colorcode'];?></td>
				  <td width="48" align="center" style="border: 1px solid #000;">&nbsp;</td>
                  <td width="48" align="center" style="border: 1px solid #000;">&nbsp;</td>
                  <td width="51" align="center" style="border: 1px solid #000;">&nbsp;</td>
				  <td width="51" align="center" style="border: 1px solid #000;">&nbsp;</td>
				  <td width="51" align="center" style="border: 1px solid #000;">&nbsp;</td>
                </tr>
				<tr>
                  <td style="border: 1px solid #000;" align="left">MZC1　Light
                    <table width="200" border="0">
                      <tbody>
                        <tr>
                          <td><input type="checkbox" name="JISL-0842" value="1"></td>
                          <td align="right">JISL 0842</td>
                        </tr>
                        <tr>
                          <td height="21"><input type="checkbox" name="ISO-105-B02" value="1" <?= (!empty($data2['light_rating1'])||!empty($data4['dlight_rating1'])) ? 'checked' : '' ?>></td>
                          <td align="right">ISO 105 B02</td>
                        </tr>
                      </tbody>
                  </table></td>
				  <td style="border: 1px solid #000;" align="center">C.C</td>
                  <td style="border: 1px solid #000;" align="center"><?php if(!empty($data4['dlight_rating1'])){echo $data4['dlight_rating1'];}else if(!empty($data2['light_rating1'])){echo $data2['light_rating1'];}else echo '/'; ?></td>
				  <td style="border: 1px solid #000;" align="center">/</td>
                  <td style="border: 1px solid #000;" align="center">/</td>
                  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td width="54" align="center" style="border: 1px solid #000;">/</td>
                </tr>
				<tr>
				  <td style="border: 1px solid #000;" align="left">MZC2 Light and Perspiration
					<table width="200" border="0">
					  <tbody>
						<tr>
						  <td align="right">Mizuno method</td>
						</tr>
					  </tbody>
					</table>
				  </td>
				  <td style="border: 1px solid #000;" align="center">C.C</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td align="center" style="border: 1px solid #000;">/</td>
				  </tr>
				<tr>
				  <td style="border: 1px solid #000;" align="left">MZC3 Washing (A-1)
			        <table width="200" border="0">
			          <tbody>
			            <tr>
			              <td><input type="checkbox" name="JISL-0842" value="1"></td>
			              <td align="right">JISL 0844 A-1 method</td>
		                </tr>
						<tr>
			              <td><input type="checkbox" name="JISL-0842" value="1"></td>
			              <td align="right">ISO C60 A-1S(neutral detergent)</td>
		                </tr>
		              </tbody>
		            </table>
				  </td>
				  <td style="border: 1px solid #000;" align="center">C.C/St.</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td align="center" style="border: 1px solid #000;">/</td>
				  </tr>
				<tr>
				  <td style="border: 1px solid #000;" align="left">MZC3 Washing (A-2)
			        <table width="200" border="0">
			          <tbody>
			            <tr>
			              <td><input type="checkbox" name="JISL-0844" value="1"></td>
			              <td align="right">JISL 0844 A-2 method</td>
		                </tr>
						<tr>
			              <td><input type="checkbox" name="ISO-C6" value="1" <?= (!empty($data2['wash_colorchange'])||!empty($data2['wash_nylon'])||!empty($data4['dwash_colorchange'])||!empty($data4['dwash_nylon'])) ? 'checked' : '' ?>></td>
			              <td align="right">ISO C6 B1S</td>
		                </tr>
		              </tbody>
	              </table></td>
				  <td style="border: 1px solid #000;" align="center">C.C/St.</td>
				  <td style="border: 1px solid #000;" align="center"><?php if(!empty($data4['dwash_colorchange']) && !empty($data2['wash_colorchange'])){echo $data4['dwash_colorchange'];}else if(!empty($data2['wash_colorchange'])){echo $data2['wash_colorchange'];}else echo ''; ?>/<?php if(!empty($data4['dwash_nylon']) && !empty($data2['wash_nylon'])){echo $data4['dwash_nylon'];}else if(!empty($data2['wash_nylon'])){echo $data2['wash_nylon'];}else echo ''; ?></td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td align="center" style="border: 1px solid #000;">/</td>
				  </tr>
				<tr>
				  <td style="border: 1px solid #000;" align="left">MZC４ Oxygen bleach
			        <table width="200" border="0">
			          <tbody>
			            <tr>
			              <td><input type="checkbox" name="JISL-0889" value="1"></td>
			              <td align="right">JISL 0889</td>
		                </tr>
			            <tr>
			              <td><input type="checkbox" name="ISO-105-C09" value="1"></td>
			              <td align="right">ISO 105 C09</td>
		                </tr>
		              </tbody>
	              </table>
				  </td>
				  <td style="border: 1px solid #000;" align="center">C.C</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td align="center" style="border: 1px solid #000;">/</td>
				  </tr>
				<tr>
				  <td style="border: 1px solid #000;" align="left">MZC5 Dry cleaning (Petro)
						<table width="200" border="0">
						  <tbody>
							<tr>
							  <td><input type="checkbox" name="JISL-0860B" value="1"></td>
							  <td align="right">JISL 0860B-1 method</td>
							</tr>
							<tr>
							  <td><input type="checkbox" name="ISO-105-D01" value="1"></td>
							  <td align="right">ISO 105－D01</td>
							</tr>
						</tbody>
					  </table>
				  </td>
				  <td style="border: 1px solid #000;" align="center">C.C/St.</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td align="center" style="border: 1px solid #000;">/</td>
				  </tr>
				<tr>
				  <td style="border: 1px solid #000;" align="left">MZC5 Dry cleaning (Perchlen)
			          <table width="200" border="0">
						  <tbody>
							<tr>
							  <td><input type="checkbox" name="JISL-0860A" value="1"></td>
							  <td align="right">JISL 0860A-1 method</td>
							</tr>
							<tr>
							  <td><input type="checkbox" name="ISO-105-D01" value="1"></td>
							  <td align="right">ISO 105－D01</td>
							</tr>
						  </tbody>
					  </table>
				  </td>
				  <td style="border: 1px solid #000;" align="center">C.C/St.</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td align="center" style="border: 1px solid #000;">/</td>
				  </tr>
				<tr>
				  <td style="border: 1px solid #000;" align="left">MZC6 Rubbing
			          <table width="200" border="0">
						  <tbody>
							<tr>
							  <td><input type="checkbox" name="JISL-0849" value="1"></td>
							  <td align="right">JISL 0849 II type</td>
							</tr>
							<tr>
							  <td><input type="checkbox" name="ISO-105-X12" value="1" <?= (!empty($data4['dcrock_len1'])||!empty($data4['dcrock_len2'])||!empty($data2['crock_len1'])||!empty($data2['crock_len2'])) ? 'checked' : '' ?>></td>
							  <td align="right">ISO 105 X12</td>
							</tr>
					    </tbody>
				    </table>
				  </td>
				  <td style="border: 1px solid #000;" align="center">Dry/Wet</td>
				  <td style="border: 1px solid #000;" align="center"><?php if(!empty($data4['dcrock_len1'])){echo $data4['dcrock_len1'];}else if(!empty($data2['crock_len1'])){echo $data2['crock_len1'];}else echo ''; ?>/<?php if(!empty($data4['dcrock_len2'])){echo $data4['dcrock_len2'];}else if(!empty($data2['crock_len2'])){echo $data2['crock_len2'];}else echo ''; ?></td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td align="center" style="border: 1px solid #000;">/</td>
				  </tr>
				<tr>
				  <td style="border: 1px solid #000;" align="left">MZC7 Perspiration （acid)
			          <table width="200" border="0">
						  <tbody>
							<tr>
							  <td><input type="checkbox" name="JISL-0848" value="1"></td>
							  <td align="right">JISL 0848</td>
							</tr>
							<tr>
							  <td><input type="checkbox" name="ISO-105-E04" value="1" <?= (!empty($data2['acid_colorchange'])||!empty($data2['acid_nylon'])) ? 'checked' : '' ?>></td>
							  <td align="right">ISO 105 E04</td>
							</tr>
					    </tbody>
				    </table>
				  </td>
				  <td style="border: 1px solid #000;" align="center">C.C/St.</td>
				  <td style="border: 1px solid #000;" align="center"><?php if(!empty($data4['dacid_colorchange']) && !empty($data2['acid_colorchange'])){echo $data4['dacid_colorchange'];}else if(!empty($data2['acid_colorchange'])){echo $data2['acid_colorchange'];}else echo ''; ?>/<?php if(!empty($data4['dacid_nylon']) && !empty($data2['acid_nylon'])){echo $data4['dacid_nylon'];}else if(!empty($data2['acid_nylon'])){echo $data2['acid_nylon'];}else echo ''; ?></td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td align="center" style="border: 1px solid #000;">/</td>
				  </tr>
				<tr>
				  <td height="67" align="left" style="border: 1px solid #000;"> MZC7 Perspiration (alkaline）
			          <table width="200" border="0">
						  <tbody>
							<tr>
							  <td><input type="checkbox" name="JISL-0848" value="1"></td>
							  <td align="right">JISL 0848</td>
							</tr>
							<tr>
							  <td><input type="checkbox" name="ISO-105-E04" value="1" <?= (!empty($data2['alkaline_colorchange'])||!empty($data2['alkaline_nylon'])||!empty($data2['alkaline_colorchange'])||!empty($data2['alkaline_nylon'])) ? 'checked' : '' ?>></td>
							  <td align="right">ISO 105 E04</td>
							</tr>
					    </tbody>
				    </table>
				  </td>
				  <td style="border: 1px solid #000;" align="center">C.C/St.</td>
				  <td style="border: 1px solid #000;" align="center"><?php if(!empty($data4['dalkaline_colorchange'])){echo $data4['dalkaline_colorchange'];}else if(!empty($data2['alkaline_colorchange'])){echo $data2['alkaline_colorchange'];}else echo ''; ?>/<?php if(!empty($data4['dalkaline_nylon'])){echo $data4['dalkaline_nylon'];}else if(!empty($data2['alkaline_nylon'])){echo $data2['alkaline_nylon'];}else echo ''; ?></td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td align="center" style="border: 1px solid #000;">/</td>
				  </tr>
				<tr>
				  <td style="border: 1px solid #000;" align="left">MZC8 Sublimation in storage
			          <table width="200" border="0">
						  <tbody>
							<tr>
							  <td align="right">JISL 0854</td>
							</tr>
					    </tbody>
				    </table>
				  </td>
				  <td style="border: 1px solid #000;" align="center">C.C/St.</td>
				  <td style="border: 1px solid #000;" align="center"><?php if(!empty($data4['dcm_dye_colorchange'])){echo $data4['dcm_dye_colorchange'];}else if(!empty($data2['cm_dye_colorchange'])){echo $data2['cm_dye_colorchange'];}else echo ''; ?>/<?php if(!empty($data4['dcm_dye_stainingface'])){echo $data4['dcm_dye_stainingface'];}else if(!empty($data2['cm_dye_stainingface'])){echo $data2['cm_dye_stainingface'];}else echo ''; ?></td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td align="center" style="border: 1px solid #000;">/</td>
				  </tr>
				<tr>
				  <td height="53" align="left" style="border: 1px solid #000;">MZC9 Water
			          <table width="200" border="0">
						  <tbody>
							<tr>
							  <td><input type="checkbox" name="JISL-0848" value="1">Swimming</td>
							  <td><input type="checkbox" name="ISO-105-E04" value="1">Rain</td>
							</tr>
							<tr>
							  <td colspan="2" align="right">Mizuno method</td>
						    </tr>
					    </tbody>
				    </table>
				  </td>
				  <td style="border: 1px solid #000;" align="center">C.C/St.</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td align="center" style="border: 1px solid #000;">/</td>
				  </tr>
				<tr>
				  <td height="32" align="left" style="border: 1px solid #000;">MZC10 Bleeding
		            <table width="200" border="0">
						  <tbody>
							<tr>
							  <td align="right">Mizuno method</td>
							</tr>
						  </tbody>
					  </table>
				  </td>
				  <td style="border: 1px solid #000;" align="center">St.</td>
				  <td style="border: 1px solid #000;" align="center">Watermark = <?php if(!empty($data4['dbleeding'])){echo $data4['dbleeding'];}else if(!empty($data2['bleeding'])){echo $data2['bleeding'];}else echo '/'; ?> <br>Below Watermark= <?php if(!empty($data5['dbleeding_root'])){echo $data5['dbleeding_root'];}else if(!empty($data3['bleeding_root'])){echo $data3['bleeding_root'];}else echo '/'; ?></td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td align="center" style="border: 1px solid #000;">/</td>
				  </tr>
				<tr>
				  <td height="75" align="left" style="border: 1px solid #000;">MZC11 Chlorinated water
			          <table width="200" border="0">
						  <tbody>
							<tr>
							  <td></td>
							  <td align="right">(&nbsp;)</td>
							</tr>
							<tr>
							  <td><input type="checkbox" name="JISL-0884" value="1"></td>
							  <td align="right">JISL 0884</td>
							</tr>
							<tr>
							  <td><input type="checkbox" name="ISO-105-E03" value="1"></td>
							  <td align="right">ISO 105 E03</td>
							</tr>
					    </tbody>
				    </table>
				  </td>
				  <td style="border: 1px solid #000;" align="center">C.C</td>
				  <td style="border: 1px solid #000;" align="center">&nbsp;</td>
				  <td style="border: 1px solid #000;" align="center">&nbsp;</td>
				  <td style="border: 1px solid #000;" align="left">&nbsp;</td>
				  <td style="border: 1px solid #000;" align="center">&nbsp;</td>
				  <td style="border: 1px solid #000;" align="center">&nbsp;</td>
				  <td align="center" style="border: 1px solid #000;">&nbsp;</td>
				  </tr>
				<tr>
				  <td height="31" align="left" style="border: 1px solid #000;">MZC12 Yellowing
		            <table width="200" border="0">
						  <tbody>
							<tr>
							  <td align="right">ISO 105X18</td>
							</tr>
						  </tbody>
					  </table>
				  </td>
				  <td style="border: 1px solid #000;" align="center">St.</td>
				  <td style="border: 1px solid #000;" align="center"><?php if(!empty($data4['dphenolic_colorchange'])){echo $data4['dphenolic_colorchange'];}else if(!empty($data2['phenolic_colorchange'])){echo $data2['phenolic_colorchange'];}else echo '/'; ?></td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td style="border: 1px solid #000;" align="center">/</td>
				  <td align="center" style="border: 1px solid #000;">/</td>
				  </tr>
				<tr>
				  <td height="62" align="left" style="border: 1px solid #000;">MZO２  Formaldehyde (ppm)
		            <table width="200" border="0">
						  <tbody>
							<tr>
							  <td><input type="checkbox" name="JISL-0848" value="1"></td>
							  <td align="right">JISL 1041</td>
							</tr>
							<tr>
							  <td><input type="checkbox" name="ISO-105-E04" value="1"></td>
							  <td align="right">ISO 14184-1</td>
							</tr>
					    </tbody>
				    </table>
				  </td>
				  <td style="border: 1px solid #000;" align="center">-</td>
				  <td style="border: 1px solid #000;" align="center">&nbsp;</td>
				  <td style="border: 1px solid #000;" align="center">&nbsp;</td>
				  <td style="border: 1px solid #000;" align="left">&nbsp;</td>
				  <td style="border: 1px solid #000;" align="center">&nbsp;</td>
				  <td style="border: 1px solid #000;" align="center">&nbsp;</td>
				  <td align="center" style="border: 1px solid #000;">&nbsp;</td>
				  </tr>
				<tr>
				  <td height="36" align="left" style="border: 1px solid #000;">
			          <table width="200" border="0">
						  <tbody>
							<tr>
							  <td align="right">JISL</td>
							</tr>
							<tr>
							  <td align="right">ISO</td>
							</tr>
					    </tbody>
				    </table>
				  </td>
				  <td style="border: 1px solid #000;" align="center">&nbsp;</td>
				  <td style="border: 1px solid #000;" align="center">&nbsp;</td>
				  <td style="border: 1px solid #000;" align="center">&nbsp;</td>
				  <td style="border: 1px solid #000;" align="left">&nbsp;</td>
				  <td style="border: 1px solid #000;" align="center">&nbsp;</td>
				  <td style="border: 1px solid #000;" align="center">&nbsp;</td>
				  <td align="center" style="border: 1px solid #000;">&nbsp;</td>
				  </tr>
				  <tr>
				  <td height="51" colspan="2" align="center" style="border: 1px solid #000;">Fabric specimen</td>
				  <td style="border: 1px solid #000;" align="center">&nbsp;</td>
				  <td style="border: 1px solid #000;" align="center">&nbsp;</td>
				  <td style="border: 1px solid #000;" align="left">&nbsp;</td>
				  <td style="border: 1px solid #000;" align="center">&nbsp;</td>
				  <td style="border: 1px solid #000;" align="center">&nbsp;</td>
				  <td align="center" style="border: 1px solid #000;">&nbsp;</td>
				  </tr>
              </table>
			</td>
      </tr>
        <tr>
          <td colspan="2" align="left" style="font-size: 12px;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2" align="left" style="font-size: 12px;"><table cellspacing="0" cellpadding="0">
              <tr>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26" align="left" valign="top"><table cellpadding="0" cellspacing="0">
                  <tr>
                      <td width="26"></td>
                  </tr>
                </table></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="26"></td>
              </tr>
            </table></td>
        </tr>
        <tr>
            <td height="17" colspan="2" align="center" style="font-size: 12px;"><table cellspacing="0" cellpadding="0">
              <col width="26" span="67" />
              <tr>
                <td style="border: 1px solid #000;" colspan="2" rowspan="9">Testing    Institute</td>
                <td style="border-top: 1px solid #000;" colspan="4" rowspan="2"> Issued on :</td>
                <td style="border-top: 1px solid #000;" colspan="3"><?= $data1['issued_on'];?></td>
                <td colspan="24" align="left" valign="top" style="border-top: 1px solid #000;"></td>
                <td style="border: 1px solid #000;" colspan="4" rowspan="9">Comment</td>
                <td colspan="20" style="border-top: 1px solid #000;"></td>
                <td style="border: 1px solid #000;" colspan="3" rowspan="4" align="center">Judged</td>
                <td colspan="7" rowspan="4" align="center" valign="middle" style="border: 1px solid #000;"><?= $data2['status'];?></td>
              </tr>
              <tr>
                <td width="10"></td>
                <td width="21"></td>
                <td width="20"></td>
                <td width="17"></td>
                <td width="17"></td>
                <td width="18" align="left" valign="top"><table cellpadding="0" cellspacing="0">
                  <tr>
                      <td width="26"></td>
                  </tr>
                </table></td>
                <td width="17"></td>
                <td width="17"></td>
                <td width="17"></td>
                <td width="17"></td>
                <td width="17"></td>
                <td width="17"></td>
                <td width="17"></td>
                <td width="17"></td>
                <td width="17"></td>
                <td width="17"></td>
                <td width="17"></td>
                <td width="17"></td>
                <td width="17"></td>
                <td width="17"></td>
                <td width="17"></td>
                <td width="17"></td>
                <td width="20"></td>
                <td width="12"></td>
                <td width="20"></td>
                <td width="19"></td>
                <td width="18">&nbsp;</td>
                <td width="17">&nbsp;</td>
                <td width="17"></td>
                <td width="16"></td>
                <td width="16"></td>
                <td width="16"></td>
                <td width="16"></td>
                <td width="16"></td>
                <td width="16"></td>
                <td width="16"></td>
                <td width="16"></td>
                <td width="16"></td>
                <td width="16"></td>
                <td width="16"></td>
                <td width="16"></td>
                <td width="16"></td>
                <td width="16"></td>
                <td width="16"></td>
                <td width="16"></td>
                <td width="16"></td>
                <td width="16">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4" rowspan="2"> Rep. No. :</td>
                <td colspan="27" rowspan="2"><?php echo($data1['no_report']);?></td>
                <td>&nbsp;</td>
                <td colspan="18" rowspan="5"><?php echo($data1['comments']);?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4" rowspan="2"> Testing institute :</td>
                <td colspan="23" rowspan="5" style="border-bottom: 1px solid #000;">LAB.INDOTAICHEN</td>
                <td width="12"></td>
                <td width="20"></td>
                <td></td>
                <td width="18">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="5" style="border: 1px solid #000;" align="center">Authorized by</td>
                <td width="62" colspan="5" style="border: 1px solid #000;" align="center">Production staff</td>
              </tr>
              <tr>
                <td colspan="3" rowspan="3">stamp</td>
                <td width="18">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="5" rowspan="4" style="border: 1px solid #000;">&nbsp;</td>
                <td colspan="5" rowspan="4" style="border: 1px solid #000;">&nbsp;</td>
              </tr>
              <tr>
                <td width="16"></td>
                <td width="26"></td>
                <td width="26"></td>
                <td width="38"></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4" style="border-bottom: 1px solid #000;">&nbsp;</td>
                <td colspan="4" style="border-bottom: 1px solid #000;">&nbsp;</td>
                <td style="border-bottom: 1px solid #000;" colspan="20">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="67" align="center">MIZUNO    CORPORATION</td>
              </tr>
            </table></td>
        </tr>
</table>
    <!-- <div class="pagebreak"></div> -->
    <!-- Page 4 End -->
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