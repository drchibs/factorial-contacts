<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'action',
        'contact_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
