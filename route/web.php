<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

session_start();
Route::get('/', function () {
    if(!isset($_SESSION['log'])){
        return view('login');  
    }

    if($_SESSION['log'] != 'true'){
        return view('login');  
    }

    $json = json_decode(file_get_contents("https://api.coinmarketcap.com/v1/ticker/"));

    foreach($json as $abshir){
        $data = []; 
        if($abshir->name == 'Bitcoin'){
        
        $data['symbol'] = $abshir->symbol;
        $data['price'] =  "$".$abshir->price_usd;
        $data['one_hour'] =  $abshir->percent_change_1h."%";
        $data['one_day'] =  $abshir->percent_change_24h."%";
        $data['seven_days'] =  $abshir->percent_change_7d."%";

        // this shows the recorded price of the last time you logged out

        if(isset($_SESSION['usd'])){
        $data['difference'] = $abshir->price_usd - $_SESSION['usd'];
        $data['percent_difference'] = $data['difference'] / $abshir->price_usd. "%";
        } else {
        $data['percent_difference'] = 'No logs yet';   
        }

        // this part is the graphic arrows 
        if($data['one_hour'] < 0){
        $data['arrow_hour'] = 'fa fa-arrow-down';
        } else {
        $data['arrow_hour'] = 'fa fa-arrow-up';
        }

        if($data['one_day'] < 0){
        $data['arrow_day'] = 'fa fa-arrow-down';
        } else {
        $data['arrow_day'] = 'fa fa-arrow-up';
        }

        if($data['seven_days'] < 0){
        $data['arrow_seven'] = 'fa fa-arrow-down';
        } else {
        $data['arrow_seven'] = 'fa fa-arrow-up';
        }

    return view('index', $data);

}
}
});

Route::get('/aud', function () {
    $json = json_decode(file_get_contents("https://api.coinmarketcap.com/v1/ticker/?convert=aud&limit=10"));

    foreach($json as $abshir){
        $data = []; 
        if($abshir->name == 'Bitcoin'){
        $data['symbol'] = $abshir->symbol;
        $data['price'] =  "A$".$abshir->price_aud;
        $data['one_hour'] =  $abshir->percent_change_1h."%";
        $data['one_day'] =  $abshir->percent_change_24h."%";
        $data['seven_days'] =  $abshir->percent_change_7d."%";

         // this shows the recorded price of the last time you logged out
        if(isset($_SESSION['aud'])){
        $data['difference'] = $abshir->price_aud - $_SESSION['aud'];
        $data['percent_difference'] = $data['difference'] / $abshir->price_aud. "%";
        } else {
        $data['percent_difference'] = 'No logs yet';   
        }

        // this part is the graphic arrows 
        if($data['one_hour'] < 0){
        $data['arrow_hour'] = 'fa fa-arrow-down';
        } else {
        $data['arrow_hour'] = 'fa fa-arrow-up';
        }

        if($data['one_day'] < 0){
        $data['arrow_day'] = 'fa fa-arrow-down';
        } else {
        $data['arrow_day'] = 'fa fa-arrow-up';
        }

        if($data['seven_days'] < 0){
        $data['arrow_seven'] = 'fa fa-arrow-down';
        } else {
        $data['arrow_seven'] = 'fa fa-arrow-up';
        }

    return view('index', $data);

}
}
});

Route::get('/eur', function () {
    $json = json_decode(file_get_contents("https://api.coinmarketcap.com/v1/ticker/?convert=eur&limit=10"));

    foreach($json as $abshir){
        $data = []; 
        if($abshir->name == 'Bitcoin'){
        $data['symbol'] = $abshir->symbol;
        $data['price'] =  "€".$abshir->price_eur;
        $data['one_hour'] =  $abshir->percent_change_1h."%";
        $data['one_day'] =  $abshir->percent_change_24h."%";
        $data['seven_days'] =  $abshir->percent_change_7d."%";

        // this shows the recorded price of the last time you logged out
        if(isset($_SESSION['eur'])){
        $data['difference'] = $abshir->price_eur - $_SESSION['eur'];
        $data['percent_difference'] = $data['difference'] / $abshir->price_eur. "%";
        } else {
        $data['percent_difference'] = 'No logs yet';   
        }

        // this part is the graphic arrows 
        if($data['one_hour'] < 0){
        $data['arrow_hour'] = 'fa fa-arrow-down';
        } else {
        $data['arrow_hour'] = 'fa fa-arrow-up';
        }

        if($data['one_day'] < 0){
        $data['arrow_day'] = 'fa fa-arrow-down';
        } else {
        $data['arrow_day'] = 'fa fa-arrow-up';
        }

        if($data['seven_days'] < 0){
        $data['arrow_seven'] = 'fa fa-arrow-down';
        } else {
        $data['arrow_seven'] = 'fa fa-arrow-up';
        }

    return view('index', $data);

}
}
});

Route::get('/logout', function () {
    $json_eur = json_decode(file_get_contents("https://api.coinmarketcap.com/v1/ticker/?convert=eur&limit=10"));
    $json_aud = json_decode(file_get_contents("https://api.coinmarketcap.com/v1/ticker/?convert=aud&limit=10"));
    $json_usd = json_decode(file_get_contents("https://api.coinmarketcap.com/v1/ticker/"));

    foreach($json_eur as $euro){
    if($euro->name == 'Bitcoin'){
        $_SESSION['eur'] = $euro->price_eur;
    }
    }
    foreach($json_usd as $usd){
        if($usd->name == 'Bitcoin'){
        $_SESSION['usd'] = $usd->price_usd;
    }
    }
    foreach($json_aud as $aud){
        if($aud->name == 'Bitcoin'){
        $_SESSION['aud'] = $aud->price_aud;
    }
    }
    $_SESSION['log'] = 'false';
    return view('login');

});

Route::get('/login', function () {
    return view('login');
});

Route::get('/auth', function () {
    $_SESSION['log'] = 'true';

    $json = json_decode(file_get_contents("https://api.coinmarketcap.com/v1/ticker/"));

    foreach($json as $abshir){
        $data = []; 
        if($abshir->name == 'Bitcoin'){
        
        $data['symbol'] = $abshir->symbol;
        $data['price'] =  "$".$abshir->price_usd;
        $data['one_hour'] =  $abshir->percent_change_1h."%";
        $data['one_day'] =  $abshir->percent_change_24h."%";
        $data['seven_days'] =  $abshir->percent_change_7d."%";

        if(isset($_SESSION['usd'])){
        $data['difference'] = $abshir->price_usd - $_SESSION['usd'];
        $data['percent_difference'] = $data['difference'] / $abshir->price_usd. "%";
        } else {
        $data['percent_difference'] = 'No logs yet';   
        }
        if($data['one_hour'] < 0){
        $data['arrow_hour'] = 'fa fa-arrow-down';
        } else {
        $data['arrow_hour'] = 'fa fa-arrow-up';
        }

        if($data['one_day'] < 0){
        $data['arrow_day'] = 'fa fa-arrow-down';
        } else {
        $data['arrow_day'] = 'fa fa-arrow-up';
        }

        if($data['seven_days'] < 0){
        $data['arrow_seven'] = 'fa fa-arrow-down';
        } else {
        $data['arrow_seven'] = 'fa fa-arrow-up';
        }

    return view('index', $data);

}
}
});

