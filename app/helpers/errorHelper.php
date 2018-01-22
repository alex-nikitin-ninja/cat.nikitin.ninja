<?php
Class errorHelper extends Helper {
	

	protected $codesList = array(
		'100' => array(
			'caption' => 'Continue',
			'description' => 'This interim response indicates that everything so far is OK and that the client should continue with the request or ignore it if it is already finished.',
		),
		'101' => array(
			'caption' => 'Switching Protocol',
			'description' => 'This code is sent in response to an Upgrade: request header by the client, and indicates that the protocol the server is switching too. It was introduced to allow migration to an incompatible protocol version, and is not in common use.',
		),
		'200' => array(
			'caption' => 'OK',
			'description' => 'OK',
		),
		'201' => array(
			'caption' => 'Created',
			'description' => 'The request has succeeded and a new resource has been created as a result of it. This is typically the response sent after a PUT request.',
		),
		'202' => array(
			'caption' => 'Accepted',
			'description' => 'The request has been received but not yet acted upon. It is non-committal, meaning that there is no way in HTTP to later send an asynchronous response indicating the outcome of processing the request. It is intended for cases where another process or server handles the request, or for batch processing.',
		),
		'203' => array(
			'caption' => 'Non-Authoritative Information',
			'description' => 'This response code means returned meta-information set is not exact set as available from the origin server, but collected from a local or a third party copy. Except this condition, 200 OK response should be preferred instead of this response.',
		),
		'204' => array(
			'caption' => 'No Content',
			'description' => 'There is no content to send for this request, but the headers may be useful. The user-agent may update its cached headers for this resource with the new ones.',
		),
		'205' => array(
			'caption' => 'Reset Content',
			'description' => 'This response code is sent after accomplishing request to tell user agent reset document view which sent this request.',
		),
		'206' => array(
			'caption' => 'Partial Content',
			'description' => 'This response code is used because of range header sent by the client to separate download into multiple streams.',
		),
		'300' => array(
			'caption' => 'Multiple Choice',
			'description' => 'The request has more than one possible responses. User-agent or user should choose one of them. There is no standardized way to choose one of the responses.',
		),
		'301' => array(
			'caption' => 'Moved Permanently',
			'description' => 'This response code means that URI of requested resource has been changed. Probably, new URI would be given in the response.',
		),
		'302' => array(
			'caption' => 'Found',
			'description' => 'This response code means that URI of requested resource has been changed temporarily. New changes in the URI might be made in the future. Therefore, this same URI should be used by the client in future requests.',
		),
		'303' => array(
			'caption' => 'See Other',
			'description' => 'Server sent this response to directing client to get requested resource to another URI with an GET request.',
		),
		'304' => array(
			'caption' => 'Not Modified',
			'description' => 'This is used for caching purposes. It is telling to client that response has not been modified. So, client can continue to use same cached version of response.',
		),
		'305' => array(
			'caption' => 'Use Proxy',
			'description' => 'This means requested response must be accessed by a proxy. This response code is not largely supported because security reasons.',
		),
		'306' => array(
			'caption' => 'unused',
			'description' => 'This response code is no longer used, it is just reserved currently. It was used in a previous version of the HTTP 1.1 specification.',
		),
		'307' => array(
			'caption' => 'Temporary Redirect',
			'description' => 'Server sent this response to directing client to get requested resource to another URI with same method that used prior request. This has the same semantic than the 302 Found HTTP response code, with the exception that the user agent must not change the HTTP method used: if a POST was used in the first request, a POST must be used in the second request.',
		),
		'308' => array(
			'caption' => 'Permanent Redirect',
			'description' => 'Permanent Redirect',
		),
		'400' => array(
			'caption' => 'Bad Request',
			'description' => 'This response means that server could not understand the request due to invalid syntax.',
		),
		'401' => array(
			'caption' => 'Unauthorized',
			'description' => 'Authentication is needed to get requested response. This is similar to 403, but in this case, authentication is possible.',
		),
		'402' => array(
			'caption' => 'Payment Required',
			'description' => 'This response code is reserved for future use. Initial aim for creating this code was using it for digital payment systems however this is not used currently.',
		),
		'403' => array(
			'caption' => 'Forbidden',
			'description' => 'Client does not have access rights to the content so server is rejecting to give proper response.',
		),
		'404' => array(
			'caption' => 'Not Found',
			'description' => 'Server can not find requested resource. This response code probably is most famous one due to its frequency to occur in web.',
		),
		'405' => array(
			'caption' => 'Method Not Allowed',
			'description' => 'The request method is known by the server but has been disabled and cannot be used. The two mandatory methods, GET and HEAD, must never be disabled and should not return this error code.',
		),
		'406' => array(
			'caption' => 'Not Acceptable',
			'description' => 'This response is sent when the web server, after performing server-driven content negotiation, doesn\'t find any content following the criteria given by the user agent.',
		),
		'407' => array(
			'caption' => 'Proxy Authentication Required',
			'description' => 'This is similar to 401 but authentication is needed to be done by a proxy.',
		),
		'408' => array(
			'caption' => 'Request Timeout',
			'description' => 'This response is sent on an idle connection by some servers, even without any previous request by the client. It means that the server would like to shut down this unused connection. This response is used much more since some browsers, like Chrome or IE9, use HTTP preconnection mechanisms to speed up surfing (see bug 881804, which tracks the future implementation of such a mechanism in Firefox). Also note that some servers merely shut down the connection without sending this message.',
		),
		'409' => array(
			'caption' => 'Conflict',
			'description' => 'This response would be sent when a request conflict with current state of server.',
		),
		'410' => array(
			'caption' => 'Gone',
			'description' => 'This response would be sent when requested content has been deleted from server.',
		),
		'411' => array(
			'caption' => 'Length Required',
			'description' => 'Server rejected the request because the Content-Length header field is not defined and the server requires it.',
		),
		'412' => array(
			'caption' => 'Precondition Failed',
			'description' => 'The client has indicated preconditions in its headers which the server does not meet.',
		),
		'413' => array(
			'caption' => 'Payload Too Large',
			'description' => 'Request entity is larger than limits defined by server; the server might close the connection or return an Retry-After header field.',
		),
		'414' => array(
			'caption' => 'URI Too Long',
			'description' => 'The URI requested by the client is longer than the server is willing to interpret.',
		),
		'415' => array(
			'caption' => 'Unsupported Media Type',
			'description' => 'The media format of the requested data is not supported by the server, so the server is rejecting the request.',
		),
		'416' => array(
			'caption' => 'Requested Range Not Satisfiable',
			'description' => 'The range specified by the Range header field in the request can\'t be fulfilled; it\'s possible that the range is outside the size of the target URI\'s data.',
		),
		'417' => array(
			'caption' => 'Expectation Failed',
			'description' => 'This response code means the expectation indicated by the Expect request header field can\'t be met by the server.',
		),
		'418' => array(
			'caption' => 'I\'m a teapot',
			'description' => 'Any attempt to brew coffee with a teapot should result in the error code "418 I\'m a teapot". The resulting entity body MAY be short and stout.',
		),
		'421' => array(
			'caption' => 'Misdirected Request',
			'description' => 'The request was directed at a server that is not able to produce a response. This can be sent by a server that is not configured to produce responses for the combination of scheme and authority that are included in the request URI.',
		),
		'426' => array(
			'caption' => 'Upgrade Required',
			'description' => 'The server refuses to perform the request using the current protocol but might be willing to do so after the client upgrades to a different protocol. The server MUST send an Upgrade header field in a 426 response to indicate the required protocol(s) (Section 6.7 of [RFC7230]).',
		),
		'428' => array(
			'caption' => 'Precondition Required',
			'description' => 'The origin server requires the request to be conditional. Intended to prevent "the \'lost update\' problem, where a client GETs a resource\'s state, modifies it, and PUTs it back to the server, when meanwhile a third party has modified the state on the server, leading to a conflict."',
		),
		'429' => array(
			'caption' => 'Too Many Requests',
			'description' => 'The user has sent too many requests in a given amount of time ("rate limiting").',
		),
		'431' => array(
			'caption' => 'Request Header Fields Too Large',
			'description' => 'The server is unwilling to process the request because its header fields are too large. The request MAY be resubmitted after reducing the size of the request header fields.',
		),
		'500' => array(
			'caption' => 'Internal Server Error',
			'description' => 'The server has encountered a situation it doesn\'t know how to handle.',
		),
		'501' => array(
			'caption' => 'Not Implemented',
			'description' => 'The request method is not supported by the server and cannot be handled. The only methods that servers are required to support (and therefore that must not return this code) are GET and HEAD.',
		),
		'502' => array(
			'caption' => 'Bad Gateway',
			'description' => 'This error response means that the server, while working as a gateway to get a response needed to handle the request, got an invalid response.',
		),
		'503' => array(
			'caption' => 'Service Unavailable',
			'description' => 'The server is not ready to handle the request. Common causes are a server that is down for maintenance or that is overloaded. Note that together with this response, a user-friendly page explaining the problem should be sent. This responses should be used for temporary conditions and the Retry-After: HTTP header should, if possible, contain the estimated time before the recovery of the service. The webmaster must also take care about the caching-related headers that are sent along with this response, as these temporary condition responses should usually not be cached.',
		),
		'504' => array(
			'caption' => 'Gateway Timeout',
			'description' => 'This error response is given when the server is acting as a gateway and cannot get a response in time.',
		),
		'505' => array(
			'caption' => 'HTTP Version Not Supported',
			'description' => 'The HTTP version used in the request is not supported by the server.',
		),
		'506' => array(
			'caption' => 'Variant Also Negotiates',
			'description' => 'The server has an internal configuration error: transparent content negotiation for the request results in a circular reference.',
		),
		'507' => array(
			'caption' => 'Variant Also Negotiates',
			'description' => 'The server has an internal configuration error: the chosen variant resource is configured to engage in transparent content negotiation itself, and is therefore not a proper end point in the negotiation process.',
		),
		'511' => array(
			'caption' => 'Network Authentication Required',
			'description' => 'The 511 status code indicates that the client needs to authenticate to gain network access.	',
		),
	);

	public function getDescription($errorCode){
		$result = false;
		if(isset($this->codesList[$errorCode])){
			$result = $this->codesList[$errorCode];
		}
		return $result;
	}


}