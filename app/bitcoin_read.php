<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bitcoin_read 
{
    protected $titles_array = [];

    public function all(){
    return $this->titles_array;
    }
    
    public function get($id){
    return $this->titles_array[$id];   
    }
}
