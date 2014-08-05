<?php
# Image Controller Helper

# set up imgur connection
$client = new \Imgur\Client();
$client->setOption('client_id', 'd6c1ad7da60dc22');
$client->setOption('client_secret', 'f3d89c626d4a3ce5a41e23351400e942d79542a6');

if (isset($_SESSION['token'])) 
{
    $client->setAccessToken($_SESSION['token']);
    if($client->checkAccessTokenExpired()) 
    {
        $client->refreshToken();
    }
}
elseif (isset($_GET['code'])) 
{
        $client->requestAccessToken($_GET['code']);
        $_SESSION['token'] = $client->getAccessToken();
}
else 
{
    echo '<a href="'.$client->getAuthenticationUrl().'">Click to authorize</a>';
}	
