<?php
$host = 'localhost'; // адрес сервера 
$database = 'mydb'; // имя базы данных
$user = 'root'; // имя пользователя
$password = ''; // пароль

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

function setOrderRow($arr) {
    echo '
    
    <li class="list-group-item">'.
    '<button class="btn btn-primary mx-2" onclick="choseOrder('.$arr['id'].');">Select</button>'
    .'<a id="rowName'.$arr['id'].'">'.$arr['name'].'</a> - 
    <a id="rowPhone'.$arr['id'].'">'.$arr['phone'].'</a>
    <div hidden>
        <a id="adressSity'.$arr['id'].'">'.$arr['adressSity'].'</a>
        <a id="adressStreet'.$arr['id'].'">'.$arr['adressStreet'].'</a>
        <a id="adressHouse'.$arr['id'].'">'.$arr['adressHouse'].'</a>
        <a id="adressRoom'.$arr['id'].'">'.$arr['adressRoom'].'</a>
    </div>
    </li>
    ';
}


?>