<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relación para estudiantes que pertenecen a este docente 
    public function estudiantes() { 
        return $this->hasMany(Assignment::class, 'docente_id'); 
    
    
    }
    // Relación para el estudiante asignado a un docente 
    public function assignment() { 
        return $this->hasOne(Assignment::class, 'estudiante_id'); 
    }


    public function docente()
    {
        return $this->belongsTo(User::class, 'docente_id');
    }

    public function grupo()
    {
        return $this->belongsToMany(Grupo::class, 'grupo_usuario', 'user_id', 'grupo_id');

    }
    public function seguimientos()
    {
        return $this->hasMany(Seguimiento::class);
    }

    public function entregas() { 
        return $this->hasMany(Entrega::class); 
    }
    public function seguimientos()
    {
        return $this->hasMany(Seguimiento::class);
    }

    public function crossevaluations() { 
        return $this->hasMany(Crossevaluation::class); 
    }

    
}
