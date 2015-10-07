<?php
$headers = array();
foreach ($_SERVER as $key => $value) {
    if (strpos($key, 'HTTP_') === 0) {
        $headers[str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))))] = $value;
    }
}
require_once('../configuration.php');

if ($headers['Httpsiteapi'] == $remote['api_key']) {
$encoded_file = $_POST['file'];
$decoded_file = base64_decode($encoded_file);
/* Now you can copy the uploaded file to your server. */
file_put_contents('../tmp/'.$headers['Httpsiteapi'].'.zip', $decoded_file);

$target_path = '../tmp/'.$headers['Httpsiteapi'].'.zip';  // change this to the correct site path
$zip = new ZipArchive();
$x = $zip->open($target_path);
if ($x === true) {
$zip->extractTo("data/"); // change this to the correct site path
$zip->close();

}
unlink($target_path);
echo "success";
} else {

echo "denied";
}


?>
