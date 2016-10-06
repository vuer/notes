<?php

namespace Vuer\Notes;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

class NotesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!class_exists('CreateNotesTable')) {
            // Publish the migration
            $timestamp = date('Y_m_d_His', time());
            $this->publishes([
                __DIR__ . '/../database/migrations/create_notes_table.php.stub' => database_path('migrations/' . $timestamp . '_create_notes_table.php'),
            ], 'migrations');
        }

        $this->publishes([
            __DIR__ . '/../config/notes.php' => config_path('notes.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
