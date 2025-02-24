<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['slug', 'name', 'profile_image', 'position','phone_no','location','status','gender','rank'];

    // Generate a unique slug when creating an Employee
    protected static function booted()
    {
        static::creating(function ($employee) {
            // Generate a unique 8-character slug
            $employee->slug = self::generateUniqueSlug();
        });
    }

    // Function to generate a unique 8-character slug
    public static function generateUniqueSlug()
    {
        // Generate a random slug
        do {
            $slug = Str::random(8);
        } while (self::where('slug', $slug)->exists()); // Ensure the slug is unique

        return $slug;
    }
}
