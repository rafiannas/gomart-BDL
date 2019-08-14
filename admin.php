<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cek_login();
	}


	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		//jumlah vendor
		$q_vendor = "SELECT COUNT(Vendor) as Jumlah
					FROM vendor_list";
		$data['vendor'] = $this->db->query($q_vendor)->row_array();
		//jumlah user
		$q_user = "SELECT COUNT(id) as Jumlah
					FROM user";
		$data['usr'] = $this->db->query($q_user)->row_array();
		//jumlah barang
		$q_barang = "SELECT COUNT(id_barang) as Jumlah
					FROM barang";
		$data['brg'] = $this->db->query($q_barang)->row_array();
		//jumlah transaksi
		$q_keranjang = "SELECT COUNT(id_keranjang) as Jumlah
					FROM keranjang";
		$data['krj'] = $this->db->query($q_keranjang)->row_array();

		$q_tr = "SELECT `keranjang`.*, `vendor`.`nama_vendor`,`vendor`.`kode_pos`,  `user`.`name`, `kurir`.`nama_kurir`
			   FROM `keranjang`, `user`,`vendor`,`kurir`
			   WHERE `keranjang`.`id_vendor` = `vendor`.`id_vendor` AND `keranjang`.`id_user` = `user`.`id` AND `keranjang`.`id_kurir` = `kurir`.`id`
			   ORDER BY `keranjang`.`tgl` DESC

		";
		$data['transaksi'] = $this->db->query($q_tr)->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/slidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function export()
	{
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		//jumlah vendor
		$q_vendor = "SELECT COUNT(Vendor) as Jumlah
					FROM vendor_list";
		$data['vendor'] = $this->db->query($q_vendor)->row_array();
		//jumlah user
		$q_user = "SELECT COUNT(id) as Jumlah
					FROM user";
		$data['usr'] = $this->db->query($q_user)->row_array();
		//jumlah barang
		$q_barang = "SELECT COUNT(id_barang) as Jumlah
					FROM barang";
		$data['brg'] = $this->db->query($q_barang)->row_array();
		//jumlah transaksi
		$q_keranjang = "SELECT COUNT(id_keranjang) as Jumlah
					FROM keranjang";
		$data['krj'] = $this->db->query($q_keranjang)->row_array();

		$q_tr = "SELECT `keranjang`.*, `vendor`.`nama_vendor`,`vendor`.`kode_pos`,  `user`.`name`, `kurir`.`nama_kurir`
			   FROM `keranjang`, `user`,`vendor`,`kurir`
			   WHERE `keranjang`.`id_vendor` = `vendor`.`id_vendor` AND `keranjang`.`id_user` = `user`.`id` AND `keranjang`.`id_kurir` = `kurir`.`id`

		";
		$data['transaksi'] = $this->db->query($q_tr)->result_array();

		var_dump($data['transaksi']);
		require(APPPATH . 'phpExcel/Classes/PHPExcel.php');
		require(APPPATH . 'phpExcel/Classes/PHPExcel/Writer/Excel2007.php');

		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()->setCreator("Gomart");
		$objPHPExcel->getProperties()->setLastModifiedBy("Gomart");
		$objPHPExcel->getProperties()->setTitle("Data Transaksi");
		$objPHPExcel->getProperties()->setSubject("");
		$objPHPExcel->getProperties()->setDescription("");

		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'No');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Lokasi Belanja');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Tanggal');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Pembeli');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Lokasi Pembeli');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Total Harga');
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Metode Pembayaran');
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Ongkir');
		$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Kurir');


		$baris = 2;
		$x = 1;
		foreach ($data['transaksi'] as $tr) {
			$objPHPExcel->getActiveSheet()->setCellValue('A' . $baris, $x);
			$objPHPExcel->getActiveSheet()->setCellValue('B' . $baris, $tr['nama_vendor']);
			$objPHPExcel->getActiveSheet()->setCellValue('C' . $baris, $tr['tgl']);
			$objPHPExcel->getActiveSheet()->setCellValue('D' . $baris, $tr['name']);
			$objPHPExcel->getActiveSheet()->setCellValue('E' . $baris, $tr['alamat_kirim']);
			$objPHPExcel->getActiveSheet()->setCellValue('F' . $baris, $tr['total_harga']);
			$objPHPExcel->getActiveSheet()->setCellValue('G' . $baris, $tr['met_pemb']);
			$objPHPExcel->getActiveSheet()->setCellValue('H' . $baris, $tr['ongkir']);
			$objPHPExcel->getActiveSheet()->setCellValue('I' . $baris, $tr['nama_kurir']);

			$x++;
			$baris++;
		}

		$filename = "Data-Transaksi" . date("d-m-Y-H-i-s") . '.xlsx';
		$objPHPExcel->getActiveSheet()->setTitle("Data Transaksi");

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age-0');

		$writer = PHPExcel_IOFactory::createWeiter($objPHPExcel, 'Excel2007');
		$writer->save('php://output');

		exit;
	}



	public function role()
	{
		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get('user_role')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/slidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role', $data);
		$this->load->view('templates/footer', $data);
	}

	public function report()
	{
		$data['title'] = 'Report';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['kategori'] = $this->db->query("SELECT id_kategori,nama_kategori FROM kategori")->result_array();

		$flag = ['flag' => 0];
		$this->session->set_userdata($flag);
		$data['s1'] =$this->session->userdata('flag');

		$flag2 = ['flag2' => 0];
		$this->session->set_userdata($flag2);
		$data['s2'] =$this->session->userdata('flag2');

		$flag3 = ['flag3' => 0];
		$this->session->set_userdata($flag3);
		$data['s3'] =$this->session->userdata('flag3');

		$flag4 = ['flag4' => 0];
		$this->session->set_userdata($flag4);
		$data['s4'] =$this->session->userdata('flag4');


		// $text = "SELECT YEAR(tgl) AS year FROM keranjang";
		// $ok = $this->db->query($text)->row_array();
		// var_dump($ok);
		// // echo $ok['year'];
		// foreach ($ok as $o) {
		// 	$oo = $o;
		// }
		// echo $oo;
		// echo $oo[1];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/slidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/report', $data);
		$this->load->view('templates/footer', $data);
	}
	public function nav1()
	{
		$data['title'] = 'Report';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['kategori'] = $this->db->query("SELECT nama_kategori, id_kategori FROM kategori")->result_array();


		$this->form_validation->set_rules('awal', 'Awal', 'required');
		$this->form_validation->set_rules('akhir', 'Akhir', 'required|trim');
		$this->form_validation->set_rules('kategori', 'Ktg', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/report', $data);
			$this->load->view('templates/footer', $data);
		} else {
			//$flag = ['flag' => 1];
			// $flag = "1";
			// $s1 = $this->session->set_userdata($flag);
			// $data['s1'] = $s1;
			$flag4 = ['flag4' => 1];
			$this->session->set_userdata($flag4);
			$data['s4'] =$this->session->userdata('flag4');

			$flag2 = ['flag2' => 0];
			$this->session->set_userdata($flag2);
			$data['s2'] =$this->session->userdata('flag2');

			$flag3 = ['flag3' => 0];
			$this->session->set_userdata($flag3);
			$data['s3'] =$this->session->userdata('flag3');

			$flag = ['flag' => 0];
			$this->session->set_userdata($flag);
			$data['s1'] =$this->session->userdata('flag');


			$awall = ($this->input->post('awal'));
			$akhirr = ($this->input->post('akhir'));
			$kat = htmlspecialchars($this->input->post('kategori'));

			// echo $awall;
			// echo "   " . $akhirr;
			$q_nav1 = "SELECT YEAR(keranjang.tgl) AS year,
					MONTH(keranjang.tgl) AS month,
					SUM(isi_keranjang.total_harga) AS total,
					COUNT(keranjang.id_keranjang) AS transaksi,
					SUM(keranjang.total_harga) AS toptrofik

					FROM keranjang,isi_keranjang, barang
					WHERE
					keranjang.id_keranjang = isi_keranjang.id_keranjang AND
					isi_keranjang.id_barang = barang.id_barang AND
					keranjang.tgl BETWEEN '$awall' AND '$akhirr' AND barang.id_kategori_barang = '$kat'

					GROUP BY
					YEAR(keranjang.tgl), MONTH(keranjang.tgl)
					ORDER BY YEAR(keranjang.tgl) DESC,
					MONTH(keranjang.tgl) DESC
		";
			$data['hasil1'] = $this->db->query($q_nav1)->result_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/report', $data);
			$this->load->view('templates/footer', $data);
			// echo $test;
			// $tg = $test[3] . $test[4];
			// $bln= $test[0] . $test[1];
			// $thn = $test[6] . $test[7].$test[8] . $test[9];



		}
	}

	public function nav2()
	{
		$data['title'] = 'Report';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('awal', 'Awal', 'required');
		$this->form_validation->set_rules('akhir', 'Akhir', 'required|trim');

		if ($this->form_validation->run() == false) {
			echo "hahaha";
		} else {
			$flag3 = ['flag3' => 1];
			$this->session->set_userdata($flag3);
			$data['s3'] =$this->session->userdata('flag3');


			$awall = ($this->input->post('awal'));
			$akhirr = ($this->input->post('akhir'));

			$q_nav2 = "SELECT YEAR(keranjang.tgl) AS year, MONTH(keranjang.tgl) AS month, nama_barang, COUNT(isi_keranjang.id_barang) AS jmh, nama_vendor
						FROM barang, isi_keranjang, keranjang, vendor
						WHERE barang.id_barang = isi_keranjang.id_barang AND keranjang.id_keranjang = isi_keranjang.id_keranjang AND keranjang.id_vendor = vendor.id_vendor
						AND keranjang.tgl BETWEEN '$awall' AND '$akhirr' 

						GROUP BY YEAR(keranjang.tgl), MONTH(keranjang.tgl)
						ORDER BY YEAR(keranjang.tgl),
						MONTH(keranjang.tgl),
						COUNT(isi_keranjang.id_barang) DESC
						";

			$data['hasil2'] = $this->db->query($q_nav2)->result_array();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/report', $data);
			$this->load->view('templates/footer', $data);
		}
	}

	public function nav3()
	{
		$data['title'] = 'Report';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('awal', 'Awal', 'required');
		$this->form_validation->set_rules('akhir', 'Akhir', 'required|trim');

		if ($this->form_validation->run() == false) {
			echo "hahaha";
		} else {
			$flag2 = ['flag2' => 1];
			$this->session->set_userdata($flag2);
			$data['s2'] =$this->session->userdata('flag2');


			$awall = ($this->input->post('awal'));
			$akhirr = ($this->input->post('akhir'));

			$q_nav3 = " SELECT YEAR(keranjang.tgl) AS year,  nama_vendor, COUNT(keranjang.id_keranjang) AS jmh, SUM(keranjang.total_harga) AS total
						FROM vendor, keranjang
						WHERE vendor.id_vendor = keranjang.id_vendor AND keranjang.tgl BETWEEN '$awall' AND '$akhirr'
						GROUP BY YEAR(keranjang.tgl) DESC
						";

			$data['hasil3'] = $this->db->query($q_nav3)->result_array();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/report', $data);
			$this->load->view('templates/footer', $data);
	}

}

public function nav4()
	{
		$data['title'] = 'Report';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('awal', 'Awal', 'required');
		$this->form_validation->set_rules('akhir', 'Akhir', 'required|trim');

		if ($this->form_validation->run() == false) {
			echo "hahaha";
		} else {

			$flag = ['flag' => 1];
			$this->session->set_userdata($flag);
			$data['s1'] =$this->session->userdata('flag');

			$awall = ($this->input->post('awal'));
			$akhirr = ($this->input->post('akhir'));

			$q_nav4 = " SELECT YEAR(keranjang.tgl) AS year, user.name, SUM(keranjang.total_harga) AS total_belanja, COUNT(keranjang.id_user) AS jmh
						FROM keranjang, user
						WHERE keranjang.id_user = user.id AND keranjang.tgl BETWEEN '$awall' AND '$akhirr'
						GROUP BY YEAR(keranjang.tgl) DESC
						";

			$data['hasil4'] = $this->db->query($q_nav4)->result_array();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/report', $data);
			$this->load->view('templates/footer', $data);
	}

}

	//############################################	HAPUS
	public function hapus_vendor($id_vendor)
	{
		$this->db->where('id_vendor', $id_vendor);
		$this->db->delete('vendor');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success delete vendor</div>');
		redirect('admin/vendor');
	}
	public function hapus_kategori($id_kategori)
	{
		$this->db->where('id_kategori', $id_kategori);
		$this->db->delete('kategori');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success delete kategori</div>');
		redirect('admin/kategori');
	}

	public function hapus_user($id_user)
	{
		$this->db->where('id', $id_user);
		$this->db->delete('user');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success delete user</div>');
		redirect('admin/list_user');
	}
	public function hapus_admin($id_user)
	{
		$this->db->where('id', $id_user);
		$this->db->delete('user');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success delete admin</div>');
		redirect('admin/list_admin');
	}

	public function hapus_barang($id_barang)
	{
		$this->db->where('id_barang', $id_barang);
		$this->db->delete('barang');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success delete Item</div>');
		redirect('admin/kategori_barang');
	}
	///#########################################################
	public function edit_vendor($id_vendor)
	{

		$data['title'] = 'Edit Vendor';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$query_edit = "SELECT * FROM kode_area";
		$data['edit'] = $this->db->query($query_edit)->result_array();
		$query_jenis = "SELECT * FROM vendor_list";
		$data['jenis_vendor'] = $this->db->query($query_jenis)->result_array();

		$data['vendorC'] = $this->db->get_where('vendor', ['id_vendor' => $id_vendor])->row_array();

		//$this->form_validation->set_rules('jenis_vendor', 'JV','required|trim');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
		$this->form_validation->set_rules('kp', 'Kp', 'required|trim');
		$this->form_validation->set_rules('owner', 'Owner', 'required|trim');
		$this->form_validation->set_rules('phone', 'Phone', 'required|trim');


		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/edit_vendor', $data);
			$this->load->view('templates/footer', $data);
		} else {
			//cek jika ada gambar
			//$temp_pos=$this->input->post('kp');
			$q_pos = $this->db->get_where('kode_area', ['kode_pos' => $this->input->post('kp')])->row_array();

			$q_venlis = $this->db->get_where('vendor_list', ['Vendor' => $this->input->post('jenis_vendor')])->row_array();

			$data2 = [
				//"Id_vendor_list" => $q_venlis['Id_Vendor_List'],
				"nama_vendor" => $this->input->post('nama', true),
				"alamat" => $this->input->post('alamat', true),
				"kode_pos" => $this->input->post('kp'),
				"kode_area" => $q_pos['kode_area'],
				"nama_kontak" => $this->input->post('owner', true),
				"nomor_kontak" => $this->input->post('phone', true)
			];

			$this->db->where('id_vendor', $id_vendor);
			$this->db->update('vendor', $data2);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Vendor has been updated</div>');
			redirect('admin/vendor');
		}
	}


	public function roleaccess($role_id)


	{
		$data['title'] = 'Role Access';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

		$this->db->where('id !=', 1);

		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/slidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role-access', $data);
		$this->load->view('templates/footer', $data);
	}

	public function changeaccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu', $data);

		if ($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Change!</div>');
	}


	public function vendor()
	{

		$data['title'] = 'Daftar Vendor';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


		$cari = $this->input->post('cari');

		$query = "SELECT `vendor`.*, `vendor_list`.* 
				FROM `vendor` JOIN `vendor_list`
				ON `vendor`.`Id_vendor_list` = `vendor_list`.`Id_Vendor_List`
				WHERE `nama_vendor` LIKE '%$cari%'
		OR `alamat` LIKE '%$cari%' OR `kode_pos` LIKE '%$cari%'
		";

		$data['kode_pos'] = $this->db->query("SELECT * FROM kode_area")->result_array();

		$data['vendor'] = $this->db->query($query)->result_array();


		$this->form_validation->set_rules('cari', 'Cari');

		$this->load->model('menu_model', 'pilih');
		$data['pilih'] = $this->db->query("SELECT * FROM vendor_list")->result_array();

		$this->form_validation->set_rules('menu_id', 'menu_id', 'required');
		$this->form_validation->set_rules('name', 'nama_vendor', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('pos', 'kode_pos', 'required');
		//$this->form_validation->set_rules('area', 'kode_area','required');
		$this->form_validation->set_rules('pemilik', 'nama_kontak', 'required');
		$this->form_validation->set_rules('no_kontak', 'nomor_kontak', 'required');
		//$this->form_validation->set_rules('logo', 'logo','required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/vendor', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$q_area = $this->db->get_where('kode_area', ['kode_pos' => $this->input->post('pos')])->row_array();

			$branch = $this->input->post('menu_id');
			$br = "SELECT Vendor FROM vendor_list WHERE id_vendor_list=$branch";
			$data['ok'] = $this->db->query($query)->result_array();

			$upload = $_FILES['image']['name'];
			if ($upload) {
				$config['allowed_types'] = 'jpg|png';
				$config['max_size']     = '1024';
				$config['upload_path'] = './assets/img/img/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {

					$new_image = $this->upload->data('file_name');
					//$this->db->set('photo',$new_image);

				} else {
					echo $this->upload->display_error();
				}
			}

			$data = [
				'id_vendor_list' => $this->input->post('menu_id'),
				'nama_vendor' => $ok['Vendor'] . $this->input->post('name'),
				'alamat' => $this->input->post('alamat'),
				'kode_pos' => $this->input->post('pos'),
				'kode_area' => $q_area['kode_area'],
				'nama_kontak' => $this->input->post('pemilik'),
				'nomor_kontak' => $this->input->post('no_kontak'),
				//'logo' => $this->input->post('logo')
				'logo' => $new_image

			];
			$this->db->insert('vendor', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Vendor Added</div>');
			redirect('admin/vendor');
		}
	}

	public function list_vendor()
	{

		$data['title'] = 'Daftar Vendor';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		// $cari=$this->input->post('cari');

		// $query="SELECT * FROM vendor WHERE nama_vendor LIKE '%$cari%'
		// OR alamat LIKE '%$cari%' OR kode_pos LIKE '%$cari%'";
		$qr = "SELECT * FROM vendor_list";
		$data['vendor'] = $this->db->query($qr)->result_array();

		//$this->form_validation->set_rules('vendor', 'Vendor');
		//$this->form_validation->set_rules('cari','Cari');
		//$query= "SELECT * FROM `vendor`";

		//$data['vendor'] = $this->db->query($query)->result_array();

		//	$data['list'] = $this->db->get('vendor_list')->result_array();

		$this->form_validation->set_rules('name', 'nama_vendor', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('pos', 'kode_pos', 'required');
		$this->form_validation->set_rules('area', 'kode_area', 'required');
		$this->form_validation->set_rules('pemilik', 'nama_kontak', 'required');
		$this->form_validation->set_rules('no_kontak', 'nomor_kontak', 'required');
		$this->form_validation->set_rules('logo', 'logo', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/list_vendor', $data);
			$this->load->view('templates/footer', $data);
		} else {

			// $cari=$this->input->post('cari');
			//$query= "SELECT * FROM vendor WHERE nama_vendor='$cari'";

			// $data['vendor'] = $this->db->get_where('vendor', ['nama_vendor' => $cari])->row_array();
			//redirect('admin/temp');

			$data = [
				'nama_vendor' => $this->input->post('name'),
				'alamat' => $this->input->post('alamat'),
				'kode_pos' => $this->input->post('pos'),
				'kode_area' => $this->input->post('area'),
				'nama_kontak' => $this->input->post('pemilik'),
				'nomor_kontak' => $this->input->post('no_kontak'),
				'logo' => $this->input->post('logo')

			];
			$this->db->insert('vendor', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Vendor Added</div>');
			redirect('admin/vendor');
		}
	}
	public function before($id)
	{
		$data['info'] = $this->db->get_where('vendor', ['id_vendor' => $id])->row_array();
		$id_ve = ['id_ve' => $id];
		$this->session->set_userdata($id_ve);
		redirect('admin/kategori');
	}

	public function kategori()
	{
		//$data['info']= $this->db->get_where('vendor', ['id_vendor' => $info])->row_array();

		$data['info'] = $this->db->get_where('vendor', ['id_vendor' => $this->session->userdata('id_ve')])->row_array();

		$data['title'] = 'Daftar Kategori';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		// $id_ve= ['id_ve' => $info];
		// $this->session->set_userdata($id_ve);

		echo $this->session->userdata('id_vendor');
		$query = "SELECT * FROM `kategori`";

		$data['kategori'] = $this->db->query($query)->result_array();

		$data['kategori'] = $this->db->get('kategori')->result_array();


		$this->form_validation->set_rules('name', 'nama_kategori', 'required');
		// $this->form_validation->set_rules('url', 'url','required');
		$this->form_validation->set_rules('image', 'image', 'required');


		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data,);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/kategori', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$data = [
				'nama_kategori' => $this->input->post('name'),
				// 'url' => $lothis->input->post('url'),
				'image' => $this->input->post('image')

			];
			$this->db->insert('kategori', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Category Added</div>');
			redirect('admin/kategori');
		}
	}
	public function before_barang($id_kategori)
	{

		$id_kat = ['id_kat' => $id_kategori];
		$this->session->set_userdata($id_kat);
		redirect('admin/kategori_barang');
	}

	public function kategori_barang()
	{
		$data['inf'] = $this->db->get_where('vendor', ['id_vendor' => $this->session->userdata('id_ve')])->row_array();

		$id_kat = $this->session->userdata('id_kat');
		$data['title'] = 'Daftar Makanan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$list = $data['inf']['Id_vendor_list'];

		$query = "SELECT *
				 FROM `barang`JOIN `vendor_list`
				 ON `barang`.`id_vendor_list` = `vendor_list`.`Id_Vendor_List`
				 WHERE `id_kategori_barang`= $id_kat AND `barang`.`id_vendor_list`= $list 
		";

		$data['makanan'] = $this->db->query($query)->result_array();

		$this->form_validation->set_rules('name', 'nama_barang', 'required');
		$this->form_validation->set_rules('harga', 'harga_barang', 'required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');
		$this->form_validation->set_rules('stok', 'stok', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/kategori_barang', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$upload = $_FILES['image']['name'];
			if ($upload) {
				$config['allowed_types'] = 'jpg|png';
				$config['max_size']     = '1024';
				$config['upload_path'] = './assets/img/barang/all/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$old_image = $data['makanan']['image'];
					if ($old_image != 'default.png') {
						unlink(FCPATH . 'assets/img/barang/all' . $old_image);
					}


					$new_image = $this->upload->data('file_name');
					//$this->db->set('photo',$new_image);

				} else {
					echo $this->upload->display_error();
				}
			}


			$data = [
				'nama_barang' => $this->input->post('name'),
				'harga_barang' => $this->input->post('harga'),
				'deskripsi' => $this->input->post('deskripsi'),
				'stok' => $this->input->post('stok'),
				'id_vendor_list' => $list,
				'id_kategori_barang' => $id_kat,
				'image' => $new_image


			];
			$this->db->insert('barang', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success add item</div>');
			redirect('admin/kategori_barang');
		}
	}



	public function list_user()
	{
		$data['title'] = 'List User';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['usr'] = $this->db->get_where('user', ['role_id' => 2])->result_array();

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('phone', 'Phone Number', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'Email has been registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
			'matches' => 'password dont match! ',
			'min_length' => 'password too short!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/list_user', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$data = [
				'name' => $this->input->post('name', true),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'phone_number' => $this->input->post('phone'),
				'role_id' => 2,
				'is_active' => 1,
				'date_created' => time(),
				'photo' => 'default.png'
			];
			$this->db->insert('user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Add User</div>');
			redirect('admin/list_user');
		}
	}


	public function edit_user($id_user)
	{
		$data['title'] = "Edit User";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['usr'] = $this->db->get_where('user', ['id' => $id_user])->row_array();

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');

		$this->form_validation->set_rules('phone', 'Phone', 'required|trim');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]', [
			'min_length' => 'password too short!'
		]);



		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/edit_user', $data);
			$this->load->view('templates/footer', $data);
		} else {

			$data2 = [

				"name" => htmlspecialchars($this->input->post('nama', true)),
				"password" => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				"phone_number" => htmlspecialchars($this->input->post('phone', true))
			];

			$this->db->where('id', $id_user);
			$this->db->update('user', $data2);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User has been updated</div>');
			redirect('admin/list_user');
		}
	}

	public function list_admin()
	{
		$data['title'] = 'List Admin';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['admin'] = $this->db->get_where('user', ['role_id' => 1])->result_array();

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('phone', 'Phone Number', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'Email has been registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
			'matches' => 'password dont match! ',
			'min_length' => 'password too short!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/list_admin', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$data = [
				'name' => $this->input->post('name', true),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'phone_number' => $this->input->post('phone'),
				'role_id' => 1,
				'is_active' => 1,
				'date_created' => time(),
				'photo' => 'default.png'
			];
			$this->db->insert('user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Add Admon</div>');
			redirect('admin/list_admin');
		}
	}

	public function edit_kategori($id)
	{
		$data['title'] = "Edit Kategori";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['kategori'] = $this->db->get_where('kategori', ['id_kategori' => $id])->row_array();
		$data['vendor'] = $this->db->get_where('vendor', ['id_vendor' => $this->session->userdata('id_ve')])->row_array();

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/edit_kategori', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$upload = $_FILES['image']['name'];

			if ($upload) {
				$config['allowed_types'] = 'jpg|png';
				$config['max_size']     = '1024';
				// $config['max_width'] 	= '1024';
				// $config['max_height'] 	= '768';
				$config['upload_path'] = './assets/img/kategori/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$old_image = $data['kategori']['image'];
					if ($old_image != 'default.png') {
						unlink(FCPATH . 'assets/img/kategori/' . $old_image);
					}


					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					echo $this->upload->display_error();
				}
			}

			$data2 = [
				//"Id_vendor_list" => $q_venlis['Id_Vendor_List'],
				"nama_kategori" => $this->input->post('nama', true)
			];

			$this->db->where('id_kategori', $id);
			$this->db->update('kategori', $data2);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kategori has been updated</div>');
			redirect('admin/kategori');
		}
	}

	public function edit_barang($id)
	{
		$data['title'] = "Edit Item";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['barang'] = $this->db->get_where('barang', ['id_barang' => $id])->row_array();
		$data['vendor'] = $this->db->get_where('vendor', ['id_vendor' => $this->session->userdata('id_ve')])->row_array();

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('harga', 'Harga', 'required|trim');
		$this->form_validation->set_rules('deskripsi', 'Desk', 'required|trim');
		$this->form_validation->set_rules('stok', 'Stok', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/edit_barang', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$upload = $_FILES['image']['name'];

			if ($upload) {
				$config['allowed_types'] = 'jpg|png';
				$config['max_size']     = '1024';
				// $config['max_width'] 	= '1024';
				// $config['max_height'] 	= '768';
				$config['upload_path'] = './assets/img/kategori/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$old_image = $data['kategori']['image'];
					if ($old_image != 'default.png') {
						unlink(FCPATH . 'assets/img/kategori/' . $old_image);
					}


					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					echo $this->upload->display_error();
				}
			}

			$data2 = [
				//"Id_vendor_list" => $q_venlis['Id_Vendor_List'],
				"nama_barang" => $this->input->post('nama', true),
				"harga_barang" => $this->input->post('harga', true),
				"deskripsi" => $this->input->post('deskripsi', true),
				"stok" => $this->input->post('stok', true)
			];

			$this->db->where('id_barang', $id);
			$this->db->update('barang', $data2);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Item has been updated</div>');
			redirect('admin/kategori_barang');
		}
	}

	public function list_kurir()
	{
		$data['title'] = "List Kurir";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['kurir'] = $this->db->get('kurir')->result_array();

		$query = "SELECT DISTINCT kode_area
			 FROM kode_area";
		$data['kode'] = $this->db->query($query)->result_array();

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('plat', 'Plat', 'required|trim');
		$this->form_validation->set_rules('kode_t', 'Kode', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/list_kurir', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$upload = $_FILES['image']['name'];
			if ($upload) {
				$config['allowed_types'] = 'jpg|png';
				$config['max_size']     = '1024';
				$config['upload_path'] = './assets/img/kurir/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$old_image = $data['makanan']['image'];
					if ($old_image != 'default.png') {
						unlink(FCPATH . 'assets/img/kurir' . $old_image);
					}


					$new_image = $this->upload->data('file_name');
					//$this->db->set('photo',$new_image);

				} else {
					echo $this->upload->display_error();
				}
			}

			$data = [
				'plat_nomor' => $this->input->post('plat'),
				'nama_kurir' => $this->input->post('nama'),
				'kode_tugas' => $this->input->post('kode_t'),
				'foto' => $new_image

			];
			$this->db->insert('kurir', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Add Kurir</div>');
			redirect('admin/list_kurir');
		}
	}
	public function exportE(){
        // $id=$this->uri->segment(3);
        // $this->load->model('m_user');
        // $mhs=$this->m_user->edit_sesi($id);
        // foreach($mhs->result() as $m):
        //     $nama_sesi=$m->nama_sesi;
        //     $nama_blok=$m->nama_blok;
        //     $tgl=$m->tgl;
        // endforeach;

        $nilai=$this->m_user->lihat_nilai_sesi($id);
        $heading=array('No','NIM','Mahasiswa','Benar','Salah','Nilai');
        $this->load->library('PHPExcel');
        //Create a new Object
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle($nama_sesi);
        //Loop Heading
        $rowNumberH = 1;
        $colH = 'A';
        foreach($heading as $h){
            $objPHPExcel->getActiveSheet()->setCellValue($colH.$rowNumberH,$h);
            $colH++;    
        }
        //Loop Result
        $totn=$nilai->num_rows();
        $no=1;
        for($i=2;$i<=$totn+1;$i++){
            foreach($nilai->result() as $n):
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,$no);
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$n->nim);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$i,$n->nama);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,$n->benar);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,$n->salah);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,$n->nilai);
            endforeach;
            $no++;
        }
        //Freeze pane
        $objPHPExcel->getActiveSheet()->freezePane('A2');
        //Save as an Excel BIFF (xls) file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Nilai-'.$nama_sesi.'-'.$nama_blok.'-'.$tgl.'.xls"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');
        exit();
    }
}
