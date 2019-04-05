<?php
require_once 'testConnection.php'; // подключаем скрипт
//echo 'test';
//var_dump (selectAll('task'));
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Спасибо за заказ!</title>
    
    <?php
    if (isset($_POST["perim"])) {
      $newOrder = array();
        foreach ($_POST as $key => $value) {
          $newOrder[$key] = $value;
        }
        //insertNew('orders', $newOrder);
        newOrder($newOrder);
        //perim - площадь
        //svet - 
        //angle - углы
        //chandelier - люстры
        //clientName
        //clientPhone
        echo 'Ваш заказ успешно добавлен!';
    }
    ?>

  </head>
  <body>
    

    <div class="container-fluid mt-1 ">

      <div class="d-flex justify-content-center my-5">
        <a href="index.html" class="text-center nav-link bg-danger rounded font-weight-bolder w-50 " style="color: white;">Вернуться на сайт</a>
      </div>

      <div class="jumbotron">
        <h1 class="display-3">Спасибо за заказ!</h1>
        <p class="lead">В ближайшее время Наши менеджеры свяжутся с Вами.</p>
        <hr class="my-2">
        <p>Выберете наиболие удобный способ связи: </p>

        <div class="custom-control custom-radio">
          <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
          <label class="custom-control-label" for="customRadio1">Telegram</label>
        </div>
        <div class="custom-control custom-radio">
          <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
          <label class="custom-control-label" for="customRadio2">Viber</label>
        </div>
        <div class="custom-control custom-radio">
          <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
          <label class="custom-control-label" for="customRadio3">VK</label>
        </div>
        <div class="custom-control custom-radio">
          <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
          <label class="custom-control-label" for="customRadio4">e-mail</label>
        </div>
        <div class="custom-control custom-radio">
          <input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
          <label class="custom-control-label" for="customRadio5">Телефон</label>
        </div>

        <p class="lead">
          <a class="btn btn-primary btn-lg" href="#!" role="button">Выбрать</a>
        </p>
      </div>
    </div>


    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
  </body>
</html>