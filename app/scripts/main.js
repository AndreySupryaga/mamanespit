jQuery(document).ready(function () {

    //TODO: Переместить отправку формы в отдельный файл
    var $modalForm = $('.modal-form');
    var $successMailSend = $('.success-mail-send').hide();
    $modalForm.submit(function (e) {
        e.preventDefault();
        var $form = $(this);
        var formObject = objectifyForm($form.serializeArray());
        console.log(formObject);

        var form_data = $(this).serialize(); //собераем все данные из формы
        $.ajax({
            type: 'POST', //Метод отправки
            dataType: 'json',
            //TODO: Для прода поменять на ../send.php
            url: 'send.php', //путь до php фаила отправителя
            data: form_data,
            success: function (response) {
                $modalForm.hide();
                $successMailSend.show();
            }
        });

    });

    //TODO: Переместить логику формы в отдельный файл

    $('input[name="delivery-type"]').change(function () {
        if (this.checked) {
            if (this.value == 'post-n') {
                $('.post-n-number-input').show();
                $('.post-u-address-input').hide();
            }
            else if (this.value == 'post-u') {
                $('.post-n-number-input').hide();
                $('.post-u-address-input').show();
            }
        }
    }).change();


    //TODO: Переместить инициализацию карусели в отдельный файл

    $('.carousel-container').slick({
        centerMode: true,
        centerPadding: '60px',
        slidesToShow: 3,
        autoplay: true,
        autoplaySpeed: 5000,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
    });

    // TODO: Переместить в отдельный файл

    var modal = document.getElementById('myModal');
    var btn = $('.open-modal-button');
    var span = document.getElementsByClassName('close')[0];

    btn.click(function () {
        modal.style.display = 'block';
        $modalForm.show();
        $successMailSend.hide();
    });

    span.onclick = function () {
        modal.style.display = 'none';
    };

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };

});

function objectifyForm(formArray) {//serialize data function
    var returnArray = {};
    for (var i = 0; i < formArray.length; i++) {
        returnArray[formArray[i]['name']] = formArray[i]['value'];
    }
    return returnArray;
}
