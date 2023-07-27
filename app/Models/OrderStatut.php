<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatut extends Model
{
    use HasFactory;

    const CREATED_AT = "CreationDateTime";
    const UPDATED_AT = "EditDateTime";

    protected $table = "OrderStatuts";
    protected $primaryKey = "Id";

    //zwroci kolekecje Orderss, nalezacych do danego OrderStatut
    public function Orders()
    {
        return $this->hasMany(Order::class, "OrderStatutsId");
    }
}
