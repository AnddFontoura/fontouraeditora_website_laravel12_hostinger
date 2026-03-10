<?php

namespace App\Console\Commands;

use App\Enums\PublicationFilesEnum;
use App\Models\Publication;
use App\Models\PublicationFile;
use Illuminate\Console\Command;

class PopulatePublicationImagePathCommand extends Command
{
    protected $signature = 'app:populate-publication-image-path-command';

    protected $description = 'get image path from publication files and launch at publications';

    public function handle(): void
    {
        $publications = Publication::whereNull('image_path')->get();
        $progressBar = $this->output->createProgressBar(count($publications));

        foreach ($publications as $publication) {
            $publicationImage = PublicationFile::where('publication_id', $publication->id)
                ->where('file_type', PublicationFilesEnum::FILE_TYPE_IMAGE)
                ->first();

            if ($publicationImage) {
                $publication->image_path = $publicationImage->path ?? null;
                $publication->save();
            }

            $progressBar->advance();
        }

        $progressBar->finish();
    }
}
