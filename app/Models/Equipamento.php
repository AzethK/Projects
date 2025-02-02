<?php

namespace App\Models;

use App\Models\Marca;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Equipamento extends Model
{
    
    protected $table = 'equipamento';
    protected $primaryKey = 'id_equipamento';
    use HasFactory;

    protected $casts = [
        'estado_baixa' => 'boolean',
    ];

    protected $fillable = [
        'patrimonio_uepg',
        'nome',
        'modelo',
        'num_serie',
        'observacao',
        'id_marca',
        'id_categoria',
        'id_sala',
        'id_equipamento',
    ];

    public function categoria(): BelongsTo
    {
        return $this->BelongsTo(Categoria::class, 'id_categoria');
    }

    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class, 'id_marca');
    }

    public function sala(): BelongsTo
    {
        return $this->belongsTo(Sala::class, 'id_sala');
    }
}
