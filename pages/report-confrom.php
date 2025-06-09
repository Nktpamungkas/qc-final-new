<?PHP
ini_set("error_reporting", 1);
session_start();
include "koneksi.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Filter Conform</title>
</head>

<body>
  <?php
  $Awal  = isset($_POST['awal']) ? $_POST['awal'] : '';
  $Akhir  = isset($_POST['akhir']) ? $_POST['akhir'] : '';
  $Demand  = isset($_POST['demand']) ? $_POST['demand'] : '';
  $Lot  = isset($_POST['lot']) ? $_POST['lot'] : '';
  $Order  = isset($_POST['no_order']) ? $_POST['no_order'] : '';
  $Langganan  = isset($_POST['langganan']) ? $_POST['langganan'] : '';
  $PO  = isset($_POST['po']) ? $_POST['po'] : '';
  $ArticleGrup  = isset($_POST['ag']) ? $_POST['ag'] : '';
  $ArticleCode  = isset($_POST['ac']) ? $_POST['ac'] : '';
  $Warna  = isset($_POST['warna']) ? $_POST['warna'] : '';
  ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"> Filter conform NOW</h3>
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
              <input name="awal" type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Awal" value="<?php echo $Awal; ?>" autocomplete="off" />
            </div>
          </div>
          <!-- /.input group -->
        </div>
        <div class="form-group">
          <div class="col-sm-2">
            <div class="input-group date">
              <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
              <input name="akhir" type="text" class="form-control pull-right" id="datepicker1" placeholder="Tanggal Akhir" value="<?php echo $Akhir;  ?>" autocomplete="off" />
            </div>
          </div>
          <!-- /.input group -->
        </div>
        <div class="form-group">
          <div class="col-sm-2">
            <input name="demand" type="text" class="form-control pull-right" id="demand" placeholder="No Demand" value="<?php echo $Demand;  ?>" />
          </div>
          <div class="col-sm-2">
            <input name="lot" type="text" class="form-control pull-right" id="lot" placeholder="No Lot" value="<?php echo $Lot;  ?>" />
          </div>
          <div class="col-sm-2">
            <input name="langganan" type="text" class="form-control pull-right" id="langganan" placeholder="Langganan" value="<?php echo $Langganan;  ?>" />
          </div>
          <div class="col-sm-2">
            <input name="po" type="text" class="form-control pull-right" id="po" placeholder="No PO" value="<?php echo $PO;  ?>" />
          </div>
          <div class="col-sm-2">
            <input name="no_order" type="text" class="form-control pull-right" id="no_order" placeholder="No Order" value="<?php echo $Order;  ?>" />
          </div>
          <!-- /.input group -->
        </div>
        <div class="form-group">
          <div class="col-sm-2">
            <input name="ag" type="text" class="form-control pull-right" id="ag" placeholder="Article Group" value="<?php echo $ArticleGrup;  ?>" />
          </div>
          <div class="col-sm-2">
            <input name="ac" type="text" class="form-control pull-right" id="ac" placeholder="Article Code" value="<?php echo $ArticleCode;  ?>" />
          </div>
          <div class="col-sm-2">
            <input name="warna" type="text" class="form-control pull-right" id="warna" placeholder="Warna" value="<?php echo $Warna;  ?>" />
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="col-sm-2">
          <button type="submit" class="btn btn-block btn-social btn-linkedin btn-sm" name="save" style="width: 60%">Search <i class="fa fa-search"></i></button>
        </div>
      </div>
      <!-- /.box-footer -->
    </form>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data conform </h3><br>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-hover table-striped nowrap" id="example3" style="width:100%">
            <thead class="bg-blue">
              <tr>
              </tr>
              <th rowspan="1">
                <div align="center">No</div>
              </th>
              <th rowspan="1">
                <div align="center">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Aksi
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
              </th>
                <th rowspan="1">
                  <div align="center">No Demand</div>
                </th>
                <th rowspan="1">
                  <div align="center">No Production Order</div>
                </th>
                <th rowspan="1">
                  <div align="center">Langganan</div>
                </th>
                <th rowspan="1">
                  <div align="center">Buyer</div>
                </th>
                <th rowspan="1">
                  <div align="center">No PO</div>
                </th>
                <th rowspan="1">
                  <div align="center">No Order</div>
                </th>
                <th rowspan="1">
                  <div align="center">No Item</div>
                </th>
                <th rowspan="1">
                  <div align="center">Article Group</div>
                </th>
                <th rowspan="1">
                  <div align="center">Article Code</div>
                </th>
                <th rowspan="1">
                  <div align="center">Jenis Kain</div>
                </th>
                <th rowspan="1">
                  <div align="center">Lebar</div>
                </th>
                <th rowspan="1">
                  <div align="center">Gramasi</div>
                </th>
                <th rowspan="1">
                  <div align="center">Warna</div>
                </th>
                <th rowspan="1">
                  <div align="center">Masalah</div>
                </th>
                <th>
                  <div align="center">Pejabat QC 1</div>
                </th>
                <th>
                  <div align="center">Pejabat QC 2</div>
                </th>
                <th>
                  <div align="center">Pejabat QC 3</div>
                </th>
                <th rowspan="1">
                  <div align="center">Produksi</div>
                </th>
                <th rowspan="1">
                  <div align="center">Marketing</div>
                </th>
                <th rowspan="1">
                  <div align="center">Tgl Conform</div>
                </th>
                <th rowspan="1">
                  <div align="center">Tgl MKT Terima</div>
                </th>
                <th rowspan="1">
                  <div align="center">Tgl Feedback</div>
                </th>
                <th rowspan="1">
                  <div align="center">Keputusan</div>
                </th>
                <th rowspan="1">
                  <div align="center">Foto Confrom</div>
                </th>
                <th rowspan="1">
                  <div align="center">Foto Feedback</div>
                </th>
                <th rowspan="1">
                  <div align="center">Inspect Report
                  </div>
                </th>
                <th rowspan="1">
                  <div align="center">lot</div>
                </th>

              </tr>

            </thead>
            <tbody>
              <?php
              $no = 1;

              if ($Awal != '' || $Demand != '' || $Lot != '' || $Order != '' || $Langganan != '' || $PO != '' || $ArticleGrup != '' || $ArticleCode != '' || $Warna != '') {
                $Where = " AND 1=1 ";
                if ($Awal != '') {
                  $Where .= " AND DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' ";
                }
                if ($Demand != '') {
                  $Where .= " AND no_demand LIKE '%$Demand%' ";
                }
                if ($Lot != '') {
                  $Where .= " AND lot LIKE '%$Lot%' ";
                }
                if ($Order != '') {
                  $Where .= " AND prod_order LIKE '%$Order%' ";
                }
                if ($Langganan != '') {
                  $Where .= " AND langganan LIKE '%$Langganan%' ";
                }
                if ($PO != '') {
                  $Where .= " AND no_po LIKE '%$PO%' ";
                }
                if ($ArticleGrup != '') {
                  $Where .= " AND article_group LIKE '%$ArticleGrup%' ";
                }
                if ($ArticleCode != '') {
                  $Where .= " AND article_code LIKE '%$ArticleCode%' ";
                }
                if ($Warna != '') {
                  $Where .= " AND warna LIKE '%$Warna%' ";
                }

                $sql = "SELECT * FROM tbl_conform_qc WHERE 1=1 $Where ORDER BY no_demand ASC";
              } else {
                $sql = "SELECT * FROM tbl_conform_qc WHERE 1=0";
              }
              $sqlData1 = mysqli_query($con, $sql);
              while ($row1 = mysqli_fetch_array($sqlData1)) {
                $noorder = str_replace("/", "&", $row1['no_order']);
              ?>
                <tr bgcolor="<?php echo $bgcolor; ?>">
                  <td align="center"><?php echo $no; ?></td>
                  <td align="center">
                    <div class="btn-group">
                      <a href="Editconform-<?php echo $row1['id']; ?>" class="btn btn-warning btn-xs" target="_blank"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit Data"></i> </a>
                      <a href="#" class="btn btn-danger btn-xs" onclick="confirm_delete('./HapusDataConform-<?php echo $row1['id'] ?>');"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Hapus"></i> </a>
                    </div>
                  </td>
                  <td align="center"><?php echo $row1['no_demand']; ?></td>
                  <td align="center"><?php echo $row1['prod_order']; ?></td>
                  <td align="center"><?php echo $row1['langganan']; ?></td>
                  <td align="center"><?php echo $row1['buyer']; ?></td>
                  <td align="center"><?php echo $row1['no_po']; ?></td>
                  <td align="center"><?php echo $row1['no_order']; ?></td>
                  <td align="center"><?php echo $row1['no_item']; ?></td>
                  <td align="center"><?php echo $row1['article_group']; ?></td>
                  <td align="center"><?php echo $row1['article_code']; ?></td>
                  <td align="left"><b title="<?php echo htmlentities($row1['jenis_kain'], ENT_QUOTES); ?>"><?php echo htmlentities(substr($row1['jenis_kain'], 0, 40), ENT_QUOTES); ?></b></td>
                  <td align="center"><?php echo $row1['lebar']; ?></td>
                  <td align="center"><?php echo $row1['gramasi']; ?></td>
                  <td align="center"><?php echo $row1['warna']; ?></td>
                  <td align="center"><?php echo $row1['masalah']; ?></td>
                  <!-- <td align="center"><?php echo $row1['qty_kg']; ?></td>
                  <td align="center"><?php echo $row1['qty_yard']; ?></td> -->
                  <td align="center"><?php echo $row1['pejabat1']; ?></td>
                  <td align="center"><?php echo $row1['pejabat2']; ?></td>
                  <td align="center"><?php echo $row1['pejabat3']; ?></td>
                  <td align="center"><?php echo $row1['produksi']; ?></td>
                  <td align="center"><?php echo $row1['marketing']; ?></td>
                  <td align="center"><?php echo ($row1['tgl_conform']); ?></td>
                  <td align="center"><?php echo $row1['tgl_mkt_terima']; ?></td>
                  <td align="center"><?php echo $row1['tgl_feedback']; ?></td>
                  <td align="center"><?php echo $row1['keputusan']; ?></td>
                  <td align="center"><a href="#" class="gambarconform" id="<?php echo $row1['file_foto']; ?>"><?php echo $row1['file_foto']; ?></a></td>
                  <!-- <td align="center"><a href="#" class="btn btn-danger btn-xs <?php if ($_SESSION['akses'] == 'biasa' or $row1['file_foto'] == NULL or $row1['file_foto'] == "") {
                                                                                      echo "disabled";
                                                                                    } ?>" onclick="confirm_delete1('./HapusDataFoto1-<?php echo $row1['id'] ?>-<?php echo $row1['file_foto'] ?>');"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Hapus File Foto 1"></i></a></td> -->
                  <td align="center"><a href="#" class="gambarconform2" id="<?php echo $row1['file_foto2']; ?>"><?php echo $row1['file_foto2']; ?></a></td>
                  <!-- <td align="center"><a href="#" class="btn btn-danger btn-xs <?php if ($_SESSION['akses'] == 'biasa' or $row1['file_foto2'] == NULL or $row1['file_foto2'] == "") {
                                                                                      echo "disabled";
                                                                                    } ?>" onclick="confirm_delete2('./HapusDataFoto2-<?php echo $row1['id'] ?>-<?php echo $row1['file_foto2'] ?>');"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Hapus File Foto 2"></i></a></td> -->
                  <!-- <td align="center"><?php echo $row1['ext_ref']; ?></td>
                  <td align="center"><?php echo $row1['int_ref']; ?></td> -->
                  <td align="center"><a href="#" class="gambarconform3" id="<?php echo $row1['file_foto3']; ?>"><?php echo $row1['file_foto3']; ?></a></td>
                  <td align="center"><?php echo $row1['lot']; ?></td>
                </tr>
              <?php $no++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modal_del1" tabindex="-1">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="margin-top:100px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" style="text-align:center;">Are you sure to delete foto 1?</h4>
        </div>

        <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
          <a href="#" class="btn btn-danger" id="delete_link1">Delete</a>
          <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modal_del2" tabindex="-1">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="margin-top:100px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" style="text-align:center;">Are you sure to delete foto 2?</h4>
        </div>

        <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
          <a href="#" class="btn btn-danger" id="delete_link2">Delete</a>
          <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modal_del" tabindex="-1">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="margin-top:100px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" style="text-align:center;">Are you sure to delete all data ?</h4>
        </div>

        <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
          <a href="#" class="btn btn-danger" id="delete_link">Delete</a>
          <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <div id="StsGKEdit" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
  <div id="PicDisp" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
  <div id="PicDisp2" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
  <script type="text/javascript">
    function confirm_delete1(delete_url1) {
      $('#modal_del1').modal('show', {
        backdrop: 'static'
      });
      document.getElementById('delete_link1').setAttribute('href', delete_url1);
    }

    function confirm_delete2(delete_url2) {
      $('#modal_del2').modal('show', {
        backdrop: 'static'
      });
      document.getElementById('delete_link2').setAttribute('href', delete_url2);
    }

    function confirm_delete(delete_url) {
      $('#modal_del').modal('show', {
        backdrop: 'static'
      });
      document.getElementById('delete_link').setAttribute('href', delete_url);
    }
  </script>
  <script>
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>
</body>

</html>