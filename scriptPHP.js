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

function startTask(id) {
    document.getElementById('stop').innerHTML = '0';
    document.getElementById('startId').value = id;
    var buttons = document.getElementsByClassName('start');
    for (var i=0; i < buttons.length; i++) {
        buttons[i].hidden = 'true';
    }
    var name = document.getElementById('name'+id).innerHTML;
    document.getElementById('startTitle').innerHTML = name;
    document.getElementById('timeToCompleted').innerHTML = document.getElementById('timeToCompleted'+id).innerHTML;
    timer();
}

function timer() {
    var time = 00;
    var sec = 00;
    var min = 00;
    var hour = 00;
    var timerId = setInterval(function() { //запускаем проверку на меню
        //console.log( "тик" );
        sec++;
        if (sec >= 60) {
            sec = 0;
            min++;
        }
        if (min >= 60) {
            min = 0;
            hour++;
        }
        //console.log(sec.toString().length);
        if (sec.toString().length ==1) { sec= '0'+sec; }
        if (min.toString().length ==1) { min= '0'+min; }
        if (hour.toString().length ==1) { hour= '0'+hour; }
        time= hour+':'+min+':'+sec;
        document.getElementById('timeAfterStart').innerHTML = time;

        if (document.getElementById('stop').innerHTML == '1') {
            clearInterval(timerId);
            var buttons = document.getElementsByClassName('start');
            for (var i=0; i < buttons.length; i++) {
                console.log('stop');
                buttons[i].hidden = false;
            }
        }
      }, 1000);
}

function stop() {
    document.getElementById('stop').innerHTML = '1';
    console.log(document.getElementById('stop').innerHTML);
}

function setTime() {
    var time = document.getElementById('timeAfterStart').innerHTML;
    document.getElementById('stop').innerHTML = '<input type="time" name="timeAfterStart" hidden value="'+time+'">'+
    '<input type="text" name="timeId" value=""></input>';
}