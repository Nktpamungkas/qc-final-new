<?php
    session_start();
    include "koneksi.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simpan_user']) && $_POST['simpan_user'] == 'Simpan') {
        $nama     = mysqli_real_escape_string($con, $_POST['nama']);
        $user     = mysqli_real_escape_string($con, $_POST['user']);
        $email    = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $level    = mysqli_real_escape_string($con, $_POST['level']);
        $status   = 'Aktif';
        $dept     = mysqli_real_escape_string($con, $_POST['dept']);
        $foto     = mysqli_real_escape_string($con, $_POST['foto']);
        $akses    = mysqli_real_escape_string($con, $_POST['akses']);
        $jabatan  = mysqli_real_escape_string($con, $_POST['jabatan']);
        // $jobdesc  = mysqli_real_escape_string($con, $_POST['jobdesc']);

        $query = "INSERT INTO user_login 
            (nama, user, email, password, level, status, dept, foto, akses, jabatan
            -- , jobdesc
            ) 
            VALUES 
            ('$nama', '$user', '$email', '$password', '$level', '$status', '$dept', '$foto', '$akses', '$jabatan'
            -- , '$jobdesc'
            )";

        if (mysqli_query($con, $query)) {
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
                        window.location.href = 'userInformation';
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

    // Proses update data
    if (isset($_POST['update_user'])) {
        $id       = mysqli_real_escape_string($con, $_POST['id']); 
        $nama     = mysqli_real_escape_string($con, $_POST['nama']);
        $user     = mysqli_real_escape_string($con, $_POST['user']);
        $email    = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $level    = mysqli_real_escape_string($con, $_POST['level']);
        $dept     = mysqli_real_escape_string($con, $_POST['dept']);
        $foto     = mysqli_real_escape_string($con, $_POST['foto']);
        $akses    = mysqli_real_escape_string($con, $_POST['akses']);
        $jabatan  = mysqli_real_escape_string($con, $_POST['jabatan']);
        // $jobdesc  = mysqli_real_escape_string($con, $_POST['jobdesc']);

        $query = "UPDATE user_login SET 
                    nama='$nama',  user='$user', email='$email', password='$password', 
                    level='$level', dept='$dept', foto='$foto', akses='$akses', 
                    jabatan='$jabatan'
                    -- , jobdesc='$jobdesc' 
                    WHERE id='$id'";

        if (mysqli_query($con, $query)) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                Swal.fire({
                    title: 'Data Berhasil Diperbarui!',
                    text: 'Klik OK untuk kembali ke halaman user.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'userInformation';
                });
            </script>";
            exit;
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                Swal.fire({
                    title: 'Gagal Memperbarui!',
                    text: '" . addslashes(mysqli_error($con)) . "',
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
                        <h3 class="box-title">USER INFORMATION</h3>
                        <br><br>
                        <!-- Tombol Add User -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUserModal">
                            + Add User
                        </button>
                    </div>
                    <div class="box-body">
                        <table id="example3" class="table table-bordered table-hover table-striped display nowrap" width="100%">
                            <thead class="bg-blue">
                                <tr>
                                    <th><div align="center">NO</div></th>
                                    <th><div align="center">ACTION</div></th>
                                    <th><div align="center">USER</div></th>
                                    <th><div align="center">PASSWORD</div></th>
                                    <th><div align="center">ROLE</div></th>
                                    <!-- <th><div align="center">JOBDESC</div></th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $users = mysqli_query($con, "SELECT *
                                            FROM user_login
                                            WHERE status = 'Aktif'
                                            AND dept = 'QC'
                                            AND (akses = 'admin' OR akses = 'biasa');
                                    ");
                                    $no = 1;
                                    while($user = mysqli_fetch_array($users)) {
                                ?>
                                <tr>
                                    <td align="center"><?php echo $no;?></td>
                                    <td align="center">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editUserModal_<?php echo $user['id']; ?>">EDIT</button>
                                    </td>
                                    <td><?php echo htmlspecialchars($user['user']); ?></td>
                                    <td><?php echo htmlspecialchars($user['password']); ?></td>
                                    <td><?php echo htmlspecialchars($user['level']); ?></td>
                                    <!-- <td><?php echo htmlspecialchars($user['jobdesc']); ?></td> -->
                                </tr>
                                <?php $no++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Tambah User -->
        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form name="modal_popup" data-toggle="validator" method="post" action="" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header bg-blue">
                            <h5 class="modal-title" id="addUserLabel">Add New User</h5>
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
                            <div class="form-group">
                                <label>User</label>
                                <input type="text" name="user" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control" required>
                            </div>
                            <?php
                                $levels = mysqli_query($con, "SELECT DISTINCT level FROM user_login ORDER BY level ASC");
                            ?>
                            <div class="form-group">
                                <label>Level</label>
                                <select name="level" class="form-control" required>
                                    <option value="" disabled selected>-- Pilih Level --</option>
                                    <?php while ($level = mysqli_fetch_assoc($levels)) { ?>
                                        <option value="<?php echo htmlspecialchars($level['level']); ?>">
                                            <?php echo htmlspecialchars($level['level']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php
                                $departments = mysqli_query($con, "SELECT nama FROM tbl_dept ORDER BY nama ASC");
                            ?>
                            <div class="form-group">
                                <label>Departemen</label>
                                <select name="dept" class="form-control" required>
                                    <option value="" disabled selected>-- Pilih Departemen --</option>
                                    <?php while ($dept = mysqli_fetch_assoc($departments)) { ?>
                                        <option value="<?php echo ($dept['nama'] == 'QCF') ? 'QC' : htmlspecialchars($dept['nama']); ?>">
                                            <?php echo htmlspecialchars($dept['nama']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Foto (Avatar)</label>
                                <select name="foto" class="form-control">
                                    <option value="" disabled selected>-- Pilih Avatar --</option>
                                    <option value="avatar">avatar</option>
                                    <option value="avatar2">avatar2</option>
                                    <option value="avatar3">avatar3</option>
                                    <option value="avatar04">avatar04</option>
                                    <option value="avatar5">avatar5</option>
                                    <option value="avatar6">avatar6</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Akses</label>
                                <select name="akses" class="form-control">
                                    <option value="" disabled selected>-- Pilih Akses --</option>
                                    <option value="admin">admin</option>
                                    <option value="biasa">biasa</option>
                                    <option value="superadmin">superadmin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" name="jabatan" class="form-control">
                            </div>
                            <!-- <div class="form-group">
                                <label>Jobdesc</label>
                                <input type="text" name="jobdesc" class="form-control">
                            </div> -->
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
            $users = mysqli_query($con, "SELECT * FROM user_login WHERE status = 'Aktif'");
            while ($user = mysqli_fetch_array($users)) {
            ?>
            <div class="modal fade" id="editUserModal_<?php echo $user['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editUserLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="POST" action="">
                        <div class="modal-content">
                            <div class="modal-header bg-blue">
                                <h5 class="modal-title">Edit User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" style="color:white;">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($user['nama']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>User</label>
                                    <input type="text" name="user" class="form-control" value="<?php echo htmlspecialchars($user['user']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="password" class="form-control" value="<?php echo htmlspecialchars($user['password']); ?>" required>
                                </div>
                                <!-- LEVEL -->
                                <?php
                                    $levels = mysqli_query($con, "SELECT DISTINCT level FROM user_login ORDER BY level ASC");
                                ?>
                                <div class="form-group">
                                    <label>Level</label>
                                    <select name="level" class="form-control" required>
                                        <option value="" disabled>-- Pilih Level --</option>
                                        <?php while ($level = mysqli_fetch_assoc($levels)) { ?>
                                            <option value="<?php echo htmlspecialchars($level['level']); ?>"
                                                <?php echo ($level['level'] == $user['level']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($level['level']); ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!-- DEPARTEMEN -->
                                <?php
                                    $departments = mysqli_query($con, "SELECT nama FROM tbl_dept ORDER BY nama ASC");
                                ?>
                                <div class="form-group">
                                    <label>Departemen</label>
                                    <select name="dept" class="form-control" required>
                                        <option value="" disabled>-- Pilih Departemen --</option>
                                        <?php while ($dept = mysqli_fetch_assoc($departments)) { ?>
                                            <option value="<?php echo htmlspecialchars($dept['nama']); ?>"
                                                <?php echo ($dept['nama'] == $user['dept']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($dept['nama']); ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!-- FOTO (AVATAR) -->
                                <div class="form-group">
                                    <label>Foto (Avatar)</label>
                                    <select name="foto" class="form-control">
                                        <option value="" disabled>-- Pilih Avatar --</option>
                                        <?php
                                        $avatars = ['avatar', 'avatar2', 'avatar3', 'avatar04', 'avatar5', 'avatar6'];
                                        foreach ($avatars as $avatar) {
                                            echo "<option value=\"$avatar\" " . ($avatar == $user['foto'] ? 'selected' : '') . ">$avatar</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- AKSES -->
                                <div class="form-group">
                                    <label>Akses</label>
                                    <select name="akses" class="form-control">
                                        <option value="" disabled>-- Pilih Akses --</option>
                                        <?php
                                        $aksesList = ['admin', 'biasa', 'superadmin'];
                                        foreach ($aksesList as $akses) {
                                            echo "<option value=\"$akses\" " . ($akses == $user['akses'] ? 'selected' : '') . ">$akses</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control" value="<?php echo htmlspecialchars($user['jabatan']); ?>">
                                </div>
                                <!-- <div class="form-group">
                                    <label>Jobdesc</label>
                                    <input type="text" name="jobdesc" class="form-control" value="<?php echo htmlspecialchars($user['jobdesc']); ?>">
                                </div> -->
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="update_user" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php } 
        ?>
    </body>
</html>

<?php if (isset($_SESSION['swal_success'])): ?>
<script>
    Swal.fire({
        title: 'Sukses!',
        text: 'Data user berhasil disimpan.',
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