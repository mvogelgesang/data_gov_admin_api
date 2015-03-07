<?php 

/**
 * @file
 * Contains the client class for communicating with the api.data.gov api umbrella.
 * version 0.1
 */

require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Stream\Stream;

class ApiDataGovClient extends Client {

  protected $xApiKey = NULL;
  protected $xAdminAuthToken = NULL;
  protected $apiUrl = 'http://api.data.gov/api-umbrella/v1/';

  /**
   * Constructor.
   * 
   * @param string $xApiKey
   *   An api.data.gov api key that is granted to your user.
   *
   * @param string $xAdminAuthToken
   *   Admin Authorization Token provided by api.data.gov admin accounts.
   */
  public function __construct($xApiKey, $xAdminAuthToken) {
  	parent::__construct(['base_url' => $this->apiUrl]);
    $this->xApiKey = $xApiKey;
    $this->xAdminAuthToken = $xAdminAuthToken;
    $this->setDefaultOption('headers', array(
    	'X-Api-Key' => $this->xApiKey,
			'X-Admin-Auth-Token' => $this->xAdminAuthToken,
      'Content-Type' => 'application/json',
      'Accept' => 'text/*'
		));
  }

  /**
   * Requests a list of all users
   *
   * @return array
   *   The response, including results.
   */
  public function getUsers() {
    $request = $this->createRequest('GET','users');

    $response = $this->send($request);
    $data = $response->json();

    return $data;
  }

  /**
   * Requests a given user.
   *
   * @param string $id
   *   The user id as provided by api.data.gov
   *
   * @return array
   *   The response, including results.
   */
  public function getUser($id) {

    // @todo Add ability to include 'sort_by' parameter.
    $request = $this->createRequest('GET','users/' . $id);

    $response = $this->send($request);
    $data = $response->json();

    return $data;
  }

	/**
	 * Creates an API User
	 *
	 * @param string $email
	 *   The users e-mail address
	 *
	 * @param string $fname
	 *   The users first name
	 *
	 * @param string $lname
	 *   The users last name
	 *
	 * @param string $use_description
	 *   Description of how the user will utilize the API
	 *
	 * @param boolean $t_and_c
	 *   Does the user agree to the terms and conditions?
	 *
	 * @param boolean $send_welcome_email
	 *   Have api.data.gov send a welcome e-mail to the user
	 *
	 * @param boolean $throttle_by_ip
	 *   Throttle requests by IP address
	 *
	 * @param array $roles
	 *   Roles that the user should be granted
	 *
	 * @param boolean $enabled
	 *   Enable the account?
	 *
	 * @return array
	 *   The response, including results
	 */
  public function createUser($email, $fname, $lname, $use_description, $t_and_c = true, $send_welcome_email = false, $throttle_by_ip = false, $roles = array(), $enabled = true) {
  	$body = array( 
  		"user" => array(
  			"email" => $email,
  			"first_name" => $fname,
    		"last_name" => $lname,
		    "use_description" => $use_description,
		    "terms_and_conditions" => $t_and_c,
		    "send_welcome_email" => $send_welcome_email,
		    "throttle_by_ip" => $throttle_by_ip,
		    "roles" => $roles,
		    "enabled" => $enabled,
		    "settings" => array (
		      "rate_limit_mode" => null,
		      "rate_limits" => array(),
		    ),
	  )); 
  	
	  $request = $this->createRequest('POST','users');
  	$request->setBody(Stream::factory(json_encode($body)));

  	$response = $this->send($request);
    $data = $response->json();

    return $data;
  }

  /**
	 * Updates an API User
	 *
	 * @param string $id
	 *   The users unique ID
	 *
	 * @param array $updateArray
	 *   Key value pairs matching user object fields
	 *
	 * @return array
	 *   The response, including results
	 */
  public function updateUser($id, $updateArray) {
  	$body = array( 
  		"user" => $updateArray
    ); 
	  $request = $this->createRequest('PUT','users/' . $id);
  	$request->setBody(Stream::factory(json_encode($body)));
  	$response = $this->send($request);
    $data = $response->json();

    return $data;
  }

  /**
   * Retrieves a list of API's or a specific API
   *
   * @return array
   *  The response, including results
   */
  public function getApis($apiId=null) {
    $id = null;
    if (!empty($apiId)) {
      $id = '/' . $apiId;
    }
    $request = $this->createRequest('GET', 'apis' . $id);
    $request->setBody(Stream::factory(json_encode($body)));
    $response = $this->send($request);
    $data = $response->json();

    return $data;
  }

  /**
   * Updates a given API
   *
   * @param string $id
   *   Unique ID of the api to update
   *
   * @param array $updateArray
   *   Key value pairs matching API object fields
   *
   * @return array
   *   The response, including results
   */
  public function updateApi($apiId, $updateArray) {
    $body = array( 
      "api" => $updateArray
    ); 
    $request = $this->createRequest('PUT', 'apis/' . $apiId);
    $request->setBody(Stream::factory(json_encode($body)));
    $response = $this->send($request);
    $data = $response->json();

    return $data;
  }
}
