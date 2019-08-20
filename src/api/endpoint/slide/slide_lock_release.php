<?php
/*
*  ====>
*
*  Attempt to lock a slide.
*
*  This endpoint succeeds if:
*
*    * The caller is in the 'admin' or 'editor' groups.
*    * The slide has previously been locked by the caller.
*
*  The 'error' value returned by this endpoint is
*
*    * API_E_OK on success.
*    * API_E_LOCK if the slide is locked by another user.
*
*  **Request:** POST, application/json
*
*  Parameters
*    * id = The ID of the slide to lock.
*
*  Return value
*    * error = An error code or API_E_OK on success.
*
*  <====
*/

require_once($_SERVER['DOCUMENT_ROOT'].'/api/api.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/common/php/slide/slide.php');

$SLIDE_LOCK_RELEASE = new APIEndpoint(array(
	APIEndpoint::METHOD		=> API_METHOD['POST'],
	APIEndpoint::RESPONSE_TYPE	=> API_MIME['application/json'],
	APIEndpoint::FORMAT_BODY => array(
		'id' => API_P_STR
	),
	APIEndpoint::REQ_QUOTA		=> TRUE,
	APIEndpoint::REQ_AUTH		=> TRUE
));

if (
	!check_perm(
		'grp:admin|grp:editor;',
		$SLIDE_LOCK_RELEASE->get_caller()
	)
) {
	throw new APIException(
		API_E_NOT_AUTHORIZED,
		"Not authorized"
	);
}

$slide = new Slide();
$slide->load($SLIDE_LOCK_RELEASE->get('id'));
try {
	$slide->lock_release($SLIDE_LOCK_RELEASE->get_session());
} catch (SlideLockException $e) {
	throw new APIException(
		API_E_LOCK,
		"Failed to release slide lock.",
		0,
		$e
	);
}
$slide->write();

$SLIDE_LOCK_RELEASE->resp_set([]);
$SLIDE_LOCK_RELEASE->send();
