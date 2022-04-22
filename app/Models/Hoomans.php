<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Hoomans extends Authenticatable
{
    public const RULES = [
        "name" => ["required", "min:3"],
        "email" => ["required", "string", "email", "unique:hoomans"],
        "password" => ["required", "min:5", "confirmed"],
        "images" => ["required", "image", "mimes:jpg,png,jpeg,gif", "max:9999999"],
        "role" => ["required", "alpha", ],
    ];

    protected $dates = ["deleted_at"];

    protected $table = "hoomans";

    protected $primaryKey = "id";

    protected $guarded = ["id"];

    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["name", "email", "password", "role", "images"];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ["password"];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "email_verified_at" => "datetime",
    ];
}
