<?php
//error_log(__FILE__);
// THIS IS AN EXAMPLE
// you will obviously need to do more server side work than I am doing here to check and move your upload.
// API is up for discussion, jump on http://dojotoolkit.org/forums

// JSON.php is available in dojo svn checkout
//require("./dojo-release-1.7.1/dojo/tests/resources/JSON.php");
//$json = new Services_JSON();

error_log(print_r($_REQUEST, true));
error_log(print_r($_FILES, true));

// fake delay
sleep(3);
$name = empty($_REQUEST['name'])? "default" : $_REQUEST['name'];
if(is_array($_FILES)){
	$ar = array(
		// lets just pass lots of stuff back and see what we find.
		// the _FILES aren't coming through in IE6 (maybe 7)
		'status' => "success",
		'name' => $name,
		'request' => $_REQUEST,
		'postvars' => $_POST,
		'details' => $_FILES,
		// and some static subarray just to see
		'foo' => array('foo'=>"bar")
	);
	file_put_contents('/Users/Shared/'.$_FILES['flashUploadFiles']['name'], file_get_contents($_FILES['flashUploadFiles']['tmp_name']));

}else{
	$ar = array(
		'status' => "failed",
		'details' => ""
	);
}

error_log(json_encode($ar));

echo '<textarea>'.json_encode($ar).'</textarea>';
exit;
// yeah, seems you have to wrap iframeIO stuff in textareas?
$foo = $json->encode($ar);
?>
<textarea><?php print $foo; ?></textarea>
