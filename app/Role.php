<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use Laravel\Passport\Client;

class Role extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table="roles";

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function application() {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
