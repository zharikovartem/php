<?php
require_once 'testConnection.php'; // подключаем скрипт
echo 'test';
//var_dump (selectAll('task'));
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="bootstrapformhelpers/css/bootstrap-formhelpers.min.css">
    <script type="text/javascript" src="bootstrapformhelpers/js/bootstrap-formhelpers.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="cssToPhp.css">
    <title>php admin</title>
</head>

<body>
    <?php
    require_once 'testConnection.php'; // подключаем скрипт
    //echo printElement('3');
    if (isset($_GET["timeAfterStart"])) {
      //echo 'timeAfterStart: '.$_GET["timeAfterStart"].'<br>';
      $start['id'] = $_GET["startId"];
      $start['start'] = $_GET["timeAfterStart"];
      saveTime($start);
    }
    if (isset($_POST["dellId"])) {
      echo 'work!!!<br>';
      dellIt('task', $_POST["dellId"]);
    }
    if ($_GET["id"] == "") {
      if (isset($_GET["name"])) {
        $newTask = array();
        foreach ($_GET as $key => $value) {
          $newTask[$key] = $value;
        }
        insertNew('task', $newTask);
      }
    } else {
      $newTask = array();
      foreach ($_GET as $key => $value) {
        $newTask[$key] = $value;
      }
      editTask('task', $newTask);
    }




    $arr = selectAll('task');

    ?>
    <!-- <div class="container-fluid">
  <div class="row">
    <div class="col-12 text-right text-sm-left text-md-left text-lg-left text-xl-left">col</div>
    <div class="col-12 text-left text-sm-right text-md-left text-lg-left text-xl-left">sm</div>
    <div class="col-12 text-left text-sm-left text-md-right text-lg-left text-xl-left">md</div>
    <div class="col-12 text-left text-sm-left text-md-left text-lg-right text-xl-left">lg</div>
    <div class="col-12 text-left text-sm-left text-md-left text-lg-left text-xl-right">xl</div>
  </div>
</div> -->
<div id="accordionSettings" role="tablist">
  <div class="card" >
    <div class="card-header d-flex justify-content-end" role="tab" id="headingSettings">
      <h5 class="mb-0">
        <a data-toggle="collapse" href="#collapseSettings" aria-expanded="true" aria-controls="collapseSettings">
          Settings
        </a>
      </h5>
    </div>

    <div id="collapseSettings" class="collapse" role="tabpanel" aria-labelledby="headingSettings">
      <div class="card-body">
        Сюда следует добавить настройки для отображения задач
        <form method="get" action="test.php">
        <!-- <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" name="showCompleted" id="showCompleted">
          <label class="custom-control-label" for="showCompleted">Отображать завершенные задачи</label>
        </div> -->
        <?php
          $allSettings = selectAll('taskSettings');
          foreach ($allSettings as $key => $value) {
            $checked = '';
            if ($value['data'] == '1' && $value['type'] == 'checkbox') {
              $checked = 'checked';
            }
            echo '
            <div class="custom-control custom-checkbox">
              <input type="'.$value['type'].'" class="custom-control-input" name="setting'.$value['id'].'" id="setting'.$value['id'].'" '.$checked.'>
              <label class="custom-control-label" for="setting'.$value['id'].'">'.$value['name'].'</label>
            </div>
            ';
          }
        ?>
        <button type="submit" class="btn btn-primary" onclick="">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<form method="get" action="test.php">
<div class="container-fluid" id="start">
  <div class="card">
  <div class="card-body">
    <h4 class="card-title" id="startTitle">Активная задача</h4>
    <p id="stop" class="card-text" hidden>
    
      3
    </p>
    <span>Время на выполнение: </span> 
    <span id="timeToCompleted"></span>
    <br>
    <span>Время после старта: </span> 
    <span name="timeAfterStart" id="timeAfterStart"></span>
    <br>
    <input type="text" name="startId" id="startId" hidden/>
    <br>
    <a class="btn btn-primary" onclick="stop();">Pause</a>
    <button type="submit" class="btn btn-primary" onclick="setTime();">Complete</button>
  </div>
  </div>
</div>
</form>


    <div class="container-fluid m-2">
        <button type="button" class="btn btn-primary"><a href="test.php" class="text-light">Refresh</a></button>
        <button type="button" class="btn btn-primary"><a href="index.html" class="text-light">Back</a></button>
        <!-- Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="createNew();">
            Create New Task
        </button>
        <a href="order.php">orders</a>
    </div>

    <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="get" action="test.php" id="tryIt">

                        <div class="form-group">
                            <label for="formGroupExampleInput" id="actionToEdit">Id(не заполнять)</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" name="id" placeholder="Example input" hidden>
                        </div>

                        <div class="form-group">
                            <label for="formGroupExampleInput2">Name</label>
                            <input type="text" class="form-control" id="formGroupExampleInput2" name="name" placeholder="Another input">
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="formGroupExampleInput3">child</label>
                                    <input type="text" value="0" class="form-control" id="formGroupExampleInput3" name="child" placeholder="0">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="formGroupExampleInput4">Status (completed)</label>
                                    <input type="text" default="0" id="status" name="completed" hidden>
                                    <input type="checkbox" onclick="chengecheckbox();" class="form-control" id="formGroupExampleInput4" placeholder="Another input">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="formGroupExampleInput5">Время</label>
                                    <input type="time" value="00:00:00" class="form-control bfh-timepicker" data-time="00:00" id="formGroupExampleInput5" name="realization" placeholder="0">
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="createNew();">Close</button>
                    <button type="submit" class="btn btn-primary" form="tryIt">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->

    <div class="modal" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="test.php" id="dellIt">
                        <label for="deletedId" id="massege1">child</label>
                        <input type="text" class="form-control" name="dellId" id="deletedId" hidden>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" form="dellIt">Dell</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end 2 modal -->




    <div id="accordion" role="tablist">
        <?php
        
        foreach ($arr as $key => $value) {
          if ($value['child'] == 0) {
            printCard($value['id']);
          }
        }
        ?>
    </div>
    </div>

    <button onclick="test();">test</button>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="scriptPHP.js"></script> <!-- подключили JS -->
</body>

</html>
<?php

?> 