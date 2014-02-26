<?php
$params = json_decode(file_get_contents('php://input'));
return json_encode(array("test" => 'Ok', 'data' => $params->data));
?>