<?php 
/**
 *PayGate Database Class
 *Uses Wordpress implementations
 * @This Class extend PDO
 *
 * Original code from {@link http://php.justinvincent.com Justin Vincent (justin@visunet.ie)}
 *
 * 
 * @package PayGate
 * @subpackage Database
 * @since 0.1.0
 */
/**
 * @since 0.1.0
 */
define( 'EZSQL_VERSION', 'PayGate 0.1' );

/**
 * @since 0.1.0
 */
define( 'OBJECT', 'OBJECT' );
define( 'object', 'OBJECT' ); // For Back compat.

/**
 * @since 0.1.0
 */
define( 'OBJECT_K', 'OBJECT_K' );

/**
 * @since 0.1.0
 */
define( 'ARRAY_A', 'ARRAY_A' );

/**
 * @since 0.1.0
 */
define( 'ARRAY_N', 'ARRAY_N' );

/**
* Paygate database abstraction object class.
*
*we should try to make it possible to replace this with
*any other class if so required
*/

class pgdb extends PDO{

	/**
	 * Whether to show SQL/DB errors.
	 *
	 * Default behavior would be to show errors if both PG_DEBUG and PG_DEBUG_DISPLAY
	 * evaluated to true.
	 *
	 * @since 0.1
	 * @var bool
	 */
	var $show_errors = false;

	/**
	 * Whether to suppress errors during the DB bootstrapping.
	 *
	 * @since 0.1
	 * @var bool
	 */
	var $suppress_errors = false;

	/**
	 * The last error during query.
	 *
	 * @since 0.1
	 * @var string
	 */
	public $last_error = '';

	/**
	 * Amount of queries made
	 *
	 * @since 0.1
	 * @var int
	 */
	public $num_queries = 0;

		/**
	 * Count of rows returned by previous query
	 *
	 * @since 0.1
	 * @var int
	 */
	public $num_rows = 0;

	/**
	 * Count of affected rows by previous query
	 *
	 * @since 0.1.0
	 * @var int
	 */
	var $rows_affected = 0;

	/**
	 * The ID generated for an AUTO_INCREMENT column by the previous query (usually INSERT).
	 *
	 * @since 0.1
	 * @var int
	 */
	public $insert_id = 0;

	/**
	 * Last query made
	 *
	 * @since 0.1
	 * @var array
	 */
	var $last_query;

	/**
	 * Results of the last query made
	 *
	 * @since 0.1
	 * @var array|null
	 */
	var $last_result;

	/**
	 * MySQL result, which is either a resource or boolean.
	 *
	 * @since 0.1
	 * @var mixed
	 */
	protected $result;

	/**
	 * Cached column info, for sanity checking data before inserting
	 *
	 * @since 0.1
	 * @var array
	 */
	protected $col_meta = array();

	/**
	 * Calculated character sets on tables
	 *
	 * @since 0.1
	 * @var array
	 */
	protected $table_charset = array();

	/**
	 * Whether text fields in the current query need to be sanity checked.
	 *
	 * @since 0.1
	 * @var bool
	 */
	protected $check_current_query = true;

	/**
	 * Flag to ensure we don't run into recursion problems when checking the collation.
	 *
	 * @since 0.1
	 * @see wpdb::check_safe_collation()
	 * @var bool
	 */
	private $checking_collation = false;

	/**
	 * Saved info on the table column
	 *
	 * @since 0.1
	 * @var array
	 */
	protected $col_info;

	/**
	 * Saved queries that were executed
	 *
	 * @since 0.1
	 * @var array
	 */
	var $queries;

	/**
	 * The number of times to retry reconnecting before dying.
	 *
	 * @since 0.1
	 * @see wpdb::check_connection()
	 * @var int
	 */
	protected $reconnect_retries = 5;

	/**
	 * Whether the database queries are ready to start executing.
	 *
	 * @since 0.1
	 * @var bool
	 */
	var $ready = false;

	/**
	 * Service ID.
	 *
	 * @since 0.1
	 * @var int
	 */
	public $pg_service_id = 0;

	/**
	 * Site ID.
	 *
	 * @since 0.1
	 * @var int
	 */
	public $siteid = 0;

	/**
	* Hold service data
	* @since 0.1
	* @var object
	*/
	public $service_data

	/**
	 * List of per-service tables
	 * Plugged-in service set its table array
	 *
	 * @since 0.1
	 * @see wpdb::tables()
	 * @var array
	 */
	public $tables = array();

	/**
	 * List of global tables for all services
	 *
	 * @since 0.1
	 * @see wpdb::tables()
	 * @var array
	 */
	var $global_tables = array( 'users', 'usermeta' );

	/**
	 * List of Multisite global tables
	 *
	 * @since 3.0.0
	 * @see wpdb::tables()
	 * @var array
	 */
	var $ms_global_tables = array( 'blogs', 'signups', 'site', 'sitemeta',
		'sitecategories', 'registration_log', 'blog_versions' );


	/**
	 * Comments table
	 *
	 * @since 0.1
	 * @var string
	 */
	public $comments;

	/**
	 * Comment Metadata table
	 *
	 * @since 0.1
	 * @var string
	 */
	public $commentmeta;


	/**
	 * WordPress Post Metadata table
	 *
	 * @since 1.5.0
	 * @var string
	 */
	public $postmeta;

	/**
	 * WordPress Posts table
	 *
	 * @since 1.5.0
	 * @var string
	 */
	public $posts;

	/**
	 * WordPress Terms table
	 *
	 * @since 2.3.0
	 * @var string
	 */
	public $terms;

	/**
	 * WordPress Term Relationships table
	 *
	 * @since 2.3.0
	 * @var string
	 */
	public $term_relationships;

	/**
	 * WordPress Term Taxonomy table
	 *
	 * @since 2.3.0
	 * @var string
	 */
	public $term_taxonomy;

	/**
	 * WordPress Term Meta table.
	 *
	 * @since 4.4.0
	 * @var string
	 */
	public $termmeta;

	/**
	 * Users table
	 *
	 * @since 1.5.0
	 * @var string
	 */
	public $users;

	/**
	 * User Metadata table
	 *
	 * @since 2.3.0
	 * @var string
	 */
	public $usermeta;

	/**
	 * Multisite Blogs table
	 *
	 * @since 3.0.0
	 * @var string
	 */
	public $blogs;

	/**
	 * Multisite Blog Versions table
	 *
	 * @since 3.0.0
	 * @var string
	 */
	public $blog_versions;

	/**
	 * Registration Log table
	 *
	 * @since 3.0.0
	 * @var string
	 */
	public $registration_log;

	/**
	 * Signups table
	 *
	 * @since 3.0.0
	 * @var string
	 */
	public $signups;

	/**
	 * PayGate Links table
	 *
	 * @since 1.5.0
	 * @var string
	 */
	public $links;

	/**
	 * PayGate Options table
	 *
	 * @since 1.5.0
	 * @var string
	 */
	public $options;

	/**
	 * Multisite Sitewide Terms table
	 *
	 * @since 3.0.0
	 * @var string
	 */
	public $sitecategories;

	/**
	 * Multisite Site Metadata table
	 *
	 * @since 3.0.0
	 * @var string
	 */
	public $sitemeta;


	/**
	 * Format specifiers for DB columns. Columns not listed here default to %s. Initialized during WP load.
	 *
	 * Keys are column names, values are format types: 'ID' => '%d'
	 *
	 * @since 2.8.0
	 * @see wpdb::prepare()
	 * @see wpdb::insert()
	 * @see wpdb::update()
	 * @see wpdb::delete()
	 * @see wp_set_wpdb_vars()
	 * @var array
	 */
	public $field_types = array();

	/**
	 * Database table columns charset
	 *
	 * @since 2.2.0
	 * @var string
	 */
	public $charset;

	/**
	 * Database table columns collate
	 *
	 * @since 2.2.0
	 * @var string
	 */
	public $collate;

	/**
	 * Database Username
	 *
	 * @since 2.9.0
	 * @var string
	 */
	protected $dbuser;

	/**
	 * Database Password
	 *
	 * @since 3.1.0
	 * @var string
	 */
	protected $dbpassword;

	/**
	 * Database Name
	 *
	 * @since 3.1.0
	 * @var string
	 */
	protected $dbname;

	/**
	 * Database Host
	 *
	 * @since 3.1.0
	 * @var string
	 */
	protected $dbhost;

	/**
	 * Database Handle
	 *
	 * @since 0.71
	 * @var string
	 */
	protected $dbh;

	/**
	 * A textual description of the last query/get_row/get_var call
	 *
	 * @since 3.0.0
	 * @var string
	 */
	public $func_call;

	/**
	 * A list of incompatible SQL modes.
	 *
	 * @since 3.9.0
	 * @var array
	 */
	protected $incompatible_modes = array( 'NO_ZERO_DATE', 'ONLY_FULL_GROUP_BY',
		'STRICT_TRANS_TABLES', 'STRICT_ALL_TABLES', 'TRADITIONAL' );

	/**
	 * Whether MySQL is used as the database engine.
	 *
	 * Set in Pgdb::db_connect() to true, by default. This is used when checking
	 * against the required MySQL version for PayGate. setting this to true
	 * will force the checks to occur.
	 *
	 * @since 3.3.0
	 * @var bool
	 */
	public $is_mysql = null;

	/**
	 * Whether to use mysqli over mysql.
	 *
	 * @since 0.1
	 * @var bool
	 */
	private $use_mysqli = false;

	/**
	 * Whether we've managed to successfully connect at some point
	 *
	 * @since 0.1
	 * @var bool
	 */
	private $has_connected = false;

	/**
	 * Connects to the database server and selects a database
	 *
	 * PHP5 style constructor for compatibility with PHP5. Does
	 * the actual setting up of the class properties and connection
	 * to the database.
	 *
	 * @link https://core.trac.wordpress.org/ticket/3354
	 * @since 2.0.8
	 *
	 * @global string $wp_version
	 *
	 * @param string $dbuser     MySQL database user
	 * @param string $dbpassword MySQL database password
	 * @param string $dbname     MySQL database name
	 * @param string $dbhost     MySQL database host
	 */

	public function __construct($dbuser, $dbpassword, $dbname, $dbhost){
		register_shutdown_function( array( $this, '__destruct' ) );

		if(PG_DEBUG && PG_DEBUG_DISPLAY)
			$this->show_errors();

		//use ext/mysqli if it exists unless WP_USE_EXT_MYSQL is defined as true
		if( function_exists('mysqli_connect') ){
			$this->use_mysqli = true;

			if( defined('USE_EXT_MYSQL') ){
				$this->use_mysqli = ! USE_EXT_MYSQL;
			}
		}

		$this->dbuser = $dbuser;
		$this->dbpassword = $dbpassword;
		$this->dbname = $dbname;
		$this->dbhost = $dbhost;

		$this->db_connect();

	}

	/**
	 * PHP5 style destructor and will run when database object is destroyed.
	 *
	 * @see pgdb::__construct()
	 * @since 0.1
	 * @return true
	 */
	public function __destruct() {
		return true;
	}

	/**
	 * Enables showing of database errors.
	 *
	 * This function should be used only to enable showing of errors.
	 * wpdb::hide_errors() should be used instead for hiding of errors. However,
	 * this function can be used to enable and disable showing of database
	 * errors.
	 *
	 * @since 0.1
	 * @see wpdb::hide_errors()
	 *
	 * @param bool $show Whether to show or hide errors
	 * @return bool Old value for showing errors.
	 */
	public function show_errors( $show = true ) {
		$errors = $this->show_errors;
		$this->show_errors = $show;
		return $errors;
	}

	/**
	 * Connect to and select database.
	 *
	 * If $allow_bail is false, the lack of database connection will need
	 * to be handled manually.
	 *
	 * @since 3.0.0
	 * @since 3.9.0 $allow_bail parameter added.
	 *
	 * @param bool $allow_bail Optional. Allows the function to bail. Default true.
	 * @return bool True with a successful connection, false on failure.
	 */

	public function db_connect($allow_bail = true){
		$this->is_mysql =true;

		$new_link = defined( 'MYSQL_NEW_LINK' ) ? MYSQL_NEW_LINK : true;
		$client_flag = defined( 'MYSQL_CLIENT_FLAGS' ) ? MYSQL_CLIENT_FLAGS : 0;


		if( $this->use_mysqli ){

			$this->dbh = mysqli_init();

			$host    = $this->dbhost;
			$port    = null;
			$socket  = null;
			$is_ipv6 = false;

			if($host_data = $this->parse_db_host($this->dbhost) ){
				list( $host, $port, $socket, $is_ipv6 ) = $host_data ;
			}

			/*
			 * If using the `mysqlnd` library, the IPv6 address needs to be
			 * enclosed in square brackets, whereas it doesn't while using the
			 * `libmysqlclient` library.
			 * @see https://bugs.php.net/bug.php?id=67563
			 */
			if ( $is_ipv6 && extension_loaded( 'mysqlnd' ) ) {
				$host = "[$host]";
			}

			if(PG_DEBUG){
				mysqli_real_connect($this->dbh, $this->dbhost, $this->dbuser, $this->dbpassword, null, $port, $socket, $client_flags );
			}else{
				@mysqli_real_connect($this->dbh, $this->dbhost, $this->dbuser, $this->dbpassword, null, $port, $socket, $client_flags );
			}

			if($this->dbh->connect_errno){
				$this->dbh = null;

				/*
				 * It's possible ext/mysqli is misconfigured. Fall back to ext/mysql if:
		 		 *  - We haven't previously connected, and
		 		 *  - WP_USE_EXT_MYSQL isn't set to false, and
		 		 *  - ext/mysql is loaded.
		 		 */

				$attempt_fallback = true;

				if($this->hasconnected){
					$attempt_fallback = false;
				}elseif( defined('USE_EXT_MYSQL') && ! USE_EXT_MYSQL ){
					$attempt_fallback = false;
				}elseif( ! function_exists('mysql_connect')){ 
					$attempt_fallback = false;
				}
			}

			if($attempt_fallback){
				$this->use_mysqli = false;
				$this->db_connect($allow_bail);
			}


		}else{
			if ( PG_DEBUG ) {
				$this->dbh = mysql_connect( $this->dbhost, $this->dbuser, $this->dbpassword, $new_link, $client_flags );
			} else {
				$this->dbh = @mysql_connect( $this->dbhost, $this->dbuser, $this->dbpassword, $new_link, $client_flags );
			}
		}



	}

	/**
	 * Parse the DB_HOST setting to interpret it for mysqli_real_connect.
	 *
	 * mysqli_real_connect doesn't support the host param including a port or
	 * socket like mysql_connect does. This duplicates how mysql_connect detects
	 * a port and/or socket file.
	 *
	 * @since 0.1
	 * @param string $host The DB_HOST setting to parse.
	 * @return array|bool Array containing the host, the port, the socket and whether
	 *                    it is an IPv6 address, in that order. If $host couldn't be parsed,
	 *                    returns false.
	 *
	 */

	public function parse_db_host($host){

		$port =    null;
		$socket =  null;
		$is_ipv6 = false;

		/**
		* A fall back pattern by Stephen Ryan
		* IPv6 regex from Stephen Ryan
		* Recognizes most of the ipv6 format according to RFC5952
		* @link http://intermapper.com
		*/  

		$ryan_pattern = '/^\s*((([0-9A-Fa-f]{1,4}:){7}([0-9A-Fa-f]{1,4}|:))|
					(([0-9A-Fa-f]{1,4}:){6}(:[0-9A-Fa-f]{1,4}|((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|
					(([0-9A-Fa-f]{1,4}:){5}(((:[0-9A-Fa-f]{1,4}){1,2})|:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|
					(([0-9A-Fa-f]{1,4}:){4}(((:[0-9A-Fa-f]{1,4}){1,3})|((:[0-9A-Fa-f]{1,4})?:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|
					(([0-9A-Fa-f]{1,4}:){3}(((:[0-9A-Fa-f]{1,4}){1,4})|((:[0-9A-Fa-f]{1,4}){0,2}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|
					(([0-9A-Fa-f]{1,4}:){2}(((:[0-9A-Fa-f]{1,4}){1,5})|((:[0-9A-Fa-f]{1,4}){0,3}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|
					(([0-9A-Fa-f]{1,4}:){1}(((:[0-9A-Fa-f]{1,4}){1,6})|((:[0-9A-Fa-f]{1,4}){0,4}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|
					(:(((:[0-9A-Fa-f]{1,4}){1,7})|((:[0-9A-Fa-f]{1,4}){0,5}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:)))(%.+)?\s*$/' ;
		
		
		// First peel off the socket parameter from the right, if it exists.
		$socket_pos = strpos( $host, ':/' );
		if ( $socket_pos !== false ) {
			$socket = substr( $host, $socket_pos + 1 );
			$host = substr( $host, 0, $socket_pos );
		}

		if( substr_count($host, ':') > 1 ){
			$pattern = '#^(?:\[)?(?P<host>[0-9a-fA-F:]+)(?:\]:(?P<port>[\d]+))?#';
			$is_ipv6 = true;
		}elseif( !(substr_count($host, ':' ) > 1) ){
			$pattern = $ryan_pattern ;
			$is_ipv6 = true;
		}else{
			// Seems like we are working with IPv4 
			$pattern = '#^(?P<host>[^:/]*)(?::(?P<port>[\d]+))?#';
		}

		$matches = array();
		$result = preg_match( $pattern, $host, $matches );

		if ( 1 !== $result ) {
			// Couldn't parse the address, bail.
			return false;
		}


		$host = '';
		foreach ( array( 'host', 'port' ) as $component ) {
			if ( ! empty( $matches[ $component ] ) ) {
				$$component = $matches[ $component ];
			}
		}

		return array( $host, $port, $socket, $is_ipv6 );

	}



}


?>