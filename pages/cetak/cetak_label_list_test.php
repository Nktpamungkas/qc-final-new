<?php
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";

$singkatan = [
  "FLAMMABILITY" => "Flam",
  "FIBER CONTENT" => "Fiber Co",
  "FABRIC COUNT" => "Fabric Co",
  "BOW & SKEW" => "Bow-Skew",
  "PILLING MARTINDLE" => "Pill Mar",
  "FABRIC WEIGHT & SHRINKAGE & SPIRALITY" => "fw & shrink-Spr",
  "PILLING BOX" => "Pill Box",
  "PILLING RANDOM TUMBLER" => "Pill Rand",
  "ABRATION" => "Abration",
  "SNAGGING MACE" => "Snagg Mace",
  "SNAGGING POD" => "Snagg Pod",
  "BEAN BAG" => "Bean Bag",
  "BURSTING STRENGTH" => "Burst Strength",
  "THICKNESS" => "Thickness",
  "STRETCH & RECOVERY" => "S & R",
  "GROWTH" => "Growth",
  "APPEARANCE" => "Apperance",
  "HEAT SHRINKAGE" => "Heat Shrink",
  "FIBRE/FUZZ" => "Fibre/Fuzz",
  "PILLING LOCUS" => "Pill Loc",
  "ODOUR" => "Odour",
  "CURLING" => "Curling",
  "NEDLE" => "NedHol & crock",
  "WICKING" => "Wicking",
  "ABSORBENCY" => "Absorbency",
  "DRYING TIME" => "Dry Time",
  "WATER REPPELENT" => "Water Repp",
  "PH" => "PH",
  "SOIL RELEASE" => "Soil Release",
  "HUMIDITY" => "Humidity",
  "WASHING" => "Wash Fast",
  "PERSPIRATION ACID" => "Pers Fast Acid",
  "PERSPIRATION ALKALINE" => "Pers Fast Alkali",
  "WATER" => "Water Fast",
  "CROCKING" => "Crock Fast",
  "LIGHT" => "Light Fast",
  "COLOR MIGRATION-OVEN TEST" => "C migration -OT",
  "COLOR MIGRATION" => "C Migration Fast",
  "LIGHT PERSPIRATION" => "Light Pers",
  "SALIVA" => "Saliva Fast",
  "BLEEDING" => "Bleeding",
  "CHLORIN & NON-CHLORIN" => "Chlo & N-Ch",
  "DYE TRANSFER" => "Dye Trans",
  "SWEAT CONCEAL" => "Sweat Conceal",
  "PHENOLIC YELLOWING" => "Pehn Yellow",
  "WRINKLE" => "Wrinkle"
];

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
      font-size: 7px !important;
      vertical-align: top !important;
    }
  </style>
</head>


<body>
  <table width="100%" border="0" style="width: 7in; border-collapse: collapse">
    <tbody>
      <tr>
        <td align="left" valign="top" style="height: 1.6in;;">
          <table width="100%" border="0" class="table-list1" style="width: 2.3in;">
            <tr>
              <td colspan="3">
                <table>
                  <?php while ($i < 10) { ?>
                    <tr>
                      <td><?= $singkatan[$r[$i++]] ?></td>
                    </tr>
                  <?php } ?>
                </table>
              </td>
              <td colspan="3">
                <table>
                  <?php while ($i < 20) { ?>
                    <tr>
                      <td><?= $singkatan[$r[$i++]] ?></td>
                    </tr>
                  <?php } ?>
                </table>
              </td>
            </tr>
          </table>
        </td>

        <td align="left" valign="top" style="height: 1.6in;">
          <table width="100%" border="0" class="table-list1" style="width: 2.3in;">
            <tr>
              <td colspan="3">
                <table>
                  <?php while ($ii < 10) { ?>
                    <tr>
                      <td><?= $singkatan[$r[$ii++]] ?></td>
                    </tr>
                  <?php } ?>
                </table>
              </td>
              <td colspan="3">
                <table>
                  <?php while ($ii < 20) { ?>
                    <tr>
                      <td><?= $singkatan[$r[$ii++]] ?></td>
                    </tr>
                  <?php } ?>
                </table>
              </td>
            </tr>
          </table>
        </td>

        <td align="left" valign="top" style="height: 1.6in;">
          <table width="100%" border="0" class="table-list1" style="width: 2.3in;">
            <tr>
              <td colspan="3">
                <table>
                  <?php while ($iii < 10) { ?>
                    <tr>
                      <td><?= $singkatan[$r[$iii++]] ?></td>
                    </tr>
                  <?php } ?>
                </table>
              </td>
              <td colspan="3">
                <table>
                  <?php while ($iii < 20) { ?>
                    <tr>
                      <td><?= $singkatan[$r[$iii++]] ?></td>
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