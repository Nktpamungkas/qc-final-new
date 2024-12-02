<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
$modal_id = $_GET['id'];
$modal = mysqli_query($con, "SELECT * FROM tbl_detail_retur_now WHERE id='$modal_id' ");
while ($r = mysqli_fetch_array($modal)) {
    ?>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="EditRetur"
                enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Retur</h4>
                </div>
                <script>
                    $(document).on("click", ".modal-body", function () {
                        $("#datepicker").datepicker({
                            autoclose: true,
                            format: 'yyyy-mm-dd',
                            todayHighlight: true,
                        });
                        $("#datepicker1").datepicker({
                            autoclose: true,
                            format: 'yyyy-mm-dd',
                            todayHighlight: true,
                        });
                        $("#datepicker2").datepicker({
                            autoclose: true,
                            format: 'yyyy-mm-dd',
                            todayHighlight: true,
                        });
                        $("#datepicker3").datepicker({
                            autoclose: true,
                            format: 'yyyy-mm-dd',
                            todayHighlight: true,
                        });
                    });  
                </script>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value="<?php echo $r['id']; ?>">
                    <input type="hidden" idnsp="idnsp" name="idnsp" value="<?php echo $r['id_nsp']; ?>">
                    <div class="form-group">
                        <label for="sjreturplg" class="col-sm-2 control-label">No SJ Retur</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input name="sjreturplg" type="text" class="form-control" id="sjreturplg"
                                    value="<?php echo $r['sjreturplg']; ?>" placeholder="" style="text-align: right;">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <input name="tgl_sjretur" type="text" class="form-control pull-right" id="datepicker"
                                    placeholder="0000-00-00" value="<?php echo $r['tgl_sjretur']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tgltrm_sjretur" class="col-sm-2 control-label">Tgl Terima SJ Retur</label>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <input name="tgltrm_sjretur" type="text" class="form-control pull-right" id="datepicker1"
                                    placeholder="0000-00-00" value="<?php echo $r['tgltrm_sjretur']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sj_itti" class="col-sm-2 control-label">SJ ITTI</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input name="sj_itti" type="text" class="form-control" id="sj_itti"
                                    value="<?php echo $r['sj_itti']; ?>" placeholder="" style="text-align: right;">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <input name="tgl_sjitti" type="text" class="form-control pull-right" id="datepicker2"
                                    placeholder="0000-00-00" value="<?php echo $r['tgl_sjitti']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- Roll & KG-->
                        <label for="qty" class="col-sm-2 control-label">Quantity</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input name="roll" type="text" class="form-control" id="roll"
                                    value="<?php echo $r['roll']; ?>" placeholder="0" style="text-align: right;">
                                <span class="input-group-addon">Roll</span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input name="kg" type="text" class="form-control" id="kg" value="<?php echo $r['kg']; ?>"
                                    placeholder="0.00" style="text-align: right;">
                                <span class="input-group-addon">Kg</span>
                            </div>
                        </div>
                        <!-- End Roll & KG -->
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input name="pjg" type="text" class="form-control" id="pjg" value="<?php echo $r['pjg']; ?>"
                                    placeholder="0.00" style="text-align: right;">
                                <span class="input-group-addon">
                                    <select name="satuan" style="font-size: 12px;" id="satuan">
                                        <option value="Yard" <?php if ($r['satuan'] == "Yard") {
                                            echo "SELECTED";
                                        } ?>>Yard
                                        </option>
                                        <option value="Meter" <?php if ($r['satuan'] == "Meter") {
                                            echo "SELECTED";
                                        } ?>>Meter
                                        </option>
                                        <option value="PCS" <?php if ($r['satuan'] == "PCS") {
                                            echo "SELECTED";
                                        } ?>>PCS</option>
                                    </select>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lot" class="col-sm-2 control-label">Qty Timbang Ulang</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input name="qty_tu" type="text" class="form-control" id="qty_tu"
                                    value="<?php echo $r['qty_tu']; ?>" placeholder="0.00" style="text-align: right;">
                                <span class="input-group-addon">Kg</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="masalah_dominan" class="col-sm-2 control-label">Sub Defect</label>
                        <div class="col-sm-5">
                            <select class="form-control select2" name="masalah_dominan" id="masalah_dominan">
                                <option value="">Pilih</option>
                                <?php
                                $qrym = mysqli_query($con, "SELECT masalah FROM tbl_masalah_aftersales ORDER BY masalah ASC");
                                while ($rm = mysqli_fetch_array($qrym)) {
                                    ?>
                                    <option value="<?php echo $rm['masalah']; ?>" <?php if ($r['masalah_dominan'] == $rm['masalah']) {
                                          echo "SELECTED";
                                      } ?>>
                                        <?php echo $rm['masalah']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nodemand_ncp" class="col-sm-2 control-label">No Demand NCP</label>
                        <div class="col-sm-5">
                            <select class="form-control select2" name="nodemand_ncp">
                                <option value="">Pilih</option>
                                <?php $sqlkkncp = mysqli_query($con, "SELECT nodemand FROM tbl_aftersales_now WHERE po='$r[po]' and no_order='$r[no_order]' ORDER BY nodemand");
                                while ($rkkncp = mysqli_fetch_array($sqlkkncp)) { ?>
                                    <option value="<?php echo $rkkncp['nodemand']; ?>" <?php if ($r['nodemand_ncp'] == $rkkncp['nodemand']) {
                                        echo "SELECTED";
                                    } ?>>
                                        <?php echo $rkkncp['nodemand']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nodemand_akj" class="col-sm-2 control-label">No Demand AKJ</label>
                        <div class="col-sm-5">
                            <input name="nodemand_akj" type="text" class="form-control" id="nodemand_akj"
                                value="<?php echo $r['nodemand_akj']; ?>" placeholder="No Demand AKJ">
                        </div>
                        <?php
                            // Query untuk mengambil data dari dept DMF
                            $qdmf = "SELECT * FROM tbl_digital_signature t
                                        WHERE t.dept = 'DMF'
                                        AND t.status_aktif = 1";
                            $r_qdmf = mysqli_query($con, $qdmf);
                            $ddmf = mysqli_fetch_array($r_qdmf);
                            ?>
                        

                    </div>
                    <div class="form-group">
                        <label for="masalah" class="col-sm-2 control-label">Masalah</label>
                        <div class="col-sm-8">
                            <textarea name="masalah" rows="2" class="form-control" id="masalah"
                                placeholder="Masalah"><?php echo $r['masalah']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ket" class="col-sm-2 control-label">Keterangan</label>
                        <div class="col-sm-8">
                            <textarea name="ket" rows="3" class="form-control" id="ket"
                                placeholder="Keterangan"><?php echo $r['ket']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tgl_keputusan" class="col-sm-2 control-label">Tgl Keputusan</label>
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <input name="tgl_keputusan" type="text" class="form-control pull-right" id="datepicker3"
                                    placeholder="0000-00-00" value="<?php echo $r['tgl_keputusan']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="t_jawab" class="col-sm-2 control-label">Dept. Tanggung Jawab 1</label>
                        <div class="col-sm-5">
                            <select class="form-control select2" name="t_jawab">
                                <option value="">Pilih</option>
                                <option value="MKT" <?php if ($r['t_jawab'] == "MKT") {
                                    echo "SELECTED";
                                } ?>>MKT</option>
                                <option value="FIN" <?php if ($r['t_jawab'] == "FIN") {
                                    echo "SELECTED";
                                } ?>>FIN</option>
                                <option value="DYE" <?php if ($r['t_jawab'] == "DYE") {
                                    echo "SELECTED";
                                } ?>>DYE</option>
                                <option value="KNT" <?php if ($r['t_jawab'] == "KNT") {
                                    echo "SELECTED";
                                } ?>>KNT</option>
                                <option value="LAB" <?php if ($r['t_jawab'] == "LAB") {
                                    echo "SELECTED";
                                } ?>>LAB</option>
                                <option value="PRT" <?php if ($r['t_jawab'] == "PRT") {
                                    echo "SELECTED";
                                } ?>>PRT</option>
                                <option value="KNK" <?php if ($r['t_jawab'] == "KNK") {
                                    echo "SELECTED";
                                } ?>>KNK</option>
                                <option value="QCF" <?php if ($r['t_jawab'] == "QCF") {
                                    echo "SELECTED";
                                } ?>>QCF</option>
                                <option value="GKG" <?php if ($r['t_jawab'] == "GKG") {
                                    echo "SELECTED";
                                } ?>>GKG</option>
                                <option value="PRO" <?php if ($r['t_jawab'] == "PRO") {
                                    echo "SELECTED";
                                } ?>>PRO</option>
                                <option value="RMP" <?php if ($r['t_jawab'] == "RMP") {
                                    echo "SELECTED";
                                } ?>>RMP</option>
                                <option value="PPC" <?php if ($r['t_jawab'] == "PPC") {
                                    echo "SELECTED";
                                } ?>>PPC</option>
                                <option value="TAS" <?php if ($r['t_jawab'] == "TAS") {
                                    echo "SELECTED";
                                } ?>>TAS</option>
                                <option value="GKJ" <?php if ($r['t_jawab'] == "GKJ") {
                                    echo "SELECTED";
                                } ?>>GKJ</option>
                                <option value="BRS" <?php if ($r['t_jawab'] == "BRS") {
                                    echo "SELECTED";
                                } ?>>BRS</option>
                                <option value="CST" <?php if ($r['t_jawab'] == "CST") {
                                    echo "SELECTED";
                                } ?>>CST</option>
                                <option value="GAS" <?php if ($r['t_jawab'] == "GAS") {
                                    echo "SELECTED";
                                } ?>>GAS</option>
                                <option value="YND" <?php if ($r['t_jawab'] == "YND") {
                                    echo "SELECTED";
                                } ?>>YND</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="t_jawab1" class="col-sm-2 control-label">Dept. Tanggung Jawab 2</label>
                        <div class="col-sm-5">
                            <select class="form-control select2" name="t_jawab1">
                                <option value="">Pilih</option>
                                <option value="MKT" <?php if ($r['t_jawab1'] == "MKT") {
                                    echo "SELECTED";
                                } ?>>MKT</option>
                                <option value="FIN" <?php if ($r['t_jawab1'] == "FIN") {
                                    echo "SELECTED";
                                } ?>>FIN</option>
                                <option value="DYE" <?php if ($r['t_jawab1'] == "DYE") {
                                    echo "SELECTED";
                                } ?>>DYE</option>
                                <option value="KNT" <?php if ($r['t_jawab1'] == "KNT") {
                                    echo "SELECTED";
                                } ?>>KNT</option>
                                <option value="LAB" <?php if ($r['t_jawab1'] == "LAB") {
                                    echo "SELECTED";
                                } ?>>LAB</option>
                                <option value="PRT" <?php if ($r['t_jawab1'] == "PRT") {
                                    echo "SELECTED";
                                } ?>>PRT</option>
                                <option value="KNK" <?php if ($r['t_jawab1'] == "KNK") {
                                    echo "SELECTED";
                                } ?>>KNK</option>
                                <option value="QCF" <?php if ($r['t_jawab1'] == "QCF") {
                                    echo "SELECTED";
                                } ?>>QCF</option>
                                <option value="GKG" <?php if ($r['t_jawab1'] == "GKG") {
                                    echo "SELECTED";
                                } ?>>GKG</option>
                                <option value="PRO" <?php if ($r['t_jawab1'] == "PRO") {
                                    echo "SELECTED";
                                } ?>>PRO</option>
                                <option value="RMP" <?php if ($r['t_jawab1'] == "RMP") {
                                    echo "SELECTED";
                                } ?>>RMP</option>
                                <option value="PPC" <?php if ($r['t_jawab1'] == "PPC") {
                                    echo "SELECTED";
                                } ?>>PPC</option>
                                <option value="TAS" <?php if ($r['t_jawab1'] == "TAS") {
                                    echo "SELECTED";
                                } ?>>TAS</option>
                                <option value="GKJ" <?php if ($r['t_jawab1'] == "GKJ") {
                                    echo "SELECTED";
                                } ?>>GKJ</option>
                                <option value="BRS" <?php if ($r['t_jawab1'] == "BRS") {
                                    echo "SELECTED";
                                } ?>>BRS</option>
                                <option value="CST" <?php if ($r['t_jawab1'] == "CST") {
                                    echo "SELECTED";
                                } ?>>CST</option>
                                <option value="GAS" <?php if ($r['t_jawab1'] == "GAS") {
                                    echo "SELECTED";
                                } ?>>GAS</option>
                                <option value="YND" <?php if ($r['t_jawab1'] == "YND") {
                                    echo "SELECTED";
                                } ?>>YND</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="t_jawab2" class="col-sm-2 control-label">Dept. Tanggung Jawab 3</label>
                        <div class="col-sm-5">
                            <select class="form-control select2" name="t_jawab2">
                                <option value="">Pilih</option>
                                <option value="MKT" <?php if ($r['t_jawab2'] == "MKT") {
                                    echo "SELECTED";
                                } ?>>MKT</option>
                                <option value="FIN" <?php if ($r['t_jawab2'] == "FIN") {
                                    echo "SELECTED";
                                } ?>>FIN</option>
                                <option value="DYE" <?php if ($r['t_jawab2'] == "DYE") {
                                    echo "SELECTED";
                                } ?>>DYE</option>
                                <option value="KNT" <?php if ($r['t_jawab2'] == "KNT") {
                                    echo "SELECTED";
                                } ?>>KNT</option>
                                <option value="LAB" <?php if ($r['t_jawab2'] == "LAB") {
                                    echo "SELECTED";
                                } ?>>LAB</option>
                                <option value="PRT" <?php if ($r['t_jawab2'] == "PRT") {
                                    echo "SELECTED";
                                } ?>>PRT</option>
                                <option value="KNK" <?php if ($r['t_jawab2'] == "KNK") {
                                    echo "SELECTED";
                                } ?>>KNK</option>
                                <option value="QCF" <?php if ($r['t_jawab2'] == "QCF") {
                                    echo "SELECTED";
                                } ?>>QCF</option>
                                <option value="GKG" <?php if ($r['t_jawab2'] == "GKG") {
                                    echo "SELECTED";
                                } ?>>GKG</option>
                                <option value="PRO" <?php if ($r['t_jawab2'] == "PRO") {
                                    echo "SELECTED";
                                } ?>>PRO</option>
                                <option value="RMP" <?php if ($r['t_jawab2'] == "RMP") {
                                    echo "SELECTED";
                                } ?>>RMP</option>
                                <option value="PPC" <?php if ($r['t_jawab2'] == "PPC") {
                                    echo "SELECTED";
                                } ?>>PPC</option>
                                <option value="TAS" <?php if ($r['t_jawab2'] == "TAS") {
                                    echo "SELECTED";
                                } ?>>TAS</option>
                                <option value="GKJ" <?php if ($r['t_jawab2'] == "GKJ") {
                                    echo "SELECTED";
                                } ?>>GKJ</option>
                                <option value="BRS" <?php if ($r['t_jawab2'] == "BRS") {
                                    echo "SELECTED";
                                } ?>>BRS</option>
                                <option value="CST" <?php if ($r['t_jawab2'] == "CST") {
                                    echo "SELECTED";
                                } ?>>CST</option>
                                <option value="GAS" <?php if ($r['t_jawab2'] == "GAS") {
                                    echo "SELECTED";
                                } ?>>GAS</option>
                                <option value="YND" <?php if ($r['t_jawab2'] == "YND") {
                                    echo "SELECTED";
                                } ?>>YND</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="t_jawab" class="col-sm-2 control-label">Dibuat QC Dept</label>
                        <div class="col-sm-5">
                            <?php
                            $qstaf = "SELECT * FROM tbl_digital_signature t
                                    WHERE t.dept = 'QCF'
                                    AND t.jabatan NOT IN ('Manager', 'Ast. Supervisor')
                                    AND t.status_aktif = 1";
                            $rstaff = mysqli_query($con, $qstaf);
                            ?>
                            <select class="form-control select2" name="qc_staff" required>
                                <option value="">Pilih</option>
                                <?php while ($d_qc_staff = mysqli_fetch_array($rstaff)) { ?>
                                    <option value="<?php echo $d_qc_staff['id']; ?>" <?php if ($r['qc_staff'] == $d_qc_staff['id']) {
                                           echo "SELECTED";
                                       } ?>>
                                        <?php echo $d_qc_staff['nama']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="t_jawab" class="col-sm-2 control-label">Diterima QC Manager</label>
                        <div class="col-sm-5">
                            <?php
                            $qstaf = "SELECT * FROM tbl_digital_signature t
                                    WHERE t.dept = 'QCF'
                                    AND t.jabatan IN ('Manager', 'Ast. Supervisor')
                                    AND t.status_aktif = 1";
                            $rstaff = mysqli_query($con, $qstaf);
                            ?>
                            <select class="form-control select2" name="qcf_manager" required>
                                <option value="">Pilih</option>
                                <?php while ($d_qc_mng = mysqli_fetch_array($rstaff)) { ?>
                                    <option value="<?php echo $d_qc_mng['id']; ?>" <?php if ($r['qcf_manager'] == $d_qc_mng['id']) {
                                           echo "SELECTED";
                                       } ?>>
                                        <?php echo $d_qc_mng['nama']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="t_jawab" class="col-sm-2 control-label">Diterima GKJ</label>
                        <div class="col-sm-5">
                            <?php
                                $gstaf = "SELECT * FROM tbl_digital_signature t
                                    WHERE t.dept = 'GKJ'
                                    AND t.status_aktif = 1";
                                $r_gstaff = mysqli_query($con, $gstaf);
                                ?>
                            <select class="form-control select2" name="gkj" required>
                                <option value="">Pilih</option>
                                <?php while ($d_gkj_staff = mysqli_fetch_array($r_gstaff)) { ?>
                                    <option value="<?php echo $d_gkj_staff['id']; ?>" <?php if ($r['gkj'] == $d_gkj_staff['id']) {
                                           echo "SELECTED";
                                       } ?>>
                                        <?php echo $d_gkj_staff['nama']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="t_jawab" class="col-sm-2 control-label">Sales Assistant
                            *optional
                        </label>
                        <div class="col-sm-5">
                            <?php
                                $sstaf = "SELECT * FROM tbl_digital_signature t
                                    WHERE t.dept = 'MKT'
                                    AND t.jabatan not in ('Manager','Ast. Supervisor')
                                    AND t.status_aktif = 1";
                                $r_sstaff = mysqli_query($con, $sstaf);
                                ?>
                            <select class="form-control select2" name="sales">
                                <option value="">Pilih</option>
                                <?php while ($d_sales_staff = mysqli_fetch_array($r_sstaff)) { ?>
                                    <option value="<?php echo $d_sales_staff['id']; ?>" <?php if ($r['sales'] == $d_sales_staff['id']) {
                                           echo "SELECTED";
                                       } ?>>
                                        <?php echo $d_sales_staff['nama']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="t_jawab" class="col-sm-2 control-label">MKT/PPC Manager
                            *optional
                        </label>
                        <div class="col-sm-5">
                            <?php
                                $gmng = "SELECT * FROM tbl_digital_signature t
                                    WHERE t.dept IN ('MKT','PPC') 
                                    AND t.jabatan not in ('Staff','Sales Assistant')
                                    AND t.status_aktif = 1";
                                $r_gmng = mysqli_query($con, $gmng);
                                ?>
                            <select class="form-control select2" name="mkt_ppc_manager">
                                <option value="">Pilih</option>
                                <?php while ($d_ppc_mkt_mng = mysqli_fetch_array($r_gmng)) { ?>
                                    <option value="<?php echo $d_ppc_mkt_mng['id']; ?>" <?php if ($r['mkt_ppc_manager'] == $d_ppc_mkt_mng['id']) {
                                           echo "SELECTED";
                                       } ?>>
                                        <?php echo $d_ppc_mkt_mng['nama']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="t_jawab" class="col-sm-2 control-label">Mengetahui DMF
                        </label>
                        <div class="col-sm-5">
                            <?php
                                $gmng = "SELECT * FROM tbl_digital_signature t
                                    WHERE t.dept IN ('DMF') 
                                    AND t.status_aktif = 1";
                                $r_gmng = mysqli_query($con, $gmng);
                                ?>
                            <select class="form-control select2" name="dmf">
                                <option value="">Pilih</option>
                                <?php while ($d_dmf = mysqli_fetch_array($r_gmng)) { ?>
                                    <option value="<?php echo $d_dmf['id']; ?>" <?php if ($r['dmf'] == $d_dmf['id']) {
                                           echo "SELECTED";
                                       } ?>>
                                        <?php echo $d_dmf['nama']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
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