<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Data extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
    public $timestamps = false;

    public function scopeWhereProvinsi(Builder $query, $provinsiId) : void{
        $query->whereHas('provinsi', function($subQuery) use(&$provinsiId) {
            return $subQuery->where('id', $provinsiId);
        });
    }

    function provinsi() : BelongsTo {
        return $this->belongsTo(Provinsi::class);
    }

    function kabupatenKota() : BelongsTo {
        return $this->belongsTo(KabupatenKota::class);
    }

    function satker() : BelongsTo {
        return $this->belongsTo(Satker::class);
    }

    function program() : BelongsTo {
        return $this->belongsTo(Program::class);
    }
}
