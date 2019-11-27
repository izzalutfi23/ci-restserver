<?php 
	use Restserver\Libraries\REST_Controller;
	
	defined('BASEPATH') OR exit('No direct script access allowed');
	

	require APPPATH . 'libraries/REST_Controller.php';
	
	require APPPATH . 'libraries/Format.php';


	class Mahasiswa extends REST_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('Mrest');

			$this->methods['index_get']['limit'] = 50;
		}

		public function index_get(){
			$id = $this->get('id');
			if($id===null){
				$mhs = $this->Mrest->get_mhs()->result();				
			}
			else{
				$mhs = $this->Mrest->get_mhs($id)->result();
			}
			if($mhs){
				$this->response([
                    'status' => TRUE,
                    'data' => $mhs
                ], REST_Controller::HTTP_OK);
			}
			else{
				$this->response([
                    'status' => FALSE,
                    'message' => 'data not found'
                ], REST_Controller::HTTP_NOT_FOUND);
			}
		}

		public function index_post(){
			$data = [
				'nim'=>$this->post('nim'),
				'nama'=>$this->post('nama'),
				'alamat'=>$this->post('alamat'),
				'tgl_lahir'=>$this->post('tgl_lahir')
			];

			if($this->Mrest->input_mhs($data)>0){
				$this->response([
                    	'status' => TRUE,
                    	'message'=>'data mahasiswa telah ditambahkan'
                	], REST_Controller::HTTP_CREATED);
			}
			else{
				$this->response([
	                    'status' => FALSE,
	                    'message' => 'gagal menambahkan data!'
                	], REST_Controller::HTTP_BAD_REQUEST);
			}
		}

		public function index_delete(){
			$id = $this->delete('id');
			if($id==null){
				$this->response([
                    'status' => FALSE,
                    'message' => 'provide an id!'
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
			else{
				if($this->Mrest->del_mhs($id) > 0){
					$this->response([
	                    'status' => TRUE,
	                    'message' => 'deleted'
                	], REST_Controller::HTTP_NO_CONTENT);
				}
				else{
					$this->response([
	                    'status' => FALSE,
	                    'message' => 'id not found!'
                	], REST_Controller::HTTP_BAD_REQUEST);
				}
			}
		}

		public function index_put(){
			$id = $this->put('nim');
			$data = [
				'nim'=>$this->put('nim'),
				'nama'=>$this->put('nama'),
				'alamat'=>$this->put('alamat'),
				'tgl_lahir'=>$this->put('tgl_lahir')
			];
			if($this->Mrest->edit_mhs($data, $id)>	0){
				$this->response([
                    	'status' => TRUE,
                    	'message'=>'data mahasiswa telah diubah'
                	], REST_Controller::HTTP_OK);
			}
			else{
				$this->response([
	                    'status' => FALSE,
	                    'message' => 'gagal mengubah data!'
                	], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
	}
 ?>