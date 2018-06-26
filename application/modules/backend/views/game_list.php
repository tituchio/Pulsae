<select id="games" name="games" class="form-control" size="20"' onChange="selectGame(this)">
	<?php foreach($games_enum as $game): ?>
	<option value="<?php echo $game->GAMEID; ?>">[<?php echo $game->GAMEID; ?>] <?php echo $game->HOME_TEAM->NAME . " - " . $game->AWAY_TEAM->NAME; ?></option>
	<?php endforeach; ?>
</select>