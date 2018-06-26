
		<?php foreach($players as $player): ?>
		<tr>
			<td><?php echo $player->NAME; ?></td>
			<td><?php echo $player->POSITION; ?></td>
			<td><input type="text" name="game[playermap][<?php echo strtoupper( $type ); ?>][<?php echo $player->PLAYERID; ?>]" value="<?php echo g_val($players_tag, $player->PLAYERID); ?>" /></td>
		</tr>
		<?php endforeach; ?>

