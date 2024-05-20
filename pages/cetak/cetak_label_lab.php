<?php
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";

$nocounter = $_GET['nocounter'];
$data = mysqli_query($conlab, "SELECT * FROM tbl_test_qc WHERE no_counter = '$nocounter' ");
$r = mysqli_fetch_array($data);

?>
<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="styles_cetak.css" rel="stylesheet" type="text/css">
  <title>Cetak Label</title>
  <style>
    td {
      border-top: 0px #000000 solid;
      border-bottom: 0px #000000 solid;
      border-left: 0px #000000 solid;
      border-right: 0px #000000 solid;
    }
  </style>
</head>


<body>
  <table width="100%" border="0" style="width: 7in;">
    <tbody>
      <tr>

        <!-- end of pertama -->
        <td align="left" valign="top" style="height: 1.6in;">
          <table width="100%" border="0" class="table-list1" style="width: 2.3in;">
            <tr>
              <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size: 8px;">
                  <?php echo $r['no_counter']; ?>
                  <br>
                  <?php echo "Test-" . $r['no_test']; ?>&nbsp;&nbsp;<?= ''?>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;">
                  <?php echo $r['buyer']; ?>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;"><?php echo '' ?></div>
              </td>
            </tr>
            <tr>
              <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;">
                  <strong><?php echo $r['no_order']; ?></strong><?php echo " (" . $r['no_item'] . ")"; ?></div>
              </td>
            </tr>
            <tr>
              <td colspan="3" valign="top" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:6px;"><?php echo substr($r['jenis_kain'], 0, 100); ?></div>
              </td>
            </tr>
            <tr>
              <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;"><span
                    style="font-size:7px;"><?php echo "<strong><span style='font-size:9px;'>" . substr($r['warna'], 0, 60) . "</span></strong>/" . substr($r['no_warna'], 0, 15); ?></span>
                </div>
              </td>
            </tr>
            <!-- <tr>
              <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;">
                  <?php echo date('d-m-Y H:i', strtotime(substr($r['tgl_masuk'], 0, 18))) . "/" . substr($r['proses_fin'], 0, 14); ?><?php if ($r['suhu'] != '' and $r['suhu'] != '-') {
                       echo $suhu = '/' . $r['suhu'];
                     } else {
                       echo $suhu = '/0';
                     } ?>

                </div>
              </td>
            </tr> -->
            <!-- <tr>
              <td style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;">
                  <?php echo $r['nokk']; ?>&nbsp;<?php if ($r['lot_legacy'] != '-') {
                      echo $r['lot_legacy'];
                    }
                    ; ?></div>
              </td>
              <td width="14%" align="right" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;">L&amp;G:</div>
              </td>
              <td width="51%" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;"><?php echo $r['lebar'] . " x " . $r['gramasi']; ?></div>
              </td>
            </tr> -->
            <?php
            // if ($r['development'] == 'Additional') {
            //   $color = 'green';
            // } else if ($r['development'] == '1st Bulk') {
            //   $color = 'yellow';
            // } else if ($r['development'] == 'Development') {
            //   $color = 'red';
            // } else if ($r['development'] == 'Labdip') {
            //   $color = 'gray';
            // } else if ($r['development'] == 'Mini Bulk') {
            //   $color = 'blue';
            // } else if ($r['development'] == 'Request') {
            //   $color = 'purple';
            // } else {
            //   $color = '';
            // }
            ?>



            <?php
            if (strpos($r['pelanggan'], 'UNDER A') !== false) {
              ?>
              <!-- <tr>
                <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                  <div style="font-size: 8px;">
                    Waktu Shrinkage <br>
                    Waktu Testing : <?php // echo date('d-m-Y H:i', strtotime($r['tgl_update'] . '+ 4 hour'));
                      echo $waktu_testing = date('d-m-Y H:i', strtotime($r['tgl_masuk'] . '+ 4 hour'));

                      ?>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                  <div style="font-size: 8px;">Waktu Selesai Test :
                    <?php echo $waktu_selesai = date('d-m-Y H:i', strtotime($waktu_testing . '+ 6 hour')); ?></div>
                </td>
              </tr>
              <tr>
                <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                  <div style="font-size: 8px;">Waktu Ukur :
                    <?php echo $waktu_ukur = date('d-m-Y H:i', strtotime($waktu_selesai . '+ 4 hour')); ?></div>
                </td>
              </tr> -->
            <?php } ?>

            <!-- <tr>
              <td colspan=3 style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
        border-left:0px #000000 solid; border-right:0px #000000 solid; background-color:<?= $color ?>">
                &nbsp;
              </td>
            </tr> -->
          </table>
        </td> <!-- end of pertama -->

        <!-- end of kedua -->
        <td align="left" valign="top" style="height: 1.6in;">
          <table width="100%" border="0" class="table-list1" style="width: 2.3in;">
            <tr>
              <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size: 8px;">
                  <?php echo $r['no_counter']; ?>
                  <br>
                  <?php echo "Test-" . $r['no_test']; ?>&nbsp;&nbsp;<?= ''?>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;">
                  <?php echo $r['buyer']; ?>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;"><?php echo '' ?></div>
              </td>
            </tr>
            <tr>
              <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;">
                  <strong><?php echo $r['no_order']; ?></strong><?php echo " (" . $r['no_item'] . ")"; ?></div>
              </td>
            </tr>
            <tr>
              <td colspan="3" valign="top" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:6px;"><?php echo substr($r['jenis_kain'], 0, 100); ?></div>
              </td>
            </tr>
            <tr>
              <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;"><span
                    style="font-size:7px;"><?php echo "<strong><span style='font-size:9px;'>" . substr($r['warna'], 0, 60) . "</span></strong>/" . substr($r['no_warna'], 0, 15); ?></span>
                </div>
              </td>
            </tr>
            <!-- <tr>
              <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;">
                  <?php echo date('d-m-Y H:i', strtotime(substr($r['tgl_masuk'], 0, 18))) . "/" . substr($r['proses_fin'], 0, 14); ?><?php if ($r['suhu'] != '' and $r['suhu'] != '-') {
                       echo $suhu = '/' . $r['suhu'];
                     } else {
                       echo $suhu = '/0';
                     } ?>

                </div>
              </td>
            </tr> -->
            <!-- <tr>
              <td style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;">
                  <?php echo $r['nokk']; ?>&nbsp;<?php if ($r['lot_legacy'] != '-') {
                      echo $r['lot_legacy'];
                    }
                    ; ?></div>
              </td>
              <td width="14%" align="right" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;">L&amp;G:</div>
              </td>
              <td width="51%" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;"><?php echo $r['lebar'] . " x " . $r['gramasi']; ?></div>
              </td>
            </tr> -->
            <?php
            // if ($r['development'] == 'Additional') {
            //   $color = 'green';
            // } else if ($r['development'] == '1st Bulk') {
            //   $color = 'yellow';
            // } else if ($r['development'] == 'Development') {
            //   $color = 'red';
            // } else if ($r['development'] == 'Labdip') {
            //   $color = 'gray';
            // } else if ($r['development'] == 'Mini Bulk') {
            //   $color = 'blue';
            // } else if ($r['development'] == 'Request') {
            //   $color = 'purple';
            // } else {
            //   $color = '';
            // }
            ?>



            <?php
            if (strpos($r['pelanggan'], 'UNDER A') !== false) {
              ?>
              <!-- <tr>
                <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                  <div style="font-size: 8px;">
                    Waktu Shrinkage <br>
                    Waktu Testing : <?php // echo date('d-m-Y H:i', strtotime($r['tgl_update'] . '+ 4 hour'));
                      echo $waktu_testing = date('d-m-Y H:i', strtotime($r['tgl_masuk'] . '+ 4 hour'));

                      ?>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                  <div style="font-size: 8px;">Waktu Selesai Test :
                    <?php echo $waktu_selesai = date('d-m-Y H:i', strtotime($waktu_testing . '+ 6 hour')); ?></div>
                </td>
              </tr>
              <tr>
                <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                  <div style="font-size: 8px;">Waktu Ukur :
                    <?php echo $waktu_ukur = date('d-m-Y H:i', strtotime($waktu_selesai . '+ 4 hour')); ?></div>
                </td>
              </tr> -->
            <?php } ?>

            <!-- <tr>
              <td colspan=3 style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
        border-left:0px #000000 solid; border-right:0px #000000 solid; background-color:<?= $color ?>">
                &nbsp;
              </td>
            </tr> -->
          </table>
        </td> <!-- end of kedua -->

        <!-- end of ketiga -->
        <td align="left" valign="top" style="height: 1.6in;">
          <table width="100%" border="0" class="table-list1" style="width: 2.3in;">
            <tr>
              <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size: 8px;">
                  <?php echo $r['no_counter']; ?>
                  <br>
                  <?php echo "Test-" . $r['no_test']; ?>&nbsp;&nbsp;<?= ''?>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;">
                  <?php echo $r['buyer']; ?>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;"><?php echo '' ?></div>
              </td>
            </tr>
            <tr>
              <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;">
                  <strong><?php echo $r['no_order']; ?></strong><?php echo " (" . $r['no_item'] . ")"; ?></div>
              </td>
            </tr>
            <tr>
              <td colspan="3" valign="top" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:6px;"><?php echo substr($r['jenis_kain'], 0, 100); ?></div>
              </td>
            </tr>
            <tr>
              <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;"><span
                    style="font-size:7px;"><?php echo "<strong><span style='font-size:9px;'>" . substr($r['warna'], 0, 60) . "</span></strong>/" . substr($r['no_warna'], 0, 15); ?></span>
                </div>
              </td>
            </tr>
            <!-- <tr>
              <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;">
                  <?php echo date('d-m-Y H:i', strtotime(substr($r['tgl_masuk'], 0, 18))) . "/" . substr($r['proses_fin'], 0, 14); ?><?php if ($r['suhu'] != '' and $r['suhu'] != '-') {
                       echo $suhu = '/' . $r['suhu'];
                     } else {
                       echo $suhu = '/0';
                     } ?>

                </div>
              </td>
            </tr> -->
            <!-- <tr>
              <td style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;">
                  <?php echo $r['nokk']; ?>&nbsp;<?php if ($r['lot_legacy'] != '-') {
                      echo $r['lot_legacy'];
                    }
                    ; ?></div>
              </td>
              <td width="14%" align="right" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;">L&amp;G:</div>
              </td>
              <td width="51%" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                <div style="font-size:9px;"><?php echo $r['lebar'] . " x " . $r['gramasi']; ?></div>
              </td>
            </tr> -->
            <?php
            // if ($r['development'] == 'Additional') {
            //   $color = 'green';
            // } else if ($r['development'] == '1st Bulk') {
            //   $color = 'yellow';
            // } else if ($r['development'] == 'Development') {
            //   $color = 'red';
            // } else if ($r['development'] == 'Labdip') {
            //   $color = 'gray';
            // } else if ($r['development'] == 'Mini Bulk') {
            //   $color = 'blue';
            // } else if ($r['development'] == 'Request') {
            //   $color = 'purple';
            // } else {
            //   $color = '';
            // }
            ?>



            <?php
            if (strpos($r['pelanggan'], 'UNDER A') !== false) {
              ?>
              <!-- <tr>
                <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                  <div style="font-size: 8px;">
                    Waktu Shrinkage <br>
                    Waktu Testing : <?php // echo date('d-m-Y H:i', strtotime($r['tgl_update'] . '+ 4 hour'));
                      echo $waktu_testing = date('d-m-Y H:i', strtotime($r['tgl_masuk'] . '+ 4 hour'));

                      ?>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                  <div style="font-size: 8px;">Waktu Selesai Test :
                    <?php echo $waktu_selesai = date('d-m-Y H:i', strtotime($waktu_testing . '+ 6 hour')); ?></div>
                </td>
              </tr>
              <tr>
                <td colspan="3" style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
  border-left:0px #000000 solid; border-right:0px #000000 solid;">
                  <div style="font-size: 8px;">Waktu Ukur :
                    <?php echo $waktu_ukur = date('d-m-Y H:i', strtotime($waktu_selesai . '+ 4 hour')); ?></div>
                </td>
              </tr> -->
            <?php } ?>

            <!-- <tr>
              <td colspan=3 style="border-top:0px #000000 solid; border-bottom:0px #000000 solid;
        border-left:0px #000000 solid; border-right:0px #000000 solid; background-color:<?= $color ?>">
                &nbsp;
              </td>
            </tr> -->
          </table>
        </td> <!-- end of ketiga -->

      </tr>
    </tbody>
  </table>
</body>

</html>