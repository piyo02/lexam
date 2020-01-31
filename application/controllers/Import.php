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
			'question_model',
			'question_answer_model',
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

	public function import_quest()
	{
		$questionnaire_id = $this->input->post( 'questionnaire_id' );
		if (isset($_FILES["file"]["name"])) {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
				$highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
				$row = 11;
                while ($row <= $highestRow) {
					$question = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    if ($question == null) {
						$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, 'Tidak ada data soal'));
						redirect( site_url( 'teacher/question/questionnaire/' . $questionnaire_id ) );
                    }
                    $data = array(
						'code'          => $this->generate_code( $questionnaire_id ),
                        'questionnaire_id'  => $questionnaire_id,
                        'type'          => 'text',
                        'text'          => $question,
                    );
					$question_id = $this->question_model->create( $data );
					
                    $type = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    if ($type != 'text' && $type != 'short_answer' && $type != 'essay') {
                        $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, 'Silahkan cek kembali tipe soal'));
                        redirect(site_url('guru/soal/daftar_soal/' . $this->input->post('b')));
                    }
                    $method_option = "get_". $type ."_option";
					$option = $this->$method_option($worksheet, $question_id, $row);
					$result = $this->question_answer_model->create( $option );

					switch ($type) {
						case 'text':
							$row += 5;
							break;
						case 'short_answer':
						case 'essay':
							$row += 1;
							break;
					}
                }
            }
        }
        $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, 'Import Data Siswa Berhasil' ));
        redirect( site_url( 'teacher/question/questionnaire/' . $questionnaire_id ) );
	}

	public function get_text_option($worksheet, $question_id, $row)
	{
		for ($i = 0; $i < 5; $i++) {
			$_option['question_id'] = $question_id;
			$_option['type']    = 'text';
			$_option['answer'] = $worksheet->getCellByColumnAndRow(3, ($row + $i))->getValue();

			$_option['value']    = $worksheet->getCellByColumnAndRow(4, ($row + $i))->getValue();
			$_data_option[] = $_option;
		}
		return $_data_option;
	}

	public function get_short_answer_option($worksheet, $question_id, $row)
	{
		$data[] = [
			'question_id' => $question_id,
			'type' => 'short_answer',
			'answer' => $worksheet->getCellByColumnAndRow(3, $row)->getValue(),
			'value' => $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
		];
		return $data;
	}

	public function get_essay_option($worksheet, $question_id, $row)
	{
		$data[] = [
			'question_id' => $question_id,
			'type' => 'essay',
			'answer' => $worksheet->getCellByColumnAndRow(3, $row)->getValue(),
			'value' => $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
		];
		return $data;
	}

	private function generate_code( $questionnaire_id = NULL )
	{
		$data = $this->question_model->question_by_questionnaire_id(0, NULL, $questionnaire_id)->row();
		if (!isset($data->code))
			$code = 'S-1';
		else {
			$code = substr($data->code, 2) + 1;
			$code = 'S-' . $code;
		}
		return $code;
	}
}
