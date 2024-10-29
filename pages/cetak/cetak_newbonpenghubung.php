<?php 
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";
 
if (isset($_POST['sql'])) { 
	$sql_code =  $_POST['sql'];
?>

<?php
$now = date("Ymdhis");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=reportbonpenghubung".$now.".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>



 <table border=1>
          <thead class="bg-blue">
            <tr>  
              <th rowspan=2><div align="center" valign="middle">DATE</div></th>
			  <th  rowspan=2><div align="center" valign="middle">CUSTOMER</div></th>
			  <th  rowspan=2><div align="center" valign="middle">PO</div></th>
			  <th  rowspan=2><div align="center" valign="middle">ORDER</div></th>
			   <th  rowspan=2><div align="center" valign="middle">HANGER</div></th>
			   <th  rowspan=2><div align="center" valign="middle">ITEM</div></th>
			   <th  rowspan=2><div align="center" valign="middle">COLOR</div></th>
			   <th  rowspan=2><div align="center" valign="middle">LOT</div></th>
			   <th  rowspan=2><div align="center" valign="middle">DEMAND</div></th>
			   
			   <th colspan=3 ><div align="center" valign="middle">QTY</div></th>
			   <th colspan=2 ><div align="center" valign="middle">QTY FOC</div></th>
			   <th colspan=2 ><div align="center" valign="middle">ESTIMASI FOC</div></th>

			   <th  rowspan=2><div align="center" valign="middle">ISSUE</div></th>
			   <th  rowspan=2><div align="center" valign="middle">NOTES</div></th>
			   <th  rowspan=2><div align="center" valign="middle">ADVICE FROM PRODUCTION/QC</div></th>
			   <th  rowspan=2><div align="center" valign="middle">RESPONSIBILITY</div></th>
			 
			   
			   
            </tr>
			<tr>  
              
			    <th><div align="center" valign="middle">ROLL</div></th>
				<th><div align="center" valign="middle">KG</div></th>
				<th><div align="center" valign="middle">YARD</div></th>
				
				<th><div align="center" valign="middle">KG</div></th>
				<th><div align="center" valign="middle">YARD</div></th>

				<!-- ESTIMASI -->
				<th><div align="center" valign="middle">KG</div></th>
				<th><div align="center" valign="middle">YARD</div></th>
				
            </tr>
         
          </thead>
          <tbody>
          <?php
            $no=1;
           
			 $sql=mysqli_query($con,$sql_code);
			
				  ?>
				 
			<?php 
                while($row1=mysqli_fetch_array($sql)){
                  $dtArr=$row1['t_jawab'];
                  $data = explode(",",$dtArr);
                  $dtArr1=$row1['persen'];
                  $data1 = explode(",",$dtArr1);
				  
				 if ($row1['penghubung_dep_persen'] !='') {
					 $array_persen = array();
					  $arrayA = explode(',', $row1['penghubung_dep_persen']);
						foreach ($arrayA as $element) {
							 $array_persen[] = $element ;
						}
				  }
				  
				  
				  
				  
				  
				  
				   
              ?>
              
		 
          <tr bgcolor="<?php echo $bgcolor; ?>">
            <td align="center"><?php echo $row1['tgl_masuk'];?></td>
			<td align="center"><?php echo $row1['pelanggan'];?></td>
			 <td align="center"><?php echo $row1['no_po'];?></td>
			 <td align="center"><?php echo $row1['no_order'];?></td>
			 <td align="center"><?php echo $row1['no_hanger'];?></td>
			  <td align="center"><?php echo $row1['no_item'];?></td>
			  <td align="center"><?php echo $row1['warna'];?></td>
			  <td align="center"><?php echo $row1['lot'];?></td>
			  <td align="center"><?php echo $row1['nodemand'];?></td>
			  <td align="center"><?php echo $row1['penghubung_roll1'];?></td>
			  <td align="center"><?php echo $row1['penghubung_roll2'];?></td>
			  <td align="center"><?php echo $row1['penghubung_roll3'];?></td>

        	  
        	  <td align="center"><?php echo $row1['berat_extra'];?></td>
			  <td align="center"><?php echo $row1['panjang_extra'];?></td>
			  <!-- <td align="center"><?php echo $row1['penghubung_foc3'];?></td> -->

			  <!-- ESTIMASI -->
        	  <td align="center"><?php echo $row1['estimasi'];?></td>
			  <td align="center"><?php echo $row1['panjang_estimasi'];?></td>

			   <td align="center"><?php echo $row1['penghubung_masalah'];?></td>
			    <td align="center"><?php echo $row1['penghubung_keterangan'];?></td>
                <td align="center"><?php echo $row1['advice1'];?></td>
				<td align="center">
				<?php if ($row1['penghubung_dep'] !='') {
						$arrayA = explode(',', $row1['penghubung_dep']);
						$no_depp = 1;
						foreach ($arrayA as $key=>$element) {			
							if (array_key_exists($key,$array_persen )) {
								
								if ($no_depp >=2) {
									echo ',';
								}
								
								echo $element.' ' ;
								echo $array_persen [$key];
								
								
								echo ' ';
								
							}
						$no_depp++;
						}
				  }   ?>
				</td>

          </tr>
		  
		  <?php if($row1['penghubung2_roll1'] and  $row1['penghubung2_roll1'] !='')  
		  {  
		  ?>
		  
		  
		  <tr bgcolor="<?php echo $bgcolor; ?>">
            <td align="center"><?php echo $row1['tgl_masuk'];?></td>
			<td align="center"><?php echo $row1['pelanggan'];?></td>
			 <td align="center"><?php echo $row1['no_po'];?></td>
			 <td align="center"><?php echo $row1['no_order'];?></td>
			 <td align="center"><?php echo $row1['no_hanger'];?></td>
			  <td align="center"><?php echo $row1['no_item'];?></td>
			  <td align="center"><?php echo $row1['warna'];?></td>
			  <td align="center"><?php echo $row1['lot'];?></td>
			  <td align="center"><?php echo $row1['nodemand'];?></td>
			  <td align="center"><?php echo $row1['penghubung2_roll1'];?></td>
			  <td align="center"><?php echo $row1['penghubung2_roll2'];?></td>
			  <td align="center"><?php echo $row1['penghubung2_roll3'];?></td>
			   
			 <!-- Tambahan -->
			 <!-- <td align="center"><?php echo $row1['berat_extra'];?></td> --> <td></td>
			  <!-- <td align="center"><?php echo $row1['panjang_extra'];?></td> --> <td></td>
			  <!-- <td align="center"><?php echo $row1['penghubung_foc3'];?></td> -->

				<!-- ESTINASI -->
				<td align="center"></td>
				<td align="center"></td>

			  <td align="center"><?php echo $row1['penghubung2_masalah'];?></td>
			    <td align="center"><?php echo $row1['penghubung2_keterangan'];?></td>
                <td align="center"><?php echo $row1['advice2'];?></td>
				<td align="center">
				<?php if ($row1['penghubung2_dep'] !='') {
						$arrayA = explode(',', $row1['penghubung2_dep']);
						$no_depp = 1;
						foreach ($arrayA as $key=>$element) {			
							if (array_key_exists($key,$array_persen )) {
								
								if ($no_depp >=2) {
									echo ',';
								}
								
								echo $element.' ' ;
								echo $array_persen [$key];
								
								
								echo ' ';
								
							}
						$no_depp++;
						}
				  }   ?>
				</td>	 										 
          </tr>
		  
		  
		  <?php  } ?>
		  
		  
		   <?php if($row1['penghubung3_roll1'] and  $row1['penghubung3_roll1'] !='')  
		  {  
		  ?>
		  
		  
		   < bgcolor="<?php echo $bgcolor; ?>">
            <td align="center"><?php echo $row1['tgl_masuk'];?></td>
			<td align="center"><?php echo $row1['pelanggan'];?></td>
			 <td align="center"><?php echo $row1['no_po'];?></td>
			 <td align="center"><?php echo $row1['no_order'];?></td>
			 <td align="center"><?php echo $row1['no_hanger'];?></td>
			  <td align="center"><?php echo $row1['no_item'];?></td>
			  <td align="center"><?php echo $row1['warna'];?></td>
			  <td align="center"><?php echo $row1['lot'];?></td>
			  <td align="center"><?php echo $row1['nodemand'];?></td>
			  <td align="center"><?php echo $row1['penghubung3_roll1'];?></td>
			  <td align="center"><?php echo $row1['penghubung3_roll2'];?></td>
			  <td align="center"><?php echo $row1['penghubung3_roll3'];?></td>
			 <!-- Tambahan -->
			 <!-- <td align="center"><?php echo $row1['berat_extra'];?></td> --> <td></td>
			  <!-- <td align="center"><?php echo $row1['panjang_extra'];?></td> --> <td></td>
			  <!-- <td align="center"><?php echo $row1['penghubung_foc3'];?></td> -->

			  <!-- ESTINASI -->
				<td align="center"></td>
				<td align="center"></td>

			  <td align="center"><?php echo $row1['penghubung3_masalah'];?></td>
			    <td align="center"><?php echo $row1['penghubung3_keterangan'];?></td>
                <td align="center"><?php echo $row1['advice3'];?></td>
				<td align="center">
				<?php if ($row1['penghubung3_dep'] !='') {
						$arrayA = explode(',', $row1['penghubung3_dep']);
						$no_depp = 1;
						foreach ($arrayA as $key=>$element) {			
							if (array_key_exists($key,$array_persen )) {
								
								if ($no_depp >=2) {
									echo ',';
								}
								
								echo $element.' ' ;
								echo $array_persen [$key];
								
								
								echo ' ';
								
							}
						$no_depp++;
						}
				  }   ?>
				</td>										 
          </tr>
		  
		  <?php  } ?>
		  
		  
		  
		  
          <?php	$no++;  } ?>
        </tbody>
      </table>
	  


































<?php }
?>