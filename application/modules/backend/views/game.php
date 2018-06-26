<!-- Content Header (Page header) -->
<section class="content-header">
	<h1 style="font-size:32px; font-weight: bold;"> Game </h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Game</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	
	<form method="post" action="" enctype='multipart/form-data'>
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
								<?php echo modules::run('backend/game/game_list'); ?>
							</div>
							<div class="form-group" >
								<a href="<?php echo base_url('backend/game'); ?>" class="btn btn-sm btn-primary ">ADD GAME</a>
							</div>
						</form>
					</div><!-- /.box-body -->
	
				</div><!-- /.box -->
			</div>
			<div class="col-md-8">
				
				<div class="row">
					<div class="col-md-12">
						
						<?php $success_msg = $this->session->flashdata('success_msg');
						if($success_msg) : ?>
						<div class="alert alert-success" role="alert"><?php echo $success_msg; ?></div>
						<?php endif; ?>
						
						<!-- Parameter -->
						<div class="box box-primary">
							<div class="box-header">
								<i class="fa fa-bar-chart-o"></i>
								<h3 class="box-title">Plan List</h3>
							</div>
							<div class="box-body">
								<div class="form-group" >
									<?php echo form_dropdown('game[PLANID]', $plans_enum, g_val($model, 'PLANEID'), 'id="planes" class="form-control"'); ?>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" >
											<label>Ball Tag</label>
											<input type="text" class="form-control" name="game[ball_tag]" value="<?php echo g_val($model, 'OTHERS_TAG.-1'); ?>" />
										</div>	
									</div>
									<div class="col-md-6">
										<div class="form-group" >
											<label>Referee Tag</label>
											<input type="text" class="form-control" name="game[referee_tag]" value="<?php echo g_val($model, 'OTHERS_TAG.-2'); ?>" />
										</div>		
									</div>
								</div>
								
								
								<div class="clearfix"></div>						
							</div><!-- /.box-body -->
			
						</div><!-- /.box -->
					</div>
					
				</div>
				
				
				<div class="row">
					<div class="col-md-6">
						<div class="box box-primary">
							<div class="box-header">
								<i class="fa fa-bar-chart-o"></i>
								<h3 class="box-title">HOME TEAM</h3>
							</div>
							<div class="box-body">
									<div class="form-group" >
										<?php echo form_dropdown('game[HOME_TEAMID]', $teams_enum, g_val($model, 'HOME_TEAMID'), 'id="home_teamid" class="form-control"'); ?>
									</div>
									<div class="form-group" >
										<label>Players</label>
										<table id="home_players" class="table table-hove table-condensed table-borderedr">
											<thead>
												<tr><th>Name</th><th>Position</th><th>Tag</th></tr>
											</thead>
											<tbody>
											<?php if($model) echo $this->load->view('game_playermap_table_tbody', array('type' => 'home', 'players' => $model->HOME_PLAYERS, 'players_tag' => $model->HOME_PLAYERS_TAG), TRUE); ?>
											</tbody>
										</table>
									</div>
									
									<!-- div class="box-footer text-right" style="margin-top:30px;">
										<input  id="analyze" type="submit" class="btn btn-primary pull-left"  value="<?php echo $model?'SAVE':'CREATE'; ?>" />
										<?php if(isset($model->TEAMID)): ?>
										<a href="<?php echo base_url('backend/team/delete/' . $model->TEAMID); ?>" class="btn btn-danger pull-right">DELETE</a>
										<?php endif; ?>
										<div class="clearfix"></div>
									</div -->
							</div>
							<!-- /.box-body -->
						</div>
						<!-- /.box -->
					</div>
					
					<div class="col-md-6">
						<div class="box box-primary">
							<div class="box-header">
								<i class="fa fa-bar-chart-o"></i>
								<h3 class="box-title">AWAY TEAM</h3>
							</div>
							<div class="box-body">
									<div class="form-group" >
										<?php echo form_dropdown('game[AWAY_TEAMID]', $teams_enum, g_val($model, 'AWAY_TEAMID'), 'id="away_teamid" class="form-control"'); ?>
									</div>
									<div class="form-group" >
										<label>Players</label>
										<table id="away_players" class="table table-hove table-condensed table-borderedr">
											<thead>
												<tr><th>Name</th><th>Tag</th></tr>
											</thead>
											<tbody>
											<?php if($model) echo $this->load->view('game_playermap_table_tbody', array('type' => 'away', 'players' => $model->AWAY_PLAYERS, 'players_tag' => $model->AWAY_PLAYERS_TAG ), TRUE); ?>
											</tbody>
										</table>
									</div>
							</div>
							<!-- /.box-body -->
						</div>
						<!-- /.box -->
					</div>
				
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<!-- Parameter -->
						<div class="box box-primary">
			
							<div class="box-footer">
								<div class="form-group" >
									<input type="submit" value="<?php echo isset($model->GAMEID)?'SAVE':'CREATE'; ?>" class="btn btn-primary" />
									<?php if(isset($model->GAMEID)): ?>
									<a href="<?php echo base_url('backend/game/delete/' . $model->GAMEID); ?>" class="btn btn-danger pull-right">DELETE</a>
									<?php endif; ?>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-body -->
			
						</div><!-- /.box -->
					</div>
				</div>
				
				
			</div>
		</div>
		
	</form>
</section><!-- /.content -->

<script type="text/javascript">
	
	$(function(){
		
		
		$('#home_teamid').change(function(){
			loadPlayers('home', $('#home_teamid').val());
		});
		
		$('#away_teamid').change(function(){
			loadPlayers('away', $('#away_teamid').val());
		});
		
		<?php if(!g_val($model, 'GAMEID')): ?>
			$('#home_teamid').change();
			$('#away_teamid').change();	
		<?php endif; ?>
		
		//setInterval(refreshGameList, 60000);
		
	});
	
	function selectGame(obj){
		if( $(obj).val() == 'CREATE NEW' )  window.location = '<?php echo base_url('backend/game/index/'); ?>/' ;
		else window.location = '<?php echo base_url('backend/game/index/'); ?>/'  + $(obj).val();
	}
	
	function loadPlayers(type, teamId){
		$.get('<?php echo base_url('backend/game/table_playermap/'); ?>/' + type + '/' + teamId, function(data){
			$('#' + type + '_players tbody').html(data);
		});
	}
	
	function refreshGameList(){
		$.get('<?php echo base_url('backend/game/game_list/'); ?>', function(data){
			$('#games').parent().html(data);
		});
	}
</script>