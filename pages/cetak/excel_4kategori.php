<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Summary-4Kategori-KPE-TotalKirim-".substr($_GET['awal'],0,10).".xls");//ganti nama sesuai keperluan
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
                <th bgcolor="#12C9F0">KATEGORI</th>
                <th bgcolor="#12C9F0">JUMLAH KASUS</th>
                <th bgcolor="#12C9F0">QTY KELUHAN (KG)</th>
                <th bgcolor="#12C9F0">% DIBANDINGKAN TOTAL KELUHAN</th>
                <th bgcolor="#12C9F0">% DIBANDINGKAN TOTAL KIRIM</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            if($Awal!=""){
            $qry9Repeat = mysqli_query($con,"select
                                                    count(*) as jumlah_kasus,
                                                    sum(rep.qty_claim) as qty_claim
                                                from
                                                    (
                                                    select
                                                        count(*) as jumlah_kasus,
                                                        sum(a.qty_claim) as qty_claim
                                                    from
                                                        tbl_aftersales_now a
                                                    where
                                                        date_format(a.tgl_buat, '%Y-%m-%d' ) between '$Awal' and '$Akhir'
                                                    group by
                                                        a.no_hanger,
                                                        a.masalah_dominan
                                                    having
                                                        count(*) > 1
                                                    order by
                                                        a.id asc
                                                ) rep");
            $ri9Repeat = mysqli_fetch_array($qry9Repeat);
            
            $qry9Major = mysqli_query($con, "select
                                                    count(*) as jumlah_kasus,
                                                    sum(rep.qty_claim2) as qty_claim2
                                                from
                                                    (
                                                    select
                                                        count(*) as jumlah_kasus,
                                                        sum(a.qty_claim2) as qty_claim2
                                                    from
                                                        tbl_aftersales_now a
                                                    where
                                                        date_format(a.tgl_buat, '%Y-%m-%d' ) between '$Awal' and '$Akhir'
                                                        and a.qty_claim2 > 500
                                                    group by
                                                        a.nodemand,
                                                        a.masalah_dominan
                                                    order by
                                                        a.id asc
                                                ) rep");
            $ri9Major = mysqli_fetch_array($qry9Major);

            $qry9General = mysqli_query($con, "select
                                                    count(*) as jumlah_kasus,
                                                    sum(rep.qty_claim2) as qty_claim2
                                                from
                                                    (
                                                    select
                                                        count(*) as jumlah_kasus,
                                                        sum(a.qty_claim2) as qty_claim2
                                                    from
                                                        tbl_aftersales_now a
                                                    where
                                                        date_format(a.tgl_buat, '%Y-%m-%d' ) between '$Awal' and '$Akhir'
                                                        and a.qty_claim2 < 500
                                                    group by
                                                        a.nodemand,
                                                        a.masalah_dominan
                                                    order by
                                                        a.id asc
                                                ) rep");
            $ri9General = mysqli_fetch_array($qry9General);

            $qry9Sample = mysqli_query($con, "select
                                                    count(*) as jumlah_kasus,
                                                    sum(rep.qty_claim) as qty_claim
                                                from
                                                    (
                                                    select
                                                        count(*) as jumlah_kasus,
                                                        sum(a.qty_claim) as qty_claim
                                                    from
                                                        tbl_aftersales_now a
                                                    where
                                                        date_format(a.tgl_buat, '%Y-%m-%d' ) between '$Awal' and '$Akhir'
                                                        and substring(a.no_order, 1, 3) in('SAM', 'SME')
                                                    group by
                                                        a.nodemand,
                                                        a.masalah_dominan
                                                    order by
                                                        a.id asc
                                                ) rep");
            $ri9Sample = mysqli_fetch_array($qry9Sample);

            $totalKasus = $ri9Repeat['jumlah_kasus'] + $ri9Major['jumlah_kasus'] + $ri9General['jumlah_kasus'] + $ri9Sample['jumlah_kasus'];
            $totalQty = $ri9Repeat['qty_claim'] + $ri9Major['qty_claim2'] + $ri9General['qty_claim2'] + $ri9Sample['qty_claim'];

            $repeatDibandingkanTotalKeluhan = number_format(($ri9Repeat['qty_claim']/$totalQty)*100, 2);
            $repeatDibandingkanTotalKirim = number_format(($ri9Repeat['qty_claim']/$TotalKirim)*100,2);
            $majorDibandingkanTotalKeluhan = number_format(($ri9Major['qty_claim2']/$totalQty)*100, 2);
            $majorDibandingkanTotalKirim = number_format(($ri9Major['qty_claim2']/$TotalKirim)*100,2);
            $generalDibandingkanTotalKeluhan = number_format(($ri9General['qty_claim2']/$totalQty)*100, 2);
            $generalDibandingkanTotalKirim = number_format(($ri9General['qty_claim2']/$TotalKirim)*100,2);
            $sampleDibandingkanTotalKeluhan = number_format(($ri9Sample['qty_claim']/$totalQty)*100, 2);
            $sampleDibandingkanTotalKirim = number_format(($ri9Sample['qty_claim']/$TotalKirim)*100,2);

            $persenTotalKeluhan = $repeatDibandingkanTotalKeluhan + $majorDibandingkanTotalKeluhan + $generalDibandingkanTotalKeluhan + $sampleDibandingkanTotalKeluhan;
            $persenTotalKirim = $repeatDibandingkanTotalKirim + $majorDibandingkanTotalKirim + $generalDibandingkanTotalKirim + $sampleDibandingkanTotalKirim;
            ?>
            <tr valign="top">
                <td align="center">1</td>  
                <td align="left">REPEAT</td>
                <td align="right"><?= $ri9Repeat['jumlah_kasus'] ?></td>
                <td align="right"><?= number_format($ri9Repeat['qty_claim'], 2) ?></td>
                <td align="right"><?php if($TotalKirim!=''){echo $repeatDibandingkanTotalKeluhan . " %";}else{echo "0";} ?></td>
                <td align="right"><?php if($TotalKirim!=''){echo $repeatDibandingkanTotalKirim ." %";}else{echo "0";} ?></td>
            </tr>
            <tr valign="top">
                <td align="center">2</td>  
                <td align="left">MAJOR</td>
                <td align="right"><?= $ri9Major['jumlah_kasus'] ?></td>
                <td align="right"><?= number_format($ri9Major['qty_claim2'], 2) ?></td>
                <td align="right"><?php if($TotalKirim!=''){echo $majorDibandingkanTotalKeluhan. " %";}else{echo "0";} ?></td>
                <td align="right"><?php if($TotalKirim!=''){echo $majorDibandingkanTotalKirim." %";}else{echo "0";} ?></td>
            </tr>
            <tr valign="top">
                <td align="center">4</td>  
                <td align="left">GENERAL</td>
                <td align="right"><?= $ri9General['jumlah_kasus'] ?></td>
                <td align="right"><?= number_format($ri9General['qty_claim2'], 2) ?></td>
                <td align="right"><?php if($TotalKirim!=''){echo $generalDibandingkanTotalKeluhan. " %";}else{echo "0";} ?></td>
                <td align="right"><?php if($TotalKirim!=''){echo $generalDibandingkanTotalKirim ." %";}else{echo "0";} ?></td>
            </tr>
            <tr valign="top">
                <td align="center">3</td>  
                <td align="left">SAMPLE</td>
                <td align="right"><?= $ri9Sample['jumlah_kasus'] ?></td>
                <td align="right"><?= number_format($ri9Sample['qty_claim'], 2) ?></td>
                <td align="right"><?php if($TotalKirim!=''){echo $sampleDibandingkanTotalKeluhan. " %";}else{echo "0";} ?></td>
                <td align="right"><?php if($TotalKirim!=''){echo $sampleDibandingkanTotalKirim ." %";}else{echo "0";} ?></td>
            </tr>
        <?php } ?>
        </tbody>
        <tfoot>
            <tr valign="top">
                <td align="right" colspan="2"><strong>TOTAL</strong></td>
                <td align="right" colspan="1"><strong><?php if($TotalKirim!=""){echo number_format($totalKasus,2);}else{echo "0";} ?></strong></td>
                <td align="right" colspan="1"><strong><?php if($TotalKirim!=""){echo number_format($totalQty,2);}else{echo "0";} ?></strong></td>
                <td align="right" colspan="1"><strong><?php if($TotalKirim!=''){echo number_format(($persenTotalKeluhan/$persenTotalKeluhan)*100,2)." %";}else{echo "0";} ?></strong></td>
            </tr>
            <tr valign="top">
                <td align="right" colspan="2"><strong>TOTAL KIRIM</strong></td>
                <td align="right" colspan="1"><strong><?php if($TotalKirim!=""){echo number_format($TotalKirim,2);}else{echo "0";} ?></strong></td>
            </tr>
        </tfoot>
    </table>
</body>