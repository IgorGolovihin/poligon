<?php

function CurlVerificationDomen($url)
{

	$user_agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';

	$ch = curl_init();

	$opts = [
		CURLOPT_FOLLOWLOCATION => 1,
		CURLOPT_MAXREDIRS      => 20,
		CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
		CURLOPT_SSL_VERIFYPEER => 1,
		CURLOPT_NOBODY => 1,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_DNS_CACHE_TIMEOUT => 0,
		CURLOPT_HTTPGET => 1,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_AUTOREFERER    => 0,
		CURLOPT_ENCODING       => "identity",
		CURLOPT_HEADER         => 0,
		CURLOPT_CONNECTTIMEOUT => 120,
		CURLOPT_TIMEOUT        => 120,
		CURLPROTO_HTTPS => 1,
		CURLOPT_USERAGENT => $user_agent,
		CURLOPT_CAINFO, dirname(__FILE__) . ".env/cacert.pem",
		CURLOPT_URL => $url,
		CURLOPT_VERBOSE => 0
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
