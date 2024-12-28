<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'teacher_id',
        'video_url',
        'image_url',
    ];

    /**
     * Relación: El curso pertenece a un profesor (usuario).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function instructor()
    {
        return $this->belongsTo(User::class, 'teacher_id'); // Un curso tiene un solo profesor
    }

    /**
     * Relación: El curso tiene muchos estudiantes inscritos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students()
    {
        return $this->belongsToMany(User::class, 'course__enrollments')
            ->withPivot('status', 'enrolled_at') // Incluye datos adicionales en la tabla pivot
            ->withTimestamps(); // Para manejar las columnas de tiempo en la tabla pivot
    }


    
}
