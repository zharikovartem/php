function choseOrder(id) {
    //document.getElementById('startTitle').innerHTML = document.getElementById('rowName'+id).innerHTML;
    //deliveryAdress
    document.getElementById('clientName').getElementsByTagName('input')[0].value = document.getElementById('rowName'+id).innerHTML;
    //console.log(document.getElementById('rowName'+id).innerHTML);
    document.getElementById('contactPhone').getElementsByTagName('input')[0].value = document.getElementById('rowPhone'+id).innerHTML;
    document.getElementById('deliveryAdress').getElementsByTagName('input')[0].value = document.getElementById('rowSity'+id).innerHTML+', '+
    document.getElementById('rowStreet'+id).innerHTML+' '+document.getElementById('rowHouse'+id).innerHTML+'-'+
    document.getElementById('rowRoom'+id).innerHTML;
    //
    //console.log(document.getElementById('rowSity'+id).innerHTML);
    document.getElementById('createDate').getElementsByTagName('input')[0].value = document.getElementById('startDate'+id).innerHTML;
    document.getElementById('createTime').getElementsByTagName('input')[0].value = document.getElementById('startTime'+id).innerHTML;

    //формируем таблицу товаров:
    var needElement = document.getElementById('raw'+id);
    var productsArray = needElement.getElementsByTagName('span');
    var productChildsArray = needElement.getElementsByTagName('table');
    document.getElementById('totalCount').value = needElement.getElementsByTagName('table').length;
    //console.log('work1');
    var tableBody = '';
    for (let i =1; i < productsArray.length; i++) {
        //console.log('work');
        //console.log(productsArray[i].innerHTML);
        tableBody = tableBody + '<tr><td>'+productsArray[i].innerHTML+'</td> <td>'+
        '<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample'+i+'" aria-expanded="false" aria-controls="collapseExample'+i+'">'+
        'Подробней'+
      '</button>'+
        // '<div class="collapse" id="collapseExample'+i+'">'+
        //     '<div class="card card-body">'+
        //         'Сюда следует всунуть таблицу с продуктами в зависимости от типа '+
        //     '</div>'+
        // '</div>'+
        '</td></tr>'+
        '<div class="collapse" id="collapseExample'+i+'">'+
            '<div class="card card-body">'+
                'Сюда следует всунуть таблицу с продуктами в зависимости от типа '+
                '<table class="table">'+
                getChildProducts(productChildsArray[i-1], productsArray[i].innerHTML)+
                //needElement.innerHTML+
                'test'+
                '</table>'+
            '</div>'+
        '</div>';
    }
    //console.log(getChildProducts(productChildsArray[1], productsArray[1].innerHTML));
    document.getElementById('innerDataProduct').innerHTML = tableBody;
    
}

function getChildProducts(needElement, titleSpan) {
    
    // <ul class="list-group">
    //     <li class="list-group-item">Morbi leo risus</li>
    //     <li class="list-group-item">Porta ac consectetur ac</li>
    //     <li class="list-group-item">Vestibulum at eros</li>
    // </ul>
    var resultText = '';
    resultText += '<table class="table">'

    if (titleSpan.includes('type: product')) {
        //console.log(needElement);//нужная таблица
        //console.log(needElement.innerHTML);
        var itemArrey = needElement.getElementsByTagName('tr');

        // if (itemArrey.length > 0) {
        //     resultText += itemArrey[0]
        // }
        for (var i=1; i<itemArrey.length; i++) {
            console.log(itemArrey[i]);
            var item = itemArrey[i].getElementsByTagName('td')
            for (var j=0; j<item.length; j++) {
                console.log(item[j].innerHTML);
            }
        }
    }
    return 'needElement';
}

function fillOrder() {
    console.log('try');
    var d = new Date();
    var curr_date = d.getDate();
    console.log('Значение: '+curr_date.toString()+' curr_date.toString.length: '+curr_date.toString.length);
    if(curr_date <= 9) {
        curr_date = "0"+curr_date;
    }
    var curr_month = d.getMonth() + 1;
    if(curr_month <= 9) {
        curr_month = "0"+curr_month;
    }
    var curr_year = d.getFullYear();
    var needDate = curr_year + "-" + curr_month + "-" + curr_date;
    console.log(needDate);
    console.log(document.getElementById('startDate'));
    document.getElementById('startDate').value = needDate;

    var curr_hour = d.getHours();
    if(curr_hour <= 9) {
        curr_hour = "0"+curr_hour;
    }
    var curr_min = d.getMinutes();
    if(curr_min <= 9) {
        curr_min = "0"+curr_min;
    }
    var needtime = curr_hour + ":" + curr_min;
    document.getElementById('startTime').value = needtime;
    console.log(needtime);
}

function editRow(id) {
    var elem = document.getElementById(id);
    elem.getElementsByTagName('input')[0].removeAttribute('readonly');
    elem.getElementsByTagName('img')[0].hidden = !elem.getElementsByTagName('img')[0].hidden;
    elem.getElementsByTagName('img')[1].hidden = !elem.getElementsByTagName('img')[1].hidden;
}

function saveRow(id) {
    //document.getElementById(id).readonly = 'true';
    var elem = document.getElementById(id);
    elem.getElementsByTagName('input')[0].setAttribute("readonly", "readonly");
    elem.getElementsByTagName('img')[0].hidden = !elem.getElementsByTagName('img')[0].hidden;
    elem.getElementsByTagName('img')[1].hidden = !elem.getElementsByTagName('img')[1].hidden;
}