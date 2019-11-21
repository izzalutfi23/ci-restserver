<?php 
	use Restserver\Libraries\REST_Controller;
	
	defined('BASEPATH') OR exit('No direct script access allowed');
	

	require APPPATH . 'libraries/REST_Controller.php';
	
	require APPPATH . 'libraries/Format.php';


	class Mahasiswa extends REST_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('Mrest');
		}

		public function index_get(){
			$id = $this->get('id');
			if($id==null){
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

		public function index_delete(){
			$id = $this->delete('id');
			if($id===null){
				$this->response([
                    'status' => FALSE,
                    'message' => 'provide an id!'
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
			else{
				if($this->Mrest->del_mhs($id) > 0){
					$this->response([
                    	'status' => TRUE,
                    	'id' => $id,
                    	'message'=>'deleted'
                	], REST_Controller::HTTP_OK);
				}
				else{
					$this->response([
	                    'status' => FALSE,
	                    'message' => 'id not found!'
                	], REST_Controller::HTTP_BAD_REQUEST);
				}
			}
		}
	}
 ?>