<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=delay-TQ_FL.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<?php 
include "../../koneksi.php";
//--
?>
<body>
	
<table width="100%" border="1">
    <tr>
      <th bgcolor="#12C9F0">NO</th>
      <th bgcolor="#12C9F0">NO. REPORT FL</th>
      <th bgcolor="#12C9F0">NO. KK</th>
      <th bgcolor="#12C9F0">TANGGAL TARGET</th>
      <th bgcolor="#12C9F0">LANGGANAN</th>
    </tr>
	<?php 
    $no=1;
    $query=mysqli_query($con,"SELECT a.*, a.id AS idkk, b.* 
      FROM tbl_tq_first_lot a
      LEFT JOIN tbl_tq_test_fl b ON a.id=b.id_nokk
      WHERE (`status`='' or `status` IS NULL) and DATE_FORMAT( tgl_masuk, '%Y-%m-%d' ) between date_sub(now(),INTERVAL 30 DAY) and now()
      ORDER BY tgl_target ASC");
	while($r=mysqli_fetch_array($query)){
        $tgltarget = new DateTime($r['tgl_target']);
        $now=new DateTime();
        $target = $now->diff($tgltarget);
        $delay = $tgltarget->diff($now);
	?>
    <tr>
      <td align="center"><?php echo $no;?></td>
      <td align="center">'<?php echo $r['no_report_fl'];?></td>
      <td align="center">'<?php echo $r['nokk'];?></td>
      <td align="center"><?php echo $r['tgl_target'];?><br>
      <?php if($delay->d>0){ ?>
        <span style="color:#F44336;text-align:center;"><?php echo "Delay "; echo $delay->d; echo " Hari";?></span>
      <?php } ?>
      </td>
      <td align="center"><?php echo $r['pelanggan'];?></td>
  </tr>
    <?php $no++;} ?>
</table>
</body>