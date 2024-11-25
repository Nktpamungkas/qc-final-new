<?php

// Pastikan koneksi database sudah dilakukan
include "../../koneksi.php";// Sesuaikan dengan file koneksi database Anda

// Sertakan autoload PHPMailer
require '../../vendor/autoload.php';

function write_log($message)
{
    $logfile = 'log.txt'; // Tentukan nama file log
    $current_time = date("Y-m-d H:i:s"); // Menambahkan waktu saat log ditulis
    $message = $current_time . " - " . $message . "\n";
    file_put_contents($logfile, $message, FILE_APPEND); // Menulis log ke file
}

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

$no_order = $_GET['no_order'];
$po = $_GET['po'];
$id_nsp = $_GET['id_nsp'];
$id_cek = $_GET['id_cek'];
$id_cek1 = $_GET['id_cek1'];
$id_cek2 = $_GET['id_cek2'];
$step = $_GET['step'];
// Memeriksa dan menyetel nilai untuk id_cek1 dan id_cek2
$id_cek1_value = isset($id_cek1) && $id_cek1 !== '' ? $id_cek1 : "NULL";  // Jika kosong atau tidak ada, gunakan NULL
$id_cek2_value = isset($id_cek2) && $id_cek2 !== '' ? $id_cek2 : "NULL";  // Jika kosong atau tidak ada, gunakan NULL


// Untuk step Update GKJ
if ($step == 2) {
    // echo 'Step 2';
    $step2 = 3;
    $row_cek = mysqli_query($con, "SELECT * FROM tbl_detail_retur_now WHERE id='$id_cek'");
    $data_cek = mysqli_fetch_assoc($row_cek);
    $row_gkj_staff = mysqli_query($con, "SELECT * FROM tbl_digital_signature WHERE id='$data_cek[gkj]'");
    $data_gkj_staff = mysqli_fetch_array($row_gkj_staff);
    $row_mng_qc = mysqli_query($con, "SELECT * FROM tbl_digital_signature WHERE id='$data_cek[qcf_manager]'");
    $data_mng_qc = mysqli_fetch_array($row_mng_qc);
    $email_gkj = $data_gkj_staff['email'];
    $email_qc_mng = $data_mng_qc['email'];
    $tanggal = date("Y-m-d H:i:s");
    $status = 0;
    $approve = 'REJECT_GKJ';
    $subject = 'APPROVE BON RETUR QC';

    if ($id_cek1_value != 'NULL') {
        $id_approve2 = "AND id_cek1 = '$id_cek1'";
    } else {
        $id_approve2 = "";
    }
    if ($id_cek2_value != 'NULL') {
        $id_approve3 = "AND id_cek2 = '$id_cek2'";
    } else {
        $id_approve3 = "";
    }


    $sql = "UPDATE tbl_email_bon_retur 
        SET 
            id_cek1 = $id_cek1_value, 
            id_cek2 = $id_cek2_value, 
            email_gkj = '$email_gkj', 
            status_email_gkj = '$status', 
            `status` = '$approve',
            tanggal_approve_gkj = '$tanggal'
        WHERE 
            id_cek = '$id_cek'
            $id_approve2
            $id_approve3
        ";
    if (mysqli_query($con, $sql)) {

        echo 'Data Berhasil Di Reject Oleh GKJ';

        // $transport = (new Swift_SmtpTransport('mail.ridinet.id', 465))  // Ganti dengan host SMTP server Anda (misal Gmail)
        //     ->setUsername('noreply@ridinet.id')   // Ganti dengan email Anda
        //     ->setPassword('^D&{rhD;oox,')     // Ganti dengan password email Anda
        //     ->setEncryption('SSL');                  // Menggunakan TLS untuk koneksi aman

        // $mailer = new Swift_Mailer($transport);
        // $message = (new Swift_Message($subject))
        //     ->setFrom(['noreply@ridinet.id' => 'DEPT. QCF'])  // Ganti dengan email pengirim Anda
        //     ->setTo([$email_qc_mng=> $data_mng_qc['nama']])  // Ganti dengan email penerima
        //     ->setBody('<h1>Bon Retur QCF</h1>
        //                 <p>Dear,  ' . $data_mng_qc['nama'] . '</p>
        //                 <p>Mohon di approve untuk bon retur ini. Untuk detail dapat disini <a href="localhost/qc-final-new/pages/cetak/cetak_suratretur.php?no_order=' . $no_order . '&po=' . $po . '&id_nsp=' . $id_nsp . '&id_cek=' . $id_cek . '&id_cek1=' . $id_cek1 . '&id_cek2=' . $id_cek2 . '">Detail</a></p>
        //                 <p><strong style="color: green">APPROVE</strong> <a href="localhost/qc-final-new/pages/cetak/approve_bon_retur_id.php?no_order=' . $no_order . '&po=' . $po . '&id_nsp=' . $id_nsp . '&id_cek=' . $id_cek . '&id_cek1=' . $id_cek1 . '&id_cek2=' . $id_cek2 . '&step=' . $step2 . '">Klik untuk Approve</a></p>
        //                 <p><strong style="color: red">REJECT</strong> <a href="link_baru">Klik untuk Reject</a></p>
        //                 ', // Body dalam format HTML
        //         'text/html'  // Tipe MIME untuk HTML
        //     );

        // // Mengirim email
        // try {
        //     $result = $mailer->send($message);
        //     echo 'Email sent successfully!';
        // } catch (Exception $e) {
        //     echo 'Failed to send email: ' . $e->getMessage();
        // }
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else 

// Update untuk manager qc
    if ($step == 3) {
        if ($id_cek1_value != 'NULL') {
            $id_approve2 = "AND id_cek = '$id_cek1'";
        } else {
            $id_approve2 = "";
        }
        if ($id_cek2_value != 'NULL') {
            $id_approve3 = "AND id_cek = '$id_cek2'";
        } else {
            $id_approve3 = "";
        }
        $row_cek = mysqli_query($con, "SELECT 
                                                        * FROM 
                                                    tbl_detail_retur_now 
                                                    WHERE id='$id_cek'
                                                    ");
        $data_cek = mysqli_fetch_assoc($row_cek);
        $row_sales = mysqli_query($con, "SELECT 
                                                            * FROM 
                                                            tbl_digital_signature 
                                                                WHERE 
                                                            id='$data_cek[sales]'");
        $data_sales = mysqli_fetch_array($row_sales);
        $cek_sales = mysqli_num_rows($row_sales);
        $row_mkt_ppc_mng = mysqli_query($con, "SELECT 
                                                            * FROM 
                                                            tbl_digital_signature 
                                                                WHERE 
                                                            id='$data_cek[mkt_ppc_manager]'");
        $data_mkt_ppc_mng = mysqli_fetch_array($row_mkt_ppc_mng);
        $cek_mkt_ppc_mng = mysqli_num_rows($row_mkt_ppc_mng);
        $row_mng_qc = mysqli_query($con, "SELECT 
                                                        * FROM 
                                                            tbl_digital_signature 
                                                        WHERE 
                                                            id='$data_cek[qcf_manager]'");
        $data_mng_qc = mysqli_fetch_array($row_mng_qc);
        $email_qc_mng = $data_mng_qc['email'];
        $row_dmf = mysqli_query($con, "SELECT 
                                                        * FROM 
                                                            tbl_digital_signature 
                                                        WHERE 
                                                            id='$data_cek[dmf]'");
        $data_dmf = mysqli_fetch_array($row_dmf);
        $email_dmf = $data_dmf['email'];

        $status = 0;
        $approve = 'REJECT_QCF_MANAGER';
        $subject = 'APPROVE BON RETUR QC';
        $tanggal = date("Y-m-d H:i:s");
        

        $sql = "UPDATE tbl_email_bon_retur 
            SET 
                id_cek1 = $id_cek1_value, 
                id_cek2 = $id_cek2_value, 
                email_qc_mng = '$email_qc_mng', 
                status_email_qc_mng = '$status', 
                `status` = '$approve',
                tanggal_approve_mng_qcf = '$tanggal'
            WHERE id_cek = '$id_cek'
            $id_approve2
            $id_approve3
            ";
        if (mysqli_query($con, $sql)) {
            echo 'Data Berhasil Di Reject Oleh GKJ';
            }
    }
// Sales Assistant 
    else if ($step == 4){
        // echo 'Test untuk sales asistant';
        if ($id_cek1_value != 'NULL') {
            $id_approve2 = "AND id_cek = '$id_cek1'";
        } else {
            $id_approve2 = "";
        }
        if ($id_cek2_value != 'NULL') {
            $id_approve3 = "AND id_cek = '$id_cek2'";
        } else {
            $id_approve3 = "";
        }
        $row_cek = mysqli_query($con, "SELECT 
                                                        * FROM 
                                                    tbl_detail_retur_now 
                                                    WHERE id='$id_cek'
                                                    ");
        $data_cek = mysqli_fetch_assoc($row_cek);
        $row_sales = mysqli_query($con, "SELECT 
                                                            * FROM 
                                                            tbl_digital_signature 
                                                                WHERE 
                                                            id='$data_cek[sales]'");
        $data_sales = mysqli_fetch_array($row_sales);
        $email_sales = $data_sales['email'];

        $status = 0;
        $approve = 'REJECT_SALES';
        $tanggal = date("Y-m-d H:i:s");


        $sql = "UPDATE tbl_email_bon_retur 
            SET 
                id_cek1 = $id_cek1_value, 
                id_cek2 = $id_cek2_value, 
                email_sales = '$data_sales[email]', 
                status_email_sales = '$status', 
                `status` = '$approve',
                tanggal_approve_sales = '$tanggal'
            WHERE id_cek = '$id_cek'
            $id_approve2
            $id_approve3";
        if (mysqli_query($con, $sql)) {
            echo 'Data Berhasil Di Reject Oleh Sales Assistant';
        }

// Untuk Manager PPC/MKT 
    } else if ($step == 5){
        if ($id_cek1_value != 'NULL') {
            $id_approve2 = "AND id_cek = '$id_cek1'";
        } else {
            $id_approve2 = "";
        }
        if ($id_cek2_value != 'NULL') {
            $id_approve3 = "AND id_cek = '$id_cek2'";
        } else {
            $id_approve3 = "";
        }
        $row_cek = mysqli_query($con, "SELECT 
                                                        * FROM 
                                                    tbl_detail_retur_now 
                                                    WHERE id='$id_cek'
                                                    ");
        $data_cek = mysqli_fetch_assoc($row_cek);
        $row_mkt_ppc_mng = mysqli_query($con, "SELECT 
                                                            * FROM 
                                                            tbl_digital_signature 
                                                                WHERE 
                                                            id='$data_cek[mkt_ppc_manager]'");
        $data_mkt_ppc_mng = mysqli_fetch_array($row_mkt_ppc_mng);
        $cek_mkt_ppc_mng = mysqli_num_rows($row_mkt_ppc_mng);
        $row_dmf = mysqli_query($con, "SELECT 
                                                        * FROM 
                                                            tbl_digital_signature 
                                                        WHERE 
                                                            id='$data_cek[dmf]'");
        $data_dmf = mysqli_fetch_array($row_dmf);
        $email_dmf = $data_dmf['email'];

        $status = 0;
        $approve = 'REJECT_MKT/PPC_MANAGER';
        $tanggal = date("Y-m-d H:i:s");
        

        $sql = "UPDATE tbl_email_bon_retur 
            SET 
                id_cek1 = $id_cek1_value, 
                id_cek2 = $id_cek2_value, 
                email_mkt_ppc_mng = '$data_mkt_ppc_mng[email]', 
                status_email_mkt_ppc_mng = '$status', 
                `status` = '$approve',
                tanggal_approve_mng_mkt_ppc = '$tanggal'
            WHERE id_cek = '$id_cek'
            $id_approve2
            $id_approve3";
        if (mysqli_query($con, $sql)) {
            echo 'Data Berhasil Di Reject Oleh MKT/PPC Manager';
        }

    } else if ($step == 6){
        if ($id_cek1_value != 'NULL') {
            $id_approve2 = "AND id_cek = '$id_cek1'";
        } else {
            $id_approve2 = "";
        }
        if ($id_cek2_value != 'NULL') {
            $id_approve3 = "AND id_cek = '$id_cek2'";
        } else {
            $id_approve3 = "";
        }
        $row_cek = mysqli_query($con, "SELECT 
                                                        * FROM 
                                                    tbl_detail_retur_now 
                                                    WHERE id='$id_cek'
                                                    ");
        $data_cek = mysqli_fetch_assoc($row_cek);
        $row_dmf = mysqli_query($con, "SELECT 
                                                        * FROM 
                                                            tbl_digital_signature 
                                                        WHERE 
                                                            id='$data_cek[dmf]'");
        $data_dmf = mysqli_fetch_array($row_dmf);
        $email_dmf = $data_dmf['email'];

        $status = 0;
        $approve = 'REJECT_DMF';
        $subject = 'APPROVE BON RETUR QC';
        $tanggal = date("Y-m-d H:i:s");

        $sql = "UPDATE tbl_email_bon_retur 
            SET 
                id_cek1 = $id_cek1_value, 
                id_cek2 = $id_cek2_value, 
                email_dmf = '$email_dmf', 
                status_email_dmf = '$status', 
                `status` = '$approve',
                tanggal_approve_dmf = '$tanggal'
            WHERE id_cek = '$id_cek'
            $id_approve2
            $id_approve3";
        if (mysqli_query($con, $sql)) {
            echo 'Data Berhasil Di Reject Oleh DMF';
        }
    }

// Ambil data staf QC dan email terkait dari database
// $row_cek = mysqli_query($con, "SELECT * FROM tbl_detail_retur_now WHERE id='$id_cek'");
// $data_cek = mysqli_fetch_assoc($row_cek);
// $row_gkj_staff = mysqli_query($con, "SELECT * FROM tbl_digital_signature WHERE id='$data_cek[gkj]'");
// $data_gkj_staff = mysqli_fetch_array($row_gkj_staff);
// $row_qc_staff = mysqli_query($con, "SELECT * FROM tbl_digital_signature WHERE id='$data_cek[qc_staff]'");
// $data_qc_staff = mysqli_fetch_array($row_qc_staff);
// $row_mng_qc = mysqli_query($con, "SELECT * FROM tbl_digital_signature WHERE id='$data_cek[qcf_manager]'");
// $data_mng_qc = mysqli_fetch_array($row_mng_qc);
// $email_qc = $data_qc_staff['email'];
// $email_gkj = $data_gkj_staff['email'];
// $email_qc_mng = $data_mng_qc['email'];


//     // Status APPROVE
// $status = 1;
// $approve = 'APPROVE_STAFF_QC';
// $subject = 'APPROVE BON RETUR QC';
// $body_email = 'Mohon di Approve untuk Bon Retur. Detail Retur dapat dilihat di 
//         "https://online.indotaichen.com/qc-final-new/pages/cetak/cetak_suratretur.php?no_order=' . $no_order . '&po=' . $po . '&id_nsp=' . $id_nsp . '&id_cek=' . $id_cek . '&id_cek1=' . $id_cek1 . '&id_cek2=' . $id_cek2 . '"';

// // Insert ke database





// if($id_cek1!='0'){
//     $id_approve2 = "AND id_cek1 = '$id_cek1'";
// }else{
//     $id_approve2 ="";
// }
// if($id_cek2!='0'){
//     $id_approve3 = "AND id_cek2 = '$id_cek2'" ;
// }$id_approve3 ="";

//  // Query untuk memeriksa apakah sudah ada data yang cocok
// $qcek_approve = "SELECT * 
//                     FROM tbl_email_bon_retur
//                     WHERE 
//                     id_cek = '$id_cek' 
//                     $id_approve2
//                     $id_approve3
//                     AND status_email_qc = '1' 
//                     AND status_email_gkj is NULL 
//                     ORDER BY id DESC
//                     LIMIT 1";

//                     // Menjalankan query
//                     $query_approve1 = mysqli_query($con, $qcek_approve);

//                     // Menyimpan hasil query untuk menghitung jumlah baris
//                     $row_approve_gkj = mysqli_num_rows($query_approve1);
// if($row_approve_gkj>1){
//         $status = 1;
//         $approve = 'APPROVE_STAFF_GKJ';
//         $subject = 'APPROVE BON RETUR QC';
//         $body_email = 'Mohon di Approve untuk Bon Retur. Detail Retur dapat dilihat di 
//                 "https://online.indotaichen.com/qc-final-new/pages/cetak/cetak_suratretur.php?no_order=' . $no_order . '&po=' . $po . '&id_nsp=' . $id_nsp . '&id_cek=' . $id_cek . '&id_cek1=' . $id_cek1 . '&id_cek2=' . $id_cek2 . '"';
//     // Insert ke database
//     $sql = "UPDATE tbl_email_bon_retur
//             SET('email_gkj','status_email_gkj',`status`)
//             VALUES('$email_gkj','$status', '$approve')";
//     if (mysqli_query($con, $sql)) {
//         $transport = (new Swift_SmtpTransport('mail.ridinet.id', 465))  // Ganti dengan host SMTP server Anda (misal Gmail)
//             ->setUsername('noreply@ridinet.id')   // Ganti dengan email Anda
//             ->setPassword('^D&{rhD;oox,')     // Ganti dengan password email Anda
//             ->setEncryption('SSL');                  // Menggunakan TLS untuk koneksi aman

//         $mailer = new Swift_Mailer($transport);
//         $message = (new Swift_Message($subject))
//             ->setFrom(['noreply@ridinet.id' => 'DEPT. QCF'])  // Ganti dengan email pengirim Anda
//             ->setTo([$email_gkj])  // Ganti dengan email penerima
//             ->setBody("Test Tulis Email
//                     Bisa klik link berikut
//                    $body_email");

//         // Mengirim email
//         try {
//             $result = $mailer->send($message);
//             echo 'Email sent successfully!';
//         } catch (Exception $e) {
//             echo 'Failed to send email: ' . $e->getMessage();
//         }
//     } else {
//         echo "Error: " . mysqli_error($koneksi);
    // }
?>