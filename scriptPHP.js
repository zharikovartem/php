function dellIt(id) {
    //console.log('!!!');
    document.getElementById('massege1').innerHTML='Вы дейтвительно хотите ужалить  задачу '+id+'?';
    document.getElementById('deletedId').value = id;
}

function editIt(id) {
    //!!!
    document.getElementById('actionToEdit').innerHTML='Изменить: '+id+'';
    document.getElementById('formGroupExampleInput').value = id; //id
    var name = document.getElementById('name'+id).innerHTML;
    document.getElementById('formGroupExampleInput2').value = name; //name
    var child = document.getElementById('child'+id).textContent;
    
    document.getElementById('formGroupExampleInput3').value = child; //child

    var completed = document.getElementById('complited'+id).innerHTML;//completed
    if (completed == '1') {
        document.getElementById('formGroupExampleInput4').checked = true;
    } else {
        document.getElementById('formGroupExampleInput4').checked = false;
    }
    var time = document.getElementById('time'+id).innerHTML;
    console.log(time);
    document.getElementById('formGroupExampleInput5').value = time; //time
}

function chengecheckbox() {
    console.log(document.getElementById('status').value);
    if (document.getElementById('formGroupExampleInput4').checked) {
        document.getElementById('status').value = '1';
    } else {
        document.getElementById('status').value = '0';
    }
}

function test() {
    console.log('!!!');
    document.getElementById('status').value = '123';
    var test = document.getElementById('status');
    console.log(test);
}
function subtask(id) {
    var name = document.getElementById('name'+id).innerHTML;
    document.getElementById('actionToEdit').innerHTML='Создание подзадачи для '+name+':';
    document.getElementById('formGroupExampleInput3').value = id;
}

function createNew() {
    document.getElementById('actionToEdit').innerHTML='Создать новую задачу';
    document.getElementById('formGroupExampleInput').value = '';
    document.getElementById('formGroupExampleInput2').value = '';
    document.getElementById('formGroupExampleInput3').value = '0';
    document.getElementById('formGroupExampleInput4').checked = false;
    //document.getElementById('complited'+id).innerHTML = '';
}