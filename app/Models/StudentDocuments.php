<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDocuments extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'product_id',
        'product_name',
        'price',
        'quantitystock',
        'category',
        'discount',
    ];

    public function enrolled()
    {
        return $this->belongsTo(StudentEnrolled::class, 'student_id', 'student_id');
    }

    
}