<?php

namespace App\Models;

use App\Models\Equipamento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Marca extends Model
{
    protected $table = 'marca';
    protected $primaryKey = 'id_marca';
    use HasFactory;

    protected $fillable = [
        'marca',
        'id_marca',
    ];

    public function equipamento(): HasMany
    {
        return $this->hasMany(Equipamento::class);
    }
}
