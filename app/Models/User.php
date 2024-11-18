<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'url_img'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relación: El usuario es profesor de varios cursos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id'); // El usuario puede ser profesor de varios cursos
    }

    /**
     * Relación: El usuario está inscrito en varios cursos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'course__enrollments')
                    ->withPivot('status', 'enrolled_at') // Incluye datos adicionales en la tabla pivot
                    ->withTimestamps(); // Para manejar las columnas de tiempo en la tabla pivot
    }
}
