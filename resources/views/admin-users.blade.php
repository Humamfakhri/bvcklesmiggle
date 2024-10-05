<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/cce5ebab8a.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
    {{-- <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css"> --}}
    {{-- <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script> --}}
    {{-- <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script> --}}
    <title>bvcklesmiggle</title>
</head>

<body class="bg-gray-200">
    <main>
        @if (session('success'))
            <x-success-alert>{{ session('success') }}</x-success-alert>
        @elseif (session('error'))
            <x-error-alert>{{ session('error') }}</x-error-alert>
        @endif

        <div class="flex">
            <x-sidebar />
            <div class="content grow padding-container pt-5">
                <h1 class="font-bold text-3xl mb-4">User</h1>
                {{-- <form method="POST" action="{{ route('admin-users.store') }}" class="flex-col gap-5"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs mb-1 font-bold" for="name">Name<span
                                    class="text-red-600">*</span></label>
                            <input required type="text" name="name" id="name"
                                oninput="checkInputFilled(this)" placeholder="Enter user name"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400">
                        </div>
                        <div>
                            <label class="block text-xs mb-1 font-bold" for="link">Link</label>
                            <input required type="text" name="link" id="link"
                                oninput="checkInputFilled(this)" placeholder="Enter user link"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs mb-1 font-bold">User's Image</label>
                            <input type="file" name="image" id="image" accept=".jpeg,.jpg,.png,.webp"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400 bg-white @error('image') is-invalid @enderror"
                                onchange="validateFiles('image', 'imagesPreview', 'imageError')"
                                oninput="checkInputFilled(this)">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="text-red-500 text-xs pt-2" id="imageError"></div>
                            <!-- Tempat error message -->
                            <div class="grid grid-cols-2 gap-3 pt-4" id="imagesPreview"></div>
                        </div>
                    </div>
                    <div class="flexEnd">
                        <button id="addUserBtn"
                            class="w-fit px-4 py-1 my-6  text-white font-bold bg-primary rounded border-2 border-black flexCenter gap-2 disabled:cursor-not-allowed disabled:opacity-30">
                            Add User
                            <i class="fa-solid fa-plus text-white"></i>
                        </button>
                    </div>
                </form> --}}
                <hr class="border-gray-300 mb-10">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <input type="hidden" id="rowId" value="{{ $user->id }}">
                                <td id="rowNo">No.</td>
                                <td id="rowName">{{ $user->name }}</td>
                                <td id="rowUsername">{{ $user->username }}</td>
                                <td id="rowEmail">{{ $user->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                // "columnDefs": [{
                //         "width": "10%",
                //         "targets": 0
                //     }, // Mengatur lebar kolom pertama
                //     {
                //         "width": "90%",
                //         "targets": 1
                //     } // Mengatur kolom kedua untuk menempati sisa ruang
                // ],
                "order": [
                    [1, 'asc']
                ],
                "rowCallback": function(row, data, index) {
                    var table = $('#myTable').DataTable();
                    $('td:eq(0)', row).html(table.page.info().start + index + 1);
                }
            });
        });
    </script>
</body>

</html>
