<?php
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";

$idkk = $_REQUEST['idkk'];

$data = mysqli_query($con, "select
                              b.physical,
                              b.functional,
                              b.colorfastness
                            from
                              tbl_tq_nokk a
                            left join
                              tbl_master_test b
                              on
                              a.no_test = b.no_testmaster
                            where
                              a.nodemand = '$idkk'
                            order by
                              a.id desc
                            limit 1");

$row = mysqli_fetch_array($data);

$detail = explode(",", rtrim($row['physical'], ','));
$detail1 = explode(",", rtrim($row['functional'], ','));
$detail2 = explode(",", rtrim($row['colorfastness'], ','));

$r = array_merge($detail, $detail1, $detail2);

$i = 0;
$ii = 0;
$iii = 0;
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
      border: none !important;
      font-size: 8px !important;
      vertical-align: top !important;
    }
  </style>
</head>


<body>
  <table width="100%" border="0" style="width: 7in; border-collapse: collapse">
    <tbody>
      <tr>
        <td align="left" valign="top" style="height: 1.6in; border: 1px solid #000 !important;">
          <table width="100%" border="0" class="table-list1" style="width: 2.3in;">
            <tr>
              <td colspan="3">
                <table>
                  <?php while ($i < 10) { ?>
                    <tr>
                      <td><?= $r[$i++] ?></td>
                    </tr>
                  <?php } ?>
                </table>
              </td>
              <td colspan="3">
                <table>
                  <?php while ($i < 20) { ?>
                    <tr>
                      <td><?= $r[$i++] ?></td>
                    </tr>
                  <?php } ?>
                </table>
              </td>
            </tr>
          </table>
        </td>

        <td align="left" valign="top" style="height: 1.6in; border: 1px solid #000 !important">
          <table width="100%" border="0" class="table-list1" style="width: 2.3in;">
            <tr>
              <td colspan="3">
                <table>
                  <?php while ($ii < 10) { ?>
                    <tr>
                      <td><?= $r[$ii++] ?></td>
                    </tr>
                  <?php } ?>
                </table>
              </td>
              <td colspan="3">
                <table>
                  <?php while ($ii < 20) { ?>
                    <tr>
                      <td><?= $r[$ii++] ?></td>
                    </tr>
                  <?php } ?>
                </table>
              </td>
            </tr>
          </table>
        </td>

        <td align="left" valign="top" style="height: 1.6in; border: 1px solid #000 !important">
          <table width="100%" border="0" class="table-list1" style="width: 2.3in;">
            <tr>
              <td colspan="3">
                <table>
                  <?php while ($iii < 10) { ?>
                    <tr>
                      <td><?= $r[$iii++] ?></td>
                    </tr>
                  <?php } ?>
                </table>
              </td>
              <td colspan="3">
                <table>
                  <?php while ($iii < 20) { ?>
                    <tr>
                      <td><?= $r[$iii++] ?></td>
                    </tr>
                  <?php } ?>
                </table>
              </td>
            </tr>
          </table>
        </td>

      </tr>
    </tbody>
  </table>
</body>

</html>