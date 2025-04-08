<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['product_name','quantity','price'];

    // Function to calculate total value of the product
    public function getTotalValueAttribute(): float
    {
        return $this->quantity * $this->price;
    }
}
