<?php
session_start();
include "../koneksi.php";

$modal_id=$_GET['id'];
$modal=mysqli_query($con,"SELECT
								a.*,
								b.qty_claim,
								b.satuan_c,
								b.qty_claim2,
								b.satuan_c2
							from
								tbl_tpukpe_now a
							left join tbl_aftersales_now b
							on a.id_nsp = b.id
							where
								a.id = '$modal_id'
							limit 1 ");

$r=mysqli_fetch_array($modal);

if($r['qty'] != "") {
	$kg = $r['qty'];
}
//  else {
// 	$kg = strtoupper($r['satuan_c']) == 'KG' ? $r['qty_claim'] : '';
// }

if($r['qty2'] != "") {
	$yd = $r['qty2'];
} 
// else {
// 	$yd = strtoupper($r['satuan_c2']) == 'YD' ? $r['qty_claim2'] : '';
// }

$tgl_packing = (!empty($r['tgl_packing']) && $r['tgl_packing'] != '0000-00-00') ? $r['tgl_packing'] : '';
$tgl_kpe 	 = (!empty($r['tgl_kpe']) 	  && $r['tgl_kpe'] != '0000-00-00')     ? $r['tgl_kpe'] : '';
$tgl_conform = (!empty($r['tgl_conform']) && $r['tgl_conform'] != '0000-00-00') ? $r['tgl_conform'] : '';
$serah_qai	 = (!empty($r['serah_qai'])   && $r['serah_qai'] != '0000-00-00')   ? $r['serah_qai'] : '';
?>

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
	<input type="hidden" id="id" name="id" value="<?php echo $r['id'];?>">
	<input type="hidden" idnsp="idnsp" name="idnsp" value="<?php echo $r['id_nsp'];?>">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Edit TPUKPE</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i
						class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-body">

			<div class="col-md-6">

				<div class="form-group">
                	<label for="status" class="col-sm-2 control-label">Status Masalah</label>
                  	<div class="col-sm-6">
						<select name="status" class="form-control select2" id="status" onChange="tampil();">
                            <option value="">Pilih</option>
							<option value="Selesai" <?php if($r['status']=="Selesai"){ echo "SELECTED"; }?>>Selesai</option>
							<option value="Belum Selesai : Rapat Tinjauan Manajemen" <?php if($r['status']=="Belum Selesai : Rapat Tinjauan Manajemen"){ echo "SELECTED"; }?>>Belum Selesai : Rapat Tinjauan Manajemen</option>
							<option value="Belum Selesai : Dibukakan KPI" <?php if($r['status']=="Belum Selesai : Dibukakan KPI"){ echo "SELECTED"; }?>>Belum Selesai : Dibukakan KPI</option>
                            <option value="Belum Selesai : Dibukakan FT" <?php if($r['status']=="Belum Selesai : Dibukakan FT"){ echo "SELECTED"; }?>>Belum Selesai : Dibukakan FT</option>
                            <option value="Belum Selesai : Lihat FT/KPI/KPE" <?php if($r['status']=="Belum Selesai : Lihat FT/KPI/KPE"){ echo "SELECTED"; }?>>Belum Selesai : Lihat FT/KPI/KPE</option>
						</select>
                  	</div>
                </div>

				<div class="form-group">
                    <label for="tgl_packing" class="col-sm-2 control-label">Tgl Packing</label>
                        <div class="col-sm-4">					  
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                    <input name="tgl_packing" type="text" class="form-control pull-right" id="datepicker1" placeholder="0000-00-00" value="<?php echo $tgl_packing;?>" />
                            </div>
                        </div>
                        <label for="tgl_kpe" class="col-sm-2 control-label">Tgl KPE</label>
                        <div class="col-sm-4">					  
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                    <input name="tgl_kpe" type="text" class="form-control pull-right" id="datepicker2" placeholder="0000-00-00" value="<?php echo $tgl_kpe;?>" />
                            </div>
                        </div>	
                </div>
                <div class="form-group">
                    <label for="tgl_conform" class="col-sm-2 control-label">Tgl Conform</label>
					<div class="col-sm-4">					  
						<div class="input-group date">
							<div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
							<input name="tgl_conform" type="text" class="form-control pull-right" id="datepicker3" placeholder="0000-00-00" value="<?php echo $tgl_conform;?>" />
						</div>
					</div>	
                </div>
                <div class="form-group">
                    <label for="serah_qai" class="col-sm-2 control-label">Penyerahan ke QAI</label>
					<div class="col-sm-4">					  
						<div class="input-group date">
							<div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
							<input name="serah_qai" type="text" class="form-control pull-right" id="datepicker" placeholder="0000-00-00" value="<?php echo $serah_qai;?>" />
						</div>
					</div>	
                </div>
                <div class="form-group">
                    <label for="qty" class="col-sm-2 control-label">Qty (KG)</label>
					<div class="col-sm-4">
						<input name="qty" type="text" class="form-control" id="qty" value="<?php echo $kg ?>" placeholder="0.00">
						<!-- <input name="qty" type="text" class="form-control" id="qty"  placeholder="0.00"> -->
					</div>
                </div>
                <div class="form-group">
                    <label for="qty2" class="col-sm-2 control-label">Qty (Yard)</label>
					<div class="col-sm-4">
						<input name="qty2" type="text" class="form-control" id="qty2" value="<?php echo $yd ?>" placeholder="0.00">
						<!-- <input name="qty2" type="text" class="form-control" id="qty2"  placeholder="0.00"> -->
					</div>
                </div>
                <div class="form-group">
                    <label for="masalah" class="col-sm-2 control-label">Masalah</label>
					<div class="col-sm-8">
						<textarea name="masalah" class="form-control" id="masalah" placeholder="" rows="3"><?php echo $r['masalah']; ?></textarea>
					</div>
                </div>
                
			</div>

			<div class="col-md-6">

				<div class="form-group">
                    <label for="masalah_dominan" class="col-sm-2 control-label">Sub Defect</label>
					<div class="col-sm-5">
						<select class="form-control select2" name="masalah_dominan" id="masalah_dominan">
							<option value="">Pilih</option>
							<?php 
							$qrym=mysqli_query($con,"SELECT masalah FROM tbl_masalah_aftersales ORDER BY masalah ASC");
							while($rm=mysqli_fetch_array($qrym)){
							?>
							<option value="<?php echo $rm['masalah'];?>" <?php if($r['masalah_dominan']==$rm['masalah']){echo "SELECTED";}?>><?php echo $rm['masalah'];?></option>	
							<?php }?>
						</select>
					</div>
		  	    </div>
				<div class="form-group">
					<label for="t_jawab" class="col-sm-2 control-label">Dept. T. Jawab 1</label>
					<div class="col-sm-5">
						<select class="form-control select2" name="t_jawab">
							<option value="">Pilih</option>
							<option value="MKT" <?php if($r['t_jawab']=="MKT"){echo "SELECTED";}?>>MKT</option>
							<option value="FIN" <?php if($r['t_jawab']=="FIN"){echo "SELECTED";}?>>FIN</option>
							<option value="DYE" <?php if($r['t_jawab']=="DYE"){echo "SELECTED";}?>>DYE</option>
							<option value="KNT" <?php if($r['t_jawab']=="KNT"){echo "SELECTED";}?>>KNT</option>
							<option value="LAB" <?php if($r['t_jawab']=="LAB"){echo "SELECTED";}?>>LAB</option>
							<option value="PRT" <?php if($r['t_jawab']=="PRT"){echo "SELECTED";}?>>PRT</option>
							<option value="KNK" <?php if($r['t_jawab']=="KNK"){echo "SELECTED";}?>>KNK</option>
							<option value="QCF" <?php if($r['t_jawab']=="QCF"){echo "SELECTED";}?>>QCF</option>
							<option value="GKG" <?php if($r['t_jawab']=="GKG"){echo "SELECTED";}?>>GKG</option>
							<option value="PRO" <?php if($r['t_jawab']=="PRO"){echo "SELECTED";}?>>PRO</option>
							<option value="RMP" <?php if($r['t_jawab']=="RMP"){echo "SELECTED";}?>>RMP</option>
							<option value="PPC" <?php if($r['t_jawab']=="PPC"){echo "SELECTED";}?>>PPC</option>
							<option value="TAS" <?php if($r['t_jawab']=="TAS"){echo "SELECTED";}?>>TAS</option>
							<option value="GKJ" <?php if($r['t_jawab']=="GKJ"){echo "SELECTED";}?>>GKJ</option>
							<option value="BRS" <?php if($r['t_jawab']=="BRS"){echo "SELECTED";}?>>BRS</option>
							<option value="CST" <?php if($r['t_jawab']=="CST"){echo "SELECTED";}?>>CST</option>
							<option value="GAS" <?php if($r['t_jawab']=="GAS"){echo "SELECTED";}?>>GAS</option>
							<option value="YND" <?php if($r['t_jawab']=="YND"){echo "SELECTED";}?>>YND</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="t_jawab1" class="col-sm-2 control-label">Dept. T. Jawab 2</label>
					<div class="col-sm-5">
						<select class="form-control select2" name="t_jawab1">
							<option value="">Pilih</option>
							<option value="MKT" <?php if($r['t_jawab1']=="MKT"){echo "SELECTED";}?>>MKT</option>
							<option value="FIN" <?php if($r['t_jawab1']=="FIN"){echo "SELECTED";}?>>FIN</option>
							<option value="DYE" <?php if($r['t_jawab1']=="DYE"){echo "SELECTED";}?>>DYE</option>
							<option value="KNT" <?php if($r['t_jawab1']=="KNT"){echo "SELECTED";}?>>KNT</option>
							<option value="LAB" <?php if($r['t_jawab1']=="LAB"){echo "SELECTED";}?>>LAB</option>
							<option value="PRT" <?php if($r['t_jawab1']=="PRT"){echo "SELECTED";}?>>PRT</option>
							<option value="KNK" <?php if($r['t_jawab1']=="KNK"){echo "SELECTED";}?>>KNK</option>
							<option value="QCF" <?php if($r['t_jawab1']=="QCF"){echo "SELECTED";}?>>QCF</option>
							<option value="GKG" <?php if($r['t_jawab1']=="GKG"){echo "SELECTED";}?>>GKG</option>
							<option value="PRO" <?php if($r['t_jawab1']=="PRO"){echo "SELECTED";}?>>PRO</option>
							<option value="RMP" <?php if($r['t_jawab1']=="RMP"){echo "SELECTED";}?>>RMP</option>
							<option value="PPC" <?php if($r['t_jawab1']=="PPC"){echo "SELECTED";}?>>PPC</option>
							<option value="TAS" <?php if($r['t_jawab1']=="TAS"){echo "SELECTED";}?>>TAS</option>
							<option value="GKJ" <?php if($r['t_jawab1']=="GKJ"){echo "SELECTED";}?>>GKJ</option>
							<option value="BRS" <?php if($r['t_jawab1']=="BRS"){echo "SELECTED";}?>>BRS</option>
							<option value="CST" <?php if($r['t_jawab1']=="CST"){echo "SELECTED";}?>>CST</option>
							<option value="GAS" <?php if($r['t_jawab1']=="GAS"){echo "SELECTED";}?>>GAS</option>
							<option value="YND" <?php if($r['t_jawab1']=="YND"){echo "SELECTED";}?>>YND</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="t_jawab2" class="col-sm-2 control-label">Dept. T. Jawab 3</label>
					<div class="col-sm-5">
						<select class="form-control select2" name="t_jawab2">
							<option value="">Pilih</option>
							<option value="MKT" <?php if($r['t_jawab2']=="MKT"){echo "SELECTED";}?>>MKT</option>
							<option value="FIN" <?php if($r['t_jawab2']=="FIN"){echo "SELECTED";}?>>FIN</option>
							<option value="DYE" <?php if($r['t_jawab2']=="DYE"){echo "SELECTED";}?>>DYE</option>
							<option value="KNT" <?php if($r['t_jawab2']=="KNT"){echo "SELECTED";}?>>KNT</option>
							<option value="LAB" <?php if($r['t_jawab2']=="LAB"){echo "SELECTED";}?>>LAB</option>
							<option value="PRT" <?php if($r['t_jawab2']=="PRT"){echo "SELECTED";}?>>PRT</option>
							<option value="KNK" <?php if($r['t_jawab2']=="KNK"){echo "SELECTED";}?>>KNK</option>
							<option value="QCF" <?php if($r['t_jawab2']=="QCF"){echo "SELECTED";}?>>QCF</option>
							<option value="GKG" <?php if($r['t_jawab2']=="GKG"){echo "SELECTED";}?>>GKG</option>
							<option value="PRO" <?php if($r['t_jawab2']=="PRO"){echo "SELECTED";}?>>PRO</option>
							<option value="RMP" <?php if($r['t_jawab2']=="RMP"){echo "SELECTED";}?>>RMP</option>
							<option value="PPC" <?php if($r['t_jawab2']=="PPC"){echo "SELECTED";}?>>PPC</option>
							<option value="TAS" <?php if($r['t_jawab2']=="TAS"){echo "SELECTED";}?>>TAS</option>
							<option value="GKJ" <?php if($r['t_jawab2']=="GKJ"){echo "SELECTED";}?>>GKJ</option>
							<option value="BRS" <?php if($r['t_jawab2']=="BRS"){echo "SELECTED";}?>>BRS</option>
							<option value="CST" <?php if($r['t_jawab2']=="CST"){echo "SELECTED";}?>>CST</option>
							<option value="GAS" <?php if($r['t_jawab2']=="GAS"){echo "SELECTED";}?>>GAS</option>
							<option value="YND" <?php if($r['t_jawab2']=="YND"){echo "SELECTED";}?>>YND</option>
						</select>
					</div>
				</div> 
                <div class="form-group">
                	<label for="penyelidik_qcf" class="col-sm-2 control-label">Penyelidikan Dept. QCF</label>
                  	<div class="col-sm-8">
                    	<textarea name="penyelidik_qcf" class="form-control" id="penyelidik_qcf" placeholder="" rows="3"><?php echo $r['penyelidik_qcf']; ?></textarea>
                  	</div>
                </div>
                <div class="form-group">
                	<label for="cegah_qcf" class="col-sm-2 control-label">Tindakan Pencegahan Dept. QCF</label>
                  	<div class="col-sm-8">
                    	<textarea name="cegah_qcf" class="form-control" id="cegah_qcf" placeholder="" rows="3"><?php echo $r['cegah_qcf']; ?></textarea>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="ket" class="col-sm-2 control-label">Keterangan</label>
					<div class="col-sm-8">
						<textarea name="ket" rows="3" class="form-control" id="ket" placeholder="Keterangan"><?php echo $r['ket']; ?></textarea>
					</div>				   
			    </div>

			</div>

		</div>

		<div class="box-footer">
			<button type="submit" class="btn btn-primary pull-right" name="save" value="save"><i class="fa fa-save"></i> Save</button>
		</div>
		<!-- /.box-footer -->
	</div>
</form>

<?php
$idnsp=$_POST['idnsp'];

if ($_POST) {
	$id 			= mysqli_real_escape_string($con, $_POST['id']);
	$status 		= str_replace("'", "''", $_POST['status']);
	$tgl_packing 	= $_POST['tgl_packing'];
	$serah_qai 		= $_POST['serah_qai'];
	$ket 		 	= str_replace("'", "''", $_POST['ket']);
	$masalah 	 	= str_replace("'", "''", $_POST['masalah']);
	$penyelidik_qcf = str_replace("'", "''", $_POST['penyelidik_qcf']);
	$tgl_kpe 		= str_replace("'", "''", $_POST['tgl_kpe']);
	$tgl_conform 	= str_replace("'", "''", $_POST['tgl_conform']);
	$cegah_qcf 		= str_replace("'", "''", $_POST['cegah_qcf']);
	$kpi 			= str_replace("'", "''", $_POST['no_kpi']);
	$ft 			= str_replace("'", "''", $_POST['no_ft']);
	$kpe 			= str_replace("'", "''", $_POST['no_kpe']);
	$qty 			= str_replace("'", "''", $_POST['qty']); // ini qty kg claim
	$qty2 			= str_replace("'", "''", $_POST['qty2']); // ini qty yard claim

	$sqlupdate = mysqli_query($con, "UPDATE tbl_tpukpe_now SET
										status='$status',
										masalah='$masalah',
										tgl_packing='$tgl_packing',
										serah_qai='$serah_qai',
										ket='$ket',
										penyelidik_qcf='$penyelidik_qcf',
										cegah_qcf='$cegah_qcf',
										tgl_kpe='$tgl_kpe',
										tgl_conform='$tgl_conform',
										qty='$qty',
										qty2='$qty2',
										masalah_dominan='$_POST[masalah_dominan]',
										t_jawab='$_POST[t_jawab]',
										t_jawab1='$_POST[t_jawab1]',
										t_jawab2='$_POST[t_jawab2]',
										tgl_update=now()
									WHERE id='$id' LIMIT 1");
	echo "<script>
			swal({
      			title: 'Data Telah diUbah',
      			text: 'Klik Ok untuk melanjutkan',
      			type: 'success',
      		}).then((result) => {
      			if (result.value) {
        			// window.location='LapTPUKPE';
					window.close();
      			}
    		});
		</script>";
}
?>