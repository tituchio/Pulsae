<select id="analysisreqs" name="analysisreqs" class="form-control" size="20"' onChange="selectAnalysis(this);">
	<?php foreach($analysisreqs_enum as $analysisreq): ?>
	<option value="<?php echo $analysisreq->ANALYSISID; ?>" <?php echo $analysisreq->ANALYSISID == $selected_id?'selected="selected"':''; ?>>
		<?php echo $analysisreq->GAME->HOME_TEAM->NAME . " - " . $analysisreq->GAME->AWAY_TEAM->NAME; ?> [<?php echo $analysisreq->ALIAS; ?>]
		(<?php echo $analysisreq->STATUS == 0?'IN PROGRESS':($analysisreq->STATUS == 1?'DONE':'ERROR'); ?>)
	</option>
	<?php endforeach; ?>
</select>