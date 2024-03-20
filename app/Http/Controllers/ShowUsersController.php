<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowUsersController extends Controller
{
    public function show()
    {
        // Select all records from Table 1 and count of their records in table 2
        $users = User::withCount('addresses')->get();
        // Select all records from table 1 whose record does not exist in table 2
        $noRecordsUsers = User::doesntHave('addresses')->get();

        // Select all duplicate records in table 2 and show a counter of their iteration
        $duplicateRecords = UserAddress::select('address', DB::raw('COUNT(*) as count'))
            ->groupBy('address')
            ->having('count', '>', 1)
            ->get();
        return view('show-users', compact('users', 'noRecordsUsers', 'duplicateRecords'));
    }
}
