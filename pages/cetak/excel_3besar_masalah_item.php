<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=5Besar-Masalah-PerHanger-".substr($_GET['awal'],0,10).".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<?php 
include "../../koneksi.php";
//--
$Awal=$_GET['awal'];
$Akhir=$_GET['akhir'];
$Langganan = $_GET['langganan'];
$Kirim=$_GET['kirim'];
?>
<body>

<strong>Periode: <?php echo $Awal; ?> s/d <?php echo $Akhir; ?></strong><br>
<table width="100%" border="1">
    <thead>
        <tr>
        <th bgcolor="#12C9F0">Hanger</th>
        <th bgcolor="#12C9F0">Masalah</th>
        <th bgcolor="#12C9F0">Jumlah Kasus</th>
        <th bgcolor="#12C9F0">KG</th>
        <th bgcolor="#12C9F0">% Dibandingan Total Keluhan</th>
        <th bgcolor="#12C9F0">% Dibandingkan Total Kirim</th>
        <th bgcolor="#12C9F0">% Masalah Per Hanger</th>
        </tr>
    </thead>
    <tbody>
	<?php 
        $tkirim=0;
        if($Langganan!=''){$lgn=" AND langganan LIKE '%$Langganan%' ";}else{$lgn="";}
        $qry7=mysqli_query($con,"SELECT no_item, no_hanger, SUM(qty_claim) AS qty_keluhan FROM tbl_aftersales_now WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' $lgn
        GROUP BY no_hanger
        ORDER BY qty_keluhan DESC
        LIMIT 5");
        while($ri7=mysqli_fetch_array($qry7)){
            $qryd7=mysqli_query($con,"SELECT count(*) as jumlah_kasus, masalah_dominan, SUM(qty_claim) AS qty_keluhan FROM tbl_aftersales_now WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' $lgn
            AND no_hanger='$ri7[no_hanger]' 
            GROUP BY masalah_dominan
            ORDER BY qty_keluhan DESC
            LIMIT 3");
            $qrykirim=mysqli_query($con,"SELECT SUM(qty) AS qty_kirim FROM tbl_pengiriman WHERE DATE_FORMAT(tgl_kirim, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND no_item='$ri7[no_item]' AND tmp_hapus='0'");
            $rkirim=mysqli_fetch_array($qrykirim);
            $qrytitem=mysqli_query($con,"SELECT SUM(a.qty_keluhan) AS total_keluhan FROM
            (SELECT SUM(qty_claim) AS qty_keluhan FROM tbl_aftersales_now WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'
            AND no_hanger='$ri7[no_hanger]' 
            GROUP BY masalah_dominan
            ORDER BY qty_keluhan DESC
            LIMIT 3) a");
            $ritem=mysqli_fetch_array($qrytitem);
            while($rdi7=mysqli_fetch_array($qryd7)){
    ?>
        <tr valign="top">
            <td align="center"><?php echo $ri7['no_hanger'];?></td>  
            <td align="right"><?php echo $rdi7['masalah_dominan'];?></td>
            <td align="right"><?php echo $rdi7['jumlah_kasus'];?></td>
            <td align="right"><?php echo $rdi7['qty_keluhan'];?></td>
            <td align="right"><?php if($_GET['totalk']!=''){echo number_format(($rdi7['qty_keluhan']/$_GET['totalk'])*100,2)." %";}else{echo "0";}?></td>
            <td align="right"><?php if($_GET['kirim']!=''){echo number_format(($rdi7['qty_keluhan']/$_GET['kirim'])*100,2)." %";}else{echo "0";}?></td>
            <td align="right"><?php if($_GET['kirim']!=''){echo number_format(($ritem['total_keluhan']/$_GET['kirim'])*100,2)." %";}else{echo "0";}?></td>
        </tr>
    <?php  
    $tkirim=$tkirim+$_GET['kirim'];} } 
    ?>
    </tbody>
    <tfoot>
        <tr valign="top">
            <td align="center" colspan="1"><strong>TOTAL KIRIM</strong></td>
            <td align="right" colspan="1"><strong><?php if($_GET['kirim']!=''){echo number_format($_GET['kirim'],2);} ?></strong></td>
        </tr>
    </tfoot>
</table>
</body>