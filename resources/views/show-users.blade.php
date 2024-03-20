<!-- show-users.blade.php -->
<x-app-layout>
    <style>
        .dt-search input, .dt-length select, .pagination a{
            background: transparent;
            color: black;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Show Users
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Display users and their counts -->
                    <h3 class="font-semibold text-lg">Users and their counts in Table 2:</h3>
                    <table id="users" class="table-auto w-full mt-3">
                        <thead>
                            <tr>
                                <th class="border p-2">Key</th>
                                <th class="border p-2">Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                            <tr>
                                <td class="border p-2">{{ $key + 1 }}</td>
                                <td class="border p-2">{{ $user->name }} ({{ $user->addresses_count ?? 0 }})</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- Display users with no records in Table 2 -->
                    <h3 class="font-semibold text-lg mt-6">Users with no records in Table 2:</h3>
                    <table id="noRecordsUsers" class="table-auto w-full mt-3">
                        <thead>
                            <tr>
                                <th class="border p-2">Key</th>
                                <th class="border p-2">Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($noRecordsUsers as $key => $user)
                            <tr>
                                <td class="border p-2">{{ $key + 1 }}</td>
                                <td class="border p-2">{{ $user->name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- Display duplicate records in Table 2 -->
                    <h3 class="font-semibold text-lg mt-6">Duplicate records in Table 2:</h3>
                    <table id="duplicateRecords" class="table-auto w-full mt-3">
                        <thead>
                            <tr>
                                <th class="border p-2">ID</th>
                                <th class="border p-2">Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($duplicateRecords as $key => $data)
                            <tr>
                                <td class="border p-2">{{ $key + 1 }}</td>
                                <td class="border p-2">{{ $data->address }} ({{ $data->count ?? 0 }})</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.tailwindcss.js"></script>
    <script>
        new DataTable('#users');
        new DataTable('#noRecordsUsers');
        new DataTable('#duplicateRecords');
    </script>
</x-app-layout>
