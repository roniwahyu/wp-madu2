<?php

function get_twitter($username){
	
	/* From http://www.wprecipes.com/how-to-display-your-latest-twitter-entry-on-your-wp-blog/comment-page-2#comment-114746 */

	$prefix = "<p>";
	$suffix = "</p>";

	$feed = "http://search.twitter.com/search.atom?q=from:" . $username . "&rpp=1";

	function parse_feed($feed) {
	    $stepOne = explode("<content type=\"html\">", $feed);
	    $stepTwo = explode("</content>", $stepOne[1]);
	    $tweet = $stepTwo[0];
	    $tweet = str_replace("&lt;", "<", $tweet);
	    $tweet = str_replace("&gt;", ">", $tweet);
		$tweet = str_replace('&apos;', "‘", $tweet);
	    return $tweet;
	}
	
	function curr_date($feed) {
	    $stepOne = explode("<updated>", $feed);
	    $stepTwo = explode("</updated>", $stepOne[1]);
	    $tweet_time = $stepTwo[0];
	    return $tweet_time;
	}
	
	
 
	/* If your running PHP > 5.3 you need to set this or your app will throw errors */
	date_default_timezone_set('Europe/London');

	/* Added from Skidoosh at http://www.skidoosh.co.uk/php/create-twitter-like-date-formatted-strings-with-php/ */

	function twitter_time_format ($date) {

		$blocks = array (
			array('year',  (3600 * 24 * 365)),
			array('month', (3600 * 24 * 30)),
			array('week',  (3600 * 24 * 7)),
			array('day',   (3600 * 24)),
			array('hour',  (3600)),
			array('min',   (60)),
			array('sec',   (1))
		);

		#Get the time from the function arg and the time now
		$argtime = strtotime($date);
		$nowtime = time();

		#Get the time diff in seconds
		$diff    = $nowtime - $argtime;

		#Store the results of the calculations
		$res = array ();

		#Calculate the largest unit of time
		for ($i = 0; $i < count($blocks); $i++) {
			$title = $blocks[$i][0];
			$calc  = $blocks[$i][1];
			$units = floor($diff / $calc);
			if ($units > 0) {
				$res[$title] = $units;
			}
		}

		if (isset($res['year']) && $res['year'] > 0) {
			if (isset($res['month']) && $res['month'] > 0 && $res['month'] < 12) {
				$format      = "About %s %s %s %s ago";
				$year_label  = $res['year'] > 1 ? 'years' : 'year';
				$month_label = $res['month'] > 1 ? 'months' : 'month';
				return sprintf($format, $res['year'], $year_label, $res['month'], $month_label);
			} else {
				$format     = "About %s %s ago";
				$year_label = $res['year'] > 1 ? 'years' : 'year';
				return sprintf($format, $res['year'], $year_label);
			}
		}

		if (isset($res['month']) && $res['month'] > 0) {
			if (isset($res['day']) && $res['day'] > 0 && $res['day'] < 31) {
				$format      = "About %s %s %s %s ago";
				$month_label = $res['month'] > 1 ? 'months' : 'month';
				$day_label   = $res['day'] > 1 ? 'days' : 'day';
				return sprintf($format, $res['month'], $month_label, $res['day'], $day_label);
			} else {
				$format      = "About %s %s ago";
				$month_label = $res['month'] > 1 ? 'months' : 'month';
				return sprintf($format, $res['month'], $month_label);
			}
		}

		if (isset($res['day']) && $res['day'] > 0) {
			if ($res['day'] == 1) {
				return sprintf("Yesterday at %s", date('h:i a', $argtime));
			}
			if ($res['day'] <= 7) {
				return date("\L\a\s\\t l \a\\t h:i a", $argtime);
			}
			if ($res['day'] <= 31) {
				return date("l \a\\t h:i a", $argtime);
			}
		}

		if (isset($res['hour']) && $res['hour'] > 0) {
			if ($res['hour'] > 1) {
				return sprintf("About %s hours ago", $res['hour']);
			} else {
				return "About an hour ago";
			}
		}

		if (isset($res['min']) && $res['min']) {
			if ($res['min'] == 1) {
				return "About one minut ago";
			} else {
				return sprintf("About %s minuts ago", $res['min']);
			}
		}

		if (isset ($res['sec']) && $res['sec'] > 0) {
			if ($res['sec'] == 1) {
				return "One second ago";
			} else {
				return sprintf("%s seconds ago", $res['sec']);
			}
		}
	}

	$twitterFeed = file_get_contents($feed);
	
	return stripslashes($prefix) . parse_feed($twitterFeed) . stripslashes($suffix).'<p class="tweet_time">'.twitter_time_format(curr_date($twitterFeed)).'</p>';
	
}

?>