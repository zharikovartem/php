<!doctype html>
<html lang="en">
<head>
    <?php
        require_once 'testConnection.php';
    ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Diary</title>
</head>
<body>
    <h1>Дневник: </h1>
    <label for="today">Дата</label>
    <input type="date" class="form-control" id="today" name="today" style="min-width:200px; width: 10vw;">

    <table class="table table-bordered">
    <thead>
        <tr>
        <th>Id</th>
        <th>Date</th>
        <th>Task Id</th>
        <th>Task Name</th>
        <th>Start Time</th>
        <th>Stop Time</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $plans = selectAll('diary');
            $tasks = selectAll('task');


            foreach ($plans as $key => $value) {
                echo '
                <tr>
                <td>'.$value['id'].'</td>
                <td>'.$value['date'].'</td>
                <td>'.$value['taskId'].'</td>
                <td>'.$tasks[$value['taskId']]['name'].'</td>
                <td>'.$value['startTime'].'</td>
                <td>'.$value['stopTime'].'</td>
                </tr>
                ';
            }
        ?>
        <!-- <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        </tr>
        <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        </tr> -->
    </tbody>
    </table>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>