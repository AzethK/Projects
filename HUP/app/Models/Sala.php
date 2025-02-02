<?php

namespace App\Models;

use App\Models\Equipamento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sala extends Model
{
    protected $table = 'sala';
    protected $primaryKey = 'id_sala';
    use HasFactory;

    protected $fillable = [
        'nome',
        'id_setor',
        'id_sala',
    ];

    public function setor(): BelongsTo
    {
        return $this->belongsTo(Setor::class, 'id_setor');
    }

    public function equipamento(): HasMany
    {
        return $this->hasMany(Equipamento::class, 'id_sala');
    }
}
