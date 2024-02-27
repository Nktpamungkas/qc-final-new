<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
    $modal_id=$_GET['id'];
	$modal=mysqli_query($con,"SELECT * FROM tbl_ganti_kain_now WHERE id='$modal_id' ");
while($r=mysqli_fetch_array($modal)){	
?>
          <div class="modal-dialog">
            <div class="modal-content">
            <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="EditBon" enctype="multipart/form-data">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Bon</h4>
              </div>
              <div class="modal-body">
              <input type="hidden" id="id" name="id" value="<?php echo $r['id'];?>">
              <input type="hidden" idnsp="idnsp" name="idnsp" value="<?php echo $r['id_nsp'];?>">
		<div class="form-group">
            <label for="penyebab" class="col-sm-3 control-label">Penyebab</label>
                <?php 
                  $dtArr=$r['sebab'];
                  $data = explode(",",$dtArr);
                ?>
			      <div class="col-sm-8">
            <div class="form-group">
              <label><input type="checkbox" class="minimal" name="penyebab[]" value="Man" <?php if(in_array("Man",$data)){echo "checked";} ?>> Man &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
              </label>
              <label><input type="checkbox" class="minimal" name="penyebab[]" value="Methode" <?php if(in_array("Methode",$data)){echo "checked";} ?>> Methode &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
              </label>
              <label><input type="checkbox" class="minimal" name="penyebab[]" value="Machine" <?php if(in_array("Machine",$data)){echo "checked";} ?>> Machine 
              </label>
            </div>
            <div class="form-group">
              <label><input type="checkbox" class="minimal" name="penyebab[]" value="Material" <?php if(in_array("Material",$data)){echo "checked";} ?>> Material &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
              </label>
              <label><input type="checkbox" class="minimal" name="penyebab[]" value="Environment" <?php if(in_array("Environment",$data)){echo "checked";} ?>> Environment
              </label>
              </label>
            </div>
            <!--<div class="input-group">
              <select class="form-control select2" multiple="multiple" data-placeholder=" Masalah" name="penyebab[]" style="width: 100%;">
                  <?php 
                  $dtArr=$r['sebab'];
                  $data = explode(",",$dtArr);
                  ?>
                <option value="Man" <?php if(in_array("Man",$data)){echo "SELECTED";} ?>>Man</option>
                <option value="Methode" <?php if(in_array("Methode",$data)){echo "SELECTED";} ?>>Methode</option>
                <option value="Machine" <?php if(in_array("Machine",$data)){echo "SELECTED";} ?>>Machine</option>
                <option value="Material" <?php if(in_array("Material",$data)){echo "SELECTED";} ?>>Material</option>
                <option value="Environment" <?php if(in_array("Environment",$data)){echo "SELECTED";} ?>>Environment</option>	  
              </select>
            </div>-->
			</div>  
		</div>		  
		<div class="form-group">
                  <label for="analisa" class="col-sm-3 control-label">Analisa</label>
			      <div class="col-sm-6">
                    <textarea name="analisa" class="form-control"><?php echo $r['analisa']; ?></textarea>
			</div>  
		</div>		  
		<div class="form-group">
                  <label for="pencegahan" class="col-sm-3 control-label">Pencegahan</label>
			      <div class="col-sm-6">
                    <textarea name="pencegahan" class="form-control"><?php echo $r['pencegahan']; ?></textarea>
			</div>		  
              </div>
      <div class="form-group">
        <label for="kg1" class="col-sm-3 control-label">Qty Nego</label>
        <div class="col-sm-4">
          <div class="input-group">
							<input name="kg1" type="text" class="form-control" id="kg1" value="<?php echo $r['kg1']; ?>" placeholder="0.00" style="text-align: right;">
							<span class="input-group-addon">Kg</span>	
					</div>
        </div>  
        <div class="col-sm-4">
          <div class="input-group">  
							<input name="pjg1" type="text" class="form-control" id="pjg1" value="<?php echo $r['pjg1']; ?>" placeholder="0.00" style="text-align: right;">
								<span class="input-group-addon">
									<select name="satuan1" style="font-size: 12px;" id="satuan1">
										<option value="Yard" <?php if($r['satuan1']=="Yard"){ echo "SELECTED"; }?>>Yard</option>
										<option value="Meter" <?php if($r['satuan1']=="Meter"){ echo "SELECTED"; }?>>Meter</option>
										<option value="PCS" <?php if($r['satuan1']=="PCS"){ echo "SELECTED"; }?>>PCS</option>
                    <option value="<?php echo $r['satuan1'];?>" <?php if($r['satuan1']!=""){ echo "SELECTED"; }?>><?php echo $r['satuan1'];?></option>
							  		</select>
								</span>	
					</div>
        </div>
		  </div>
      <div class="form-group">
        <label for="qty_email" class="col-sm-3 control-label">Qty Email</label>
        <div class="col-sm-4">
          <div class="input-group">
							<input name="qty_email" type="text" class="form-control" id="qty_email" value="<?php echo $r['qty_email']; ?>" placeholder="0.00" style="text-align: right;">
							<span class="input-group-addon">Kg</span>	
					</div>
        </div>  
        <div class="col-sm-4">
          <div class="input-group">  
							<input name="pjg_email" type="text" class="form-control" id="pjg_email" value="<?php echo $r['pjg_email']; ?>" placeholder="0.00" style="text-align: right;">
								<span class="input-group-addon">
									<select name="satuan_email" style="font-size: 12px;" id="satuan_email">
										<option value="Yard" <?php if($r['satuan_email']=="Yard"){ echo "SELECTED"; }?>>Yard</option>
										<option value="Meter" <?php if($r['satuan_email']=="Meter"){ echo "SELECTED"; }?>>Meter</option>
										<option value="PCS" <?php if($r['satuan_email']=="PCS"){ echo "SELECTED"; }?>>PCS</option>
                    <option value="<?php echo $r['satuan_email'];?>" <?php if($r['satuan_email']!=""){ echo "SELECTED"; }?>><?php echo $r['satuan_email'];?></option>
							  		</select>
								</span>	
					</div>
        </div>
		  </div>
      <div class="form-group">
        <label for="masalah" class="col-sm-3 control-label">Masalah</label>
        <div class="col-sm-8">
						<input name="masalah" type="text" class="form-control" id="masalah" value="<?php echo $r['masalah']; ?>" placeholder="">
        </div>  
      </div>
      <div class="form-group">
		  		<label for="sub_defect" class="col-sm-3 control-label">Sub Defect</label>
		 			<div class="col-sm-5">
						<select class="form-control select2" name="sub_defect" id="sub_defect">
							<option value="">Pilih</option>
							<?php 
							$qrym=mysqli_query($con,"SELECT masalah FROM tbl_masalah_aftersales ORDER BY masalah ASC");
							while($rm=mysqli_fetch_array($qrym)){
							?>
							<option value="<?php echo $rm['masalah'];?>" <?php if($r['sub_defect']==$rm['masalah']){echo "SELECTED";}?>><?php echo $rm['masalah'];?></option>	
							<?php }?>
						</select>
		 	 		</div>
		  	</div>
      <div class="form-group">
		  <label for="tangggung_jawab" class="col-sm-3 control-label">Tanggung Jawab 1</label>
        <div class="col-sm-4">
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
        </select>	
        </div>
		  <div class="col-sm-3">
                    <div class="input-group">  
					<input name="persen" type="text" class="form-control" id="persen" value="<?php echo $r['persen']; ?>" placeholder="0" style="text-align: right;">
					<span class="input-group-addon">%</span>	
					</div>
                  </div>	
		  </div>
		<div class="form-group">
		  <label for="tangggung_jawab" class="col-sm-3 control-label">Tanggung Jawab 2</label>		  
        <div class="col-sm-4">
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
        </select>	
        </div>
		  <div class="col-sm-3">
                    <div class="input-group">  
					<input name="persen1" type="text" class="form-control" id="persen1" value="<?php echo $r['persen1']; ?>" placeholder="0" style="text-align: right;">
					<span class="input-group-addon">%</span>	
					</div>
                  </div>	
		  </div>  
		<div class="form-group">
		  <label for="tangggung_jawab" class="col-sm-3 control-label">Tanggung Jawab 3</label>		  
        <div class="col-sm-4">
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
        </select>	
        </div>
		  		<div class="col-sm-3">
                    <div class="input-group">  
					<input name="persen2" type="text" class="form-control" id="persen2" value="<?php echo $r['persen2']; ?>" placeholder="0" style="text-align: right;">
					<span class="input-group-addon">%</span>	
					</div>
                  </div>	
		  </div>
      <!--<div class="form-group">
        <label for="kg2" class="col-sm-3 control-label">KG 2</label>
        <div class="col-sm-4">
          <div class="input-group">
							<input name="kg2" type="text" class="form-control" id="kg2" value="<?php echo $r['kg2']; ?>" placeholder="0.00" style="text-align: right;">
							<span class="input-group-addon">Kg</span>	
					</div>
        </div>
        <div class="col-sm-4">
          <div class="input-group">  
							<input name="pjg2" type="text" class="form-control" id="pjg2" value="<?php echo $r['pjg2']; ?>" placeholder="0.00" style="text-align: right;">
								<span class="input-group-addon">
									<select name="satuan2" style="font-size: 12px;" id="satuan2">
										<option value="Yard" <?php if($r['satuan2']=="Yard"){ echo "SELECTED"; }?>>Yard</option>
										<option value="Meter" <?php if($r['satuan2']=="Meter"){ echo "SELECTED"; }?>>Meter</option>
										<option value="PCS" <?php if($r['satuan2']=="PCS"){ echo "SELECTED"; }?>>PCS</option>
                    <option value="<?php echo $r['satuan2'];?>" <?php if($r['satuan2']!=""){ echo "SELECTED"; }?>><?php echo $r['satuan2'];?></option>
							  		</select>
								</span>	
					</div>
        </div>  
		  </div>
      <div class="form-group">
        <label for="kg3" class="col-sm-3 control-label">KG 3</label>
        <div class="col-sm-4">
          <div class="input-group">
							<input name="kg3" type="text" class="form-control" id="kg3" value="<?php echo $r['kg3']; ?>" placeholder="0.00" style="text-align: right;">
							<span class="input-group-addon">Kg</span>	
					</div>
        </div>
        <div class="col-sm-4">
          <div class="input-group">  
							<input name="pjg3" type="text" class="form-control" id="pjg3" value="<?php echo $r['pjg3']; ?>" placeholder="0.00" style="text-align: right;">
								<span class="input-group-addon">
									<select name="satuan3" style="font-size: 12px;" id="satuan3">
										<option value="Yard" <?php if($r['satuan3']=="Yard"){ echo "SELECTED"; }?>>Yard</option>
										<option value="Meter" <?php if($r['satuan3']=="Meter"){ echo "SELECTED"; }?>>Meter</option>
										<option value="PCS" <?php if($r['satuan3']=="PCS"){ echo "SELECTED"; }?>>PCS</option>
                    <option value="<?php echo $r['satuan3'];?>" <?php if($r['satuan3']!=""){ echo "SELECTED"; }?>><?php echo $r['satuan3'];?></option>
							  		</select>
								</span>	
					</div>
        </div>  
		  </div>-->
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Save</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
  </div>
          <!-- /.modal-dialog -->
          <?php } ?>
<script>
	$(function () {
    //Initialize Select2 Elements
	$('.select2').select2();
	}
	?>