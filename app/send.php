<?
include 'LiqPay.php';

//return getForm();
if((isset($_POST['full-name'])&&$_POST['contacts'])){ //Проверка отправилось ли наше поля name и не пустые ли они
    $to = 'andrew.supryaga@gmail.com'; //Почта получателя, через запятую можно указать сколько угодно адресов
    $subject = 'Обратный звонок'; //Загаловок сообщения
    $message = '
                <html>
                    <head>
                        <title>'.$subject.'</title>
                    </head>
                    <body>
                        <p>Имя: '.$_POST['full-name'].'</p>
                        <p>Телефон: '.$_POST['contacts'].'</p>                        
                        <p>Комментарий: '.$_POST['comments'].'</p>                        
                    </body>
                </html>'; //Текст нащего сообщения можно использовать HTML теги
    $headers  = "Content-type: text/html; charset=utf-8 \r\n"; //Кодировка письма
    $headers .= "From: Отправитель <mamanespit@example.com>\r\n"; //Наименование и почта отправителя
    mail($to, $subject, $message, $headers); //Отправка письма с помощью функции mail
    echo json_encode( 'Письмо успешно отправленно' );
}

//
//function getForm($order_id = 0){
//
//    $public_key = 'i98657408727';
//    $private_key= 'pxCBaXSHtYxHhxShUM7h5DXLPYItFNJGUAeIWtzi';
//
//    $liqpay = new LiqPay($public_key, $private_key);
//    $html = $liqpay->cnb_form(array(
//        'version'=>'3',
//        'action'         => 'pay',
//        'amount'         => 10, // сумма заказа
//        'currency'       => 'UAH',
//
//        //TODO: Добавить запись в таблицу
//        /* перед этим мы ведь внесли заказ в  таблицу,
//        $insert_id = $wpdb->query( 'insert into table_orders' );
//        */
////        'description'    => 'Оплата заказа № '.$insert_id,
//
//        'description'    => 'Оплата заказа № 111',
//        'order_id'       => 1212121212,
//        // если пользователь возжелает вернуться на сайт
//        'result_url'	=>	'http://mamanespit.com',
//        /*
//            если не вернулся, то Webhook LiqPay скинет нам сюда информацию из формы,
//            в частонсти все тот же order_id, чтобы заказ
//             можно было обработать как оплаченый
//        */
//        'server_url'	=>	'http://mydomain.site/liqpay_status/',
//        'language'		=>	'ru', // uk, en
//        'sandbox'=>'1' // и куда же без песочницы,
//        // не на реальных же деньгах тестировать
//    ));
//
//    $res_arr = array("status"=>1, 'form'=>$html, 'order_num'=>111, 'error'=>'Ошибка');
//    echo json_encode( $res_arr ); // вернем нашу сгенерированную форму для отправки
//    //покупателя на LiqPay
////    wp_die();
//
//}

// слушатель статуса
//add_action('init', function(){
//
//    if(is_page('liqpay_status')){ //проверим чтобы код не срабатывал на всех страницах
//
//        if( isset($_POST['data']) ){
//
//            $result= json_decode( base64_decode($_POST['data']) );
//            // данные вернуться в base64 формат JSON
//
//            if( $result->status == 'success' ){
//                global $wpdb;
//                $sql_up = "UPDATE `table_orders` SET paid=1 WHERE ID=%d";
//                // обновим статус заказа
//                $wpdb->query( $wpdb->prepare($sql_up, $result->order_id) );
//            }
//        }
//    }
//});
?>