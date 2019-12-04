<div  id="row">
    <div class="card">
        <div class="card-body">

        	<?php if(isset($is_inline_grid)){
        			if($is_inline_grid == TRUE)
        				$this->load->view('grid/grid_edit_inline_body', $grid_body_data);
        			else
        				$this->load->view('grid/grid_body', $grid_body_data);
        			}
					else 
        				$this->load->view('grid/grid_body', $grid_body_data);
        		?>

        </div>
    </div>
</div>

        