<?php
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";

?>
<?php
$Awal = isset($_POST['awal']) ? $_POST['awal'] : '';
$Akhir = isset($_POST['akhir']) ? $_POST['akhir'] : '';
$Bulanm = isset($_POST['bulan']) ? date('m', strtotime($_POST['bulan'])) : ''; // output: 03
$BulanM = isset($_POST['bulan']) ? date('M', strtotime($_POST['bulan'])) : ''; // output: Mar
$TahunY = isset($_POST['bulan']) ? date('Y', strtotime($_POST['bulan'])) : ''; // output: 2024
$TanggalAwal = isset($_POST['bulan']) ? date('01', strtotime($_POST['bulan'])) : ''; // output: 01
$TanggalAkhir = isset($_POST['bulan']) ? date('t', strtotime($_POST['bulan'])) : ''; // output: 30


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

        .top-5-besar tr,
        .top-5-besar th,
        .top-5-besar td {
            border: 1px solid #909090 !important;
        }

        .top-5-besar td {
            vertical-align: middle !important;
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
                            <input name="bulan" type="month" class="form-control pull-right" />
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
    <!--Section 2 -->
    <div class="row">

        <!-- 5 Item Terbesar TPUKPE -->
        <div class="col-xs-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> 5 ITEM TERBESAR TPUKPE
                        <?= strtoupper($BulanM) . ' ' . $TahunY ?> PERIODE
                        <?= $TanggalAwal ?: '...' ?> S/D
                        <?= $TanggalAkhir ?: '...' ?>
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped top-5-besar" style="width: 100%;">
                        <thead class="bg-blue">
                            <tr>
                                <th width="5%">
                                    <div align="center">Hanger</div>
                                </th>
                                <th width="25%">
                                    <div align="center">Masalah</div>
                                </th>
                                <th width="14%">
                                    <div align="center">KG</div>
                                </th>
                                <th width="15%">
                                    <div align="center">Total Qty Per Item</div>
                                </th>
                                <th width="15%">
                                    <div align="center">Total Kirim Per Item</div>
                                </th>
                                <th width="15%">
                                    <div align="center">% Dibandingkan Total Kirim Per Item</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($con, "select 
                                                            b.no_hanger
                                                        from tbl_tpukpe_now a
                                                        left join tbl_aftersales_now b
                                                        on a.id_nsp = b.id
                                                        where year(a.tgl_buat) = '$TahunY' and month(a.tgl_buat) = '$Bulanm'
                                                        group by b.no_hanger
                                                        order by a.qty desc 
                                                        limit 5");

                            while ($row = mysqli_fetch_array($query)) {
                                $query2 = mysqli_query($con, "select 
                                                                    b.no_hanger,
                                                                    a.masalah_dominan,
                                                                    sum(a.qty) as kg,
                                                                    b.qty_kirim
                                                                from tbl_tpukpe_now a
                                                                left join tbl_aftersales_now b
                                                                on a.id_nsp = b.id
                                                                where b.no_hanger = '$row[no_hanger]'
                                                                group by b.no_hanger, a.masalah_dominan, b.qty_kirim
                                                                order by a.qty desc
                                                                limit 3");

                                $queryTotalQtyPerItem = mysqli_query($con, "
                                                                            select
                                                                                sum(a.kg) as total
                                                                            from (select 
                                                                                b.no_hanger,
                                                                                a.masalah_dominan,
                                                                                sum(a.qty) as KG
                                                                            from tbl_tpukpe_now a
                                                                            left join tbl_aftersales_now b
                                                                            on a.id_nsp = b.id
                                                                            where b.no_hanger = '$row[no_hanger]'
                                                                            group by b.no_hanger, a.masalah_dominan 
                                                                            order by a.qty desc
                                                                            limit 3) a limit 1");
                                $rowTotalQtyPerItem = mysqli_fetch_array($queryTotalQtyPerItem);

                                $rowspan = mysqli_num_rows($query2);
                                $count = 0;
                                while ($row2 = mysqli_fetch_array($query2)) {
                                    ?>
                                    <tr valign="top">
                                        <?php
                                        if ($count < 1) {
                                            ?>
                                            <td align="center" rowspan="<?= $rowspan ?>">
                                                <?= $row2['no_hanger'] ?>
                                            </td>
                                        <?php } ?>
                                        <td align="left">
                                            <?= $row2['masalah_dominan'] ?>
                                        </td>
                                        <td align="center">
                                            <?= $row2['kg'] ?>
                                        </td>
                                        <?php
                                        if ($count < 1) {
                                            ?>
                                            <td align="center" rowspan="<?= $rowspan ?>">
                                                <?= number_format($rowTotalQtyPerItem['total'], 2, '.', ',') ?>
                                            </td>
                                            <td align="center" rowspan="<?= $rowspan ?>">
                                                <?= $row2['qty_kirim'] ?>
                                            </td>
                                            <td align="center" rowspan="<?= $rowspan ?>">
                                                <?= number_format(($rowTotalQtyPerItem['total'] / $row2['qty_kirim']) * 100, 2, '.', '') . '%' ?>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                    <?php
                                    $count = 1;
                                }
                            }
                            ?>
                        </tbody>

                    </table>
                    <div class="box-footer">
                        <!-- <a href="pages/cetak/excel_5besar_def_tpukpe1.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>"
                            class="btn btn-success <?php if ($_POST['awal'] == "") {
                                echo "disabled";
                            } ?>"
                            target="_blank"><i class="fa fa-file-excel-o"></i></a> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- 3 Pelanggan Terbesar TPUKPE -->
        <div class="col-xs-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> 3 PELANGGAN TERBESAR TPUKPE
                        <?= strtoupper($BulanM) . ' ' . $TahunY ?> PERIODE
                        <?= $TanggalAwal ?: '...' ?> S/D
                        <?= $TanggalAkhir ?: '...' ?>
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped top-5-besar" style="width: 100%;">
                        <thead class="bg-blue">
                            <tr>
                                <th width="5%">
                                    <div align="center">Pelanggan</div>
                                </th>
                                <th width="25%">
                                    <div align="center">Masalah</div>
                                </th>
                                <th width="14%">
                                    <div align="center">KG</div>
                                </th>
                                <th width="15%">
                                    <div align="center">Total Qty Per Item</div>
                                </th>
                                <th width="15%">
                                    <div align="center">Total Kirim Per Item</div>
                                </th>
                                <th width="15%">
                                    <div align="center">% Dibandingkan Total Kirim Per Item</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($con, "select 
                                                            b.no_hanger
                                                        from tbl_tpukpe_now a
                                                        left join tbl_aftersales_now b
                                                        on a.id_nsp = b.id
                                                        where year(a.tgl_buat) = '$TahunY' and month(a.tgl_buat) = '$Bulanm'
                                                        group by b.no_hanger
                                                        order by a.qty desc 
                                                        limit 3");

                            while ($row = mysqli_fetch_array($query)) {
                                $query2 = mysqli_query($con, "select 
                                                                    b.no_hanger,
                                                                    a.masalah_dominan,
                                                                    sum(a.qty) as kg,
                                                                    b.qty_kirim,
                                                                    b.buyer
                                                                from tbl_tpukpe_now a
                                                                left join tbl_aftersales_now b
                                                                on a.id_nsp = b.id
                                                                where b.no_hanger = '$row[no_hanger]'
                                                                group by b.no_hanger, a.masalah_dominan, b.qty_kirim, b.buyer
                                                                order by a.qty desc
                                                                limit 3");

                                $queryTotalQtyPerItem = mysqli_query($con, "
                                                                            select
                                                                                sum(a.kg) as total
                                                                            from (select 
                                                                                b.no_hanger,
                                                                                a.masalah_dominan,
                                                                                sum(a.qty) as KG
                                                                            from tbl_tpukpe_now a
                                                                            left join tbl_aftersales_now b
                                                                            on a.id_nsp = b.id
                                                                            where b.no_hanger = '$row[no_hanger]'
                                                                            group by b.no_hanger, a.masalah_dominan
                                                                            order by a.qty desc
                                                                            limit 3) a limit 1");
                                $rowTotalQtyPerItem = mysqli_fetch_array($queryTotalQtyPerItem);

                                $rowspan = mysqli_num_rows($query2);
                                $count = 0;
                                while ($row2 = mysqli_fetch_array($query2)) {
                                    ?>
                                    <tr valign="top">
                                        <?php
                                        if ($count < 1) {
                                            ?>
                                            <td align="center" rowspan="<?= $rowspan ?>">
                                                <?= $row2['buyer'] ?>
                                            </td>
                                        <?php } ?>
                                        <td align="left">
                                            <?= $row2['masalah_dominan'] ?>
                                        </td>
                                        <td align="center">
                                            <?= $row2['kg'] ?>
                                        </td>
                                        <?php
                                        if ($count < 1) {
                                            ?>
                                            <td align="center" rowspan="<?= $rowspan ?>">
                                                <?= number_format($rowTotalQtyPerItem['total'], 2, '.', ',') ?>
                                            </td>
                                            <td align="center" rowspan="<?= $rowspan ?>">
                                                <?= $row2['qty_kirim'] ?>
                                            </td>
                                            <td align="center" rowspan="<?= $rowspan ?>">
                                                <?= number_format(($rowTotalQtyPerItem['total'] / $row2['qty_kirim']) * 100, 2, '.', '') . '%' ?>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                    <?php
                                    $count = 1;
                                }
                            }
                            ?>
                        </tbody>

                    </table>
                    <div class="box-footer">
                        <!-- <a href="pages/cetak/excel_5besar_def_tpukpe1.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>"
                            class="btn btn-success <?php if ($_POST['awal'] == "") {
                                echo "disabled";
                            } ?>"
                            target="_blank"><i class="fa fa-file-excel-o"></i></a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Section 2 -->
    <div class="row">

        <!-- 3 Dept Terbesar TPUKPE -->
        <div class="col-xs-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> 3 DEPT TERBESAR TPUKPE
                        <?= strtoupper($BulanM) . ' ' . $TahunY ?> PERIODE
                        <?= $TanggalAwal ?: '...' ?> S/D
                        <?= $TanggalAkhir ?: '...' ?>
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped top-5-besar" style="width: 100%;">
                        <thead class="bg-blue">
                            <tr>
                                <th width="5%">
                                    <div align="center">DEPT</div>
                                </th>
                                <th width="25%">
                                    <div align="center">Masalah</div>
                                </th>
                                <th width="14%">
                                    <div align="center">KG</div>
                                </th>
                                <th width="15%">
                                    <div align="center">Total Qty Per Item</div>
                                </th>
                                <th width="15%">
                                    <div align="center">Total Kirim Per Item</div>
                                </th>
                                <th width="15%">
                                    <div align="center">% Dibandingkan Total Kirim Per Item</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($con, "select 
                                                            b.no_hanger
                                                        from tbl_tpukpe_now a
                                                        left join tbl_aftersales_now b
                                                        on a.id_nsp = b.id
                                                        where year(a.tgl_buat) = '$TahunY' and month(a.tgl_buat) = '$Bulanm'
                                                        group by b.no_hanger
                                                        order by a.qty desc 
                                                        limit 3");

                            while ($row = mysqli_fetch_array($query)) {
                                $query2 = mysqli_query($con, "select 
                                                                    b.no_hanger,
                                                                    a.masalah_dominan,
                                                                    sum(a.qty) as kg,
                                                                    a.t_jawab,
                                                                    a.t_jawab1,
                                                                    a.t_jawab2,
                                                                    b.qty_kirim
                                                                from tbl_tpukpe_now a
                                                                left join tbl_aftersales_now b
                                                                on a.id_nsp = b.id
                                                                where b.no_hanger = '$row[no_hanger]'
                                                                group by b.no_hanger, a.masalah_dominan, a.t_jawab, b.qty_kirim
                                                                order by a.qty desc
                                                                limit 3");

                                $queryTotalQtyPerItem = mysqli_query($con, "
                                                                            select
                                                                                sum(a.kg) as total
                                                                            from (select 
                                                                                b.no_hanger,
                                                                                a.masalah_dominan,
                                                                                sum(a.qty) as KG,
                                                                                b.qty_kirim
                                                                            from tbl_tpukpe_now a
                                                                            left join tbl_aftersales_now b
                                                                            on a.id_nsp = b.id
                                                                            where b.no_hanger = '$row[no_hanger]'
                                                                            group by b.no_hanger, a.masalah_dominan, b.qty_kirim
                                                                            order by a.qty desc
                                                                            limit 3) a limit 1");
                                $rowTotalQtyPerItem = mysqli_fetch_array($queryTotalQtyPerItem);

                                $rowspan = mysqli_num_rows($query2);
                                $count = 0;
                                while ($row2 = mysqli_fetch_array($query2)) {
                                    ?>
                                    <tr valign="top">
                                        <?php
                                        if ($count < 1) {
                                            ?>
                                            <td align="center" rowspan="<?= $rowspan ?>">
                                                <?php
                                                if ($row2['t_jawab2'] != "") {
                                                    echo $row2['t_jawab2'];
                                                } else if ($row2['t_jawab1'] != "") {
                                                    echo $row2['t_jawab1'];
                                                } else {
                                                    echo $row2['t_jawab'];
                                                }
                                                ?>
                                            </td>
                                        <?php } ?>
                                        <td align="left">
                                            <?= $row2['masalah_dominan'] ?>
                                        </td>
                                        <td align="center">
                                            <?= $row2['kg'] ?>
                                        </td>
                                        <?php
                                        if ($count < 1) {
                                            ?>
                                            <td align="center" rowspan="<?= $rowspan ?>">
                                                <?= number_format($rowTotalQtyPerItem['total'], 2, '.', ',') ?>
                                            </td>
                                            <td align="center" rowspan="<?= $rowspan ?>">
                                                <?= $row2['qty_kirim'] ?>
                                            </td>
                                            <td align="center" rowspan="<?= $rowspan ?>">
                                                <?= number_format(($rowTotalQtyPerItem['total'] / $row2['qty_kirim']) * 100, 2, '.', '') . '%' ?>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                    <?php
                                    $count = 1;
                                }
                            }
                            ?>
                        </tbody>

                    </table>
                    <div class="box-footer">
                        <!-- <a href="pages/cetak/excel_5besar_def_tpukpe1.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>"
                            class="btn btn-success <?php if ($_POST['awal'] == "") {
                                echo "disabled";
                            } ?>"
                            target="_blank"><i class="fa fa-file-excel-o"></i></a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script type="text/javascript">


</script>