<?php

namespace App\Models;

use App\Models\Equipamento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    protected $table = 'categoria';
    protected $primaryKey = 'id_categoria';
    use HasFactory;

    protected $fillable = [
        'categoria',
        'id_categoria',
    ];

    public function equipamento(): HasMany
    {
        return $this->hasMany(Equipamento::class);
    }
}
