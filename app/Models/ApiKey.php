<?php

namespace App\Models;

use App\Models\ApiLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApiKey extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
    protected $hidden = ['secret_key']; // Never expose in API responses

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function logs()
    {
        return $this->hasMany(ApiLog::class);
    }

    /**
     * Generates and stores a new key pair.
     * Returns the plain text keys that should be shown to the user.
     * This is the only time the plain text keys will be available.
     */
    public function generateKeyPair(): array
    {
        $secret = 'sk_' . $this->environment . '_' . Str::random(32);
        $public = 'pk_' . $this->environment . '_' . Str::random(32);
        
        $this->secret_key = $secret;
        $this->public_key = $public;
        
        return [
            'secret_key' => $secret,
            'public_key' => $public
        ];
    }

    public function getMaskedSecretKeyAttribute(): string
    {
        return substr($this->secret_key, 0, 7) . str_repeat('*', strlen($this->secret_key) - 11) . substr($this->secret_key, -4);
    }

    public function getMaskedPublicKeyAttribute(): string
    {
        return substr($this->public_key, 0, 7) . str_repeat('*', strlen($this->public_key) - 11) . substr($this->public_key, -4);
    }

    public function getLastUsedAtAttribute()
    {
        return $this->logs->isNotEmpty() ? $this->logs->latest()->first()->created_at : null;
    }
}
