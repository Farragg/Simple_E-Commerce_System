<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function countries(){
        return $this->belongsTo(Countrie::class,'countrie_id');
    }
    public function states(){
        return $this->belongsTo(State::class, 'state_id');
    }
    public function cities(){
        return $this->belongsTo(Citie::class, 'citie_id');
    }
    public function customers(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
