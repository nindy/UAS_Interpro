<?
class database {
    // properti
    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbName = "crudoop";
    // method koneksi MySQL
    function connectMySQL() {
        mysql_connect($this->dbHost, $this->dbUser);
        mysql_select_db($this->dbName) or die("Database tidak ada!");
    }
    // method tambah data (insert)  
    function tambahAnggota($nama, $kelas, $nilai) {
        $query = "INSERT INTO anggota (nama, kelas, nilai) VALUES ('$nama', '$kelas','$nilai')";
        $hasil = mysql_query($query);
        if ($hasil)
            echo"<meta http-equiv='refresh' content='0; url=index.php'>";
        else
            echo "Data Anggota gagal disimpan ke database";
    }
    // method tampil data   
    function tampilAnggota() {
        $query = mysql_query("SELECT * FROM anggota ORDER BY rank");
        while ($row = mysql_fetch_array($query))
            $data[] = $row;
        return $data;
    }
    // method hapus data
    function hapusAnggota($rank) {
        $query = mysql_query("DELETE FROM anggota WHERE rank='$rank'");
        echo "<p>Data Anggota dengan ID " . $rank. " sudah dihapus</p>";
    }
    // method membaca data anggota 
    function bacaDataAnggota($field, $rank) {
        $query = "SELECT * FROM anggota WHERE rank = '$rank'";
        $hasil = mysql_query($query);
        $data = mysql_fetch_array($hasil);
        if ($field == 'nama')
            return $data['nama'];
        else if ($field == 'kelas')
            return $data['kelas'];
        else if ($field == 'nilai')
            return $data['nilai'];
    }
    // method untuk proses update data anggota
    function updateDataAnggota($rank, $nama, $kelas, $nilai) {
        $query = "UPDATE anggota SET    nama='$nama', kelas ='$kelas', nilai='$nilai' WHERE rank='$rank'";
        mysql_query($query);
        echo "<p>Data Anggota sudah di update.</p>";
    }
}