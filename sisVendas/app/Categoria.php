<?php

namespace sisVendas;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='categoria';

    protected $primaryKey='idcategoria';

    public $timestamps=false;

    protected $fillable =[
        'nome',
        'descricao',
        'cond'
    ];

    protected $guarded =[

    ];
}
