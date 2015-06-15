<? include("header.php"); ?>
                  <table>
                    <tr>
                      <td> <img src="image/user_icon.png" width="100" height="96" alt="" /> </td>
                      <td><h2>PROFIL</h2></td>
                    </tr>
                  </table> <br />

<h1>DESKRIPSI MATA KULIAH</h1>
Mata Kuliah Internet dan Pemrograman adalah mata kuliah yang membahas tentang konsep dasar aplikasi web dinamis. dalam mata kuliah ini, akan diperkenalkan tentang salah satu server side scripting yaitu PHP. Pengenalan PHP tidak hanya sebatas pada pendekatan prosedural saja, tetapi juga akan dibahas dengan menggunakan pendekatan Objek Oriented Progamming.
<br /><ol>
  <h3>LAPORAN NILAI TERTINGGI HASIL UAS INTERNET DAN PEMROGRAMAN</h3>
</ol>
Tujuan Akhir Perkuliahan<br />
<ol>
  <li>   Memahami konsep web dinamis.</li>
  <li>   Memahami konsep server-side scripting</li>
  <li>   Mampu menerapkan konsep untuk membangun sebuah web dinamis</li>
</ol>  <br />
<?
// memanggil file koneksi
include 'koneksi_class.php';
// instance objek db
$db = new database();
// koneksi ke MySQL via method
$db->connectMySQL();
// proses hapus data
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        // baca ID dari parameter ID Anggota yang akan dihapus
        $id = $_GET['rank'];
        // proses hapus data anggota berdasarkan ID via method
        $db->hapusAnggota($id);
    } elseif ($_GET['aksi'] == 'tambah') {
        echo"<br>
<form method=POST action='?aksi=tambahAnggota'>
<table>
<tr><td>Nama</td><td><input type=text name='nama'></td></tr>
<tr><td>Kelas</td><td><input type=text name='kelas'></td></tr>
<tr><td>Nilai</td><td><input type=text name='nilai'></td></tr>
<tr><td></td><td><input type=submit value='simpan'></td></tr>
</table>
</form>
";
    } elseif ($_GET['aksi'] == 'tambahAnggota') {
        $nama = $_POST['nama'];
        $kelas = $_POST['kelas'];
        $nilai = $_POST['nilai'];
        $db->tambahAnggota($nama, $kelas, $nilai);
    }
// proses edit data
    else if ($_GET['aksi'] == 'edit') {
        // baca ID anggota yang akan diedit
        $id = $_GET['rank'];
// menampilkan form edit anggota pakai method bacaDataAnggota()
        ?>   
 
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>?aksi=update">
            <table>
                <tr><td>Nama Mahasiswa</td><td>:</td>
                    <td><input type="text" name="nama" value="<?php echo $db->bacaDataAnggota('nama', $id); ?>"></td>
                </tr>
                <tr><td>Kelas</td><td>:</td>
                    <td><input type="text" name="kelas" value="<?php echo $db->bacaDataAnggota('kelas', $id); ?>" size="40"></td>
                </tr>
                <tr><td>Nilai</td><td>:</td>
                    <td><input type="text" name="nilai" value="<?php echo $db->bacaDataAnggota('nilai', $id); ?>"></td>
                </tr> 
            </table>
            <input type="hidden" name="id" value="<?php echo $rank; ?>">
            <input type="submit" name="submit" value="Update Data">
        </form>
 
        <?php
    } else if ($_GET['aksi'] == 'update') {
        // proses update data anggota
        $rank = $_POST['rank'];
        $nama = $_POST['nama'];
        $kelas = $_POST['kelas'];
        $nilai = $_POST['nilai'];
        // update data via method
        $db->updateDataAnggota($rank, $nama, $kelas, $nilai);
    }
}
// buat array data anggota dari method tampilAnggota()
$arrayanggota = $db->tampilAnggota();
echo"</table> <br> <a href='?aksi=tambah'>TAMBAH</a>";
echo "<table border='1' cellpadding='5'>
      <tr><th>Rank</th>
           <th>Nama Mahasiswa</th>
           <th>Kelas</th>
           <th>Nilai</th>
           <th>Aksi</th>
       </tr>";
$i = 1;
foreach ($arrayanggota as $data) {
    echo "<tr><td>" . $i . "</td> 
               <td>" . $data['nama'] . "</td>
               <td>" . $data['kelas'] . "</td>
               <td>" . $data['nilai'] . "</td>
               <td><a href='" . $_SERVER['PHP_SELF'] . "?aksi=edit&rank=" . $data['rank'] . "'>Edit</a> |
                   <a href='" . $_SERVER['PHP_SELF'] . "?aksi=hapus&rank=" . $data['rank'] . "'>Hapus</a></td>
            </tr>";
    $i++;
}
echo "</table>";