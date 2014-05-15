<?php

class GoogleClient extends Singleton
{
	private static $isAuthenticated = false;
	private $userInfoService;
	
	protected function __construct()
	{
		$client = new Google_Client();
		$client->setClientId('778414904778-e2gerbsjlim3vqahfigo4fq604n5vlc5.apps.googleusercontent.com');
		$client->setClientSecret('7abZIVQJYWH0DydfgX1W6_iE');
		$client->setRedirectUri('http://localhost/phonebook/?p=console');							// this will change here and on the Google Developer Console
		$client->setScopes(array('https://www.googleapis.com/auth/userinfo.email',
									'https://www.googleapis.com/auth/userinfo.profile'
									));
		$client->setUseObjects(true);

		//TODO: If protocol is not HTTPS, redirect to same address with HTTPS.
		//TODO: Next, define 'User' cookie with HTTPS Only so it is not even sent if not on an authorized page
		
		$userinfoService = new Google_Oauth2Service($client);
		
		$failedAuthentication = false;
		if (isset($_GET['code']) && !isset($_COOKIE["user"]))
		{
			try
			{
				$accessToken = $client->authenticate($_GET['code']);
						
				setcookie("user", json_encode(array(
					'tokens' => $accessToken
					)), 0, "/", "", false, true);
			}
			catch (Exception $e)
			{
				$failedAuthentication = true;
			}
		}
		if (isset($_COOKIE["user"]))
		{
			$accessToken = json_decode($_COOKIE["user"])->tokens;
		}
		else if (!isset($_GET['code']) || $failedAuthentication)
		{
			$authUrl = $client->createAuthUrl();
			
			header('Location: '.$authUrl);
		}

		$client->setAccessToken($accessToken);
		
		$this->userinfoService = $userinfoService;

		self::$isAuthenticated = true;
	}
	
	//this method should not trigger instantiation
	public static function signout()
	{
		setcookie("user", false, time()-3600, "/", "", false, true);
	}
	
	// this is the only method which will trigger instantiation
	protected function authenticate()
	{
		return $this->userinfoService->userinfo->get()->email;
	}
}

?>