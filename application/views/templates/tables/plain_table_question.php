<div class="table-responsive">
    <table id="table" class="table table-striped table-bordered table-hover  ">
        <thead>
            <tr>
                <th style="width:50px">No</th>
                <?php foreach ($header as $key => $value) : ?>
                    <th><?php echo $value ?></th>
                <?php endforeach; ?>
                <?php if (isset($action)) : ?>
                    <th><?php echo "Aksi" ?></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = (isset($number) && ($number != NULL))  ? $number : 1;
            foreach ($rows as $ind => $row) :
                ?>
                <tr>
                    <td data-title="No"> <?php echo $no++ ?> </td>
                    <?php foreach ($header as $key => $value) : ?>
                        <td data-title="<?= $value ?>">
                            <?php
                                    $option = "";
                                    $attr = "";
                                    if ($key == 'text')
                                    {
                                        $image = "";
                                        $question = $row->$key;
                                        if ($row->image != NULL)
                                            $image = '<img src="' . $row->image_quest . '" width="150px" height="150px">';
                                        $attr =  '<div>
                                                        <div>
                                                            <p><b>Kode: ' . $row->code . '</b></p>
                                                        </div>
                                                        '. $image .'
                                                        <p>' . $question . '</p>
                                                    </div>';
                                    }
                                    if ($key == 'answer')
                                    {
                                        $option = $row->$key;
                                        if ($row->type_option == "image")
                                            $option = '<img src="' . $row->image_answer . '" width="150px" height="150px">';
                                        $attr =  '<div>
                                                        <p>' . $option . '</p>
                                                        <div class="float-right">
                                                            <p><b>Skor: ' . $row->value . '</b></p>
                                                        </div>
                                                    </div>';
                                    }
                                    echo $attr;
                                    ?>
                        </td>
                    <?php endforeach; ?>
                    <?php if( isset( $action ) ):?>
                        <td>
                            <!--  -->
                            <!-- <div class="btn-group"> -->
                                <!-- <ul class="nav navbar-nav"> -->
                                    <?php 
                                        foreach ( $action as $ind => $value) :
                                    ?>
                                        <!-- <li>                                 -->
                                            <?php 
                                                    switch( $value['type'] )
                                                    {
                                                        case "link" :
                                                                $value["data"] = $row;
                                                                $this->load->view('templates/actions/link', $value ); 
                                                            break;
                                                        case "modal_delete" :
                                                                $value["data"] = $row;
                                                                $this->load->view('templates/actions/modal_delete', $value ); 
                                                            break;
                                                        case "modal_form" :
                                                                $value["data"] = $row;
                                                                $this->load->view('templates/actions/modal_form', $value ); 
                                                            break;
                                                        case "modal_form_multipart" :
                                                                $value["data"] = $row;
                                                                $this->load->view('templates/actions/modal_form_multipart', $value ); 
                                                            break;
                                                        case "button_dropdowns" :
                                                                $value["data"] = $row;
                                                                $this->load->view('templates/actions/button_dropdown', $value ); 
                                                            break;
                                                    }
                                            ?>
                                        <!-- </li> -->
                                    <?php 
                                        endforeach;
                                    ?>
                                <!-- </ul> -->
                            <!-- </div> -->
                            <!--  -->
                        </td>
                    <?php endif;?>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</div>
<script>
    var width = window.innerWidth;
    console.log(width);
    var element = document.getElementById('table');

    if (width <= 600) {
        element.classList.add('rg-table');
    } else {
        element.classList.remove('rg-table');
    }
</script>