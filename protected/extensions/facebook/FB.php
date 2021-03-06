<?php
/**
 * Wrapper component around Facebook library
 */

// Require rather than import because of facebook file name case mismatching.
require_once(Yii::getPathOfAlias('ext.facebook.sdk') . '/facebook.php');

class FB extends CApplicationComponent {

	/**
	 * @var string Facebook application id.
	 */
	public $appID;
	
	/**
	 * @var string Facebook application secret.
	 */
	public $appSecret;
	
	/**
	 * @var string the application namespace.
	 */
	public $appNamespace;
	
	/**
	 * @var boolean whether file uploads are enabled.
	 */
	public $isFileUploadEnabled;

	/**
	 * @var string comma separated list of additional permissions to ask of users
	 */
	public $scope;

	/**
	 * @var string the path to the location where facebook views are stored.
	 * Defaults to 'application.views.facebook'.
	*/
	public $viewPath = 'application.views.facebook';

	protected $_facebook;

	/**
	 * Initializes this component.
	 */
	public function init()
	{
		$config = array(
			'appId' => $this->appID,
			'secret' => $this->appSecret
		);

		if (!is_null($this->isFileUploadEnabled)) {
			$config['isFileUploadEnabled'] = $this->isFileUploadEnabled;
		}

		$this->_facebook = new Facebook($config);
	}

	/**
	 * Registers an Open Graph action with Facebook.
	 * @param string $action the action to register.
	 * @param array $params the query parameters.
	 */
	public function registerAction($action, $params=array())
	{
		$id = $this->currentUserFacebookId;
		$this->api($id . '/'.$this->appNamespace.':'.$action, $params);
	}

	/**
	 * Calls the Facebook API.
	 * @param string $query the query to send.
	 * @param array $params the query parameters.
	 * @return array the response.
	 */
	protected function api($query, $params=array())
	{
		$data = array();

		if ($params !== array()) {
			$query .= '?'.http_build_query($params);
		}

		try {
			$data = $this->_facebook->api('/'.$query);
			Yii::trace(
				CVarDumper::dumpAsString($query)
				. " with params: " . CVarDumper::dumpAsString($params)
				. PHP_EOL . "   returns: " 
				. CVarDumper::dumpAsString($data)
				, 'facebook');
		}
		catch (FacebookApiException $e)
		{
			throw new CException('Facebook api exception: '
				. PHP_EOL . $e->getMessage()
				. PHP_EOL . 'Query:  ' . CVarDumper::dumpAsString($query)
				. PHP_EOL . 'Params: ' . CVarDumper::dumpAsString($params)
				, $e->getCode());
		}

		return $data;
	}

	/**
	 * Calls the Facebook API with a POST command.
	 * @param string $query the query to send.
	 * @param array $params the query parameters.
	 * @return array the response.
	 */
	protected function post($query, $params) {
		try {
			$data = $this->_facebook->api('/'.$query, 'POST', $params);
			Yii::trace(
				CVarDumper::dumpAsString($query)
				. " with params: " . CVarDumper::dumpAsString($params)
				. PHP_EOL . "   returns: " 
				. CVarDumper::dumpAsString($data)
				, 'facebook');
		}
		catch (FacebookApiException $e)
		{
			throw new CException('Facebook post exception: '
				. PHP_EOL . $e->getMessage()
				. PHP_EOL . 'Query:  ' . CVarDumper::dumpAsString($query)
				. PHP_EOL . 'Params: ' . CVarDumper::dumpAsString($params)
				, $e->getCode());
		}

		return $data;
	}

	/**
	 * Returns the locale based on the application language.
	 * @return string the locale.
	 */
	public function getLocale()
	{
		$language = Yii::app()->language;

		if ($language !== null)
		{
			$pieces = explode('_', $language);
			if (count($pieces) === 2)
				return $pieces[0].'_'.strtoupper($pieces[1]);
		}

		return 'en_US';
	}

	/**
	 * Returns the Facebook application instance.
	 * @return Facebook the instance.
	 */
	protected function getFacebook()
	{
		return $this->_facebook;
	}

	public function logout() {
		$this->facebook->destroySession();
	}

	/**
	* Renders a facebook view.  Facebook view files should end with '.facebook.php'
	* 
	* @param string view alias for body of view
	* @param array the data of the message.  If a $view is set and this 
	* is a string, this is passed to the view as $data.  If $view is set 
	* and this is an array, the array values are passed to the view like in the 
	* controller render() method
	* @return string rendered view
	*/
	public function renderView($view, $data = null) {
		
		// if Yii::app()->controller doesn't exist create a dummy 
		// controller to render the view (needed in the console app)
		if(isset(Yii::app()->controller)) {
			$controller = Yii::app()->controller;
		}
		else {
			$controller = new CController('FB');
		}

		$data = array_merge($data, array('FB'=>$this)); // append email data to data
		
		// renderPartial won't work with CConsoleApplication, so use 
		// renderInternal - this requires that we use an actual path to the 
		// view rather than the usual alias
		$viewPath = Yii::getPathOfAlias($this->viewPath.'.'.$view).'.facebook.php';
		$output = $controller->renderInternal($viewPath, $data, true);	

		return $output;
	}

	public function getLoginUrl() {
		return $this->facebook->getLoginUrl(array(
			'redirect_uri'=>$this->redirectURI,
			'scope'=>$this->scope,
		));
	}

	/** 
	 * @return string url to oauth landing pages passed as part of loging attempt
	 * @see https://developers.facebook.com/apps 'Website with Facebook Login'
	 **/
	public function getRedirectURI() {
		return Yii::app()->createAbsoluteUrl('site/login');
	}

	// FACEBOOK WRAPPERS

	/**
	 * Get the application or user access token from FB
	 * @return string
	 **/
	public function getAccessToken() {
		return $this->facebook->getAccessToken();
	}

	/**
	 * Gets the current user's facebook id from Facebook
	 * Note: this kicks off massive side-effects (like, signing the user in)
	 * @return int|null the current user's facebook id
	 **/
	public function getCurrentUserFacebookId() {
		return $this->facebook->getUser();
	}

	/**
	 * Maps to facebook/me
	 * @return array
	 **/
	public function getCurrentUserDetails() {
		$id = $this->currentUserFacebookId;
		return $this->api($id);
	}

	/**
	 * Maps to facebook/me/groups
	 * @return array
	 **/
	public function getCurrentUserGroups() {
		$id = $this->currentUserFacebookId;
		return $this->api($id . '/groups');
	}

	/**
	 * Get the image url of the user
	 * @return string absolute url of image file
	 **/
	public function getCurrentUserPictureURL() {
		$id = $this->currentUserFacebookId;
		return "https://graph.facebook.com/{$id}/picture";
	}

	public function getUserPictureURL($facebookId) {
		return "https://graph.facebook.com/{$facebookId}/picture";
	}

	/**
	 * Maps to facebook/<groupId>/picture
	 * @return string absolute url of image file
	 **/
	public function getGroupPictureURL($groupFacebookId) {
		return "https://graph.facebook.com/{$groupFacebookId}/picture";
	}

	/**
	 * Maps to facebook/<groupId>/members
	 * @return array
	 **/
	public function getGroupMembers($groupFacebookId) {
		return $this->api("{$groupFacebookId}/members");	
	}

	public function addGroupPost($groupFacebookId, $params) {
		if(StringUtils::isBlank($groupFacebookId)) {
			throw new Exception("Group id is not set.");
		}

		return $this->post($groupFacebookId . '/feed', $params);
	}

	public function addPostComment($postId, $params) {
		return $this->post($postId . '/comments', $params);
	}

	public function getPostComments($postId) {
		$comments = array();
		$response = $this->api($postId . '/comments');

		foreach($response['data'] as $commentData) {
			$comment = new FacebookComment();
			$comment->id = $commentData['id'];
			$comment->authorFacebookId = $commentData['from']['id'];
			$comment->authorFullName = $commentData['from']['name'];
			$comment->message = $commentData['message'];
			$comment->created = $commentData['created_time'];

			$comments[] = $comment;
		}

		return $comments;
	}
}