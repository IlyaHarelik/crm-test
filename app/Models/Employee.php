<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'first_name',
        'last_name',
        'company_id',
        'email',
        'phone',
        'note',
    ];

    /**
     * @return BelongsTo<User>
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
