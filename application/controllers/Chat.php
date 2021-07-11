<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends CI_Controller
{

	public function __construct()
	{
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '2048M');
		parent::__construct();
		$this->load->model('ChatModel');
	}


	public function index()
	{
		if ($_SESSION['id_user'] == null) {

			redirect('chat/login', 'refresh');
		} else {
			$no =  $this->uri->segment(2);
			$data['data'] = $this->ChatModel->getDataById($no);
			if ($data == null) {
				die("user tidak ada nih");
			} else {
				// var_dump($data);die;
				$this->load->view('chat', $data);
			}
		}
	}
	public function dua()
	{
		$this->load->view('dua');
	}
	public function loadChat()
	{
		$id_user = 	$this->input->post('id_user');
		$id_lawan = 	$this->input->post('id_lawan');
		$data = $this->ChatModel->getPesan($id_user, $id_lawan);

		echo json_encode(array(
			'data' => $data
		));

		# code...
	}
	public function KirimPesan()
	{
		$now = date("Y-m-d H:i:s");
		// var_dump($now);die;
		$pesan = $this->input->post('pesan');
		$id_user = $this->input->post('id_user');
		$id_lawan = $this->input->post('id_lawan');

		// $id_user =2;
		// $id_lawan =1;
		$in = array(
			'id_user' => $id_user,
			'id_lawan' => $id_lawan,
			'isi' => $pesan,
			'waktu' => $now,
		);

		$this->ChatModel->TambahChatKeSatu($in);
		$log = array('status' => true);
		echo json_encode($log);
		return true;


		# code...
	}
	public function process_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$data = $this->ChatModel->getData($username,md5($password));
		// var_dump($data);die;
		if ($data == null) {
			$pesan = "Maaf, User Tidak Di temukan";
			$status = false;
		} else {
			$pesan = "selamat datang, " . $data->nama;
			$status = true;

			$array = array(
				'id_user' => $data->id_user,
				'nama' => $data->nama
			);

			$this->session->set_userdata($array);
		}
		$log = array(
			'status' => $status,
			'pesan' => $pesan,
		);

		echo json_encode($log);
		return true;

		# code...
	}
	public function login()
	{
		$this->load->view('login');

		# code...
	}
	public function menu()
	{
		if ($_SESSION['id_user'] == null) {

			redirect('chat/login', 'refresh');
		} else {
				$this->load->view('menu');
			
		}
		# code...
	}
	public function GetAllOrang()
	{
		$id_user = $this->input->post('id_user');
		$data = $this->ChatModel->GetAllOrangKecUser($id_user);

		echo json_encode(array(
			'data' => $data
		));

		# code...
	}
	public function logout()
	{

		$this->session->sess_destroy();
			$pesan="Berhasil Keluar, Anda Akan Diarahkan Ke Halaman Login";
			$status = true;
		

		echo json_encode(array(
			'pesan' => $pesan,
			'status' => $status
		));



		# code...
	}
	public function register()
	{
		$this->load->view('register');
	}
	public function process_register()
	{
		$username = $this->input->post('username');
		$nama_lengkap = $this->input->post('nama_lengkap');
		$password = $this->input->post('password');
		$data = $this->ChatModel->getDataOnly($username);
		if($data!=null){
			$pesan = "Data Sudah Pernah Ada!";
			$status = false;
		}else{
			$reg = array(
				'username' =>$username,
				'nama' =>$nama_lengkap,
				'password' => md5($password),
			 );
			 $this->ChatModel->Tambah('user',$reg);
			 $pesan = "User Berhasil Di tambah!, <br>
			 	Anda Akan Diarahkan Ke Halaman Login
			 ";
			 $status = true;
		}

		echo json_encode(array(
			'pesan' => $pesan,
			'status' => $status
		));
	}
}
        
    /* End of file  Chat.php */
