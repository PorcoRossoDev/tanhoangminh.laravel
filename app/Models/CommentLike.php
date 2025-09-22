<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    use HasFactory;
    protected $fillable = ['comment_id', 'customer_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
