<?php
define('SERVER_API_KEY','AIzaSyC_YR_QPTXLq7JA3VtT_ZAWdcyLOMxrEsI');
$tokens = ['fjNV83HInR0:APA91bFH0eLzPaZ4IYTWlsxR2-hkLbi6Od3ukLgqavDQBEo4JnyqZjLe0oZiwfHu4XPTGr821VEncQ9-OXrVZ582VaqYG9p550Qmlh3jWCWnGgfnEuYsnhiUi5meh8GrANg0fBKByjJq'];
$header =[
'Authorization: key='.SERVER_API_KEY,
'Content-Type: Application/json'
];
$msg =[
'title' => 'Se acabó el semestre que sad la dvd',
'body' => 'Espero hayas aprendido cosas nuevas en esta materia - Y si la vdd ty',
'icon' => 'img/briggita.jpg',
'img' => 'img/briggita.jpg',
];
$payload = array(
'registration_ids' => $tokens,
'data' => $msg
);
$curl = curl_init();

curl_setopt_array($curl, array(
 CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
 CURLOPT_RETURNTRANSFER => true,
 CURLOPT_CUSTOMREQUEST => "POST",
 CURLOPT_POSTFIELDS => json_encode( $payload ),
 CURLOPT_SSL_VERIFYHOST => 0,
 CURLOPT_SSL_VERIFYPEER => 0,
 CURLOPT_HTTPHEADER => $header
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
if ($err) {
 echo "cURL Error #:" . $err;
} else {
 echo $response;
}
?>
