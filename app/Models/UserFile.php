<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserFile extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id', 'file_name', 'url'];
    protected $hidden = ['user_id', 'updated_at', 'deleted_at'];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function getCreatedAtAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->format('Y-m-d');
    }
}
