<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {

	function __construct()
	{
			parent::__construct();
			$this->load->model(array(
				'testimoni_model',
				'school_model',
				'test_model',
				'teacher_profile_model',
				'student_profile_model',
			));
	}
	public function index()
	{
		redirect( site_url('auth/login') );
		// TODO : tampilkan landing page bagi user yang belum daftar
		$this->data['schools'] = $this->school_model->record_count();
		$this->data['tests'] = $this->test_model->record_count();
		$this->data['teachers'] = $this->teacher_profile_model->record_count();
		$this->data['students'] = $this->student_profile_model->record_count();
		$this->data['testimonies'] = $this->testimoni_model->testimonies()->result();
		$this->render("landing_page", 'user_master');
	}
}