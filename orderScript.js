function choseOrder(id) {
    document.getElementById('startTitle').innerHTML = document.getElementById('rowName'+id).innerHTML;
    //deliveryAdress
    document.getElementById('contactPhone').innerHTML = document.getElementById('rowPhone'+id).innerHTML;
    document.getElementById('deliveryAdress').innerHTML = 
    document.getElementById('adressSity'+id).innerHTML + " " +
    document.getElementById('adressStreet'+id).innerHTML  + " " +
    document.getElementById('adressHouse'+id).innerHTML  + "-" +
    document.getElementById('adressRoom'+id).innerHTML;
}

function fillOrder() {
    var d = new Date();
    var curr_date = d.getDate();
    if(curr_date.toString.length == 0) {
        curr_date = "0"+curr_date;
    }
    var curr_month = d.getMonth() + 1;
    if(curr_month.toString.length == 1) {
        curr_month = "0"+curr_month;
    }
    var curr_year = d.getFullYear();
    var needDate = curr_year + "-" + curr_month + "-" + curr_date;
    document.getElementById('startDate').value = needDate;

    var curr_hour = d.getHours();
    var curr_min = d.getMinutes();
    var needtime = curr_hour + ":" + curr_min;
    document.getElementById('startTime').value = needtime;
}