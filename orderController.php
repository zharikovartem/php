<?php
$host = 'localhost'; // адрес сервера 
$database = 'id9110365_mydb'; // имя базы данных
$user = 'id9110365_root'; // имя пользователя
$password = 'gfhjkm4501'; // пароль

function createNewOrder($arr) {
    var_dump($arr);
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
        if ($key != 'id') {
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
        }
    }
    $query = "INSERT INTO `$name`".$fields.''.$values;
echo $query;
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка1 " . mysqli_error($link));
    $result = mysqli_query($link, $query) or die("Ошибка2 " . mysqli_error($link)); 
    mysqli_close($link);
    return 'новый заказ добавлен!';
}

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

$accounts = selectAll('account');
$potoloks = selectAll('potolok');

function setOrderRow($arr) {
   global $accounts, $potoloks;

    $needAccount = array();
    foreach ($accounts as $key => $value) {
        if($arr['clientId'] == $value['id']) {
            $needAccount = $value;
        }
    }

    //require_once 'testConnection.php';
    $i = 0;
    $products = '<a class="btn btn-primary float-right" data-toggle="collapse" href="#collapseExample'.$arr['id'].'" aria-expanded="false" aria-controls="collapseExample'.$arr['id'].'">
                    Товары
                </a>
                <div class="collapse" id="collapseExample'.$arr['id'].'">
                    <div class="card card-body">';
    
    foreach ($potoloks as $key => $value) {
        if($arr['id'] == $value['orderId']) {
            $i++;
            if($i > 1) {$row1 = '<br>';} else {$row1 = '';}
            $row1 = $row1.'<span>'.$value['id'].'</span>';
            $products = $products.''.$row1;
            //echo 'sovp: '.$products;
        }
    }
    $products = $products.'</div> </div>';

    if ($i == 0) {$products = '';}

    echo '
    <li class="list-group-item">'.
    '<span>№'.$arr['id'].'</span>
    <button class="btn btn-primary mx-2" onclick="choseOrder('.$arr['id'].');">Select</button>'
    .'<a id="rowName'.$arr['id'].'">'.$needAccount['name'].'</a> - 
    <a id="rowPhone'.$arr['id'].'">'.$needAccount['phone'].'</a>
    
    ('.count($potoloks).')prods: 
    '.$products.'
    <div hidden>
        <a id="adressSity'.$arr['id'].'">'.$needAccount['adressSity'].'</a>
        <a id="adressStreet'.$arr['id'].'">'.$needAccount['adressStreet'].'</a>
        <a id="adressHouse'.$arr['id'].'">'.$needAccount['adressHouse'].'</a>
        <a id="adressRoom'.$arr['id'].'">'.$needAccount['adressRoom'].'</a>
    </div>
    </li>
    ';
}


?>