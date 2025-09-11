<?php
    session_start();
    include "koneksi.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simpan_user']) && $_POST['simpan_user'] == 'Simpan') {
        $nama     = mysqli_real_escape_string($con, $_POST['nama']);

        $query = "INSERT INTO tbl_jobdesc
            (nama) VALUES ('$nama')";

        if (mysqli_query($con, $query)) {
            $last_id = mysqli_insert_id($con);

            // Insert ke tbl_pembagian_testing_tq
            $query2 = "INSERT INTO tbl_pembagian_testing_tq (id_jobdesc) VALUES ('$last_id')";
            mysqli_query($con, $query2);
        
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                Swal.fire({
                    title: 'Data Berhasil Disimpan!',
                    text: 'Klik OK untuk kembali ke halaman user.',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'pembagianTestingTQ';
                    }
                });
            </script>";
            exit;
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                Swal.fire({
                    title: 'Gagal Menyimpan!',
                    text: '" . addslashes(mysqli_error($con)) . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.history.back();
                });
            </script>";
            exit;
        }
    }

    if (isset($_POST['update_pembagian_testing'])) {
    $id_jobdesc = intval($_POST['id_jobdesc']);
    $nama = isset($_POST['nama']) ? mysqli_real_escape_string($con, $_POST['nama']) : '';

    $id_users = isset($_POST['id_user']) && is_array($_POST['id_user']) ? $_POST['id_user'] : [];
    $jenis_testings = isset($_POST['jenis_testing']) && is_array($_POST['jenis_testing']) ? $_POST['jenis_testing'] : [];

    $jenis_testing_str = !empty($jenis_testings) ? implode(',', array_map(function($t) use ($con) {
        return mysqli_real_escape_string($con, trim($t));
    }, $jenis_testings)) : null;

    mysqli_begin_transaction($con);

    try {
        // Update nama
        $update_nama_query = "UPDATE tbl_jobdesc SET nama = '$nama' WHERE id = $id_jobdesc";
        mysqli_query($con, $update_nama_query);

        // Hapus data lama untuk id_jobdesc ini
        mysqli_query($con, "DELETE FROM tbl_pembagian_testing_tq WHERE id_jobdesc = $id_jobdesc");

        if (!empty($id_users)) {
            // Ada user → simpan semua user + jenis testing (kalau ada)
            $stmt_insert = $con->prepare("INSERT INTO tbl_pembagian_testing_tq (id_jobdesc, id_user, jenis_testing) VALUES (?, ?, ?)");
            foreach ($id_users as $user_id) {
                $user_id_int = intval($user_id);
                $stmt_insert->bind_param("iis", $id_jobdesc, $user_id_int, $jenis_testing_str);
                $stmt_insert->execute();
            }
            $stmt_insert->close();
        } else {
            // Tidak ada user → tetap simpan id_jobdesc dan jenis_testing (kalau ada)
            $stmt_insert = $con->prepare("INSERT INTO tbl_pembagian_testing_tq (id_jobdesc, id_user, jenis_testing) VALUES (?, NULL, ?)");
            $stmt_insert->bind_param("is", $id_jobdesc, $jenis_testing_str);
            $stmt_insert->execute();
            $stmt_insert->close();
        }

        mysqli_commit($con);

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                title: 'Data Berhasil Diperbarui!',
                text: 'Klik OK untuk kembali ke halaman user.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'pembagianTestingTQ';
            });
        </script>";
        exit;
    } catch (Exception $e) {
        mysqli_rollback($con);
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                title: 'Gagal Memperbarui!',
                text: '" . addslashes($e->getMessage()) . "',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
        exit;
    }
}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title></title>
    </head>
    <body>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">PEMBAGIAN TESTING TQ</h3>
                        <br><br>
                        <!-- Tombol Add Description -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addDescModal">
                            + Add Description
                        </button>
                    </div>
                    <div class="box-body">
                        <table id="example3" class="table table-bordered table-hover table-striped display nowrap" width="100%">
                            <thead class="bg-blue">
                                <tr>
                                    <th><div align="center">NO</div></th>
                                    <th><div align="center">ACTION</div></th>
                                    <th><div align="center">JOB DESC</div></th>
                                    <th><div align="center">USER</div></th>
                                    <th><div align="center">JENIS TESTING</div></th>
                                    <th><div align="center">JUMLAH TESTING</div></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $users = mysqli_query($con, "SELECT * FROM tbl_jobdesc");
                                    $no = 1;
                                    while($user = mysqli_fetch_array($users)) {
                                        // Ambil semua user dan jenis_testing untuk 1 id_jobdesc
                                        $pembagian_testing_q = mysqli_query($con, "
                                            SELECT GROUP_CONCAT(u.user ORDER BY u.user ASC SEPARATOR ', ') AS users, p.jenis_testing
                                            FROM tbl_jobdesc j
                                            LEFT JOIN tbl_pembagian_testing_tq p ON j.id = p.id_jobdesc
                                            LEFT JOIN user_login u ON FIND_IN_SET(u.id, p.id_user) > 0
                                            WHERE j.id = {$user['id']}
                                            GROUP BY j.id
                                        ");
                                        $pembagian_testing = mysqli_fetch_assoc($pembagian_testing_q);

                                        // Hitung jumlah jenis_testing
                                        $jumlah_testing = 0;
                                        if (!empty($pembagian_testing['jenis_testing'])) {
                                            $jenis_array = array_filter(array_map('trim', explode(',', $pembagian_testing['jenis_testing'])));
                                            $jumlah_testing = count($jenis_array);
                                        }
                                ?>
                                <tr>
                                    <td align="center"><?php echo $no; ?></td>
                                    <td align="center">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editDescModal_<?php echo $user['id']; ?>">EDIT</button>
                                    </td>
                                    <td><?php echo htmlspecialchars($user['nama']); ?></td>
                                    <td><?php echo htmlspecialchars($pembagian_testing['users'] ?? ''); ?></td>
                                    <td><?php echo htmlspecialchars($pembagian_testing['jenis_testing'] ?? ''); ?></td>
                                    <td align="center"><?php echo $jumlah_testing; ?></td>
                                </tr>
                                <?php
                                    $no++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Desc -->
        <div class="modal fade" id="addDescModal" tabindex="-1" role="dialog" aria-labelledby="addDescLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form name="modal_popup" data-toggle="validator" method="post" action="" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header bg-blue">
                            <h5 class="modal-title" id="addDescLabel">Add New Description</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="color:white;">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form Fields -->
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="simpan_user" value="Simpan" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php
            if (isset($_POST['update_pembagian_testing'])) {
                $id_jobdesc = intval($_POST['id_jobdesc']);

                $id_user = null;
                $jenis_testing = null;

                if (!empty($_POST['id_user']) && is_array($_POST['id_user'])) {
                    $id_user = implode(',', $_POST['id_user']);
                }

                if (!empty($_POST['jenis_testing']) && is_array($_POST['jenis_testing'])) {
                    $jenis_testing = implode(',', $_POST['jenis_testing']);
                }

                $stmt = $con->prepare("UPDATE tbl_pembagian_testing_tq 
                                    SET id_user = ?, jenis_testing = ?
                                    WHERE id_jobdesc = ?");
                $stmt->bind_param("ssi", $id_user, $jenis_testing, $id_jobdesc);

                if ($stmt->execute()) {
                    echo "Data berhasil diupdate";
                } else {
                    echo "Gagal update: " . $stmt->error;
                }
            }
        ?>

        <?php
            $jobDescriptions = mysqli_query($con, " SELECT id_jobdesc, GROUP_CONCAT(DISTINCT id_user) AS id_user, GROUP_CONCAT(DISTINCT jenis_testing) AS jenis_testing
                FROM tbl_pembagian_testing_tq
                GROUP BY id_jobdesc
            ");

            while ($jobdesc = mysqli_fetch_assoc($jobDescriptions)):

                $selected_users_int = [];
                if (!empty($jobdesc['id_user'])) {
                    foreach (explode(',', $jobdesc['id_user']) as $p) {
                        $p = trim($p);
                        if ($p !== '' && ctype_digit($p)) {
                            $selected_users_int[] = (int)$p;
                        }
                    }
                }

                $whereSelected = '';
                if (!empty($selected_users_int)) {
                    $whereSelected = " OR id IN (" . implode(',', $selected_users_int) . ")";
                }

                $sqlUsers = "SELECT DISTINCT * 
                            FROM user_login 
                            WHERE status = 'Aktif'
                            AND dept = 'QC'
                            AND (akses = 'admin' OR akses = 'biasa'){$whereSelected}
                            ORDER BY user ASC";
                $users = mysqli_query($con, $sqlUsers);

                $selected_testing = [];
                if (!empty($jobdesc['jenis_testing'])) {
                    $selected_testing = array_map('trim', explode(',', $jobdesc['jenis_testing']));
                }

                $jenisTesting = "SELECT DISTINCT TRIM(SUBSTRING_INDEX(physical, ',', 1)) AS physical
                    FROM tbl_master_test
                    ORDER BY physical ASC
                ";
                $jenisTest = mysqli_query($con, $jenisTesting);

                $jenisTesting = "SELECT GROUP_CONCAT(u.user ORDER BY u.user ASC SEPARATOR ', ') AS users, p.jenis_testing
                                                        FROM tbl_jobdesc j
                                                        LEFT JOIN tbl_pembagian_testing_tq p ON j.id = p.id_jobdesc
                                                        LEFT JOIN user_login u ON p.id_user = u.id
                                                        WHERE j.id = {$user['id']}
                                                        GROUP BY j.id
                ";

                $jenis_testing_dipakai_lain = [];
            $res_dipakai_lain = mysqli_query($con, "
                SELECT jenis_testing 
                FROM tbl_pembagian_testing_tq 
                WHERE id_jobdesc != " . intval($jobdesc['id_jobdesc']) . " AND jenis_testing IS NOT NULL
            ");
            while ($row = mysqli_fetch_assoc($res_dipakai_lain)) {
                $arr = array_map('trim', explode(',', $row['jenis_testing']));
                foreach ($arr as $j) {
                    if ($j !== '') {
                        $jenis_testing_dipakai_lain[] = $j;
                    }
                }
            }
            $jenis_testing_dipakai_lain = array_unique($jenis_testing_dipakai_lain);

            $jenisTestingMaster = mysqli_query($con, "SELECT
                                                            UPPER(value) AS physical
                                                        FROM
                                                            tbl_tq_mastertest t
                                                        WHERE 
                                                            is_active = 1
                                                ");
        ?>

        <!-- Modal Edit -->
        <div class="modal fade" id="editDescModal_<?php echo htmlspecialchars($jobdesc['id_jobdesc']); ?>" tabindex="-1" role="dialog" aria-labelledby="editUserLabel_<?php echo htmlspecialchars($jobdesc['id_jobdesc']); ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" action="">
                    <div class="modal-content">
                        <div class="modal-header bg-blue">
                            <h5 class="modal-title">Edit Pembagian Testing</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="color:white;">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" name="id_jobdesc" value="<?php echo htmlspecialchars($jobdesc['id_jobdesc']); ?>">

                            <!-- Input Nama Jobdesc -->
                            <div class="form-group">
                                <label>Nama Jobdesc</label>
                                <?php
                                // Ambil nama jobdesc dari tbl_jobdesc untuk id ini
                                $nama_jobdesc = '';
                                $res_nama = mysqli_query($con, "SELECT nama FROM tbl_jobdesc WHERE id = " . intval($jobdesc['id_jobdesc']));
                                if ($row_nama = mysqli_fetch_assoc($res_nama)) {
                                    $nama_jobdesc = $row_nama['nama'];
                                }
                                ?>
                                <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($nama_jobdesc); ?>" required>
                            </div>

                            <!-- Select User -->
                            <div class="form-group">
                                <label>User</label>
                                <select name="id_user[]" class="form-select select2" multiple="multiple" data-placeholder="Pilih user QC" style="width:100%;">
                                    <?php
                                    // Reset data pointer supaya bisa di loop ulang
                                    mysqli_data_seek($users, 0);
                                    while ($user = mysqli_fetch_assoc($users)):
                                    ?>
                                        <option value="<?php echo intval($user['id']); ?>"
                                            <?php if (in_array(intval($user['id']), $selected_users_int)) echo 'selected'; ?>>
                                            <?php echo strtoupper(htmlspecialchars($user['user'])) . ' - ' . strtoupper(htmlspecialchars($user['level'])); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <!-- Select Jenis Testing -->
                            <div class="form-group">
                                <label>Jenis Testing</label>
                                <select name="jenis_testing[]" class="form-select select2" multiple="multiple" data-placeholder="Pilih jenis testing" style="width:100%;">
                                    <?php while ($testing = mysqli_fetch_assoc($jenisTestingMaster)): 
                                        $val = $testing['physical'];
                                        // Cek apakah jenis testing sudah dipakai di jobdesc lain, kecuali kalau sudah dipilih jobdesc ini (boleh dipilih)
                                        $disabled = '';
                                        if (in_array($val, $jenis_testing_dipakai_lain) && !in_array($val, $selected_testing)) {
                                            // Jika sudah dipakai jobdesc lain dan bukan milik jobdesc ini, disable opsi ini agar tidak bisa dipilih
                                            $disabled = 'disabled';
                                        }
                                    ?>
                                        <option value="<?php echo htmlspecialchars($val); ?>" 
                                            <?php if (in_array($val, $selected_testing)) echo 'selected'; ?>
                                            <?php echo $disabled; ?>>
                                            <?php echo htmlspecialchars($val); ?>
                                            <?php if ($disabled) echo " (Sudah dipakai)"; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" name="update_pembagian_testing" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php endwhile; ?>
    </body>
</html>

<?php if (isset($_SESSION['swal_success'])): ?>
<script>
    Swal.fire({
        title: 'Sukses!',
        text: 'Data berhasil disimpan.',
        icon: 'success',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    </script>
<?php unset($_SESSION['swal_success']); endif; ?>

<?php if (isset($_SESSION['swal_error'])): ?>
<script>
    Swal.fire({
        title: 'Gagal!',
        text: "<?php echo addslashes($_SESSION['swal_error']); ?>",
        icon: 'error',
        toast: true,
        position: 'top-end',
        showConfirmButton: true
    });
</script>
<?php unset($_SESSION['swal_error']); endif; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        // Inisialisasi Select2
        $('.select2').select2();
    });
</script>

