<?php
ini_set("error_reporting", 1);
session_start();
include ("../koneksi.php");

$nsp_id = $_GET['nspId'];

$qry = mysqli_query($con, "SELECT * FROM tbl_debit_note WHERE id_nsp = '$nsp_id' ");
$row = mysqli_fetch_array($qry);
$cek = mysqli_num_rows($qry);
?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action=""
            enctype="multipart/form-data" onsubmit="return submitForm(this)">
            <input type="hidden" name="id_nsp" value="<?= $nsp_id ?>">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Debit Note</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="dn_kg" class="col-md-4 control-label">KG</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="dn_kg" placeholder="0.0" name="dn_kg"
                            value="<?= $row['qty_kg'] ?>" required <?= $cek > 0 ? 'disabled' : '' ?>>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dn_yd" class="col-md-4 control-label">YD</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="dn_yd" placeholder="0.0" name="dn_yd"
                            value="<?= $row['qty_yard'] ?>" required <?= $cek > 0 ? 'disabled' : '' ?>>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dn_amount" class="col-md-4 control-label">AMOUNT</label>
                    <div class="col-md-3">
                        <select name="currency" id="currency" class="form-control" <?= $cek > 0 ? 'disabled' : '' ?>>
                            <option value="IDR" <?php if ($row['currency'] == "IDR")
                                echo "selected"; ?>>IDR</option>
                            <option value="USD" <?php if ($row['currency'] == "USD")
                                echo "selected"; ?>>USD</option>
                        </select>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="dn_amount" placeholder="Rp. 1.000" name="dn_amount"
                            value="<?= $row['amount'] ?>" required onkeyup="formatRupiah(this)" <?= $cek > 0 ? 'disabled' : '' ?>>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

                    <input type="submit" value="Simpan" name="simpan_solusi_db" id="simpan_solusi_db"
                        class="btn btn-primary pull-right" <?= $cek > 0 ? 'disabled' : '' ?>>
                </div>
        </form>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

<script>
    function submitForm(e) {
        $.ajax({
            url: "pages/ajax/ajax_detail_solusi_debit_note.php",
            type: "POST",
            data: $(e).serialize(),
            success: function (ajaxData) {
                const json = JSON.parse(ajaxData);
                if (json.status == 201) {
                    $('#DataSolusiDebitNote').modal('hide');

                    swal({
                        title: 'Data Telah Tersimpan',
                        text: 'Klik Ok untuk input data kembali',
                        type: 'success',
                    });
                }
            }
        });

        return false;
    }
</script>