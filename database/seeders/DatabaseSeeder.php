<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $fs = new Filesystem;

        // delete directories
        $except_folder_names = [
            // folder name (storage/app/public/<folder_name>)
        ];
        $folder_paths = $fs->directories(public_path('storage'));
        foreach ($folder_paths as $folder_path) {
            $folder_name = last(explode('/', $folder_path));
            if (!in_array($folder_name, $except_folder_names)) {
                $fs->deleteDirectory($folder_path);
            }
        }

        // delete files
        $except_file_names = [
            '.gitignore',
            // file name (storage/app/public/<file_name>)
        ];
        $file_paths = $fs->files(public_path('storage'));
        foreach ($file_paths as $file_path) {
            $file_name = last(explode('/', $file_path));
            if (!in_array($file_name, $except_file_names)) {
                $fs->delete($file_path);
            }
        }

        echo "Gambar successfully deleted!\n";
    }
}
