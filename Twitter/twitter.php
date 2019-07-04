<?php
require_once('TwitterAPIExchange.php');
$settings = array(
'oauth_access_token' => "",
'oauth_access_token_secret' => "",
'consumer_key' => "=",
'consumer_secret' => ""
);
$url = "https://api.twitter.com/1.1/search/tweets.json";
$requestMethod = "GET";
$getfield = '?q=#medicine&result_type=recent';
$twitter = new TwitterAPIExchange($settings);
$res = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();
$res = json_decode($res,true);
//print_r($res);
foreach($res['statuses'] as $items) {

$datecreate = $items['created_at'];
//$id = $items['id'];
$twit = $items['text'];

//echo "ID: $id<br />";
echo "Created: $datecreate<br />";
echo "Tweet: $twit<br />";  

}
?>
