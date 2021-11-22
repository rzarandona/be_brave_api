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
$cover_type = $_GET['cover_type'];

$uuid = Uuid::uuid4();
$uuid_file_string = $uuid->toString();

$base_api_url = getenv('BASE_API_URL');
$html_file_path = "html-converted/".$uuid_file_string . ".html";
$html_outer_file_path = "html-outer-converted/".$uuid_file_string . ".html";


// Parse Inner Book File
$contents = file_get_contents ("./templates/" . $character . ".html");
$contents = str_replace('(nc)', $name, $contents);
$contents = str_replace('(pp)', $p_pronoun, $contents);
$contents = str_replace('(sp)', $s_pronoun, $contents);

$contents = str_replace('(pronoun)', $s_pronoun, $contents);

$contents = str_replace('(spc)', ucfirst($s_pronoun), $contents);
$contents = str_replace('(boy or girl)', "". $gender , $contents);
$contents = str_replace('“', '"', $contents);

file_put_contents($html_file_path, $contents);

// Parse Outer Book File
$contents = file_get_contents ("./templates/" . $character . "-outer.html");
$contents = str_replace('(nc)', $name, $contents);
$contents = str_replace('(pp)', $p_pronoun, $contents);
$contents = str_replace('(sp)', $s_pronoun, $contents);
$contents = str_replace('“', '"', $contents);
file_put_contents($html_outer_file_path, $contents);


$headers = [
    'Authorization: Bearer oV5IiPlnhNwG6H7i6DN7CgzwcVqTd2nH37nGcDke',
    'Content-Type: application/json'
];


// START INNER CONVERSIONS
$pdf_data = [
    'source' => 'https://bebraveapi.hectorspost.com/html-converted/' . $uuid_file_string . ".html",
    'media' => 'print',
    'height' => 9.09, //10.1
    'width' => 9.09,  //10
    'unit' => 'in',
    'page_ranges'=> '3, 5, 7, 9, 11, 13, 15, 17, 19, 21, 23, 25, 27, 29, 31, 33, 35, 37, 39, 41, 43, 45, 47, 49, 51, 53, 55, 57',
    'test' => false
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

$outer_page_ranges = "1, 3";
if($cover_type == "hardback"){
    $outer_page_ranges = "1";
}

//START OUTER CONVERSIONS
$outer_pdf_data = [
    'source' => 'https://bebraveapi.hectorspost.com/html-outer-converted/' . $uuid_file_string . ".html",
    'media' => 'print',
    'height' => 17.52, // 20
    'width' => 9.09, // 10.5
    'page_ranges' => $outer_page_ranges,
    'landscape' => true,  
    'unit' => 'in', // in
    'test' => false,
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
    'source' => 'https://bebraveapi.hectorspost.com/html-outer-converted/' . $uuid_file_string . ".html",
    // 'height' => 17.52, // 20
    // 'width' => 9.09, // 10.5
    'unit' => 'in',
    'test' => false,
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





