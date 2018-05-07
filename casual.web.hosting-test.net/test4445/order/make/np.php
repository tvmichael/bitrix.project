<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("np");
?>



<?
$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => "https://api.novaposhta.ua/v2.0/json/",
CURLOPT_RETURNTRANSFER => True,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => "{\r\n\"apiKey\": \"b2444b86ad7faff76b9a69dc6eb37c7d\",\r\n\"modelName\": \"Common\",\r\n\"calledMethod\": \"getServiceTypes\",\r\n\"methodProperties\": {}\r\n}",
CURLOPT_HTTPHEADER => array("content-type: application/json",),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
if ($err) {
echo "cURL Error #:" . $err;
} else {
	echo "<h4>NP1</h4>";
	echo "<p>";
	$FormContent= convert_cyr_string($response,"t","w");
	echo $FormContent;
	//echo json_encode($response, JSON_UNESCAPED_UNICODE);
	//echo json_encode($response);
	echo "</p>";
}
?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>