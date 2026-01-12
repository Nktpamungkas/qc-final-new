<?PHP
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
?>

<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script>
</script>
<head>
  <title>Summary Buyer</title>
</head>

<body>
  <?php
  $data_kiri = [];
  $data_kanan = [];
  $query_mysql_kiri = "SELECT
    nodemand,
    id,
    nokk,
    rol,
    bruto,
    proses
  FROM
    tbl_schedule
  WHERE
    NOT STATUS = 'selesai'
    AND NOT proses ='Perbaikan'";
  $prepare_mysql_kiri = mysqli_query($con, $query_mysql_kiri);
  while($data_mysql_kiri = mysqli_fetch_array($prepare_mysql_kiri)){
    $data_kiri[] = $data_mysql_kiri;
  }

  $data_hanger_kiri = [];
  $sum_hanger = [];
  foreach($data_kiri as $key => $value){
    $query_db2 = "SELECT
                    p.SUBCODE02,
                    p.SUBCODE03,
                    p.SUBCODE04,
                    TRIM(p.SUBCODE02) || TRIM(p.SUBCODE03) AS HANGER
                  FROM
                    PRODUCTIONDEMAND p
                  WHERE
                    p.CODE = '$value[nodemand]'";
    $stmt_db2 = db2_exec($conn1, $query_db2);
    while($data_db2 = db2_fetch_assoc($stmt_db2)){
      // $data[] = $data_db2['HANGER'];
      $data_hanger_kiri[$data_db2['HANGER']] += $value['bruto'];
    }
  }
  arsort($data_hanger_kiri);
      $top5 = array_slice($data_hanger_kiri, 0, 5, true);
      $sisa = array_slice($data_hanger_kiri, 5, null, true);
      $top5['DLL'] = array_sum($sisa);
      $hcData = [];
      foreach ($top5 as $item => $qty) {
          $hcData[] = [$item, (float)$qty];
      }
  $query_mysql_kanan = "SELECT
    nodemand,
    id,
    nokk,
    rol,
    bruto,
    proses
  FROM
    tbl_schedule
  WHERE
    NOT STATUS = 'selesai'
    AND proses ='Perbaikan'";
  $prepare_mysql_kanan = mysqli_query($con, $query_mysql_kanan);
  while($data_mysql_kanan = mysqli_fetch_array($prepare_mysql_kanan)){
    $data_kanan[] = $data_mysql_kanan;
  }

  $data_hanger_kanan = [];
  $sum_hanger = [];
  foreach($data_kanan as $key => $value){
    $query_db2 = "SELECT
                    p.SUBCODE02,
                    p.SUBCODE03,
                    p.SUBCODE04,
                    TRIM(p.SUBCODE02) || TRIM(p.SUBCODE03) AS HANGER
                  FROM
                    PRODUCTIONDEMAND p
                  WHERE
                    p.CODE = '$value[nodemand]'";
    $stmt_db2 = db2_exec($conn1, $query_db2);
    while($data_db2 = db2_fetch_assoc($stmt_db2)){
      // $data[] = $data_db2['HANGER'];
      $data_hanger_kanan[$data_db2['HANGER']] += $value['bruto'];
    }
  }
  arsort($data_hanger_kanan);
      $top5_kanan = array_slice($data_hanger_kanan, 0, 5, true);
      $sisa_kanan = array_slice($data_hanger_kanan, 5, null, true);
      $top5_kanan['DLL'] = array_sum($sisa_kanan);
      $hcData_kanan = [];
      foreach ($top5_kanan as $item => $qty) {
          $hcData_kanan[] = [$item, (float)$qty];
      }
  // print_r($top5);
  
  $no = 1;
  $n = 1;
  $c = 0;
  $tglNow = date("Ymd");
  ?>
  <div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">

      <div class="box-header with-border">
        <h3 class="box-title">Summary Item</h3>
      </div>

      <div class="box-body">
        <a href="Schedule" class="btn btn-success btn-sm">
          <i class="fa fa-arrow-left"></i> Kembali
        </a>
        <hr>

        <!-- TABLES -->
        <div class="row">
          <!-- TABLE KIRI -->
          <div class="col-md-6">
            <h4>Summary Tanpa Perbaikan</h4>
            <table class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  <th width="40">No</th>
                  <th>Item</th>
                  <th class="text-right">Qty</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1; 
                $total = 0;
                foreach ($top5 as $item => $qty): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $item ?></td>
                  <td class="text-right"><?= number_format($qty,2) ?></td>
                </tr>
                <?php $total += $qty; endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="2">TOTAL</th>
                  <th class="text-right"><?= number_format($total,2) ?></th>
                </tr>
              </tfoot>
            </table>
          </div>

          <!-- TABLE KANAN -->
          <div class="col-md-6">
            <h4>Summary Perbaikan</h4>
            <table class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  <th width="40">No</th>
                  <th>Item</th>
                  <th class="text-right">Qty</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1; 
                $total = 0;
                foreach ($top5_kanan as $item => $qty): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $item ?></td>
                  <td class="text-right"><?= number_format($qty,2) ?></td>
                </tr>
                <?php $total += $qty; endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="2">TOTAL</th>
                  <th class="text-right"><?= number_format($total,2) ?></th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>

        <!-- GRAFIK -->
        <div class="row">
          <div class="col-md-6">
            <div id="chartLeft2" style="height:400px"></div>
          </div>
          <div class="col-md-6">
            <div id="chartRight" style="height:400px"></div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
</body>

</html>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
  console.log(<?= json_encode($top5) ?>);
Highcharts.chart('chartLeft2', {
    chart: {
        type: 'column'
    },

    title: {
        text: 'TOP 5 Summary Per Item Tanpa Perbaikan'
    },

    xAxis: {
        type: 'category',
        labels: {
            autoRotation: [-45, -90],
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },

    yAxis: {
        min: 0,
        title: {
            text: 'Qty (KG)'
        }
    },

    legend: {
        enabled: false
    },

    tooltip: {
        pointFormat: '<b>{point.y:,.2f} KG</b>'
    },

    series: [{
        name: 'QTY',
        colors: [
            '#3667c9', '#2f72c3', '#277dbd', '#1f88b7', '#1693b1', '#0a9eaa'
        ],
        colorByPoint: true,
        groupPadding: 0,
        data: <?= json_encode($hcData) ?>,
        dataLabels: {
            enabled: true,
            rotation: 0,
            inside: true,
            format: '{point.y:,.2f}',
            style: {
                fontSize: '11px',
                fontWeight: 'bold',
                color: '#FFFFFF'
            }
        }
    }]
});
</script>
<script src="dist/js/highchart/highcharts.js"></script>
<script src="dist/js/highchart/exporting.js"></script>
<script src="dist/js/highchart/export-data.js"></script>
<script src="dist/js/highchart/accessibility.js"></script>
<script>
  
  // console.log(<?= json_encode($top5) ?>);
Highcharts.chart('chartRight', {
    chart: {
        type: 'column'
    },

    title: {
        text: 'TOP 5 Summary Per Item Perbaikan'
    },

    xAxis: {
        type: 'category',
        labels: {
            autoRotation: [-45, -90],
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },

    yAxis: {
        min: 0,
        title: {
            text: 'Qty (KG)'
        }
    },

    legend: {
        enabled: false
    },

    tooltip: {
        pointFormat: '<b>{point.y:,.2f} KG</b>'
    },

    series: [{
        name: 'QTY',
        colors: [
            '#3667c9', '#2f72c3', '#277dbd', '#1f88b7', '#1693b1', '#0a9eaa'
        ],
        colorByPoint: true,
        groupPadding: 0,
        data: <?= json_encode($hcData_kanan) ?>,
        dataLabels: {
            enabled: true,
            rotation: 0,
            inside: true,
            format: '{point.y:,.2f}',
            style: {
                fontSize: '11px',
                fontWeight: 'bold',
                color: '#FFFFFF'
            }
        }
    }]
});
</script>
