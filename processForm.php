<?php

if (count($_POST) == 0) {
    die('NOPE.');
}

$first = strip_tags($_POST['first']);
$expiry = strip_tags($_POST['expiry']);

$data = json_decode(file_get_contents('https://api.walmartlabs.com/v1/items?apiKey=fhd34cqau75b2mgqxhuhjras&upc=' . $first), true);

$items = $data['items'];

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
    <p>Expiration Date (in days): 10 days</p>
  <?php endforeach; ?>
</body>

</html>
