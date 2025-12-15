<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    protected $primaryKey = 'PenaltyID';

    protected $fillable = [
        'RequestID', 
        'Amount', 
        'Reason', 
        'DateIssued'
    ];

    public function request()
    {
        return $this->belongsTo(LendingRequest::class, 'RequestID');
    }
}