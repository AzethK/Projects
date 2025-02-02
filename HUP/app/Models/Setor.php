<?php

namespace App\Models;

use App\Models\Estabelecimento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Setor extends Model
{
    protected $table = 'setor';
    protected $primaryKey = 'id_setor';
    use HasFactory;

    protected $fillable = [
        'setor',
        'id_estabelecimento',
        'pavimento',
        'id_setor',
    ];

    public function estabelecimento(): BelongsTo
    {
        return $this->belongsTo(Estabelecimento::class, 'id_estabelecimento');
    }
}
