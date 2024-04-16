<?PHP
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";

?>

<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Laporan Return</title>

</head>

<body>
  <?php

  $Awal = isset($_POST['awal']) ? $_POST['awal'] : '';
  $Akhir = isset($_POST['akhir']) ? $_POST['akhir'] : '';
  $Order = isset($_POST['order']) ? $_POST['order'] : '';
  $ProdOrder = isset($_POST['prod_order']) ? $_POST['prod_order'] : '';
  $Hanger = isset($_POST['hanger']) ? $_POST['hanger'] : '';
  $Langganan = isset($_POST['langganan']) ? $_POST['langganan'] : '';

  ?>

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"> Filter Laporan TPUKPE</h3>
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
          <div class="col-sm-2">
            <div class="input-group date">
              <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
              <input name="akhir" type="text" class="form-control pull-right" id="datepicker1"
                placeholder="Tanggal Akhir" value="<?php echo $Akhir; ?>" autocomplete="off" />
            </div>
          </div>
          <div class="col-sm-2">
            <input name="prod_order" type="text" class="form-control pull-right" id="prod_order" placeholder="Prod Order"
              value="<?php echo $ProdOrder; ?>" autocomplete="off" />
          </div>
          <div class="col-sm-2">
            <input name="hanger" type="text" class="form-control pull-right" id="hanger" placeholder="No Hanger"
              value="<?php echo $Hanger; ?>" autocomplete="off" />
          </div>
          <div class="col-sm-2">
            <input name="langganan" type="text" class="form-control pull-right" id="langganan" placeholder="Langganan"
              value="<?php echo $Langganan; ?>" autocomplete="off" />
          </div>
          <!-- /.input group -->
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="col-sm-2">
          <button type="submit" class="btn btn-block btn-social btn-linkedin btn-sm" name="submit"
            style="width: 60%">Search <i class="fa fa-search"></i></button>
        </div>
      </div>
      <!-- /.box-footer -->
    </form>
  </div>

  <div class="row">

    <div class="col-xs-12">

      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">DETAIL TPUKPE</h3><br>
          <?php if ($Awal != "") { ?><b>Periode:
              <?php echo $Awal . " to " . $Akhir; ?>
            </b>
          <?php } ?>
        </div>

        <div class="box-body">
          <table class="table table-bordered table-hover table-striped" id="example2" style="width:100%">
            <thead class="bg-blue">
              <tr>
                <th rowspan="2">
                  <div align="center">NO TPUKPE</div>
                </th>
                <th rowspan="2">
                  <div align="center">PROD ORDER</div>
                </th>
                <th rowspan="2">
                  <div align="center">DEMAND</div>
                </th>
                <th rowspan="2">
                  <div align="center">LANGGANAN</div>
                </th>
                <th rowspan="2">
                  <div align="center">HANGER</div>
                </th>
                <th rowspan="2">
                  <div align="center">WARNA</div>
                </th>
                <th rowspan="2">
                  <div align="center">MASALAH DOMINAN</div>
                </th>
                <th rowspan="2">
                  <div align="center">MASALAH</div>
                </th>
                <th rowspan="2">
                  <div align="center">TANGGUNG JAWAB</div>
                </th>
                <th colspan="2">
                  <div align="center">QTY CLAIM</div>
                </th>
              </tr>
              <tr>
                <th>
                  <div align="center">KG</div>
                </th>
                <th>
                  <div align="center">YDS</div>
                </th>
              </tr>
            </thead>
            <tbody>
            <?php
              if ($Awal != "") {
                $Where = " AND DATE_FORMAT( a.tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' ";
              }
              if ($Awal != "" or $Hanger != "" or $ProdOrder != "" or $Langganan != "") {
                $qry1 = mysqli_query($con, "select
                                              a.id,
                                              a.no_tpukpe,
                                              a.no_po,
                                              b.nodemand,
                                              a.langganan,
                                              b.no_hanger,
                                              a.warna,
                                              a.masalah_dominan,
                                              a.masalah,
                                              a.t_jawab,
                                              a.t_jawab1,
                                              a.t_jawab2,
                                              a.qty,
                                              a.qty2,
                                              b.qty_claim,
                                              b.satuan_c,
                                              b.qty_claim2,
                                              b.satuan_c2,
                                              b.nokk
                                            FROM tbl_tpukpe_now a
                                            left join tbl_aftersales_now b
                                            on a.id_nsp = b.id
                                            WHERE b.nokk LIKE '%$ProdOrder%' 
                                              AND b.no_hanger LIKE '%$Hanger%' 
                                              AND a.langganan LIKE '%$Langganan%' $Where ORDER BY a.id ASC");
              
              while ($row1 = mysqli_fetch_array($qry1)) {
                ?>

                <tr>
                  <td align="center">
                    <?= ''//$row1['no_tpukpe'] ?>
                    <a href="#" class="edit_tpukpe" id="<?php echo $row1['id'] ?>"><?php echo $row1['no_tpukpe']; ?></a>
                  </td>
                  <td align="center">
                    <?= $row1['nokk'] ?>
                  </td>
                  <td align="center">
                    <?= $row1['nodemand'] ?>
                  </td>
                  <td align="center">
                    <?= $row1['langganan'] ?>
                  </td>
                  <td align="center">
                    <?= $row1['no_hanger'] ?>
                  </td>
                  <td align="center">
                    <?= $row1['warna'] ?>
                  </td>
                  <td align="center">
                    <?= $row1['masalah_dominan'] ?>
                  </td>
                  <td align="center">
                    <?= $row1['masalah'] ?>
                  </td>
                  <td align="center">
                    <?php 
                      if($row1['t_jawab2'] != "") {
                        echo $row1['t_jawab2'];
                      } else if($row1['t_jawab1'] != "") {
                        echo $row1['t_jawab1'];
                      } else {
                        echo $row1['t_jawab'];
                      }
                    ?>
                  </td>
                  <td align="center">
                    <?php
                    if($row1['qty'] != "") {
                      echo $row1['qty'];
                    } else {
                      echo strtoupper($row1['satuan_c']) == 'KG' ? $row1['qty_claim'] : '';
                    }
                    ?>
                  </td>
                  <td align="center">
                    <?php
                    if($row1['qty2'] != "") {
                      echo $row1['qty2'];
                    } else {
                      echo strtoupper($row1['satuan_c2']) == 'YD' ? $row1['qty_claim2'] : '';
                    }
                    ?>
                  </td>
                </tr>
        <?php 
              } 
            }
        ?>
            </tbody>
            
          </table>
          <div id="EditTPUKPE" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
        </div>

      </div>

    </div>

  </div>
</body>

</html>