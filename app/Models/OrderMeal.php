<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMeal extends Model
{
    use HasFactory;

    const CREATED_AT = "CreationDateTime";
    const UPDATED_AT = "EditDateTime";

    protected $table = "OrderMeals";
    protected $primaryKey = "Id";

    //zwroci Orders polaczone kluczem obcym
    public function Orders()
    {
        return $this->belongsTo(Order::class, "OrdersId");
    }

    //zwroci Meals polaczone kluczem obcym
    public function Meals()
    {
        return $this->belongsTo(Meal::class, "MealsId");
    }
}
