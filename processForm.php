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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Expiry Products</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Expiry &hearts;</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" target= "_blank" href="https://www.walmart.com/">Walmart</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

    <form id="processForm" action="processForm.php" method="POST">
        <h1 class="my-4">Enter your products!</h1>
        <div class="list-group">
          <input id="product1" name="first" type="text" class="form-control" placeholder="Your First Product *" required data-validation-required-message="Please enter your first product.">
          <input id="product1" name="second" type="text" class="form-control" placeholder="Your Second Product *" required data-validation-required-message="Please -enter your second product.">
          <input id="product1" name="third" type="text" class="form-control" placeholder="Your Third Product *" required data-validation-required-message="Please enter your third product.">
          <p class="help-block text-danger"></p>
          <input type="submit" value="Add List"/>

        </div>

      </div>
      <!-- /.col-lg-3 -->
    </form>

    <div class="col-lg-9">

      <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
            <img class="d-block img-fluid" src="img/salad.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block img-fluid" src="img/vege.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block img-fluid" src="img/le.jpg" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <div class="row">

        <?php foreach ($items as $item): ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
            <img src="<?= $item['mediumImage'] ?>"/>
            <div class="card-body">
              <h4 class="card-title">
                <?= $item['name'] ?>
              </h4>
              <p class="card-text">Expired? <?=$difference < 8 ? 'No! You have a week to replace this item.' : sprintf("You still have this amount of days: %s - %s = %s day(s)", $expiry->format('m/d/Y'), $today->format('m/d/Y'), $difference)  ?>
            </div>
            <div class="card-footer">
              <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
            </div>
          </div>
        </div>
        <?php endforeach; ?>

        <?php foreach ($itemsnext as $item): ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
            <img src="<?= $item['mediumImage'] ?>"/>
             <div class="card-body">
              <h4 class="card-title">
                <?= $item['name'] ?>
              </h4>
              <p>Expired? <?=$differencenext < 8 ? 'You have a week to replace this item.' : sprintf("You still have this amount of days: %s - %s = %s day(s)", $expirynext->format('m/d/Y'), $today->format('m/d/Y'), $differencenext)  ?>
            </div>
            <div class="card-footer">
              <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
            </div>
          </div>
        </div>
        <?php endforeach; ?>

        <?php foreach ($itemsnextnext as $item): ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
            <img src="<?= $item['mediumImage'] ?>"/>
            <div class="card-body">
              <h4 class="card-title">
                 <?= $item['name'] ?>
              </h4>
              <p>Expired? <?=$differencenextnext < 8 ? 'You have a week to replace this item.' : sprintf("You still have this amount of days: %s - %s = %s day(s)", $expirynextnext->format('m/d/Y'), $today->format('m/d/Y'), $differencenextnext)  ?>
            </div>
            <div class="card-footer">
              <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
            </div>
          </div>
        </div>
          <?php endforeach; ?>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.col-lg-9 -->

  </div>
  <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Expiry 2018</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
