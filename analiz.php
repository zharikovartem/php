<!doctype html>
<html lang="en">
  <head>
<?php
    require_once 'testConnection.php'; // подключаем скрипт
    echo 'testConnection comleted<br>';
?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Анализ задач</title>
  </head>
  <body>
    <h1>Задачи для анализа:</h1>
    <br>

    <?php
        $allTasks = selectAll('task');
        //var_dump($allTasks);
        $i =0;
        foreach ($allTasks as $key => $value) {
            if($value["realization"] == '00:00:00' && $value["completed"] != '1' && $value["type"] != 'Project' && $value["type"] != 'Folder') {
                $i++;
                echo '<br> '.$i.') id: '.$value['id'].' - '.$value['name'].' - '.$value["completed"].' - '.$value["child"];
            }
        }
        echo '<br><h1>Задачи для планирования:</h1>';
        $i =0;
        foreach ($allTasks as $key => $value) {
            if($value["realization"] != '00:00:00' && $value["completed"] != '1' && $value["type"] != 'Project' && $value["type"] != 'Folder') {
                echo '<br> '.$i.') id: '.$value['id'].' Время: '.$value["realization"].' - '.$value['name'].' родитель: '.$allTasks[$value["child"]]["name"];
            }
        }
        echo '<br><h1>Итого времени:</h1>';
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

<?php

?>