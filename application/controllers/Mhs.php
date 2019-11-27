<?php 
	class Mhs extends CI_controller{
		function __construct(){
			parent::__construct();
			$this->load->model('Mrest');
		}
		public function index(){
			$mhs=$this->Mrest->get_mhs()->result();
			var_dump($mhs);
		}
	}
 ?>