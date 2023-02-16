
<div class="content-wrapper">
	
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">DETAIL DATA VIS</h3>
			</div>
		
		<table class='table table-bordered'>        

	
			<tr>
				<td>Questionnaire</td>
				<td><?php echo $questionnaire; ?></td>
			</tr>
	
			<tr>
				<td>Modified Time</td>
				<td><?php echo $modified_time; ?></td>
			</tr>
	
			<tr>
				<td>Created Time</td>
				<td><?php echo $created_time; ?></td>
			</tr>
	
			<tr>
				<td></td>
				<td><a href="<?php echo site_url('monitoring') ?>" class="btn btn-default">Kembali</a></td>
			</tr>
	
		</table>
		</div>
	</section>
</div>