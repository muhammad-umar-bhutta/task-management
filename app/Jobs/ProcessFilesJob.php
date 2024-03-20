<?php

namespace App\Jobs;

use App\Imports\StockImport;
use App\Models\ImportLog;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProcessFilesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;
    protected $file;
    // protected $fileName;
    /**
     * Create a new job instance.
     */
    public function __construct($file)
    {
        $this->file = $file;
        // $this->fileName = $fileName;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Excel::import(new StockImport, $this->file);

        // Optionally, you can delete the file after processing
        try {
            Storage::delete($this->file);
            Log::info('File is deleted.');
        } catch (\Exception $e) {
            // Handle deletion failure, log error, etc.
            Log::error('Error deleting file: ' . $e->getMessage());
        }
    }
}
