<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const CREATED_AT = "CreationDateTime";
    const UPDATED_AT = "EditDateTime";

    protected $table = "Orders";
    protected $primaryKey = "Id";

    //zwroci kolekecje dostęnych OdresStatuts
    public function OrderStatuts()
    {
        return $this->belongsTo(OrderStatut::class, "OrderStatutsId");
    }

    //zwroci Users polaczone kluczem obcym
    public function Users()
    {
        return $this->belongsTo(User::class, "UsersId");
    }
    //zwroci kolekecje OrderMeals, nalezacych do danego Order
    public function OrderMeals()
    {
        return $this->hasMany(OrderMeal::class, "OrdersId");
    }
}
