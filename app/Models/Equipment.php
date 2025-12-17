<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    // Tell Laravel our Primary Key is 'EquipmentID', not 'id'
    protected $primaryKey = 'EquipmentID';

    // Allow these columns to be saved (Fixes Mass Assignment Error)
    protected $fillable = [
        'Name',
        'Category',
        'Quantity',
        'Condition',
        'Description',
        'AvailabilityStatus'
    ];

    // Relationship: One equipment has many requests
    public function requests()
    {
        return $this->hasMany(LendingRequest::class, 'EquipmentID');
    }
}