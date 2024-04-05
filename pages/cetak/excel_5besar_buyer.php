<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Summary-5-Buyer-Terbesar-KPE-TotalKirim-".substr($_GET['awal'],0,10).".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<?php
include "../../koneksi.php";
//--
$Awal = $_GET['awal'];
$Akhir = $_GET['akhir'];
$TotalKirim = $_GET['total'];
?>

<body>

    <strong>Periode:
        <?php echo $Awal; ?> s/d
        <?php echo $Akhir; ?>
    </strong><br>
    <table width="100%" border="1">
        <thead>
            <tr>
                <th bgcolor="#12C9F0">NO.</th>
                <th bgcolor="#12C9F0">BRAND/BUYER</th>
                <th bgcolor="#12C9F0">JUMLAH KASUS</th>
                <th bgcolor="#12C9F0">QTY KELUHAN (KG)</th>
                <th bgcolor="#12C9F0">% DIBANDINGKAN TOTAL KELUHAN</th>
                <th bgcolor="#12C9F0">% DIBANDINGKAN TOTAL KIRIM</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $qry8Total = mysqli_query($con, "select
                                                sum(qty_claim) as total_qty_keluhan
                                            from tbl_aftersales_now
                                            where date_format(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'
                                            order by total_qty_keluhan desc
                    limit 5");
            $ri8Total=mysqli_fetch_array($qry8Total);
            $qry8 = mysqli_query($con, "select
                                            buyer,
                                            count(*) as jumlah_kasus,
                                            sum(qty_claim) as qty_keluhan
                                        from tbl_aftersales_now
                                        where date_format(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'
                                        group by substring(buyer, 1, 3)
                                        order by qty_keluhan desc
                                        limit 5");
            $no = 1;
            while ($ri8 = mysqli_fetch_array($qry8)) {
                ?>
                <tr valign="top">
                    <td align="center"><?= $no++ ?></td>  
                    <td align="right"><?= $ri8['buyer'] ?></td>
                    <td align="right"><?= $ri8['jumlah_kasus'] ?></td>
                    <td align="right"><?= $ri8['qty_keluhan'] ?></td>
                    <td align="right"><?php if($TotalKirim!=''){echo number_format(($ri8['qty_keluhan'] / $ri8Total['total_qty_keluhan']) * 100, 2). " %";}else{echo "0";} ?></td>
                    <td align="right"><?php if($TotalKirim!=''){echo number_format(($ri8['qty_keluhan']/$TotalKirim)*100,2)." %";}else{echo "0";} ?></td>
                </tr>
                <?php
            } ?>
        </tbody>
        <tfoot>
            <tr valign="top">
                <td align="right" colspan="2"><strong>TOTAL KIRIM</strong></td>
                <td align="right" colspan="1"><strong><?php if($TotalKirim!=""){echo number_format($TotalKirim,2);}else{echo "0";} ?></strong></td>
            </tr>
        </tfoot>
    </table>
</body>