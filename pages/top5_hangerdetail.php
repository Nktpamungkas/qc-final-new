<?PHP

use GuzzleHttp\Psr7\Query;

ini_set("error_reporting", 1);
session_start();
include "koneksi.php";
set_time_limit(0);
?>
<?php
$hanger = isset($_GET['hanger']) ? $_GET['hanger'] : '';
$buyer = isset($_GET['buyer']) ? $_GET['buyer'] : '';
$Awal = isset($_GET['awal']) ? $_GET['awal'] : '';
$Akhir = isset($_GET['akhir']) ? $_GET['akhir'] : '';
$Digit = isset($_GET['digit']) ? $_GET['digit'] : ''; // Corrected parameter name
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Detail Data Top 5 DEFECT</title>
</head>

<body>
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Detail Data Top 5 DEFECT for Hanger: <?php echo htmlspecialchars($hanger); ?></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <b>Tanggal Inspeksi :
                        <?php echo htmlspecialchars($Awal); ?> s.d.
                        <?php echo htmlspecialchars($Akhir); ?>
                    </b> <br><br>
                </div>
                <?php
                    // $qryb1 = "SELECT
                    //     BUYER_TERDEPAN AS BUYERS,
                    //     TRIM(SUBCODE02) || '' || TRIM(SUBCODE03) AS HANGER,
                    //     CODEEVENTCODE || ' - ' || i.SHORTDESCRIPTION AS DEFECT,
                    //     SUM(POINTS) AS POINTSS,
                    //     SUM(LENGTHGROSS) AS LENGTHGROSSS,
                    //     SUM(LENGHTCALC) AS LENGHTCALCS
                    //     FROM
                    //         (
                    //         SELECT
                    //             SUBCODE02,
                    //             SUBCODE03,
                    //             CASE
                    //                 WHEN LOCATE(',', BUYER) > 0 THEN TRIM(SUBSTR(BUYER, 1, LOCATE(',', BUYER) - 1))
                    //                 ELSE BUYER
                    //             END AS BUYER_TERDEPAN,
                    //             SUM(POINTS) AS POINTS,
                    //             ORIGDLVSALORDLINESALORDERCODE,
                    //             ORIGDLVSALORDERLINEORDERLINE,
                    //             ELEMENTCODE,
                    //             INSPECTIONINDEX,
                    //             DEMANDCODE,
                    //             LENGTHGROSS,
                    //             LENGHTCALC,
                    //             INSPECTIONSTARTDATETIME,
                    //             INSPECTIONSTATION,
                    //             ABSUNIQUEID,
                    //             JENISKAIN,
                    //             SHORTDESCRIPTION,
                    //             CODEEVENTCODE
                    //         FROM
                    //             (
                    //             SELECT
                    //                 DISTINCT PRODUCTIONDEMAND.SUBCODE02,
                    //                 PRODUCTIONDEMAND.SUBCODE03,
                    //                 LISTAGG(DISTINCT ORDERPARTNERBRAND.LONGDESCRIPTION,
                    //                 ',') AS BUYER,
                    //                 (c.POINTS),
                    //                 PRODUCTIONDEMAND.ORIGDLVSALORDLINESALORDERCODE,
                    //                 PRODUCTIONDEMAND.ORIGDLVSALORDERLINEORDERLINE,
                    //                 ELEMENTSINSPECTION.ELEMENTCODE,
                    //                 ELEMENTSINSPECTION.INSPECTIONINDEX,
                    //                 ELEMENTSINSPECTION.DEMANDCODE,
                    //                 ELEMENTSINSPECTION.LENGTHGROSS,
                    //                 a.VALUEDECIMAL AS LENGHTCALC,
                    //                 ELEMENTSINSPECTION.INSPECTIONSTARTDATETIME,
                    //                 ELEMENTSINSPECTION.INSPECTIONSTATION,
                    //                 ELEMENTSINSPECTION.ABSUNIQUEID,
                    //                 FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION AS JENISKAIN,
                    //                 ITXVIEWORDERITEMLINKACTIVE.SHORTDESCRIPTION,
                    //                 c.CODEEVENTCODE
                    //             FROM
                    //                 PRODUCTIONDEMAND PRODUCTIONDEMAND
                    //             LEFT JOIN ORDERPARTNER ORDERPARTNER ON
                    //                 PRODUCTIONDEMAND.CUSTOMERCODE = ORDERPARTNER.CUSTOMERSUPPLIERCODE
                    //             LEFT JOIN BUSINESSPARTNER BUSINESSPARTNER ON
                    //                 ORDERPARTNER.ORDERBUSINESSPARTNERNUMBERID = BUSINESSPARTNER.NUMBERID
                    //             LEFT JOIN ELEMENTSINSPECTION ELEMENTSINSPECTION ON
                    //                 PRODUCTIONDEMAND.CODE = ELEMENTSINSPECTION.DEMANDCODE
                    //                 AND PRODUCTIONDEMAND.COUNTERCODE = ELEMENTSINSPECTION.DEMANDCOUNTERCODE
                    //             LEFT JOIN INITIALS INITIALS ON
                    //                 ELEMENTSINSPECTION.OPERATORCODE = INITIALS.CODE
                    //             LEFT JOIN FULLITEMKEYDECODER FULLITEMKEYDECODER ON
                    //                 PRODUCTIONDEMAND.FULLITEMIDENTIFIER = FULLITEMKEYDECODER.IDENTIFIER
                    //             LEFT JOIN ITXVIEWORDERITEMLINKACTIVE ITXVIEWORDERITEMLINKACTIVE ON
                    //                 PRODUCTIONDEMAND.CUSTOMERCODE = ITXVIEWORDERITEMLINKACTIVE.ORDPRNCUSTOMERSUPPLIERCODE
                    //                 AND PRODUCTIONDEMAND.ITEMTYPEAFICODE = ITXVIEWORDERITEMLINKACTIVE.ITEMTYPEAFICODE
                    //                 AND PRODUCTIONDEMAND.SUBCODE01 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE01
                    //                 AND PRODUCTIONDEMAND.SUBCODE02 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE02
                    //                 AND PRODUCTIONDEMAND.SUBCODE03 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE03
                    //                 AND PRODUCTIONDEMAND.SUBCODE04 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE04
                    //                 AND PRODUCTIONDEMAND.SUBCODE05 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE05
                    //                 AND PRODUCTIONDEMAND.SUBCODE06 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE06
                    //                 AND PRODUCTIONDEMAND.SUBCODE07 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE07
                    //                 AND PRODUCTIONDEMAND.SUBCODE08 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE08
                    //                 AND PRODUCTIONDEMAND.SUBCODE09 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE09
                    //                 AND PRODUCTIONDEMAND.SUBCODE10 = ITXVIEWORDERITEMLINKACTIVE.SUBCODE10
                    //             LEFT JOIN ADSTORAGE a ON
                    //                 a.UNIQUEID = ELEMENTSINSPECTION.ABSUNIQUEID
                    //                 AND FIELDNAME = 'CalculatedLength'
                    //             LEFT JOIN SALESORDER b ON
                    //                 b.CODE = PRODUCTIONDEMAND.ORIGDLVSALORDLINESALORDERCODE
                    //             LEFT JOIN ORDERPARTNERBRAND ORDERPARTNERBRAND ON
                    //                 b.ORDERPARTNERBRANDCODE = ORDERPARTNERBRAND.CODE
                    //             LEFT JOIN ELEMENTSINSPECTIONEVENT c ON
                    //                 c.ELEMENTSINSPECTIONELEMENTCODE = ELEMENTSINSPECTION.ELEMENTCODE
                    //             WHERE
                    //                 ELEMENTSINSPECTION.INSPECTIONSTARTDATETIME BETWEEN '$Awal' AND '$Akhir'
                    //                 AND ORDERPARTNER.CUSTOMERSUPPLIERTYPE = '1'
                    //                 AND ORDERPARTNERBRAND.LONGDESCRIPTION IS NOT NULL
                    //                 AND ELEMENTSINSPECTION.ELEMENTITEMTYPECODE = 'KFF'
                    //                 AND c.POINTS IS NOT NULL
                    //             GROUP BY
                    //                 PRODUCTIONDEMAND.SUBCODE02,
                    //                 PRODUCTIONDEMAND.SUBCODE03,
                    //                 c.POINTS,
                    //                 PRODUCTIONDEMAND.ORIGDLVSALORDLINESALORDERCODE,
                    //                 PRODUCTIONDEMAND.ORIGDLVSALORDERLINEORDERLINE,
                    //                 ELEMENTSINSPECTION.ELEMENTCODE,
                    //                 ELEMENTSINSPECTION.INSPECTIONINDEX,
                    //                 ELEMENTSINSPECTION.DEMANDCODE,
                    //                 ELEMENTSINSPECTION.LENGTHGROSS,
                    //                 a.VALUEDECIMAL,
                    //                 ELEMENTSINSPECTION.INSPECTIONSTARTDATETIME,
                    //                 ELEMENTSINSPECTION.INSPECTIONSTATION,
                    //                 ELEMENTSINSPECTION.ABSUNIQUEID,
                    //                 FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION,
                    //                 ITXVIEWORDERITEMLINKACTIVE.SHORTDESCRIPTION,
                    //                 c.CODEEVENTCODE )
                    //         GROUP BY
                    //             SUBCODE02,
                    //             SUBCODE03,
                    //             BUYER,
                    //             ORIGDLVSALORDLINESALORDERCODE,
                    //             ORIGDLVSALORDERLINEORDERLINE,
                    //             ELEMENTCODE,               
                    //             INSPECTIONINDEX,
                    //             DEMANDCODE,
                    //             LENGTHGROSS,
                    //             LENGHTCALC,
                    //             INSPECTIONSTARTDATETIME,
                    //             INSPECTIONSTATION,
                    //             ABSUNIQUEID,
                    //             JENISKAIN,
                    //             SHORTDESCRIPTION,
                    //             CODEEVENTCODE)
                    //     LEFT JOIN INSPECTIONEVENTTEMPLATE i ON
                    //         i.EVENTCODE = CODEEVENTCODE
                    //     WHERE
                    //         BUYER_TERDEPAN = '$buyer' AND TRIM(SUBCODE02) || '' || TRIM(SUBCODE03) = '$hanger'
                    //     GROUP BY
                    //         CODEEVENTCODE,
                    //         i.SHORTDESCRIPTION,
                    //         SUBCODE02,
                    //         SUBCODE03,
                    //         BUYER_TERDEPAN
                    //     ORDER BY
                    //         POINTSS DESC"
                    // ;
                    $qryb1 = " SELECT * FROM 
                        (SELECT
                        TRIM(SUBCODE02) || '' || TRIM(SUBCODE03) AS HANGER,
                        CASE
                            WHEN LOCATE(',', BUYER) > 0 THEN TRIM(SUBSTR(BUYER, 1, LOCATE(',', BUYER) - 1))
                            ELSE BUYER
                        END AS BUYER_TERDEPAN,
                        SUM(POINTS) AS POINTS,
                        MAX(CODEEVENTCODE) AS CODEEVENTCODE,
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
                        FROM
                            (
                            SELECT
                                DISTINCT PRODUCTIONDEMAND.SUBCODE02,
                                PRODUCTIONDEMAND.SUBCODE03,
                                LISTAGG(DISTINCT ORDERPARTNERBRAND.LONGDESCRIPTION,
                                ',') AS BUYER,
                                (c.POINTS),
                                MAX(c.CODEEVENTCODE) AS CODEEVENTCODE,
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
                            LEFT JOIN ORDERPARTNER ORDERPARTNER ON
                                PRODUCTIONDEMAND.CUSTOMERCODE = ORDERPARTNER.CUSTOMERSUPPLIERCODE
                            LEFT JOIN BUSINESSPARTNER BUSINESSPARTNER ON
                                ORDERPARTNER.ORDERBUSINESSPARTNERNUMBERID = BUSINESSPARTNER.NUMBERID
                            LEFT JOIN ELEMENTSINSPECTION ELEMENTSINSPECTION ON
                                PRODUCTIONDEMAND.CODE = ELEMENTSINSPECTION.DEMANDCODE
                                AND PRODUCTIONDEMAND.COUNTERCODE = ELEMENTSINSPECTION.DEMANDCOUNTERCODE
                            LEFT JOIN INITIALS INITIALS ON
                                ELEMENTSINSPECTION.OPERATORCODE = INITIALS.CODE
                            LEFT JOIN FULLITEMKEYDECODER FULLITEMKEYDECODER ON
                                PRODUCTIONDEMAND.FULLITEMIDENTIFIER = FULLITEMKEYDECODER.IDENTIFIER
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
                            LEFT JOIN ADSTORAGE a ON
                                a.UNIQUEID = ELEMENTSINSPECTION.ABSUNIQUEID
                                AND FIELDNAME = 'CalculatedLength'
                            LEFT JOIN SALESORDER b ON
                                b.CODE = PRODUCTIONDEMAND.ORIGDLVSALORDLINESALORDERCODE
                            LEFT JOIN ORDERPARTNERBRAND ORDERPARTNERBRAND ON
                                b.ORDERPARTNERBRANDCODE = ORDERPARTNERBRAND.CODE
                            LEFT JOIN ELEMENTSINSPECTIONEVENT c ON
                                c.ELEMENTSINSPECTIONELEMENTCODE = ELEMENTSINSPECTION.ELEMENTCODE
                            WHERE
                                ELEMENTSINSPECTION.INSPECTIONSTARTDATETIME BETWEEN '$Awal' AND '$Akhir'
                                AND ORDERPARTNER.CUSTOMERSUPPLIERTYPE = '1'
                                AND ORDERPARTNERBRAND.LONGDESCRIPTION IS NOT NULL
                                AND ELEMENTSINSPECTION.ELEMENTITEMTYPECODE = 'KFF'
                                AND c.POINTS IS NOT NULL
                            GROUP BY
                                PRODUCTIONDEMAND.SUBCODE02,
                                PRODUCTIONDEMAND.SUBCODE03,
                                c.POINTS,
                                PRODUCTIONDEMAND.ORIGDLVSALORDLINESALORDERCODE,
                                PRODUCTIONDEMAND.ORIGDLVSALORDERLINEORDERLINE,
                                ELEMENTSINSPECTION.ELEMENTCODE,
                                ELEMENTSINSPECTION.INSPECTIONINDEX,
                                ELEMENTSINSPECTION.DEMANDCODE,
                                LENGTHGROSS,
                                a.VALUEDECIMAL,
                                ELEMENTSINSPECTION.INSPECTIONSTARTDATETIME,
                                ELEMENTSINSPECTION.INSPECTIONSTATION,
                                ELEMENTSINSPECTION.ABSUNIQUEID,
                                FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION,
                                ITXVIEWORDERITEMLINKACTIVE.SHORTDESCRIPTION)
                            GROUP BY
                            SUBCODE02,
                            SUBCODE03,
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
                        WHERE BUYER_TERDEPAN = '$buyer' AND HANGER = '$hanger'"  
                    ;
                    $stmt = db2_exec($conn1, $qryb1, array('cursor' => DB2_SCROLLABLE));
                    if ($stmt) {
                        
                ?>
                <div class="box-body">
                    <table id="example3" class="table table-bordered table-hover table-striped display nowrap" width="100%">
                        <thead class="bg-blue">
                            <tr>
                                <th width="24">
                                    <div align="center">No</div>
                                </th>
                                <th width="78">
                                    <div align="center">DEFECT</div>
                                </th>
                                <th width="24">
                                    <div align="center">TOTAL POINT</div>
                                </th>
                                <th width="78">
                                    <div align="center">PERSENTASI %</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                $totalPoint = $totalPersentase = 0;
                                $grouped = [];
                                $descCache = [];

                                while ($row = db2_fetch_assoc($stmt)) {
                                    $eventcode = $row['CODEEVENTCODE'];

                                    // Kelompokkan POINTS
                                    if (!isset($grouped[$eventcode])) {
                                        $grouped[$eventcode] = [
                                            'POINTS' => 0,
                                            'CODEEVENTCODE' => $eventcode,
                                        ];
                                    }
                                    $grouped[$eventcode]['POINTS'] += $row['POINTS'];
                                    $totalPoint += $row['POINTS'];

                                    if (!isset($descCache[$eventcode])) {
                                        $safeCode = db2_escape_string($eventcode);
                                        $qdesc = "SELECT SHORTDESCRIPTION FROM INSPECTIONEVENTTEMPLATE WHERE EVENTCODE = '$safeCode'";
                                        $descStmt = db2_exec($conn1, $qdesc);
                                        $descRow = db2_fetch_assoc($descStmt);
                                        $descCache[$eventcode] = $descRow ? $descRow['SHORTDESCRIPTION'] : $eventcode;
                                    }
                                }

                                // Urutkan berdasarkan POINTS terbesar
                                usort($grouped, function($a, $b) {
                                    return $b['POINTS'] <=> $a['POINTS'];
                                });

                                // Ambil top 4 dan sisanya
                                $top4 = array_slice($grouped, 0, 4);
                                $sisa = array_slice($grouped, 4);

                                // Tampilkan top 4
                                foreach ($top4 as $item) {
                                    $eventcode = $item['CODEEVENTCODE'];
                                    $desc = $descCache[$eventcode] ?? $eventcode;
                                    $points = $item['POINTS'];
                                    $persentase = $totalPoint > 0 ? ($points / $totalPoint) * 100 : 0;
                                    $totalPersentase += $persentase;
                                ?>
                                <tr>
                                    <td align="center"><?php echo $no++; ?></td>
                                    <td align="center"><?php echo $eventcode . ' - ' . $desc; ?></td>
                                    <td align="center"><?php echo number_format($points, 2); ?></td>
                                    <td align="center"><?php echo number_format($persentase, 2); ?>%</td>
                                </tr>
                            <?php
                            }

                            $lainPoint = 0;
                            foreach ($sisa as $item) {
                                $lainPoint += $item['POINTS'];
                            }

                            $lainPersentase = $totalPoint > 0 ? ($lainPoint / $totalPoint) * 100 : 0;
                            $totalPersentase += $lainPersentase;

                            if ($lainPoint > 0) {
                            ?>
                            <tr>
                                <td align="center"><?php echo $no++; ?></td>
                                <td align="center">Lain-lain</td>
                                <td align="center"><?php echo number_format($lainPoint, 2); ?></td>
                                <td align="center"><?php echo number_format($lainPersentase, 2); ?>%</td>
                            </tr>
                            <?php } ?>
                        </tbody>

                        <tfoot class="bg-blue">
                            <tr>
                                <td align="center" colspan="2"><div align="center">TOTAL </div></td>
                                <td align="center"><div align="center"><?php echo number_format($totalPoint, 2); ?></div></td>
                                <td align="center"><div align="center"><?php echo number_format($totalPersentase, 2); ?>%</div></td>
                            </tr>
                        </tfoot>
                    </table>
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