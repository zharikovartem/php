<!doctype html>
<html lang="en">
  <head>
  <?php
  require_once 'orderController.php'; // подключаем скрипт
if (isset($_GET["phone"])) {
    //echo 'orderPhone';
    $newOrder = array();
        foreach ($_GET as $key => $value) {
          $newOrder[$key] = $value;
        }
    //createNewOrder($newOrder);
    insertNew('orders', $newOrder);
}
  ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Orders</title>
  </head>
  <body>
  <div class="m-3">
  <button type="button" class="btn btn-primary"><a href="index.php" class="text-light">Back</a></button>
  <button type="button" class="btn btn-primary"><a href="order.php" class="text-light">Refresh</a></button>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="fillOrder();">
    Crate New Order
  </button>
  </div>
    <!-- Modal -->
    <form method="get" action="order.php">
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...

        <div class="input-group" hidden>
            <div class="input-group-prepend">
                <span class="input-group-text" >Id</span>
            </div>
            <input type="text" class="form-control" name="id">
        </div>

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" >Контактный Телефон Заказчика</span>
            </div>
            <input type="text" class="form-control" name="phone">
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">ФИО Заказчика</span>
            </div>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Адрес Доставки</span>
            </div>
            <input type="text" placeholder="Город" class="form-control" name="adressSity">
            <input type="text" placeholder="Улица" class="form-control" name="adressStreet">
            <input type="text" placeholder="Дом" class="form-control" name="adressHouse">
            <input type="text" placeholder="Квартира" class="form-control" name="adressRoom">
        </div>

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Дата заказа</span>
            </div>
            <input type="date" class="form-control" id="startDate" name="startDate">
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Время поступления заказа</span>
            </div>
            <input type="time" class="form-control" id="startTime" name="startTime">
        </div>
        <!-- <button onclick="alert(document.getElementById('startTime').value);">123</button> -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Order</button>
        <button type="button" class="btn btn-primary">Приступить к Обработке</button>
      </div>
    </div>
  </div>
</div>
</form>

<form method="get" action="index.php">
<div class="container-fluid" id="start">
  <div class="card">
  <div class="card-body">
    <h4 class="card-title" id="startTitle">Активный Заказ</h4>
    <p id="stop" class="card-text" hidden>
    
      3
    </p>
    <span>Контактный телефон: </span> 
    <span id="contactPhone"></span>
    <br>
    <span>Адресс: </span> 
    <span name="deliveryAdress" id="deliveryAdress"></span>
    <br>
    <input type="text" name="startId" id="startId" hidden/>
    <br>
    <a class="btn btn-primary" onclick="stop();">Pause</a>
    <button type="submit" class="btn btn-primary" onclick="setTime();">Complete</button>
  </div>
  </div>
</div>
</form>

<br>
<ul class="list-group">
  <?php
  $arr = selectAll('orders');
  foreach ($arr as $key => $value) {
    setOrderRow($value);
  }
    
  ?>
  <!-- <li class="list-group-item">Porta ac consectetur ac</li>
  <li class="list-group-item">Vestibulum at eros</li> -->
</ul>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="orderScript.js"></script> <!-- подключили JS -->
  </body>
</html>