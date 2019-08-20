<?php
/*
*  ====>
*
*  Logout all sessions of the user corresponding to the supplied
*  authentication key except the calling session.
*
*  **Request:** POST, application/json
*
*  Return value
*    * error = An error code or API_E_OK on success.
*
*  <====
*/

require_once($_SERVER['DOCUMENT_ROOT'].'/api/api.php');

$AUTH_LOGOUT_OTHER = new APIEndpoint(array(
	APIEndpoint::METHOD         => API_METHOD['POST'],
	APIEndpoint::RESPONSE_TYPE  => API_MIME['application/json'],
	APIEndpoint::FORMAT_BODY    => array(),
	APIEndpoint::REQ_QUOTA      => FALSE,
	APIEndpoint::REQ_AUTH       => TRUE
));

$u = $AUTH_LOGOUT_OTHER->get_caller();
$u->session_n_rm($AUTH_LOGOUT_OTHER->get_session()->get_id());
$u->write();

$AUTH_LOGOUT_OTHER->resp_set(array('error' => API_E_OK));
$AUTH_LOGOUT_OTHER->send();
