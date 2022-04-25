<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animal extends Model
{
    public const VALIDATION_RULES = [
        "animal_name" => ["required", "min:3"],
        "age" => ["required", "numeric", "min:1", "max:20"],
        "gender" => ["required", "alpha", "string", "min:3"],
        "images" => ["required", "image", "mimes:jpg,png,jpeg,gif", "max:5048"],
    ];

    use HasFactory;

    use SoftDeletes;

    protected $dates = ["deleted_at"];

    protected $table = "animals";

    protected $primaryKey = "id";

    protected $guarded = ["id"];

    //public function rescuer()
    //{
    //  return $this->belongsTo("\App\Models\Rescuer", "rescuer_id");
    //}

    //public function diseaseInjury()
    //{
    //  return $this->hasMany(DiseasInjury::class);
    //}
    // public function adopter()
    //{
    //  return $this->hasMany(Adopter::class);
    //}
}
