<?php
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";
include "../../tgl_indo.php";
//--
$idkk = $_REQUEST['idkk'];
$act = $_GET['g'];
//-
$Awal = $_GET['Awal'];
$Akhir = $_GET['akhir'];
//$Dept=$_GET['dept'];
//$Cancel=$_GET['cancel'];
$qTgl = mysqli_query($con, "SELECT DATE_FORMAT(now(),'%Y-%m-%d') as tgl_skrg,DATE_FORMAT(now(),'%H:%i:%s') as jam_skrg");
$rTgl = mysqli_fetch_array($qTgl);
//$tgl=$rTgl['tgl_skrg'];//tambahan 
//$jam=$rTgl['jam_skrg'];//tambahan
if ($Awal != "") {
    $tgl = substr($Awal, 0, 10);
    $jam = $Awal;
} else {
    $tgl = $rTgl['tgl_skrg'];
    $jam = $rTgl['jam_skrg'];
}
$qry = mysqli_query($con, "SELECT a.langganan, b.* FROM tbl_aftersales_now a
INNER JOIN tbl_detail_retur_now b ON a.id=b.id_nsp
WHERE b.id_nsp='$_GET[id_nsp]' AND b.po='$_GET[po]' AND b.no_order='$_GET[no_order]'");
$r = mysqli_fetch_array($qry);
$qry1 = mysqli_query($con, "SELECT * FROM tbl_detail_retur_now WHERE id_nsp='$_GET[id_nsp]' LIMIT 1");
$r1 = mysqli_fetch_array($qry1);

$qrybon = mysqli_query($con, "SELECT * FROM tbl_detail_retur_now WHERE id='$_GET[id_cek]' LIMIT 1");
$rbon = mysqli_fetch_array($qrybon);
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- <link href="styles_cetak.css" rel="stylesheet" type="text/css"> -->
    <title>Cetak Retur</title>
    <script>
        // set portrait orientation

        jsPrintSetup.setOption('orientation', jsPrintSetup.kPortraitOrientation);

        // set top margins in millimeters
        jsPrintSetup.setOption('marginTop', 0);
        jsPrintSetup.setOption('marginBottom', 0);
        jsPrintSetup.setOption('marginLeft', 0);
        jsPrintSetup.setOption('marginRight', 0);

        // set page header
        jsPrintSetup.setOption('headerStrLeft', '');
        jsPrintSetup.setOption('headerStrCenter', '');
        jsPrintSetup.setOption('headerStrRight', '');

        // set empty page footer
        jsPrintSetup.setOption('footerStrLeft', '');
        jsPrintSetup.setOption('footerStrCenter', '');
        jsPrintSetup.setOption('footerStrRight', '');

        // clears user preferences always silent print value
        // to enable using 'printSilent' option
        jsPrintSetup.clearSilentPrint();

        // Suppress print dialog (for this context only)
        jsPrintSetup.setOption('printSilent', 1);

        // Do Print 
        // When print is submitted it is executed asynchronous and
        // script flow continues after print independently of completetion of print process! 
        jsPrintSetup.print();

        window.addEventListener('load', function () {
            var rotates = document.getElementsByClassName('rotate');
            for (var i = 0; i < rotates.length; i++) {
                rotates[i].style.height = rotates[i].offsetWidth + 'px';
            }
        });
        // next commands
    </script>
    <style>
        body,
        td,
        th {
            /*font-family: Courier New, Courier, monospace; */
            /* font-family: sans-serif, Roman, serif; */
            font-family: 'Times New Roman', Times, serif;
        }

        pre {
            font-family: 'Times New Roman', Times, serif;
            clear: both;
            margin: 0px auto 0px;
            padding: 0px;
            white-space: pre-wrap;
            /* Since CSS 2.1 */
            white-space: -moz-pre-wrap;
            /* Mozilla, since 1999 */
            white-space: -pre-wrap;
            /* Opera 4-6 */
            white-space: -o-pre-wrap;
            /* Opera 7 */
            word-wrap: break-word;
        }

        body {
            margin: 0px auto 0px;
            padding: 2px;
            font-size: 8px;
            color: #000;
            width: 98%;
            background-position: top;
            background-color: #fff;
        }

        .table-list {
            clear: both;
            text-align: left;
            border-collapse: collapse;
            margin: 0px 0px 10px 0px;
            background: #fff;
        }

        .table-list td {
            color: #333;
            font-size: 12px;
            border-color: #fff;
            border-collapse: collapse;
            vertical-align: center;
            padding: 3px 5px;
            border-bottom: 1px #000000 solid;
            border-left: 1px #000000 solid;
            border-right: 1px #000000 solid;
        }

        .table-list1 {
            clear: both;
            text-align: left;
            border-collapse: collapse;
            margin: 0px 0px 5px 0px;
            background: #fff;
        }

        .table-list1 td {
            color: #333;
            font-size: 11px;
            border-color: #fff;
            border-collapse: collapse;
            vertical-align: center;
            padding: 1px 3px;
            border-bottom: 1px #000000 solid;
            border-top: 1px #000000 solid;
            border-left: 1px #000000 solid;
            border-right: 1px #000000 solid;
        }

        #nocetak {
            display: none;
        }

        /* --> */


        .hurufvertical {
            writing-mode: tb-rl;
            -webkit-transform: rotate(-90deg);
            -moz-transform: rotate(-90deg);
            -o-transform: rotate(-90deg);
            -ms-transform: rotate(-90deg);
            transform: rotate(180deg);
            white-space: nowrap;
            float: left;
        }

        input {
            text-align: center;
            border: hidden;
            font-size: 9px;
            /* font-family:sans-serif, Roman, serif;	 */
            font-family: 'Times New Roman', Times, serif;
        }

        @media print {
            ::-webkit-input-placeholder {
                /* WebKit browsers */
                color: transparent;
            }

            :-moz-placeholder {
                /* Mozilla Firefox 4 to 18 */
                color: transparent;
            }

            ::-moz-placeholder {
                /* Mozilla Firefox 19+ */
                color: transparent;
            }

            :-ms-input-placeholder {
                /* Internet Explorer 10+ */
                color: transparent;
            }

            .pagebreak {
                page-break-before: always;
            }

            .header {
                display: block
            }

            table thead {
                display: table-header-group;
            }

        }
    </style>
</head>
<?php
$nmBln = array(1 => "JANUARI", "FEBUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER");
?>

<body>
    <table>
        <thead>
            <tr>
                <td>
                    <table border="1" class="table-list1" style="width:7in;">
                        <tr>
                            <td width="10%" align="center"><img src="Indo.jpg" width="50" height="50
        " alt="" /></td>
                            <td width="58%" align="center">
                                <font size="+1"><strong>SURAT PENGAMBILAN BARANG RETUR<br />PT. INDO TAICHEN TEXTILE
                                        INDUSTRY<br /></font>
                                <?php echo $rbon['no_retur']; ?>
                                </strong>
                            </td>
                            <td width="32%" align="center">
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="36%" style="border-top:0px #000000 solid; 
    border-bottom:0px #000000 solid;
    border-left:0px #000000 solid; 
    border-right:0px #000000 solid;">No Form</td>
                                            <td width="5%" style="border-top:0px #000000 solid; 
    border-bottom:0px #000000 solid;
    border-left:0px #000000 solid; 
    border-right:0px #000000 solid;">:</td>
                                            <td width="59%" style="border-top:0px #000000 solid; 
    border-bottom:0px #000000 solid;
    border-left:0px #000000 solid; 
    border-right:0px #000000 solid;">06-07</td>
                                        </tr>
                                        <tr>
                                            <td style="border-top:0px #000000 solid; 
    border-bottom:0px #000000 solid;
    border-left:0px #000000 solid; 
    border-right:0px #000000 solid;">No Revisi</td>
                                            <td style="border-top:0px #000000 solid; 
    border-bottom:0px #000000 solid;
    border-left:0px #000000 solid; 
    border-right:0px #000000 solid;">:</td>
                                            <td style="border-top:0px #000000 solid; 
    border-bottom:0px #000000 solid;
    border-left:0px #000000 solid; 
    border-right:0px #000000 solid;">01</td>
                                        </tr>
                                        <tr>
                                            <td style="border-top:0px #000000 solid; 
    border-bottom:0px #000000 solid;
    border-left:0px #000000 solid; 
    border-right:0px #000000 solid;">Tgl Revisi</td>
                                            <td style="border-top:0px #000000 solid; 
    border-bottom:0px #000000 solid;
    border-left:0px #000000 solid; 
    border-right:0px #000000 solid;">:</td>
                                            <td style="border-top:0px #000000 solid; 
    border-bottom:0px #000000 solid;
    border-left:0px #000000 solid; 
    border-right:0px #000000 solid;">20 November 2020</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </thead>

        <tr>
            <td>
                <table border="0" class="table-list1" style="width:7in; height:0.7in;">
                    <tbody>
                        <tr>
                            <td width="100%" align="left" valign="top">No. PO : <span style="border-top:0px #000000 solid; 
                border-bottom:0px #000000 solid;
                border-left:0px #000000 solid; 
                border-right:0px #000000 solid;"><?php echo $r['po']; ?></span></td>
                        </tr>
                        <tr>
                            <td width="100%" align="left" valign="top">No. Order : <span style="border-top:0px #000000 solid; 
                border-bottom:0px #000000 solid;
                border-left:0px #000000 solid; 
                border-right:0px #000000 solid;"><?php echo $r['no_order']; ?></span></td>
                        </tr>
                        <tr>
                            <td width="100%" align="left" valign="top">Nama Langganan : <span style="border-top:0px #000000 solid; 
                border-bottom:0px #000000 solid;
                border-left:0px #000000 solid; 
                border-right:0px #000000 solid;"><?php echo $r['langganan']; ?></span></td>
                        </tr>

                        <table style="width:7in; height:3.2in;" border="0" class="table-list1">
                            <tr>
                                <td width="14%" rowspan="2" align="center">Masalah</td>
                                <td width="40%" rowspan="2" align="center">Jenis Kain</td>
                                <td width="10%" rowspan="2" align="center">Warna</td>
                                <td width="5%" rowspan="2" align="center">Lot</td>
                                <td width="8%" colspan="2" align="center">SJ Retur Pelanggan</td>
                                <td width="10%" rowspan="2" align="center">Tgl Terima SJ Retur</td>
                                <td width="10%" colspan="2" align="center">Surat Jalan ITTI</td>
                                <td width="20%" colspan="3" align="center">Quantity</td>
                            </tr>
                            <tr>
                                <td width="3%" align="center">No</td>
                                <td width="3%" align="center">Tanggal</td>
                                <td width="3%" align="center">No</td>
                                <td width="3%" align="center">Tanggal</td>
                                <td width="3%" align="center">Roll</td>
                                <td width="3%" align="center">Kg</td>
                                <td width="3%" align="center"><?php echo $r['satuan']; ?></td>
                            </tr>
                            <?php
                            if ($_GET['id_cek'] != "") {
                                $qry1 = mysqli_query($con, "SELECT * FROM tbl_detail_retur_now
                    WHERE id='$_GET[id_cek]'");
                                $cek = mysqli_num_rows($qry1);
                                $row = mysqli_fetch_array($qry1);
                            }
                            if ($_GET['id_cek1'] != "") {
                                $qry2 = mysqli_query($con, "SELECT * FROM tbl_detail_retur_now
                    WHERE id='$_GET[id_cek1]'");
                                $cek2 = mysqli_num_rows($qry2);
                                $row1 = mysqli_fetch_array($qry2);
                            }
                            if ($_GET['id_cek2'] != "") {
                                $qry3 = mysqli_query($con, "SELECT * FROM tbl_detail_retur_now
                    WHERE id='$_GET[id_cek2]'");
                                $cek3 = mysqli_num_rows($qry3);
                                $row2 = mysqli_fetch_array($qry3);
                            }
                            ?>
                            <?php if ($cek != 0) { ?>
                                <tr>
                                    <td align="left"><?php echo $row['masalah']; ?>
                                        <?php if ($row['t_jawab'] != "" and $row['t_jawab1'] != "" and $row['t_jawab2'] != "") {
                                            echo "(" . $row['t_jawab'] . "," . $row['t_jawab1'] . "," . $row['t_jawab2'] . ")";
                                        } else if ($row['t_jawab'] != "" and $row['t_jawab1'] != "") {
                                            echo "(" . $row['t_jawab'] . "," . $row['t_jawab1'] . ")";
                                        } else if ($row['t_jawab'] != "") {
                                            echo "(" . $row['t_jawab'] . ")";
                                        } ?>
                                    </td>

                                    <td align="left" style="font-size:8px;"><?php echo substr($row['jenis_kain'], 0, 45); ?>
                                    </td>
                                    <td align="center" style="font-size:8px;"><?php echo $row['warna']; ?>
                                    <td align="center"><?php echo $row['lot'];?></td>
                                    <td align="center"><?php echo $row['sjreturplg']; ?></td>
                                    <td align="center"><?php echo $row['tgl_sjretur']; ?></td>
                                    <td align="center"><?php echo $row['tgltrm_sjretur']; ?></td>
                                    <td align="center"><?php echo $row['sj_itti']; ?></td>
                                    <td align="center"><?php echo $row['tgl_sjitti']; ?></td>
                                    <td align="center"><?php echo $row['roll']; ?></td>
                                    <td align="center"><?php echo $row['kg']; ?></td>
                                    <td align="center"><?php echo $row['pjg']; ?></td>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <td align="left">&nbsp;</td>
                                    <td align="left">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                </tr>
                            <?php } ?>
                            <?php if ($cek2 != 0) { ?>
                                <tr>
                                    <td align="left"><?php echo $row1['masalah']; ?>
                                        <?php if ($row1['t_jawab'] != "" and $row1['t_jawab1'] != "" and $row1['t_jawab2'] != "") {
                                            echo "(" . $row1['t_jawab'] . "," . $row1['t_jawab1'] . "," . $row1['t_jawab2'] . ")";
                                        } else if ($row1['t_jawab'] != "" and $row1['t_jawab1'] != "") {
                                            echo "(" . $row1['t_jawab'] . "," . $row1['t_jawab1'] . ")";
                                        } else if ($row1['t_jawab'] != "") {
                                            echo "(" . $row1['t_jawab'] . ")";
                                        } ?>
                                    </td>
                                    <td align="left" style="font-size:8px;"><?php echo $row1['jenis_kain']; ?></td>
                                    <td align="center" style="font-size:8px;"><?php echo $row1['warna']; ?></td>
                                    <td align="center"><?php echo $row1['lot']; ?></td>
                                    <td align="center"><?php echo $row1['sjreturplg']; ?></td>
                                    <td align="center"><?php echo $row1['tgl_sjretur']; ?></td>
                                    <td align="center"><?php echo $row1['tgltrm_sjretur']; ?></td>
                                    <td align="center"><?php echo $row1['sj_itti']; ?></td>
                                    <td align="center"><?php echo $row1['tgl_sjitti']; ?></td>
                                    <td align="center"><?php echo $row1['roll']; ?></td>
                                    <td align="center"><?php echo $row1['kg']; ?></td>
                                    <td align="center"><?php echo $row1['pjg']; ?></td>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <td align="left">&nbsp;</td>
                                    <td align="left">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                </tr>
                            <?php } ?>
                            <?php if ($cek3 != 0) { ?>
                                <tr>
                                    <td align="left"><?php echo $row2['masalah']; ?>
                                        <?php if ($row2['t_jawab'] != "" and $row2['t_jawab1'] != "" and $row2['t_jawab2'] != "") {
                                            echo "(" . $row2['t_jawab'] . "," . $row2['t_jawab1'] . "," . $row2['t_jawab2'] . ")";
                                        } else if ($row2['t_jawab'] != "" and $row2['t_jawab1'] != "") {
                                            echo "(" . $row2['t_jawab'] . "," . $row2['t_jawab1'] . ")";
                                        } else if ($row2['t_jawab'] != "") {
                                            echo "(" . $row2['t_jawab'] . ")";
                                        } ?>
                                    </td>
                                    <td align="left" style="font-size:8px;"><?php echo $row2['jenis_kain']; ?></td>
                                    <td align="center" style="font-size:8px;"><?php echo $row2['warna']; ?></td>
                                    <td align="center"><?php echo $row2['lot']; ?></td>
                                    <td align="center"><?php echo $row2['sjreturplg']; ?></td>
                                    <td align="center"><?php echo $row2['tgl_sjretur']; ?></td>
                                    <td align="center"><?php echo $row2['tgltrm_sjretur']; ?></td>
                                    <td align="center"><?php echo $row2['sj_itti']; ?></td>
                                    <td align="center"><?php echo $row2['tgl_sjitti']; ?></td>
                                    <td align="center"><?php echo $row2['roll']; ?></td>
                                    <td align="center"><?php echo $row2['kg']; ?></td>
                                    <td align="center"><?php echo $row2['pjg']; ?></td>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <td align="left">&nbsp;</td>
                                    <td align="left">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td align="left">&nbsp;</td>
                                <td align="left">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="left">&nbsp;</td>
                                <td align="left">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="12" align="left" valign="top">Keterangan : <br />
                                    <table width="100%">
                                        <tbody>
                                            <?php
                                            $qry4 = mysqli_query($con, "SELECT * FROM tbl_detail_retur_now 
                                WHERE id='$_GET[id_cek]'");
                                            $row4 = mysqli_fetch_array($qry4);
                                            $qry5 = mysqli_query($con, "SELECT * FROM tbl_detail_retur_now 
                                WHERE id='$_GET[id_cek1]'");
                                            $row5 = mysqli_fetch_array($qry5);
                                            $qry6 = mysqli_query($con, "SELECT * FROM tbl_detail_retur_now 
                                WHERE id='$_GET[id_cek2]'");
                                            $row6 = mysqli_fetch_array($qry6);
                                            ?>
                                            <tr>
                                                <td width="14%" align="left" valign="top" style="border-top:0px #000000 solid; 
                                                border-bottom:0px #000000 solid;
                                                border-left:0px #000000 solid; 
                                                border-right:0px #000000 solid;">
                                                    <?php if ($row4['ket'] != "") {
                                                        echo "1. " . $row4['ket'] . " " . $row4['tgl_keputusan'];
                                                    } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="14%" align="left" valign="top" style="border-top:0px #000000 solid; 
                                    border-bottom:0px #000000 solid;
                                    border-left:0px #000000 solid; 
                                    border-right:0px #000000 solid;">
                                                    <?php if ($row5['ket'] != "") {
                                                        echo "2. " . $row5['ket'] . " " . $row5['tgl_keputusan'];
                                                    } ?>
                                                </td>
                                            </tr>
                                            <td width="14%" align="left" valign="top" style="border-top:0px #000000 solid; 
                                    border-bottom:0px #000000 solid;
                                    border-left:0px #000000 solid; 
                                    border-right:0px #000000 solid;">
                                                <?php if ($row6['ket'] != "") {
                                                    echo "3. " . $row6['ket'] . " " . $row6['tgl_keputusan'];
                                                } ?>
                                            </td>
                            </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    </tbody>
    </table>
    </td>
    </tr>
    <tr>
        <td>
            <table style="width:7in" border="0" class="table-list1">
                <tr align="center">
                    <td width="14%">&nbsp;</td>
                    <td width="12%">Dibuat :</td>
                    <td width="12%">Diterima :</td>
                    <td width="17%">Diperiksa :</td>
                    <td width="40%" colspan="3">Mengetahui :</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td align="center">
                        <?php $row_qc_staff = mysqli_query($con, "SELECT * FROM tbl_digital_signature WHERE id='$row[qc_staff]'");
                        $data_qc_staff = mysqli_fetch_array($row_qc_staff) ?>
                        <input name="nama5" type="text" value="<?= $data_qc_staff['nama'] ?>" size="12" />
                    </td>
                    <td align="center">
                        <?php $row_gkj_staff = mysqli_query($con, "SELECT * FROM tbl_digital_signature WHERE id='$row[gkj]'");
                        $data_gkj_staff = mysqli_fetch_array($row_gkj_staff) ?>
                        <input name="nama13" type="text" value="<?= $data_gkj_staff['nama'] ?>" size="10" />
                    </td>
                    <td align="center">
                        <?php
                        $qmng = "SELECT * FROM tbl_digital_signature t
                                        WHERE t.dept = 'QCF'
                                        AND t.jabatan IN ('Manager', 'Ast. Supervisor')
                                        AND t.status_aktif = 1";
                        $r_qmng = mysqli_query($con, $qmng);
                        $dmng = mysqli_fetch_array($r_qmng);
                        ?>
                        <input name="nama3" type="text" value="<?= $dmng['nama'] ?>" size="10" />
                    </td>
                    <td align="center">
                        <?php
                        if(!empty($row['sales'])){
                            $sstaf = "SELECT * FROM tbl_digital_signature t
                                    WHERE t.id = '$row[sales]'";
                            $r_sstaff = mysqli_query($con, $sstaf);
                            $dstaff = mysqli_fetch_array($r_sstaff);
                        } ;
                        ?>
                        <input name="nama6" type="text" value="<?= $dstaff['nama'] ?>" size="10" />
                    </td>
                    <td align="center">
                        <?php
                        $gmng = mysqli_query($con, "SELECT * FROM tbl_digital_signature WHERE id='$row[mkt_ppc_manager]'");
                        $data_manager = mysqli_fetch_array($gmng)?>
                        <input name="nama8" type="text" value="<?= $data_manager['nama'] ?>" size="10" />
                    </td>
                    <td align="center">
                        <?php $qdmf = mysqli_query($con, "SELECT * FROM tbl_digital_signature WHERE id='$row[dmf]'");
                        $ddmf = mysqli_fetch_array($qdmf); ?>
                        <input name="nama10" type="text" value="<?= $ddmf['nama'] ?>" size="10" />
                    </td>
                </tr>
                <tr>

                    <?php ?>
                    <td>Tanggal</td>
                    <?php
                    // Cek apakah nilai id_cek1 dan id_cek2 sudah ada
                    if ($cek2 != 0) {
                        $id_approve2 = "AND id_cek1 = '$_GET[id_cek1]'";
                    } else {
                        $id_approve2 = "";
                    }
                    if ($cek3 != 0) {
                        $id_approve3 = "AND id_cek2 = '$_GET[id_cek2]'";
                    } else {
                        $id_approve3 = "";
                    }
                    $qcek_approve = "SELECT 
                                        * 
                                            FROM tbl_email_bon_retur
                                        WHERE 
                                            id_cek = '$_GET[id_cek]' 
                                            $id_approve2
                                            $id_approve3
                                        AND status_email_qc = '1' 
                                            ORDER BY id DESC
                                        LIMIT 1";
                    $query_approve1 = mysqli_query($con, $qcek_approve); 
                    $data_approve1 = mysqli_fetch_array($query_approve1)?>
                    <td align="center"><?php if(!empty($data_approve1['tanggal_approve_qc'])){
                        $tanggal_approve_qc = new DateTime($data_approve1['tanggal_approve_qc']);
                        echo $tanggal_approve_qc->format('d-m-y');
                    } else {
                        echo 'Not Yet Approve';
                    }?>
                    </td>
                    <?php
                    if ($cek2 != 0) {
                        $id_approve2 = "AND id_cek1 = '$_GET[id_cek1]'";
                    } else {
                        $id_approve2 = "";
                    }
                    if ($cek3 != 0) {
                        $id_approve3 = "AND id_cek2 = '$_GET[id_cek2]'";
                    } else {
                        $id_approve3 = "";
                    }
                    $qcek_approve2 = "SELECT 
                                        * 
                                            FROM tbl_email_bon_retur
                                        WHERE 
                                            id_cek = '$_GET[id_cek]' 
                                            $id_approve2
                                            $id_approve3
                                        AND status_email_qc = '1'
                                        AND status_email_gkj = '1' 
                                            ORDER BY id DESC
                                        LIMIT 1";
                    $query_approve2 = mysqli_query($con, $qcek_approve2);
                    $data_approve2 = mysqli_fetch_array($query_approve2) ?>
                    <td align="center"><?php if (!empty($data_approve2['tanggal_approve_gkj'])) {
                        $tanggal_approve_gkj = new DateTime($data_approve2['tanggal_approve_gkj']);
                        echo $tanggal_approve_gkj->format('d-m-y');
                    } else {
                        echo 'Not Yet Approve';
                    } ?>
                    </td>
                    <?php
                    if ($cek2 != 0) {
                        $id_approve2 = "AND id_cek1 = '$_GET[id_cek1]'";
                    } else {
                        $id_approve2 = "";
                    }
                    if ($cek3 != 0) {
                        $id_approve3 = "AND id_cek2 = '$_GET[id_cek2]'";
                    } else {
                        $id_approve3 = "";
                    }
                    $qcek_approve3 = "SELECT 
                                        * 
                                            FROM tbl_email_bon_retur
                                        WHERE 
                                            id_cek = '$_GET[id_cek]' 
                                            $id_approve2
                                            $id_approve3
                                        AND status_email_qc = '1'
                                        AND status_email_gkj = '1'
                                        AND status_email_qc_mng = '1' 
                                            ORDER BY id DESC
                                        LIMIT 1";
                    $query_approve3 = mysqli_query($con, $qcek_approve3);
                    $data_approve3 = mysqli_fetch_array($query_approve3) ?>
                    <td align="center"><?php if (!empty($data_approve3['tanggal_approve_mng_qcf'])) {
                        $tanggal_approve_mng_qcf = new DateTime($data_approve3['tanggal_approve_mng_qcf']);
                        echo $tanggal_approve_mng_qcf->format('d-m-y');
                    } else {
                        echo 'Not Yet Approve';
                    } ?>
                    </td>
                    <?php
                    if ($cek2 != 0) {
                        $id_approve2 = "AND id_cek1 = '$_GET[id_cek1]'";
                    } else {
                        $id_approve2 = "";
                    }
                    if ($cek3 != 0) {
                        $id_approve3 = "AND id_cek2 = '$_GET[id_cek2]'";
                    } else {
                        $id_approve3 = "";
                    }
                    $qcek_approve4 = "SELECT 
                                        * 
                                            FROM tbl_email_bon_retur
                                        WHERE 
                                            id_cek = '$_GET[id_cek]' 
                                            $id_approve2
                                            $id_approve3
                                        AND status_email_qc = '1'
                                        AND status_email_gkj = '1'
                                        AND status_email_qc_mng = '1' 
                                            ORDER BY id DESC
                                        LIMIT 1";
                    $query_approve4 = mysqli_query($con, $qcek_approve4);
                    $data_approve4 = mysqli_fetch_array($query_approve4) ?>
                     <td align="center"><?php if (!empty($data_approve4['tanggal_approve_sales'])) {
                        $tanggal_approve_sales = new DateTime($data_approve4['tanggal_approve_sales']);
                        echo $tanggal_approve_sales->format('d-m-y');
                    } else if(!empty($row['sales'])){
                        echo 'Not Yet Approve';
                    } else {
                        '';
                    }?>
                    </td>
                    <?php
                    if ($cek2 != 0) {
                        $id_approve2 = "AND id_cek1 = '$_GET[id_cek1]'";
                    } else {
                        $id_approve2 = "";
                    }
                    if ($cek3 != 0) {
                        $id_approve3 = "AND id_cek2 = '$_GET[id_cek2]'";
                    } else {
                        $id_approve3 = "";
                    }
                    $qcek_approve5 = "SELECT 
                                        * 
                                            FROM tbl_email_bon_retur
                                        WHERE 
                                            id_cek = '$_GET[id_cek]' 
                                            $id_approve2
                                            $id_approve3
                                        AND status_email_qc = '1'
                                        AND status_email_gkj = '1'
                                        AND status_email_qc_mng = '1' 
                                        AND status_email_mkt_ppc_mng = '1' 
                                            ORDER BY id DESC
                                        LIMIT 1";
                    $query_approve5 = mysqli_query($con, $qcek_approve5);
                    $data_approve5 = mysqli_fetch_array($query_approve5) ?>
                    <td align="center"><?php if (!empty($data_approve5['tanggal_approve_mng_mkt_ppc'])) {
                        $tanggal_approve_mng_mkt_ppc = new DateTime($data_approve5['tanggal_approve_mng_mkt_ppc']);
                        echo $tanggal_approve_mng_mkt_ppc->format('d-m-y');
                    } else if (!empty($row['mkt_ppc_manager'])) {
                        echo 'Not Yet Approve';
                    } else {
                        '';
                    } ?>
                    </td>
                    <?php
                    if ($cek2 != 0) {
                        $id_approve2 = "AND id_cek1 = '$_GET[id_cek1]'";
                    } else {
                        $id_approve2 = "";
                    }
                    if ($cek3 != 0) {
                        $id_approve3 = "AND id_cek2 = '$_GET[id_cek2]'";
                    } else {
                        $id_approve3 = "";
                    }
                    $qcek_approve6 = "SELECT 
                                        * 
                                            FROM tbl_email_bon_retur
                                        WHERE 
                                            id_cek = '$_GET[id_cek]' 
                                            $id_approve2
                                            $id_approve3
                                        AND status_email_qc = '1'
                                        AND status_email_gkj = '1'
                                        AND status_email_qc_mng = '1' 
                                        AND status_email_dmf = '1' 
                                            ORDER BY id DESC
                                        LIMIT 1";
                    $query_approve6 = mysqli_query($con, $qcek_approve6);
                    $data_approve6 = mysqli_fetch_array($query_approve6) ?>
                    <td align="center"><?php if (!empty($data_approve6['tanggal_approve_dmf'])) {
                        $tanggal_approve_dmf = new DateTime($data_approve6['tanggal_approve_dmf']);
                        echo $tanggal_approve_dmf->format('d-m-y');
                    } else if (!empty($row['dmf'])) {
                        echo 'Not Yet Approve';
                    } else {
                        '';
                    } ?>
                    </td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td align="center"><?= $data_qc_staff['jabatan'] ?></td>
                    <td align="center"><?= $data_gkj_staff['jabatan'] ?></td>
                    <td align="center"><?= $dmng['jabatan'] ?></td>
                    <td align="center"><?= $dstaff['jabatan'] ?></td>
                    <td align="center"><?= $data_manager['jabatan'] ?></td>
                    <td align="center"><?= $ddmf['jabatan'] ?></td>
                </tr>
                <tr>
                    <td valign="top" style="height: 0.5in;">Tanda Tangan</td>
                    <td align="center">
                        <?php
                        // Cek apakah nilai id_cek1 dan id_cek2 sudah ada
                        if ($cek2 != 0) {
                            $id_approve2 = "AND id_cek1 = '$_GET[id_cek1]'";
                        } else {
                            $id_approve2 = "";
                        }
                        if ($cek3 != 0) {
                            $id_approve3 = "AND id_cek2 = '$_GET[id_cek2]'";
                        } else {
                            $id_approve3 = "";
                        }

                        // Query untuk memeriksa apakah sudah ada data yang cocok
                        $qcek_approve = "SELECT * 
                                            FROM tbl_email_bon_retur
                                            WHERE 
                                            id_cek = '$_GET[id_cek]' 
                                            $id_approve2
                                            $id_approve3
                                            AND status_email_qc = '1' 
                                            ORDER BY id DESC
                                            LIMIT 1";

                        // Menjalankan query
                        $query_approve1 = mysqli_query($con, $qcek_approve);

                        // Menyimpan hasil query untuk menghitung jumlah baris
                        $row_approve_qc = mysqli_num_rows($query_approve1);

                        // Menetapkan nilai step
                        $step = 1;

                        // Menampilkan tombol jika hasil query tidak ditemukan (row_approve_qc < 1)
                        if ($row_approve_qc < 1) {
                            ?>
                            <!-- Menampilkan tombol Approve jika tidak ada data yang cocok -->
                            <button onclick="approveBonRetur()">Approve</button>

                            <script>
                                // Fungsi untuk mengirim data dengan AJAX
                                function approveBonRetur() {
                                    // Mendapatkan nilai cek dan step dari PHP ke JavaScript
                                    // var cek = <?php echo $cek; ?>;
                                    var step = <?php echo $row_approve_qc; ?>;

                                    // Cek data yang akan dikirim
                                    // console.log("cek: " + cek);
                                    console.log("step: " + step);
                                    console.log("no_order: <?php echo $_GET['no_order']; ?>");
                                    console.log("po: <?php echo $_GET['po']; ?>");
                                    console.log("id_nsp: <?php echo $_GET['id_nsp']; ?>");
                                    console.log("id_cek: <?php echo $_GET['id_cek']; ?>");
                                    console.log("id_cek1: <?php echo $_GET['id_cek1']; ?>");
                                    console.log("id_cek2: <?php echo $_GET['id_cek2']; ?>");

                                    // Membuat request AJAX
                                    var xhr = new XMLHttpRequest();
                                    xhr.open("POST", "approve_bon_retur.php", true);
                                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                                    // Mengirimkan data dalam format URL-encoded
                                    xhr.send(
                                        // "cek=" + cek +
                                        "step=" + step + // Mengirimkan parameter step
                                        "&no_order=" + encodeURIComponent("<?php echo $_GET['no_order']; ?>") +
                                        "&po=" + encodeURIComponent("<?php echo $_GET['po']; ?>") +
                                        "&id_nsp=" + encodeURIComponent("<?php echo $_GET['id_nsp']; ?>") +
                                        "&id_cek=" + encodeURIComponent("<?php echo $_GET['id_cek']; ?>") +
                                        "&id_cek1=" + encodeURIComponent("<?php echo $_GET['id_cek1']; ?>") +
                                        "&id_cek2=" + encodeURIComponent("<?php echo $_GET['id_cek2']; ?>"));

                                    // Setelah AJAX selesai, tangani responsenya
                                    xhr.onload = function () {
                                        if (xhr.status === 200) {
                                            console.log(xhr.responseText);  // Tampilkan respons dari server di console
                                            alert('Data berhasil diproses!');
                                            location.reload(); // Reload halaman setelah sukses
                                        } else {
                                            console.error("Error: " + xhr.status + " " + xhr.statusText);
                                            alert('Terjadi kesalahan. Status: ' + xhr.status);
                                        }
                                    };
                                }
                            </script>

                            <?php
                        } else {
                            echo '<img src="../../dist/img/' . htmlspecialchars($data_qc_staff['image']) . '" alt="Gambar Tidak Ditemukan">';

                        }
                        ?>
                    </td>

                    <td align="center">&nbsp;
                        <?php
                        // Cek apakah nilai id_cek1 dan id_cek2 sudah ada
                        if ($cek2 != 0) {
                            $id_approve2 = "AND id_cek1 = '$_GET[id_cek1]'";
                        } else {
                            $id_approve2 = "";
                        }
                        if ($cek3 != 0) {
                            $id_approve3 = "AND id_cek2 = '$_GET[id_cek2]'";
                        } else {
                            $id_approve3 = "";
                        }

                        // Query untuk memeriksa apakah sudah ada data yang cocok
                        $qcek_approve = "SELECT * 
                    FROM tbl_email_bon_retur
                    WHERE 
                    id_cek = '$_GET[id_cek]' 
                    $id_approve2
                    $id_approve3
                    AND status_email_gkj = '1'
                    ORDER BY id DESC
                    LIMIT 1";

                        // Menjalankan query
                        $query_approve1 = mysqli_query($con, $qcek_approve);
                        $data_approve1 = mysqli_fetch_array($query_approve1);

                        // Menyimpan hasil query untuk menghitung jumlah baris
                        $row_approve_gkj = mysqli_num_rows($query_approve1);

                        // Menampilkan tombol jika hasil query tidak ditemukan (row_approve_qc < 1)
                        if ($row_approve_gkj < 1 ) {
                            if($data_approve1['status_email_gkj']=='0'){
                                echo 'REJECTED';
                            }else{
                                echo  'NOT YET APPROVE';
                            }
                        } else {
                            echo '<img src="../../dist/img/' . htmlspecialchars($data_gkj_staff['image']) . '" alt="Gambar Tidak Ditemukan">';
                        }
                        ?>

                    </td>
                    <td align="center">&nbsp;
                        <?php
                        // Cek apakah nilai id_cek1 dan id_cek2 sudah ada
                        if ($cek2 != 0) {
                            $id_approve2 = "AND id_cek1 = '$_GET[id_cek1]'";
                        } else {
                            $id_approve2 = "";
                        }
                        if ($cek3 != 0) {
                            $id_approve3 = "AND id_cek2 = '$_GET[id_cek2]'";
                        } else {
                            $id_approve3 = "";
                        }

                        // Query untuk memeriksa apakah sudah ada data yang cocok
                        $qcek_approve = "SELECT * 
                    FROM tbl_email_bon_retur
                    WHERE 
                    id_cek = '$_GET[id_cek]' 
                    $id_approve2
                    $id_approve3
                    AND status_email_qc_mng = '1'
                    ORDER BY id DESC
                    LIMIT 1";

                        // Menjalankan query
                        $query_approve2 = mysqli_query($con, $qcek_approve);
                        $data_approve2 = mysqli_fetch_array($query_approve2);

                        // Menyimpan hasil query untuk menghitung jumlah baris
                        $row_approve_qc_mng = mysqli_num_rows($query_approve2);

                        // Menampilkan tombol jika hasil query tidak ditemukan (row_approve_qc < 1)
                        if ($row_approve_qc_mng < 1) {
                                echo 'NOT YET APPROVE';
                        } else {
                            echo '<img src="../../dist/img/' . htmlspecialchars($dmng['image']) . '" alt="Gambar Tidak Ditemukan">';
                        }
                        ?>
                    </td>
                    <td align="center">&nbsp;
                        <?php if ($dstaff['nama'] != '') {
                            // Cek apakah nilai id_cek1 dan id_cek2 sudah ada
                            if ($cek2 != 0) {
                                $id_approve2 = "AND id_cek1 = '$_GET[id_cek1]'";
                            } else {
                                $id_approve2 = "";
                            }
                            if ($cek3 != 0) {
                                $id_approve3 = "AND id_cek2 = '$_GET[id_cek2]'";
                            } else {
                                $id_approve3 = "";
                            }

                            // Query untuk memeriksa apakah sudah ada data yang cocok
                            $qcek_approve = "SELECT * 
                    FROM tbl_email_bon_retur
                    WHERE 
                    id_cek = '$_GET[id_cek]' 
                    $id_approve2
                    $id_approve3
                    AND status_email_qc = '1' 
                    AND status_email_gkj = '1'
                    AND status_email_qc_mng = '1'
                    AND status_email_sales = '1'
                    ORDER BY id DESC
                    LIMIT 1";

                            // Menjalankan query
                            $query_approve3 = mysqli_query($con, $qcek_approve);

                            // Menyimpan hasil query untuk menghitung jumlah baris
                            $row_approve_sales = mysqli_num_rows($query_approve3);

                            // Menampilkan tombol jika hasil query tidak ditemukan (row_approve_qc < 1)
                            if ($row_approve_sales < 1) {
                                echo 'NOT YET APPROVE';
                            } else {
                                echo '<img src="../../dist/img/' . htmlspecialchars($dstaff['image']) . '" alt="Gambar Tidak Ditemukan">';
                            }
                        } else {
                            echo "";
                        }
                        ?>
                    </td>
                    <td align="center">&nbsp;
                        <?php if ($data_manager['nama'] != '') {
                            // Cek apakah nilai id_cek1 dan id_cek2 sudah ada
                            if ($cek2 != 0) {
                                $id_approve2 = "AND id_cek1 = '$_GET[id_cek1]'";
                            } else {
                                $id_approve2 = "";
                            }
                            if ($cek3 != 0) {
                                $id_approve3 = "AND id_cek2 = '$_GET[id_cek2]'";
                            } else {
                                $id_approve3 = "";
                            }

                            // Query untuk memeriksa apakah sudah ada data yang cocok
                            $qcek_approve = "SELECT * 
                                                FROM tbl_email_bon_retur
                                                WHERE 
                                                id_cek = '$_GET[id_cek]' 
                                                $id_approve2
                                                $id_approve3
                                                AND status_email_qc = '1' 
                                                AND status_email_gkj = '1'
                                                AND status_email_qc_mng = '1'
                                                AND status_email_mkt_ppc_mng = '1'
                                                ORDER BY id DESC
                                                LIMIT 1";

                            // Menjalankan query
                            $query_approve3 = mysqli_query($con, $qcek_approve);

                            // Menyimpan hasil query untuk menghitung jumlah baris
                            $row_approve_mkt_ppc = mysqli_num_rows($query_approve3);

                            // Menampilkan tombol jika hasil query tidak ditemukan (row_approve_qc < 1)
                            if ($row_approve_mkt_ppc < 1) {
                                echo 'NOT YET APPROVE';
                            } else {
                                echo '<img src="../../dist/img/' . htmlspecialchars($data_manager['image']) . '" alt="Gambar Tidak Ditemukan">';
                            }
                        } else {
                            echo "";
                        }
                        ?>
                    </td>
                    <td align="center">&nbsp;
                        <?php if ($ddmf['nama'] != '') {
                            // Cek apakah nilai id_cek1 dan id_cek2 sudah ada
                            if ($cek2 != 0) {
                                $id_approve2 = "AND id_cek1 = '$_GET[id_cek1]'";
                            } else {
                                $id_approve2 = "";
                            }
                            if ($cek3 != 0) {
                                $id_approve3 = "AND id_cek2 = '$_GET[id_cek2]'";
                            } else {
                                $id_approve3 = "";
                            }

                            // Query untuk memeriksa apakah sudah ada data yang cocok
                            $qcek_approve = "SELECT * 
                                                FROM tbl_email_bon_retur
                                                WHERE 
                                                id_cek = '$_GET[id_cek]' 
                                                $id_approve2
                                                $id_approve3
                                                AND status_email_dmf = '1'
                                                ORDER BY id DESC
                                                LIMIT 1";

                            // Menjalankan query
                            $query_approve4 = mysqli_query($con, $qcek_approve);

                            // Menyimpan hasil query untuk menghitung jumlah baris
                            $row_approve_dmf = mysqli_num_rows($query_approve4);

                            // Menampilkan tombol jika hasil query tidak ditemukan (row_approve_qc < 1)
                            if ($row_approve_dmf < 1) {
                                echo 'NOT YET APPROVE';
                            } else {
                                echo '<img src="../../dist/img/' . htmlspecialchars($ddmf['image']) . '" alt="Gambar Tidak Ditemukan">';
                            }
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table style="width:7in" border="0">
                <tr align="left">
                    <td style="font-size: 10px;"><span
                            style="border-top:0px #000000 solid; 
                border-bottom:0px #000000 solid;
                border-left:0px #000000 solid; 
                border-right:0px #000000 solid;"><?php echo "Keterangan: <br> Putih : Arsip QCF; Merah : MKT ; Hijau : PPC ; Kuning : GKJ"; ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    </table>


    <script>
        //alert('cetak');window.print();
    </script>
</body>

</html>