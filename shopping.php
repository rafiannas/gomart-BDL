<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class shopping extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		cek_login();
	}

	public function index()
	{
			$data['title']= 'Shopping';
			$data['user']= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

			$alamat_skrg=$this->input->post('alamat');
				$addr= ['addr' => $alamat_skrg];
				$this->session->set_userdata($addr);

			$loc=$this->input->post('location');

			$data['loc']= $loc;
			$data['ad'] = $alamat_skrg;
			$lokasi= ['lokasi' => $loc];
			$this->session->set_userdata($lokasi);

			$data['query1']=$this->db->get_where('kode_area', ['kode_pos' => $loc])->row_array();
			//var_dump($data['query1']);
			$kode= $data['query1']['kode_area'];


			$data["vendor"] =$this->db->get_where('vendor',['kode_area' => $kode])->result_array();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('shopping/vendor', $data);
			$this->load->view('templates/footer', $data);
		
	}
			

	public function C1_10510($id)
	{
	
		$id_ve= ['id_ve' => $id];
		$this->session->set_userdata($id_ve);

		$data['title']= 'Shopping';
		$data['user']= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['vendor']= $this->db->get_where('vendor', ['id_vendor' => $id])->row_array();

		$data["kategori"]=$this->db->get('kategori')->result_array(); 
		
		date_default_timezone_set('Asia/Jakarta');
		$tgl=date('Y-m-d h:i:s');// tgl

		$id_vnd=$this->session->userdata('id_vnd');




			$buat_keranjang = [
				'id_vendor' => $id,
				'id_user' => $data['user']['id'],
				'tgl' =>$tgl,
				'status_bayar' => 'PENDING'
		];
			$this->db->insert('keranjang', $buat_keranjang);

		$id_user=$data['user']['id'];
		$ambil_keranjang= "SELECT * FROM keranjang WHERE id_user = $id_user AND status_bayar = 'PENDING' ";
		$data['keranjang']= $this->db->query($ambil_keranjang)->row_array();
	
		//var_dump($data['keranjang']);
		$ID= $data['keranjang']['id_keranjang'];
		$VE=$data['keranjang']['id_vendor'];
		$id_ker=['id_ker' =>$ID, 'id_vnd' => $VE];
		$this->session->set_userdata($id_ker);


			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('shopping/C1_10510', $data);
			$this->load->view('templates/footer', $data);
	}
	

	public function before($id_kat)
	{
		
		$id_kate= ['id_kate' => $id_kat];
		$this->session->set_userdata($id_kate);
		redirect('shopping/barang');
	}


	public function barang()
	{

		$data['inf']= $this->db->get_where('vendor',['id_vendor' => $this->session->userdata('id_ve')] )->row_array();



		$data['title']= $this->db->get_where('kategori',['id_kategori' => $this->session->userdata('id_kate')])->row_array();

		$id_kateg=$data['title']['id_kategori'];
		//echo "$id_kateg";

		$data['user']= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		$list= $data['inf']['Id_vendor_list'];
		
		$query= "SELECT *
				 FROM `barang`JOIN `vendor_list`
				 ON `barang`.`id_vendor_list` = `vendor_list`.`Id_Vendor_List`
				 WHERE `id_kategori_barang`= $id_kateg AND `barang`.`id_vendor_list`= $list
		";

		$data['barang'] = $this->db->query($query)->result_array();
		
		$this->form_validation->set_rules('qty','Qty','required|trim|integer');
		if ($this->form_validation->run() == false)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('shopping/kategori/barang_qty', $data);
			$this->load->view('templates/footer', $data);
		}
		else
		{	

			$data['brg']= $this->db->get_where('barang', ['id_barang' =>  $this->input->post('id_b')])->row_array();

			$q=$this->input->post('qty');
			$vendor=$data['inf']['id_vendor'];
			$user=$data['user']['id'];
			$id_brg=$this->input->post('id_b');
			$id_kr=$this->session->userdata('id_ker');
			echo $id_kr;
			echo "haha";
			echo $id_brg;
			// $cek="SELECT * FROM isi_keranjang WHERE id_keranjang = $id_kr AND id_barang = $id_brg";
		
			$cek_keranjang = $this->db->get_where('isi_keranjang', ['id_keranjang' => $id_kr, 'id_barang' => $id_brg])->row_array();
			var_dump($cek_keranjang);
				
			if($cek_keranjang)
			{
				$isi=[
				
				'jumlah_barang' => $q+$cek_keranjang['jumlah_barang'],
				'harga_barang' => $data['brg']['harga_barang'],
				'total_harga' => ($q*$data['brg']['harga_barang'])+$cek_keranjang['total_harga'],
				'status_barang' => 'READY'
			];
				$id_isi_ker=$cek_keranjang['id_isi_keranjang'];
				$cek_keranjang['id_barang'];
				echo "kikikiki";
				echo $id_isi_ker;
				$this->db->where('id_isi_keranjnag', $id_isi_ker);
				$this->db->update('isi_keranjang', $isi);	
			}
			else
			{
				$isi=[
				'id_keranjang' => $this->session->userdata('id_ker'),
				'id_barang' => $this->input->post('id_b'),
				'jumlah_barang' => $q,
				'harga_barang' => $data['brg']['harga_barang'],
				'total_harga' => $q*$data['brg']['harga_barang'],
				'status_barang' => 'READY'
			];
			$this->db->insert('isi_keranjang', $isi);


			}

			
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan barang</div>');
				redirect('shopping/barang');

		}	
	}

	public function buy_qty($id_barang)
	{


		$data['user']= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['barang']=$this->db->get_where('barang',['id_barang' => $id_barang])->row_array();
		
		$data['vendor']= $this->db->get_where('vendor', $this->session->userdata('id_v'))->row_array();

		$lok=$this->session->userdata('lokasi'); //session lokasi
		$keranjang=$this->session->userdata('id_ker');
		if ( $lok == $data['vendor']['kode_pos'])
		{
			$ongkos= 5000;
		}
		else
		{
			$ongkos= 10000;
		}

		date_default_timezone_set('Asia/Jakarta');
 		$tgl=date('Y-m-d');// tgl
 		

		$q_keranjang=[
			'id_vendor' => $this->session->userdata('id_v'),
			'tgl' => $tgl,
			'id_user' => $data['user']['id'],
			'status_bayar' => 'Pending',
			'ongkir' => $ongkos
		];
		$this->db->insert('keranjang', $q_keranjang);


		$q=$this->input->post('qty');
		$query=[
			'id_barang'=> $data['barang']['id_barang'],
			'id_vendor' => $this->session->userdata('id_v'),
			'id_user' => $data['user']['id'],
			'jumlah_barang' => $q,
			'harga_barang' => $data['barang']['harga_barang'],
			'total_harga' => $data['barang']['harga_barang'],
			'status_barang' => 'Ready'
		];
		$this->db->insert('isi_keranjang', $query);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan barang</div>');
            redirect('shopping/barang');
	}



	

	public function basket()
	{
		$keranjang=$this->session->userdata('id_ker');	
		$data['title']= 'Basket List';
		$data['user']= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


		$query=
				"SELECT *
				 FROM `keranjang` JOIN `isi_keranjang` ON `keranjang`.`id_keranjang` = `isi_keranjang`.`id_keranjang`
				JOIN `BARANG` ON `isi_keranjang`.`id_barang`= `barang`.`id_barang`
				WHERE `keranjang`.`id_keranjang`= $keranjang;
				";

				

		$data["basket"]=$this->db->query($query)->result_array();

		// var_dump($data['basket']);
		// 
			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('shopping/basket', $data);
			$this->load->view('templates/footer', $data);
		
	}


	public function plus_barang($id)
	{
		$keranjang=$this->session->userdata('id_ker');

		$query="SELECT * FROM isi_keranjang WHERE id_barang = $id AND id_keranjang = $keranjang";

		$data['brg']= $this->db->query($query)->row_array();
		$h1=$data['brg']['harga_barang'];
		var_dump($data['brg']);

		$id_isi_ker= $data['brg']['id_isi_keranjang'];
		// echo $id_isi_ker;

		$jmh=$data['brg']['jumlah_barang']+1;
		// echo $jmh;

		$harga=$data['brg']['total_harga']+$h1;
		// echo $harga;

		$data=[
				'jumlah_barang' => $jmh,
				'total_harga' => $harga 
		];

		$this->db->where('id_isi_keranjang', $id_isi_ker);
		$this->db->update('isi_keranjang', $data);
		redirect('shopping/basket');
	}

	public function minus_barang($id)
	{
		$keranjang=$this->session->userdata('id_ker');

		$query="SELECT * FROM isi_keranjang WHERE id_barang = $id AND id_keranjang = $keranjang";

		$data['brg']= $this->db->query($query)->row_array();
		$h1=$data['brg']['harga_barang'];
		var_dump($data['brg']);

		$id_isi_ker= $data['brg']['id_isi_keranjang'];
		// echo $id_isi_ker;

		$jmh=$data['brg']['jumlah_barang']-1;
		// echo $jmh;

		$harga=$data['brg']['total_harga']-$h1;
		// echo $harga;

		$data=[
				'jumlah_barang' => $jmh,
				'total_harga' => $harga 
		];

		$this->db->where('id_isi_keranjang', $id_isi_ker);
		$this->db->update('isi_keranjang', $data);
		redirect('shopping/basket');
	}
		public function hapus_barang($id)
	{
		$this->db->where('id_isi_keranjang', $id);
		$this->db->delete('isi_keranjang');

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Success delete Item</div>');
		redirect('shopping/basket');
	}

	public function before2($harga)
	{
		$data2=[
					'total_harga' => $harga
			];

			$keranjang=$this->session->userdata('id_ker');

			$this->db->where('id_keranjang', $keranjang);
			$this->db->update('keranjang', $data2);
		
		$hrg= ['hrg' => $harga];
		$this->session->set_userdata($hrg);
		redirect('shopping/checkout');
	}

	public function checkout()
	{

		$lok=$this->session->userdata('lokasi'); //session lokasi
		

		$data['vendor']= $this->db->get_where('vendor',['id_vendor' => $this->session->userdata('id_ve')] )->row_array();

		// var_dump($data['vendor']);
		if ($lok == $data['vendor']['kode_pos'])
		{
			$data['ongkir']= 5000;
		}
		else
		{
			$data['ongkir']= 10000;
		}

		$data2=[
					'ongkir' => $data['ongkir']
			];

			$keranjang=$this->session->userdata('id_ker');

			$this->db->where('id_keranjang', $keranjang);
			$this->db->update('keranjang', $data2);


		$data['title']= 'Checkout';
		$data['user']= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$query="SELECT `isi_keranjang`.*, `barang`.`nama_barang`
				FROM `barang` JOIN `isi_keranjang` 
				ON `isi_keranjang`.`id_barang` = `barang`.`id_barang`
				WHERE `isi_keranjang`.`id_keranjang` = $keranjang
				";		

		$data["basket"]=$this->db->query($query)->result_array();
		$data['harga']=$this->session->userdata('hrg');
		$keranjang=$this->session->userdata('id_ker');
		
	
        if ( $this->form_validation->run() == false )
        {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('shopping/checkout', $data);
			$this->load->view('templates/footer', $data);
		}
		else
		{
			echo ($this->input->post('met'));
		}


	}
	public function before3($harga)
	{
		
		$total= ['total' => $harga];
		$this->session->set_userdata($total);
		redirect('shopping/konfirmasi');
	}
	public function konfirmasi()
	{	
		$data['address']=$this->session->userdata('addr');
		$data['lok']=$this->session->userdata('lokasi'); //session lokasi
		$ven=$this->session->userdata('id_ve');
		$keranjang=$this->session->userdata('id_ker');

		$data['title']= 'Konfirmasi';
		$data['user']= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$query="SELECT `isi_keranjang`.*, `barang`.`nama_barang`
				FROM `barang` JOIN `isi_keranjang` 
				ON `isi_keranjang`.`id_barang` = `barang`.`id_barang`
				WHERE `isi_keranjang`.`id_keranjang` = $keranjang
				";		

		$data["basket"]=$this->db->query($query)->result_array();
		$data['harga']=$this->session->userdata('total');
		$keranjang=$this->session->userdata('id_ker');
		
		$query_vendor="SELECT *
				FROM `vendor` JOIN `keranjang`
				ON `vendor`.`id_vendor` = `keranjang`.`id_vendor`
				WHERE `id_keranjang`= $keranjang
				";
		$data['vendor']=$this->db->query($query_vendor)->row_array();
		$aa=$data['vendor']['kode_area'];

		$lok_area=$this->session->userdata('lokasi');
		$cari_kode_area= "SELECT *
						 FROM kode_area
						 WHERE kode_pos = '$lok_area'
						";
		$data['dapet_kode_area']= $this->db->query($cari_kode_area)->row_array();
		$ini=$data['dapet_kode_area']['kode_area'];
		// echo $ini;
		$query_kurir="SELECT * 
					  FROM kurir
					  WHERE kode_tugas = '$ini'
		";

		$data['kurir']=$this->db->query($query_kurir)->row_array();
		// var_dump($data['kurir']);

		
        
			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('shopping/konfirmasi', $data);
			$this->load->view('templates/footer', $data);
		
	}
	public function selesai($id_kurir)
	{
		$alamat=$this->session->userdata('addr');
		$lok=$this->session->userdata('lokasi');
		$data=[
				'met_pemb' => "GOPAY",
				'id_kurir' => $id_kurir,
				'status_bayar' => "LUNAS",
				'alamat_kirim' => $alamat,
				'lokasi_kirim' => $lok
		];
		var_dump($data);
		$keranjang=$this->session->userdata('id_ker');

		$this->db->where('id_keranjang', $keranjang);
		$this->db->update('keranjang', $data);

		$this->session->unset_userdata('id_ker');
        $this->session->unset_userdata('lok');
        $this->session->unset_userdata('id_ve');
        $this->session->unset_userdata('addr');
        $this->session->unset_userdata('id_kate');
        $this->session->unset_userdata('hrg');
		$this->session->unset_userdata('total');

		echo $this->session->unset_userdata('total');
			$this->session->set_flashdata('message', '<div class="alert alert-success" 	role="alert">Pembelian Berhasil</div>');
            redirect('shopping');
	}

	public function buy($id)
	{
		$data['user']= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['barang']=$this->db->get_where('barang',['id_barang' => $id])->row_array();
		
		$data['vendor']= $this->db->get_where('vendor', $this->session->userdata('id_v'))->row_array();

		$query=[
			'id_barang'=> $data['barang']['id_barang'],
			'id_vendor' => $this->session->userdata('id_v'),
			'id_user' => $data['user']['id'],
			'jumlah_barang' => '1',
			'harga_barang' => $data['barang']['harga_barang'],
			'total_harga' => $data['barang']['harga_barang'],
			'status_barang' => 'Ready'
		];
		$this->db->insert('isi_keranjang', $query);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan barang</div>');
            redirect('shopping');
			
	}
	// 	public function hapus_barang($id_isi_keranjnag)
	// {
	// 	$this->db->where('id_isi_keranjnag', $isi_keranjang);
	// 	$this->db->delete('isi_keranjang');

	// 	$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Success delete Item</div>');
	// 	redirect('shopping/basket');
	// }

}


