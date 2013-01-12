<?PHP

/*!
* OpenTok PHP Library
* http://www.tokbox.com/
*
* Copyright 2010, TokBox, Inc.
*
* Last modified: 2011-08-26
*/

global $CONFIG;
//require_once 'API_Config.php';
//require_once 'OpenTokSession.php';
	require_once($CONFIG->pluginspath . "videochat/vendors/opentok-php-sdk.2011-08-26/API_Config.php");
	require_once($CONFIG->pluginspath . "videochat/vendors/opentok-php-sdk.2011-08-26/OpenTokSession.php");

//Generic OpenTok exception. Read the message to get more details
class OpenTokException extends Exception { };
//OpenTok exception related to authentication. Most likely an issue with your API key or secret
class AuthException extends OpenTokException { };
//OpenTok exception related to the HTTP request. Most likely due to a server error. (HTTP 500 error)
class RequestException extends OpenTokException { };

class RoleConstants {
    const SUBSCRIBER = "subscriber"; //Can only subscribe
    const PUBLISHER = "publisher";   //Can publish, subscribe, and signal
    const MODERATOR = "moderator";   //Can do the above along with  forceDisconnect and forceUnpublish
};

class OpenTokSDK {

	private $api_key;

	private $api_secret;

	public function __construct($api_key, $api_secret) {
		$this->api_key = $api_key;
		$this->api_secret = trim($api_secret);
	}

	/** - Generate a token
	 *
	 * $session_id  - If session_id is not blank, this token can only join the call with the specified session_id.
	 * $role        - One of the constants defined in RoleConstants. Default is publisher, look in the documentation to learn more about roles.
	 * $expire_time - Optional timestamp to change when the token expires. See documentation on token for details.
	 */
    public function generate_token($session_id='', $role='', $expire_time=NULL, $connection_data='') {
		$create_time = time();

		$nonce = microtime(true) . mt_rand();

		if(!$role) {
			$role = RoleConstants::PUBLISHER;
		}

		$data_string = "session_id=$session_id&create_time=$create_time&role=$role&nonce=$nonce";
        if(!is_null($expire_time))
			$data_string .= "&expire_time=$expire_time";
		if($connection_data != '') {
			$data_string .= "&connection_data=" . urlencode($connection_data);
		}

        $sig = $this->_sign_string($data_string, $this->api_secret);
		$api_key = $this->api_key;
		$sdk_version = API_Config::SDK_VERSION;

        return "T1==" . base64_encode("partner_id=$api_key&sdk_version=$sdk_version&sig=$sig:$data_string");
	}

	/**
	 * Creates a new session.
	 * $location - IP address to geolocate the call around.
	 * $properties - Optional array, keys are defined in SessionPropertyConstants
	 */
    public function create_session($location, $properties=array()) {
		$properties["location"] = $location;
		$properties["api_key"] = $this->api_key;

        $createSessionResult = $this->_do_request("/session/create", $properties);
        $createSessionXML = @simplexml_load_string($createSessionResult, 'SimpleXMLElement', LIBXML_NOCDATA);
		if(!$createSessionXML) {
			throw new OpenTokException("Failed to create session: Invalid response from server");
		}

		$errors = $createSessionXML->xpath("//error");
		if($errors) {
			$errMsg = $errors[0]->xpath("//@message");
			if($errMsg) {
				$errMsg = (string)$errMsg[0]['message'];
			} else {
				$errMsg = "Unknown error";
			}
			throw new AuthException("Error " . $createSessionXML->error['code'] ." ". $createSessionXML->error->children()->getName() . ": " . $errMsg );
		}
		if(!isset($createSessionXML->Session->session_id)) {
			throw new OpenTokException("Failed to create session.");
		}
		$sessionId = $createSessionXML->Session->session_id;

		return new OpenTokSession($sessionId, null);
	}

    //////////////////////////////////////////////
    //Signing functions, request functions, and other utility functions needed for the OpenTok
    //Server API. Developers should not edit below this line. Do so at your own risk.
    //////////////////////////////////////////////

	protected function _sign_string($string, $secret) {
		return hash_hmac("sha1", $string, $secret);
	}

	protected function _do_request($url, $data) {
		$url = API_Config::API_SERVER . $url;

		$dataString = "";
		foreach($data as $key => $value){
			$value = urlencode($value);
			$dataString .= "$key=$value&";
		}

		$dataString = rtrim($dataString,"&");

		//Use file_get_contents if curl is not available for PHP
		if(function_exists("curl_init")) {            
			$ch = curl_init();

			$api_key = $this->api_key;
			$api_secret = $this->api_secret;

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, Array('Content-type: application/x-www-form-urlencoded'));
			curl_setopt($ch, CURLOPT_HTTPHEADER, Array("X-TB-PARTNER-AUTH: $this->api_key:$this->api_secret"));
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

			$res = curl_exec($ch);
			if(curl_errno($ch)) {
				throw new RequestException('Request error: ' . curl_error($ch));
			}

			curl_close($ch);
		}
		else {        
			if (function_exists("file_get_contents")) {
				$context_source = array ('http' => array (
										'method' => 'POST',
										'header'=> "Content-type: application/x-www-form-urlencoded\n"
										."X-TB-PARTNER-AUTH: $this->api_key:$this->api_secret\n"
										. "Content-Length: " . strlen($dataString) . "\n",
										'content' => $dataString
										)
									);
				$context = stream_context_create($context_source);
				$res = @file_get_contents( $url ,false, $context);                
			}
			else{
				throw new RequestException("Your PHP installion neither supports the file_get_contents method nor cURL. Please enable one of these functions so that you can make API calls.");
			}        
		}        
		return $res;
	}
}
