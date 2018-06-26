<!-- Content Header (Page header) -->
<section class="content-header">
	<h1 style="font-size:32px; font-weight: bold;"> Result </h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Result</li>
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
					<h3 class="box-title">Game  List </h3>
				</div>

				<div class="box-body">
					<form id="analyze-form" class="" role="form">
						<div class="form-group" >
							<select id="games" name="games" class="form-control" size="20"'>
								<?php foreach($games_enum as $game): ?>
								<option value="<?php echo $game->GAMEID; ?>">[<?php echo $game->GAMEID; ?>] <?php echo $game->HOME_TEAM->NAME . " - " . $game->AWAY_TEAM->NAME; ?></option>
								<?php endforeach; ?>
							</select>
							<?php //echo form_dropdown('games', $games_enum, g_val($model, 'GAMEID'), 'id="games" class="form-control" size="20"'); ?>
						</div>
					</form>
				</div><!-- /.box-body -->

			</div><!-- /.box -->
		</div>
		<?php if($model): ?>
		<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-bar-chart-o"></i>
					<h3 class="box-title">Game Result</h3>
					<?php if($model): ?>
					<a href="<?php echo base_url('backend/result'); ?> " class="btn btn-sm btn-danger pull-right" title="Close"><span class="glyphicon glyphicon-remove"></span></a>
					<?php endif; ?>
				</div>
				<div class="box-body">
					<form method="post" action="" enctype='multipart/form-data'>
						
						<?php /*
						<div class="form-group" >
							<label>FROM TIME (UNIX timestamp)</label>
							<input type="text"class="form-control" name="game[FROM_TIME]" />
						</div>
						<div class="form-group" >
							<label>TO TIME (UNIX timestamp)</label>
							<input type="text"class="form-control" name="game[TO_TIME]" />
						</div>
						 * */ ?>
						
						<table>
							<thead>
								<tr>
									<th></th><th><?php echo $model->HOME_TEAM->NAME; ?></th><th><?php echo $model->AWAY_TEAM->NAME; ?></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$fields = array(
									array('label' => 'SCORE', 'field' => 'SCORE'),
									array('label' => 'YELLOW', 'field' => 'YELLOW'),
									array('label' => 'RED', 'field' => 'RED'),
									array('label' => 'TOTAL SHOOTING', 'field' => 'TOTALSHOOTING'),
									array('label' => 'VALID SHOOTING', 'field' => 'VALIDSHOOTING'),
								);
								$readonly_fields = array(/*
									array('label' => 'PASS SUCCESS', 'field' => 'PASSSUCCESS'),
									array('label' => 'PASS FAIL', 'field' => 'PASSFAIL'),
									array('label' => 'OCCRATE', 'field' => 'OCCRATE'),
									array('label' => 'DISTANCE', 'field' => 'DISTANCE'),
									array('label' => 'PULSEAVG', 'field' => 'PULSEAVG'),
									array('label' => 'PULSEMAX', 'field' => 'PULSEMAX'),
									array('label' => 'VELAVG', 'field' => 'VELAVG'),
									array('label' => 'VELMAX', 'field' => 'VELMAX') */
								);
									foreach($fields as $field) :
								?>
								<tr>
									<td><?php echo $field['label']; ?></td>
									<td><input type="text" class="form-control" name="game[HOME_<?php echo $field['field']; ?>]" value="<?php echo g_val($model, 'HOME_' . $field['field']); ?>" />
											<?php echo form_error('HOME_' . $field['field']); ?></td>
									<td><input type="text" class="form-control" name="game[AWAY_<?php echo $field['field']; ?>]" value="<?php echo g_val($model, 'AWAY_' . $field['field']); ?>" />
											<?php echo form_error('AWAY_' . $field['field']); ?></td>
								</tr>
								<?php endforeach;
									foreach($readonly_fields as $field) :
								?>
								<tr>
									<td><?php echo $field['label']; ?></td>
									<td><input type="text" class="form-control" name="game[HOME_<?php echo $field['field']; ?>]" value="<?php echo g_val($model, 'HOME_' . $field['field']); ?>" disabled="disabled" />
											<?php echo form_error('HOME_' . $field['field']); ?></td>
									<td><input type="text" class="form-control" name="game[AWAY_<?php echo $field['field']; ?>]" value="<?php echo g_val($model, 'AWAY_' . $field['field']); ?>" disabled="disabled" />
											<?php echo form_error('AWAY_' . $field['field']); ?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						
						<div class="box-footer text-right" style="margin-top:30px;">
							<input  id="analyze" type="submit" class="btn btn-primary pull-left"  value="<?php echo $model?'SAVE':'CREATE'; ?>" />
							<?php if(isset($model->gameID)): ?>
							<a href="<?php echo base_url('backend/game/delete/' . $model->GAMEID); ?>" class="btn btn-danger pull-right">DELETE</a>
							<?php endif; ?>
							<div class="clearfix"></div>
						</div>
					</form>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<?php endif; ?>
	</div>
	
</section><!-- /.content -->

<script type="text/javascript">

	$(function(){
		$('#games').change(function(){
			console.log($(this).val());
			window.location = '<?php echo base_url('backend/result/index/'); ?>/'  + $(this).val();
		});
	});
</script>
