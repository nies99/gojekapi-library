<?php
class Constants
{
    const APP_VERSION = '3.34.2';
	const LOCATION = '-6.180495,106.824992';
	const PHONE_MODEL = 'Apple, iPhone 8';
	const DEVICE_OS = 'iOS, 12.3.1';
	const DEVICE_ID = '74fde562-452b-48a2-86bb-7cbe90ae4b8d';
}

class Action {
	// GOJEK Endpoint
	const loginPhone = 'v3/customers/login_with_phone';
	const loginEmail = 'v3/customers/login_with_email';
	const loginGojek = 'v3/customers/token';
	const checkBalance = 'wallet/profile';
	const getCustomer = 'gojek/v2/customer';
	const editAccount = 'gojek/v2/customer/edit/v2';
	const bookingHistory = 'gojek/v2/booking/history/';
	const logout = 'v3/auth/token';
	
	// GOPAY Endpoint
	const gopayTransfer = 'v2/fund/transfer';
    const gopayDetail = 'wallet/profile/detailed';
}

class GOJEK
{
    const BASE_ENDPOINT = 'https://api.gojekapi.com/';

    private $authToken;

    private $headers = [
		'X-AppVersion'	=> Constants::APP_VERSION,
		'X-Location'	=> Constants::LOCATION,
		'X-PhoneModel'	=> Constants::PHONE_MODEL,
		'X-DeviceOS'	=> Constants::DEVICE_OS,
	];

    public function __construct()
	{
		$this->headers['X-Uniqueid'] = Constants::DEVICE_ID;
	}

    /**
	 *  Authorization Token
	 * 
	 * @var String
	 */
	
	public function setAuthToken($authToken)
	{
		$this->authToken = $authToken;
    }
    
    /**
	 * loginPhone
	 * 
	 * @param String			$mobilePhone
	 * @return Class            DefaultResponse
	 */
	
	public function loginPhone($mobilePhone)
	{
		$ch = new Curl();
		
		$data = [
			'phone'				=> $mobilePhone
		];
		
		return $ch->post(GOJEK::BASE_ENDPOINT . Action::loginPhone, $data, $this->headers)->getResponse();
    }
    
    /**
	 * loginEmail
	 * 
	 * @param String			$email
	 * @return Class            DefaultResponse
	 */
	
	public function loginEmail($email)
	{
		$ch = new Curl();
		
		$data = [
			'email'				=> $email
		];
		
		return $ch->post(GOJEK::BASE_ENDPOINT . Action::loginEmail, $data, $this->headers)->getResponse();
    }
    
    /**
	 * Login GOJEK
	 * 
	 * @param String			$loginToken
	 * @param String			$OTP
	 * @return Class            DefaultResponse
	 */
	
	public function loginGojek($loginToken, $OTP)
	{
		$ch = new Curl();
		
		$data = [
			'scopes'			=> 'gojek:customer:transaction gojek:customer:readonly',
			'grant_type'		=> 'password',
			'login_token'		=> $loginToken,
			'otp'				=> $OTP,
			'client_id'			=> 'gojek:cons:android',
			'client_secret'		=> '83415d06-ec4e-11e6-a41b-6c40088ab51e'
		];
		
		return $ch->post(GOJEK::BASE_ENDPOINT . Action::loginGojek, $data, $this->headers)->getResponse();
    }
    
    /**
	 * Get Balance GOJEK
	 * 
	 * @return Class            DefaultResponse
	 */
	
	public function checkBalance()
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GOJEK::BASE_ENDPOINT . Action::checkBalance, $data, $this->headers)->getResponse();
    }

    /**
	 * Get Booking History GOJEK
	 * 
	 * @return Class            DefaultResponse
	 */
	
	public function bookingHistory($userId)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GOJEK::BASE_ENDPOINT . Action::bookingHistory . $userId, $data, $this->headers)->getResponse();
    }
    
    /**
	 * Get Customer GOJEK
	 * 
	 * @return Class            DefaultResponse
	 */
	
	public function getCustomer()
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GOJEK::BASE_ENDPOINT . Action::getCustomer, $data, $this->headers)->getResponse();
    }
    
    /**
	 * Edit Akun Pengguna GOJEK
	 * 
	 * @return Class            DefaultResponse
	 */
	
	public function editAccount($mobilePhone, $email, $name)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [
			'phone'				=> $mobilePhone,
			'email'				=> $email,
			'name'				=> $name,
		];
		
		return $ch->post(GOJEK::BASE_ENDPOINT . Action::editAccount, $data, $this->headers)->getResponse();
    }
    
    /**
	 * Verifikasi Akun Pengguna GOJEK
	 * 
	 * @return Class            DefaultResponse
	 */
	
	public function editAccountVerify($id, $mobilePhone, $verificationCode)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [
			'id'				=> $id,
			'phone'				=> $mobilePhone,
			'verificationCode'	=> $verificationCode,
		];
		
		return $ch->post(GOJEK::BASE_ENDPOINT . Action::editAccount, $data, $this->headers)->getResponse();
    }
    
    /**
	 * Logout GOJEK
	 * 
	 * @return Class            DefaultResponse
	 */
	
	public function logout()
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->delete(GOJEK::BASE_ENDPOINT . Action::logout, $data, $this->headers)->getResponse();
    }
    
    /**
	 * Get GOPAY Detail
	 * 
	 * @return Class            DefaultResponse
	 */
	
	public function gopayDetail()
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GOJEK::BASE_ENDPOINT . Action::gopayDetail, $data, $this->headers)->getResponse();
    }
    
    /**
	 * Get GOPAY History
	 * 
	 * @return Class            DefaultResponse
	 */
	
	public function gopayHistory($page, $limit)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GOJEK::BASE_ENDPOINT . 'wallet/history?page=' . $page . '&limit=' . $limit, $data, $this->headers)->getResponse();
    }
    
    /**
	 * Get Wallet Code
	 * 
	 * @param String			$mobilePhoneTo
	 * @return Class            DefaultResponse
	 */
	
	public function checkWalletCode($mobilePhoneTo)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GOJEK::BASE_ENDPOINT . 'wallet/qr-code?phone_number=%2B62' . ltrim($mobilePhoneTo, '0'), $data, $this->headers)->getResponse();
    }
    
    /**
	 * Transfer GOPAY
	 * 
	 * @param String			$QRID
	 * @param String			$PIN
	 * @param Float				$amount
	 * @param String			$description
	 * @return Class            DefaultResponse
	 */
	
	public function gopayTransfer($QRID, $PIN, $amount, $description)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		$this->headers['pin'] = $PIN;
		$this->headers['User-Agent'] = 'Gojek/3.34.1 (com.go-jek.ios; build:3701278; iOS 12.3.1) Alamofire/4.7.3';
		
		$data = [
			'qr_id'				=> $QRID,
			'amount'			=> $amount,
			'description'		=> $description
		];
		
		return $ch->post(GOJEK::BASE_ENDPOINT . Action::gopayTransfer, $data, $this->headers)->getResponse();
	}
}

class Curl
{
    public $ch;
	
	private function _getHeaders($headers)
	{
		$result = [];
		
		foreach ($headers as $key => $val) { array_push($result, $key . ': ' . $val); }
		
		return $result;
	}
	
	public function __construct()
	{
		$this->ch = curl_init();
	}
	
	public function delete($url, $data, $headers)
	{
		$headers['Content-Type'] = 'application/json;charset=UTF-8';
		
		curl_setopt($this->ch, CURLOPT_URL, $url);
		curl_setopt($this->ch, CURLOPT_POST, false);
		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->_getHeaders($headers));
		
		$result = curl_exec($this->ch);
		
		curl_close($this->ch);
		
		return new ParseResponse($result, $url);
	}
	
	public function get($url, $data, $headers)
	{
		$headers['Content-Type'] = 'application/json;charset=UTF-8';
		
		curl_setopt($this->ch, CURLOPT_URL, $url);
		curl_setopt($this->ch, CURLOPT_POST, false);
		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->_getHeaders($headers));
		
		$result = curl_exec($this->ch);
		
		curl_close($this->ch);
		
		return new ParseResponse($result, $url);
	}
	
	public function post($url, $data, $headers)
	{
		$headers['Content-Type'] = 'application/json;charset=UTF-8';
		
		curl_setopt($this->ch, CURLOPT_URL, $url);
		curl_setopt($this->ch, CURLOPT_POST, true);
		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->_getHeaders($headers));
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($data));
		
		$result = curl_exec($this->ch);
		
		curl_close($this->ch);
		
		return new ParseResponse($result, $url);
	}
}

class ParseResponse
{
	private $response;
	
	public function __construct($res, $url)
	{
		$res_json = json_decode($res);
		
		// NOTE : ACTION => gojek/v2
		if (isset($res_json->status) && $res_json->status != 'OK') throw new ParseException($url . ' ' . $res_json->message);
		// NOTE : ACTION => default
		if (isset($res_json->success) && $res_json->success == false) throw new ParseException($url . ' ' . $res_json->errors[0]->code . ' => ' . $res_json->errors[0]->message);
		
		$parts = parse_url($url);
		
		$this->response = new DefaultResponse($res_json);
	}
	
	public function getResponse()
	{
		return $this->response;
	}
}

class DefaultResponse
{
	private $result;
	
	public function __construct($res)
	{
		$this->result = isset($res->data) ? $res->data : $res;
	}
	
	public function getResult()
	{
		return $this->result;
	}
}
