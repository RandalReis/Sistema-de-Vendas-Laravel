<?php

namespace sisVendas;

use Illuminate\Database\Eloquent\Model;

class Detalhe_entrada extends Model
{
    
    protected $table='detalhe_entrada';

    protected $primaryKey='iddetalhe_entrada';

    public $timestamps=false;

    protected $fillable =[
        'identrada',
        'idarticulo',
        'quantidade',
        'preco_compra',
        'preco_venda'
    ];

    protected $guarded =[

    ];
}
