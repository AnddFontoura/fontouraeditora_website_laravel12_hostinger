<?php

namespace App\Console\Commands;

use App\Models\Publication;
use App\Models\PublicationFile;
use Illuminate\Console\Command;

class AdjustPublicationImageCommand extends Command
{
    protected $signature = 'app:adjust-publication-image-command';

    protected $description = 'Command description';

    public function handle(): void
    {
        $publications = Publication::whereNull('image_path')->get();

        $progressBar = $this->output->createProgressBar(count($publications));

        foreach ($publications as $publication) {
            $publicationImage = PublicationFile::where('file_type', 'IMAGE')
                ->where('publication_id', $publication->id)
                ->first();

            if ($publicationImage) {
                $publication->image_path = $publicationImage->path;
                $publication->save();
            }

            $progressBar->advance();
        }

        $progressBar->finish();
    }
}
