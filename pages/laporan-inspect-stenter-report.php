<?PHP

use GuzzleHttp\Psr7\Query;

ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
set_time_limit(0);
?>
<?php
$Awal = isset($_POST['awal']) ? $_POST['awal'] : '';
$Akhir = isset($_POST['akhir']) ? $_POST['akhir'] : '';
// $Digit = isset($_POST['DIGIT']) ? $_POST['DIGIT'] : '';

?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>

</head>

<body>
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Cari Data Laporan Stenter </h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
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
                            <input name="awal" type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Awal"
                                value="<?php echo $Awal; ?>" autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">
                        <div class="input-group date">
                            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                            <input name="akhir" type="text" class="form-control pull-right" id="datepicker1"
                                placeholder="Tanggal Akhir" value="<?php echo $Akhir; ?>" autocomplete="off" />
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-success" name="cari"><i class="fa fa-search"></i> Cari Data</button>
                    </div>
                </div>
                <!-- /.box-footer -->
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Report Inspect Stenter</h3><br>
                    <b>Tanggal Inspeksi :
                        <?php echo $_POST['awal']; ?> s.d.
                        <?php echo $_POST['akhir']; ?>
                    </b> <br><br>
                </div>
                <?php
                $qryb = "SELECT
                            *
                        FROM
                            tbl_lap_stenter
                        WHERE
                            DATE(tanggal_buat) BETWEEN '$Awal' AND '$Akhir'";
                $stmt1 = mysqli_query($con, $qryb);
                if ($stmt1) {
                ?>
                    
                <div class="box-body">
                    <table id="example3" class="table table-bordered table-hover table-striped display nowrap" width="100%">
                        <thead class="bg-blue">
                            <tr>
                                <th>No</th>
                                <th>No KK</th>
                                <th>No Demand</th>
                                <th>Langganan</th>
                                <th>Buyer</th>
                                <th>No Order</th>
                                <th>Jenis Kain</th>
                                <th>Warna</th>
                                <th>No MC</th>
                                <th>Bruto</th>
                                <th>Roll</th>
                                <th>No Hanger</th>
                                <th>No Item</th>
                                <th>Status</th>
                                <th>Catatan</th>
                                <th>No PO</th>
                                <th>Lebar</th>
                                <th>Gramasi</th>
                                <th>Operator</th>
                                <th>No Warna</th>
                                <th>Tanggal Buat</th>
                            </tr>
                            
                                
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($stmt1)) {
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row['nokk']; ?></td>
                                    <td><?php echo $row['nodemand']; ?></td>
                                    <td><?php echo $row['langganan']; ?></td>
                                    <td><?php echo $row['buyer']; ?></td>
                                    <td><?php echo $row['no_order']; ?></td>
                                    <td><?php echo $row['jenis_kain']; ?></td>
                                    <td><?php echo $row['warna']; ?></td>
                                    <td><?php echo $row['no_mc']; ?></td>
                                    <td><?php echo $row['bruto']; ?></td>
                                    <td><?php echo $row['roll']; ?></td>
                                    <td><?php echo $row['no_hanger']; ?></td>
                                    <td><?php echo $row['no_item']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    <td><?php echo $row['catatan']; ?></td>
                                    <td><?php echo $row['no_po']; ?></td>
                                    <td><?php echo $row['lebar']; ?></td>
                                    <td><?php echo $row['gramasi']; ?></td>
                                    <td><?php echo $row['operator']; ?></td>
                                    <td><?php echo $row['no_warna']; ?></td>
                                    <td><?php echo $row['tanggal_buat']; ?></td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                        
                    </table>
                </div>
                <?php
                } else {
                    echo "Query execution failed: " . mysqli_error($con);
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>