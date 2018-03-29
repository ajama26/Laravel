<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bitcoin_model as bit;
class bitcoin extends Controller
{
    //

public function __construct(bit $titles){
$this->titles = $titles->all();
$this->find = $titles->get(2);
}

public function index(){
return view('index');
}
public function get(){
return $this->find;
}
}
