<!-- Content Header (Page header) -->
<section class="content-header">
	<h1 style="font-size:32px; font-weight: bold;"> Analysis Request </h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Team</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<!-- top row -->
	<div class="row">
		<div class="col-md-4">
			<!-- Parameter -->
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-bar-chart-o"></i>
					<h3 class="box-title">Analysis Request List </h3>
				</div>

				<div class="box-body">
					<form id="analyze-form" class="" role="form">
						<div class="form-group" id="analysisreqs_container" >
							<?php echo modules::run('backend/analysisreq/analysisreq_list/' . g_val($model, 'ANALYSISID')); ?>
						</div>
						<div class="form-group" >
							<a href="<?php echo base_url('backend/analysisreq'); ?>" class="btn btn-sm btn-primary ">ADD ANALYSIS REQUEST</a>
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
					<h3 class="box-title">Analysis Request Detail</h3>
					<?php if($model): ?>
					<a href="<?php echo base_url('backend/analysisreq'); ?> " class="btn btn-sm btn-danger pull-right" title="Close"><span class="glyphicon glyphicon-remove"></span></a>
					<?php endif; ?>
				</div>
				<div class="box-body">
					<form method="post" action="" enctype='multipart/form-data'>
						<div class="form-group" >
							<label>GAME</label>
							<select id="games" name="analysisreq[GAMEID]" class="form-control">
								<?php foreach($games_enum as $game): ?>
								<option value="<?php echo $game->GAMEID; ?>" <?php echo g_val($model, 'GAMEID') == $game->GAMEID?'selected="selected"':''; ?> >[<?php echo $game->GAMEID; ?>] <?php echo $game->HOME_TEAM->NAME . " - " . $game->AWAY_TEAM->NAME; ?></option>
								<?php endforeach; ?>
							</select>
							<?php echo form_error('GAMEID'); ?>
						</div>
						<div class="form-group" >
							<label>FS</label>
							<?php echo form_dropdown('analysisreq[FS]', array('F' => 'First Half', 'S' => 'Second Half'), g_val($model, 'FS'), 'class="form-control"'); ?>
						</div>
						<div class="form-group" >
							<label>START TIME (Minutes)</label>
							<input type="text" class="form-control" name="analysisreq[STIME]" value="<?php echo g_val($model, 'STIME'); ?>" />
							<?php echo form_error('STIME'); ?>
						</div>
						<div class="form-group" >
							<label>END TIME (Minutes)</label>
							<input type="text" class="form-control" name="analysisreq[ETIME]" value="<?php echo g_val($model, 'ETIME'); ?>" />
							<?php echo form_error('ETIME'); ?>
						</div>
						<div class="form-group" >
							<label>ALIAS</label>
							<input type="text" class="form-control" name="analysisreq[ALIAS]" value="<?php echo g_val($model, 'ALIAS'); ?>" />
							<?php echo form_error('ALIAS'); ?>
						</div>
						<div class="box-footer text-right" style="margin-top:30px;">
							<input  id="analyze" type="submit" class="btn btn-primary pull-left"  value="<?php echo $model?'SAVE':'CREATE'; ?>" />
							<?php if(isset($model->ANALYSISID)): ?>
							<a href="<?php echo base_url('backend/analysisreq/delete/' . $model->ANALYSISID); ?>" class="btn btn-danger pull-right">DELETE</a>
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
		
		refreshAnalysisreqList();
		
		setInterval(refreshAnalysisreqList, 60000);
	});
	
	function selectAnalysis(obj){
		window.location = '<?php echo base_url('backend/analysisreq/index/'); ?>/'  + $(obj).val();
	}
	function refreshAnalysisreqList(){
		$.get('<?php echo base_url('backend/analysisreq/analysisreq_list/'); ?>', function(data){
			$('#analysisreqs_container').html(data);
		});
	}
</script>
