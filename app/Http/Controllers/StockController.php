<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\StockImport;
use App\Exports\StockExport;
use App\Jobs\ProcessFilesJob;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Stock;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class StockController extends Controller
{
    public function import(Request $request)
    {
        // Validate the request data
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);
    
        try {

            $file = $request->file('file');
            Excel::import(new StockImport, $file);    
            // File successfully imported
            return redirect()->back()->with('success', 'File imported successfully.');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error($e->getMessage());
    
            // Handle the error gracefully
            return redirect()->back()->with('error', 'An error occurred while uploading the file. Please try again.');
        }
    }
    

    public function export()
    {
        return Excel::download(new StockExport, 'sample2.xlsx');
    }
}
