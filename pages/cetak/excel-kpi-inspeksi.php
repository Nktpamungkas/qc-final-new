<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Lap-KPI-Inspektor-".date($_GET['awal']).".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<?php 
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";
?>
<div align="center"> <h1>LAPORAN KPI INSPEKTOR</h1></div>
<h3>Tanggal : <?php echo $_GET['awal']." s/d ".$_GET['akhir'];?></h3>
<table width="100%" border="1">
    <tr>
        <th rowspan="4" align="center" bgcolor="#729FCF">Nama Operator</th>
        <th rowspan="4" align="center" bgcolor="#729FCF">Shift</th>
        
        <th colspan="42" align="center" bgcolor="#729FCF">Quantity</th>
        <th rowspan="2" align="center" bgcolor="#729FCF">Quantity</th>
        <th rowspan="4" align="center" bgcolor="#729FCF">Total Yard</th>
    </tr>
    <tr>
        <th colspan="8" align="center" bgcolor="#729FCF">Inspek</th>
        <th colspan="8" align="center" bgcolor="#729FCF">Inspek Qty Kecil</th>
        <th colspan="8" align="center" bgcolor="#729FCF">Inspek White</th>
        <th colspan="3" align="center" bgcolor="#729FCF">Inspek Oven</th>
        <th colspan="3" align="center" bgcolor="#729FCF">Inspek Packing</th>
        <th colspan="3" align="center" bgcolor="#729FCF">Pisah</th>
        <th colspan="3" align="center" bgcolor="#729FCF">Perbaikan</th>
        <th colspan="3" align="center" bgcolor="#729FCF">Perbaikan Grade</th>
        <!-- <th colspan="3" align="center" bgcolor="#729FCF">Kragh</th> -->
        <th colspan="3" align="center" bgcolor="#729FCF">Packing</th>
    </tr>
    <tr>
        <th colspan="3" align="center" bgcolor="#729FCF">Lululemon</th>
        <th align="center" bgcolor="#729FCF">Target</th>
        <th colspan="3" align="center" bgcolor="#729FCF">Adidas dan Lainnya</th>
        <th align="center" bgcolor="#729FCF">Target</th>
        <th colspan="3" align="center" bgcolor="#729FCF">Lululemon</th>
        <th align="center" bgcolor="#729FCF">Target</th>
        <th colspan="3" align="center" bgcolor="#729FCF">Adidas dan Lainnya</th>
        <th align="center" bgcolor="#729FCF">Target</th>
        <th colspan="3" align="center" bgcolor="#729FCF">Lululemon</th>
        <th align="center" bgcolor="#729FCF">Target</th>
        <th colspan="3" align="center" bgcolor="#729FCF">Adidas dan Lainnya</th>
        <th align="center" bgcolor="#729FCF">Target</th>
        <th rowspan="2" align="center" bgcolor="#729FCF">Roll</th>
        <th rowspan="2" align="center" bgcolor="#729FCF">Kg</th>
        <th rowspan="2" align="center" bgcolor="#729FCF">Yard</th>
        <!-- <th align="center" bgcolor="#729FCF">Target</th> -->
        <th rowspan="2" align="center" bgcolor="#729FCF">Roll</th>
        <th rowspan="2" align="center" bgcolor="#729FCF">Kg</th>
        <th rowspan="2" align="center" bgcolor="#729FCF">Yard</th>
        <!-- <th align="center" bgcolor="#729FCF">Target</th> -->
        <th rowspan="2" align="center" bgcolor="#729FCF">Roll</th>
        <th rowspan="2" align="center" bgcolor="#729FCF">Kg</th>
        <th rowspan="2" align="center" bgcolor="#729FCF">Yard</th>
        <!-- <th align="center" bgcolor="#729FCF">Target</th> -->
        <th rowspan="2" align="center" bgcolor="#729FCF">Roll</th>
        <th rowspan="2" align="center" bgcolor="#729FCF">Kg</th>
        <th rowspan="2" align="center" bgcolor="#729FCF">Yard</th>
        <!-- <th align="center" bgcolor="#729FCF">Target</th> -->
        <th rowspan="2" align="center" bgcolor="#729FCF">Roll</th>
        <th rowspan="2" align="center" bgcolor="#729FCF">Kg</th>
        <th rowspan="2" align="center" bgcolor="#729FCF">Yard</th>
        <!-- <th align="center" bgcolor="#729FCF">Target</th> -->
        <!-- <th rowspan="2" align="center" bgcolor="#729FCF">Roll</th>
        <th rowspan="2" align="center" bgcolor="#729FCF">Kg</th>
        <th rowspan="2" align="center" bgcolor="#729FCF">Yard</th>
        <th align="center" bgcolor="#729FCF">Target</th> -->
        <th rowspan="2" align="center" bgcolor="#729FCF">Roll</th>
        <th rowspan="2" align="center" bgcolor="#729FCF">Kg</th>
        <th rowspan="2" align="center" bgcolor="#729FCF">Yard</th>
        <!-- <th align="center" bgcolor="#729FCF">Target</th> -->
        <th rowspan="2" align="center" bgcolor="#729FCF">100</th>
    </tr>
    <tr>
        <th align="center" bgcolor="#729FCF">Roll</th>
        <th align="center" bgcolor="#729FCF">Kg</th>
        <th align="center" bgcolor="#729FCF">Yard</th>
        <th align="center" bgcolor="#729FCF">1800</th>
        <th align="center" bgcolor="#729FCF">Roll</th>
        <th align="center" bgcolor="#729FCF">Kg</th>
        <th align="center" bgcolor="#729FCF">Yard</th>
        <th align="center" bgcolor="#729FCF">1800</th>
        <th align="center" bgcolor="#729FCF">Roll</th>
        <th align="center" bgcolor="#729FCF">Kg</th>
        <th align="center" bgcolor="#729FCF">Yard</th>
        <th align="center" bgcolor="#729FCF">1000</th>
        <th align="center" bgcolor="#729FCF">Roll</th>
        <th align="center" bgcolor="#729FCF">Kg</th>
        <th align="center" bgcolor="#729FCF">Yard</th>
        <th align="center" bgcolor="#729FCF">1000</th>
        <th align="center" bgcolor="#729FCF">Roll</th>
        <th align="center" bgcolor="#729FCF">Kg</th>
        <th align="center" bgcolor="#729FCF">Yard</th>
        <th align="center" bgcolor="#729FCF">1300</th>
        <th align="center" bgcolor="#729FCF">Roll</th>
        <th align="center" bgcolor="#729FCF">Kg</th>
        <th align="center" bgcolor="#729FCF">Yard</th>
        <th align="center" bgcolor="#729FCF">1300</th>
    </tr>
    <?php 
    if($_GET['gshift']=="ALL"){		
        $WGshift=" ";	
    }else{	
        $WGshift=" AND b.g_shift='$_GET[gshift]' ";	
    }
    if($_GET['personil']=="ALL"){		
        $Wnama=" ";	
    }else{	
        $Wnama=" AND a.personil='$_GET[personil]'  ";	
    }
        $sql = mysqli_query($con, 
                "SELECT 
                    a.personil
                FROM 
                    tbl_inspection a 
                LEFT JOIN 
                    tbl_schedule b 
                ON 
                    a.id_schedule = b.id 
                WHERE 
                    a.status = 'selesai' 
                    AND DATE_FORMAT(a.tgl_update, '%Y-%m-%d %H:%i') BETWEEN '$_GET[awal]' AND '$_GET[akhir]' 
                    $Wnama  
                    $WGshift 
                GROUP BY 
                    a.personil
                ORDER BY 
                    a.personil ASC
            ");
            
        while($r=mysqli_fetch_array($sql)){
    //Inspect Query
        $sqlInsLu=mysqli_query($con,"SELECT
             b.g_shift,
             SUM( a.jml_rol ) AS rolIns,
             SUM( a.qty ) AS brutoIns,
             SUM( a.yard ) AS panjangIns,
             TIMESTAMPDIFF(MINUTE, b.tgl_mulai,b.tgl_stop) AS waktuIns,
             IF(a.yard>0,a.yard,b.pjng_order) AS yardIns,
             IF(b.istirahat='',0,b.istirahat) AS istirahatIns  
             FROM
               tbl_inspection a
             LEFT JOIN 
                 tbl_schedule b 
             ON 
                 a.id_schedule=b.id  
             WHERE
                 DATE_FORMAT( a.tgl_update, '%Y-%m-%d %H:%i' ) BETWEEN '$_GET[awal]' AND '$_GET[akhir]' 
                 AND proses='Inspect Finish' 
                 AND a.personil='$r[personil]' 
                --  AND b.g_shift='$r[g_shift]'
                 AND b.t_jawab_buyer = 'Lululemon' ");
             $rInsLu=mysqli_fetch_array($sqlInsLu);

        $sqlInsAd=mysqli_query($con,"SELECT
             b.g_shift,
             SUM( a.jml_rol ) AS rolIns,
             SUM( a.qty ) AS brutoIns,
             SUM( a.yard ) AS panjangIns,
             TIMESTAMPDIFF(MINUTE, b.tgl_mulai,b.tgl_stop) AS waktuIns,
             IF(a.yard>0,a.yard,b.pjng_order) AS yardIns,
             IF(b.istirahat='',0,b.istirahat) AS istirahatIns  
             FROM
               tbl_inspection a
             LEFT JOIN 
                 tbl_schedule b 
             ON 
                 a.id_schedule=b.id  
             WHERE
                 DATE_FORMAT( a.tgl_update, '%Y-%m-%d %H:%i' ) BETWEEN '$_GET[awal]' AND '$_GET[akhir]' 
                 AND proses='Inspect Finish' 
                 AND a.personil='$r[personil]' 
                --  AND b.g_shift='$r[g_shift]'
                 AND b.t_jawab_buyer = 'Adidas atau Lain-Lain'");
             $rInsAd=mysqli_fetch_array($sqlInsAd);
            //  $hourdiffIns  = (int)$rIns['waktuIns']-(int)$rIns['istirahatIns'];
    // End Inspect

    //Inspect Qty Kecil
        $sqlIQKLu=mysqli_query($con,"SELECT
            b.g_shift,
            SUM( a.jml_rol ) AS rolIQK,
            SUM( a.qty ) AS brutoIQK,
            SUM( a.yard ) AS panjangIQK,
            TIMESTAMPDIFF(MINUTE, b.tgl_mulai,b.tgl_stop) AS waktuIQK,
            IF(a.yard>0,a.yard,b.pjng_order) AS yardIQK,
	        IF(b.istirahat='',0,b.istirahat) AS istirahatIQK 
            FROM
            tbl_inspection a
            LEFT JOIN 
                tbl_schedule b 
            ON 
                a.id_schedule=b.id  
            WHERE
                DATE_FORMAT( a.tgl_update, '%Y-%m-%d %H:%i' ) BETWEEN '$_GET[awal]' AND '$_GET[akhir]' 
                AND proses='Inspect Qty Kecil' 
                AND a.personil='$r[personil]' 
                -- AND b.g_shift='$r[g_shift]'
                AND b.t_jawab_buyer = 'Lululemon'");
        $rIQKLu=mysqli_fetch_array($sqlIQKLu);

        $sqlIQKAd=mysqli_query($con,"SELECT
            b.g_shift,
            SUM( a.jml_rol ) AS rolIQK,
            SUM( a.qty ) AS brutoIQK,
            SUM( a.yard ) AS panjangIQK,
            TIMESTAMPDIFF(MINUTE, b.tgl_mulai,b.tgl_stop) AS waktuIQK,
            IF(a.yard>0,a.yard,b.pjng_order) AS yardIQK,
	        IF(b.istirahat='',0,b.istirahat) AS istirahatIQK 
            FROM
            tbl_inspection a
            LEFT JOIN 
                tbl_schedule b 
            ON 
                a.id_schedule=b.id  
            WHERE
                DATE_FORMAT( a.tgl_update, '%Y-%m-%d %H:%i' ) BETWEEN '$_GET[awal]' AND '$_GET[akhir]' 
                AND proses='Inspect Qty Kecil' 
                AND a.personil='$r[personil]' 
                -- AND b.g_shift='$r[g_shift]'
                AND b.t_jawab_buyer = 'Adidas atau Lain-Lain'");
        $rIQKAd=mysqli_fetch_array($sqlIQKAd);
            $hourdiffIQK  = (int)$rIQK['waktuIQK']-(int)$rIQK['istirahatIQK'];
    // End Inspect Qty Kecil

    //Inspect White
        $sqlWLu=mysqli_query($con,"SELECT
            b.g_shift,
            SUM( a.jml_rol ) AS rolW,
            SUM( a.qty ) AS brutoW,
            SUM( a.yard ) AS panjangW,
            TIMESTAMPDIFF(MINUTE, b.tgl_mulai,b.tgl_stop) AS waktuW,
            IF(a.yard>0,a.yard,b.pjng_order) AS yardW,
	        IF(b.istirahat='',0,b.istirahat) AS istirahatW
            FROM
            tbl_inspection a
            LEFT JOIN 
                tbl_schedule b 
            ON 
                a.id_schedule=b.id  
            WHERE
                DATE_FORMAT( a.tgl_update, '%Y-%m-%d %H:%i' ) BETWEEN '$_GET[awal]' AND '$_GET[akhir]' 
                AND proses='Inspect White' 
                AND a.personil='$r[personil]' 
                -- AND b.g_shift='$r[g_shift]'
                AND b.t_jawab_buyer = 'Lululemon'");
            $rWLu=mysqli_fetch_array($sqlWLu);

        $sqlWAd=mysqli_query($con,"SELECT
            b.g_shift,
            SUM( a.jml_rol ) AS rolW,
            SUM( a.qty ) AS brutoW,
            SUM( a.yard ) AS panjangW,
            TIMESTAMPDIFF(MINUTE, b.tgl_mulai,b.tgl_stop) AS waktuW,
            IF(a.yard>0,a.yard,b.pjng_order) AS yardW,
            IF(b.istirahat='',0,b.istirahat) AS istirahatW
            FROM
            tbl_inspection a
            LEFT JOIN 
                tbl_schedule b 
            ON 
                a.id_schedule=b.id  
            WHERE
                DATE_FORMAT( a.tgl_update, '%Y-%m-%d %H:%i' ) BETWEEN '$_GET[awal]' AND '$_GET[akhir]' 
                AND proses='Inspect White' 
                AND a.personil='$r[personil]' 
                -- AND b.g_shift='$r[g_shift]'
                AND b.t_jawab_buyer = 'Adidas atau Lain-Lain'");
            $rWAd=mysqli_fetch_array($sqlWAd);
            $hourdiffW  = (int)$rW['waktuW']-(int)$rW['istirahatW'];  
    // End Inspect White

    //Inspect Oven
        $sqlO=mysqli_query($con,"SELECT
            b.g_shift,
            SUM( a.jml_rol ) AS rolO,
            SUM( a.qty ) AS brutoO,
            SUM( a.yard ) AS panjangO,
            TIMESTAMPDIFF(MINUTE, b.tgl_mulai,b.tgl_stop) AS waktuO,
            IF(a.yard>0,a.yard,b.pjng_order) AS yardO,
	        IF(b.istirahat='',0,b.istirahat) AS istirahatO   
            FROM
            tbl_inspection a
            LEFT JOIN 
                tbl_schedule b 
            ON 
                a.id_schedule=b.id  
            WHERE
                DATE_FORMAT( a.tgl_update, '%Y-%m-%d %H:%i' ) BETWEEN '$_GET[awal]' AND '$_GET[akhir]' 
                AND proses='Inspect Oven' 
                AND a.personil='$r[personil]' 
                -- AND b.shift='$r[shift]'
                ");
            $rO=mysqli_fetch_array($sqlO);
            $hourdiffO  = (int)$rO['waktuO']-(int)$rO['istirahatO'];
    // End Inspect Oven

    //Pisah
            $sqlP=mysqli_query($con,"SELECT
            b.g_shift,
            SUM( a.jml_rol ) AS rolP,
            SUM( a.qty ) AS brutoP,
            SUM( a.yard ) AS panjangP,
            TIMESTAMPDIFF(MINUTE, b.tgl_mulai,b.tgl_stop) AS waktuP,
            IF(a.yard>0,a.yard,b.pjng_order) AS yardP,
	        IF(b.istirahat='',0,b.istirahat) AS istirahatP 
            FROM
            tbl_inspection a
            LEFT JOIN 
                tbl_schedule b 
            ON 
                a.id_schedule=b.id  
            WHERE
                DATE_FORMAT( a.tgl_update, '%Y-%m-%d %H:%i' ) BETWEEN '$_GET[awal]' AND '$_GET[akhir]' 
                AND proses='Pisah' 
                AND a.personil='$r[personil]' 
                -- AND b.shift='$r[shift]'
                ");
            $rP=mysqli_fetch_array($sqlP);
            $hourdiffP  = (int)$rP['waktuP']-(int)$rP['istirahatP'];
    // End Pisah

    //Perbaikan
            $sqlPb=mysqli_query($con,"SELECT
            b.g_shift,
            SUM( a.jml_rol ) AS rolPb,
            SUM( a.qty ) AS brutoPb,
            SUM( a.yard ) AS panjangPb,
            TIMESTAMPDIFF(MINUTE, b.tgl_mulai,b.tgl_stop) AS waktuPb,
            IF(a.yard>0,a.yard,b.pjng_order) AS yardPb,
	        IF(b.istirahat='',0,b.istirahat) AS istirahatPb 
            FROM
            tbl_inspection a
            LEFT JOIN 
                tbl_schedule b 
            ON 
                a.id_schedule=b.id  
            WHERE
                DATE_FORMAT( a.tgl_update, '%Y-%m-%d %H:%i' ) BETWEEN '$_GET[awal]' AND '$_GET[akhir]' 
                AND proses='Perbaikan' 
                AND a.personil='$r[personil]' 
                -- AND b.shift='$r[shift]'
                ");
            $rPb=mysqli_fetch_array($sqlPb);
            $hourdiffPb  = (int)$rPb['waktuPb']-(int)$rPb['istirahatPb'];
    // End Perbaikan

    //Perbaikan Grade
            $sqlPG=mysqli_query($con,"SELECT
            b.g_shift,
            SUM( a.jml_rol ) AS rolPG,
            SUM( a.qty ) AS brutoPG,
            SUM( a.yard ) AS panjangPG,
            TIMESTAMPDIFF(MINUTE, b.tgl_mulai,b.tgl_stop) AS waktuPG,
            IF(a.yard>0,a.yard,b.pjng_order) AS yardPG,
	        IF(b.istirahat='',0,b.istirahat) AS istirahatPG 
            FROM
            tbl_inspection a
            LEFT JOIN 
                tbl_schedule b 
            ON 
                a.id_schedule=b.id  
            WHERE
                DATE_FORMAT( a.tgl_update, '%Y-%m-%d %H:%i' ) BETWEEN '$_GET[awal]' AND '$_GET[akhir]' 
                AND proses='Perbaikan Grade' 
                AND a.personil='$r[personil]' 
                -- AND b.shift='$r[shift]'
                ");
            $rPG=mysqli_fetch_array($sqlPG);
            $hourdiffPG  = (int)$rPG['waktuPG']-(int)$rPG['istirahatPG'];
    // End Perbaikan Grade
            
    //Packing
            $sqlPack=mysqli_query($con,"SELECT
            b.g_shift,
            SUM( a.jml_rol ) AS rolPack,
            SUM( a.qty ) AS brutoPack,
            SUM( a.yard ) AS panjangPack,
            TIMESTAMPDIFF(MINUTE, b.tgl_mulai,b.tgl_stop) AS waktuPack,
            IF(a.yard>0,a.yard,b.pjng_order) AS yardPack,
	        IF(b.istirahat='',0,b.istirahat) AS istirahatPack 
            FROM
            tbl_inspection a
            LEFT JOIN 
                tbl_schedule b 
            ON 
                a.id_schedule=b.id  
            WHERE
                DATE_FORMAT( a.tgl_update, '%Y-%m-%d %H:%i' ) BETWEEN '$_GET[awal]' AND '$_GET[akhir]' 
                AND proses='Packing' 
                AND a.personil='$r[personil]' 
                -- AND b.shift='$r[shift]'
                ");
            $rPack=mysqli_fetch_array($sqlPack);
            $hourdiffPack  = (int)$rPack['waktuPack']-(int)$rPack['istirahatPack'];
    // End Packing

    //Inspect Packing
            $sqlIP=mysqli_query($con,"SELECT
            b.g_shift,
            SUM( a.jml_rol ) AS rolIP,
            SUM( a.qty ) AS brutoIP,
            SUM( a.yard ) AS panjangIP,
            TIMESTAMPDIFF(MINUTE, b.tgl_mulai,b.tgl_stop) AS waktuIP,
            IF(a.yard>0,a.yard,b.pjng_order) AS yardIP,
	        IF(b.istirahat='',0,b.istirahat) AS istirahatIP 
            FROM
            tbl_inspection a
            LEFT JOIN 
                tbl_schedule b 
            ON 
                a.id_schedule=b.id  
            WHERE
                DATE_FORMAT( a.tgl_update, '%Y-%m-%d %H:%i' ) BETWEEN '$_GET[awal]' AND '$_GET[akhir]' 
                AND proses='Inspect Packing' 
                AND a.personil='$r[personil]' 
                -- AND b.shift='$r[shift]'
                ");
            $rIP=mysqli_fetch_array($sqlIP);
            $hourdiffIP  = (int)$rIP['waktuIP']-(int)$rIP['istirahatIP'];
    // End Inspect Packing

    ?>
    <tr> 
        <td align="left"><?php echo $r['personil'];?></td>
        <td align="right"><?php //echo $r['g_shift'];?></td>
        <td align="right"><?php echo $rInsLu['rolIns'];?></td>
        <td align="right"><?php echo $rInsLu['brutoIns'];?></td>
        <td align="right"><?php echo $rInsLu['panjangIns'];?></td>
        <td align="right"><?php echo $targetInsLulu= number_format(($rInsLu['panjangIns']/1800*100),2);?></td>
        <td align="right"><?php echo $rInsAd['rolIns'];?></td>
        <td align="right"><?php echo $rInsAd['brutoIns'];?></td>
        <td align="right"><?php echo $rInsAd['panjangIns'];?></td>
        <td align="right"><?php echo $targetInsAds= number_format(($rInsAd['panjangIns']/1800*100),2);?></td>
        <td align="right"><?php echo $rIQKLu['rolIQK'];?></td>
        <td align="right"><?php echo $rIQKLu['brutoIQK'];?></td>
        <td align="right"><?php echo $rIQKLu['panjangIQK'];?></td>
        <td align="right"><?php echo $targetIQKLulu= number_format(($rIQKLu['panjangIQK']/1000*100),2);?></td>
        <td align="right"><?php echo $rIQKAd['rolIQK'];?></td>
        <td align="right"><?php echo $rIQKAd['brutoIQK'];?></td>
        <td align="right"><?php echo $rIQKAd['panjangIQK'];?></td>
        <td align="right"><?php echo $targetIQKAds= number_format(($rIQKAd['panjangIQK']/1000*100),2);?></td>
        <td align="right"><?php echo $rWLu['rolW'];?></td>
        <td align="right"><?php echo $rWLu['brutoW'];?></td>
        <td align="right"><?php echo $rWLu['panjangW'];?></td>
        <td align="right"><?php echo $targetIWLulu= number_format(($rWLu['panjangW']/1300*100),2); ?></td>
        <td align="right"><?php echo $rWAd['rolW'];?></td>
        <td align="right"><?php echo $rWAd['brutoW'];?></td>
        <td align="right"><?php echo $rWAd['panjangW'];?></td>
        <td align="right"><?php echo $targetIWAds= number_format(($rWAd['panjangW']/1300*100),2); ?></td>
        <td align="right"><?php echo $rO['rolO'];?></td>
        <td align="right"><?php echo $rO['brutoO'];?></td>
        <td align="right"><?php echo $rO['panjangO'];?></td>
        <td align="right"><?php echo $rIP['rolIP'];?></td>
        <td align="right"><?php echo $rIP['brutoIP'];?></td>
        <td align="right"><?php echo $rIP['panjangIP'];?></td>
        <td align="right"><?php echo $rP['rolP'];?></td>
        <td align="right"><?php echo $rP['brutoP'];?></td>
        <td align="right"><?php echo $rP['panjangP'];?></td>
        <td align="right"><?php echo $rPb['rolPb'];?></td>
        <td align="right"><?php echo $rPb['brutoPb'];?></td>
        <td align="right"><?php echo $rPb['panjangPb'];?></td>
        <td align="right"><?php echo $rPG['rolPG'];?></td>
        <td align="right"><?php echo $rPG['brutoPG'];?></td>
        <td align="right"><?php echo $rPG['panjangPG'];?></td>
        <!-- <td align="right"><?php echo $rK['rolK'];?></td>
        <td align="right"><?php echo $rK['brutoK'];?></td>
        <td align="right"><?php echo $rK['panjangK'];?></td>
        <td align="right">&nbsp;</td> -->
        <td align="right"><?php echo $rPack['rolPack'];?></td>
        <td align="right"><?php echo $rPack['brutoPack'];?></td>
        <td align="right"><?php echo $rPack['panjangPack'];?></td>
        <td align="right"><?php echo $Qty100= number_format(($targetInsLulu+$targetInsAds+$targetIQKLulu+$targetIQKAds+$targetIWLulu+$targetIWAds+$targetO+$targetIP+$targetP+$targetPb+$targetPG+$targetPack)*100/100,2);?></td>
        <td align="right"><?php echo $rInsLu['panjangIns']+$rInsAd['panjangIns']+$rIQKLu['panjangIQK']+$rIQKAd['panjangIQK']+$rWLu['panjangW']+$rWAd['panjangW']+$rO['panjangO']+$rPack['panjangPack']+$rP['panjangP']+$rPb['panjangPb']+$rPG['panjangPG']+$rIP['panjangIP'];?></td>
    </tr>
    <?php
    $troll_InsLulu      += $rInsLu['rolIns'];
    $tbruto_InsLulu     += $rInsLu['brutoIns'];
    $tpanjang_InsLulu   += $rInsLu['panjangIns'];
    $troll_IQKLulu      += $rIQKLu['rolIQK'];
    $tbruto_IQKLulu     += $rIQKLu['brutoIQK'];
    $tpanjang_IQKLulu   += $rIQKLu['panjangIQK'];
    $troll_WLulu        += $rWLu['rolW'];
    $tbruto_WLulu       += $rWLu['brutoW'];
    $tpanjang_WLulu     += $rWLu['panjangW'];
    $troll_InsAds       += $rInsAd['rolIns'];
    $tbruto_InsAds      += $rInsAd['brutoIns'];
    $tpanjang_InsAds    += $rInsAd['panjangIns'];
    $troll_IQKAds       += $rIQKAd['rolIQK'];
    $tbruto_IQKAds      += $rIQKAd['brutoIQK'];
    $tpanjang_IQKAds    += $rIQKAd['panjangIQK'];
    $troll_WAds         += $rWAd['rolW'];
    $tbruto_WAds        += $rWAd['brutoW'];
    $tpanjang_WAds      += $rWAd['panjangW'];
    // $troll_Ins      = $troll_Ins+$rIns['rolIns'];
    // $tbruto_Ins     = $tbruto_Ins+$rIns['brutoIns'];
    // $tpanjang_Ins   = $tpanjang_Ins+$rIns['panjangIns'];
    // $troll_IQK      = $troll_IQK+$rIQK['rolIQK'];
    // $tbruto_IQK     = $tbruto_IQK+$rIQK['brutoIQK'];
    // $tpanjang_IQK   = $tpanjang_IQK+$rIQK['panjangIQK'];
    // $troll_W        = $troll_W+$rW['rolW'];
    // $tbruto_W       = $tbruto_W+$rW['brutoW'];
    // $tpanjang_W     = $tpanjang_W+$rW['panjangW'];
    $troll_O        = $troll_O+$rO['rolO'];
    $tbruto_O       = $tbruto_O+$rO['brutoO'];
    $tpanjang_O     = $tpanjang_O+$rO['panjangO'];
    $troll_Pack     = $troll_Pack+$rPack['rolPack'];
    $tbruto_Pack    = $tbruto_Pack+$rPack['brutoPack'];
    $tpanjang_Pack  = $tpanjang_Pack+$rPack['panjangPack'];
    $troll_P        = $troll_P+$rP['rolP'];
    $tbruto_P       = $tbruto_P+$rP['brutoP'];
    $tpanjang_P     = $tpanjang_P+$rP['panjangP'];
    $troll_Pb       = $troll_Pb+$rPb['rolPb'];
    $tbruto_Pb      = $tbruto_Pb+$rPb['brutoPb'];
    $tpanjang_Pb    = $tpanjang_Pb+$rPb['panjangPb'];
    $troll_PG       = $troll_PG+$rPG['rolPG'];
    $tbruto_PG      = $tbruto_PG+$rPG['brutoPG'];
    $tpanjang_PG    = $tpanjang_PG+$rPG['panjangPG'];
    $troll_K        = $troll_K+$rK['rolK'];
    $tbruto_K       = $tbruto_K+$rK['brutoK'];
    $tpanjang_K     = $tpanjang_K+$rK['panjangK'];
    $troll_IP       = $troll_IP+$rIP['rolIP'];
    $tbruto_IP      = $tbruto_IP+$rIP['brutoIP'];
    $tpanjang_IP    = $tpanjang_IP+$rIP['panjangIP'];
    $tQty100        = $tQty100+$Qty100;
    $ttargetInsLulu = $ttargetInsLulu+$targetInsLulu;
    $ttargetInsAds = $ttargetInsAds+$targetInsAds;
    $ttargetIQKLulu = $ttargetIQKLulu+$targetIQKLulu;
    $ttargetIQKAds = $ttargetIQKAds+$targetIQKAds;
    $ttargetIWLulu = $ttargetIWLulu+$targetIWLulu;
    $ttargetIWAds = $ttargetIWAds+$targetIWAds;
    $ttargetO       = $ttargetO+$targetO;
    $ttargetIP       = $ttargetIP+$targetIP;
    $ttargetP       = $ttargetP+$targetP;
    $ttargetPb       = $ttargetPb+$targetPb;
    $ttargetPG       = $ttargetPG+$targetPG;
    $ttargetPack     = $ttargetPack+$targetPack;
    } ?>
    <tr>
        <td colspan="2" align="left"><strong>Total</strong></td>
        <td align="right"><strong><?php echo number_format($troll_InsLulu,2);?></strong></td>
        <td align="right"><strong><?php echo number_format($tbruto_InsLulu,2);?></strong></td>
        <td align="right"><strong><?php echo number_format($tpanjang_InsLulu,2);?></strong></td>
        <td align="right"><strong><?php //echo number_format($ttargetInsLulu,2);?></strong></td>
        <td align="right"><strong><?php echo number_format($troll_InsAds,2);?></strong></td>
        <td align="right"><strong><?php echo number_format($tbruto_InsAds,2);?></strong></td>
        <td align="right"><strong><?php echo number_format($tpanjang_InsAds,2);?></strong></td>
        <td align="right"><strong><?php //echo number_format($ttargetInsAds,2);?></strong></td>
        <td align="right"><strong><?php echo number_format($troll_IQKLulu,2);?></strong></td>
        <td align="right"><strong><?php echo number_format($tbruto_IQKLulu,2);?></strong></td>
        <td align="right"><strong><?php echo number_format($tpanjang_IQKLulu,2);?></strong></td>
        <td align="right"><strong><?php //echo number_format($ttargetIQKLulu,2);?></strong></td>
        <td align="right"><strong><?php echo number_format($troll_IQKAds,2);?></strong></td>
        <td align="right"><strong><?php echo number_format($tbruto_IQKAds,2);?></strong></td>
        <td align="right"><strong><?php echo number_format($tpanjang_IQKAds,2);?></strong></td>
        <td align="right"><strong><?php //echo number_format($ttargetIQKAds,2);?></strong></td>
        <td align="right"><strong><?php echo number_format($troll_WLulu,2);?></strong></td>
        <td align="right"><strong><?php echo number_format($tbruto_WLulu,2);?></strong></td>
        <td align="right"><strong><?php echo number_format($tpanjang_WLulu,2);?></strong></td>
        <td align="right"><strong><?php //echo number_format($ttargetIWLulu,2);?></strong></td>
        <td align="right"><strong><?php echo number_format($troll_WAds,2);?></strong></td>
        <td align="right"><strong><?php echo number_format($tbruto_WAds,2);?></strong></td>
        <td align="right"><strong><?php echo number_format($tpanjang_WAds,2);?></strong></td>
        <td align="right"><strong><?php //echo number_format($ttargetIWAds,2);?></strong></td>
        <td align="right"><strong><?php echo $troll_O;?></strong></td>
        <td align="right"><strong><?php echo $tbruto_O;?></strong></td>
        <td align="right"><strong><?php echo $tpanjang_O;?></strong></td>
        <td align="right"><strong><?php echo $troll_IP;?></strong></td>
        <td align="right"><strong><?php echo $tbruto_IP;?></strong></td>
        <td align="right"><strong><?php echo $tpanjang_IP;?></strong></td>
        <td align="right"><strong><?php echo $troll_P;?></strong></td>
        <td align="right"><strong><?php echo $tbruto_P;?></strong></td>
        <td align="right"><strong><?php echo $tpanjang_P;?></strong></td>
        <td align="right"><strong><?php echo $troll_Pb;?></strong></td>
        <td align="right"><strong><?php echo $tbruto_Pb;?></strong></td>
        <td align="right"><strong><?php echo $tpanjang_Pb;?></strong></td>
        <td align="right"><strong><?php echo $troll_PG;?></strong></td>
        <td align="right"><strong><?php echo $tbruto_PG;?></strong></td>
        <td align="right"><strong><?php echo $tpanjang_PG;?></strong></td>
        <!-- <td align="right"><strong><?php echo $troll_K;?></strong></td>
        <td align="right"><strong><?php echo $tbruto_K;?></strong></td>
        <td align="right"><strong><?php echo $tpanjang_K;?></strong></td>
        <td align="right">&nbsp;</td> -->
        <td align="right"><strong><?php echo $troll_Pack;?></strong></td>
        <td align="right"><strong><?php echo $tbruto_Pack;?></strong></td>
        <td align="right"><strong><?php echo $tpanjang_Pack;?></strong></td>
        <td align="right"><strong><?php echo $tQty100;?></strong></td>
        <td align="right"><strong><?php echo $tpanjang_InsLulu+$tpanjang_InsAds+$tpanjang_IQKLulu+$tpanjang_IQKAds+$tpanjang_WLulu+$tpanjang_WAds+$tpanjang_O+$tpanjang_Pack+$tpanjang_P+$tpanjang_Pb+$tpanjang_PG+$tpanjang_IP;?></strong></td>
    </tr>
</table>