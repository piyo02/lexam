
 <?php  $this->load->library( array( 'form_validation' ) );  ?>
 <?php  $this->load->helper(['form']);  ?>
 <!-- - -->
 <div class="row clearfix">
 <?php foreach( $form_data as $form_name => $attr ): ?>
    <?php
        if( $attr['type'] == 'hidden' )
        {
            $form = array(
                'name' => $form_name,
                'type' => $attr['type'],
                'placeholder' => ( isset( $attr['label'] )  ) ? $attr['label'] : '' ,
                  
                
            );
            $value = ( ( isset( $data ) && ( $data != NULL) )   ? ( isset( $data->$form_name ) ? $data->$form_name : '' ) : ''  );
            $form['value'] = ( isset( $attr['value'] )  ) ? $attr['value'] : $value;
            echo form_input( $form );
            continue;
        }
    ?>
        <div class="col-md-6">
            <div class="form-group form-float">
                <div class="form-line">
                    <?php

                        $form = array(
                            'name' => $form_name,
                            'id' => $form_name,
                            'type' => $attr['type'],
                            'placeholder' => ( isset( $attr['label'] )  ) ? $attr['label'] : '' ,
                            'class' => 'form-control',  
                            
                        );
                        
                        $form['readonly'] = '';

                        switch(  $attr['type'] )
                        {
                            case 'date':
                                $form['class'] = "form-control datepicker";
                                $form['type'] = "text";
                            case 'password':
                            case 'email':
                            case 'text':
                            case 'number':
                                $value = ( ( isset( $data ) && ( $data != NULL) )   ? ( isset( $data->$form_name ) ? $data->$form_name : '' ) : ''  );
                                $form['value'] = ( isset( $attr['value'] )  ) ? $attr['value'] : $value;
                                echo '<label for="'.$form_name.'" class="control-label">'.$attr["label"].'</label>';
                                echo form_input( $form );
                                break;
                            case 'hidden':
                                $value = ( ( isset( $data ) && ( $data != NULL) )   ? ( isset( $data->$form_name ) ? $data->$form_name : '' ) : ''  );
                                $form['value'] = ( isset( $attr['value'] )  ) ? $attr['value'] : $value;
                                echo form_input( $form );
                                break;
                            case 'ckeditor':
                                $value = ((isset($data) && ($data != NULL))   ? (isset($data->$form_name) ? $data->$form_name : '') : '');
                                $form['rows'] = "5";
                                $form['value'] = (isset($attr['value'])) ? $attr['value'] : $value;
                                $form['id'] = 'editor';
                                echo '<div class="form-group">
                                        <label for="" class="control-label">' . $attr["label"] . '</label>';
                                echo form_textarea($form);
                                echo '</div>';
                                break;
                            case 'textarea':
                                $value = ( ( isset( $data ) && ( $data != NULL) )   ? ( isset( $data->$form_name ) ? $data->$form_name : '' ) : ''  );
                                $form['rows'] = "5";
                                $form['value'] =  ( isset( $attr['value'] )  ) ? $attr['value'] : $value;
                                echo '<label for="" class="control-label">'.$attr["label"].'</label>';
                                echo form_textarea( $form );
                                break;
                            case 'multiple_file':
                                $form['multiple'] = "";
                            case 'file':
                                echo '<label for="" class="control-label">'.$attr["label"].'</label>';
                                echo form_upload( $form );
                                break;
                            case 'select_search':
                                $form['class'] = 'form-control show-tick';
                                $form['data-live-search'] = 'true';
                            case 'select':
                                $form['options'] = ( isset( $attr['options'] )  ) ? $attr['options'] : '';
                                $value = ( ( isset( $data ) && ( $data != NULL) )   ? ( isset( $data->$form_name ) ? $data->$form_name : '' ) : ''  );
                                $form['selected'] = ( isset( $attr['selected'] )  ) ? $attr['selected'] : $value;
                                echo '<label for="" class="control-label">'.$attr["label"].'</label>';
                                echo form_dropdown( $form );
                                break;
                        }
                    ?>
                </div>
            </div>
        </div>
<?php endforeach; ?>
</div>


<!--  -->