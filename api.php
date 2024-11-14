<?php
$url = "https://zenoplay.zenomedia.com/api/zenofm/nowplaying/6ss1gdc7uv8uv";

$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$return_json = curl_exec($ch);

$obj = json_decode($return_json);
$tit = $obj->{'title'};
//echo $tit;


$parte   = explode(" - ", $tit);
$artista = $parte[0];
$tema    = $parte[1];

//api Portada o album artista
$fot = preg_replace('/\W+/', '%20', $artista);
$url2 = @file_get_contents('https://itunes.apple.com/search?term='.$fot.'&media=music&limit=1');
$json = json_decode($url2, true);
foreach($json['results'] as $value)
{
$foto = $value['artworkUrl100'];
}

if (empty($foto)){
$imagen="img/default.jpg"; //ruta de portada default
} else {
$imagen = preg_replace('/100x100bb/', '600x600bb', $foto);
}
?>


{
  "type":"result",
  "data":[
    {
      "song":"<?=$tit?>",
      "image":"<?=$imagen?>",
      "listeners":"",
      "unique_listeners":"",
      "history": ""
    }
  ]
}