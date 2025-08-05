<?PHP

use GuzzleHttp\Psr7\Query;

ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
set_time_limit(0);
?>
<?php
$Awal = isset($_POST['awal']) ? $_POST['awal'] : '';
$Akhir = isset($_POST['akhir']) ? $_POST['akhir'] : '';
$Digit = isset($_POST['DIGIT']) ? $_POST['DIGIT'] : '';

?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>

</head>

<body>
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Cari Data Top 5 DEFECTT </h3>
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
                        <select class="form-control select2" name="DIGIT" id="DIGIT" required>
                            <option value="">Pilih Digit</option>
                            <option value="11" <?php echo $Digit == '11' ? 'selected' : ''; ?>>11</option>
                            <option value="13" <?php echo $Digit == '13' ? 'selected' : ''; ?>>13</option>
                        </select>
                    </div>
                    <!-- /.input group -->
                </div>
                <div class="form-group">
                    <div class="col-sm-2">
                        <div class="input-group date">
                            <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                            <input name="akhir" type="text" class="form-control pull-right" id="datepicker1"
                                placeholder="Tanggal Akhir" value="<?php echo $Akhir; ?>" autocomplete="off" />
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-success" name="cari"><i class="fa fa-search"></i> Cari Data</button>
                    </div>
                </div>
                <!-- /.box-footer -->
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Report Data Top 5 DEFECT</h3><br>
                    <b>Tanggal Inspeksi :
                        <?php echo $_POST['awal']; ?> s.d.
                        <?php echo $_POST['akhir']; ?>
                    </b> <br><br>
                </div>
                <?php
                $qryb = "SELECT 
                            BUYER_TERDEPAN AS BUYERS,
                            SUM(POINTS) AS POINTSS,
                            SUM(LENGTHGROSS) AS LENGTHGROSSS,
                            SUM(LENGHTCALC) AS LENGHTCALCS
                        FROM(
                            SELECT 
                                CASE 
                                    WHEN LOCATE(',', BUYER) > 0 THEN TRIM(SUBSTR(BUYER, 1, LOCATE(',', BUYER) - 1))
                                    ELSE BUYER
                                END AS BUYER_TERDEPAN,
                                SUM(POINTS) AS POINTS,
                                ORIGDLVSALORDLINESALORDERCODE,
                                ORIGDLVSALORDERLINEORDERLINE,
                                ELEMENTCODE,
                                INSPECTIONINDEX,
                                DEMANDCODE,
                                LENGTHGROSS,
                                LENGHTCALC,
                                INSPECTIONSTARTDATETIME,
                                INSPECTIONSTATION,
                                ABSUNIQUEID,
                                JENISKAIN,
                                SHORTDESCRIPTION
                            FROM  (
                                SELECT DISTINCT
                                    LISTAGG(DISTINCT ORDERPARTNERBRAND.LONGDESCRIPTION,',') AS BUYER,
                                    (c.POINTS),
                                    PRODUCTIONDEMAND.ORIGDLVSALORDLINESALORDERCODE,
                                    PRODUCTIONDEMAND.ORIGDLVSALORDERLINEORDERLINE,
                                    ELEMENTSINSPECTION.ELEMENTCODE,
                                    ELEMENTSINSPECTION.INSPECTIONINDEX,
                                    ELEMENTSINSPECTION.DEMANDCODE,
                                    ELEMENTSINSPECTION.LENGTHGROSS,
                                    a.VALUEDECIMAL AS LENGHTCALC,
                                    ELEMENTSINSPECTION.INSPECTIONSTARTDATETIME,
                                    ELEMENTSINSPECTION.INSPECTIONSTATION,
                                    ELEMENTSINSPECTION.ABSUNIQUEID,
                                    FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION AS JENISKAIN,
                                    ITXVIEWORDERITEMLINKACTIVE.SHORTDESCRIPTION
                                FROM
                                    PRODUCTIONDEMAND PRODUCTIONDEMAND
                                LEFT JOIN ORDERPARTNER ORDERPARTNER ON PRODUCTIONDEMAND.CUSTOMERCODE = ORDERPARTNER.CUSTOMERSUPPLIERCODE 
                                LEFT JOIN BUSINESSPARTNER BUSINESSPARTNER ON	ORDERPARTNER.ORDERBUSINESSPARTNERNUMBERID = BUSINESSPARTNER.NUMBERID 
                                LEFT JOIN ELEMENTSINSPECTION ELEMENTSINSPECTION ON PRODUCTIONDEMAND.CODE = ELEMENTSINSPECTION.DEMANDCODE
                                    AND PRODUCTIONDEMAND.COUNTERCODE = ELEMENTSINSPECTION.DEMANDCOUNTERCODE 
                                LEFT JOIN INITIALS INITIALS ON ELEMENTSINSPECTION.OPERATORCODE = INITIALS.CODE 
                                LEFT JOIN FULLITEMKEYDECODER FULLITEMKEYDECODER ON PRODUCTIONDEMAND.FULLITEMIDENTIFIER = FULLITEMKEYDECODER.IDENTIFIER 
                                LEFT JOIN ITXVIEWORDERITEMLINKACTIVE ITXVIEWORDERITEMLINKACTIVE ON
                                    PRODUCTIONDEMAND.CUSTOMERCODE = ITXVIEWORDERITEMLINKACTIVE.ORDPRNCUSTOMERSUPPLIERCODE
                                    AND PRODUCTIONDEMAND.ITEMTYPEAFICODE = ITXVIEWORDERITEMLINKACTIVE.ITEMTYPEAFICODE
                                    AND PRODUCTIONDEMAND.SUBCODE01 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE01
                                    AND PRODUCTIONDEMAND.SUBCODE02 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE02
                                    AND PRODUCTIONDEMAND.SUBCODE03 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE03
                                    AND PRODUCTIONDEMAND.SUBCODE04 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE04
                                    AND PRODUCTIONDEMAND.SUBCODE05 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE05
                                    AND PRODUCTIONDEMAND.SUBCODE06 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE06
                                    AND PRODUCTIONDEMAND.SUBCODE07 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE07
                                    AND PRODUCTIONDEMAND.SUBCODE08 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE08
                                    AND PRODUCTIONDEMAND.SUBCODE09 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE09
                                    AND PRODUCTIONDEMAND.SUBCODE10 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE10
                                LEFT JOIN ADSTORAGE a ON a.UNIQUEID = ELEMENTSINSPECTION.ABSUNIQUEID AND FIELDNAME = 'CalculatedLength'
                                LEFT JOIN SALESORDER b ON b.CODE = PRODUCTIONDEMAND.ORIGDLVSALORDLINESALORDERCODE
                                LEFT JOIN ORDERPARTNERBRAND ORDERPARTNERBRAND ON b.ORDERPARTNERBRANDCODE = ORDERPARTNERBRAND.CODE
                                LEFT JOIN ELEMENTSINSPECTIONEVENT c ON c.ELEMENTSINSPECTIONELEMENTCODE = ELEMENTSINSPECTION.ELEMENTCODE
                                WHERE
                                    ELEMENTSINSPECTION.INSPECTIONSTARTDATETIME BETWEEN '$Awal ' AND '$Akhir'
                                    AND ORDERPARTNER.CUSTOMERSUPPLIERTYPE = '1'
                                    AND ORDERPARTNERBRAND.LONGDESCRIPTION IS NOT NULL
                                    AND ELEMENTSINSPECTION.ELEMENTITEMTYPECODE = 'KFF' 
                                    AND c.POINTS IS NOT NULL
                                GROUP BY 
                                    c.POINTS,
                                    PRODUCTIONDEMAND.ORIGDLVSALORDLINESALORDERCODE,
                                    PRODUCTIONDEMAND.ORIGDLVSALORDERLINEORDERLINE,
                                    ELEMENTSINSPECTION.ELEMENTCODE,
                                    ELEMENTSINSPECTION.INSPECTIONINDEX,
                                    ELEMENTSINSPECTION.DEMANDCODE,
                                    ELEMENTSINSPECTION.LENGTHGROSS,
                                    a.VALUEDECIMAL,
                                    ELEMENTSINSPECTION.INSPECTIONSTARTDATETIME,
                                    ELEMENTSINSPECTION.INSPECTIONSTATION,
                                    ELEMENTSINSPECTION.ABSUNIQUEID,
                                    FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION,
                                    ITXVIEWORDERITEMLINKACTIVE.SHORTDESCRIPTION
                            )
                            GROUP BY 
                                BUYER,
                                ORIGDLVSALORDLINESALORDERCODE,
                                ORIGDLVSALORDERLINEORDERLINE,
                                ELEMENTCODE,
                                INSPECTIONINDEX,
                                DEMANDCODE,
                                LENGTHGROSS,
                                LENGHTCALC,
                                INSPECTIONSTARTDATETIME,
                                INSPECTIONSTATION,
                                ABSUNIQUEID,
                                JENISKAIN,
                                SHORTDESCRIPTION)
                        GROUP BY 
                            BUYER_TERDEPAN
                        ORDER BY POINTSS DESC
                        FETCH FIRST 5 ROWS ONLY";
                $stmt1 = db2_exec($conn1, $qryb, array('cursor' => DB2_SCROLLABLE));
                if ($stmt1) {
                    ?>
                    <div class="box-body">
                        <table id="example3" class="table table-bordered table-hover table-striped display nowrap" width="100%">
                            <thead class="bg-blue">
                                <tr>
                                    <th width="23">
                                        <div align="center">No</div>
                                    </th>
                                    <th width="78">
                                        <div align="center">Buyer</div>
                                    </th>
                                    <th width="24">
                                        <div align="center">QYY YRD </div>
                                    </th>
                                    <th width="78">
                                        <div align="center">UOM</div>
                                    </th>
                                    <th align="center">
                                        <div align="center">GRADE A</div>
                                    </th>
                                    <th align="center">
                                        <div align="center">GRADE B</div>
                                    </th>
                                    <th align="center">
                                        <div align="center">GRADE C</div>
                                    </th>
                                    <th width="78">
                                        <div align="center">TOTAL</div>
                                    </th>
                                    <th align="center">
                                        <div align="center">Grade A %</div>
                                    </th>
                                    <th align="center">
                                        <div align="center">Grade B %</div>
                                    </th>
                                    <th align="center">
                                        <div align="center">Grade C %</div>
                                    </th>
                                    <th width="78">
                                        <div align="center">Total Point</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                $no = 1;
                                $total = $gradeA = $gradeB = $gradeC = 0;
                                    
                                while ($row = db2_fetch_assoc($stmt1)) {
                                    if (!empty($row['BUYERS'])) {
                                        $qty_a = "SELECT 
                                            BUYER_TERDEPAN AS BUYERS,
                                            SUM(POINTS) AS POINTSS,
                                            SUM(LENGTHGROSS) AS QTY_A,
                                            SUM(LENGHTCALC) AS LENGHTCALCS
                                        FROM(
                                            SELECT 
                                                CASE 
                                                    WHEN LOCATE(',', BUYER) > 0 THEN TRIM(SUBSTR(BUYER, 1, LOCATE(',', BUYER) - 1))
                                                    ELSE BUYER
                                                END AS BUYER_TERDEPAN,
                                                SUM(POINTS) AS POINTS,
                                                ORIGDLVSALORDLINESALORDERCODE,
                                                ORIGDLVSALORDERLINEORDERLINE,
                                                ELEMENTCODE,
                                                INSPECTIONINDEX,
                                                DEMANDCODE,
                                                LENGTHGROSS,
                                                LENGHTCALC,
                                                INSPECTIONSTARTDATETIME,
                                                INSPECTIONSTATION,
                                                ABSUNIQUEID,
                                                JENISKAIN,
                                                SHORTDESCRIPTION
                                            FROM  (
                                                SELECT DISTINCT
                                                    LISTAGG(DISTINCT ORDERPARTNERBRAND.LONGDESCRIPTION,',') AS BUYER,
                                                    (c.POINTS),
                                                    PRODUCTIONDEMAND.ORIGDLVSALORDLINESALORDERCODE,
                                                    PRODUCTIONDEMAND.ORIGDLVSALORDERLINEORDERLINE,
                                                    ELEMENTSINSPECTION.ELEMENTCODE,
                                                    ELEMENTSINSPECTION.INSPECTIONINDEX,
                                                    ELEMENTSINSPECTION.DEMANDCODE,
                                                    ELEMENTSINSPECTION.LENGTHGROSS,
                                                    a.VALUEDECIMAL AS LENGHTCALC,
                                                    ELEMENTSINSPECTION.INSPECTIONSTARTDATETIME,
                                                    ELEMENTSINSPECTION.INSPECTIONSTATION,
                                                    ELEMENTSINSPECTION.ABSUNIQUEID,
                                                    FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION AS JENISKAIN,
                                                    ITXVIEWORDERITEMLINKACTIVE.SHORTDESCRIPTION
                                                FROM
                                                    PRODUCTIONDEMAND PRODUCTIONDEMAND
                                                LEFT JOIN ORDERPARTNER ORDERPARTNER ON PRODUCTIONDEMAND.CUSTOMERCODE = ORDERPARTNER.CUSTOMERSUPPLIERCODE 
                                                LEFT JOIN BUSINESSPARTNER BUSINESSPARTNER ON	ORDERPARTNER.ORDERBUSINESSPARTNERNUMBERID = BUSINESSPARTNER.NUMBERID 
                                                LEFT JOIN ELEMENTSINSPECTION ELEMENTSINSPECTION ON PRODUCTIONDEMAND.CODE = ELEMENTSINSPECTION.DEMANDCODE
                                                    AND PRODUCTIONDEMAND.COUNTERCODE = ELEMENTSINSPECTION.DEMANDCOUNTERCODE AND ELEMENTSINSPECTION.QUALITYCODE = 1
                                                LEFT JOIN INITIALS INITIALS ON ELEMENTSINSPECTION.OPERATORCODE = INITIALS.CODE 
                                                LEFT JOIN FULLITEMKEYDECODER FULLITEMKEYDECODER ON PRODUCTIONDEMAND.FULLITEMIDENTIFIER = FULLITEMKEYDECODER.IDENTIFIER 
                                                LEFT JOIN ITXVIEWORDERITEMLINKACTIVE ITXVIEWORDERITEMLINKACTIVE ON
                                                    PRODUCTIONDEMAND.CUSTOMERCODE = ITXVIEWORDERITEMLINKACTIVE.ORDPRNCUSTOMERSUPPLIERCODE
                                                    AND PRODUCTIONDEMAND.ITEMTYPEAFICODE = ITXVIEWORDERITEMLINKACTIVE.ITEMTYPEAFICODE
                                                    AND PRODUCTIONDEMAND.SUBCODE01 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE01
                                                    AND PRODUCTIONDEMAND.SUBCODE02 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE02
                                                    AND PRODUCTIONDEMAND.SUBCODE03 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE03
                                                    AND PRODUCTIONDEMAND.SUBCODE04 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE04
                                                    AND PRODUCTIONDEMAND.SUBCODE05 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE05
                                                    AND PRODUCTIONDEMAND.SUBCODE06 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE06
                                                    AND PRODUCTIONDEMAND.SUBCODE07 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE07
                                                    AND PRODUCTIONDEMAND.SUBCODE08 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE08
                                                    AND PRODUCTIONDEMAND.SUBCODE09 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE09
                                                    AND PRODUCTIONDEMAND.SUBCODE10 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE10
                                                LEFT JOIN ADSTORAGE a ON a.UNIQUEID = ELEMENTSINSPECTION.ABSUNIQUEID AND FIELDNAME = 'CalculatedLength'
                                                LEFT JOIN SALESORDER b ON b.CODE = PRODUCTIONDEMAND.ORIGDLVSALORDLINESALORDERCODE
                                                LEFT JOIN ORDERPARTNERBRAND ORDERPARTNERBRAND ON b.ORDERPARTNERBRANDCODE = ORDERPARTNERBRAND.CODE
                                                LEFT JOIN ELEMENTSINSPECTIONEVENT c ON c.ELEMENTSINSPECTIONELEMENTCODE = ELEMENTSINSPECTION.ELEMENTCODE
                                                WHERE
                                                    ELEMENTSINSPECTION.INSPECTIONSTARTDATETIME BETWEEN '$Awal ' AND '$Akhir'
                                                    AND ORDERPARTNER.CUSTOMERSUPPLIERTYPE = '1'
                                                    AND ORDERPARTNERBRAND.LONGDESCRIPTION IS NOT NULL
                                                    AND ELEMENTSINSPECTION.ELEMENTITEMTYPECODE = 'KFF' 
                                                    AND c.POINTS IS NOT NULL
                                                GROUP BY 
                                                    c.POINTS,
                                                    PRODUCTIONDEMAND.ORIGDLVSALORDLINESALORDERCODE,
                                                    PRODUCTIONDEMAND.ORIGDLVSALORDERLINEORDERLINE,
                                                    ELEMENTSINSPECTION.ELEMENTCODE,
                                                    ELEMENTSINSPECTION.INSPECTIONINDEX,
                                                    DEMANDCODE,
                                                    LENGTHGROSS,
                                                    a.VALUEDECIMAL,
                                                    ELEMENTSINSPECTION.INSPECTIONSTARTDATETIME,
                                                    ELEMENTSINSPECTION.INSPECTIONSTATION,
                                                    ELEMENTSINSPECTION.ABSUNIQUEID,
                                                    FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION,
                                                    ITXVIEWORDERITEMLINKACTIVE.SHORTDESCRIPTION
                                            )
                                            GROUP BY 
                                                BUYER,
                                                ORIGDLVSALORDLINESALORDERCODE,
                                                ORIGDLVSALORDERLINEORDERLINE,
                                                ELEMENTCODE,
                                                INSPECTIONINDEX,
                                                DEMANDCODE,
                                                LENGTHGROSS,
                                                LENGHTCALC,
                                                INSPECTIONSTARTDATETIME,
                                                INSPECTIONSTATION,
                                                ABSUNIQUEID,
                                                JENISKAIN,
                                                SHORTDESCRIPTION) WHERE BUYER_TERDEPAN = '{$row['BUYERS']}'
                                        GROUP BY 
                                            BUYER_TERDEPAN
                                        ORDER BY POINTSS DESC
                                        FETCH FIRST 5 ROWS ONLY";

                                        $qty_a_stmt = db2_exec($conn1, $qty_a); // Eksekusi query
                                        if ($qty_a_stmt) {
                                            $rowqty_a = db2_fetch_assoc($qty_a_stmt); // Ambil hasil query
                                        } else {
                                            echo "Query execution failed: " . db2_stmt_errormsg();
                                        }
                                    } else {
                                        echo "Error: BUYERS value is empty.";
                                    }

                                    $qty_b = "SELECT 
                                            BUYER_TERDEPAN AS BUYERS,
                                            SUM(POINTS) AS POINTSS,
                                            SUM(LENGTHGROSS) AS QTY_B,
                                            SUM(LENGHTCALC) AS LENGHTCALCS
                                        FROM(
                                            SELECT 
                                                CASE 
                                                    WHEN LOCATE(',', BUYER) > 0 THEN TRIM(SUBSTR(BUYER, 1, LOCATE(',', BUYER) - 1))
                                                    ELSE BUYER
                                                END AS BUYER_TERDEPAN,
                                                SUM(POINTS) AS POINTS,
                                                ORIGDLVSALORDLINESALORDERCODE,
                                                ORIGDLVSALORDERLINEORDERLINE,
                                                ELEMENTCODE,
                                                INSPECTIONINDEX,
                                                DEMANDCODE,
                                                LENGTHGROSS,
                                                LENGHTCALC,
                                                INSPECTIONSTARTDATETIME,
                                                INSPECTIONSTATION,
                                                ABSUNIQUEID,
                                                JENISKAIN,
                                                SHORTDESCRIPTION
                                            FROM  (
                                                SELECT DISTINCT
                                                    LISTAGG(DISTINCT ORDERPARTNERBRAND.LONGDESCRIPTION,',') AS BUYER,
                                                    (c.POINTS),
                                                    PRODUCTIONDEMAND.ORIGDLVSALORDLINESALORDERCODE,
                                                    PRODUCTIONDEMAND.ORIGDLVSALORDERLINEORDERLINE,
                                                    ELEMENTSINSPECTION.ELEMENTCODE,
                                                    ELEMENTSINSPECTION.INSPECTIONINDEX,
                                                    ELEMENTSINSPECTION.DEMANDCODE,
                                                    ELEMENTSINSPECTION.LENGTHGROSS,
                                                    a.VALUEDECIMAL AS LENGHTCALC,
                                                    ELEMENTSINSPECTION.INSPECTIONSTARTDATETIME,
                                                    ELEMENTSINSPECTION.INSPECTIONSTATION,
                                                    ELEMENTSINSPECTION.ABSUNIQUEID,
                                                    FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION AS JENISKAIN,
                                                    ITXVIEWORDERITEMLINKACTIVE.SHORTDESCRIPTION
                                                FROM
                                                    PRODUCTIONDEMAND PRODUCTIONDEMAND
                                                LEFT JOIN ORDERPARTNER ORDERPARTNER ON PRODUCTIONDEMAND.CUSTOMERCODE = ORDERPARTNER.CUSTOMERSUPPLIERCODE 
                                                LEFT JOIN BUSINESSPARTNER BUSINESSPARTNER ON	ORDERPARTNER.ORDERBUSINESSPARTNERNUMBERID = BUSINESSPARTNER.NUMBERID 
                                                LEFT JOIN ELEMENTSINSPECTION ELEMENTSINSPECTION ON PRODUCTIONDEMAND.CODE = ELEMENTSINSPECTION.DEMANDCODE
                                                    AND PRODUCTIONDEMAND.COUNTERCODE = ELEMENTSINSPECTION.DEMANDCOUNTERCODE AND ELEMENTSINSPECTION.QUALITYCODE = 2
                                                LEFT JOIN INITIALS INITIALS ON ELEMENTSINSPECTION.OPERATORCODE = INITIALS.CODE 
                                                LEFT JOIN FULLITEMKEYDECODER FULLITEMKEYDECODER ON PRODUCTIONDEMAND.FULLITEMIDENTIFIER = FULLITEMKEYDECODER.IDENTIFIER 
                                                LEFT JOIN ITXVIEWORDERITEMLINKACTIVE ITXVIEWORDERITEMLINKACTIVE ON
                                                    PRODUCTIONDEMAND.CUSTOMERCODE = ITXVIEWORDERITEMLINKACTIVE.ORDPRNCUSTOMERSUPPLIERCODE
                                                    AND PRODUCTIONDEMAND.ITEMTYPEAFICODE = ITXVIEWORDERITEMLINKACTIVE.ITEMTYPEAFICODE
                                                    AND PRODUCTIONDEMAND.SUBCODE01 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE01
                                                    AND PRODUCTIONDEMAND.SUBCODE02 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE02
                                                    AND PRODUCTIONDEMAND.SUBCODE03 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE03
                                                    AND PRODUCTIONDEMAND.SUBCODE04 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE04
                                                    AND PRODUCTIONDEMAND.SUBCODE05 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE05
                                                    AND PRODUCTIONDEMAND.SUBCODE06 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE06
                                                    AND PRODUCTIONDEMAND.SUBCODE07 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE07
                                                    AND PRODUCTIONDEMAND.SUBCODE08 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE08
                                                    AND PRODUCTIONDEMAND.SUBCODE09 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE09
                                                    AND PRODUCTIONDEMAND.SUBCODE10 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE10
                                                LEFT JOIN ADSTORAGE a ON a.UNIQUEID = ELEMENTSINSPECTION.ABSUNIQUEID AND FIELDNAME = 'CalculatedLength'
                                                LEFT JOIN SALESORDER b ON b.CODE = PRODUCTIONDEMAND.ORIGDLVSALORDLINESALORDERCODE
                                                LEFT JOIN ORDERPARTNERBRAND ORDERPARTNERBRAND ON b.ORDERPARTNERBRANDCODE = ORDERPARTNERBRAND.CODE
                                                LEFT JOIN ELEMENTSINSPECTIONEVENT c ON c.ELEMENTSINSPECTIONELEMENTCODE = ELEMENTSINSPECTION.ELEMENTCODE
                                                WHERE
                                                    ELEMENTSINSPECTION.INSPECTIONSTARTDATETIME BETWEEN '$Awal ' AND '$Akhir'
                                                    AND ORDERPARTNER.CUSTOMERSUPPLIERTYPE = '1'
                                                    AND ORDERPARTNERBRAND.LONGDESCRIPTION IS NOT NULL
                                                    AND ELEMENTSINSPECTION.ELEMENTITEMTYPECODE = 'KFF' 
                                                    AND c.POINTS IS NOT NULL
                                                GROUP BY 
                                                    c.POINTS,
                                                    PRODUCTIONDEMAND.ORIGDLVSALORDLINESALORDERCODE,
                                                    PRODUCTIONDEMAND.ORIGDLVSALORDERLINEORDERLINE,
                                                    ELEMENTSINSPECTION.ELEMENTCODE,
                                                    ELEMENTSINSPECTION.INSPECTIONINDEX,
                                                    DEMANDCODE,
                                                    LENGTHGROSS,
                                                    a.VALUEDECIMAL,
                                                    ELEMENTSINSPECTION.INSPECTIONSTARTDATETIME,
                                                    ELEMENTSINSPECTION.INSPECTIONSTATION,
                                                    ELEMENTSINSPECTION.ABSUNIQUEID,
                                                    FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION,
                                                    ITXVIEWORDERITEMLINKACTIVE.SHORTDESCRIPTION
                                            )
                                            GROUP BY 
                                                BUYER,
                                                ORIGDLVSALORDLINESALORDERCODE,
                                                ORIGDLVSALORDERLINEORDERLINE,
                                                ELEMENTCODE,
                                                INSPECTIONINDEX,
                                                DEMANDCODE,
                                                LENGTHGROSS,
                                                LENGHTCALC,
                                                INSPECTIONSTARTDATETIME,
                                                INSPECTIONSTATION,
                                                ABSUNIQUEID,
                                                JENISKAIN,
                                                SHORTDESCRIPTION) WHERE BUYER_TERDEPAN = '{$row['BUYERS']}'
                                        GROUP BY 
                                            BUYER_TERDEPAN
                                        ORDER BY POINTSS DESC
                                        FETCH FIRST 5 ROWS ONLY";
                                          $qty_b_stmt = db2_exec($conn1, $qty_b);
                                          $rowqty_b = db2_fetch_assoc($qty_b_stmt);




                                          $qty_c = "SELECT 
                                            BUYER_TERDEPAN AS BUYERS,
                                            SUM(POINTS) AS POINTSS,
                                            SUM(LENGTHGROSS) AS QTY_C,
                                            SUM(LENGHTCALC) AS LENGHTCALCS
                                        FROM(
                                            SELECT 
                                                CASE 
                                                    WHEN LOCATE(',', BUYER) > 0 THEN TRIM(SUBSTR(BUYER, 1, LOCATE(',', BUYER) - 1))
                                                    ELSE BUYER
                                                END AS BUYER_TERDEPAN,
                                                SUM(POINTS) AS POINTS,
                                                ORIGDLVSALORDLINESALORDERCODE,
                                                ORIGDLVSALORDERLINEORDERLINE,
                                                ELEMENTCODE,
                                                INSPECTIONINDEX,
                                                DEMANDCODE,
                                                LENGTHGROSS,
                                                LENGHTCALC,
                                                INSPECTIONSTARTDATETIME,
                                                INSPECTIONSTATION,
                                                ABSUNIQUEID,
                                                JENISKAIN,
                                                SHORTDESCRIPTION
                                            FROM  (
                                                SELECT DISTINCT
                                                    LISTAGG(DISTINCT ORDERPARTNERBRAND.LONGDESCRIPTION,',') AS BUYER,
                                                    (c.POINTS),
                                                    PRODUCTIONDEMAND.ORIGDLVSALORDLINESALORDERCODE,
                                                    PRODUCTIONDEMAND.ORIGDLVSALORDERLINEORDERLINE,
                                                    ELEMENTSINSPECTION.ELEMENTCODE,
                                                    ELEMENTSINSPECTION.INSPECTIONINDEX,
                                                    ELEMENTSINSPECTION.DEMANDCODE,
                                                    ELEMENTSINSPECTION.LENGTHGROSS,
                                                    a.VALUEDECIMAL AS LENGHTCALC,
                                                    ELEMENTSINSPECTION.INSPECTIONSTARTDATETIME,
                                                    ELEMENTSINSPECTION.INSPECTIONSTATION,
                                                    ELEMENTSINSPECTION.ABSUNIQUEID,
                                                    FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION AS JENISKAIN,
                                                    ITXVIEWORDERITEMLINKACTIVE.SHORTDESCRIPTION
                                                FROM
                                                    PRODUCTIONDEMAND PRODUCTIONDEMAND
                                                LEFT JOIN ORDERPARTNER ORDERPARTNER ON PRODUCTIONDEMAND.CUSTOMERCODE = ORDERPARTNER.CUSTOMERSUPPLIERCODE 
                                                LEFT JOIN BUSINESSPARTNER BUSINESSPARTNER ON	ORDERPARTNER.ORDERBUSINESSPARTNERNUMBERID = BUSINESSPARTNER.NUMBERID 
                                                LEFT JOIN ELEMENTSINSPECTION ELEMENTSINSPECTION ON PRODUCTIONDEMAND.CODE = ELEMENTSINSPECTION.DEMANDCODE
                                                    AND PRODUCTIONDEMAND.COUNTERCODE = ELEMENTSINSPECTION.DEMANDCOUNTERCODE AND ELEMENTSINSPECTION.QUALITYCODE = 3
                                                LEFT JOIN INITIALS INITIALS ON ELEMENTSINSPECTION.OPERATORCODE = INITIALS.CODE 
                                                LEFT JOIN FULLITEMKEYDECODER FULLITEMKEYDECODER ON PRODUCTIONDEMAND.FULLITEMIDENTIFIER = FULLITEMKEYDECODER.IDENTIFIER 
                                                LEFT JOIN ITXVIEWORDERITEMLINKACTIVE ITXVIEWORDERITEMLINKACTIVE ON
                                                    PRODUCTIONDEMAND.CUSTOMERCODE = ITXVIEWORDERITEMLINKACTIVE.ORDPRNCUSTOMERSUPPLIERCODE
                                                    AND PRODUCTIONDEMAND.ITEMTYPEAFICODE = ITXVIEWORDERITEMLINKACTIVE.ITEMTYPEAFICODE
                                                    AND PRODUCTIONDEMAND.SUBCODE01 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE01
                                                    AND PRODUCTIONDEMAND.SUBCODE02 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE02
                                                    AND PRODUCTIONDEMAND.SUBCODE03 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE03
                                                    AND PRODUCTIONDEMAND.SUBCODE04 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE04
                                                    AND PRODUCTIONDEMAND.SUBCODE05 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE05
                                                    AND PRODUCTIONDEMAND.SUBCODE06 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE06
                                                    AND PRODUCTIONDEMAND.SUBCODE07 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE07
                                                    AND PRODUCTIONDEMAND.SUBCODE08 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE08
                                                    AND PRODUCTIONDEMAND.SUBCODE09 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE09
                                                    AND PRODUCTIONDEMAND.SUBCODE10 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE10
                                                LEFT JOIN ADSTORAGE a ON a.UNIQUEID = ELEMENTSINSPECTION.ABSUNIQUEID AND FIELDNAME = 'CalculatedLength'
                                                LEFT JOIN SALESORDER b ON b.CODE = PRODUCTIONDEMAND.ORIGDLVSALORDLINESALORDERCODE
                                                LEFT JOIN ORDERPARTNERBRAND ORDERPARTNERBRAND ON b.ORDERPARTNERBRANDCODE = ORDERPARTNERBRAND.CODE
                                                LEFT JOIN ELEMENTSINSPECTIONEVENT c ON c.ELEMENTSINSPECTIONELEMENTCODE = ELEMENTSINSPECTION.ELEMENTCODE
                                                WHERE
                                                    ELEMENTSINSPECTION.INSPECTIONSTARTDATETIME BETWEEN '$Awal ' AND '$Akhir'
                                                    AND ORDERPARTNER.CUSTOMERSUPPLIERTYPE = '1'
                                                    AND ORDERPARTNERBRAND.LONGDESCRIPTION IS NOT NULL
                                                    AND ELEMENTSINSPECTION.ELEMENTITEMTYPECODE = 'KFF' 
                                                    AND c.POINTS IS NOT NULL
                                                GROUP BY 
                                                    c.POINTS,
                                                    PRODUCTIONDEMAND.ORIGDLVSALORDLINESALORDERCODE,
                                                    PRODUCTIONDEMAND.ORIGDLVSALORDERLINEORDERLINE,
                                                    ELEMENTSINSPECTION.ELEMENTCODE,
                                                    ELEMENTSINSPECTION.INSPECTIONINDEX,
                                                    DEMANDCODE,
                                                    LENGTHGROSS,
                                                    a.VALUEDECIMAL,
                                                    ELEMENTSINSPECTION.INSPECTIONSTARTDATETIME,
                                                    ELEMENTSINSPECTION.INSPECTIONSTATION,
                                                    ELEMENTSINSPECTION.ABSUNIQUEID,
                                                    FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION,
                                                    ITXVIEWORDERITEMLINKACTIVE.SHORTDESCRIPTION
                                            )
                                            GROUP BY 
                                                BUYER,
                                                ORIGDLVSALORDLINESALORDERCODE,
                                                ORIGDLVSALORDERLINEORDERLINE,
                                                ELEMENTCODE,
                                                INSPECTIONINDEX,
                                                DEMANDCODE,
                                                LENGTHGROSS,
                                                LENGHTCALC,
                                                INSPECTIONSTARTDATETIME,
                                                INSPECTIONSTATION,
                                                ABSUNIQUEID,
                                                JENISKAIN,
                                                SHORTDESCRIPTION) WHERE BUYER_TERDEPAN = '{$row['BUYERS']}'
                                        GROUP BY 
                                            BUYER_TERDEPAN
                                        ORDER BY POINTSS DESC
                                        FETCH FIRST 5 ROWS ONLY";
                                          $qty_c_stmt = db2_exec($conn1, $qty_c);
                                          $rowqty_c = db2_fetch_assoc($qty_c_stmt);
                                    ?>
                                    <?php 
                                        $total = ($rowqty_a['QTY_A'] + $rowqty_b['QTY_B'] + $rowqty_c['QTY_C']);
                                        $gradeA = ($rowqty_a['QTY_A'] / $total * 100);
                                        $gradeB = ($rowqty_b['QTY_B'] / $total * 100);
                                        $gradeC = ($rowqty_c['QTY_C'] / $total * 100);
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $no; ?></td>
                                        <!-- <td align="center"><?php echo $row['BUYERS']; ?></td> -->
                                        <td align="center">
                                            <a href="Top5Detail-<?php echo rawurlencode($row['BUYERS']); ?>&<?php echo urlencode($Awal); ?>&<?php echo urlencode($Akhir); ?>&<?php echo urlencode($Digit); ?>" target="_blank">
                                                <?php echo $row['BUYERS']; ?>
                                            </a>
                                        </td>
                                        <td align="center">
                                            <?php
                                            if ($Digit == '11') {
                                                echo number_format($row['LENGTHGROSSS'], 2);
                                            } elseif ($Digit == '13') {
                                                echo number_format($row['LENGHTCALCS'], 2);
                                            }
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php
                                            if ($Digit == '11') {
                                                $pembagi = $row['LENGTHGROSSS'] ?? 0;
                                            } elseif ($Digit == '13') {
                                                $pembagi = $row['LENGHTCALCS'] ?? 0;
                                            } else {
                                                $pembagi = 0;
                                            }

                                            $point = $row['POINTSS'] ?? 0;

                                            if ($pembagi != 0 && $point != 0) {
                                                echo number_format(($point * 100) / $pembagi, 2);
                                            } else {
                                                echo '0.00';
                                            }
                                            ?>
                                        </td>
                                        <td align="center"> <?php
                                            if ($Digit == '11') {
                                                echo number_format($rowqty_a['QTY_A'], 2);
                                            } elseif ($Digit == '13') {
                                                echo number_format($rowqty_a['QTY_A'], 2);
                                            }
                                            ?></td>
                                        <td align="center"> <?php
                                            if ($Digit == '11') {
                                                echo number_format($rowqty_b['QTY_B'], 2);
                                            } elseif ($Digit == '13') {
                                                echo number_format($rowqty_b['QTY_B'], 2);
                                            }
                                            ?></td>
                                        <td align="center"> 
                                            <?php
                                                if ($Digit == '11') {
                                                    echo number_format($rowqty_c['QTY_C'], 2);
                                                } elseif ($Digit == '13') {
                                                    echo number_format($rowqty_c['QTY_C'], 2);
                                                }
                                            ?>
                                        </td>
                                        <td align="center"> 
                                            <?php
                                                if ($Digit == '11') {
                                                    echo number_format($total, 2);
                                                } elseif ($Digit == '13') {
                                                    echo number_format($total, 2);
                                                }
                                            ?>
                                        </td>
                                        <td align="center"> 
                                            <?php
                                                if ($Digit == '11') {
                                                    echo number_format($gradeA, 2);
                                                } elseif ($Digit == '13') {
                                                    echo number_format($gradeA, 2);
                                                }
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php
                                                if ($Digit == '11') {
                                                    echo number_format($gradeB, 2);
                                                } elseif ($Digit == '13') {
                                                    echo number_format($gradeB, 2);
                                                }
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php
                                                if ($Digit == '11') {
                                                    echo number_format($gradeC, 2);
                                                } elseif ($Digit == '13') {
                                                    echo number_format($gradeC, 2);
                                                }
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php 
                                                echo rtrim(rtrim(number_format($row['POINTSS'], 2), '0'), '.'); 
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                            <tfoot class="bg-blue">
                                <tr>
                                    <td align="center">
                                        <div align="center">No</div>
                                    </td>
                                    <td align="center">
                                        <div align="center">Buyer</div>
                                    </td>
                                    <td align="center">
                                        <div align="center">QYY YRD</div>
                                    </td>
                                    <td align="center">
                                        <div align="center">UOM</div>
                                    </td>
                                    <td align="center">
                                        <div align="center">GRADE A</div>
                                    </td>
                                    <td align="center">
                                        <div align="center">GRADE B</div>
                                    </td>
                                    <td align="center">
                                        <div align="center">GRADE C</div>
                                    </td>
                                    <td align="center">
                                        <div align="center">TOTAL</div>
                                    </td>
                                    <td align="center">
                                        <div align="center">Grade A %</div>
                                    </td>
                                    <td align="center">
                                        <div align="center">Grade B %</div>
                                    </td>
                                    <td align="center">
                                        <div align="center">Grade C %</div>
                                    </td>
                                    <td align="center">
                                        <div align="center">Total Point</div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        </form>
                    </div>
                    <?php
                } else {
                    echo "Query execution failed: " . db2_stmt_errormsg();
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>