<?php

namespace rivetweb\bitrix24\embedded;

use \rivetweb\log\file\Log;
use \rivetweb\Bitrix\Main\Web\HttpClient;

final class Bitrix24 {

	private $config;
	private $accessToken;
	private $client;

	function __construct($config) {
		$this->config = $config;
		$this->accessToken = null;
		$this->client = new HttpClient();
	}

	/*
	function redirect($url) {
		header("HTTP 302 Found");
		header("Location: " . $url);
		// NOTE !!!use "exit" or "return" after redirect
	}*/

	function request($method, $url, $data = null) {
		$result = $this->client->query($method, $url, $data);

		//Log::info($result, "bitrix24.log");

		$result = json_decode($result, true);

		//Log::info($result, "bitrix24.log");

		return $result;
	}

	function setAccessToken($token) {
		$this->accessToken = $token;
	}

	function api($method, $params = []) {
		if (!isset($params["auth"]) && !empty($this->accessToken)) {
			$params["auth"] = $this->accessToken;
		}
		return $this->request(
			"POST",
			$this->config["PROTOCOL"] . "://" . $this->config["PORTAL"] . "/rest/" . $method,
			$params
		);
	}

}
