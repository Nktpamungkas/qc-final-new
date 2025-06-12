<?php
    ini_set("error_reporting", 1);
    set_time_limit(0);
    session_start();
    include "koneksi.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Bon Penghubung</title>

</head>
<style>
    .button-group-vertical {
        display: flex;
        flex-direction: column;
        gap: 5px; /* jarak antar tombol */
    }
    .button-group-vertical button {
        font-size: 10px;
    }
</style>

<body>
    <?php
    $Demand = isset($_GET['demand']) ? $_GET['demand'] : '';
    ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Summary Replacement Item</h3><br>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-hover table-striped nowrap" id="example3" style="width:100%">
                        <thead class="bg-blue">
                            <tr>
                                <th>No</th>
                                <th>Project</th>
                                <th>Item Code</th>
                                <th>Netto</th>
                                <th>Replace QTY (kg)</th>
                                <th>No Replace QTY (kg)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                $queryMain = "SELECT
                                                tq.no_order,
                                                tq.no_item,
                                                tq.no_warna,
                                                SUM(tq.netto) AS netto,
                                                SUM(CASE WHEN m.status_approve = 1 THEN tq.estimasi ELSE 0 END) AS estimasi_approve,
                                                SUM(CASE WHEN m.status_approve = 99 THEN tq.estimasi ELSE 0 END) AS estimasi_reject
                                            FROM
                                                tbl_bonpenghubung_mail m
                                            LEFT JOIN tbl_qcf tq ON m.nodemand = tq.nodemand
                                            WHERE
                                                tq.sts_pbon != '10'
                                                AND team <> ''
                                                AND (
                                                    tq.penghubung_masalah != '' OR
                                                    tq.penghubung_keterangan != '' OR
                                                    tq.penghubung_roll1 != '' OR
                                                    tq.penghubung_roll2 != '' OR
                                                    tq.penghubung_roll3 != '' OR
                                                    tq.penghubung_dep != '' OR
                                                    tq.penghubung_dep_persen != ''
                                                )
                                                AND m.status_approve IN ('1', '99') -- Only approved or reject
                                            --     AND tq.no_order = 'DOM2500004'
                                            GROUP BY
                                                tq.no_order,
                                                tq.no_item,
                                                tq.no_warna
                                            ORDER BY
                                                tq.no_order";
                                $resultMain = mysqli_query($con, $queryMain); 
                            ?>
                            <?php while($row = mysqli_fetch_assoc($resultMain)) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['no_order']; ?></td>
                                    <td><?php echo $row['no_item']; ?>-<?php echo $row['no_warna']; ?></td>
                                    <td><?php echo number_format($row['netto'], 2); ?></td>
                                    <td><?php echo number_format($row['estimasi_approve'], 2); ?></td>
                                    <td><?php echo number_format($row['estimasi_reject'], 2); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
    <div id="StsAksiEdit" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
    <div id="StsAksiPPCEdit" class="modal fade modal-3d-slit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>



    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Reject Bon Penghubung QC</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin Reject Bon Penghubung QC ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="confirmReject">REJECT</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="closeModal" tabindex="-1" role="dialog" aria-labelledby="closeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="closeModalLabel">Tutup Bon Penghubung QC</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menutup Bon Penghubung QC ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="confirmClose">CLOSE</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveModalLabel">Approve Bon Penghubung QC</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin mengapprove Bon Penghubung QC ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="confirmApprove">APPROVE</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
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
<script type="text/javascript">
    document.querySelectorAll("#approveButton, #rejectButton, #closeApproveButton").forEach(function(button) {
        button.addEventListener("click", function() {
            var nodemand = this.getAttribute("data-nodemand");
            var action = this.id.replace('Button', ''); // Mendapatkan action dari ID tombol (approve, reject, closeApprove)
            showModal(action, nodemand);
        });
    });


    function showModal(action, nodemand) {
        var modalId, confirmButtonId;

        // Tentukan modalId dan confirmButtonId berdasarkan action
        if (action === "approve") {
            modalId = "approveModal";
            confirmButtonId = "confirmApprove";
        } else if (action === "reject") {
            modalId = "rejectModal";
            confirmButtonId = "confirmReject";
        } else if (action == "closeApprove") {
            modalId = "closeModal";
            confirmButtonId = "confirmClose";
        }

        var apiUrl = "pages/approve_process_bon_penghubung.php";

        // Tampilkan modal sesuai action
        $('#' + modalId).modal('show');

        // Tambahkan event listener untuk tombol konfirmasi
        document.getElementById(confirmButtonId).addEventListener("click", function() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", apiUrl, true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log(xhr.responseText); // Menampilkan respons dari server
                    alert("Bon Penghubung QC dengan nodemand " + nodemand + " berhasil " + action + "!");
                    $('#' + modalId).modal('hide'); // Menutup modal setelah berhasil
                    location.reload();
                } else {
                    // Menampilkan error jika status bukan 200
                    console.log(xhr.responseText); // Menampilkan error dari server
                    alert("Terjadi kesalahan dalam proses " + action + ": " + xhr.responseText);
                }
            };
            xhr.send("nodemand=" + nodemand + "&action=" + action); // Kirim data untuk approve/reject
        });
    }


    // Menambahkan event listener untuk tombol close (di header modal atau di footer)
    $('.close, .btn-secondary[data-dismiss="modal"]').on('click', function() {
        $('#closeModal').modal('hide'); // Menutup modal secara manual jika tombol close atau cancel diklik
    });
</script>

</html>