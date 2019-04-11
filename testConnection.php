<?php
$host = 'localhost'; // адрес сервера 
$database = 'id9110365_mydb'; // имя базы данных
$user = 'id9110365_root'; // имя пользователя
$password = 'gfhjkm4501'; // пароль
$fields = getFieldNames('account');
$allSettings = selectAll('taskSettings');

function selectAll($name) {
    global $host, $database, $user, $password;
    $query = 'SELECT * FROM ' . $name;
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка подключения к БД " . mysqli_error($link));
    $result = mysqli_query($link, $query) or die("Ошибка2 в selectAll(): " . mysqli_error($link));
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
    $lastField = count($arr);
    $i = 0;
    
    foreach ($arr as $key => $value) {

        //if ($key != 'id'  && $key != 'client' && $key != 'perim' && $key != 'svet' && $key != 'angle' && $key != 'chandelier') {
        if ($key != 'id'  ) {
            $fields = $fields . '`' . $key . '`';
            $values = $values . '\'' . $value . '\'';
            $i++;
            if ($i == $lastField) {
                $fields = $fields . ')';
                $values = $values . ')';
            } else {
                $fields = $fields . ', ';
                $values = $values . ', ';
            }
        } else {
            $lastField--;
            if($key == 'client' && $key == 'perim' && $key == 'svet' && $key == 'angle' && $key == 'chandelier') {
                $newPotolok[$key] = $value;
            }
        }
    }
    if(count($newPotolok)>0) {
        insertNewPotolok($newPotolok, $arr['phone']);
    }

    $query = "INSERT INTO `$name`".$fields.''.$values;

    echo '<br>insertNew<br>'.$query.'<br><br>';

    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка1 БД insertNew" . mysqli_error($link));
    $result = mysqli_query($link, $query) or die("Ошибка2 в insertNew(): " . mysqli_error($link)); 

    mysqli_close($link);
    return null;
}



function dellIt($name, $id) {
    global $host, $database, $user, $password;
    //"DELETE FROM `task` WHERE `task`.`id` = 11"
    $query = "DELETE FROM `$name` WHERE `$name`.`id` = $id";
    //echo $query;

    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка1 БД dellIt" . mysqli_error($link));
    $result = mysqli_query($link, $query) or die("Ошибка2 в dellIt(): " . mysqli_error($link)); 


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
    //echo '<br>editTask:<br>'.$query.'<br><br>';

    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка1 БД editTask" . mysqli_error($link));
    $result = mysqli_query($link, $query) or die("Ошибка2 в editTask: " . mysqli_error($link)); 


    mysqli_close($link);
    return null;
}

function printCard($id) {
    global $arr, $allSettings;
    $hide = '';
    //$allSettings = selectAll('taskSettings');

    $show = '';

    if($allSettings['1']['data'] == '0' && $arr[$id]['completed'] == true) {
        $show = 'hidden';
        //echo 'for: '.$id.'data: '.$allSettings['1']['data'].'   completed: '.$arr[$id]['completed'].'<br>';
      }

    
    if ($arr[$id]['completed'] == true) {
        $hide = "text-black-50";
    }
    $icon = '';
    if($arr[$id]['type'] == 'Task') {
        $icon = '<img src="img/Admin/task.png" style="
        height: 40px; 
        width: 40px;
        "></img>';
    } if($arr[$id]['type'] == 'Project') {
        $icon = '<img src="img/Admin/project.svg" style="
        height: 40px; 
        width: 40px;
        "></img>';
    } if($arr[$id]['type'] == 'Folder') {
        $icon = '<img src="img/Admin/folder.svg" style="
        height: 40px; 
        width: 40px;
        "></img>';
    } 

    echo '
    <div class="card" >
    <div class="card-header py-1" role="tab" id="heading'.$id.'" '.$show.'>
      <h5 class="mb-0">
      '.$icon.'
        <span>'.$arr[$id]['id'].'</span>
        <a id="name'.$id.'" class="'.$hide.'" data-toggle="collapse" href="#collapse'.$id.'" aria-expanded="false" aria-controls="collapse'.$id.'">'.$arr[$id]['name'].'</a>
        
            <span id="child'.$id.'" hidden>'.$arr[$id]['child'].'</span>
            <span id="type'.$id.'" hidden>'.$arr[$id]['type'].'</span>
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
        if ($value['child'] == $id  && $value['completed'] != '1') {
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
 





//////// for site complet.php:

function newOrder($arr) {
    $allOrders = selectAll('account');
    //Проверяем account
    $indidClient = 0;
    foreach ($allOrders as $key => $value) {
        if($value['phone'] == $arr['phone']) {
            $indidClient = $value['id'];
            //echo 'id: '.$value['id'].'<br>';
        }
    }
    if($indidClient == 0) {
        newKlient($arr);
    } else {
        //echo $indidClient;
        $arr['id'] = $indidClient;
        oldClient($arr);
    }
    //Создаем order
    $orderFields = getFieldNames('orders');
    $order = array();
    foreach ($orderFields as $key => $value) {
        //echo $value.'<br>';
        if($arr[$value] != '') {
            $order[$value] = $arr[$value];
        } else {
            if ($value == 'startDate') {
                $order[$value] = date('Y-m-d');
                //echo date('d m Y H:i:s').'<br>';
            }
            if ($value == 'startTime') {
                $order[$value] = date('H:i:s');
                //echo date('d m Y H:i:s').'<br>';
            }
        }
    }
    $accounts = selectAll('account');
    foreach ($accounts as $key => $value) {
        if($value['phone'] == $arr['phone']) {
            $order['clientId'] = $value['id'];
        }
    }
    echo '<br>пробуем создать order<br>';
    insertNew('orders', $order);

    //Создаем potolok:
    if($arr['perim']) {
        $potolokFields = getFieldNames('potolok');
        $newPotolok = array();
        foreach ($potolokFields as $key => $value) {
            if ($arr[$value] != null) {
                echo 'est '.$value.' = '.$arr[$value].'<br>';
                $newPotolok[$value] = $arr[$value];
            }
        }
        $orders = selectAll('orders');
        foreach ($orders as $key => $value) {
            if($value['startDate'] == $order['startDate'] && $value['startTime'] == $order['startTime']) {
                $newPotolok['orderId'] = $value['id'];
            }
        }
        $newPotolok['client'] = $order['clientId'];
        //допилить проверку на совпадение даты и времени
        echo '<br>пробуем создать product. ID client: '.$newPotolok['client'].'<br>';
        var_dump($newPotolok);
        insertNewObject('potolok', $newPotolok);
    }
}

function oldClient($arr) {
    //echo 'klienta est!<br>';
    $fields = getFieldNames('account');
    $editAccount = array();
    $editAccount['id'] = $arr['id'];
    foreach ($fields as $key => $value) {
        //echo $key.' - '.$value.'<br>';
        $editAccount[$value] = $arr[$value];
    }

    editTask('account', $editAccount);
}

function newKlient($arr) {
    global $fields;
    //echo 'klienta net<br>';
    //$fields = getFieldNames('account');
    $newAccount = array();
    foreach ($fields as $key => $value) {
        //echo $key.' - '.$value.'<br>';
        $newAccount[$value] = $arr[$value];
    }
    //echo count($newAccount['phone']);
    insertNew('account', $newAccount);
}

function getFieldNames($name) {
    //echo $name;
    global $host, $database, $user, $password;
    $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$database' AND TABLE_NAME = '$name'";

    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка1 БД getFieldNames" . mysqli_error($link));
    $result = mysqli_query($link, $query) or die("Ошибка2 в getFieldNames: " . mysqli_error($link)); 

    if ($result) {
        $rows = mysqli_num_rows($result); // количество полученных строк
        $arrfields = array();

        for ($i = 0; $i < $rows; ++$i) {
            $row = mysqli_fetch_assoc($result); //каждая отдельная строка возвращается в виде Map
            for ($j = 0; $j < count($row); $j++) {
                $arrfields[$i] = $row["COLUMN_NAME"];
            }
        }
        mysqli_free_result($result);
    }

    mysqli_close($link);
    return $arrfields;
}

function insertNewObject($object, $arr) {
    $fields = getFieldNames($object);
    $resultObject = array();
    var_dump($arr);
    foreach ($fields as $key => $value) {
        if($arr[$value] != '') {
            echo 'insert :'.$value.' = '.$arr[$value].'<br>';
            $resultObject[$value] = $arr[$value];
        }
    }

    echo '$resultObject'.'<br>';
    var_dump($resultObject);
    insertNew($object, $resultObject);
}

$accounts = selectAll('account');
$potoloks = selectAll('potolok');
$products = selectAll('product');
$productItems = selectAll('productItem');
$potolokFields = getFieldNames('potolok');
$productFields = getFieldNames('product');

function setOrderRow($arr) {
    global $accounts, $potoloks, $productItems, $potolokFields, $products, $productFields;
    
    //var_dump($arr);
    //var_dump($accounts);
    //var_dump($potoloks);
    //var_dump($products);

     $needAccount = array();
     foreach ($accounts as $key => $value) {
         if($arr['clientId'] == $value['id']) {
             $needAccount = $value;
         }
     }
 
     $i = 0;
     //если есть дочерние товары:
     $childProducts = '<a class="btn btn-primary float-right" data-toggle="collapse" href="#collapseExample'.$arr['id'].'" aria-expanded="false" aria-controls="collapseExample'.$arr['id'].'">
                     Товары
                 </a>
                 <div class="collapse" id="collapseExample'.$arr['id'].'">
                     <div class="card card-body">';
     
     foreach ($productItems as $key => $value) {
         if($arr['id'] == $value['orderId']) {
            $i++;
            if($i > 1) {$row1 = '<br>';} else {$row1 = '';}
            $row1 = $row1.'<span>'.$value['id'].') type: '.$value['type'].' Описание: '.$value['name'].'</span>';

            //Добавляем потолки:
            $indexPotolok = 0;
            foreach ($potoloks as $key => $valuePotolok) {
                if ($indexPotolok == 0 && $valuePotolok['orderId'] == $value['id']) { //отрисовываем хэдэр таблици
                    $row1 = $row1.'
                    <table class="table">
                    <thead>
                    <tr>
                    ';
                    foreach ($potolokFields as $key => $valuePotolokFields) {
                        $row1 = $row1.'
                        <th>'.$valuePotolokFields.'</th>
                        ';
                    }
                    $row1 = $row1.'
                    </tr>
                    </thead>
                    ';
                }
                if($valuePotolok['orderId'] == $value['id']) { //
                    $indexPotolok++;
                    $row1 = $row1.'
                    <tr>
                    ';
                        foreach ($potolokFields as $key => $valuePotolokFields) {
                            $row1 = $row1.'
                            <td>'.$valuePotolok[$valuePotolokFields].'</td>
                            ';
                        }
                    $row1 = $row1.'
                    </tr>
                    ';
                }
            }
            if ($indexPotolok > 0 ) {
                    $row1 = $row1.'
                    </tbody>
                    </table>
                    ';
                }
            // Конец добавления потолков

            //Добавляем Продукты:
            $indexPotolok = 0;
            //echo '!!!!!!!!!!!!'.count($products).' id: '.$value['id'].'<br>';
            foreach ($products as $keyProduct => $valueProduct) {
                if ($indexPotolok == 0 && $valueProduct['productItemId'] == $value['id']) { //отрисовываем хэдэр таблици
                    $row1 = $row1.'
                    <table class="table">
                    <thead>
                    <tr>
                    ';
                    foreach ($productFields as $key => $valuePotolokFields) {
                        $row1 = $row1.'
                        <th>'.$valuePotolokFields.'</th>
                        ';
                    }
                    $row1 = $row1.'
                    </tr>
                    </thead>
                    ';
                }
                if($valueProduct['productItemId'] == $value['id']) { //отрисовываем данные
                    $indexPotolok++;
                    $row1 = $row1.'
                    <tr>
                    ';
                        foreach ($productFields as $key => $valuePotolokFields) {
                            $row1 = $row1.'
                            <td>'.$valueProduct[$valuePotolokFields].'</td>
                            ';
                        }
                    $row1 = $row1.'
                    </tr>
                    ';
                }
            }
            if ($indexPotolok > 0 ) {
                    $row1 = $row1.'
                    </tbody>
                    </table>
                    ';
                }
             // Конец добавления Продуктов

             $childProducts = $childProducts.''.$row1;
             

            
         }
     }
     $childProducts = $childProducts.'</div> </div>';
 
     if ($i == 0) {$childProducts = '';}//обнуляем товары если их нет
 
     echo '
     <li class="list-group-item" id="raw'.$arr['id'].'">'.
     '<span>№'.$arr['id'].'</span>
     <button class="btn btn-primary mx-2" onclick="choseOrder('.$arr['id'].');">Select</button>
     <button class="btn btn-primary mx-2" onclick="choseOrder('.$arr['id'].');">Edit</button>'
     .'<a id="rowName'.$arr['id'].'">'.$needAccount['name'].'</a>
     <div hidden>
     <a id="rowPhone'.$arr['id'].'">'.$needAccount['phone'].'</a>
     <a id="rowSity'.$arr['id'].'">'.$arr['adressSity'].'</a>
     <a id="rowStreet'.$arr['id'].'">'.$arr['adressStreet'].'</a>
     <a id="rowHouse'.$arr['id'].'">'.$arr['adressHouse'].'</a>
     <a id="rowRoom'.$arr['id'].'">'.$arr['adressRoom'].'</a>
     <a id="startDate'.$arr['id'].'">'.$arr['startDate'].'</a>
     <a id="startTime'.$arr['id'].'">'.$arr['startTime'].'</a>

     </div>
     
     ('.count($potoloks).')prods: 
     '.$childProducts.'
     <div hidden>
         <a id="adressSity'.$arr['id'].'">'.$needAccount['adressSity'].'</a>
         <a id="adressStreet'.$arr['id'].'">'.$needAccount['adressStreet'].'</a>
         <a id="adressHouse'.$arr['id'].'">'.$needAccount['adressHouse'].'</a>
         <a id="adressRoom'.$arr['id'].'">'.$needAccount['adressRoom'].'</a>
     </div>
     </li>
     ';
 }