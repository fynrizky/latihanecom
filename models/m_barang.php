<?php
/**
* 
*/
class Barang {//dalam sebuah kelas terdapat property dan method

	private $mysqli;//property	
	
	function __construct($koneksi) {
		$this->mysqli = $koneksi;
	}

	public function tampil($id = null) {// function itu method
		$db = $this->mysqli->koneksi;
		$sql = "SELECT * FROM barang INNER JOIN kategori ON barang.id_kategori = kategori.id_kategori";
		if ($id != null) {// jika id tidak sama dengan null/ jika id ada
			$sql .= " WHERE id_barang = $id"; // .= (menambah/merengkai dari variabel $sql)
		}
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	public function tambahbarang($id_kategori, $nm_brg, $hrg_brg, $stok, $gbr_brg){
		$db = $this->mysqli->koneksi;
		$db->query("INSERT INTO barang VALUES('', '$id_kategori', '$nm_brg', '$hrg_brg', '$stok', '$gbr_brg')") or die ($db->error);
	}
	
	public function edit($sql){
		$db = $this->mysqli->koneksi;
		$db->query($sql) or die ($db->error);
	}
	
	public function hapus($id){
		$db = $this->mysqli->koneksi;
		$db->query("DELETE FROM barang WHERE id_barang = '$id'") or die ($db->error);
	}
	
	function __destruct() {
		$db = $this->mysqli->koneksi;
		$db->close();
	}

}

?>