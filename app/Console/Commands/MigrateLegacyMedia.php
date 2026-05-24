<?php

namespace App\Console\Commands;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MigrateLegacyMedia extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'media:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate legacy media files from public/uploads to the new storage architecture';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting legacy media migration...');

        // Migrate Books
        $books = Book::whereNotNull('image')->get();
        $this->info("Checking {$books->count()} books...");
        $bookCount = 0;

        foreach ($books as $book) {
            if ($this->migrateMedia($book, 'books')) {
                $bookCount++;
            }
        }
        $this->info("Successfully migrated {$bookCount} book images.");

        // Migrate Authors
        $authors = Author::whereNotNull('image')->get();
        $this->info("Checking {$authors->count()} authors...");
        $authorCount = 0;

        foreach ($authors as $author) {
            if ($this->migrateMedia($author, 'authors')) {
                $authorCount++;
            }
        }
        $this->info("Successfully migrated {$authorCount} author images.");

        $this->info('Legacy media migration completed!');
    }

    /**
     * Migrate a single model's media file.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $folder
     * @return bool
     */
    private function migrateMedia($model, $folder)
    {
        // Skip if already migrated (doesn't start with 'uploads/')
        if (!Str::startsWith($model->image, 'uploads/')) {
            return false;
        }

        $legacyPath = public_path($model->image);

        if (File::exists($legacyPath)) {
            $extension = File::extension($legacyPath);
            $newFilename = Str::uuid() . '.' . $extension;
            $newPath = $folder . '/' . $newFilename;

            // Move the file content to the new storage location
            $content = File::get($legacyPath);
            if (Storage::disk('public')->put($newPath, $content)) {
                // Delete the legacy file
                File::delete($legacyPath);

                // Update the database record
                $model->image = $newPath;
                $model->save();

                $this->line("Migrated: {$model->image}");
                return true;
            }
        }

        $this->warn("Source file not found: {$legacyPath}");
        return false;
    }
}
