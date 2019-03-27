<?php
$host = 'localhost'; // адрес сервера 
$database = 'mydb'; // имя базы данных
$user = 'root'; // имя пользователя
$password = ''; // пароль
$arr = selectAll('task');
//select('task');

function selectAll($name)
{
    global $host, $database, $user, $password;
    $query = 'SELECT * FROM ' . $name;
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));
    $result = mysqli_query($link, $query) or die("Ошибка2 " . mysqli_error($link));
    ///////////////////////////////////////////////////////////
    if ($result) {
        $rows = mysqli_num_rows($result); // количество полученных строк
        $arr = array();

        for ($i = 0; $i < $rows; ++$i) {
            $row = mysqli_fetch_assoc($result); //каждая отдельная строка возвращается в виде Map
            for ($j = 0; $j < count($row); ++$j) {
                $arr[$row['id']] = $row;
            }
        }
        mysqli_free_result($result);
    }
    ///////////////////////////////////////////////////////////
    mysqli_close($link);
    return $arr;
}

function insertNew($name, $arr)
{
    global $host, $database, $user, $password;
    $query = "INSERT INTO `$name` (`Name`, `id`) VALUES ('{$arr['name']}', '{$arr['id']}')";
    
    $fields = "(";
    $values = " VALUES (";
    $lastField = count($arr)-1;
    $i = 0;
    foreach ($arr as $key => $value) {
        //if ($value == '') {$value=0;}
        if ($key != 'id') {
            $fields = $fields . '`' . $key . '`';
            $values = $values . '\'' . $value . '\'';
//echo $key.' = '.$value.'<br>';
            $i++;
            if ($i == $lastField) {
                $fields = $fields . ')';
                $values = $values . ')';
            } else {
                $fields = $fields . ', ';
                $values = $values . ', ';
            }
        }
    }
    $query = "INSERT INTO `$name`".$fields.''.$values;
    //echo  $fields . '<br>';
    //echo  $values . '<br>';

    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка1 " . mysqli_error($link));
    $result = mysqli_query($link, $query) or die("Ошибка2 " . mysqli_error($link)); 


    //$sql = mysqli_query($link, "INSERT INTO `'.$name.'` (`Name`, `Price`) VALUES ('{$_GET['Name']}', '{$_GET['Id']}')");
    //echo "INSERT INTO `$name` (`Name`, `id`) VALUES ('{$arr['id']}', '{$arr['name']}')";
    mysqli_close($link);
    return null;
}

function dellIt($name, $id) {
    global $host, $database, $user, $password;
    //"DELETE FROM `task` WHERE `task`.`id` = 11"
    $query = "DELETE FROM `$name` WHERE `$name`.`id` = $id";
    //echo $query;

    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка1 " . mysqli_error($link));
    $result = mysqli_query($link, $query) or die("Ошибка2 " . mysqli_error($link)); 


    mysqli_close($link);
    return null;
}

function editTask($name, $arr) {
    global $host, $database, $user, $password;
    //UPDATE `task` SET `name` = '12345678', `child` = '5' WHERE `task`.`id` = 20
    $lastField = count($arr)-1;
    $i = 0;
    foreach ($arr as $key => $value) {
       if ($key != 'id') {
            $item = $item.' `'.$key.'` = \''.$value.'\'';
            $i++;
            if ($i != $lastField) {
                $item = $item . ',';

            }
       }
    }
    $query = "UPDATE `$name` SET".$item.' WHERE `'.$name.'`.`id` = '.$arr['id'];
    //echo $query;

    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка1 " . mysqli_error($link));
    $result = mysqli_query($link, $query) or die("Ошибка2 " . mysqli_error($link)); 


    mysqli_close($link);
    return null;
}

function printCard($id) {
    global $arr;

    $hide = '';
    if ($arr[$id]['completed'] == true) {
        $hide = "text-black-50";
    }

    echo '
    <div class="card">
    <div class="card-header" role="tab" id="heading'.$id.'">
      <h5 class="mb-0">
        <span>'.$arr[$id]['id'].'</span>
        <a id="name'.$id.'" class="'.$hide.'" data-toggle="collapse" href="#collapse'.$id.'" aria-expanded="false" aria-controls="collapse'.$id.'">'.$arr[$id]['name'].'</a>
        <span id="child'.$id.'" hidden>'.$arr[$id]['child'].'</span>
        <span id="complited'.$id.'" hidden>'.$arr[$id]['completed'].'</span>
        <span id="timeToCompleted'.$id.'">'.getTime($id).'</span>
        <span>('.$arr[$id]['start'].')</span>
        <div class="float-right">
        <button class="btn btn-success start" onclick="startTask('.$id.');" >Start</button>
        </div>
      </h5>
    </div>
    ';
    echo '
    <div id="collapse'.$id.'" class="collapse" role="tabpanel" aria-labelledby="heading'.$id.'">
        <div class="card-body p-1">

        <label for="realization">Время на выполнение: </label>
        <span name="realization" id="time'.$id.'">'.$arr[$id]['realization'].'</span>

        <div class="dropdown d-flex justify-content-end">
            <button class="btn btn-secondary dropdown-toggle"
                    type="button" id="dropdownMenu1" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                Dropdown
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#exampleModal2" onclick="dellIt('.$id.');">
                Dell</button>
                <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#exampleModal" onclick="editIt('.$id.');">
                Edit</button>
                <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#exampleModal" onclick="subtask('.$id.');">
                Subtask</button>
            </div>
        </div>

        </div>
    </div>
    ';
    
    $item = $arr[$id];
    //echo $item['child'].'123: '.$item['child'];

    foreach ($arr as $key => $value) {
       if ($value['child'] == $id) {
        //echo 'est child';
        echo '
        <div id="collapse'.$id.'" class="collapse" role="tabpanel" aria-labelledby="heading'.$id.'">
            <div class="card-body py-1">';
            printCard($value['id']);
        echo '
            </div>
            </div>
        </div>
        ';
       }
    }
    echo '</div';
}

function getTime($id) {
    global $arr;
    $time = timeToMin($arr[$id]['realization']);
    //echo '<br>!!!func res: '.getChild($id);
    $time = $time + getChild($id);
    //echo 'func res: '. timeToMin(getChild($id));

    $time = date("H:i:s", mktime(0, 0, $time));
    //echo'result time:'.$time;

    return $time;
}

function getChild($id) {
    global $arr;
    $time = 0;
    foreach ($arr as $key => $value) {
        //проверяем на наличие чилдов
        //echo $value['id'].'<br>';
        if ($value['child'] == $id) {
            //$time = $time + timeToMin($arr[$id]['realization']);
            //echo '<br>before time'. $time;
            $time = $time + timeToMin($value['realization'])+getChild($value['id']);
            //echo '<br>that time'. $time;
            //echo 'tryChengeIt'.$value['id'].' = '.$value['realization'].'<br>';
        }
    }
    //echo '<br>total time'.$time;
    return $time;
    //return null;
}

function timeToMin($time) {
   $timeArr = explode(':', $time);
   //echo '<br>start $time: '.$time.'<br>';
   //var_dump($timeArr);
    
   $h = (int)$timeArr[0]*1;
   //echo 'hours: '.$timeArr[0].'<br>';
   if ($h == '00') {
       $h=0;
   }
   //echo 'h: '.$h;
   $m = (int)$timeArr[1]*1;
   if ($m == '00') {
       $m=0;
   }
   //echo 'm: '.$m;
   $s = (int)$timeArr[2]*1;
   if ($s == '00') {
       $s=0;
   }
   //echo 's: '.$s;
   
   //echo 'time: '.$time;
   //echo 'h '.$h.'m '.$m.'s '.$s.'<br>';
   //echo '<br>';
   $totalTime = $s+$m*60+$h*3600;
   //echo'<br>total perv: '.$totalTime.'<br>';
   //echo date("H:i:s", mktime(0, 0, $totalTime)).'<br>';

   return $totalTime;
}


function saveTime($time) {
    $arr = selectAll('task');
    
    echo date('d m Y H:i:s');
    echo '<br>'.$time['start'];
    echo '<br>'.$arr[$time['id']]['start'];

    $totalTime = timeToMin($time['start']) + timeToMin($arr[$time['id']]['start']);

    $time['start'] = date("H:i:s", mktime(0, 0, $totalTime));
    editTask('task', $time);
    echo '<br>result: '.$time['start'];//298
}
 