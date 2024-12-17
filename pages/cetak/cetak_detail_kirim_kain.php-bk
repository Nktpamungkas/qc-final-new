<?php
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";
include "../../tgl_indo.php";
//--
$modal_id=$_GET['awal'];
$nowarna=$_GET['nowarna'];
$project=$_GET['project'];
$lotcode=$_GET['lotcode'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles_cetak.css" rel="stylesheet" type="text/css">
<title>Cetak KPE</title>
<script>

// set portrait orientation

jsPrintSetup.setOption('orientation', jsPrintSetup.kPortraitOrientation);

// set top margins in millimeters
jsPrintSetup.setOption('marginTop', 0);
jsPrintSetup.setOption('marginBottom', 0);
jsPrintSetup.setOption('marginLeft', 0);
jsPrintSetup.setOption('marginRight', 0);

// set page header
jsPrintSetup.setOption('headerStrLeft', '');
jsPrintSetup.setOption('headerStrCenter', '');
jsPrintSetup.setOption('headerStrRight', '');

// set empty page footer
jsPrintSetup.setOption('footerStrLeft', '');
jsPrintSetup.setOption('footerStrCenter', '');
jsPrintSetup.setOption('footerStrRight', '');

// clears user preferences always silent print value
// to enable using 'printSilent' option
jsPrintSetup.clearSilentPrint();

// Suppress print dialog (for this context only)
jsPrintSetup.setOption('printSilent', 1);

// Do Print 
// When print is submitted it is executed asynchronous and
// script flow continues after print independently of completetion of print process! 
jsPrintSetup.print();

window.addEventListener('load', function () {
    var rotates = document.getElementsByClassName('rotate');
    for (var i = 0; i < rotates.length; i++) {
        rotates[i].style.height = rotates[i].offsetWidth + 'px';
    }
});
// next commands

</script>
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
}	
</style>	
</head>
<body>
<table width="100%">
  <thead>
    <tr>
      <td><table width="100%" border="1" class="table-list1"> 
  <tr>
    <td align="center"><strong><font size="+1">Cetak Detail Kirim Kain</font><br />
		<font size="-1">Prod. Order: <?php echo $modal_id;?></font>
          <br />
		<!-- <font size="-1">FW-06-QCF-01/04</font></strong></td> -->
    </tr>
  </table>

		</td>
    </tr>
	</thead>
	
    <tr>
      <td><table width="100%" border="1" class="table-list1"> 
		  <thead>
        <tr>
            <th width="5%"><div align="center">No</div></th>
            <th width="15%"><div align="center">Item Element</div></th>
            <th width="10%"><div align="center">Primary Qty</div></th>
            <th width="5%"><div align="center">UOM Primary</div></th>
            <th width="10%"><div align="center">Secondary Qty</div></th>
            <th width="5%"><div align="center">UOM Secondary</div></th>
            <th width="10%"><div align="center">Lokasi</div></th>
        </tr>
    </thead>
    <tbody>
      <?php
          $no=1;
        $sqldtl="SELECT 
          ALLOCATION.CODE,
          ALLOCATION.ORDERCODE,
          ALLOCATION.DECOSUBCODE05,
          ALLOCATION.PROJECTCODE,
          A.ITEMELEMENTCODE,
          A.LOTCODE,
          A.USERPRIMARYQUANTITY,
          A.USERPRIMARYUOMCODE,
          A.USERSECONDARYQUANTITY,
          A.USERSECONDARYUOMCODE,
          A.WHSLOCATIONWAREHOUSEZONECODE,
          A.WAREHOUSELOCATIONCODE
          FROM ALLOCATION ALLOCATION 
          LEFT JOIN (
              SELECT 
              ALLOCATION.CODE,
              ALLOCATION.LOTCODE,
              ALLOCATION.ITEMELEMENTCODE,
              ALLOCATION.USERPRIMARYQUANTITY,
              ALLOCATION.USERPRIMARYUOMCODE,
              ALLOCATION.USERSECONDARYQUANTITY,
              ALLOCATION.USERSECONDARYUOMCODE,
              ALLOCATION.WHSLOCATIONWAREHOUSEZONECODE,
              ALLOCATION.WAREHOUSELOCATIONCODE
              FROM ALLOCATION ALLOCATION
              WHERE ALLOCATION.DETAILTYPE ='0' AND ALLOCATION.ORIGINTRNTRANSACTIONNUMBER IS NULL 
          ) A ON ALLOCATION.CODE = A.CODE
          WHERE ORDERCODE ='$modal_id' AND ALLOCATION.DECOSUBCODE05='$nowarna' AND ALLOCATION.PROJECTCODE='$project' AND A.LOTCODE='$lotcode'";
          $stmt=db2_exec($conn1,$sqldtl, array('cursor'=>DB2_SCROLLABLE));
          $totalPrimaryQty = 0;
          $totalSecondaryQty = 0;
      while($r=db2_fetch_assoc($stmt)){
      ?>
      <tr>
          <td align="center" width="5%"><?php echo $no;?></td>
          <td align="center" width="15%"><?php echo $r['ITEMELEMENTCODE'];?></td>
          <td align="center" width="10%"><?php echo number_format($r['USERPRIMARYQUANTITY'], 2);?></td>
          <td align="center" width="5%"><?php echo $r['USERPRIMARYUOMCODE'];?></td>
          <td align="center" width="10%"><?php echo number_format($r['USERSECONDARYQUANTITY'], 2);?></td>
          <td align="center" width="5%"><?php echo $r['USERSECONDARYUOMCODE'];?></td>
          <td align="center" width="5%"><?php echo trim($r['WHSLOCATIONWAREHOUSEZONECODE'])."-".trim($r['WAREHOUSELOCATIONCODE']);?></td>
      </tr>
      <?php $no++; $totalPrimaryQty += $r['USERPRIMARYQUANTITY']; $totalSecondaryQty += $r['USERSECONDARYQUANTITY'];}?>
  </tbody>
      <tfoot>
        <tr>
          <td align="right" colspan="2">Total</td>
          <td><?= number_format($totalPrimaryQty, 2) ?></td>
          <td></td>
          <td><?= number_format($totalSecondaryQty, 2) ?></td>
          <td></td>
          <td></td>
        </tr>
      </tfoot>
        
      </table></td>
    </tr>
	</tbody>
  
</table>

<script>
//alert('cetak');window.print();
</script> 
</body>
</html>