<?php
$atnow = date("his");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=masterdatalab-" . substr($_GET['awal'], 0, 10) . $atnow . ".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");


//disini script laporan anda
?>
<?php
include "../../koneksi.php";
// ini_set("error_reporting", 1);

$Awal = $_GET['awal'];
$Akhir = $_GET['akhir'];

$no_counter = isset($_GET['no_counter']) ? $_GET['no_counter'] : null;

?>

<body>
  <strong>Periode:
    <?php echo $Awal; ?> s/d
    <?php echo $Akhir; ?>
  </strong><br>
  <table width="100%" border="1">
    <thead>
      <tr>
        <th bgcolor="#99FF99">No</th>
        <th bgcolor="#99FF99">Suffix</th>
        <th bgcolor="#99FF99">No Counter</th>
        <th bgcolor="#99FF99">Jenis Testing</th>
        <th bgcolor="#99FF99">Treatment</th>
        <th bgcolor="#99FF99">Buyer</th>
        <th bgcolor="#99FF99">No Warna</th>
        <th bgcolor="#99FF99">Nama Warna</th>
        <th bgcolor="#99FF99">Item</th>
        <th bgcolor="#99FF99">Jenis Kain</th>
        <th bgcolor="#99FF99">Personil Testing</th>
        <th bgcolor="#99FF99">Permintaan Testing</th>
        <th bgcolor="#99FF99">Created By</th>
        <th bgcolor="#99FF99">Status</th>
        <th bgcolor="#99FF99">Status QC</th>
      </tr>
    </thead>
    <br>
    <tbody>
      <?php
      $no = 1;
      $sql = "SELECT * FROM tbl_test_qc WHERE tgl_buat BETWEEN '$Awal' AND '$Akhir'";

      if (!empty($no_counter)) {
        $sql .= " AND no_counter = '$no_counter'";
      }

      $query = mysqli_query($conlab, $sql);

      while ($r = mysqli_fetch_array($query)) {
        ?>
        <tr>
          <td>
            <?php echo $no; ?>
          </td>
          <td align="center">
            <?php echo $r['suffix']; ?>
          </td>
          <td>
            <?php echo $r['no_counter']; ?>
          </td>
          <td>
            <?php echo $r['jenis_testing']; ?>
          </td>
          <td>
            <?php echo $r['treatment']; ?>
          </td>
          <td>
            <?php echo $r['buyer']; ?>
          </td>
          <td>
            <?php echo $r['no_warna']; ?>
          </td>
          <td>
            <?php echo $r['warna']; ?>
          </td>
          <td>
            <?php echo $r['no_item']; ?>
          </td>
          <td>
            <?php echo $r['jenis_kain']; ?>
          </td>
          <td>
            <?php echo $r['nama_personil_test']; ?>
          </td>
          <td>
            <?php echo $r['permintaan_testing']; ?>
          </td>
          <td>
            <?php echo $r['created_by']; ?>
          </td>
          <td>
            <?php echo $r['sts_laborat']; ?>,
            <?php echo $r['sts']; ?>
          </td>
          <td>
            <?php echo $r['sts_qc']; ?>
          </td>
        </tr>

        <?php $no++;
      } ?>
    </tbody>
  </table>
</body>