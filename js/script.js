$(function() {
    $(window).on("load", function() {
        dataLayer.push({
            'event': 'universalEvent',
            'eventCategory': 'mangoLandingPageVisit',
        }); 
    });

    $('#form').on('submit', function(e){
        var fio = $('#formName').val(),
        phoneNumber = $('#formTel').val(),
        address = $('#formAddress').val();
        $.ajax({
            success: function(){
                dataLayer.push({
                    'event': 'universalEvent',
                    'eventCategory': 'mangoLandingFormSend',
                    'eventModel': {
                        'FIO': fio,
                        'phone_number': phoneNumber,
                        'address': address
                    }
                }); 
            }
        });
    });
});

function sendForm(){
    var xhr = new XMLHttpRequest();
    var body='fio='+encodeURIComponent(document.getElementById('formName').value)+'&email='+encodeURIComponent(document.getElementById('formEmail').value)+'&phone='+encodeURIComponent(document.getElementById('formTel').value)+'&address='+encodeURIComponent(document.getElementById('formAddress').value);
    var submitBtn = document.getElementById("form-btn").classList;
    xhr.open('POST', '/send-mail/', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(body);
    submitBtn.add("loading");

    xhr.onreadystatechange = function() { 
        if (xhr.readyState != 4) return;
        if (xhr.status != 200) {
          alert('Ошибка отправки формы');
       } else {
		   document.getElementById('responseText').innerHTML = xhr.responseText;
		   document.getElementById('formContainer').style.display = 'none';
		   document.getElementById('responseContainer').style.display = 'block';
       }

   }
}

//--IE
if(/(MSIE|Triden)/.test(navigator.userAgent)){
    document.body.innerHTML = '<p class="ie">Браузер не поддерживается. <br> Пожалуйста, <a href="https://www.google.ru/chrome/">установите другой браузер</a>.</p>';
}