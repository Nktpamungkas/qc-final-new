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
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<script src="dist/js/jquery-3.5.1.min.js"></script>
<script src="dist/js/pages/bootstrap.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js "></script> -->
<style>
  .select2 {
    width: 100% !important;
  }
  /* .select2-container {
    z-index: 9999 !important;
} */
</style>
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
$Kategori	= isset($_POST['kategori']) ? $_POST['kategori'] : '';
$MasalahDominan = isset($_POST['masalah_dominan']) ? $_POST['masalah_dominan'] : '';
	
if($_POST['gshift']=="ALL"){$shft=" ";}else{$shft=" AND b.g_shift = '$GShift' ";}	
?>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"> Filter Laporan KPE </h3>
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
        <div class="col-sm-2">
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
        <div class="col-sm-2">
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
        <div class="col-sm-2">
        <select class="form-control select2" name="kategori" id="kategori">
							<option value="">Kategori</option>
							<?php 
							$categories = ["MAJOR", "SAMPLE", "REPEAT", "GENERAL"];
							foreach($categories as $category){
							?>
							<option value="<?=$category?>" <?=$Kategori==$category?'selected':''?>><?=$category?></option>	
							<?php }?>
						</select>
        </div>
        <div class="col-sm-2">
        <select class="form-control select2" name="masalah_dominan" id="masalah_dominan">
        <option value="">Pilih Masalah Dominan</option>
        <?php
        $qryMasalah = mysqli_query($con, "SELECT DISTINCT masalah_dominan FROM tbl_aftersales_now ORDER BY masalah_dominan ASC");
        while ($rowMasalah = mysqli_fetch_array($qryMasalah)) {
        ?>
            <option value="<?php echo $rowMasalah['masalah_dominan']; ?>" <?php if ($MasalahDominan == $rowMasalah['masalah_dominan']) echo "selected"; ?>>
                <?php echo $rowMasalah['masalah_dominan']; ?>
            </option>
        <?php } ?>
    </select>
        </div>
      </div>
    <div class="form-group">
		  <label for="status_red" class="col-sm-0 control-label"></label>		  
        <div class="col-sm-3">
        <!-- <input type="checkbox" name="sts_red" id="sts_red" value="1" >   -->
        <input type="checkbox" name="sts_red" id="sts_red" value="1" <?php  if($sts_red=="1" or $sts_red=="0"){ echo "checked";} ?>>  
        <label> Laporan Leadtime Email</label>
          
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
            <a href="pages/cetak/cetak_perbaikan_garment.php?awal=<?=$Awal?>&akhir=<?=$Akhir?>" class="btn btn-primary" target="_blank">Cetak Perbaikan Garment</a>
          <?php }elseif($_POST['solusi'] == 'DEBIT NOTE') {?>
            <a href="pages/cetak/cetak_debit_note.php?awal=<?=$Awal?>&akhir=<?=$Akhir?>" class="btn btn-success" target="_blank">Cetak Debit Note</a>
            <?php }?>
            
            <a href="pages/cetak/cetak_kpe.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&order=<?php echo $_POST['order']; ?>&po=<?php echo $_POST['po']; ?>&hanger=<?php echo $_POST['hanger']; ?>&langganan=<?php echo $_POST['langganan']; ?>&demand=<?php echo $_POST['demand']; ?>&prodorder=<?php echo $_POST['prodorder']; ?>&pejabat=<?php echo $_POST['pejabat']; ?>" class="btn btn-danger <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Cetak KPE</a>
			 
			 
			<a href="pages/cetak/cetak_kpe_disposisi.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&order=<?php echo $_POST['order']; ?>&po=<?php echo $_POST['po']; ?>&hanger=<?php echo $_POST['hanger']; ?>&langganan=<?php echo $_POST['langganan']; ?>&demand=<?php echo $_POST['demand']; ?>&prodorder=<?php echo $_POST['prodorder']; ?>&pejabat=<?php echo $_POST['pejabat']; ?>" class="btn btn-danger <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Cetak KPE Disposisi</a> 
            <a href="pages/cetak/excel_kpe_disposisi.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>&order=<?php echo $_POST['order']; ?>&po=<?php echo $_POST['po']; ?>&hanger=<?php echo $_POST['hanger']; ?>&langganan=<?php echo $_POST['langganan']; ?>&demand=<?php echo $_POST['demand']; ?>&prodorder=<?php echo $_POST['prodorder']; ?>&pejabat=<?php echo $_POST['pejabat']; ?>" class="btn btn-success <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Excel KPE Disposisi</a> 
          </div>
        <?php if($sts_red=='1' or $sts_red=='0'){ ?>
              <div class="pull-right">
                <a href="pages/cetak/cetak_redemail.php?awal=<?php echo $_POST['awal']; ?>&akhir=<?php echo $_POST['akhir']; ?>" class="btn btn-primary <?php if($_POST['awal']=="") { echo "disabled"; }?>" target="_blank">Cetak Leadtime Email</a>
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
              <th rowspan='2' rowspan='2'><div align="center">No</div></th>
              <!-- <th rowspan='2'><div align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Aksi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></th> -->
              <th rowspan='2'><div align="center">Tgl</div></th>
              <th rowspan='2'><div align="center">Pelanggan</div></th>
              <th rowspan='2'><div align="center">Buyer</div></th>
              <th rowspan='2'><div align="center">No Demand</div></th>
              <th rowspan='2'><div align="center">No Prod Order</div></th>
              <th rowspan='2'><div align="center">PO</div></th>
              <!-- <th rowspan='2'><div align="center">NO ITEM</div></th> -->
              <th rowspan='2'><div align="center">Order</div></th>
              <th rowspan='2'><div align="center">Hanger</div></th>
              <th rowspan='2'><div align="center">Jenis Kain</div></th>
              <th rowspan='2'><div align="center">Lebar</div></th>
              <th rowspan='2'><div align="center">Gramasi</div></th>
              <th rowspan='2'><div align="center">Lot</div></th>
              <th rowspan='2'><div align="center">Warna</div></th>
              <th rowspan='2'><div align="center">Qty Order</div></th>
              <th rowspan='2'><div align="center">Qty Order (yd)</div></th>
              <th rowspan='2'><div align="center">Qty Kirim</div></th>
              <th rowspan='2'><div align="center">Qty Kirim (yd)</div></th>
              <th rowspan='2'><div align="center">Qty Claim</div></th>
              <th rowspan='2'><div align="center">Qty Claim (yd)</div></th>
              <th rowspan='2'><div align="center">Qty Lolos QC (kg)</div></th>
              <th rowspan='2'><div>
                <div align="center">T Jawab</div>
              </div></th>
              <th rowspan='2'><div align="center">Masalah Dominan</div></th>
              <th rowspan='2'><div align="center">Masalah</div></th>
              <th rowspan='2'><div align="center">Penyebab</div></th>
              <th rowspan='2'><div align="center">Route Cause</div></th>
              <th rowspan='2'><div align="center">Solusi</div></th>
              <th rowspan='2'><div align="center">Klasifikasi</div></th>
              <th rowspan='2'><div align="center">Personil</div></th>
              <th rowspan='2'><div align="center">Pejabat</div></th>
              <th rowspan='2'><div align="center">Lolos/Disposisi</div></th>
              <th rowspan='2'><div align="center">BPP</div></th>
              <th colspan= '4'class="text-center">NCP</th>
              <!-- <th><div align="center">Analisa Kerusakan</div></th> -->
              <th rowspan='2'><div align="center">Ket</div></th>
              <th rowspan='2'><div align="center">Personil Additional</div></th>
              <th rowspan='2'><div align="center">Pejabat Additional</div></th>
              <th rowspan='2'><div align="center">Hitung</div></th>
              <th rowspan='2'><div align="center">Status</div></th>
              <th rowspan='2'><div align="center">Analisis</div></th>
              <th rowspan='2'><div align="center">Hasil Analisa</div></th>
              <th rowspan='2'><div align="center">Pengurangan Poin</div></th>
            </tr>
            <tr>
            <th class="text-center">No NCP</th>
              <th class="text-center">Masalah Utama</th>
              <th class="text-center">Akar Masalah</th>
              <th class="text-center">Solusi Jangka Panjang</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $no=1;
            // if($sts_red=="1"){ $stsred =" AND a.sts_red='1' "; }else{$stsred = " ";}
            if($sts_claim=="1"){ $stsclaim =" AND a.sts_claim='1' "; }else{$stsclaim =" ";}
            if($Awal!=""){ $Where =" AND DATE_FORMAT( a.tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir' "; }
            if ($MasalahDominan != "") {
              $Where .= " AND a.masalah_dominan = '$MasalahDominan' ";
            }
            if($Kategori != "") {
              $query4Kategori = mysqli_query($con, "SELECT
                                                      a.*,
                                                      b.pjg1
                                                      FROM
                                                      tbl_aftersales_now a
                                                      LEFT JOIN tbl_ganti_kain_now b
                                                      ON
                                                      b.id_nsp = a.id
                                                      WHERE
                                                      DATE_FORMAT(a.tgl_buat, '%Y-%m-%d' ) BETWEEN '$Awal' AND '$Akhir'
                                                      GROUP BY
                                                      a.po,
                                                      a.no_hanger,
                                                      a.warna,
                                                      a.masalah_dominan,
                                                      a.qty_order
                                                      ORDER BY
                                                      a.tgl_buat ASC");

              $majorTemp = [];
              $sampleTemp = [];
              $repeatTemp = [];
              $generalTemp = [];

              while($row = mysqli_fetch_assoc($query4Kategori)) {
                  if($row['pjg1'] >= 500) {
                      $majorTemp[] = $row;
                  } elseif(in_array(substr($row['no_order'], 0, 3), ['SAM', 'SME'])) {
                      $sampleTemp[] = $row;
                  } else {
                      $generalTemp[] = $row;
                  }
              }

              $hanger_masalah_dominan = array_map(function($value) {
                  return $value['no_hanger'].''.$value['masalah_dominan'];
              }, $generalTemp);

              $count_hanger_masalah_dominan = array_count_values($hanger_masalah_dominan);
              $group_hanger_masalah_dominan = array_keys(array_filter($count_hanger_masalah_dominan, fn($value) => $value > 1 ));

              foreach ($generalTemp as $key => $value) {
                  $hmd = $value['no_hanger'].''.$value['masalah_dominan'];
                  if(in_array($hmd, $group_hanger_masalah_dominan)){
                      $repeatTemp[] = $value;
                      unset($generalTemp[$key]);
                  }
              }

              $majorTemp = array_column($majorTemp, 'id');
              $sampleTemp = array_column($sampleTemp, 'id');
              $repeatTemp = array_column($repeatTemp, 'id');
              $generalTemp = array_column($generalTemp, 'id');

              switch ($Kategori) {
                case "MAJOR":
                    $WhereKategori = "AND a.id IN (" . implode(",", $majorTemp) . ") ";
                    break;
                case "SAMPLE":
                    $WhereKategori = "AND a.id IN (" . implode(",", $sampleTemp) . ") ";
                    break;
                case "REPEAT":
                    $WhereKategori = "AND a.id IN (" . implode(",", $repeatTemp) . ") ";
                    break;
                case "GENERAL":
                    $WhereKategori = "AND a.id IN (" . implode(",", $generalTemp) . ") ";
                    break;
                default:
                    // handle default case if necessary
              }
            }

            // if($Awal!="" or $sts_red=="1" or $sts_claim=="1" or $Order!="" or $Hanger!="" or $PO!="" or $Langganan!="" or $Demand!="" or $Prodorder!="" or $Pejabat!="" or $Solusi!=""){
            if($Awal!=""  or $sts_claim=="1" or $Order!="" or $Hanger!="" or $PO!="" or $Langganan!="" or $Demand!="" or $Prodorder!="" or $Pejabat!="" or $Solusi!=""){
              $qry1=mysqli_query($con,"SELECT a.*,
                          c.personil1 as personil1_additional,
                          c.personil2 as personil2_additional,
                          c.personil3 as personil3_additional,
                          c.personil4 as personil4_additional,
                          c.personil5 as personil5_additional,
                          c.personil6 as personil6_additional,
                          CONCAT_WS(', ',
                              NULLIF(c.personil1, ''),
                              NULLIF(c.personil2, ''),
                              NULLIF(c.personil3, ''),
                              NULLIF(c.personil4, ''),
                              NULLIF(c.personil5, ''),
                              NULLIF(c.personil6, '')
                          ) AS personil_additional,
                          c.pejabat as pejabat_additional,
                          c.shift1 as shift1_additional,
                          c.shift2 as shift2_additional,
                          c.hitung as hitung_additional,
                          c.status as status_additional,
                          c.analisis as analisis_additional,
                          c.hasil_analisa as hasil_analisa_additional,
                          GROUP_CONCAT( distinct b.no_ncp_gabungan separator ', ' ) as no_ncp,
                          GROUP_CONCAT( distinct b.masalah_dominan separator ', ' ) as masalah_utama,
                          GROUP_CONCAT( distinct b.akar_masalah separator ', ' ) as akar_masalah,
                          GROUP_CONCAT( distinct b.solusi_panjang separator ', ' ) as solusi_panjang 
              FROM tbl_aftersales_now a 
              LEFT JOIN tbl_ncp_qcf_now b ON a.nodemand=b.nodemand 
              LEFT JOIN tbl_add_kpe_qcf c ON c.no_demand = a.nodemand
              WHERE a.no_order LIKE '%$Order%' AND a.po LIKE '%$PO%' AND a.no_hanger LIKE '%$Hanger%' AND a.langganan LIKE '%$Langganan%' AND a.nodemand LIKE '%$Demand%' AND a.nokk LIKE '%$Prodorder%' AND a.pejabat LIKE '%$Pejabat%' AND a.solusi LIKE '%$Solusi%' $Where $WhereKategori $stsclaim 
              -- WHERE a.no_order LIKE '%$Order%' AND a.po LIKE '%$PO%' AND a.no_hanger LIKE '%$Hanger%' AND a.langganan LIKE '%$Langganan%' AND a.nodemand LIKE '%$Demand%' AND a.nokk LIKE '%$Prodorder%' AND a.pejabat LIKE '%$Pejabat%' AND a.solusi LIKE '%$Solusi%' $Where $WhereKategori $stsred $stsclaim 
              GROUP BY a.nodemand, a.masalah_dominan
              ORDER BY a.id ASC");
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
          <tr bgcolor="<?php echo $bgcolor; ?>"
              data-nokk="<?= htmlspecialchars($row1['nokk']) ?>"
              data-nodemand="<?= htmlspecialchars($row1['nodemand']) ?>" 
              data-personil1-additional="<?= htmlspecialchars($row1['personil1_additional']) ?>"
              data-personil2-additional="<?= htmlspecialchars($row1['personil2_additional']) ?>"
              data-personil3-additional="<?= htmlspecialchars($row1['personil3_additional']) ?>"
              data-personil4-additional="<?= htmlspecialchars($row1['personil4_additional']) ?>"
              data-personil5-additional="<?= htmlspecialchars($row1['personil5_additional']) ?>"
              data-personil6-additional="<?= htmlspecialchars($row1['personil6_additional']) ?>"
              data-pejabat-additional="<?= htmlspecialchars($row1['pejabat_additional']) ?>" 
              data-shift1-additional="<?= htmlspecialchars($row1['shift1_additional']) ?>"
              data-shift2-additional="<?= htmlspecialchars($row1['shift2_additional']) ?>"
              data-hitung-additional="<?= htmlspecialchars($row1['hitung_additional']) ?>" 
              data-status-additional="<?= htmlspecialchars($row1['status_additional']) ?>" 
              data-analisis-additional="<?= htmlspecialchars($row1['analisis_additional']) ?>" 
              data-hasil-analisa-additional="<?= htmlspecialchars($row1['hasil_analisa_additional']) ?>">
            <td align="center"><?php echo $no; ?></td>
            <!-- <td align="center"><div class="btn-group">
            <a href="TambahBon-<?php echo $row1['id']; ?>-<?php echo $noorder; ?>" class="btn btn-warning btn-xs <?php if($_SESSION['akses']=='biasa' OR $_SESSION['lvl_id']!='AFTERSALES'){ echo "disabled"; } ?>" target="_blank"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Ganti Kain"></i> </a>
            <a href="TambahDetailRetur-<?php echo $row1['id']; ?>" class="btn btn-success btn-xs <?php if($_SESSION['akses']=='biasa' OR $_SESSION['lvl_id']!='AFTERSALES'){ echo "disabled"; } ?>" target="_blank"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Retur"></i> </a>
            <a href="TambahTPUKPE-<?php echo $row1['id']; ?>" class="btn btn-primary btn-xs <?php if($_SESSION['akses']=='biasa' OR $_SESSION['lvl_id']!='AFTERSALES'){ echo "disabled"; } ?>" target="_blank"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="TPUKPE"></i> </a>
            <a href="EditKPENew-<?php echo $row1['id']; ?>" class="btn btn-info btn-xs <?php if($_SESSION['akses']=='biasa' OR $_SESSION['lvl_id']!='AFTERSALES'){ echo "disabled"; } ?>" target="_blank"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i> </a>
            <a href="#" class="btn btn-danger btn-xs <?php if($_SESSION['akses']=='biasa' OR $_SESSION['lvl_id']!='AFTERSALES'){ echo "disabled"; } ?>" onclick="confirm_delete('./HapusDataKPE-<?php echo $row1['id'] ?>');"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Hapus"></i> </a>
            </div></td> -->
            <td align="center"><?php echo $row1['tgl_buat'];?></td>
            <?php 
              $pelanggan = explode('/', $row1['langganan'])[0]; 
              $buyer = explode('/', $row1['langganan'])[1];
            ?>

            <td><?php echo $pelanggan; ?></td>
            <td><?php echo $buyer; ?></td>

            <td align="center" class="rekap-link" style="cursor: pointer; color: blue; text-decoration: underline;"><?php echo $row1['nodemand']; ?></td>
            <td align="center" class="rekap-link-nokk" style="cursor: pointer; color: blue; text-decoration: underline;"><?php echo $row1['nokk']; ?></td>
            <td align="center"><?php echo $row1['po'];?></td>
            <!-- <td align="center"><?php echo $row1['no_item'];?></td> -->
            <td align="center"><?php echo $row1['no_order'];?></td>
            <td align="center" valign="top"><?php echo $row1['no_hanger'];?></td>
            <td><?php echo $row1['jenis_kain'];?></td>
            <td align="center"><?php echo $row1['lebar'];?></td>
            <td align="center"><?php echo $row1['gramasi'];?></td>
            <td align="center"><?php echo $row1['lot'];?></td>
            <td align="center"><?php echo $row1['warna'];?></td>
            <td align="right"><?php echo $row1['qty_order'];?></td>
            <td align="right"><?php echo $row1['qty_order2'];?></td>
            <td align="right"><?php echo $row1['qty_kirim'];?></td>
            <td align="right"><?php echo $row1['qty_kirim2'];?></td>
            <td align="right"><?php echo $row1['qty_claim'];?></td>
            <td align="right"><?php echo $row1['qty_claim2'];?></td>
            <td align="right"><?php echo $row1['qty_lolos'];?></td>
            <td align="center"><?php echo $tjawab;?></td>
            <td><?php echo $row1['masalah_dominan'];?></td>
            <td><?php echo $row1['masalah'];?></td>
            <td><?php echo $row1['penyebab'];?></td>
            <td><?php echo $row1['kategori'];?></td> <!-- route cause -->
            <!-- <td> -->
                <!-- <?php if($row1['solusi'] == "PERBAIKAN GARMENT") { ?> -->

                  <!-- <a href="#" id='' nsp-id="<?=$row1['id'];?>" class="detail_solusi_perbaikan_garment"><?php echo $row1['solusi'];?></a> -->
                  <!-- <a href="#" id='' nsp-id="<?=$row1['id'];?>" class="edit_detail_solusi_perbaikan_garment btn btn-info btn-xs">Edit</a> -->
                  <!-- <a href="#" id='' class="detail_solusi_perbaikan_garment" data-toggle="modal" data-target="#DataSolusi" data-no_item="<?php echo $row1['no_item']; ?>"><?php echo $row1['solusi'];?></a> -->
                
                <!-- <?php }elseif($row1['solusi'] == "DEBIT NOTE"){?> -->
                  <!-- <a href="#" id='' nsp-id="<?=$row1['id'];?>" class="detail_solusi_debit_note"><?php echo $row1['solusi'];?></a> -->
                  <!-- <a href="#" id='' nsp-id="<?=$row1['id'];?>" class="edit_detail_solusi_debit_note btn btn-info btn-xs">Edit</a> -->
                  
                <!-- <?php }else{?> -->
                  <!-- <?php echo $row1['solusi'];?> -->
                <!-- <?php }?> -->
            <!-- </td> -->
            <td><?php echo $row1['solusi']; ?></td>
                  <!-- <td><?php //echo $row1['solusi'];?></td> -->
            <td><?php echo $row1['klasifikasi'];?></td>
            <td><?php if($row1['personil2']!=""){echo $row1['personil'].",".$row1['personil2'];}else{echo $row1['personil'];}?></td>
            <td><?php echo $row1['pejabat'];?></td>
            <td><?php if($row1['sts']=="1"){echo "Lolos QC";}else if($row1['sts_disposisiqc']=="1"){echo "Disposisi QC";}else if($row1['sts_disposisipro']=="1"){echo "Disposisi Produksi";}?><?php if($row1['sts_nego']=="1"){echo ", Negosiasi Aftersales";}?></td>
            <td><?php if($row1['status_penghubung']=='terima'){
              echo '&#10004';
            }else if($row1['status_penghubung']=='tolak'){
              echo 'X';
            }else{
              echo '';
            }?></td>
            <td><?php echo $row1['no_ncp'];?></td>
            <td><?php echo $row1['masalah_utama'];?></td>
            <td><?php echo $row1['akar_masalah'];?></td>
            <td><?php echo $row1['solusi_panjang'];?></td>
            <td><?php echo $row1['ket'];?></td>
            <td class="edit-cell" style="cursor: pointer;"><?php echo $row1['personil_additional']; ?></td>
            <td class="edit-cell" style="cursor: pointer;"><?php echo $row1['pejabat_additional']; ?></td>
            <td class="edit-cell" style="cursor: pointer;"><?php if($row1['hitung_additional']=="terima"){
                                                                  echo "&#10004"; }
                                                                  else if($row1['hitung_additional']=="tolak"){
                                                                  echo "X"; }
                                                                  else{
                                                                  echo "";}?>
            </td>
            <td class="edit-cell" style="cursor: pointer;"><?php echo $row1['status_additional']; ?></td>
            <td class="edit-cell" style="cursor: pointer;"><?php echo $row1['analisis_additional']; ?></td>
            <td class="edit-cell" style="cursor: pointer;"><?php echo $row1['hasil_analisa_additional']; ?></td>
            <td class="edit-cell2" data-id="<?= $row1['id']; ?>" data-field="pengurangan_poin" data-value="<?= (int) $row1['pengurangan_poin']; ?>"
              style="cursor:pointer;">
              <?= (int) $row1['pengurangan_poin']; ?>
            </td>
            </tr>
          <?php	$no++;  }} ?>
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

<div class="modal fade" id="editKpeModal" tabindex="-1" role="dialog" aria-labelledby="editKpeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="editKpeForm">
                <div class="modal-header">
                    <h3 class="modal-title" id="editKpeModalLabel">Edit Data Tambahan KPE QCF</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="modal_no_demand" name="no_demand">
                    <input type="hidden" id="modal_no_kk" name="no_kk">

                    <?php 
                        // Menyiapkan opsi untuk Personil QC
                        $personil_options_html = '<option value="">-- Pilih Personil --</option>';
                        $qryp = mysqli_query($con, "SELECT UPPER(nama) AS nama FROM user_login WHERE dept ='QC' ORDER BY nama ASC");
                        while ($row_personil = mysqli_fetch_assoc($qryp)) {
                            $nama_personil = htmlspecialchars($row_personil['nama']);
                            $personil_options_html .= "<option value='{$nama_personil}'>{$nama_personil}</option>";
                        }

                        // Menyiapkan opsi untuk Pejabat
                        $personil_pejabat = '<option value="">-- Pilih Pejabat --</option>';
                        $qrypjbt = mysqli_query($con, "SELECT nama FROM tbl_personil_aftersales WHERE jenis='pejabat' ORDER BY nama ASC");
                        while ($row_personil_pejabat = mysqli_fetch_assoc($qrypjbt)) {
                            $nama_personil_pejabat = htmlspecialchars($row_personil_pejabat['nama']);
                            $personil_pejabat .= "<option value='{$nama_personil_pejabat}'>{$nama_personil_pejabat}</option>";
                        }
                    ?>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group"><label>Personil 1</label><select class="form-control select2"  id="modal_personil1_additional" name="personil1" style="width: 100%;"><?php echo $personil_options_html; ?></select></div>
                            <div class="form-group"><label>Personil 2</label><select class="form-control select2"  id="modal_personil2_additional" name="personil2" style="width: 100%;"><?php echo $personil_options_html; ?></select></div>
                            <div class="form-group"><label>Personil 3</label><select class="form-control select2"  id="modal_personil3_additional" name="personil3" style="width: 100%;"><?php echo $personil_options_html; ?></select></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label>Personil 4</label><select class="form-control select2"  id="modal_personil4_additional" name="personil4" style="width: 100%;"><?php echo $personil_options_html; ?></select></div>
                            <div class="form-group"><label>Personil 5</label><select class="form-control select2"  id="modal_personil5_additional" name="personil5" style="width: 100%;"><?php echo $personil_options_html; ?></select></div>
                            <div class="form-group"><label>Personil 6</label><select class="form-control select2"  id="modal_personil6_additional" name="personil6" style="width: 100%;"><?php echo $personil_options_html; ?></select></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label>Pejabat</label><select class="form-control select2" id="modal_pejabat" name="pejabat" style="width: 100%;"><?php echo $personil_pejabat; ?></select></div>
                            <div class="form-group"><label>Analisis</label><select class="form-control select2" id="modal_analisis" name="analisis" style="width: 100%;"><?php echo $personil_options_html; ?></select></div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group"><label>Hitung</label><select class="form-control select2" id="modal_hitung" name="hitung" style="width: 100%;"><option value="">Pilih</option><option value="terima">&#10004;</option><option value="tolak">X</option></select></div>
                            <div class="form-group"><label>Status</label><select class="form-control select2" id="modal_status" name="status" style="width: 100%;"><option value="">Pilih</option><option value="disposisi">Disposisi</option><option value="lolos">Lolos</option></select></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                 <div class="form-group"><label>Hasil Analisa</label><textarea class="form-control" id="modal_hasil_analisa" name="hasil_analisa" rows="3"></textarea></div>
                            </div>
                        </div>
                    </div>
                </div> <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form> </div>
    </div>
</div>
<!-- Create -->
<div id="DataSolusiPerbaikanGarment" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>	
<div id="DataSolusiDebitNote" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>	

<!-- Edit -->
<div id="EditDataSolusiPerbaikanGarment" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>	
<div id="EditDataSolusiDebitNote" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>	


<script>
$(document).ready(function () {
      $('.rekap-link').on('click', function() {
        var row = $(this).closest('tr');
        var nodemandValue = row.data('nodemand');

        var form = $('<form>', {
            'method': 'POST',
            'action': 'RekapData', 
            'target': '_blank'
        });

        form.append($('<input>', {
                    type: 'hidden', 
                    name: 'demand', 
                    value: nodemandValue
                  }));

        $('body').append(form);
        form.submit();
        form.remove();
    });
     $('.rekap-link-nokk').on('click', function() {
        var nokkValue = $(this).closest('tr').data('nokk');

        var form = $('<form>', {
            'method': 'POST',
            'action': 'RekapData', 
            'target': '_blank'
        });

        if (nokkValue) {
            var inputKK = $('<input>', {
                'type': 'hidden',
                'name': 'prodorder',
                'value': nokkValue
            });
            form.append(inputKK);
        }

        $('body').append(form);
        form.submit();
        form.remove();
    });
    $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    // Tombol edit
    $('.edit-cell').on('click', function() {
        var row = $(this).closest('tr');
        var data = {
            nodemand: row.data('nodemand'),
            kk: row.data('nokk'),
            personil1: row.data('personil1-additional'),
            personil2: row.data('personil2-additional'),
            personil3: row.data('personil3-additional'),
            personil4: row.data('personil4-additional'),
            personil5: row.data('personil5-additional'),
            personil6: row.data('personil6-additional'),
            pejabat: row.data('pejabat-additional'),
            shift1: row.data('shift1-additional'),
            shift2: row.data('shift2-additional'),
            hitung: row.data('hitung-additional'),
            status: row.data('status-additional'),
            analisis: row.data('analisis-additional'),
            hasil_analisa: row.data('hasil-analisa-additional')
        };

        // isi form modal
        $('#modal_no_demand').val(data.nodemand);
        $('#modal_no_kk').val(data.kk);
        $('#modal_personil1_additional').val(data.personil1).trigger('change');
        $('#modal_personil2_additional').val(data.personil2).trigger('change');
        $('#modal_personil3_additional').val(data.personil3).trigger('change');
        $('#modal_personil4_additional').val(data.personil4).trigger('change');
        $('#modal_personil5_additional').val(data.personil5).trigger('change');
        $('#modal_personil6_additional').val(data.personil6).trigger('change');
        $('#modal_pejabat').val(data.pejabat).trigger('change');
        $('#modal_shift1').val(data.shift1).trigger('change');
        $('#modal_shift2').val(data.shift2).trigger('change');
        $('#modal_hitung').val(data.hitung).trigger('change');
        $('#modal_status').val(data.status).trigger('change');
        $('#modal_analisis').val(data.analisis).trigger('change');
        $('#modal_hasil_analisa').val(data.hasil_analisa);

        // tampilkan modal
        $('#editKpeModal').modal('show');
    });

    // Submit form
    $('#editKpeForm').on('submit', function(e) {
        e.preventDefault();
        // console.log("Data yang akan dikirim:");
        // var formData = $(this).serialize(); 
        // console.log(formData);
        // alert("Data yang akan dikirim:\n\n" + formData);
        
        $.ajax({
            url: 'pages/ajax/update_personil_kpe.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
                $('#editKpeModal').modal('hide');
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Terjadi kesalahan saat menyimpan data: ' + textStatus);
                console.error(errorThrown);
            }
        });
        
    });
});
</script>



<script type="text/javascript">
    function confirm_delete(delete_url)
    {
      $('#modal_del').modal('show', {backdrop: 'static'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>	

<script>
function formatRupiah(input) {
  if(input.value != "") {
    // Menghilangkan tanda titik dan koma
    var value = input.value.replace(/[^\d]/g, '');

    // Mengonversi nilai menjadi angka
    var amount = parseInt(value);

    // Mengonversi angka menjadi format rupiah
    var formattedValue = amount.toLocaleString('id-ID');

    // Memasukkan nilai yang sudah diformat kembali ke dalam input field
    input.value = formattedValue;
  }
}
</script>

<script>
$(document).on('click', '.edit-cell2', function () {
  const $td = $(this);

  // kalau sedang edit, jangan bikin select lagi
  if ($td.find('select').length) return;

  const id = $td.data('id');
  const field = $td.data('field');  // nama kolom
  const current = String($td.data('value') ?? $td.text().trim());

  const options = [5,10,15,20,25,30];

  // buat select
  let $select = $('<select class="edit-select form-control" style="width:100%;"></select>');
  options.forEach(v => {
    $select.append(`<option value="${v}">${v}</option>`);
  });

  $select.val(current);

  const oldText = $td.text().trim();

  $td.empty().append($select);
  $select.focus();

  function saveValue(newVal) {
    $.ajax({
      url: 'pages/ajax/update_aftersales_now.php',
      method: 'POST',
      dataType: 'json',
      data: {
        id: id,
        field: field,
        value: newVal
      },
      success: function(res){
        if(res && res.status === 'ok'){
          $td.data('value', newVal);
          $td.text(newVal);
        } else {
          alert(res?.message || 'Gagal update');
          $td.text(oldText);
        }
      },
      error: function(xhr, textStatus){
        alert(
          "AJAX error: " + textStatus +
          "\nHTTP: " + xhr.status +
          "\nResponse:\n" + (xhr.responseText ? xhr.responseText.substring(0, 400) : "-")
        );
      }
    });
  }

  $select.on('change', function(){
    const newVal = $(this).val();
    saveValue(newVal);
  });

  $select.on('blur', function(){
    const valNow = $td.data('value') ?? oldText;
    $td.text(valNow);
  });
});
</script>
</body>

</html>