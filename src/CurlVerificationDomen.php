<?php

function CurlVerificationDomen($url)
{

	//$proxyData = "https://178.35.233.235:3128"; // advanced.name/ru/freeproxy?country=RU

	$user_agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';



	// $resolve = array(sprintf(
	// 	"%s:%d:%s",
	// 	$hostname = "www.google.com",
	// 	$port = "443",
	// 	$host_ip = "172.217.10.132"
	// ));


	$ch = curl_init();

	$opts = [
		CURLOPT_FOLLOWLOCATION => 1,           // follow redirects
		CURLOPT_MAXREDIRS      => 20,          // stop after 20 redirects
		CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
		CURLOPT_SSL_VERIFYPEER => 1,
		CURLOPT_NOBODY => 1,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_DNS_CACHE_TIMEOUT => 0,
		CURLOPT_HTTPGET => 1,
		//CURLOPT_RESOLVE => $resolve,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_AUTOREFERER    => 0,           // set referrer on redirect
		CURLOPT_ENCODING       => "identity",  // handle compressed 
		CURLOPT_HEADER         => 0,           // don't return headers
		CURLOPT_CONNECTTIMEOUT => 120,         // time-out on connect
		CURLOPT_TIMEOUT        => 120,         // time-out on response
		CURLPROTO_HTTPS => 1,
		CURLOPT_USERAGENT => $user_agent,
		//CURLOPT_COOKIE=> "",
		//CURLOPT_PROXY_SSL_VERIFYPEER => 1,
		//CURLOPT_PROXY => $proxyData,
		CURLOPT_CAINFO, dirname(__FILE__) . ".env/cacert.pem", // testing curl SSL host
		CURLOPT_URL => $url,
		CURLOPT_VERBOSE => 0 // data info
	];

	curl_setopt_array($ch, $opts);

	curl_exec($ch);

	$error = curl_errno($ch);

	if (!empty($error)) {

		curl_close($ch);
		return $error;
	} else {

		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		return $code;
	}
}
