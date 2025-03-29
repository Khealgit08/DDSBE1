<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class UserJob1 extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table = 'tbluserjobs';  // Table name
    protected $primaryKey = 'id';      // Primary key

    protected $fillable = [
        'jobname'
    ];

    /**
     * Disable timestamps if not needed.
     */
    public $timestamps = false;

    /**
     * Define relationship with User model.
     * A job can have multiple users.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'jobid', 'id');
    }
}
