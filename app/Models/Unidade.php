<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unidade extends Model
{
    /** @use HasFactory<\Database\Factories\UnidadeFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['nome', 'simbolo'];
}
