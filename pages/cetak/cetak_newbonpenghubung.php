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
         		<th colspan=2 ><div align="center" valign="middle">QTY SISA</div></th>  
			   <th  rowspan=2><div align="center" valign="middle">ISSUE</div></th>
			   <th  rowspan=2><div align="center" valign="middle">NOTES</div></th>
			   <th  rowspan=2><div align="center" valign="middle">ADVICE FROM PRODUCTION/QC</div></th>
			   <th  rowspan=2><div align="center" valign="middle">RESPONSIBILITY</div></th>
			   <th colspan=3 ><div align="center" valign="middle">QTY KIRIM</div></th>
			 
			   
			   
            </tr>
			<tr>  
              
			    <th><div align="center" valign="middle">ROLL</div></th>
				<th><div align="center" valign="middle">KG</div></th>
				<th><div align="center" valign="middle">YARD</div></th>
				
				<th><div align="center" valign="middle">KG</div></th>
				<th><div align="center" valign="middle">YARD</div></th>

        		<th><div align="center" valign="middle">KG</div></th>
				<th><div align="center" valign="middle">YARD</div></th>

        		<th><div align="center" valign="middle">ROLL</div></th>
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

        		<!-- Nanti ganti -->
        	 <td align="center"><?php echo $row1['qty_sisa'];?></td>
			  <td align="center"><?php echo $row1['satuan_sisa'];?></td>

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
				        <!-- // QTY KIRIM UNTUK YANG FOC -->
						<?php
            $q_ket_foc  = db2_exec($conn1, "SELECT 
                                                COUNT(QUALITYREASONCODE) AS ROLL,
                                                SUM(FOC_KG) AS KG,
                                                SUM(FOC_YARDMETER) AS YARD_MTR,
                                                KET_YARDMETER
                                            FROM
                                                ITXVIEW_SURATJALAN_EXIM2A
                                            WHERE 
                                                QUALITYREASONCODE = 'FOC'
                                                AND PROVISIONALCODE = '$rowdb2[PROVISIONALCODE]'
                                            GROUP BY 
                                                KET_YARDMETER");
            $d_ket_foc  = db2_fetch_assoc($q_ket_foc);
        ?>
        <td><?= number_format($d_ket_foc['KG'], 2); ?></td> 
        <td><?= number_format($d_ket_foc['YARD_MTR'], 2); ?></td> 



        <!-- // QTY KIRIM UNTUK YANG BUKAN FOC -->
        <?php
            if($rowdb2['CODE'] == 'EXPORT'){
                // <!-- UNTUK YANG EXPORT -->
                $q_roll     = db2_exec($conn1, "SELECT
                                                    ise.ITEMTYPEAFICODE,
                                                    COUNT(ise.COUNTROLL) AS ROLL,
                                                    SUM(ise.QTY_KG) AS QTY_SJ_KG,
                                                    SUM(ise.QTY_YARDMETER) AS QTY_SJ_YARD,
                                                    inpe.PROJECT,
                                                    ise.ADDRESSEE,
                                                    ise.BRAND_NM
                                                FROM
                                                    ITXVIEW_SURATJALAN_EXIM2A ise 
                                                LEFT JOIN ITXVIEW_NO_PROJECTS_EXIM inpe ON inpe.PROVISIONALCODE = ise.PROVISIONALCODE 
                                                WHERE 
                                                    ise.PROVISIONALCODE = '$rowdb2[PROVISIONALCODE]' AND ise.ITEMTYPEAFICODE = '$rowdb2[ITEMTYPEAFICODE]'
                                                GROUP BY 
                                                    ise.ITEMTYPEAFICODE,
                                                    inpe.PROJECT,
                                                    ise.ADDRESSEE,
                                                    ise.BRAND_NM");
                $d_roll     = db2_fetch_assoc($q_roll);
                if($d_ket_foc['ROLL'] > 0 AND $d_ket_foc['KG'] > 0 AND $d_ket_foc['YARD_MTR'] > 0) { // MENGHITUNG JIKA FOC SEBAGIAN, MAKA ROLL UNTUK FOC DIPISAH DARI KESELURUHAN
                    echo $d_roll['ROLL'] - $d_ket_foc['ROLL'];
                }else{
                    echo $d_roll['ROLL'];
                }
            }else{
                // <!-- UNTUK YANG LOCAL -->
                $q_roll     = db2_exec($conn1, "SELECT COUNT(CODE) AS ROLL,
                                                        SUM(BASEPRIMARYQUANTITY) AS QTY_SJ_KG,
                                                        SUM(BASESECONDARYQUANTITY) AS QTY_SJ_YARD,
                                                        LOTCODE
                                                FROM 
                                                    ITXVIEWALLOCATION0 
                                                WHERE 
                                                    CODE = '$rowdb2[CODE]' AND LOTCODE = '$rowdb2[LOTCODE]'
                                                GROUP BY 
                                                    LOTCODE");
                $d_roll     = db2_fetch_assoc($q_roll);
                echo $d_roll['ROLL'];
            }
        ?>
        <td><?= number_format($d_roll['QTY_SJ_KG'], 2); ?></td>

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

        <!-- Nanti ganti -->
        <td align="center"><?php echo $row1['qty_sisa'];?></td>
			  <td align="center"><?php echo $row1['satuan_sisa'];?></td>

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
				        <!-- // QTY KIRIM UNTUK YANG FOC -->
						<?php
            $q_ket_foc  = db2_exec($conn1, "SELECT 
                                                COUNT(QUALITYREASONCODE) AS ROLL,
                                                SUM(FOC_KG) AS KG,
                                                SUM(FOC_YARDMETER) AS YARD_MTR,
                                                KET_YARDMETER
                                            FROM
                                                ITXVIEW_SURATJALAN_EXIM2A
                                            WHERE 
                                                QUALITYREASONCODE = 'FOC'
                                                AND PROVISIONALCODE = '$rowdb2[PROVISIONALCODE]'
                                            GROUP BY 
                                                KET_YARDMETER");
            $d_ket_foc  = db2_fetch_assoc($q_ket_foc);
        ?>
        <td><?= number_format($d_ket_foc['KG'], 2); ?></td> 
        <td><?= number_format($d_ket_foc['YARD_MTR'], 2); ?></td> 



        <!-- // QTY KIRIM UNTUK YANG BUKAN FOC -->
        <?php
            if($rowdb2['CODE'] == 'EXPORT'){
                // <!-- UNTUK YANG EXPORT -->
                $q_roll     = db2_exec($conn1, "SELECT
                                                    ise.ITEMTYPEAFICODE,
                                                    COUNT(ise.COUNTROLL) AS ROLL,
                                                    SUM(ise.QTY_KG) AS QTY_SJ_KG,
                                                    SUM(ise.QTY_YARDMETER) AS QTY_SJ_YARD,
                                                    inpe.PROJECT,
                                                    ise.ADDRESSEE,
                                                    ise.BRAND_NM
                                                FROM
                                                    ITXVIEW_SURATJALAN_EXIM2A ise 
                                                LEFT JOIN ITXVIEW_NO_PROJECTS_EXIM inpe ON inpe.PROVISIONALCODE = ise.PROVISIONALCODE 
                                                WHERE 
                                                    ise.PROVISIONALCODE = '$rowdb2[PROVISIONALCODE]' AND ise.ITEMTYPEAFICODE = '$rowdb2[ITEMTYPEAFICODE]'
                                                GROUP BY 
                                                    ise.ITEMTYPEAFICODE,
                                                    inpe.PROJECT,
                                                    ise.ADDRESSEE,
                                                    ise.BRAND_NM");
                $d_roll     = db2_fetch_assoc($q_roll);
                if($d_ket_foc['ROLL'] > 0 AND $d_ket_foc['KG'] > 0 AND $d_ket_foc['YARD_MTR'] > 0) { // MENGHITUNG JIKA FOC SEBAGIAN, MAKA ROLL UNTUK FOC DIPISAH DARI KESELURUHAN
                    echo $d_roll['ROLL'] - $d_ket_foc['ROLL'];
                }else{
                    echo $d_roll['ROLL'];
                }
            }else{
                // <!-- UNTUK YANG LOCAL -->
                $q_roll     = db2_exec($conn1, "SELECT COUNT(CODE) AS ROLL,
                                                        SUM(BASEPRIMARYQUANTITY) AS QTY_SJ_KG,
                                                        SUM(BASESECONDARYQUANTITY) AS QTY_SJ_YARD,
                                                        LOTCODE
                                                FROM 
                                                    ITXVIEWALLOCATION0 
                                                WHERE 
                                                    CODE = '$rowdb2[CODE]' AND LOTCODE = '$rowdb2[LOTCODE]'
                                                GROUP BY 
                                                    LOTCODE");
                $d_roll     = db2_fetch_assoc($q_roll);
                echo $d_roll['ROLL'];
            }
        ?>
        <td><?= number_format($d_roll['QTY_SJ_KG'], 2); ?></td>												 
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

        <!-- Nanti ganti -->
        <td align="center"><?php echo $row1['qty_sisa'];?></td>
			  <td align="center"><?php echo $row1['satuan_sisa'];?></td>

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
				        <!-- // QTY KIRIM UNTUK YANG FOC -->
						<?php
            $q_ket_foc  = db2_exec($conn1, "SELECT 
                                                COUNT(QUALITYREASONCODE) AS ROLL,
                                                SUM(FOC_KG) AS KG,
                                                SUM(FOC_YARDMETER) AS YARD_MTR,
                                                KET_YARDMETER
                                            FROM
                                                ITXVIEW_SURATJALAN_EXIM2A
                                            WHERE 
                                                QUALITYREASONCODE = 'FOC'
                                                AND PROVISIONALCODE = '$rowdb2[PROVISIONALCODE]'
                                            GROUP BY 
                                                KET_YARDMETER");
            $d_ket_foc  = db2_fetch_assoc($q_ket_foc);
        ?>
        <td><?= number_format($d_ket_foc['KG'], 2); ?></td> 
        <td><?= number_format($d_ket_foc['YARD_MTR'], 2); ?></td> 



        <!-- // QTY KIRIM UNTUK YANG BUKAN FOC -->
        <?php
            if($rowdb2['CODE'] == 'EXPORT'){
                // <!-- UNTUK YANG EXPORT -->
                $q_roll     = db2_exec($conn1, "SELECT
                                                    ise.ITEMTYPEAFICODE,
                                                    COUNT(ise.COUNTROLL) AS ROLL,
                                                    SUM(ise.QTY_KG) AS QTY_SJ_KG,
                                                    SUM(ise.QTY_YARDMETER) AS QTY_SJ_YARD,
                                                    inpe.PROJECT,
                                                    ise.ADDRESSEE,
                                                    ise.BRAND_NM
                                                FROM
                                                    ITXVIEW_SURATJALAN_EXIM2A ise 
                                                LEFT JOIN ITXVIEW_NO_PROJECTS_EXIM inpe ON inpe.PROVISIONALCODE = ise.PROVISIONALCODE 
                                                WHERE 
                                                    ise.PROVISIONALCODE = '$rowdb2[PROVISIONALCODE]' AND ise.ITEMTYPEAFICODE = '$rowdb2[ITEMTYPEAFICODE]'
                                                GROUP BY 
                                                    ise.ITEMTYPEAFICODE,
                                                    inpe.PROJECT,
                                                    ise.ADDRESSEE,
                                                    ise.BRAND_NM");
                $d_roll     = db2_fetch_assoc($q_roll);
                if($d_ket_foc['ROLL'] > 0 AND $d_ket_foc['KG'] > 0 AND $d_ket_foc['YARD_MTR'] > 0) { // MENGHITUNG JIKA FOC SEBAGIAN, MAKA ROLL UNTUK FOC DIPISAH DARI KESELURUHAN
                    echo $d_roll['ROLL'] - $d_ket_foc['ROLL'];
                }else{
                    echo $d_roll['ROLL'];
                }
            }else{
                // <!-- UNTUK YANG LOCAL -->
                $q_roll     = db2_exec($conn1, "SELECT COUNT(CODE) AS ROLL,
                                                        SUM(BASEPRIMARYQUANTITY) AS QTY_SJ_KG,
                                                        SUM(BASESECONDARYQUANTITY) AS QTY_SJ_YARD,
                                                        LOTCODE
                                                FROM 
                                                    ITXVIEWALLOCATION0 
                                                WHERE 
                                                    CODE = '$rowdb2[CODE]' AND LOTCODE = '$rowdb2[LOTCODE]'
                                                GROUP BY 
                                                    LOTCODE");
                $d_roll     = db2_fetch_assoc($q_roll);
                echo $d_roll['ROLL'];
            }
        ?>
        <td><?= number_format($d_roll['QTY_SJ_KG'], 2); ?></td>											 
          </tr>
		  
		  <?php  } ?>
		  
		  
		  
		  
          <?php	$no++;  } ?>
        </tbody>
      </table>
	  


































<?php }
?>