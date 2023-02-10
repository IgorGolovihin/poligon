<?php

function CurlVerificationDomen($url)
{
	$user_agent = 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)';

	$proxyData = "https://178.35.233.235:3128"; // advanced.name/ru/freeproxy?country=RU

	$ch = curl_init();

	$opts = [
		CURLOPT_FOLLOWLOCATION => 1,      // follow redirects
		CURL_IPRESOLVE_V4 => 1,
		CURLOPT_NOBODY => 1,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_HTTPGET => 1,
		CURLOPT_MAXREDIRS      => 1,      // stop after 1 redirects
		CURLOPT_AUTOREFERER    => 0,      // set referrer on redirect
		CURLOPT_ENCODING       => "",     // handle compressed 
		CURLOPT_HEADER         => 0,      // don't return headers
		CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
		CURLOPT_TIMEOUT        => 120,    // time-out on response
		CURLPROTO_HTTPS => 1,
		CURLOPT_USERAGENT => $user_agent,
		//CURLOPT_SSL_VERIFYPEER => 0,
		//CURLOPT_PROXY_SSL_VERIFYPEER => 0,
		//CURLOPT_PROXY => $proxyData,
		CURLOPT_URL => $url
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
