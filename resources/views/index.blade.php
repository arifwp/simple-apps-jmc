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
    <div class="w-full mt-4 flex flex-col items-center justify-center">
        <div class="w-full mb-4 flex flex-col items-center justify-center">
            <img class="w-32 h-auto rounded-lg shadow-lg" src="{{ asset('jmc-logo.jpeg') }}" alt="Logo JMC" />

            <h1 class="mt-4 text-2xl font-bold">JMC Test</h1>
            <h3 class="text-md">Simple Apps</h3>

            <a href="{{ route('cities.index') }}"
                class="mt-4 mx-auto p-2 bg-yellow-400 rounded-md text-black block text-center">
                Tambahkan Kota/Kabupaten
            </a>
        </div>

        @if(session('success'))
            <p class="text-green-500 bg-green-100 p-2 rounded-md">{{ session('success') }}</p>
        @endif

        @if(session('error'))
            <p class="text-red-500 bg-red-100 p-2 rounded-md">{{ session('error') }}</p>
        @endif

        <div class="w-full mt-4 flex flex-col">
            <form action="{{ isset($province) ? route('province.update', $province->id) : route('province.store') }}"
                method="POST" class="w-full flex flex-col">
                @csrf
                @if(isset($province))
                    @method('POST')
                @endif

                <label class="text-sm text-gray-600">Nama Provinsi</label>
                <input class="w-full p-2 border border-gray-400 rounded-md" name="province"
                    value="{{ isset($province) ? $province->name : '' }}" required />

                <button type="submit"
                    class="mt-4 mx-auto p-2 {{ isset($province) ? 'bg-yellow-500' : 'bg-gray-700' }} rounded-md text-white">
                    {{ isset($province) ? 'Update Provinsi' : 'Tambah Provinsi' }}
                </button>
            </form>
        </div>

        <div class="w-full mt-4">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-center">
                        <th class="border border-gray-300 p-2">No.</th>
                        <th class="border border-gray-300 p-2">Nama Provinsi</th>
                        <th class="border border-gray-300 p-2">Dibuat Tanggal</th>
                        <th class="border border-gray-300 p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($provinces as $index => $province)
                        <tr class="text-center">
                            <td class="border border-gray-300 p-2">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 p-2">{{ $province->name }}</td>
                            <td class="border border-gray-300 p-2">{{ $province->created_at->format('d M Y') }}</td>
                            <td class="border border-gray-300 p-2">
                                <div>
                                    <a href="{{ route('province.edit', $province->id) }}"
                                        class="p-1 bg-yellow-400 text-black rounded-md">Edit</a>

                                    <form action="{{ route('province.delete', $province->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1 bg-red-400 text-white rounded-md">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-gray-500 p-2">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>