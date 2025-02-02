<?php

namespace App\Models;

use App\Models\Setor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estabelecimento extends Model
{
    protected $table = 'estabelecimento';
    protected $primaryKey = 'id_estabelecimento';
    use HasFactory;

    protected $fillable = [
        'estabelecimento',
        'id_estabelecimento',
    ];

    public function setor(): HasMany
    {
        return $this->hasMany(Setor::class);
    }
}
