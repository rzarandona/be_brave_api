<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

ini_set('display_errors', true);
error_reporting(E_ALL);

require 'vendor/autoload.php';
use Ramsey\Uuid\Uuid;

$character = $_GET['character'] ?? "boy-a";
$gender =  $_GET['gender'] ?? "boy";
$name =  $_GET['character_name'] ?? "Davids";
$s_pronoun =  $_GET['s_pronoun'] ?? "he";
$o_pronoun =  $_GET['o_pronoun'] ?? "him";
$p_pronoun =  $_GET['p_pronoun'] ?? "his";

echo $character;
exit;

$uuid = Uuid::uuid4();
$uuid_file_string = $uuid->toString();

$base_api_url = getenv('BASE_API_URL');
$html_file_path = "html-converted/".$uuid_file_string . ".html";
$html_outer_file_path = "html-outer-converted/".$uuid_file_string . ".html";


// Parse Inner Book File
$contents = file_get_contents ("be_brave.html");
$contents = str_replace('(nc)', $name, $contents);
$contents = str_replace('(pp)', $p_pronoun, $contents);
$contents = str_replace('(sp)', $s_pronoun, $contents);

$contents = str_replace('(pronoun)', $s_pronoun, $contents);

$contents = str_replace('(spc)', ucfirst($s_pronoun), $contents);
$contents = str_replace('(boy or girl)', "". $gender , $contents);
file_put_contents($html_file_path, $contents);

// Parse Outer Book File
$contents = file_get_contents ("be_brave_outer.html");
$contents = str_replace('(nc)', $name, $contents);
$contents = str_replace('(pa)', $p_pronoun, $contents);
$contents = str_replace('(sp)', $s_pronoun, $contents);
file_put_contents($html_outer_file_path, $contents);


$headers = [
    'Authorization: Bearer oV5IiPlnhNwG6H7i6DN7CgzwcVqTd2nH37nGcDke',
    'Content-Type: application/json'
];


// START INNER CONVERSIONS
$pdf_data = [
    'source' => 'http://157.245.51.194/api/hectors_post/be_brave/html-converted/' . $uuid_file_string . ".html",
    'media' => 'print',
    'height' => 10.1,
    'width' => 10,  
    'unit' => 'in',
    'page_ranges'=> '2-29',
    'test' => true
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://docamatic.com/api/v1/pdf');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($pdf_data));
$response = curl_exec($ch);
curl_close($ch);
$pdf_converted_url = json_decode($response)->document;

//START OUTER CONVERSIONS
$outer_pdf_data = [
    'source' => 'http://157.245.51.194/api/hectors_post/be_brave/html-outer-converted//' . $uuid_file_string . ".html",
    'media' => 'print',
    'height' => 20,
    'width' => 10.5,
    'landscape' => true,  
    'unit' => 'in',
    'test' => true
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://docamatic.com/api/v1/pdf');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($outer_pdf_data));
$response = curl_exec($ch);
curl_close($ch);
$outer_pdf_converted_url = json_decode($response)->document;


// START IMAGE CONVERSIONS
$img_data = [
    'source' => 'http://157.245.51.194/api/hectors_post/be_brave/html-outer-converted/' . $uuid_file_string . ".html",
    'height' => 20.85,
    'width' => 20,  
    'unit' => 'in',
    'test' => true,
];
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_URL, 'https://docamatic.com/api/v1/image');
curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_POST, 1);
curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($img_data));
$response2 = curl_exec($ch2);
curl_close($ch2);

$img_converted_url = json_decode($response2)->document;



echo json_encode(["image" => $img_converted_url, "inner_pdf" => $pdf_converted_url, "outer_pdf" => $outer_pdf_converted_url, "source_id" => $uuid_file_string]);





