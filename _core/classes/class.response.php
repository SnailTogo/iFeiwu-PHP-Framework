<?php 

/**
 * Primal Request Object
 * Some functions in this class are based on https://github.com/chriso/klein.php
 *
 * @package Primal.Request
 */

class Response {
	
	const CONTINUE_ = 100; // Underscore is due to continue being a reserved word.
	const SWITCHING_PROTOCOLS = 101;
	
	// Successful
	const OK = 200;
	const CREATED = 201;
	const ACCEPTED = 202;
	const NONAUTHORITATIVE_INFORMATION = 203;
	const NO_CONTENT = 204;
	const RESET_CONTENT = 205;
	const PARTIAL_CONTENT = 206;
	
	// Redirections
	const MULTIPLE_CHOICES = 300;
	const MOVED_PERMANENTLY = 301;
	const FOUND = 302;
	const SEE_OTHER = 303;
	const NOT_MODIFIED = 304;
	const USE_PROXY = 305;
	const UNUSED= 306;
	const TEMPORARY_REDIRECT = 307;
	
	// Client Errors
	const BAD_REQUEST = 400;
	const UNAUTHORIZED  = 401;
	const PAYMENT_REQUIRED = 402;
	const FORBIDDEN = 403;
	const NOT_FOUND = 404;
	const METHOD_NOT_ALLOWED = 405;
	const NOT_ACCEPTABLE = 406;
	const PROXY_AUTHENTICATION_REQUIRED = 407;
	const REQUEST_TIMEOUT = 408;
	const CONFLICT = 409;
	const GONE = 410;
	const LENGTH_REQUIRED = 411;
	const PRECONDITION_FAILED = 412;
	const REQUEST_ENTITY_TOO_LARGE = 413;
	const REQUEST_URI_TOO_LONG = 414;
	const UNSUPPORTED_MEDIA_TYPE = 415;
	const REQUESTED_RANGE_NOT_SATISFIABLE = 416;
	const EXPECTATION_FAILED = 417;
	const I_AM_A_TEA_POT = 418; // http://tools.ietf.org/html/rfc2324
	
	// Server Errors
	const INTERNAL_SERVER_ERROR = 500;
	const NOT_IMPLEMENTED = 501;
	const BAD_GATEWAY = 502;
	const SERVICE_UNAVAILABLE = 503;
	const GATEWAY_TIMEOUT = 504;
	const VERSION_NOT_SUPPORTED = 505;
	
	
	/**
	 * HTTP Response Code Header Messages, used by statusCode().
	 *
	 * @author Jarvis Badgley
	 */
	private static $messages = array(
		// Informational
		100=>'100 Continue',
		101=>'101 Switching Protocols',
		
		// Successful
		200=>'200 OK',
		201=>'201 Created',
		202=>'202 Accepted',
		203=>'203 Non-Authoritative Information',
		204=>'204 No Content',
		205=>'205 Reset Content',
		206=>'206 Partial Content',
		
		// Redirection
		300=>'300 Multiple Choices',
		301=>'301 Moved Permanently',
		302=>'302 Found',
		303=>'303 See Other',
		304=>'304 Not Modified',
		305=>'305 Use Proxy',
		306=>'306 (Unused)',
		307=>'307 Temporary Redirect',
		
		// Client Error
		400=>'400 Bad Request',
		401=>'401 Unauthorized',
		402=>'402 Payment Required',
		403=>'403 Forbidden',
		404=>'404 Not Found',
		405=>'405 Method Not Allowed',
		406=>'406 Not Acceptable',
		407=>'407 Proxy Authentication Required',
		408=>'408 Request Timeout',
		409=>'409 Conflict',
		410=>'410 Gone',
		411=>'411 Length Required',
		412=>'412 Precondition Failed',
		413=>'413 Request Entity Too Large',
		414=>'414 Request-URI Too Long',
		415=>'415 Unsupported Media Type',
		416=>'416 Requested Range Not Satisfiable',
		417=>'417 Expectation Failed',
		418=>'418 I\'m a teapot',
		
		// Server Error
		500=>'500 Internal Server Error',
		501=>'501 Not Implemented',
		502=>'502 Bad Gateway',
		503=>'503 Service Unavailable',
		504=>'504 Gateway Timeout',
		505=>'505 HTTP Version Not Supported'
	);

	/**
	 * Checks if the request is secured (HTTPS) and redirects if it isn't.
	 *
	 * @param boolean $required 
	 * @return boolean
	 */
    public static function secure() {
		if (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS'])==='on') return;
		header("Location: https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}");
    }


	/**
	 * Sets a response header
	 *
	 * @param string $key Header name
	 * @param string $value Header value
	 * @return void
	 */
	public static function header($key, $value = '') {
	    $key = str_replace(' ', '-', ucwords(str_replace('-', ' ', $key)));
	    header("$key: $value");
	}

	/**
	 * Tell the browser not to cache the response
	 *
	 * @return void
	 */
    public static function noCache() {
        header("Pragma: no-cache");
        header('Cache-Control: no-store, no-cache');
    }

	/**
	 * Gets/Sets the HTTP status header to match the passed code. Recommended using the class constants to define the code.
	 *
	 * @param integer
	 * @return void
	 **/
	protected static function statusCode($code=null) {
		static $current_status;
		
		if ($code) {
            $protocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0';
			$current_status = $code;
			header($protocol. ' ' . static::$messages[$code]);
		}
		return $current_status?:200;
	}


	/**
	 * Sets content type to json data and sends the passed array as the body content.
	 *
	 * @param mixed The array or object to send.
	 * @return void
	 **/
	public static function json($object, $callback = null) {
		header('Content-type: application/json');
		$json = json_encode($object);
		if ($callback) echo ";$callback($json);";
		else echo $json;
		exit;
	}
	
	
	/**
	 * Sends a location header and terminates the controller, redirecting the browser to a new location.
	 *
	 * @param string URL to redirect to. Defaults to the current url if omitted.
	 * @param integer HTTP Status Code. Defaults to 302 Found
	 * @return void
	 **/
	public static function redirect($url=".", $code = 302) {
		static::statusCode($code);
		if ($url=='.') $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
		header("Location: {$url}");
		exit;
	}
	
}