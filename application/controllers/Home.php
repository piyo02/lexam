<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {

	function __construct()
	{
			parent::__construct();
			$this->load->model(array(
				'testimoni_model',
			));
	}
	public function index()
	{
		// TODO : tampilkan landing page bagi user yang belum daftar
		$this->data['testimonies'] = $this->testimoni_model->testimonies()->result();
		$this->render("landing_page", 'user_master');
	}
}