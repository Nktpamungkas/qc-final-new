<?PHP
    ini_set("error_reporting", 1);
    session_start();
    include "koneksi.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Aftersales NOW</title>
</head>

<body>
    <?php
        $Order  = isset($_POST['order']) ? $_POST['order'] : '';
        $PO  = isset($_POST['po']) ? $_POST['po'] : '';
        $ArticleGrup  = isset($_POST['ag']) ? $_POST['ag'] : '';
        $Pelanggan  = isset($_POST['pelanggan']) ? $_POST['pelanggan'] : '';
        $ArticleCode  = isset($_POST['ac']) ? $_POST['ac'] : '';
        $Warna  = isset($_POST['warna']) ? $_POST['warna'] : '';
        $Prodorder  = isset($_POST['prodorder']) ? $_POST['prodorder'] : '';
        $tgl_awal  = isset($_POST['tgl_awal']) ? $_POST['tgl_awal'] : '';
        $tgl_akhir  = isset($_POST['tgl_akhir']) ? $_POST['tgl_akhir'] : '';
    ?>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"> Filter Data Pengiriman NOW</h3>
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
                        <input name="tgl_awal" type="date" class="form-control pull-right" placeholder="Tgl Awal Pengiriman" value="<?php echo $tgl_awal;  ?>" />
                    </div>
                    <div class="col-sm-2">
                        <input name="tgl_akhir" type="date" class="form-control pull-right" placeholder="Tgl Akhir Pengiriman" value="<?php echo $tgl_akhir;  ?>" />
                    </div>

                    <!-- /.input group -->
                </div>
                <div class="form-group">
                    <div class="col-sm-2">
                        <input name="po" type="text" class="form-control pull-right" id="po" placeholder="No PO" value="<?php echo $PO;  ?>" />
                    </div>
                    <div class="col-sm-2">
                        <input name="order" type="text" class="form-control pull-right" id="order" placeholder="No Order" value="<?php echo $Order;  ?>" />
                    </div>
                    <div class="col-sm-2">
                        <input name="ag" type="text" class="form-control pull-right" id="ag" placeholder="Article Group" value="<?php echo $ArticleGrup;  ?>" />
                    </div>
                    <div class="col-sm-2">
                        <input name="pelanggan" type="text" class="form-control pull-right" id="pelanggan" placeholder="Pelanggan" value="<?php echo $Pelanggan;  ?>" />
                    </div>
                    <!-- /.input group -->
                </div>
                <div class="form-group">
                    <div class="col-sm-2">
                        <input name="ac" type="text" class="form-control pull-right" id="ac" placeholder="Article Code" value="<?php echo $ArticleCode;  ?>" />
                    </div>

                    <div class="col-sm-3">
                        <input name="warna" type="text" class="form-control pull-right" id="warna" placeholder="Warna" value="<?php echo $Warna;  ?>" />
                    </div>
                    <div class="col-sm-2">
                        <input name="prodorder" type="text" class="form-control pull-right" id="prodorder" placeholder="Prod. Order" value="<?php echo $Prodorder;  ?>" />
                    </div>
                </div>
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

    <?php if (isset($_POST['save'])) { ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Pengiriman NOW</h3><br>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-hover table-striped nowrap" id="example3" style="width:100%">
                            <thead class="bg-blue">
                                <tr>
                                    <th>
                                        <div align="center">Tgl Kirim</div>
                                    </th>
                                    <th>
                                        <div align="center">No SJ</div>
                                    </th>
                                    <th>
                                        <div align="center">No PO</div>
                                    </th>
                                    <th>
                                        <div align="center">No Order</div>
                                    </th>
                                    <th>
                                        <div align="center">Hanger</div>
                                    </th>
                                    <th>
                                        <div align="center">Roll</div>
                                    </th>
                                    <th>
                                        <div align="center">KG</div>
                                    </th>
                                    <th>
                                        <div align="center">Yd/Mtr</div>
                                    </th>
                                    <th>
                                        <div align="center">Production Order</div>
                                    </th>
                                    <th>
                                        <div align="center">Warna</div>
                                    </th>
                                    <th>
                                        <div align="center">Note</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;

                                if ($tgl_awal != '') {
                                    $tgl_awal = $_POST['tgl_awal'];
                                } else {
                                    $tgl_awal = '1990-01-01';
                                };

                                if ($tgl_akhir != '') {
                                    $tgl_akhir = $_POST['tgl_akhir'];
                                } else {
                                    $tgl_akhir = date("Y-m-d");
                                }
                                if ($tgl_awal != "") {
                                    $Where = " (CASE
                                                    WHEN SALESDOCUMENT.GOODSISSUEDATE IS NOT NULL THEN SALESDOCUMENT.GOODSISSUEDATE
                                                    ELSE SALESDOCUMENT.PROVISIONALDOCUMENTDATE
                                                END) BETWEEN '$tgl_awal' AND '$tgl_akhir' AND ";
                                }

                                if ($tgl_awal != "" or $Order != "" or $PO != "" or $ArticleGrup != "" or $ArticleCode != "" or $Warna != "" or $Prodorder != "" or $Pelanggan != "") {
                                    $sqlDB2 = "SELECT
                                                    SALESDOCUMENTLINE.SALESDOCUMENTPROVISIONALCODE,
                                                    SALESDOCUMENTLINE.ORDERLINE,
                                                    CASE
                                                        WHEN SALESDOCUMENT.GOODSISSUEDATE IS NULL THEN SALESDOCUMENT.PROVISIONALDOCUMENTDATE
                                                        ELSE SALESDOCUMENT.GOODSISSUEDATE
                                                    END AS TGL_KIRIM,
                                                    SALESDOCUMENTLINE.DLVSALORDERLINESALESORDERCODE,
                                                    SALESDOCUMENTLINE.DLVSALESORDERLINEORDERLINE,
                                                    TRIM(SALESDOCUMENTLINE.SUBCODE02) AS SUBCODE02,
                                                    TRIM(SALESDOCUMENTLINE.SUBCODE03) AS SUBCODE03,
                                                    TRIM(SALESDOCUMENTLINE.SUBCODE05) AS SUBCODE05,
                                                    CASE
                                                        WHEN SALESORDER.EXTERNALREFERENCE IS NULL THEN SALESORDERLINE.EXTERNALREFERENCE
                                                        ELSE SALESORDER.EXTERNALREFERENCE
                                                    END AS PO_NUMBER,
                                                    SUM(A.ROLL) AS ROLL,
                                                    SUM(A.USERPRIMARYQUANTITY) AS KG,
                                                    A.USERPRIMARYUOMCODE,
                                                    SUM(A.USERSECONDARYQUANTITY) AS YARD,
                                                    A.USERSECONDARYUOMCODE,
                                                    ITXVIEWCOLOR.WARNA,
                                                    A.LOTCODE,
                                                    CASE
                                                        WHEN SALESDOCUMENT.PAYMENTMETHODCODE = 'FOC' THEN 'FOC'
                                                        WHEN ELEMENTSINSPECTION.QUALITYREASONCODE = 'FOC' THEN 'FOC'
                                                        ELSE ''
                                                    END AS NOTE,
                                                    ITXVIEW_PELANGGAN.LANGGANAN
                                                FROM
                                                    SALESDOCUMENTLINE SALESDOCUMENTLINE
                                                LEFT JOIN ALLOCATION ALLOCATION ON SALESDOCUMENTLINE.SALESDOCUMENTPROVISIONALCODE = ALLOCATION.ORDERCODE
                                                    AND SALESDOCUMENTLINE.ORDERLINE = ALLOCATION.ORDERLINE
                                                LEFT JOIN SALESDOCUMENT SALESDOCUMENT ON SALESDOCUMENTLINE.SALESDOCUMENTPROVISIONALCODE = SALESDOCUMENT.PROVISIONALCODE
                                                LEFT JOIN SALESORDER SALESORDER ON SALESDOCUMENTLINE.DLVSALORDERLINESALESORDERCODE = SALESORDER.CODE
                                                LEFT JOIN SALESORDERLINE SALESORDERLINE ON SALESDOCUMENTLINE.DLVSALORDERLINESALESORDERCODE = SALESORDERLINE.SALESORDERCODE
                                                    AND SALESDOCUMENTLINE.DLVSALESORDERLINEORDERLINE = SALESORDERLINE.ORDERLINE
                                                LEFT JOIN (
                                                        SELECT
                                                            ALLOCATION.CODE,
                                                            ALLOCATION.LOTCODE,
                                                            COUNT(ALLOCATION.ITEMELEMENTCODE) AS ROLL,
                                                            SUM(ALLOCATION.USERPRIMARYQUANTITY) AS USERPRIMARYQUANTITY,
                                                            ALLOCATION.USERPRIMARYUOMCODE,
                                                            SUM(ALLOCATION.USERSECONDARYQUANTITY) AS USERSECONDARYQUANTITY,
                                                            ALLOCATION.USERSECONDARYUOMCODE,
                                                            ALLOCATION.ITEMELEMENTCODE
                                                        FROM
                                                            ALLOCATION ALLOCATION
                                                        WHERE
                                                            ALLOCATION.DETAILTYPE = '0'
                                                        GROUP BY
                                                            ALLOCATION.CODE,
                                                            ALLOCATION.LOTCODE,
                                                            ALLOCATION.USERPRIMARYUOMCODE,
                                                            ALLOCATION.USERSECONDARYUOMCODE,
                                                            ALLOCATION.ITEMELEMENTCODE
                                                    ) A ON ALLOCATION.CODE = A.CODE
                                                LEFT JOIN ITXVIEWCOLOR ITXVIEWCOLOR ON SALESDOCUMENTLINE.ITEMTYPEAFICODE = ITXVIEWCOLOR.ITEMTYPECODE
                                                    AND SALESDOCUMENTLINE.SUBCODE01 = ITXVIEWCOLOR.SUBCODE01
                                                    AND SALESDOCUMENTLINE.SUBCODE02 = ITXVIEWCOLOR.SUBCODE02
                                                    AND SALESDOCUMENTLINE.SUBCODE03 = ITXVIEWCOLOR.SUBCODE03
                                                    AND SALESDOCUMENTLINE.SUBCODE04 = ITXVIEWCOLOR.SUBCODE04
                                                    AND SALESDOCUMENTLINE.SUBCODE05 = ITXVIEWCOLOR.SUBCODE05
                                                    AND SALESDOCUMENTLINE.SUBCODE06 = ITXVIEWCOLOR.SUBCODE06
                                                    AND SALESDOCUMENTLINE.SUBCODE07 = ITXVIEWCOLOR.SUBCODE07
                                                    AND SALESDOCUMENTLINE.SUBCODE08 = ITXVIEWCOLOR.SUBCODE08
                                                    AND SALESDOCUMENTLINE.SUBCODE09 = ITXVIEWCOLOR.SUBCODE09
                                                    AND SALESDOCUMENTLINE.SUBCODE10 = ITXVIEWCOLOR.SUBCODE10
                                                LEFT JOIN ITXVIEW_PELANGGAN ON 	ITXVIEW_PELANGGAN.CODE = SALESDOCUMENTLINE.DLVSALORDERLINESALESORDERCODE
                                                LEFT JOIN ELEMENTSINSPECTION ELEMENTSINSPECTION ON ELEMENTSINSPECTION.ELEMENTCODE = A.ITEMELEMENTCODE
                                                WHERE 
                                                    $Where
                                                    SALESDOCUMENT.DOCUMENTTYPETYPE = '05'
                                                    AND ALLOCATION.ORIGINTRNTRANSACTIONNUMBER IS NULL
                                                    AND SALESDOCUMENTLINE.DLVSALORDERLINESALESORDERCODE LIKE '%$Order%'
                                                    AND (SALESORDER.EXTERNALREFERENCE LIKE '%$PO%' OR SALESORDERLINE.EXTERNALREFERENCE LIKE '%$PO%')
                                                    AND SALESDOCUMENTLINE.SUBCODE02 LIKE '%$ArticleGrup%'
                                                    AND SALESDOCUMENTLINE.SUBCODE03 LIKE '%$ArticleCode%'
                                                    AND ITXVIEWCOLOR.WARNA LIKE '%$Warna%'
                                                    AND A.LOTCODE LIKE '%$Prodorder%'
                                                    AND (ITXVIEW_PELANGGAN.LANGGANAN LIKE '%$Pelanggan%' OR ITXVIEW_PELANGGAN.BUYER LIKE '%$Pelanggan%')
                                                GROUP BY
                                                    SALESDOCUMENTLINE.SALESDOCUMENTPROVISIONALCODE,
                                                    SALESDOCUMENTLINE.ORDERLINE,
                                                    SALESDOCUMENT.GOODSISSUEDATE,
                                                    SALESDOCUMENT.PROVISIONALDOCUMENTDATE,
                                                    SALESDOCUMENTLINE.DLVSALORDERLINESALESORDERCODE,
                                                    SALESDOCUMENTLINE.DLVSALESORDERLINEORDERLINE,
                                                    SALESDOCUMENTLINE.SUBCODE02,
                                                    SALESDOCUMENTLINE.SUBCODE03,
                                                    SALESDOCUMENTLINE.SUBCODE05,
                                                    SALESORDER.EXTERNALREFERENCE,
                                                    SALESORDERLINE.EXTERNALREFERENCE,
                                                    A.USERPRIMARYUOMCODE,
                                                    A.USERSECONDARYUOMCODE,
                                                    ITXVIEWCOLOR.WARNA,
                                                    A.LOTCODE,
                                                    SALESDOCUMENT.PAYMENTMETHODCODE,
                                                    ITXVIEW_PELANGGAN.LANGGANAN,
                                                    ELEMENTSINSPECTION.QUALITYREASONCODE";
                                } else {
                                    $sqlDB2 = "SELECT
                                                SALESDOCUMENTLINE.SALESDOCUMENTPROVISIONALCODE,
                                                SALESDOCUMENTLINE.ORDERLINE,
                                                CASE
                                                    WHEN SALESDOCUMENT.GOODSISSUEDATE IS NULL THEN SALESDOCUMENT.PROVISIONALDOCUMENTDATE
                                                    ELSE SALESDOCUMENT.GOODSISSUEDATE
                                                END AS TGL_KIRIM,
                                                SALESDOCUMENTLINE.DLVSALORDERLINESALESORDERCODE,
                                                SALESDOCUMENTLINE.DLVSALESORDERLINEORDERLINE,
                                                TRIM(SALESDOCUMENTLINE.SUBCODE02) AS SUBCODE02,
                                                TRIM(SALESDOCUMENTLINE.SUBCODE03) AS SUBCODE03,
                                                TRIM(SALESDOCUMENTLINE.SUBCODE05) AS SUBCODE05,
                                                CASE
                                                    WHEN SALESORDER.EXTERNALREFERENCE IS NULL THEN SALESORDERLINE.EXTERNALREFERENCE
                                                    ELSE SALESORDER.EXTERNALREFERENCE
                                                END AS PO_NUMBER,
                                                SUM(A.ROLL) AS ROLL,
                                                SUM(A.USERPRIMARYQUANTITY) AS KG,
                                                A.USERPRIMARYUOMCODE,
                                                SUM(A.USERSECONDARYQUANTITY) AS YARD,
                                                A.USERSECONDARYUOMCODE,
                                                ITXVIEWCOLOR.WARNA,
                                                A.LOTCODE,
                                                CASE
                                                    WHEN SALESDOCUMENT.PAYMENTMETHODCODE = 'FOC' THEN 'FOC'
                                                    ELSE ''
                                                END AS NOTE,
                                                ITXVIEW_PELANGGAN.LANGGANAN
                                            FROM
                                                SALESDOCUMENTLINE SALESDOCUMENTLINE
                                            LEFT JOIN ALLOCATION ALLOCATION ON SALESDOCUMENTLINE.SALESDOCUMENTPROVISIONALCODE = ALLOCATION.ORDERCODE
                                                AND SALESDOCUMENTLINE.ORDERLINE = ALLOCATION.ORDERLINE
                                            LEFT JOIN SALESDOCUMENT SALESDOCUMENT ON SALESDOCUMENTLINE.SALESDOCUMENTPROVISIONALCODE = SALESDOCUMENT.PROVISIONALCODE
                                            LEFT JOIN SALESORDER SALESORDER ON SALESDOCUMENTLINE.DLVSALORDERLINESALESORDERCODE = SALESORDER.CODE
                                            LEFT JOIN SALESORDERLINE SALESORDERLINE ON SALESDOCUMENTLINE.DLVSALORDERLINESALESORDERCODE = SALESORDERLINE.SALESORDERCODE
                                                AND SALESDOCUMENTLINE.DLVSALESORDERLINEORDERLINE = SALESORDERLINE.ORDERLINE
                                            LEFT JOIN (
                                                    SELECT
                                                        ALLOCATION.CODE,
                                                        ALLOCATION.LOTCODE,
                                                        COUNT(ALLOCATION.ITEMELEMENTCODE) AS ROLL,
                                                        SUM(ALLOCATION.USERPRIMARYQUANTITY) AS USERPRIMARYQUANTITY,
                                                        ALLOCATION.USERPRIMARYUOMCODE,
                                                        SUM(ALLOCATION.USERSECONDARYQUANTITY) AS USERSECONDARYQUANTITY,
                                                        ALLOCATION.USERSECONDARYUOMCODE
                                                    FROM
                                                        ALLOCATION ALLOCATION
                                                    WHERE
                                                        ALLOCATION.DETAILTYPE = '0'
                                                    GROUP BY
                                                        ALLOCATION.CODE,
                                                        ALLOCATION.LOTCODE,
                                                        ALLOCATION.USERPRIMARYUOMCODE,
                                                        ALLOCATION.USERSECONDARYUOMCODE
                                                ) A ON ALLOCATION.CODE = A.CODE
                                            LEFT JOIN ITXVIEWCOLOR ITXVIEWCOLOR ON SALESDOCUMENTLINE.ITEMTYPEAFICODE = ITXVIEWCOLOR.ITEMTYPECODE
                                                AND SALESDOCUMENTLINE.SUBCODE01 = ITXVIEWCOLOR.SUBCODE01
                                                AND SALESDOCUMENTLINE.SUBCODE02 = ITXVIEWCOLOR.SUBCODE02
                                                AND SALESDOCUMENTLINE.SUBCODE03 = ITXVIEWCOLOR.SUBCODE03
                                                AND SALESDOCUMENTLINE.SUBCODE04 = ITXVIEWCOLOR.SUBCODE04
                                                AND SALESDOCUMENTLINE.SUBCODE05 = ITXVIEWCOLOR.SUBCODE05
                                                AND SALESDOCUMENTLINE.SUBCODE06 = ITXVIEWCOLOR.SUBCODE06
                                                AND SALESDOCUMENTLINE.SUBCODE07 = ITXVIEWCOLOR.SUBCODE07
                                                AND SALESDOCUMENTLINE.SUBCODE08 = ITXVIEWCOLOR.SUBCODE08
                                                AND SALESDOCUMENTLINE.SUBCODE09 = ITXVIEWCOLOR.SUBCODE09
                                                AND SALESDOCUMENTLINE.SUBCODE10 = ITXVIEWCOLOR.SUBCODE10
                                            LEFT JOIN ITXVIEW_PELANGGAN ON ITXVIEW_PELANGGAN.CODE = SALESDOCUMENTLINE.DLVSALORDERLINESALESORDERCODE
                                            WHERE
                                                (CASE
                                                    WHEN SALESDOCUMENT.GOODSISSUEDATE IS NOT NULL THEN SALESDOCUMENT.GOODSISSUEDATE
                                                    ELSE SALESDOCUMENT.PROVISIONALDOCUMENTDATE
                                                END) BETWEEN '$tgl_awal' AND '$tgl_akhir'
                                                AND SALESDOCUMENT.DOCUMENTTYPETYPE = '05'
                                                AND ALLOCATION.ORIGINTRNTRANSACTIONNUMBER IS NULL
                                                AND SALESDOCUMENTLINE.DLVSALORDERLINESALESORDERCODE LIKE '$Order'
                                                AND (SALESORDER.EXTERNALREFERENCE LIKE '$PO' OR SALESORDERLINE.EXTERNALREFERENCE LIKE '$PO')
                                                AND TRIM(SALESDOCUMENTLINE.SUBCODE02) LIKE '$ArticleGrup'
                                                AND TRIM(SALESDOCUMENTLINE.SUBCODE03) LIKE '$ArticleCode'
                                                AND ITXVIEWCOLOR.WARNA LIKE '$Warna'
                                                AND A.LOTCODE LIKE '$Prodorder'
                                                AND ITXVIEW_PELANGGAN.LANGGANAN LIKE '$Pelanggan'
                                            GROUP BY
                                                SALESDOCUMENTLINE.SALESDOCUMENTPROVISIONALCODE,
                                                SALESDOCUMENTLINE.ORDERLINE,
                                                SALESDOCUMENT.GOODSISSUEDATE,
                                                SALESDOCUMENT.PROVISIONALDOCUMENTDATE,
                                                SALESDOCUMENTLINE.DLVSALORDERLINESALESORDERCODE,
                                                SALESDOCUMENTLINE.DLVSALESORDERLINEORDERLINE,
                                                SALESDOCUMENTLINE.SUBCODE02,
                                                SALESDOCUMENTLINE.SUBCODE03,
                                                SALESDOCUMENTLINE.SUBCODE05,
                                                SALESORDER.EXTERNALREFERENCE,
                                                SALESORDERLINE.EXTERNALREFERENCE,
                                                A.USERPRIMARYUOMCODE,
                                                A.USERSECONDARYUOMCODE,
                                                ITXVIEWCOLOR.WARNA,
                                                A.LOTCODE,
                                                SALESDOCUMENT.PAYMENTMETHODCODE,
                                                ITXVIEW_PELANGGAN.LANGGANAN";
                                }
                                $stmt = db2_exec($conn1, $sqlDB2, array('cursor' => DB2_SCROLLABLE));
                                while ($row1 = db2_fetch_assoc($stmt)) {
                                ?>
                                    <tr bgcolor="<?php echo $bgcolor; ?>">
                                        <td align="center"><?php echo $row1['TGL_KIRIM']; ?></td>
                                        <td align="center"><a href="#" id='<?php echo $row1['SALESDOCUMENTPROVISIONALCODE']; ?>' nowarna='<?php echo $row1['SUBCODE05']; ?>' project='<?php echo $row1['DLVSALORDERLINESALESORDERCODE']; ?>' lotcode='<?php echo $row1['LOTCODE']; ?>' foc='<?= trim($row1['NOTE'] ?: '') ?>' class="detail_kirim_kain"><?php echo $row1['SALESDOCUMENTPROVISIONALCODE']; ?></a></td>
                                        <td align="center"><?php echo $row1['PO_NUMBER']; ?></td>
                                        <td align="center"><?php echo $row1['DLVSALORDERLINESALESORDERCODE']; ?></td>
                                        <td align="center"><?php echo $row1['SUBCODE02'] . $row1['SUBCODE03']; ?></td>
                                        <td align="center"><?php echo $row1['ROLL']; ?></td>
                                        <td align="center"><?php echo str_replace(",", "", number_format($row1['KG'], 2)) ?></td>
                                        <td align="center"><?php echo str_replace(",", "", number_format($row1['YARD'], 2)) ?></td>
                                        <td align="center"><?php echo $row1['LOTCODE']; ?></td>
                                        <td align="center"><?php echo $row1['WARNA']; ?></td>
                                        <td align="center"><?php echo $row1['NOTE']; ?></td>
                                    </tr>
                                <?php $no++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php  } ?>
    <div class="modal fade" id="modal_del" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="margin-top:100px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete all data ?</h4>
                </div>

                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="delete_link">Delete</a>
                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div id="StsGKEdit" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
    <div id="DetailKirimKain" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
    <script type="text/javascript">
        function confirm_delete(delete_url) {
            $('#modal_del').modal('show', {
                backdrop: 'static'
            });
            document.getElementById('delete_link').setAttribute('href', delete_url);
        }
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>

</html>