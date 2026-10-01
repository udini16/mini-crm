<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'email', 'logo', 'website'])]
class Company extends Model
{
    /**
     * Get the employees for the company.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
