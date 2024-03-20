<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\StockImport;
use App\Exports\StockExport;
use App\Jobs\ProcessFilesJob;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Stock;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;

class StockController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);
    
        // Upload the file to storage
        $path = $request->file('file')->store('imports');
        $batch = Bus::batch([])->dispatch();
        $batch->add(new ProcessFilesJob($path));
        
        return back()->with('success', 'CSV file queued for import.');
    }

    public function export()
    {
        return Excel::download(new StockExport, 'sample2.xlsx');
    }
}
