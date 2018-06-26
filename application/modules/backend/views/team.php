<!-- Bootstrap Color Picker -->
<link href="<?php echo base_url('assets-backend/css/colorpicker/bootstrap-colorpicker.min.css'); ?>" rel="stylesheet"/>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1 style="font-size:32px; font-weight: bold;"> Team </h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Team</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<!-- top row -->
	<div class="row">
		<div class="col-md-3">
			<!-- Parameter -->
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-bar-chart-o"></i>
					<h3 class="box-title">Team List </h3>
				</div>

				<div class="box-body">
					<form id="analyze-form" class="" role="form">
						<div class="form-group" >
							<?php echo form_dropdown('teams', $teams_enum, g_val($model, 'TEAMID'), 'id="teams" class="form-control" size="20"'); ?>
						</div>
						<div class="form-group" >
							<a href="<?php echo base_url('backend/team'); ?>" class="btn btn-sm btn-primary ">ADD TEAM</a>
						</div>
						
						<div class="clearfix"></div>
						
					</form>
				</div><!-- /.box-body -->

			</div><!-- /.box -->
		</div>
		<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-bar-chart-o"></i>
					<h3 class="box-title">Team Detail</h3>
					<?php if($model): ?>
					<a href="<?php echo base_url('backend/team'); ?> " class="btn btn-sm btn-danger pull-right" title="Close"><span class="glyphicon glyphicon-remove"></span></a>
					<?php endif; ?>
				</div>
				<div class="box-body">
					<form method="post" action="" enctype='multipart/form-data'>
						<div class="form-group" >
							<label>Name</label>
							<input type="text" class="form-control" name="team[NAME]" value="<?php echo g_val($model, 'NAME'); ?>" />
							<?php echo form_error('NAME'); ?>
						</div>
						<div class="form-group" >
							<label>Color</label>
							<div class="input-group my-colorpicker">
                                <input type="text" id="team-color" class="form-control" name="team[COLOR]" value="<?php echo g_val($model, 'COLOR'); ?>" />
                                <div class="input-group-addon">
                                    <i></i>
                                </div>
                            </div><!-- /.input group -->
							<?php echo form_error('COLOR'); ?>
						</div>
						<div class="form-group" >
							<label>Image (upload)</label>
							<?php if(isset($model->IMAGE) && $model->IMAGE != '' ): ?>
							<div>
								<img src="<?php echo base_url("uploads/team/{$model->IMAGE}"); ?>" />
							</div>
							<?php endif; ?>
							<input type="file" class="btn" name="userfile" />
							<?php echo isset($upload_error)?$upload_error:''; ?>
						</div>
						<div class="box-footer text-right" style="margin-top:30px;">
							<input  id="analyze" type="submit" class="btn btn-primary pull-left"  value="<?php echo $model?'SAVE':'CREATE'; ?>" />
							<?php if(isset($model->TEAMID)): ?>
							<a href="<?php echo base_url('backend/team/delete/' . $model->TEAMID); ?>" class="btn btn-danger pull-right">DELETE</a>
							<?php endif; ?>
							<div class="clearfix"></div>
						</div>
					</form>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>
	
</section><!-- /.content -->

<script type="text/javascript">

	$(function(){
		$('.my-colorpicker').colorpicker();
		$('#teams').change(function(){
			console.log($(this).val());
			window.location = '<?php echo base_url('backend/team/index/'); ?>/'  + $(this).val();
		});
	});
</script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url('assets-backend/js/plugins/colorpicker/bootstrap-colorpicker.min.js'); ?>" type="text/javascript"></script>