<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'title',
    //     'price',
    //     'user_id',
    //     'published_at'
    // ];
    protected $guarded = ['id'];
    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($book) {
            $book->slug = Str::slug($book->title);
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
