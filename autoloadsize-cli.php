<?php
/**
* Autoload Size
* Some server configurations limit object caching. Make sure that your autoloaded options are under that size limit.
* @author Allan Collins <allan.collins@10up.com>
*
*/
class Autoloadsize_Command extends WP_CLI_Command {

	/**
	 * Runs query to determine size of autoloaded options.
	 * 
	 */
	public function __invoke( $args, $assoc_args ) {
		global $wpdb;
		$sql	 = "select sum(row_size) from (select char_length(option_id) + char_length(option_name) + char_length(option_value) + char_length(autoload) as row_size from $wpdb->options WHERE autoload='yes') as tbl1;";
		$result	 = $wpdb->get_var( $sql );
		WP_CLI::success( sprintf( '%s bytes of options are being autoloaded.',  number_format($result)  ) );
	}

}

WP_CLI::add_command( 'autoloadsize', 'Autoloadsize_Command' );