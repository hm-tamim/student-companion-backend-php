<?php

require_once 'includes/func.php';


$url = "/" . strtoupper(fresh($_REQUEST['query']));

header('Location: ' . $url);

?>