<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Company extends Model
{
    /**
     * Get the user that owns company.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the gsz that owns company.
     */
    public function gsz()
    {
        return $this->belongsTo('App\Gsz');
    }

    /**
     * Get the opf this company.
     */
    public function opf()
    {
        return $this->belongsTo('App\Opf');
    }

    /**
     * Get the sno this company.
     */
    public function sno()
    {
        return $this->belongsTo('App\Sno');
    }

    public function monthWork(){
        $date1 = Carbon::parse($this->date_begin_work);
        $date2 = Carbon::now();
       return $date1->diffInMonths($date2);
    }

    public function work6Month(){
       return ($this->monthWork()>=6);
    }
}
