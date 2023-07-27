<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealType extends Model
{
    use HasFactory;

    const CREATED_AT = "CreationDateTime";
    const UPDATED_AT = "EditDateTime";

    protected $table = "MealTypes";
    protected $primaryKey = "Id";

    //zwroci kolekecje Meals, nalezacych do tego Mealtype
    public function Meals()
    {
        return $this->hasMany(Meal::class, "MealTypesId");
    }
}
