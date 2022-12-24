<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
    ];

    public function history()
    {
        return $this->hasMany(ContactHistory::class);
    }

    protected static function booted()
    {
        static::created(function ($contact) {
            ContactHistory::create([
                'action' => 'created',
                'contact_id' => $contact->id,
                'first_name' => $contact->first_name,
                'last_name' => $contact->last_name,
                'email' => $contact->email,
                'phone_number' => $contact->phone_number
            ]);
        });

        static::updated(function ($contact) {
            ContactHistory::create([
                'action' => 'edited',
                'contact_id' => $contact->id,
                'first_name' => $contact->first_name,
                'last_name' => $contact->last_name,
                'email' => $contact->email,
                'phone_number' => $contact->phone_number
            ]);
        });

        static::deleted(function ($contact) {
            ContactHistory::create([
                'action' => 'deleted',
                'contact_id' => $contact->id,
                'first_name' => $contact->first_name,
                'last_name' => $contact->last_name,
                'email' => $contact->email,
                'phone_number' => $contact->phone_number
            ]);
        });
    }
}
