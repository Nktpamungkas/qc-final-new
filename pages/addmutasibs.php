<?php
function no_urut(){
    include "koneksi.php";
    date_default_timezone_set("Asia/Jakarta");
    // Array bulan romawi
    $bulan_romawi = [
        1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
        7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
    ];
    $bulan = (int)date("m");
    $tahun = date("Y");
    $format_romawi = "/QCF/MBL/".$bulan_romawi[$bulan]."/".$tahun;
    $format_angka = "/QCF/MBL/".str_pad($bulan,2,'0',STR_PAD_LEFT)."/".$tahun;

    // Ambil data terakhir untuk bulan & tahun ini (baik format angka maupun romawi)
    $sql = mysqli_query($con, "SELECT no_mutasi FROM mutasi_bs_krah 
        WHERE no_mutasi LIKE '%/QCF/MBL/".str_pad($bulan,2,'0',STR_PAD_LEFT)."/".$tahun."' 
           OR no_mutasi LIKE '%/QCF/MBL/".$bulan_romawi[$bulan]."/".$tahun."' 
        ORDER BY no_mutasi DESC LIMIT 1") or die (mysqli_error($con));
    $d = mysqli_num_rows($sql);
    if($d > 0){
        $r = mysqli_fetch_array($sql);
        $d = $r['no_mutasi'];
        // Ambil nomor urut sebelum /QCF/MBL/
        $parts = explode('/QCF/MBL/', $d);
        $str = isset($parts[0]) ? $parts[0] : '000';
        $Urut = (int)$str;
    } else {
        $Urut = 0;
    }
    $Urut++;
    $Nol = str_pad($Urut, 3, "0", STR_PAD_LEFT);
    $nipbr = $Nol . $format_romawi;
    return $nipbr;
}

$nou = no_urut();
mysqli_query($con, "INSERT INTO mutasi_bs_krah (`no_mutasi`,`dept`,`tgl_buat`,`jam_penyerahan`) 
                VALUES ('$nou','QCF',now(),now())");

echo "<script type=\"text/javascript\">
            alert(\"Data Berhasil Ditambah\");
            window.location = \"MutasiBS\"
      </script>";
?>
