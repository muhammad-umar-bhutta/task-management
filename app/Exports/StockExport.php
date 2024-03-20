<?php

namespace App\Exports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\FromCollection;

class StockExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $stocks = Stock::all();
        
        // Grouping stocks by variant
        $groupedStocks = $stocks->groupBy('variant');
        
        // Processing grouped stocks
        $formattedStocks = $groupedStocks->map(function($group) {
            $stockIds = $group->pluck('stock')->implode('|');
            return [
                'sku' => $group[0]->variant,
                'stock_ids' => $stockIds
            ];
        });
        $headings =[
            'SKU' => 'SKU',
            'stock_ids' => 'stock_ids'
        ];
        $formattedStocks['variant'] = $headings;
        return $formattedStocks;
    }
}
