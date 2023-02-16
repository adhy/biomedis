<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA VIS</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post">
			
				<table class='table table-bordered'>
	
					<tr>
						<td width='200'>Questionnaire <?php echo form_error('questionnaire') ?></td><td><input type="text" class="form-control" name="questionnaire" id="questionnaire" placeholder="Questionnaire" value="<?php echo $questionnaire; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Modified Time <?php echo form_error('modified_time') ?></td><td><input type="text" class="form-control" name="modified_time" id="modified_time" placeholder="Modified Time" value="<?php echo $modified_time; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Created Time <?php echo form_error('created_time') ?></td><td><input type="text" class="form-control" name="created_time" id="created_time" placeholder="Created Time" value="<?php echo $created_time; ?>" /></td>
					</tr>
	
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="" value="<?php echo $; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('vis') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>