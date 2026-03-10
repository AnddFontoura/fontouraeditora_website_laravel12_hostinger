<?php

namespace App\Models;

use App\Enums\PublicationFilesEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Publication extends Model
{
  use SoftDeletes;

  protected $fillable = [
        'category',
        'name',
        'isbn',
        'author',
        'description',
        'value',
      'link',
      'image_path'
  ];

  protected $appends = [
    'image_url'
  ];

  public function getImageUrlAttribute(): ?string
  {
      if (!$this->image_path) {
          return null;
      }

      return Storage::disk('public')->url($this->image_path);
  }

  public function publicationImage(): hasMany
  {
    return $this->hasMany(
        PublicationFile::class,
        'publication_id',
        'id'
        )
        ->where('file_type', PublicationFilesEnum::FILE_TYPE_IMAGE);
  }
}
