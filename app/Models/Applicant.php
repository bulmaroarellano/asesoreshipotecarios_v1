<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicant extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'apellidos',
        'fecha_de_nacimiento',
        'sexo',
        'curp',
        'correo_electronico',
        'direccion',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'fecha_de_nacimiento' => 'date',
    ];

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
