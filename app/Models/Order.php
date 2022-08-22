<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'folio',
        'destino',
        'monto_solicitado',
        'applicant_id',
        'plazo',
    ];

    protected $searchableFields = ['*'];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
