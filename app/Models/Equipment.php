<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $primaryKey = 'EquipmentID';
protected $fillable = [
    'Name', 
    'Category',    // New
    'Quantity',    // New
    'Condition',   // New
    'Description', 
    'AvailabilityStatus'
];

}
