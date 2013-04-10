<?php
function slt_PHPErrorsWidget() {
	$logfile = '/home/path/logs/php-errors.log'; // Enter the server path to your logs file here
	$displayErrorsLimit = 100; // The maximum number of errors to display in the widget
	$errorLengthLimit = 300; // The maximum number of characters to display for each error
	$fileCleared = false;
	$userCanClearLog = current_user_can( 'manage_options' );
	// Clear file?
	if ( $userCanClearLog && isset( $_GET["slt-php-errors"] ) && $_GET["slt-php-errors"]=="clear" ) {
		$handle = fopen( $logfile, "w" );
		fclose( $handle );
		$fileCleared = true;
	}
	// Read file
	if ( file_exists( $logfile ) ) {
		$errors = file( $logfile );
		$errors = array_reverse( $errors );
		if ( $fileCleared ) echo '<p><em>File cleared.</em></p>';
		if ( $errors ) {
			echo '<p>'.count( $errors ).' error';
			if ( $errors != 1 ) echo 's';
			echo '.';
			if ( $userCanClearLog ) echo ' [ <b><a href="'.get_bloginfo("url").'/wp-admin/?slt-php-errors=clear" onclick="return confirm(\'Are you sure?\');">CLEAR LOG FILE</a></b> ]';
			echo '</p>';
			echo '<div id="slt-php-errors" style="height:250px;overflow:scroll;padding:2px;background-color:#faf9f7;border:1px solid #ccc;">';
			echo '<ol style="padding:0;margin:0;">';
			$i = 0;
			foreach ( $errors as $error ) {
				echo '<li style="padding:2px 4px 6px;border-bottom:1px solid #ececec;">';
				$errorOutput = preg_replace( '/\[([^\]]+)\]/', '<b>[$1]</b>', $error, 1 );
				if ( strlen( $errorOutput ) > $errorLengthLimit ) {
					echo substr( $errorOutput, 0, $errorLengthLimit ).' [...]';
				} else {
					echo $errorOutput;
				}
				echo '</li>';
				$i++;
				if ( $i > $displayErrorsLimit ) {
					echo '<li style="padding:2px;border-bottom:2px solid #ccc;"><em>More than '.$displayErrorsLimit.' errors in log...</em></li>';
					break;
				}
			}
			echo '</ol></div>';
		} else {
			echo '<p>No errors currently logged.</p>';
		}
	} else {
		echo '<p><em>There was a problem reading the error log file.</em></p>';
	}
}

// Add widgets
function slt_dashboardWidgets() {
	wp_add_dashboard_widget( 'slt-php-errors', 'PHP errors', 'slt_PHPErrorsWidget' );
}
add_action( 'wp_dashboard_setup', 'slt_dashboardWidgets' );
?>