<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LendingRequest extends Model
{
  protected $primaryKey = 'RequestID';
protected $fillable = ['BorrowerID', 'EquipmentID', 'Purpose', 'RequestDate', 'DesiredReturnDate', 'Status'];

public function borrower() { return $this->belongsTo(User::class, 'BorrowerID'); }
public function equipment() { return $this->belongsTo(Equipment::class, 'EquipmentID'); }
}
