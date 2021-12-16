<?php

class KaryawanModel {
	
	private $table = 'karyawan';
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	public function getAllKaryawan()
	{
		$this->db->query("SELECT karyawan.*, jabatan.nama_jabatan FROM " . $this->table . " JOIN jabatan ON jabatan.id = karyawan.jabatan_id");
		return $this->db->resultSet();
	}

	public function getKaryawanById($id)
	{
		$this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
		$this->db->bind('id',$id);
		return $this->db->single();
	}

	public function tambahKaryawan($data)
	{
		$query = "INSERT INTO karyawan (nama, nip, email, th_masuk, jabatan_id, ttl) VALUES(:nama, :nip, :email, :th_masuk, :jabatan_id, :ttl)";
		$this->db->query($query);
		$this->db->bind('nama', $data['nama']);
		$this->db->bind('nip', $data['nip']);
		$this->db->bind('email', $data['email']);
		$this->db->bind('th_masuk', $data['th_masuk']);
		$this->db->bind('jabatan_id', $data['jabatan_id']);
		$this->db->bind('ttl', $data['ttl']);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function updateDataKaryawan($data)
	{
		$query = "UPDATE karyawan SET nama=:nama, nip=:nip, email=:email, th_masuk=:th_masuk, jabatan_id=:jabatan_id, ttl=:ttl WHERE id=:id";
		$this->db->query($query);
		$this->db->bind('id',$data['id']);
		$this->db->bind('nama', $data['nama']);
		$this->db->bind('nip', $data['nip']);
		$this->db->bind('email', $data['email']);
		$this->db->bind('th_masuk', $data['th_masuk']);
		$this->db->bind('jabatan_id', $data['jabatan_id']);
		$this->db->bind('ttl', $data['ttl']);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function deleteKaryawan($id)
	{
		$this->db->query('DELETE FROM ' . $this->table . ' WHERE id=:id');
		$this->db->bind('id',$id);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function cariKaryawan()
	{
		$key = $_POST['key'];
		$this->db->query("SELECT * FROM " . $this->table . " WHERE nama LIKE :key");
		$this->db->bind('key',"%$key%");
		return $this->db->resultSet();
	}
}