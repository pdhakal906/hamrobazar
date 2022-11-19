<?php 
echo "hi";

$ch = curl_init();
$url = "https://api.hamrobazaar.com/api/Search/Products";
$headers = [
    "Content-Type:application/json",
    "apikey:09BECB8F84BCB7A1796AB12B98C1FB9E"
];
$data = '{"pageNumber":1,"pageSize":100,"latitude":0,"longitude":0,"deviceId":"6ab30435-3d8f-4a91-b67c-441c5dd3141b","deviceSource":"web","isHBSelect":false,"searchParams":{"searchValue":"laptop","searchBy":"","searchByDistance":0},"filterParams":{"condition":0,"priceFrom":0,"priceTo":0,"isPriceNegotiable":null,"category":"","brand":"","categoryIds":"","brandIds":"","advanceFilter":""},"sortParam":0}';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

$resp = curl_exec($ch);

$r = json_decode($resp, true);

$file = fopen('products.csv', 'w');
fputcsv($file, array("Name","Price"));


// echo $r['data'][1]['name'];
foreach ($r['data'] as $name){
    // echo $name['name'];
    fputcsv($file, array($name['name'], $name['price']));
}

?>