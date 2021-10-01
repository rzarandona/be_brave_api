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


$uuid = Uuid::uuid4();
$uuid_file_string = $uuid->toString();

$base_api_url = getenv('BASE_API_URL');
$html_file_path = "html-converted/".$uuid_file_string . ".html";
$pdf_file_path = "pdf-converted/".$uuid_file_string . ".pdf";


// Prepares the html-converted template be_brave book
$contents = file_get_contents ("be_brave.html");

// Perform replacement of custom data
$contents = str_replace('<span class="fc2">nc)</span>', "<span class='fc2'>".$name."</span>", $contents);

$contents = str_replace('>nc<', ">".$name."<", $contents);
$contents = str_replace('>pa<', ">".$p_pronoun."<", $contents);
$contents = str_replace('>sp<', ">".$s_pronoun."<", $contents);

$contents = str_replace('>spc<', ">".ucfirst($s_pronoun)."<", $contents);
$contents = str_replace('>boy or girl<', ">". $gender ."<", $contents);


// $contents = str_replace('<span class="fc1">nc</span>', "<span class='fc1'>".$name."</span>", $contents);
// $contents = str_replace('<span class="fc1">pa</span>', "<span class='fc1'>".$p_pronoun."</span>", $contents);
// $contents = str_replace('<span class="fc1">sp</span>', "<span class='fc1'>".$s_pronoun."</span>", $contents);

// $contents = str_replace('<span class="fc2">nc</span>', "<span class='fc2'>".$name."</span>", $contents);
// $contents = str_replace('<span class="fc2">pa</span>', "<span class='fc2'>".$p_pronoun."</span>", $contents);
// $contents = str_replace('<span class="fc2">sp</span>', "<span class='fc2'>".$s_pronoun."</span>", $contents);

// $contents = str_replace('<span class="fc3">nc</span>', "<span class='fc3'>".$name."</span>", $contents);
// $contents = str_replace('<span class="fc3">pa</span>', "<span class='fc3'>".$p_pronoun."</span>", $contents);
// $contents = str_replace('<span class="fc3">sp</span>', "<span class='fc3'>".$s_pronoun."</span>", $contents);

// $contents = str_replace('<span class="fc4">nc</span>', "<span class='fc4'>".$name."</span>", $contents);
// $contents = str_replace('<span class="fc4">pa</span>', "<span class='fc4'>".$p_pronoun."</span>", $contents);
// $contents = str_replace('<span class="fc4">sp</span>', "<span class='fc4'>".$s_pronoun."</span>", $contents);






// Save the customized book
file_put_contents($html_file_path, $contents);


$headers = [
    'Authorization: Bearer oV5IiPlnhNwG6H7i6DN7CgzwcVqTd2nH37nGcDke',
    'Content-Type: application/json'
];



$pdf_data = [
    'source' => 'http://157.245.51.194/api/hectors_post/be_brave/html-converted/' . $uuid_file_string . ".html",
    'media' => 'print',
    'height' => 20,
    'width' => 10.5,  
    'unit' => 'in',
    'landscape' => true,
    'page_ranges'=> '2-18',
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


$img_data = [
    'source' => 'http://157.245.51.194/api/hectors_post/be_brave/html-converted/' . $uuid_file_string . ".html",
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



echo json_encode(["image" => $img_converted_url, "pdf" => $pdf_converted_url]);






// chmod($html_file_path, 0777);

// // Convert the html page to PDF
// $browserFactory = new BrowserFactory($google_exec);
// // starts headless chrome
// $browser = $browserFactory->createBrowser();

// try {
//     // creates a new page and navigate to an url
//     $page = $browser->createPage();
//     $page->navigate($base_api_url .'/html-converted/'.$uuid_file_string .".html")->waitForNavigation();
//     // pdf
//     $page->pdf(
//         [
//             'printBackground'     => false,
//             'landscape'           => false,     
//             'marginTop'           => 0.0,
//             'marginBottom'        => 0.0,
//             'marginLeft'          => 0.0,
//             'marginRight'         => 0.0,
//             'paperWidth'          => 16.0,
//             'paperHeight'         => 8.5,  
//         ]
//     )->saveToFile($pdf_file_path);
        
// } finally {
//     // bye
//     $browser->close();
// }

// echo $base_api_url . $pdf_file_path;



