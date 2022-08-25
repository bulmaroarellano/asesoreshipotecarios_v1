<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingreso extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'empresa',
        'comprobante_ingresos',
        'salario_bruto',
        'salario_neto',
        'tipo_empleo',
        'fecha_contratacion',
        'applicant_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'fecha_contratacion' => 'date',
    ];

    public function applicant()
    {
        return $this->belongsTo(Solicitante::class, 'applicant_id');
    }
}
