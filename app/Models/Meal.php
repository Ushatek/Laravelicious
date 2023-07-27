<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    const CREATED_AT = "CreationDateTime";
    const UPDATED_AT = "EditDateTime";

    protected $table = "Meals";
    protected $primaryKey = "Id";

    //zwroci kolekecje dostęnych Mealtype
    public function MealTypes()
    {
        return $this->belongsTo(MealType::class, "MealTypesId");
    }

    //zwroci kolekecje OrderMeals, nalezacych do danego Meal
    public function OrderMeals()
    {
        return $this->hasMany(OrderMeal::class, "MealsId");
    }
}