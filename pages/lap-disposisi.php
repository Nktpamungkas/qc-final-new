<?PHP
//ini_set("error_reporting", 1);
session_start();
include"koneksi.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Disposisi</title>
<style>
  .allow_edit:hover{
    cursor: pointer;
  }
  .allow_edit{
    width: 100%;
    height: 100%;
    display:block;
  }
  .select2 {
    width: 100% !important;
  }
  .redirect:hover{
    cursor: pointer;
  }
  .redirect{
    width: 100%;
    height: 100%;
    display:block;
  }
</style>
</head>
<body>
<?php
//batasi akses edit hanya qc
if($_SESSION['dept']=='QC'){
  $edit="allow_edit";
}else{
  $edit="";
}
$Awal	= isset($_POST['awal']) ? $_POST['awal'] : '';
$Akhir	= isset($_POST['akhir']) ? $_POST['akhir'] : '';
$Subdept = isset($_POST['subdept']) ? $_POST['subdept'] : '';
$GShift	= isset($_POST['gshift']) ? $_POST['gshift'] : '';
//$GShift1 = $GShift;
$TotalKirim	= isset($_POST['total']) ? $_POST['total'] : '';
$TotalLot	= isset($_POST['total_lot']) ? $_POST['total_lot'] : '';
$sts_disposisi = isset($_POST['sts_disposisi']) ? $_POST['sts_disposisi'] : '';
$sts_lolos = isset($_POST['sts_lolos']) ? $_POST['sts_lolos'] : '';
$sts_disposisipro = isset($_POST['sts_disposisipro']) ? $_POST['sts_disposisipro'] : '';
$sts_nego = isset($_POST['sts_nego']) ? $_POST['sts_nego'] : '';
$Langganan = isset($_POST['langganan']) ? $_POST['langganan'] : '';
?>
<div class="row">
<div class="col-xs-6">
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"> Filter Laporan KPE Disposisi</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form method="post" enctype="multipart/form-data" name="form1" class="form-horizontal" id="form1">
    <div class="box-body">
      <div class="form-group">
        <div class="col-sm-4">
          <div class="input-group date">
            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
            <input name="awal" type="text" class="form-control pull-right" id="datepicker" placeholder="Tanggal Awal" value="<?php echo $Awal; ?>" autocomplete="off"/>
          </div>
        </div>
        <div class="col-sm-4">
          <input name="langganan" type="text" class="form-control pull-right" id="langganan" placeholder="Langganan/Buyer" value="<?php echo $Langganan;  ?>" autocomplete="off"/>
        </div>
        <!-- /.input group -->
      </div>
      <div class="form-group">
        <div class="col-sm-4">
          <div class="input-group date">
            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
            <input name="akhir" type="text" class="form-control pull-right" id="datepicker1" placeholder="Tanggal Akhir" value="<?php echo $Akhir;  ?>" autocomplete="off"/>
          </div>
        </div>
        <!-- /.input group -->
      </div>
      <div class="form-group">
		    <div class="col-sm-4">
                <select class="form-control select2" name="subdept" id="subdept">
                    <option value="">Pilih</option>
                    <option value="ADM" <?php if($Subdept=="ADM"){echo "SELECTED";}?>>ADM</option>	
                    <option value="AFTERSALES" <?php if($Subdept=="AFTERSALES"){echo "SELECTED";}?>>AFTERSALES</option>
                    <option value="COLORIST" <?php if($Subdept=="COLORIST"){echo "SELECTED";}?>>COLORIST</option>
                    <option value="INSPECTION" <?php if($Subdept=="INSPECTION"){echo "SELECTED";}?>>INSPECTION</option>
                    <option value="KRAGH" <?php if($Subdept=="KRAGH"){echo "SELECTED";}?>>KRAGH</option>
                    <option value="LEADER" <?php if($Subdept=="LEADER"){echo "SELECTED";}?>>LEADER</option>
                    <option value="MANAGER/ASST.MANAGER" <?php if($Subdept=="MANAGER/ASST.MANAGER"){echo "SELECTED";}?>>MANAGER/ASST.MANAGER</option>
                    <option value="PACKING" <?php if($Subdept=="PACKING"){echo "SELECTED";}?>>PACKING</option>
                    <option value="SPV" <?php if($Subdept=="SPV"){echo "SELECTED";}?>>SPV</option>
                    <option value="TEST QUALITY" <?php if($Subdept=="TEST QUALITY"){echo "SELECTED";}?>>TEST QUALITY</option>		
			    </select>
		    </div>				   
		</div> 
        <div class="form-group">
            <div class="col-sm-4">
                <select name="gshift" class="form-control select2">
                  <option value="">Pilih</option> 
                	<option value="ALL" <?php if($GShift=="ALL"){ echo "SELECTED";}?>>ALL</option>
                	<option value="A" <?php if($GShift=="A"){ echo "SELECTED";}?>>A</option>
                	<option value="B" <?php if($GShift=="B"){ echo "SELECTED";}?>>B</option>
					        <option value="C" <?php if($GShift=="C"){ echo "SELECTED";}?>>C</option>
                  <option value="Non-Shift" <?php if($GShift=="Non-Shift"){ echo "SELECTED";}?>>Non-Shift</option>
                  <option value="QC2" <?php if($GShift=="QC2"){ echo "SELECTED";}?>>QC2</option>
                  <option value="Test Quality" <?php if($GShift=="Test Quality"){ echo "SELECTED";}?>>Test Quality</option>
                </select>
            </div>			 
        </div>
        <div class="form-group">
          <div class="col-sm-4">
            <div class="input-group date">
              <div class="input-group-addon"> Total Kirim</div>
                <input name="total" type="text" class="form-control pull-right" placeholder="0" value="<?php echo $TotalKirim; ?>" />
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-4">
            <div class="input-group date">
              <div class="input-group-addon"> Total Lot Kain</div>
                <input name="total_lot" type="text" class="form-control pull-right" placeholder="0" value="<?php echo $TotalLot; ?>" />
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="sts_disposisi" class="col-sm-0 control-label"></label>		  
            <div class="col-sm-3">
            <input type="checkbox" name="sts_disposisi" id="sts_disposisi" value="1" <?php  if($sts_disposisi=="1"){ echo "checked";} ?>>  
            <label> Disposisi QC</label>
            </div>
            <div class="col-sm-3">
            <input type="checkbox" name="sts_disposisipro" id="sts_disposisipro" value="1" <?php  if($sts_disposisipro=="1"){ echo "checked";} ?>>  
            <label> Disposisi Produksi</label>
            </div>		  	
		    </div>
        <div class="form-group">
          <label for="sts_disposisi" class="col-sm-0 control-label"></label>		  
            <div class="col-sm-3">
            <input type="checkbox" name="sts_lolos" id="sts_lolos" value="1" <?php  if($sts_lolos=="1"){ echo "checked";} ?>>  
            <label> Lolos</label>
            </div>
            <div class="col-sm-3">
            <input type="checkbox" name="sts_nego" id="sts_nego" value="1" <?php  if($sts_nego=="1"){ echo "checked";} ?>>  
            <label> Nego Aftersales</label>
            </div>		  	
		    </div>	
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="col-sm-6">
        <button type="submit" class="btn btn-block btn-social btn-linkedin btn-sm" name="save" style="width: 60%">Search <i class="fa fa-search"></i></button>
      </div>
    </div>
    <!-- /.box-footer -->
  </form>
</div>
</div>

</div>


<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Data KPE Disposisi</h3><br>
              <?php if($_POST['awal']!=""){?><b>Periode: <?php echo $_POST['awal']." to ".$_POST['akhir']; ?></b><?php } ?>
        <div class="pull-right">
            <a href="pages/cetak/cetak_summary_solusi.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&shft=<?php echo $GShift; ?>&subdept=<?php echo $Subdept; ?>&total=<?php echo $_POST['total']; ?>&total_lot=<?php echo $_POST['total_lot']; ?>" class="btn btn-danger <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Cetak Summary Solusi</a> 
            <a href="pages/cetak/cetak_lap_disposisi.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&shft=<?php echo $GShift; ?>&subdept=<?php echo $Subdept; ?>&total=<?php echo $_POST['total']; ?>&total_lot=<?php echo $_POST['total_lot']; ?>" class="btn btn-danger <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Cetak Laporan Lolos/Disposisi</a> 
            <a href="pages/cetak/cetak_excel_lolosdisposisi.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&shft=<?php echo $GShift; ?>&subdept=<?php echo $Subdept; ?>&total=<?php echo $_POST['total']; ?>&total_lot=<?php echo $_POST['total_lot']; ?>" class="btn btn-success <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Excel Laporan Lolos/Disposisi</a> 
            <?php if($sts_disposisi=="1") { ?>
            <a href="pages/cetak/cetak_disposisi.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&shft=<?php echo $GShift; ?>&subdept=<?php echo $Subdept; ?>&total=<?php echo $_POST['total']; ?>&total_lot=<?php echo $_POST['total_lot']; ?>&disposisi=<?php echo $_POST['sts_disposisi']; ?>&langganan=<?php echo $_POST['langganan']; ?>" class="btn btn-danger <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Cetak Disposisi QC</a> 
            <a href="pages/cetak/cetak_excel_disposisiqc.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&shft=<?php echo $GShift; ?>&subdept=<?php echo $Subdept; ?>&total=<?php echo $_POST['total']; ?>&total_lot=<?php echo $_POST['total_lot']; ?>&disposisi=<?php echo $_POST['sts_disposisi']; ?>&langganan=<?php echo $_POST['langganan']; ?>" class="btn btn-success <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Excel Disposisi QC</a> 
            <?php } ?>
            <?php if($sts_lolos=="1") { ?>
            <a href="pages/cetak/cetak_lolosqc.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&shft=<?php echo $GShift; ?>&subdept=<?php echo $Subdept; ?>&total=<?php echo $_POST['total']; ?>&total_lot=<?php echo $_POST['total_lot']; ?>&lolos=<?php echo $_POST['sts_lolos']; ?>&langganan=<?php echo $_POST['langganan']; ?>" class="btn btn-danger <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Cetak Lolos QC</a> 
			<a href="pages/cetak/cetak_lolosqc.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&shft=<?php echo $GShift; ?>&subdept=<?php echo $Subdept; ?>&total=<?php echo $_POST['total']; ?>&total_lot=<?php echo $_POST['total_lot']; ?>&lolos=<?php echo $_POST['sts_lolos']; ?>&langganan=<?php echo $_POST['langganan']; ?>&excell" class="btn btn-danger <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Cetak Lolos QC Excell</a> 

			<?php } ?>
            <?php if($sts_disposisipro=="1") { ?>
            <a href="pages/cetak/cetak_disposisipro.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&shft=<?php echo $GShift; ?>&subdept=<?php echo $Subdept; ?>&total=<?php echo $_POST['total']; ?>&total_lot=<?php echo $_POST['total_lot']; ?>&disposisipro=<?php echo $_POST['sts_disposisipro']; ?>&langganan=<?php echo $_POST['langganan']; ?>" class="btn btn-danger <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Cetak Disposisi Produksi</a> 
            <a href="pages/cetak/cetak_excel_disposisipro.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&shft=<?php echo $GShift; ?>&subdept=<?php echo $Subdept; ?>&total=<?php echo $_POST['total']; ?>&total_lot=<?php echo $_POST['total_lot']; ?>&disposisipro=<?php echo $_POST['sts_disposisipro']; ?>&langganan=<?php echo $_POST['langganan']; ?>" class="btn btn-success <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Excel Disposisi Produksi</a> 
            <?php } ?>
            <?php if($sts_nego=="1") { ?>
            <a href="pages/cetak/cetak_nego.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&shft=<?php echo $GShift; ?>&subdept=<?php echo $Subdept; ?>&total=<?php echo $_POST['total']; ?>&total_lot=<?php echo $_POST['total_lot']; ?>&nego=<?php echo $_POST['sts_nego']; ?>&langganan=<?php echo $_POST['langganan']; ?>" class="btn btn-danger <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Cetak Nego Aftersales</a> 
            <?php } ?>
        </div>
	  </div>
      <div class="box-body">
      <table class="table table-bordered table-hover table-striped nowrap" id="example3" style="width:100%">
        <thead class="bg-blue">
          <tr>
            <th><div align="center">No</div></th>
            <th><div align="center">Tgl</div></th>
            <th><div align="center">No KK</div></th>
            <th><div align="center">Langganan</div></th>
            <th><div align="center">PO</div></th>
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
            <th><div align="center">Personil</div></th>
            <th><div align="center">Pejabat</div></th>
            <th><div align="center">Shift</div></th>
            <th><div align="center">Hitung</div></th>
            <th><div align="center">Status</div></th>
            <th><div align="center">Nama Nego</div></th>
            <th><div align="center">Hasil Nego</div></th>
            <th><div align="center">Ket</div></th>
            </tr>
        </thead>
        <tbody>
          <?php
	    $no=1;
      $arr_hitung=[
        ""=>"",
        "terima"=>"&#10004;",
        "tolak"=>"X"
      ];
      $arr_sts=[
        ""=>"",
        "disposisi"=>"Disposisi",
        "lolos"=>"Lolos"
      ];
	    if($Awal!=""){ $Where =" AND DATE_FORMAT( tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' AND sts_revdis='0' "; }
        if($GShift=="ALL" or $GShift==""){$shft=" ";}else{$shft=" AND (shift LIKE '$GShift' OR shift2 LIKE '$GShift') ";}
        //if($GShift1=="ALL"){ $shft1=" ";}else{$shft1=" AND shift2 LIKE '$GShift1' ";}
        if($Subdept!=""){ $subdpt=" AND subdept='$Subdept' "; }else{$subdpt=" ";}
        if($sts_disposisi=="1"){ $disposisi =" AND sts_disposisiqc='1' "; }else{$disposisi = " ";}
        if($sts_lolos=="1"){ $lolos =" AND sts='1' "; }else{$lolos = " ";}
        if($sts_disposisipro=="1"){ $disposisi_pro =" AND sts_disposisipro='1' "; }else{$disposisi_pro = " ";}
        if($sts_nego=="1"){ $nego =" AND sts_nego='1' "; }else{$nego = " ";}
      if($Awal!="" or $GShift!="" or $Subdept!="" or $sts_disposisi=="1" or $sts_lolos=="1" or $sts_disposisipro=="1" or $sts_nego=="1" or $Langganan!=""){
        $sql1=mysqli_query($con,"SELECT * FROM tbl_aftersales_now WHERE langganan LIKE '%$Langganan%' $Where $shft $subdpt $disposisi $lolos $disposisi_pro $nego ORDER BY id ASC") or die(mysqli_error($con));
      }else{
        $sql1=mysqli_query($con,"SELECT * FROM tbl_aftersales_now WHERE langganan LIKE '$Langganan' $Where $shft $subdpt $disposisi $lolos $disposisi_pro $nego ORDER BY id ASC");
      }
      //$qry1=mysqli_query($con,$sql1) or die(mysqli_error($con));
			while($row1=mysqli_fetch_array($sql1)){
      $arr_all_personil=array();
      if($row1['personil']!=""){
        $arr_all_personil[]=$row1['personil'];
      }
      if($row1['personil2']!=""){
        $arr_all_personil[]=$row1['personil2'];
      }
      if($row1['personil3']!=""){
        $arr_all_personil[]=$row1['personil3'];
      }
      if($row1['personil4']!=""){
        $arr_all_personil[]=$row1['personil4'];
      }
      if($row1['personil5']!=""){
        $arr_all_personil[]=$row1['personil5'];
      }
      if($row1['personil6']!=""){
        $arr_all_personil[]=$row1['personil6'];
      }
		 ?>
          <tr bgcolor="<?php echo $bgcolor; ?>" data-id_data="<?= $row1['id']; ?>"  data-personil="<?= $row1['personil']; ?>" data-personil2="<?= $row1['personil2']; ?>" data-personil3="<?= $row1['personil3']; ?>" data-personil4="<?= $row1['personil4']; ?>" data-personil5="<?= $row1['personil5']; ?>" data-personil6="<?= $row1['personil6']; ?>" data-shift="<?= $row1['shift']; ?>" data-shift2="<?= $row1['shift2']; ?>" data-pejabat="<?= $row1['pejabat']; ?>" data-hitung="<?= $row1['status_penghubung']; ?>" data-stsc="<?= $row1['sts_qc']; ?>">
            <td align="center"><?php echo $no; ?></td>
            <td align="center"><?php echo $row1['tgl_buat'];?></td>
            <td align="center"><div data-nokk="<?= $row1['nokk']; ?>" class="redirect"><?php echo $row1['nokk'];?> </div></td>
            <td><?php echo $row1['langganan'];?></td>
            <td align="center"><?php echo $row1['po'];?></td>
            <td align="center"><?php echo $row1['no_order'];?></td>
            <td align="center" valign="top"><?php echo $row1['no_hanger'];?></td>
            <td><?php echo $row1['jenis_kain'];?></td>
            <td align="center"><?php echo $row1['lebar']."x".$row1['gramasi'];?></td>
            <td align="center"><?php echo $row1['lot'];?></td>
            <td align="center"><?php echo $row1['warna'];?></td>
            <td align="right"><?php echo $row1['qty_order'];?></td>
            <td align="right"><?php echo $row1['qty_kirim'];?></td>
            <td align="right"><?php echo $row1['qty_claim'];?></td>
            <td align="center"><?php echo $row1['t_jawab'];?></td>
            <td><?php echo $row1['masalah_dominan'];?></td>
            <td><?php echo $row1['masalah'];?></td>
            <td><?php echo $row1['penyebab'];?></td>
            <td><div class="<?=$edit;?>" id="<?="td_personil_".$row1['id']."" ;?>">&nbsp;<?=join(',',$arr_all_personil)?></div></td>
            <td><div class="<?=$edit;?>" id="<?="td_pejabat_".$row1['id']."" ;?>">&nbsp;<?php echo $row1['pejabat'];?></div></td>
            <td><div class="<?=$edit;?>" id="<?="td_shift_".$row1['id']."" ;?>">&nbsp;<?php if($row1['shift2']!=""){echo $row1['shift'].",".$row1['shift2'];}else{echo $row1['shift'];}?></div></td>
            <td><div class="<?=$edit;?>" id="<?="td_hitung_".$row1['id']."" ;?>">&nbsp;<?php echo $arr_hitung[$row1['status_penghubung']];?></div></td>
            <td><div class="<?=$edit;?>" id="<?="td_stsc_".$row1['id']."" ;?>">&nbsp;<?php echo $arr_sts[$row1['sts_qc']];?></div></td>
            <td><?php echo $row1['nama_nego'];?></td>
            <td><?php echo $row1['hasil_nego'];?></td>
            <td><?php echo $row1['ket'];?></td>
          </tr>
          <?php	$no++;  } ?>
        </tbody>
      </table>
      </div>
    </div>
  </div>
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
<div class="modal fade" id="modal_personil_shift" >
  <div class="modal-dialog modal-lg" >
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Edit Personil Dan Shift</h4>
      </div>
      
      <div class="modal-body">
        <input type="hidden" id="id_data" val="0">
        <div class="row">
          <div class="form-group">
            <?php
              $personil_option="";
              $qryp = mysqli_query($con, "SELECT UPPER(nama) AS nama FROM user_login WHERE dept ='QC' ORDER BY nama ASC");
              while ($rp = mysqli_fetch_array($qryp)) {
              $personil_option .= "<option value='".$rp['nama']."'>". $rp['nama']."</option>
                  ";
              } 
            ?>
            <label for="personil" class="col-sm-3 control-label">Personil 1,2 & 3</label>
            <div class="col-sm-3">
                <select class="form-control select2" name="personil_update" id="personil_update">
                  <option value="">Pilih Personil 1</option>
                  <?=$personil_option?>
                </select>
            </div>
            <div class="col-sm-3">
              <select class="form-control select2" name="personil2_update" id="personil2_update">
                <option value="">Pilih Personil 2</option>
                <?=$personil_option?>
              </select>	
            </div>
            <div class="col-sm-3">
              <select class="form-control select2" name="personil3_update" id="personil3_update">
                <option value="">Pilih Personil 3</option>
                <?=$personil_option?>
              </select>	
            </div>
          </div> 
				</div>
        </br>
        <div class="row">
          <div class="form-group">
            <label for="personil" class="col-sm-3 control-label">Personil 4,5 & 6</label>
            <div class="col-sm-3">
                <select class="form-control select2" name="personil4_update" id="personil4_update">
                  <option value="">Pilih Personil 4</option>
                  <?=$personil_option?>
                </select>
            </div>
            <div class="col-sm-3">
              <select class="form-control select2" name="personil5_update" id="personil5_update">
                <option value="">Pilih Personil 5</option>
                <?=$personil_option?>
              </select>	
            </div>
            <div class="col-sm-3">
              <select class="form-control select2" name="personil6_update" id="personil6_update">
                <option value="">Pilih Personil 6</option>
                <?=$personil_option?>
              </select>	
            </div>
          </div> 
				</div>
        </br> 
        <div class="row">
          <div class="form-group">
            <label for="shift_update" class="col-sm-3 control-label">Shift / Shift2</label>
            <div class="col-sm-3">
              <select class="form-control select2" name="shift_update" id="shift_update">
                <option value="">Pilih</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="Non-Shift">Non-Shift</option>
                <option value="QC2">QC2</option>
                <option value="Test Quality">Test Quality</option>
              </select>
            </div>
            <div class="col-sm-3">
              <select class="form-control select2" name="shift2_update" id="shift2_update">
                <option value="">Pilih</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="Non-Shift">Non-Shift</option>
                <option value="QC2">QC2</option>
                <option value="Test Quality">Test Quality</option>
              </select>
            </div>
          </div> 
				</div> 
        </br>
        <div class="row">
          <div class="form-group">
            <?php
              $qryp = mysqli_query($con, "SELECT nama FROM tbl_personil_aftersales WHERE jenis='pejabat' ORDER BY nama ASC");
              while ($rp = mysqli_fetch_array($qryp)) {
                $pejabat_option .= "<option value='".$rp['nama']."'>". $rp['nama']."</option>
                    ";
              } 
            ?>
            <label for="pejabat_update" class="col-sm-3 control-label">Pejabat</label>
            <div class="col-sm-3">
              <select class="form-control select2" name="pejabat_update" id="pejabat_update">
                <option value="">Pilih</option>
                <?=$pejabat_option?>
              </select>
            </div>
          </div>
        </div>
        </br>
        <div class="row">
          <div class="form-group">
            <label for="hitung_update" class="col-sm-3 control-label">Hitung</label>
            <div class="col-sm-3">
              <select class="form-control select2" name="hitung_update" id="hitung_update">
                <option value="">Pilih</option>
                <option value="terima">&#10004;</option>
                <option value="tolak">X</option>
              </select>
            </div>
          </div>
        </div>
        </br>
        <div class="row">
          <div class="form-group">
            <label for="stsc_update" class="col-sm-3 control-label">Status</label>
            <div class="col-sm-3">
              <select class="form-control select2" name="stsc_update" id="stsc_update">
                <option value="">Pilih</option>
                <option value="disposisi">Disposisi </option>
                <option value="lolos">Lolos</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      
      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
        <button type="button" class="btn btn-primary" id="update_personil">Update</button>
        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>	
<form action="RekapData" method="POST" target="_blank" id="redirect_by_nokk" style="display:none">
  <input type="hidden" name="prodorder" id="prodorder"/>
  <input type="submit" value="Submit">
</form>
<script type="text/javascript">
    function confirm_delete(delete_url)
    {
      $('#modal_del').modal('show', {backdrop: 'static'});
      // document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>	
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var parent=false;
    var arr_hitung={}
    arr_hitung[""]="";
    arr_hitung["terima"]="&#10004;";
    arr_hitung["tolak"]="X";
    var arr_sts={}
    arr_sts[""]="";
    arr_sts["disposisi"]="Disposisi";
    arr_sts["lolos"]="Lolos";
    $('.allow_edit').click(function(e) {  
      parent=$(this).parent().parent();
      $('#personil_update').val(parent.data('personil')).trigger('change');
      $('#personil2_update').val(parent.data('personil2')).trigger('change');
      $('#personil3_update').val(parent.data('personil3')).trigger('change');
      $('#personil4_update').val(parent.data('personil4')).trigger('change');
      $('#personil5_update').val(parent.data('personil5')).trigger('change');
      $('#personil6_update').val(parent.data('personil6')).trigger('change');
      $('#shift_update').val(parent.data('shift')).trigger('change');
      $('#shift2_update').val(parent.data('shift2')).trigger('change');
      $('#pejabat_update').val(parent.data('pejabat')).trigger('change');
      $('#hitung_update').val(parent.data('hitung')).trigger('change');
      $('#stsc_update').val(parent.data('stsc')).trigger('change');
      $('#id_data').val(parent.data('id_data'));  
      $('#modal_personil_shift').modal('show', {backdrop: 'static'});       
    });
    $('#update_personil').click(function(e) {  
      $.ajax({
            url: 'pages/ajax/ajax_update_personil_kpe_disposisi.php',
            type: 'POST',
            data: {
              status:"update_personil", 
              id_dt:$('#id_data').val(), 
              personil:$('#personil_update').val(),  
              personil2:$('#personil2_update').val(), 
              personil3:$('#personil3_update').val(), 
              personil4:$('#personil4_update').val(), 
              personil5:$('#personil5_update').val(), 
              personil6:$('#personil6_update').val(), 
              shift:$('#shift_update').val(), 
              shift2:$('#shift2_update').val(), 
              pejabat:$('#pejabat_update').val(), 
              hitung:$('#hitung_update').val(),  
              sts_qc:$('#stsc_update').val(),  
            },
            success: function(response) {
                if(response.success){
                  $('#td_personil_'+response.messages[1]).html("&nbsp;"+response.messages[2]);
                  $('#td_shift_'+response.messages[1]).html("&nbsp;"+response.messages[3]);
                  $('#td_pejabat_'+response.messages[1]).html("&nbsp;"+response.messages[4]);
                  $('#td_hitung_'+response.messages[1]).html("&nbsp;"+arr_hitung[response.messages[5]]);
                  $('#td_stsc_'+response.messages[1]).html("&nbsp;"+arr_sts[response.messages[6]]);
                  $('#modal_personil_shift').modal('hide'); 
                  $('#example3').DataTable().columns.adjust().draw();
                  parent.data("personil",$('#personil_update').val());
                  parent.data("personil2",$('#personil2_update').val());
                  parent.data("personil3",$('#personil3_update').val());
                  parent.data("personil4",$('#personil4_update').val());
                  parent.data("personil5",$('#personil5_update').val());
                  parent.data("personil6",$('#personil6_update').val());
                  parent.data("shift",$('#shift_update').val());
                  parent.data("shift2",$('#shift2_update').val());
                  parent.data("pejabat",$('#pejabat_update').val());
                  parent.data("hitung",$('#hitung_update').val());
                  parent.data("stsc",$('#stsc_update').val());
                }else{
                    Swal.fire({
                      title: 'Error',
                      text: response.messages[0],
                      icon: 'error',
                      timer: 1000,
                      position : 'top-end',
                      showConfirmButton: false
                  });
                }
            },
            error: function() {
            }
      });
    });
    $('.redirect').click(function(e) {
      $('#prodorder').val($(this).data("nokk"));
      $('#redirect_by_nokk').submit()
    });
		$(document).ready(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});
  })
	</script>
</body>
</html>