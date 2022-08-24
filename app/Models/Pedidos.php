<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedidos extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'folio',
        'applicant_id',
        'destino',
        'monto_solicitado',
        'plazo',
    ];

    protected $searchableFields = ['*'];

    public function applicant()
    {
        return $this->belongsTo(Solicitante::class, 'applicant_id');
    }
}
