<?php
class Team {
	public static function echoCoachingTeam() {
		$coaching_team = get_post_custom_values( 'team_coaches' );
		if (!empty($coaching_team)) {
			foreach ($coaching_team as $coach) {
				echo do_shortcode($coach);
			}
		}
	}

	public static function echoTeamMeta() {
		echo '<dl class="highligthed">';

		self::echoDescription('team_age', 'Age Group');
		self::echoDescription('team_league', 'League', self::getMeta('team_competition_link'));
		self::echoDescription('team_training', 'Training schedule');

		echo '</dl>';
	}

	public static function hasSponsor() {
		return !empty(self::getMeta('team_sponsor_id'));
	}

	public static function echoSponsor() {
		$sponsor_post_id = self::getMeta('team_sponsor_id');
		if (empty($sponsor_post_id)) { return; }

		echo do_shortcode('[post_preview p='.$sponsor_post_id.' post_type=sponsor]');
	}

	private static function echoDescription($key, $title, $link = null, $link_target = '_blank') {
		$values = get_post_custom_values($key);
		if (empty($values) || $values[0] === '') { return; }

		$prefix = empty($link) ? '' : '<a href="'.$link.'" target="'.$link_target.'">';
		$postfix = empty($link) ? '' : '</a>';

		echo '<dt>'.__($title, 'sportsclubmanager').'</dt>';
		foreach ($values as $value) {
			echo '<dd>'.$prefix.$value.$postfix.'</dd>';
		}
	}

	private static function getMeta($key) {
		$values = get_post_custom_values($key);
		return empty($values) ? null : $values[0];
	}

	public static function hasFussballdeWidget() {
		$id = get_post_custom_values('team_competition_id');
		return !empty($id) && $id !== '';
	}

	public static function echoFussballdeWidget() {
		$values = get_post_custom_values('team_competition_id');

		if (empty($values)) { return; }

		foreach ($values as $id) {
			echo '<div id="widget1"></div>';
			echo '<script type="text/javascript">new fussballdeWidgetAPI().showWidget(\'widget1\', \'' . $id . '\');</script>';
		}
	}
}
?>