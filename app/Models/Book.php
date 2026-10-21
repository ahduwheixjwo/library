<?php

namespace App\Models;

use App\Models\BorrowingRecord;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'category',
        'quantity',
        'available_quantity',
    ];



    public function borrowingRecords()
    {
        return $this->hasMany(BorrowingRecord::class);
    }

}