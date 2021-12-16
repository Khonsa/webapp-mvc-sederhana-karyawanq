<?php

class Karyawan extends Controller {
	
	public function __construct()
	{	
		if($_SESSION['session_login'] != 'sudah_login') {
			Flasher::setMessage('Login','Tidak ditemukan.','danger');
			header('location: '. base_url . '/login');
			exit;
		}
	}
	
	public function index()
	{
		$data['title'] = 'Data Karyawan';
		$data['karyawan'] = $this->model('KaryawanModel')->getAllKaryawan();
		$this->view('templates/header', $data);
		$this->view('templates/sidebar', $data);
		$this->view('karyawan/index', $data);
		$this->view('templates/Footer');
	}
	public function lihatlaporan()
	{
		$data['title'] = 'Daftar Data Karyawan';
		$data['karyawan'] = $this->model('KaryawanModel')->getAllKaryawan();
		$this->view('karyawan/lihatlaporan', $data);
	}

	public function laporan()
	{
		$data['karyawan'] = $this->model('KaryawanModel')->getAllKaryawan();

			$pdf = new FPDF('p','mm','A4');
			// membuat halaman baru
			$pdf->AddPage();
			// setting jenis font yang akan digunakan
			$pdf->SetFont('Arial','B',14);
			// mencetak string 
			$pdf->Cell(190,7,'DAFTAR DATA KARYAWAN',0,1,'C');
			 
			// Memberikan space kebawah agar tidak terlalu rapat
			$pdf->Cell(10,7,'',0,1);
			 
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(50,6,'NAMA KARYAWAN',1);
			$pdf->Cell(30,6,'NIP',1);
			$pdf->Cell(40,6,'E-MAIL',1);
			$pdf->Cell(30,6,'TAHUN MASUK',1);
			$pdf->Cell(25,6,'JABATAN',1);
			  $pdf->Ln();
			$pdf->SetFont('Arial','',10);
			 
			foreach($data['karyawan'] as $row) {
			    $pdf->Cell(50,6,$row['nama'],1);
			    $pdf->Cell(30,6,$row['nip'],1);
			    $pdf->Cell(40,6,$row['email'],1);
			    $pdf->Cell(30,6,$row['th_masuk'],1); 
			    $pdf->Cell(25,6,$row['nama_jabatan'],1);
			    $pdf->Ln(); 
			}
			
			$pdf->Output('D', 'Daftar data karyawan.pdf', true);

	}
	public function cari()
	{
		$data['title'] = 'Daftar data karyawan';
		$data['karyawan'] = $this->model('KaryawanModel')->cariKaryawan();
		$data['key'] = $_POST['key'];
		$this->view('templates/header', $data);
		$this->view('templates/sidebar', $data);
		$this->view('karyawan/index', $data);
		$this->view('templates/Footer');
	}

	public function edit($id){

		$data['title'] = 'Detail Karyawan';
		$data['jabatan'] = $this->model('JabatanModel')->getAllJabatan();
		$data['karyawan'] = $this->model('KaryawanModel')->getKaryawanById($id);
		$this->view('templates/header', $data);
		$this->view('templates/sidebar', $data);
		$this->view('karyawan/edit', $data);
		$this->view('templates/Footer');
	}

	public function tambah(){
		$data['title'] = 'Tambah Karyawan';		
		$data['jabatan'] = $this->model('JabatanModel')->getAllJabatan();		
		$this->view('templates/header', $data);
		$this->view('templates/sidebar', $data);
		$this->view('karyawan/create', $data);
		$this->view('templates/Footer');
	}

	public function simpanKaryawan(){		

		if( $this->model('KaryawanModel')->tambahKaryawan($_POST) > 0 ) {
			Flasher::setMessage('Berhasil','ditambahkan','success');
			header('location: '. base_url . '/karyawan');
			exit;			
		}else{
			Flasher::setMessage('Gagal','ditambahkan','danger');
			header('location: '. base_url . '/karyawan');
			exit;	
		}
	}

	public function updateKaryawan(){	
		if( $this->model('KaryawanModel')->updateDataKaryawan($_POST) > 0 ) {
			Flasher::setMessage('Berhasil','diupdate','success');
			header('location: '. base_url . '/karyawan');
			exit;			
		}else{
			Flasher::setMessage('Gagal','diupdate','danger');
			header('location: '. base_url . '/karyawan');
			exit;	
		}
	}

	public function hapus($id){
		if( $this->model('KaryawanModel')->deleteKaryawan($id) > 0 ) {
			Flasher::setMessage('Berhasil','dihapus','success');
			header('location: '. base_url . '/karyawan');
			exit;			
		}else{
			Flasher::setMessage('Gagal','dihapus','danger');
			header('location: '. base_url . '/karyawan');
			exit;	
		}
	}
}