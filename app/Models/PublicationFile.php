<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublicationFile extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'publication_id',
    'file_type',
    'path',
  ];
}
