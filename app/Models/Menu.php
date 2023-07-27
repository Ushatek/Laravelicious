<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    const CREATED_AT = "CreationDateTime";
    const UPDATED_AT = "EditDateTime";

    protected $table = "Meals";
    protected $primaryKey = "Id";
}
