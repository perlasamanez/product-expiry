<?php

if (count($_POST) == 0) {
    die('NOPE.');
}

$first = strip_tags($_POST['first']);
$second = strip_tags($_POST['second']);
$third = strip_tags($_POST['third']);


$expiry = new DateTime('04-02-2018');
$expirynext = new DateTime('11-02-2018');
$expirynextnext = new DateTime('28-01-2018');

$today = new DateTime('now');

$difference = $today->diff($expiry)->format('%R%a');
$differencenext = $today->diff($expirynext)->format('%R%a');
$differencenextnext = $today->diff($expirynextnext)->format('%R%a');

//$difference = $expiry->diff($today)->format('%R%a');

$data = json_decode(file_get_contents('https://api.walmartlabs.com/v1/items?apiKey=fhd34cqau75b2mgqxhuhjras&upc=' . $first), true);
$datanext = json_decode(file_get_contents('https://api.walmartlabs.com/v1/items?apiKey=fhd34cqau75b2mgqxhuhjras&upc=' . $second), true);
$datanextnext = json_decode(file_get_contents('https://api.walmartlabs.com/v1/items?apiKey=fhd34cqau75b2mgqxhuhjras&upc=' . $third), true);

$items = $data['items'];
$itemsnext = $datanext['items'];
$itemsnextnext = $datanextnext['items'];

?>
<!doctype html>
<html>

<head>
  <title>Products</title>
</head>

<body>
  <?php foreach ($items as $item): ?>
    <p>Name: <?= $item['name'] ?></p>
    <p>Picture:</p> <img src="<?= $item['thumbnailImage'] ?>"/>
    <p>Expired? <?=$difference < 8 ? 'You have a week to replace this item.' : sprintf("You still have this amount of days: %s - %s = %s day(s)", $expiry->format('m/d/Y'), $today->format('m/d/Y'), $difference)  ?>
  <?php endforeach; ?>
  <?php foreach ($itemsnext as $item): ?>
    <p>Name: <?= $item['name'] ?></p>
    <p>Picture:</p> <img src="<?= $item['thumbnailImage'] ?>"/>
    <p>Expired? <?=$differencenext < 8 ? 'You have a week to replace this item.' : sprintf("You still have this amount of days: %s - %s = %s day(s)", $expirynext->format('m/d/Y'), $today->format('m/d/Y'), $differencenext)  ?>
  <?php endforeach; ?>
  <?php foreach ($itemsnextnext as $item): ?>
    <p>Name: <?= $item['name'] ?></p>
    <p>Picture:</p> <img src="<?= $item['thumbnailImage'] ?>"/>
    <p>Expired? <?=$differencenextnext < 8 ? 'You have a week to replace this item.' : sprintf("You still have this amount of days: %s - %s = %s day(s)", $expirynextnext->format('m/d/Y'), $today->format('m/d/Y'), $differencenextnext)  ?>
  <?php endforeach; ?>
</body>

</html>
