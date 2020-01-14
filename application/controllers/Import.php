<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Import extends Public_Controller {
	private $services = null;
    private $name = null;
    private $parent_page = '';
	private $current_page = 'import/';
	
	public function __construct(){
		parent::__construct();
		$this->load->model(array(
			'group_model',
			'student_profile_model',
		));
        $this->load->library('excel');
	}
	
	public function import_student()
	{
		if (isset($_FILES["file"]["name"])) {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
				$highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                $row = 4;
                while ($row <= $highestRow) {
					$first_name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $last_name = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $phone = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $address = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $email = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$password = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					
					if(!$email) continue;
					
                    $additional_data = array(
						'first_name' => $first_name,
                        'last_name' => $last_name,
                        'phone' => $phone,
                        'address' => $address,
                        'email' => $email,
                    );
					$identity = $email;
					$identity_mode = NULL;

					$user_id =  $this->ion_auth->register($identity, $password, $email,$additional_data, [4], $identity_mode );

					$classroom_id = $this->input->post('classroom_id');
					$student_profile = array(
						'user_id' => $user_id,
						'school_id' => $this->input->post('school_id'),
						'classroom_id' => $classroom_id,
					);
			
					$this->student_profile_model->create( $student_profile );
					$row++;
                }
            }
        }
        $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, 'Import Data Siswa Berhasil' ));
        redirect( site_url( 'school_admin/users/classroom/' . $classroom_id ) );
	}
}
