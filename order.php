<!doctype html>
<html lang="en">
  <head>
  <?php
require_once 'testConnection.php'; // подключаем скрипт
if (isset($_GET["phone"])) {
    //echo 'orderPhone';
    $newOrder = array();
        foreach ($_GET as $key => $value) {
          $newOrder[$key] = $value;
        }
    //createNewOrder($newOrder);
    //insertNew('orders', $newOrder);
    //insertNewObject('orders', $newOrder);
    newOrder($newOrder);
}
  ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Валидация: -->
<link rel="stylesheet" type="text/css" href="bootstrapformhelpers/css/bootstrap-formhelpers.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <script src="orderScript.js"></script> <!-- подключили JS -->
    <link rel="stylesheet" href="cssToPhp.css">

    <title>Orders</title>
  </head>
  <body>
  <div class="m-3">
  <button type="button" class="btn btn-primary"><a href="test.php" class="text-light">Back</a></button>
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
<div class="container">
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
            <!-- <input type="text" class="form-control" name="phone"> -->
            <input type="text" name="phone" class="form-control mr-1 bfh-phone mx-auto" data-format="+375( dd ) ddd-dd-dd"/>
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
            <input type="date" class="form-control" id="startDate" name="startDate" value="2000-00-00">
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Время поступления заказа</span>
            </div>
            <input type="time" class="form-control" id="startTime" name="startTime" value="00:00">
        </div>
</div>
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

<form method="get" action="order.php">
<div class="container-fluid" id="start">
  <div class="card">
  <div class="card-body">
    <h4 class="card-title" id="startTitle">Активный Заказ</h4>
    <span>Статус заказа:</span>
    <p id="stop" class="card-text" hidden>
    
      3
    </p>
    <div class="row">
      <div class="col-6 border border-dark">
        <div class="row">
          <div class="col-11 pr-1">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text p-1">Имя клиента:</span>
              </div>
              <input type="text" class="form-control p-1" id="clientName" value="" readonly>
            </div>
          </div>
          <div class="col-1 d-flex justify-content-start flex-wrap align-content-center p-0">
            <img src="img/Admin/Edit.png" alt="" style="height: 30px; width: 30px;" id="editIcon" class="edit" onclick="editRow('clientName');">
            <img src="img/Admin/Save.png" alt="" style="height: 30px; width: 30px;" id="saveIcon" class="edit" onclick="saveRow('clientName');" hidden>
          </div>
        </div>
            <!-- <span>Имя клиента: </span> 
            <span id=""></span>
            <br> -->
            <span>Контактный телефон: </span> 
            <span id="contactPhone"></span>
            <br>
            <span>Адресс: </span> 
            <span name="deliveryAdress" id="deliveryAdress"></span>
            <br>
            <span>Дата приема заказа: </span> 
            <span name="createDate" id="createDate"></span>
            <br>
            <span>Время приема заказа: </span> 
            <span name="createTime" id="createTime"></span>
            <br>
            <div hidden>
              <input type="text" name="startId" id="startId" hidden/>
            </div>
      </div>
      
      <div class="col-6 border border-dark">
        <span>Следующий звонок:</span>
        <br>
        <span>Дата доставки:</span>
      </div>
    </div>
    <div class="row">

      <div class="col-4">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Всего позиций:</span>
          </div>
          <input type="text" class="form-control" id="totalCount" value="" readonly>
        </div>
      </div>

      <div class="col-4">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Всего позиций:</span>
          </div>
          <input type="text" class="form-control" id="totalCount?" value="???" readonly>
        </div>
      </div>

    </div>

    
      <br>
    <!-- <a class="btn btn-primary" onclick="stop();">Pause</a>
    <button type="submit" class="btn btn-primary" onclick="setTime();">Complete</button> -->
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
    
  </body>
</html>