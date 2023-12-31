<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'website',
        'logo_filename',
        'note',
    ];

    /**
     * @return HasMany<User>
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
