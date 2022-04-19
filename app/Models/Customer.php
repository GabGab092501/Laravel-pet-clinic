<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    public const rules = [
        "name" => ["required", "min:2"],
        "contactNum" => ["required", "min:8"],
        "pics" => ["required", "image", "mimes:jpg,png,jpeg,gif", "max:5048"],
    ];

    use HasFactory;

    use SoftDeletes;

    protected $dates = ["deleted_at"];

    protected $table = "customers";

    protected $primaryKey = "id";

    protected $guarded = ["id"];

}
