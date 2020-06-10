<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lapor extends Model
{
    protected $table = 'lapor';
    protected $fillable = ['user_id', 'lat', 'long', 'gambar', 'keterangan', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->format('d, M Y H:i');
    }
}
