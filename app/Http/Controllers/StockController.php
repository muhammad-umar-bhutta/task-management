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
        $file = $request->file('file');
        Excel::import(new StockImport, $file);
        return back()->with('success', 'CSV file imported successfully.');
    }

    public function export()
    {
        return Excel::download(new StockExport, 'sample2.xlsx');
    }
}
