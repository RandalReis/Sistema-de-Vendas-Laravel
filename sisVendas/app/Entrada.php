<?php

namespace sisVendas;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    
    protected $table='entrada';

    protected $primaryKey='identrada';

    public $timestamps=false;

    protected $fillable =[
        'idprovedor',
        'tipo_comprovante',
        'serie_comprovante',
        'num_comprovante',
        'hora_fechamento',
        'imposto',
        'estado'
    ];

    protected $guarded =[

    ];
}
