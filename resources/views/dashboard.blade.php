<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{ route('show.users') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md">Users
                List</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            @if (session('success'))
                <div class="p-4 my-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                    <span class="font-medium">Success alert!</span> {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="p-4 my-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                    <span class="font-medium">Danger alert!</span> {{ session('error') }}
                </div>
            @endif

        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white mt-3 shadow-md rounded-lg">
                <div class="bg-gray-200 px-4 py-2 rounded-t-lg">
                    Task Management - Stock Data
                </div>
                <div class="p-4">
                    <form action="{{ route('stock.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="flex flex-col space-y-2">
                            <input type="file" name="file"
                                class="border-2 w-[100%] py-2 px-4 rounded-md border-gray-300 shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">Import
                                Stock Data</button>
                        </div>
                    </form>
                    <div class="my-2 bg-gray-200 py-2 px-4 rounded-md flex justify-between items-center">
                        <span>List Of Stocks</span>
                        <a href="{{ route('stock.export') }}"
                            class="float-right bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded-md">Export
                            Stock Data</a>
                    </div>
                    <table class="table-auto w-full mt-3">
                        <tr>
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Variant</th>
                            <th class="border p-2">Stock</th>
                        </tr>
                        @foreach ($stocks as $stock)
                            <tr>
                                <td class="border p-2">{{ $stock->id }}</td>
                                <td class="border p-2">{{ $stock->variant }}</td>
                                <td class="border p-2">{{ $stock->stock }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <br />
            {{ $stocks->links() }}
        </div>

    </div>
</x-app-layout>
