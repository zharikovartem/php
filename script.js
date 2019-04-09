window.onload = changeTop('rgb(255, 255, 255)');

  $('.navbar-collapse a').click(function (e) {
    if( $(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle' ) {
        $('.navbar-collapse').collapse('toggle');
    }
});

function changeTop(needColor) { //изменяем цвет потолка
    var color;
    if (needColor == null) {color = document.getElementById('needTop').style.borderTopColor} else {
        color = needColor;
    }

    var baseHeight = document.getElementById('parentImage').clientHeight; //высота

    var resultHeight = +baseHeight/100*18.7 +'px solid '+color;
    document.getElementById('needTop').style.borderTop = resultHeight;

    var baseWight = document.getElementById('parentImage').clientWidth;
    document.getElementById('needTop').style.width = baseWight/100*91+'px';
    var resultWight = +baseWight/100*14.3 +'px solid transparent';
    
    document.getElementById('needTop').style.borderRight = resultWight;
}

function mat()  {
    document.getElementById('needTop').style.opacity=1;
}
function glian()  {
    document.getElementById('needTop').style.opacity=0.85;
}
function satin()  {
    document.getElementById('needTop').style.opacity=0.96;
}
  
  setInterval (function(){  //Тестовое изменение размера через 0.1 сек. 
    changeTop(null);
  },100);

//   function showLustri() {
//     document.getElementById('karnizy').hidden=true;
//       document.getElementById('lustri').hidden=false;
//   }
//   function showKarnizy() {
//     document.getElementById('lustri').hidden=true;
//       document.getElementById('karnizy').hidden=false;
//   }

// function changeKarniz(karnizType) {
//     var vseKarnizy = document.getElementsByClassName('karnizy');
//     for (var i =0; i < vseKarnizy.length; i++) {
//         vseKarnizy[i].hidden = true;
//         //console.log(i);
//     }
//     document.getElementById(karnizType).hidden=false;
// }

function chengeFoto(folder) {
    selectFirstImage();
    var images = document.getElementsByClassName('primer');
    for (var i =0; i < images.length; i++) {
        var ii = i+1;
        images[i].src = 'img/examples/'+folder+'/primer'+ii+'.jpg';
    }
}

function selectFirstImage() {
    var targ = document.getElementsByClassName('car');//.remove('active');
    for (var i=0; i<targ.length; i++) {
        targ[i].classList.remove('active');
    }
    document.getElementById('caruselLI').classList.add('active');

    var fot = document.getElementsByClassName('carousel-item');
   
    for (var i=3; i<fot.length; i++) {
        fot[i].classList.remove('active');
    }
    fot[3].classList.add('active');
}

function navi(id) {
    var modul = document.getElementById(id);
    var position = modul.getBoundingClientRect();
    console.log(modul);
    
    //window.scrollBy(0, position.top);
    window.scrollBy(0, position.top);
    //modul.scrollIntoView();
    console.log(position.top++);
}

