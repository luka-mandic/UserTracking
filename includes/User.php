<?php

class User extends Database{

	protected $ip;
	protected $browser;
	protected $browser_version;
	protected $os;
	protected $country;
	protected $city;
	protected $page_visits = 0;

	public function getLocationInfoByIp() {
	    $client  = @$_SERVER['HTTP_CLIENT_IP'];
	    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	    $remote  = @$_SERVER['REMOTE_ADDR'];
	    $result  = array('country'=>'', 'city'=>'');
	    if(filter_var($client, FILTER_VALIDATE_IP)) {
	        $this->ip = $client;
	    }
	    elseif(filter_var($forward, FILTER_VALIDATE_IP)) {
	        $this->ip = $forward;
	    }
	    else {
	        $this->ip = $remote;
	    }
	    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$this->ip));    
	    if($ip_data && $ip_data->geoplugin_countryName != null) {
	        $result['country'] = $ip_data->geoplugin_countryName;
	        $result['city'] = $ip_data->geoplugin_city;
	    }
	    $this->country =  $result['country'];
	    $this->city =  $result['city'];
	}

	/*
	* In order for get_browser() to work, your browscap configuration setting in php.ini must point to the correct location of the browscap.ini file on your system.
	* browscap.ini is not bundled with PHP, but you may find an up-to-date php_browscap.ini file here:
	* http://browscap.org/
	*
	*/
	public function getBrowserInfo() {

		$browser = get_browser(null, true);
		$this->browser = $browser['browser'];
		$this->browser_version = $browser['version'];
	}

	public function getOSInfo() { 

	    $user_agent = $_SERVER['HTTP_USER_AGENT'];

	    $os_platform = "Unknown OS Platform";

	    $os_array = array(

	        '/windows nt 10.0/i'    =>  'Windows 10',
	        '/windows nt 6.2/i'     =>  'Windows 8',
	        '/windows nt 6.1/i'     =>  'Windows 7',
	        '/windows nt 6.0/i'     =>  'Windows Vista',
	        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
	        '/windows nt 5.1/i'     =>  'Windows XP',
	        '/windows xp/i'         =>  'Windows XP',
	        '/windows nt 5.0/i'     =>  'Windows 2000',
	        '/windows me/i'         =>  'Windows ME',
	        '/win98/i'              =>  'Windows 98',
	        '/win95/i'              =>  'Windows 95',
	        '/win16/i'              =>  'Windows 3.11',
	        '/macintosh|mac os x/i' =>  'Mac OS X',
	        '/mac_powerpc/i'        =>  'Mac OS 9',
	        '/linux/i'              =>  'Linux',
	        '/ubuntu/i'             =>  'Ubuntu',
	        '/iphone/i'             =>  'iPhone',
	        '/ipod/i'               =>  'iPod',
	        '/ipad/i'               =>  'iPad',
	        '/android/i'            =>  'Android',
	        '/blackberry/i'         =>  'BlackBerry',
	        '/webos/i'              =>  'Mobile'
	    );

	    foreach ($os_array as $regex => $value) { 

	        if (preg_match($regex, $user_agent)) {
	            $os_platform = $value;
	        }

	    }   

	    $this->os = $os_platform;

	}
	public function getUsers() {

		$result = $this->mysqli->query("SELECT * FROM users");
		return $result;
                                                                 
	}

	public function saveUser() {

		$this->mysqli->query("INSERT INTO users(IP_address, browser, browser_version, os, country, city) 
        VALUES('$this->ip','$this->browser','$this->browser_version', '$this->os', '$this->country','$this->city')");
                                                                 
	}

	public function isUnique() {
		$result = $this->mysqli->query("SELECT IP_address FROM users WHERE IP_address = '$this->ip'");
		if($result->num_rows > 0) {
			$this->mysqli->query("UPDATE users SET visits = visits + 1 WHERE IP_address = '$this->ip'");
		}
		else{
			return true;
		}

	}
}