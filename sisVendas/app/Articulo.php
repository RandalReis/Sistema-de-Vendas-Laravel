<?php

namespace sisVendas;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
   
    protected $table='articulo';

    protected $primaryKey='idarticulo';

    public $timestamps=false;

    protected $fillable =[
        'idcategoria',
        'codigo',
        'nome',
        'estoque',
        'descricao',
        'imagem',
        'estado'
    ];

    protected $guarded =[

    ];
}
