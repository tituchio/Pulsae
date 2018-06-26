<!-- Content Header (Page header) -->
<section class="content-header">
	<h1 style="font-size:32px; font-weight: bold;"> Player </h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Player</li>
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
					<h3 class="box-title">Players  List </h3>
				</div>

				<div class="box-body">
					<form id="analyze-form" class="" role="form">
						<div class="form-group" >
							<?php echo form_dropdown('teams', $teams_enum, $team_id, 'id="teams" class="form-control"'); ?>
						</div>
						<div class="form-group" >
							<?php echo form_dropdown('players', $players_enum, g_val($model, 'PLAYERID'), 'id="players" class="form-control" size="20"'); ?>
						</div>
						<div class="form-group" >
							<a href="<?php echo base_url("backend/player/index/{$team_id}"); ?>" class="btn btn-sm btn-primary ">ADD PLAYER</a>
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
					<h3 class="box-title">Player  Detail</h3>
					<?php if($model): ?>
					<a href="<?php echo base_url("backend/player/index/{$team_id}"); ?> " class="btn btn-sm btn-danger pull-right" title="Close"><span class="glyphicon glyphicon-remove"></span></a>
					<?php endif; ?>
				</div>
				<div class="box-body">
					<form method="post" action="" enctype='multipart/form-data'>
						<div class="form-group" >
							<label>Name</label>
							<input type="text" class="form-control" name="player[NAME]" value="<?php echo g_val($model, 'NAME'); ?>" />
							<?php echo form_error('NAME'); ?>
						</div>
						<div class="form-group" >
							<label>Back Number</label>
							<input type="text" class="form-control" name="player[BKNUMBER]" value="<?php echo g_val($model, 'BKNUMBER'); ?>" />
							<?php echo form_error('BKNUMBER'); ?>
						</div>
						<div class="form-group" >
							<label>Position</label>
							<?php echo form_dropdown('player[POSITION]', array('FW' => 'FW', 'MF' => 'MF','DF' => 'DF', 'GK' => 'GK',  ), g_val($model, 'POSITION'), 'class="form-control"'); ?>
							<?php echo form_error('POSITION'); ?>
						</div>
						<div class="form-group" >
							<label>Age</label>
							<input type="text" class="form-control" name="player[AGE]" value="<?php echo g_val($model, 'AGE'); ?>" />
							<?php echo form_error('AGE'); ?>
						</div>
						<div class="form-group" >
							<label>Height (cm)</label>
							<input type="text" class="form-control" name="player[HEIGHT]" value="<?php echo g_val($model, 'HEIGHT'); ?>" /> 
							<?php echo form_error('HEIGHT'); ?>
						</div>
						<div class="form-group" >
							<label>Weight (kg)</label>
							<input type="text" class="form-control" name="player[WEIGHT]" value="<?php echo g_val($model, 'WEIGHT'); ?>" />
							<?php echo form_error('WEIGHT'); ?>
						</div>
						<div class="form-group" >
							<label>Image (upload)</label>
							<?php if(isset($model->IMAGE) && $model->IMAGE != '' ): ?>
							<div>
								<img src="<?php echo base_url("uploads/player/{$model->IMAGE}"); ?>" />
							</div>
							<?php endif; ?>
							<input type="file" class="btn" name="userfile" />
							<?php echo isset($upload_error)?$upload_error:''; ?>
						</div>
						<div class="box-footer text-right" style="margin-top:30px;">
							<input  id="analyze" type="submit" class="btn btn-primary pull-left"  value="<?php echo $model?'SAVE':'CREATE'; ?>" />
							<?php if(isset($model->PLAYERID)): ?>
							<a href="<?php echo base_url('backend/player/delete/' . $model->PLAYERID); ?>" class="btn btn-danger pull-right">DELETE</a>
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
		$('#teams').change(function(){
			console.log($(this).val());
			window.location = '<?php echo base_url('backend/player/index/'); ?>/'  + $(this).val();
		});
		$('#players').change(function(){
			window.location = '<?php echo base_url('backend/player/index/' .  $team_id); ?>/'  + $(this).val();
		});
	});
</script>
