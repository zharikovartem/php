function choseOrder(id) {
    //document.getElementById('startTitle').innerHTML = document.getElementById('rowName'+id).innerHTML;
    //deliveryAdress
    document.getElementById('clientName').value = document.getElementById('rowName'+id).innerHTML;
    //console.log(document.getElementById('rowName'+id).innerHTML);
    document.getElementById('contactPhone').innerHTML = document.getElementById('rowPhone'+id).innerHTML;
    document.getElementById('deliveryAdress').innerHTML = document.getElementById('rowSity'+id).innerHTML+', '+
    document.getElementById('rowStreet'+id).innerHTML+' '+document.getElementById('rowHouse'+id).innerHTML+'-'+
    document.getElementById('rowRoom'+id).innerHTML;
    //
    //console.log(document.getElementById('rowSity'+id).innerHTML);
    document.getElementById('createDate').innerHTML = document.getElementById('startDate'+id).innerHTML;
    document.getElementById('createTime').innerHTML = document.getElementById('startTime'+id).innerHTML;

    console.log(document.getElementsByTagName('table').length);
    var needElement = document.getElementById('raw'+id);
    document.getElementById('totalCount').value = needElement.getElementsByTagName('table').length;
}

function fillOrder() {
    console.log('try');
    var d = new Date();
    var curr_date = d.getDate();
    console.log('Значение: '+curr_date+' curr_date.toString.length: '+curr_date.toString.length);
    if(curr_date.toString.length == 1) {
        curr_date = "0"+curr_date;
    }
    var curr_month = d.getMonth() + 1;
    if(curr_month.toString.length == 1) {
        curr_month = "0"+curr_month;
    }
    var curr_year = d.getFullYear();
    var needDate = curr_year + "-" + curr_month + "-" + curr_date;
    console.log(needDate);
    console.log(document.getElementById('startDate'));
    document.getElementById('startDate').value = needDate;

    var curr_hour = d.getHours();
    if(curr_hour.toString.length == 0) {
        curr_hour = "0"+curr_hour;
    }
    var curr_min = d.getMinutes();
    if(curr_min.toString.length == 0) {
        curr_min = "0"+curr_min;
    }
    var needtime = curr_hour + ":" + curr_min;
    document.getElementById('startTime').value = needtime;
    console.log(needtime);
}

function editRow(id) {
    //console.log(document.getElementById(id));
    document.getElementById(id).removeAttribute('readonly');
    document.getElementById('editIcon').hidden = 'true';
    document.getElementById('saveIcon').removeAttribute('hidden');
}

function saveRow(id) {
    //document.getElementById(id).readonly = 'true';
    document.getElementById(id).setAttribute("readonly", "readonly");
    document.getElementById('saveIcon').hidden = 'true';
    document.getElementById('editIcon').removeAttribute('hidden');
}