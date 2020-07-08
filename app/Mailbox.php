<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mailbox extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql_mail';

    protected $fillable = [
        'domain_id', 'password', 'email', 'user_id'
    ];


    protected $table = 'virtual_users';

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
