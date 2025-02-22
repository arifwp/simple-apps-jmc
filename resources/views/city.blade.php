<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>JMC Test</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
</head>

<body class="w-full h-full max-w-xl mx-auto font-sans antialiased">
    <div class="w-full mt-4 mb-12 flex flex-col items-center justify-center">
        <div class="w-full mb-4 flex flex-col items-center justify-center">
            <img class="w-32 h-auto rounded-lg shadow-lg" src="{{ asset('jmc-logo.jpeg') }}" alt="Logo JMC" />

            <h1 class="mt-4 text-2xl font-bold">JMC Test</h1>
            <h3 class="text-md">Simple Apps</h3>

            <a href="{{ route('province.index') }}"
                class="mt-4 mx-auto p-2 bg-yellow-400 rounded-md text-black block text-center">
                Tambahkan Provinsi
            </a>
        </div>

        @if(session('success'))
            <p class="text-green-500 bg-green-100 p-2 rounded-md">{{ session('success') }}</p>
        @endif

        @if(session('error'))
            <p class="text-red-500 bg-red-100 p-2 rounded-md">{{ session('error') }}</p>
        @endif

        <div class="w-full mt-4 flex flex-col">
            <form action="{{ route('cities.store') }}" method="POST" class="w-full gap-4 flex flex-col">
                @csrf
                <div>
                    <label class="text-sm text-gray-600">Nama Kabupaten/Kota</label>
                    <input class="w-full p-2 border border-gray-400 rounded-md" name="cities" required />
                </div>

                <div>
                    <label class="text-sm text-gray-600">Jumlah Penduduk</label>
                    <input class="w-full p-2 border border-gray-400 rounded-md" type="number" name="population"
                        required />
                </div>

                <div>
                    <label for="id_province">Pilih Provinsi:</label>
                    <select name="id_province" id="id_province" class="w-full p-2 border border-gray-400 rounded-md"
                        required>
                        <option value="">-- Pilih Provinsi --</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                        @endforeach
                    </select>

                </div>
                <button type="submit" class="mt-4 mx-auto p-2 bg-gray-700 rounded-md text-white">Tambah
                    Kota/Kabupaten</button>
            </form>
        </div>

        <div class="w-full mt-4">
            <form method="GET" action="{{ route('cities.index') }}">
                <div class="flex justify-between mb-4">
                    <select name="id_province" id="province-filter" class="p-2 border border-gray-400 rounded-md">
                        <option value="">Semua Provinsi</option>
                        @foreach($provinces as $province)
                            <option value="{{ $province->id }}" {{ request('id_province') == $province->id ? 'selected' : '' }}>
                                {{ $province->name }}
                            </option>
                        @endforeach
                    </select>

                    <input type="text" name="search" id="search-box" placeholder="Cari Kota/Kabupaten..."
                        class="p-2 border border-gray-400 rounded-md" value="{{ request('search') }}">

                    <button type="submit" class="p-2 bg-blue-500 text-white rounded-md">Filter</button>
                </div>
            </form>

            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-center">
                        <th class="border border-gray-300 p-2">No.</th>
                        <th class="border border-gray-300 p-2">Nama Provinsi</th>
                        <th class="border border-gray-300 p-2">Nama Kota/Kabupaten</th>
                        <th class="border border-gray-300 p-2">Dibuat Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cities as $index => $city)
                        <tr class="text-center">
                            <td class="border border-gray-300 p-2">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 p-2">{{ $city->province->name }}</td>
                            <td class="border border-gray-300 p-2">{{ $city->name }}</td>
                            <td class="border border-gray-300 p-2">{{ $city->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-500 p-2">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>