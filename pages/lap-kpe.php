   <?PHP
ini_set("error_reporting", 1);
session_start();
include"koneksi.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Harian Produksi</title>

</head>
<body>
<?php
$Awal	= isset($_POST['awal']) ? $_POST['awal'] : '';
$Akhir	= isset($_POST['akhir']) ? $_POST['akhir'] : '';
$Order	= isset($_POST['order']) ? $_POST['order'] : '';
$Hanger	= isset($_POST['hanger']) ? $_POST['hanger'] : '';
$PO	= isset($_POST['po']) ? $_POST['po'] : '';	
$GShift	= isset($_POST['gshift']) ? $_POST['gshift'] : '';	
$Fs		= isset($_POST['fasilitas']) ? $_POST['fasilitas'] : '';
$sts_red = isset($_POST['sts_red']) ? $_POST['sts_red'] : '';
$sts_claim = isset($_POST['sts_claim']) ? $_POST['sts_claim'] : '';
$Langganan	= isset($_POST['langganan']) ? $_POST['langganan'] : '';
$Demand	= isset($_POST['demand']) ? $_POST['demand'] : '';
$Prodorder	= isset($_POST['prodorder']) ? $_POST['prodorder'] : '';
$Pejabat	= isset($_POST['pejabat']) ? $_POST['pejabat'] : '';
$Solusi	= isset($_POST['solusi']) ? $_POST['solusi'] : '';
	
if($_POST['gshift']=="ALL"){$shft=" ";}else{$shft=" AND b.g_shift = '$GShift' ";}	
?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"> Filter Laporan KPE asdasdsa </h3>
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
            <input name="awal" type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Awal" value="<?php echo $Awal; ?>" autocomplete="off"/>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="input-group date">
            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
            <input name="akhir" type="text" class="form-control pull-right" id="datepicker1" placeholder="Tanggal Akhir" value="<?php echo $Akhir;  ?>" autocomplete="off"/>
          </div>
        </div>
        <div class="col-sm-2">
            <input name="order" type="text" class="form-control pull-right" id="order" placeholder="No Order" value="<?php echo $Order;  ?>" />
          </div>
        <div class="col-sm-2">
            <input name="po" type="text" class="form-control pull-right" id="po" placeholder="No PO" value="<?php echo $PO;  ?>" />
          </div>
        <div class="col-sm-2">
            <input name="hanger" type="text" class="form-control pull-right" id="hanger" placeholder="No Hanger" value="<?php echo $Hanger;  ?>" />
          </div>
        <div class="col-sm-2">
            <input name="langganan" type="text" class="form-control pull-right" id="langganan" placeholder="Langganan/Buyer" value="<?php echo $Langganan;  ?>" />
          </div>
        <!-- /.input group -->
      </div>
      <div class="form-group">
        <div class="col-sm-2">
          <input name="demand" type="text" class="form-control pull-right" id="demand" placeholder="No Demand" value="<?php echo $Demand;  ?>" />
        </div>
        <div class="col-sm-2">
          <input name="prodorder" type="text" class="form-control pull-right" id="prodorder" placeholder="Prod. Order" value="<?php echo $Prodorder;  ?>" />
        </div>
        <div class="col-sm-3">
            <select class="form-control select2" name="pejabat" id="pejabat">
              <option value="">Pilih Pejabat</option>
                <?php 
                  $qryp=mysqli_query($con,"SELECT nama FROM tbl_personil_aftersales WHERE jenis='pejabat' ORDER BY nama ASC");
                  while($rp=mysqli_fetch_array($qryp)){
                ?>
              <option value="<?php echo $rp['nama'];?>" <?php if($Pejabat==$rp['nama']){echo "SELECTED";}?>><?php echo $rp['nama'];?></option>	
                <?php }?>
            </select>
        </div>
        <div class="col-sm-3">
        <select class="form-control select2" name="solusi" id="solusi">
							<option value="">Solusi</option>
							<?php 
							$qryp=mysqli_query($con,"SELECT solusi FROM tbl_solusi ORDER BY solusi ASC");
							while($rp=mysqli_fetch_array($qryp)){
							?>
							<option value="<?php echo $rp['solusi'];?>" <?php if($Solusi==$rp['solusi']){echo "SELECTED";}?>><?php echo $rp['solusi'];?></option>	
							<?php }?>
						</select>
        </div>
      </div>
    <div class="form-group">
		  <label for="status_red" class="col-sm-0 control-label"></label>		  
        <div class="col-sm-3">
        <input type="checkbox" name="sts_red" id="sts_red" value="1" <?php  if($sts_red=="1"){ echo "checked";} ?>>  
        <label> Red Category Email</label>
          
        </div>		  	
		  </div>
      <div class="form-group">
		  <label for="status_claim" class="col-sm-0 control-label"></label>		  
        <div class="col-sm-3">
        <input type="checkbox" name="sts_claim" id="sts_claim" value="1" <?php  if($sts_claim=="1"){ echo "checked";} ?>>  
        <label> Claim</label>
          
        </div>		  	
		  </div>
    <!-- /.input group -->	
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
        <h3 class="box-title">Data KPE</h3><br>
        <?php if($_POST['awal']!="") { ?><b>Periode: <?php echo $_POST['awal']." to ".$_POST['akhir']; ?></b>
          <?php } ?>
          <div class="pull-right">

          <?php if($_POST['solusi'] == 'PERBAIKAN GARMENT'){ ?>
            <a href="pages/cetak/cetak_perbaikan_garment.php" class="btn btn-primary" target="_blank">Cetak Perbaikan Garment</a>
          <?php }elseif($_POST['solusi'] == 'DEBIT NOTE') {?>
            <a href="pages/cetak/cetak_debit_note.php" class="btn btn-success" target="_blank">Cetak Debit Note</a>
            <?php }?>
            
            <a href="pages/cetak/cetak_kpe.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&order=<?php echo $_POST['order']; ?>&po=<?php echo $_POST['po']; ?>&hanger=<?php echo $_POST['hanger']; ?>&langganan=<?php echo $_POST['langganan']; ?>&demand=<?php echo $_POST['demand']; ?>&prodorder=<?php echo $_POST['prodorder']; ?>&pejabat=<?php echo $_POST['pejabat']; ?>" class="btn btn-danger <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Cetak KPE</a>
			 
			 
			<a href="pages/cetak/cetak_kpe_disposisi.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&order=<?php echo $_POST['order']; ?>&po=<?php echo $_POST['po']; ?>&hanger=<?php echo $_POST['hanger']; ?>&langganan=<?php echo $_POST['langganan']; ?>&demand=<?php echo $_POST['demand']; ?>&prodorder=<?php echo $_POST['prodorder']; ?>&pejabat=<?php echo $_POST['pejabat']; ?>" class="btn btn-danger <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Cetak KPE Disposisi</a> 
            <a href="pages/cetak/excel_kpe_disposisi.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&order=<?php echo $_POST['order']; ?>&po=<?php echo $_POST['po']; ?>&hanger=<?php echo $_POST['hanger']; ?>&langganan=<?php echo $_POST['langganan']; ?>&demand=<?php echo $_POST['demand']; ?>&prodorder=<?php echo $_POST['prodorder']; ?>&pejabat=<?php echo $_POST['pejabat']; ?>" class="btn btn-success <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Excel KPE Disposisi</a> 
          </div>
        <?php if($sts_red=='1'){?>
              <div class="pull-right">
                <a href="pages/cetak/cetak_redemail.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>" class="btn btn-primary <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Cetak Red Email</a>
                </div>
            <?php } ?>
        <?php if($sts_claim=='1'){?>
              <div class="pull-right">
              <a href="pages/cetak/cetak_claim.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>" class="btn btn-primary <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Cetak Claim</a>
                </div>
            <?php } ?>
	    </div>
      <div class="box-body">
        <table class="table table-bordered table-hover table-striped nowrap" id="example3" style="width:100%">
          <thead class="bg-blue">
            <tr>
              <th><div align="center">No</div></th>
              <th><div align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Aksi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></th>
              <th><div align="center">Tgl</div></th>
              <th><div align="center">Langganan</div></th>
              <th><div align="center">No Demand</div></th>
              <th><div align="center">No Prod Order</div></th>
              <th><div align="center">PO</div></th>
              <!-- <th><div align="center">NO ITEM</div></th> -->
              <th><div align="center">Order</div></th>
              <th><div align="center">Hanger</div></th>
              <th><div align="center">Jenis Kain</div></th>
              <th><div align="center">Lebar &amp; Gramasi</div></th>
              <th><div align="center">Lot</div></th>
              <th><div align="center">Warna</div></th>
              <th><div align="center">Qty Order</div></th>
              <th><div align="center">Qty Kirim</div></th>
              <th><div align="center">Qty Claim</div></th>
              <th><div>
                <div align="center">T Jawab</div>
              </div></th>
              <th><div align="center">Masalah Dominan</div></th>
              <th><div align="center">Masalah</div></th>
              <th><div align="center">Penyebab</div></th>
              <th><div align="center">Solusi</div></th>
              <th><div align="center">Personil</div></th>
              <th><div align="center">Pejabat</div></th>
              <th><div align="center">Lolos/Disposisi</div></th>
              <th><div align="center">No NCP</div></th>
              <th><div align="center">Analisa Kerusakan</div></th>
              <th><div align="center">Ket</div></th>
            </tr>
          </thead>
          <tbody>
          <?php
            $no=1;
            if($sts_red=="1"){ $stsred =" AND a.sts_red='1' "; }else{$stsred = " ";}
            if($sts_claim=="1"){ $stsclaim =" AND a.sts_claim='1' "; }else{$stsclaim =" ";}
            if($Awal!=""){ $Where =" AND DATE_FORMAT( a.tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' "; }
            if($Awal!="" or $sts_red=="1" or $sts_claim=="1" or $Order!="" or $Hanger!="" or $PO!="" or $Langganan!="" or $Demand!="" or $Prodorder!="" or $Pejabat!="" or $Solusi!=""){
              $qry1=mysqli_query($con,"SELECT a.*,
              GROUP_CONCAT( DISTINCT b.no_ncp SEPARATOR ', ' ) AS no_ncp,
              GROUP_CONCAT( DISTINCT b.masalah SEPARATOR ', ' ) AS masalah_ncp 
              FROM tbl_aftersales_now a LEFT JOIN tbl_ncp_qcf_new b ON a.nodemand=b.nodemand 
              WHERE a.no_order LIKE '%$Order%' AND a.po LIKE '%$PO%' AND a.no_hanger LIKE '%$Hanger%' AND a.langganan LIKE '%$Langganan%' AND a.nodemand LIKE '%$Demand%' AND a.nokk LIKE '%$Prodorder%' AND a.pejabat LIKE '%$Pejabat%' AND a.solusi LIKE '%$Solusi%' $Where $stsred $stsclaim 
              GROUP BY a.nodemand
              ORDER BY a.id ASC");
            }else{
              $qry1=mysqli_query($con,"SELECT a.*,
              GROUP_CONCAT( DISTINCT b.no_ncp SEPARATOR ', ' ) AS no_ncp,
              GROUP_CONCAT( DISTINCT b.masalah SEPARATOR ', ' ) AS masalah_ncp 
              FROM tbl_aftersales_now a LEFT JOIN tbl_ncp_qcf_new b ON a.nodemand=b.nodemand 
              WHERE a.no_order LIKE '$Order' AND a.po LIKE '$PO' AND a.no_hanger LIKE '$Hanger' AND a.langganan LIKE '$Langganan' AND a.nodemand LIKE '$Demand' AND a.nokk LIKE '$Prodorder' AND a.pejabat LIKE '$Pejabat'  $Where $stsred $stsclaim 
              GROUP BY a.nodemand
              ORDER BY a.id ASC");
            }
                while($row1=mysqli_fetch_array($qry1)){
                  $noorder=str_replace("/","&",$row1['no_order']);
                  if($row1['t_jawab']!="" and $row1['t_jawab1']!="" and $row1['t_jawab2']!=""){ $tjawab=$row1['t_jawab']."+".$row1['t_jawab1']."+".$row1['t_jawab2'];
                  }else if($row1['t_jawab']!="" and $row1['t_jawab1']!="" and $row1['t_jawab2']==""){
                  $tjawab=$row1['t_jawab']."+".$row1['t_jawab1'];	
                  }else if($row1['t_jawab']!="" and $row1['t_jawab1']=="" and $row1['t_jawab2']!=""){
                  $tjawab=$row1['t_jawab']."+".$row1['t_jawab2'];	
                  }else if($row1['t_jawab']=="" and $row1['t_jawab1']!="" and $row1['t_jawab2']!=""){
                  $tjawab=$row1['t_jawab1']."+".$row1['t_jawab2'];	
                  }else if($row1['t_jawab']!="" and $row1['t_jawab1']=="" and $row1['t_jawab2']==""){
                  $tjawab=$row1['t_jawab'];
                  }else if($row1['t_jawab']=="" and $row1['t_jawab1']!="" and $row1['t_jawab2']==""){
                  $tjawab=$row1['t_jawab1'];
                  }else if($row1['t_jawab']=="" and $row1['t_jawab1']=="" and $row1['t_jawab2']!=""){
                  $tjawab=$row1['t_jawab2'];	
                  }else if($row1['t_jawab']=="" and $row1['t_jawab1']=="" and $row1['t_jawab2']==""){
                  $tjawab="";	
                  }
              ?>
          <tr bgcolor="<?php echo $bgcolor; ?>">
            <td align="center"><?php echo $no; ?>
            </td>
            <td align="center"><div class="btn-group">
            <a href="TambahBon-<?php echo $row1['id']; ?>-<?php echo $noorder; ?>" class="btn btn-warning btn-xs <?php if($_SESSION['akses']=='biasa' OR $_SESSION['lvl_id']!='AFTERSALES'){ echo "disabled"; } ?>" target="_blank"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Ganti Kain"></i> </a>
            <a href="TambahDetailRetur-<?php echo $row1['id']; ?>" class="btn btn-success btn-xs <?php if($_SESSION['akses']=='biasa' OR $_SESSION['lvl_id']!='AFTERSALES'){ echo "disabled"; } ?>" target="_blank"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Retur"></i> </a>
            <a href="TambahTPUKPE-<?php echo $row1['id']; ?>" class="btn btn-primary btn-xs <?php if($_SESSION['akses']=='biasa' OR $_SESSION['lvl_id']!='AFTERSALES'){ echo "disabled"; } ?>" target="_blank"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="TPUKPE"></i> </a>
            <a href="EditKPENew-<?php echo $row1['id']; ?>" class="btn btn-info btn-xs <?php if($_SESSION['akses']=='biasa' OR $_SESSION['lvl_id']!='AFTERSALES'){ echo "disabled"; } ?>" target="_blank"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i> </a>
            <a href="#" class="btn btn-danger btn-xs <?php if($_SESSION['akses']=='biasa' OR $_SESSION['lvl_id']!='AFTERSALES'){ echo "disabled"; } ?>" onclick="confirm_delete('./HapusDataKPE-<?php echo $row1['id'] ?>');"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Hapus"></i> </a>
            </div></td>
            <td align="center"><?php echo $row1['tgl_buat'];?></td>
            <td><?php echo $row1['langganan'];?></td>
            <td align="center"><?php echo $row1['nodemand'];?></td>
            <td align="center"><?php echo $row1['nokk'];?></td>
            <td align="center"><?php echo $row1['po'];?></td>
            <!-- <td align="center"><?php echo $row1['no_item'];?></td> -->
            <td align="center"><?php echo $row1['no_order'];?></td>
            <td align="center" valign="top"><?php echo $row1['no_hanger'];?></td>
            <td><?php echo $row1['jenis_kain'];?></td>
            <td align="center"><?php echo $row1['lebar']."x".$row1['gramasi'];?></td>
            <td align="center"><?php echo $row1['lot'];?></td>
            <td align="center"><?php echo $row1['warna'];?></td>
            <td align="right"><?php echo $row1['qty_order'];?></td>
            <td align="right"><?php echo $row1['qty_kirim'];?></td>
            <td align="right"><?php echo $row1['qty_claim'];?></td>
            <td align="center"><?php echo $tjawab;?></td>
            <td><?php echo $row1['masalah_dominan'];?></td>
            <td><?php echo $row1['masalah'];?></td>
            <td><?php echo $row1['penyebab'];?></td>
            <td>
                 <?php if($row1['solusi'] == "PERBAIKAN GARMENT") { ?>

                  <a href="#" id='<?php echo $row1['no_item']; ?> / <?php echo $row1['no_hanger']; ?>' class="detail_solusi_perbaikan_garment"><?php echo $row1['solusi'];?></a>
                  <a href="#" id='<?php echo $row1['no_item']; ?> / <?php echo $row1['no_hanger']; ?>' class="edit_detail_solusi_perbaikan_garment btn btn-info btn-xs">Edit</a>
                  <!-- <a href="#" id='' class="detail_solusi_perbaikan_garment" data-toggle="modal" data-target="#DataSolusi" data-no_item="<?php echo $row1['no_item']; ?>"><?php echo $row1['solusi'];?></a> -->
                
                <?php }elseif($row1['solusi'] == "DEBIT NOTE"){?>
                  <a href="#" id='<?php echo $row1['no_item']; ?> / <?php echo $row1['no_hanger']; ?>' class="detail_solusi_debit_note"><?php echo $row1['solusi'];?></a>
                  <a href="#" id='<?php echo $row1['no_item']; ?> / <?php echo $row1['no_hanger']; ?>' class="edit_detail_solusi_debit_note btn btn-info btn-xs">Edit</a>
                  
                  <?php }else{?>
                    <?php echo $row1['solusi'];?>
                  <?php }?>
            </td>
            
                  <!-- <td><?php echo $row1['solusi'];?></td> -->
            <td><?php if($row1['personil2']!=""){echo $row1['personil'].",".$row1['personil2'];}else{echo $row1['personil'];}?></td>
            <td><?php echo $row1['pejabat'];?></td>
            <td><?php if($row1['sts']=="1"){echo "Lolos QC";}else if($row1['sts_disposisiqc']=="1"){echo "Disposisi QC";}else if($row1['sts_disposisipro']=="1"){echo "Disposisi Produksi";}?><?php if($row1['sts_nego']=="1"){echo ", Negosiasi Aftersales";}?></td>
            <td><?php echo $row1['no_ncp'];?></td>
            <td><?php echo $row1['masalah_ncp'];?></td>
            <td><?php echo $row1['ket'];?></td>
            </tr>
          <?php	$no++;  } ?>
        </tbody>
      </table>
      </div>
    </div>
  </div>
  <!-- end of data kpe -->

</div>
<div class="modal fade" id="modal_del" tabindex="-1" >
  <div class="modal-dialog modal-sm" >
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Are you sure to delete all data ?</h4>
      </div>

      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
        <a href="#" class="btn btn-danger" id="delete_link">Delete</a>
        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>	

<!-- Create -->
<div id="DataSolusiPerbaikanGarment" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>	
<div id="DataSolusiDebitNote" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>	

<!-- Edit -->
<div id="EditDataSolusiPerbaikanGarment" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>	
<div id="EditDataSolusiDebitNote" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>	







<?php 
if($_POST['simpan_solusi_pg']=="Simpan"){

	$no_item=strtoupper($_POST['no_item']);
	$pcs=strtoupper($_POST['pg_pcs']);

  $format_amount = str_replace(['.', ','], '', $_POST['pg_amount']);
	$amount=strtoupper($format_amount);

  $currency=strtoupper($_POST['currency']);
  
	$sqlData1=mysqli_query($con,"INSERT INTO tbl_perbaikan_garment SET 
		  no_item='$no_item', pcs='$pcs', amount='$amount', currency='$currency'");
	if($sqlData1){	
	echo "<script>swal({
  title: 'Data Telah Tersimpan',   
  text: 'Klik Ok untuk input data kembali',
  type: 'success',
  }).then((result) => {
  if (result.value) {
         window.location.href='LapKPE';
	 
  }
});</script>";
}else {
      // Tampilkan pesan kesalahan jika perintah SQL gagal
      echo "Error: " . mysqli_error($con);
  }
}

if($_POST['simpan_solusi_db']=="Simpan"){
	$no_item=strtoupper($_POST['no_item']);
	$dn_kg=strtoupper($_POST['dn_kg']);
	$dn_satuan=strtoupper($_POST['dn_satuan']);
  $format_amount = str_replace(['.', ','], '', $_POST['dn_amount']);
	$amount=strtoupper($format_amount);
  $currency=strtoupper($_POST['currency']);
	$sqlData1=mysqli_query($con,"INSERT INTO tbl_debit_note SET 
		  no_item='$no_item', kg='$dn_kg', satuan='$dn_satuan', amount='$amount', currency='$currency'");
	if($sqlData1){	
	echo "<script>swal({
  title: 'Data Telah Tersimpan',   
  text: 'Klik Ok untuk input data kembali',
  type: 'success',
  }).then((result) => {
  if (result.value) {
    window.location.href='LapKPE';
	 
  }
});</script>";
}else {
  // Tampilkan pesan kesalahan jika perintah SQL gagal
  echo "Error: " . mysqli_error($con);
}
}
?>
<script type="text/javascript">
    function confirm_delete(delete_url)
    {
      $('#modal_del').modal('show', {backdrop: 'static'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>	
<script>
		$(document).ready(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});

	</script>

<script>
function formatRupiah(input) {
    // Menghilangkan tanda titik dan koma
    var value = input.value.replace(/[^\d]/g, '');

    // Mengonversi nilai menjadi angka
    var amount = parseInt(value);

    // Mengonversi angka menjadi format rupiah
    var formattedValue = amount.toLocaleString('id-ID');

    // Memasukkan nilai yang sudah diformat kembali ke dalam input field
    input.value = formattedValue;
}
</script>
<script>
$(document).ready(function(){
    $('.detail_solusi_perbaikan_garment').click(function(e){
        e.preventDefault(); // Menghentikan perilaku default dari link
        var no_item = $(this).data('no_item'); // Mengambil nilai no_item dari atribut data
        $('#no_item').val(no_item); // Memasukkan nilai no_item ke dalam input dengan id no_item di dalam modal
        $('#DataSolusi').modal('show'); // Menampilkan modal
    });
});
</script>
</body>
</html>