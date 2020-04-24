<?php
require 'gojekapi.class.php';

$gojek = new GOJEK();
echo json_encode($gojek->loginEmail('MYEMAIL@MAIL.ID')->getResult());

// echo $authToken = $gojek->loginGojek('', '')->getAuthToken();

// $gojek->setAuthToken($authToken);
// $result = $gojek->checkBalance()->getResult();

// echo json_encode($result);
