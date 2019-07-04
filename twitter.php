<?php
require_once('TwitterAPIExchange.php');
$settings = array(
'oauth_access_token' => "1366594261-h3HjV92RfJ8P5FSG7M2FofZ1k5KhbbuaaF5J9yV",
'oauth_access_token_secret' => "Yhq9IWb1K6BeVQStojeHBNSvif5TE66jXwgYymtRSQkCA",
'consumer_key' => "euwC4L7xOsWIXmntV2BVkhnHJ",
'consumer_secret' => "alZpjA5kdOs9eaNvmqsKqtFSeASvAh9gnFHQBg7y6Vy0RFEuOp"
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
echo "<h3 style='padding:6px;'>Created: $datecreate</h3>";
echo "<h2 style='color:#3498db;'>Tweet: $twit</h2><br />";  

}
?>