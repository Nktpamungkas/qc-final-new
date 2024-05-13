<?php
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";

?>
<?php
$Awal = isset($_POST['awal']) ? $_POST['awal'] : '';
$Akhir = isset($_POST['akhir']) ? $_POST['akhir'] : '';
$TotalKirim = isset($_POST['total']) ? $_POST['total'] : '';
$Langganan = isset($_POST['langganan']) ? $_POST['langganan'] : '';
$TotalLot = isset($_POST['totallot']) ? $_POST['totallot'] : '';
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Grafik</title>
    <script src="plugins/highcharts/code/highcharts.js"></script>
    <script src="plugins/highcharts/code/highcharts-3d.js"></script>
    <script src="plugins/highcharts/code/modules/exporting.js"></script>
    <script src="plugins/highcharts/code/modules/export-data.js"></script>
    <style type="text/css">
        #container {
            height: 400px;
            min-width: 310px;
            max-width: 800px;
            margin: 0 auto;
        }

        #container1 {
            height: 400px;
            min-width: 310px;
            max-width: 800px;
            margin: 0 auto;
        }

        #container2 {
            height: 400px;
            min-width: 310px;
            max-width: 800px;
            margin: 0 auto;
        }

        #container3 {
            height: 400px;
            min-width: 310px;
            max-width: 800px;
            margin: 0 auto;
        }

        #container4 {
            height: 400px;
            min-width: 310px;
            max-width: 800px;
            margin: 0 auto;
        }

        #container5 {
            height: 400px;
            min-width: 310px;
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
</head>

<body>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Filter Grafik Per Periode</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                        class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="post" enctype="multipart/form-data" name="form1" class="form-horizontal" id="form1">
            <div class="box-body">
                <div class="form-group">
                    <div class="col-sm-2">
                        <div class="input-group date">
                            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                            <input name="awal" type="text" class="form-control pull-right" id="datepicker"
                                placeholder="Tanggal Awal" value="<?php echo $Awal; ?>" />
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group date">
                            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                            <input name="akhir" type="text" class="form-control pull-right" id="datepicker1"
                                placeholder="Tanggal Akhir" value="<?php echo $Akhir; ?>" />
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group date">
                            <div class="input-group-addon"> Total Kirim</div>
                            <input name="total" type="text" class="form-control pull-right" placeholder="0"
                                value="<?php echo $TotalKirim; ?>" />
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group date">
                            <div class="input-group-addon"> Total Lot Kirim</div>
                            <input name="totallot" type="text" class="form-control pull-right" id="totallot"
                                placeholder="0" value="<?php echo $TotalLot; ?>" />
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group date">
                            <div class="input-group-addon"> Langganan</div>
                            <input name="langganan" type="text" class="form-control pull-right" placeholder="Langganan"
                                value="<?php echo $Langganan; ?>" />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success " name="cari"><i class="fa fa-search"></i> Cari
                        Data</button>
                    <!-- /.input group -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                </div>
                <!-- /.box-footer -->

            </div>
        </form>
    </div>
    <!-- Section 3 -->
    <div class="row">
        <div class="col-xs-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> 5 Terbesar Masalah Per Hanger : <?php echo $Awal . " s/d " . $Akhir; ?></h3>
                    <!-- disini 2 -->
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped" style="width: 100%;">
                        <thead class="bg-blue">
                            <tr>
                                <th width="15%">
                                    <div align="center">Hanger</div>
                                </th>
                                <th width="20%">
                                    <div align="center">Masalah</div>
                                </th>
                                <th width="20%">
                                    <div align="center">Jumlah Kasus</div>
                                </th>
                                <th width="14%">
                                    <div align="center">KG</div>
                                </th>
                                <th width="15%">
                                    <div align="center">% Dibandingkan Total Keluhan</div>
                                </th>
                                <th width="15%">
                                    <div align="center">% Dibandingkan Total Kirim</div>
                                </th>
                                <th width="15%">
                                    <div align="center">% Masalah Per Hanger</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($Langganan != '') {
                                $lgn = " AND langganan LIKE '%$Langganan%' ";
                            } else {
                                $lgn = "";
                            }
                            $qry7Total5 = mysqli_query($con, "SELECT 
                                                            no_hanger
                                                        FROM tbl_aftersales_now WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'
                                                        GROUP BY no_hanger
                                                        ORDER BY SUM(qty_claim) DESC
                                                        LIMIT 5");
                            $ri7Total = 0;
                            while ($ri7Total5 = mysqli_fetch_array($qry7Total5)) {
                                $qry7Total3 = mysqli_query($con, "SELECT
                                                                SUM(qty_claim) AS qty_keluhan 
                                                            FROM tbl_aftersales_now 
                                                            WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND no_hanger='$ri7Total5[no_hanger]'
                                                            ORDER BY qty_keluhan DESC
                                                            LIMIT 3");
                                $ri7Total3 = mysqli_fetch_array($qry7Total3);
                                $ri7Total += $ri7Total3['qty_keluhan'];
                            }

                            $qry7 = mysqli_query($con, "SELECT no_item, no_hanger, SUM(qty_claim) AS qty_keluhan FROM tbl_aftersales_now WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' $lgn
                    GROUP BY no_hanger
                    ORDER BY qty_keluhan DESC
                    LIMIT 5");
                            while ($ri7 = mysqli_fetch_array($qry7)) {
                                $qryd7 = mysqli_query($con, "SELECT count(*) as jumlah_kasus, masalah_dominan, SUM(qty_claim) AS qty_keluhan FROM tbl_aftersales_now WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' $lgn
                        AND no_hanger='$ri7[no_hanger]' 
                        GROUP BY masalah_dominan
                        ORDER BY qty_keluhan DESC
                        LIMIT 3");
                                $qrykirim = mysqli_query($con, "SELECT SUM(qty) AS qty_kirim FROM tbl_pengiriman WHERE DATE_FORMAT(tgl_kirim, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND no_item='$ri7[no_item]' AND tmp_hapus='0'");
                                $rkirim = mysqli_fetch_array($qrykirim);
                                $qrytitem = mysqli_query($con, "SELECT SUM(a.qty_keluhan) AS total_keluhan FROM
                        (SELECT SUM(qty_claim) AS qty_keluhan FROM tbl_aftersales_now WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'
                        AND no_hanger='$ri7[no_hanger]' 
                        GROUP BY masalah_dominan
                        ORDER BY qty_keluhan DESC
                        LIMIT 3) a");
                                $ritem = mysqli_fetch_array($qrytitem);
                                while ($rdi7 = mysqli_fetch_array($qryd7)) {
                                    ?>
                                    <tr valign="top">
                                        <td align="center"><?php echo $ri7['no_hanger']; ?></td>
                                        <td align="right"><?php echo $rdi7['masalah_dominan']; ?></td>
                                        <td align="right"><?php echo $rdi7['jumlah_kasus']; ?></td>
                                        <td align="right"><?php echo $rdi7['qty_keluhan']; ?></td>
                                        <td align="right">
                                            <?php if ($TotalKirim != '') {
                                                echo number_format(($rdi7['qty_keluhan'] / $ri7Total) * 100, 2) . " %";
                                            } else {
                                                echo "0";
                                            } ?>
                                        </td>
                                        <td align="right">
                                            <?php if ($TotalKirim != '') {
                                                echo number_format(($rdi7['qty_keluhan'] / $TotalKirim) * 100, 2) . " %";
                                            } else {
                                                echo "0";
                                            } ?>
                                        </td>
                                        <td align="right">
                                            <?php if ($TotalKirim != '') {
                                                echo number_format(($ritem['total_keluhan'] / $TotalKirim) * 100, 2) . " %";
                                            } else {
                                                echo "0";
                                            } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr valign="top">
                                <td align="center" colspan="1"><strong>TOTAL KIRIM</strong></td>
                                <td align="right" colspan="1">
                                    <strong><?php if ($TotalKirim != "") {
                                        echo number_format($TotalKirim, 2);
                                    } else {
                                        echo "0";
                                    } ?></strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="box-footer">
                        <a href="pages/cetak/excel_3besar_masalah_item.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&langganan=<?php echo $_POST['langganan']; ?>&kirim=<?php echo $TotalKirim; ?>&totalk=<?= $ri7Total ?>"
                            class="btn btn-success <?php if ($_POST['awal'] == "") {
                                echo "disabled";
                            } ?>" target="_blank"><i class="fa fa-file-excel-o"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->
        <div class="col-xs-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> 5 Terbesar Masalah Per Langganan : <?php echo $Awal . " s/d " . $Akhir; ?></h3>
                    <!-- disini 2 -->
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped" style="width: 100%;">
                        <thead class="bg-blue">
                            <tr>
                                <th width="15%">
                                    <div align="center">Langganan</div>
                                </th>
                                <th width="20%">
                                    <div align="center">Masalah</div>
                                </th>
                                <th width="20%">
                                    <div align="center">Jumlah Kasus</div>
                                </th>
                                <th width="14%">
                                    <div align="center">KG</div>
                                </th>
                                <th width="15%">
                                    <div align="center">% Dibandingkan Total Keluhan</div>
                                </th>
                                <th width="15%">
                                    <div align="center">% Dibandingkan Total Kirim</div>
                                </th>
                                <th width="15%">
                                    <div align="center">% Masalah Per Hanger</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($Langganan != '') {
                                $lgn = " AND langganan LIKE '%$Langganan%' ";
                            } else {
                                $lgn = "";
                            }
                            $qry7Total5 = mysqli_query($con, "SELECT 
                                                            no_hanger
                                                        FROM tbl_aftersales_now WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'
                                                        GROUP BY no_hanger
                                                        ORDER BY SUM(qty_claim) DESC
                                                        LIMIT 5");
                            $ri7Total = 0;
                            while ($ri7Total5 = mysqli_fetch_array($qry7Total5)) {
                                $qry7Total3 = mysqli_query($con, "SELECT
                                                                SUM(qty_claim) AS qty_keluhan 
                                                            FROM tbl_aftersales_now 
                                                            WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND no_hanger='$ri7Total5[no_hanger]'
                                                            ORDER BY qty_keluhan DESC
                                                            LIMIT 3");
                                $ri7Total3 = mysqli_fetch_array($qry7Total3);
                                $ri7Total += $ri7Total3['qty_keluhan'];
                            }

                            $qry7 = mysqli_query($con, "SELECT no_item, no_hanger, SUM(qty_claim) AS qty_keluhan, langganan FROM tbl_aftersales_now WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' $lgn
                    GROUP BY no_hanger
                    ORDER BY qty_keluhan DESC
                    LIMIT 5");
                            while ($ri7 = mysqli_fetch_array($qry7)) {
                                $qryd7 = mysqli_query($con, "SELECT count(*) as jumlah_kasus, masalah_dominan, SUM(qty_claim) AS qty_keluhan FROM tbl_aftersales_now WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' $lgn
                        AND no_hanger='$ri7[no_hanger]' 
                        GROUP BY masalah_dominan
                        ORDER BY qty_keluhan DESC
                        LIMIT 3");
                                $qrykirim = mysqli_query($con, "SELECT SUM(qty) AS qty_kirim FROM tbl_pengiriman WHERE DATE_FORMAT(tgl_kirim, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND no_item='$ri7[no_item]' AND tmp_hapus='0'");
                                $rkirim = mysqli_fetch_array($qrykirim);
                                $qrytitem = mysqli_query($con, "SELECT SUM(a.qty_keluhan) AS total_keluhan FROM
                        (SELECT SUM(qty_claim) AS qty_keluhan FROM tbl_aftersales_now WHERE DATE_FORMAT(tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'
                        AND no_hanger='$ri7[no_hanger]' 
                        GROUP BY masalah_dominan
                        ORDER BY qty_keluhan DESC
                        LIMIT 3) a");
                                $ritem = mysqli_fetch_array($qrytitem);
                                while ($rdi7 = mysqli_fetch_array($qryd7)) {
                                    ?>
                                    <tr valign="top">
                                        <td align="center"><?php echo $ri7['langganan']; ?></td>
                                        <td align="right"><?php echo $rdi7['masalah_dominan']; ?></td>
                                        <td align="right"><?php echo $rdi7['jumlah_kasus']; ?></td>
                                        <td align="right"><?php echo $rdi7['qty_keluhan']; ?></td>
                                        <td align="right">
                                            <?php if ($TotalKirim != '') {
                                                echo number_format(($rdi7['qty_keluhan'] / $ri7Total) * 100, 2) . " %";
                                            } else {
                                                echo "0";
                                            } ?>
                                        </td>
                                        <td align="right">
                                            <?php if ($TotalKirim != '') {
                                                echo number_format(($rdi7['qty_keluhan'] / $TotalKirim) * 100, 2) . " %";
                                            } else {
                                                echo "0";
                                            } ?>
                                        </td>
                                        <td align="right">
                                            <?php if ($TotalKirim != '') {
                                                echo number_format(($ritem['total_keluhan'] / $TotalKirim) * 100, 2) . " %";
                                            } else {
                                                echo "0";
                                            } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr valign="top">
                                <td align="center" colspan="1"><strong>TOTAL KIRIM</strong></td>
                                <td align="right" colspan="1">
                                    <strong><?php if ($TotalKirim != "") {
                                        echo number_format($TotalKirim, 2);
                                    } else {
                                        echo "0";
                                    } ?></strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="box-footer">
                        <a href="pages/cetak/excel_3besar_masalah_item.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&langganan=<?php echo $_POST['langganan']; ?>&kirim=<?php echo $TotalKirim; ?>&totalk=<?= $ri7Total ?>"
                            class="btn btn-success <?php if ($_POST['awal'] == "") {
                                echo "disabled";
                            } ?>" target="_blank"><i class="fa fa-file-excel-o"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>