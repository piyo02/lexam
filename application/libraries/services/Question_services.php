<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Question_services
{


  function __construct(){

  }

  public function __get($var)
  {
    return get_instance()->$var;
  }
  
  public function get_table_config( $_page, $start_number = 1 )
  {
      $table["header"] = array(
        'text' => 'Soal',
        'answer' => 'Jawaban',
      );
      $table["number"] = $start_number;
      $table[ "action" ] = array(
		array(
			"name" => 'Detail',
			"type" => "link",
			"modal_id" => "edit_",
			"url" => site_url( $_page."detail/"),
			"button_color" => "success",
			"param" => "id",
		  ),	  
		array(
			"name" => 'Edit',
			"type" => "modal_form",
			"modal_id" => "edit_",
			"url" => site_url( $_page."edit/"),
			"button_color" => "primary",
			"param" => "id",
			"form_data" => array(
				"id" => array(
					'type' => 'hidden',
					'label' => "id",
				),
				"name" => array(
					'type' => 'text',
					'label' => "Nama Group",
				),
				"description" => array(
					'type' => 'textarea',
					'label' => "Deskripsi",
				),
			),
			"title" => "Group",
			"data_name" => "name",
		),
		array(
			"name" => 'X',
			"type" => "modal_delete",
			"modal_id" => "delete_",
			"url" => site_url( $_page."delete/"),
			"button_color" => "danger",
			"param" => "id",
			"form_data" => array(
				"id" => array(
				'type' => 'hidden',
				'label' => "id",
				),
			),
			"title" => "Group",
			"data_name" => "code",
		),
    );
    return $table;
  }
  public function validation_config( ){
    $config = array(
        array(
          'field' => 'name',
          'label' => 'name',
          'rules' =>  'trim|required',
        ),
        array(
          'field' => 'description',
          'label' => 'description',
          'rules' =>  'trim|required',
        ),
    );
    
    return $config;
  }
  public function validation_text()
	{
		$config = array(
			array(
				'field' => 'text',
				'label' => 'Soal Teks',
				'rules' =>  'trim|required',
			),
			array(
				'field' => 'option_0',
				'label' => 'Pilihan A',
				'rules' =>  'trim|required',
			),
			array(
				'field' => 'option_1',
				'label' => 'Pilihan B',
				'rules' =>  'trim|required',
			),
			array(
				'field' => 'option_2',
				'label' => 'Pilihan C',
				'rules' =>  'trim|required',
			),
			array(
				'field' => 'option_3',
				'label' => 'Pilihan D',
				'rules' =>  'trim|required',
			),
			array(
				'field' => 'option_4',
				'label' => 'Pilihan E',
				'rules' =>  'trim|required',
			),
		);

		return $config;
	}

	public function validation_image()
	{
		$config = array(
			array(
				'field' => 'text',
				'label' => 'Soal Teks',
				'rules' =>  'trim|required',
			),
		);

		return $config;
	}

	public function validation_short_answer()
	{
		$config = array(
			array(
				'field' => 'text',
				'label' => 'Soal Teks',
				'rules' =>  'trim|required',
			),
			array(
				'field' => 'option_4',
				'label' => 'Jawaban',
				'rules' =>  'trim|required',
			),
			array(
				'field' => 'skor',
				'label' => 'Nilai Jawaban',
				'rules' =>  'trim|required',
			),
		);

		return $config;
	}

	public function validation_essay()
	{
		$config = array(
			array(
				'field' => 'text',
				'label' => 'Soal Teks',
				'rules' =>  'trim|required',
			),
		);

		return $config;
	}

	public function get_form_text_question($data = null)
	{
		if ($data)
			$_data['data'] = $data;
		$_data["form_data"] = array(
			"text" => array(
				'type' => 'ckeditor',
				'label' => "Soal teks",
			),
			"type" => array(
				'type' => 'hidden',
				'label' => "tipe soal",
				'value' => "text",
			),
		);
		if ($data)
			$_data["form_data"]['text']['value'] = $data->text;
		return $_data;
	}

	public function get_form_image_question()
	{
		$_data["form_data"] = array(
			"image" => array(
				'type' => 'file',
				'label' => "Soal gambar",
			),
			"text" => array(
				'type' => 'ckeditor',
				'label' => "Soal teks",
			),
			"type" => array(
				'type' => 'hidden',
				'label' => "tipe soal",
				'value' => "image",
			),
		);
		return $_data;
	}

	public function get_form_audio_question()
	{
		$_data["form_data"] = array(
			"audio" => array(
				'type' => 'file',
				'label' => "Soal audio (*.mp3)",
			),
			"text" => array(
				'type' => 'ckeditor',
				'label' => "Soal teks",
			),
			"type" => array(
				'type' => 'hidden',
				'label' => "tipe soal",
				'value' => "audio",
			),
		);
		return $_data;
	}

	public function get_form_text_option($data = null)
	{

		$value = '';
		$opsi = ['Pilihan A', 'Pilihan B', 'Pilihan C', 'Pilihan D', 'Pilihan E'];
		$_data["form_data"] = array();
		for ($i = 0; $i < 5; $i++) {
			$_data["form_data"]['option_' . $i] = array(
				'type' => 'text',
				'label' => $opsi[$i],
			);
			if ($data) {
				$_data["form_data"]['option_' . $i]['value'] = $data[$i]->jawaban;
				if ($data[$i]->skor == 1)
					$value = $i;
				$_data["form_data"]['data_' . $i] = array(
					'type' => 'hidden',
					'label' => 'id',
					'value' => $data[$i]->id,
				);
				$_data["form_data"]['type'] = array(
					'type' => 'hidden',
					'label' => 'type option',
					'value' => 'teks'
				);
			}
		}
		$_data["form_data"]['option_5'] = array(
			'type' => 'select',
			'label' => 'Jawaban',
			'options' => array(
				0 => 'Pilihan A',
				1 => 'Pilihan B',
				2 => 'Pilihan C',
				3 => 'Pilihan D',
				4 => 'Pilihan E'
			),
			'selected' => $value
		);
		$_data['form_data']['type_option'] = array(
			'type' => 'hidden',
			'label' => "tipe soal",
			'value' => "text",
		);
		return $_data;
	}

	public function get_form_image_option($data = null)
	{
		if ($data)
			$_data['data'] = $data;
		$option = ['Pilihan A', 'Pilihan B', 'Pilihan C', 'Pilihan D', 'Pilihan E'];
		$_data["form_data"] = array();
		for ($i = 0; $i < 5; $i++) {
			$_data["form_data"]['option[' . $i . ']'] = array(
				'type' => 'file',
				'label' => $option[$i],
			);
			if ($data) {
				$_data["form_data"]['data_' . $i] = array(
					'type' => 'hidden',
					'label' => 'id',
					'value' => $data[$i]->id,
				);
				if ($data[$i]->skor == 1)
					$value = $i;
			}
		}
		$_data["form_data"]['option_5'] = array(
			'type' => 'select',
			'label' => 'Jawaban',
			'options' => array(
				0 => 'Pilihan A',
				1 => 'Pilihan B',
				2 => 'Pilihan C',
				3 => 'Pilihan D',
				4 => 'Pilihan E'
			)
		);
		$_data['form_data']['type_option'] = array(
			'type' => 'hidden',
			'label' => "tipe soal",
			'value' => "image",
		);
		if ($data)
			$_data["form_data"]['option_5']['selected'] = $value;
		return $_data;
	}

	public function get_form_short_answer_option($data = null)
	{
		$_data["form_data"]["option_4"] = array(
			'type' => 'text',
			'label' => "Jawaban *panjang karakter hanya 255",
		);
		$_data["form_data"]["skor"] = array(
			'type' => 'number',
			'label' => "Skor",
		);
		if ($data) {
			$_data["form_data"]['option_4']['value'] = $data[0]->jawaban;
			$_data["form_data"]['skor']['value'] = $data[0]->skor;
			$_data["form_data"]['data_4'] = array(
				'type' => 'hidden',
				'label' => "id",
				'value' => $data[0]->id,
			);
			$_data["form_data"]['type'] = array(
				'type' => 'hidden',
				'label' => 'type option',
				'value' => 'isian'
			);
		}
		$_data['form_data']['type_option'] = array(
			'type' => 'hidden',
			'label' => "tipe soal",
			'value' => "short_answer",
		);
		return $_data;
	}

	public function get_form_essay_option($data = null)
	{
		$_data["form_data"]['option_4'] = array(
			'type' => 'text',
			'label' => "Silahkan tekan tombol simpan",
			'readonly' => 'readonly',
			'value' => 'Soal esai'
		);
		$_data["form_data"]['skor'] = array(
			'type' => 'number',
			'label' => "Skor",
		);
		if ($data) {
			$_data["form_data"]['option_4']['type'] = 'hidden';
			$_data["form_data"]['skor']['value'] = $data[0]->skor;
			$_data["form_data"]['data_4'] = array(
				'type' => 'hidden',
				'label' => "id",
				'value' => $data[0]->id,
			);
			$_data["form_data"]['type'] = array(
				'type' => 'hidden',
				'label' => 'type option',
				'value' => 'esai'
			);
		}
		$_data['form_data']['type_option'] = array(
			'type' => 'hidden',
			'label' => "tipe soal",
			'value' => "essay",
		);
		return $_data;
	}

	public function get_form_data_text($data)
	{
		$_data['data'] = $data;
		$_data["form_data"] = array(
			"id" => array(
				'type' => 'hidden',
				'label' => "Soal Id",
			),
			"questionnaire_id" => array(
				'type' => 'hidden',
				'label' => "Bank Soal Id",
			),
			"text" => array(
				'type' => 'ckeditor',
				'label' => "Soal teks",
				'value' => $data->text
			),
		);
		return $_data;
	}

	public function get_form_data_image($data)
	{
		$_data['data'] = $data;
		$_data["form_data"] = array(
			"id" => array(
				'type' => 'hidden',
				'label' => "Soal Id",
			),
			"questionnaire_id" => array(
				'type' => 'hidden',
				'label' => "Bank Soal Id",
			),
			"image" => array(
				'type' => 'file',
				'label' => "Soal gambar",
			),
			"text" => array(
				'type' => 'ckeditor',
				'label' => "Soal teks",
				'value' => $data->text
			),
		);
		return $_data;
	}

	public function get_form_data_audio($data)
	{
		$_data['data'] = $data;
		$_data["form_data"] = array(
			"id" => array(
				'type' => 'hidden',
				'label' => "Soal Id",
			),
			"questionnaire_id" => array(
				'type' => 'hidden',
				'label' => "Bank Soal Id",
			),
			"text" => array(
				'type' => 'ckeditor',
				'label' => "Soal teks",
				'value' => $data->text
			),
			"audio" => array(
				'type' => 'file',
				'label' => "Soal audio",
			),
		);
		return $_data;
	}

	public function get_form_data_edit($data)
	{
		$_data['data'] = $data;
		$_data["form_data"] = array(
			"id" => array(
				'type' => 'hidden',
				'label' => "Soal Id",
			),
			"questionnaire_id" => array(
				'type' => 'hidden',
				'label' => "Bank Soal Id",
			),
			"option[5]" => array(
				'type' => 'file',
				'label' => "Soal Gambar",
				'value' => $data->text
			),
			"text" => array(
				'type' => 'ckeditor',
				'label' => "Soal teks",
				'value' => $data->text
			),
			"audio" => array(
				'type' => 'file',
				'label' => "Soal audio",
			),
		);
		return $_data;
	}
}
?>
