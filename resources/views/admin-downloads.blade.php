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

        {{-- EDIT DOWNLOAD MODAL --}}
        <div class="editModal fixed inset-0 flex -z-10 opacity-100 transition-opacity items-center justify-center">
            <div class="editModalContent scale-0 transition ease-in-out duration-300 bg-white border-2 border-black max-w-[60%] max-h-[85%] px-5 overflow-y-auto w-full"
                onclick="event.stopPropagation()">
                <div class="card-popup-header flexBetween border-b-2 border-black sticky top-0 pt-5 pb-3 bg-white">
                    <h1 class="font-bold text-2xl text-black font-segoe">Edit Download</h1>
                    <button>
                        <i class="closePopupDownload text-3xl text-black fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="card-popup-body pt-5">
                    <form id="editDownloadForm" method="POST" action="" class="flex-col gap-5"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="block text-xs mb-1 font-bold" for="titleEdit">Title<span
                                        class="text-red-600">*</span></label>
                                <input required type="text" name="titleEdit" id="titleEdit"
                                    oninput="checkInputFilled(this)" placeholder="Enter download's title"
                                    class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs mb-1 font-bold" for="linkEdit">Link<span
                                        class="text-red-600">*</span></label>
                                <input required type="text" name="linkEdit" id="linkEdit"
                                    oninput="checkInputFilled(this)" placeholder="Enter download's link"
                                    class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400">
                            </div>
                        </div>
                        <div class="mt-4 flexEnd gap-3 sticky bottom-0 bg-white border-t-2 border-black py-3">
                            <button type="button"
                                class="w-fit px-4 py-1 text-white font-bold bg-gray-500 rounded closePopupDownload">
                                Cancel
                            </button>
                            <button type="submit" class="w-fit px-6 py-1 text-white font-bold bg-primary rounded">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="flex">
            <x-sidebar />
            <div class="content grow padding-container pt-5">
                <h1 class="font-bold text-3xl mb-4">Download</h1>
                <form method="POST" action="{{ route('admin-downloads.store') }}" class="flex-col gap-5"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs mb-1 font-bold" for="title">Title<span
                                    class="text-red-600">*</span></label>
                            <input required type="text" name="title" id="title"
                                oninput="checkInputFilled(this)" placeholder="Enter download title"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400">
                        </div>
                        <div>
                            <label class="block text-xs mb-1 font-bold" for="link">Link</label>
                            <input required type="text" name="link" id="link"
                                oninput="checkInputFilled(this)" placeholder="Enter download link"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400">
                        </div>
                    </div>
                    <div class="flexEnd">
                        <button id="addDownloadBtn"
                            class="w-fit px-4 py-1 my-6  text-white font-bold bg-primary rounded border-2 border-black flexCenter gap-2 disabled:cursor-not-allowed disabled:opacity-30">
                            Add Download
                            <i class="fa-solid fa-plus text-white"></i>
                        </button>
                    </div>
                </form>
                <hr class="border-gray-300 mb-10">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Link</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($downloads as $download)
                            <tr>
                                <input type="hidden" id="rowId" value="{{ $download->id }}">
                                <td id="rowNo">No.</td>
                                <td id="rowTitle">{{ $download->title }}</td>
                                <td id="rowLink">{{ $download->link }}</td>
                                <td id="rowActions">
                                    <div class="flexCenter gap-5">
                                        <button class="hidden" type="button">
                                            <i class="viewCommentBtn fa-solid fa-comment text-lg"></i>
                                        </button>
                                        <button type="button">
                                            <i class="editBtn fa-solid fa-edit text-lg"></i>
                                        </button>
                                        <form action="{{ route('admin-downloads.destroy', $download->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this download?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <i class="fa-solid fa-trash text-red-600 text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        {{-- <tr>
                            <td>Row 1 Data 1</td>
                            <td>Row 1 Data 2</td>
                        </tr> --}}
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

        if (document.querySelector('.myAlert')) {
            const myAlert = document.querySelector('.myAlert');
            myAlert.classList.remove('opacity-0');
            myAlert.classList.add('opacity-100');
            setTimeout(() => {
                myAlert.classList.remove('opacity-100');
                myAlert.classList.add('opacity-0');
            }, 3000);
        }

        // CHECK INPUT FILL DOWNLOAD
        const addDownloadBtn = document.querySelector('#addDownloadBtn');
        addDownloadBtn.setAttribute('disabled', true);

        function checkInputFilled(e) {
            // console.log(e.value);
            const title = document.querySelector('#title');
            const link = document.querySelector('#link');
            if (title.value && link.value) {
                addDownloadBtn.removeAttribute('disabled');
            } else {
                addDownloadBtn.setAttribute('disabled', true);
            }
        }

        // ============================== EDIT ============================== //
        const editBtns = document.querySelectorAll('.editBtn');
        const editModal = document.querySelector('.editModal');
        const editModalContent = document.querySelector('.editModalContent');

        const editDownloadForm = document.querySelector('#editDownloadForm');
        const inputTitleEdit = document.querySelector('#titleEdit');
        const inputLinkEdit = document.querySelector('#linkEdit');
        
        function clearEditFields() {
            inputTitleEdit.value = "";
            inputLinkEdit.value = "";
        }

        editBtns.forEach(editBtn => {
            const tr = editBtn.parentElement.parentElement.parentElement.parentElement.parentElement
            editBtn.addEventListener('click', () => {
                clearEditFields();
                const rowId = tr.querySelector('#rowId').value;
                const rowTitle = tr.querySelector('#rowTitle').innerHTML;
                const rowLink = tr.querySelector('#rowLink').innerHTML;

                editDownloadForm.action = "/sipalingadminB$/downloads/" + rowId;

                document.body.classList.add('overflow-hidden');
                editModal.classList.remove('opacity-0');
                editModal.classList.add('opacity-100');
                editModal.classList.add('bg-black/50');
                editModal.classList.remove('-z-10');
                editModal.classList.add('z-50');
                editModalContent.classList.add('scale-100');
                editModalContent.classList.remove('scale-0');

                // ASSIGN VALUE TO FIELDS
                inputTitleEdit.value = rowTitle;
                inputLinkEdit.value = rowLink;
            });
        });

        editModal.addEventListener('click', () => {
            document.body.classList.remove('overflow-hidden');
            editModal.classList.remove('opacity-100');
            editModal.classList.remove('bg-black/50');
            editModal.classList.add('opacity-0');
            editModal.classList.remove('z-50');
            setTimeout(() => {
                editModal.classList.add('-z-10');
            }, 300);
            editModalContent.classList.add('scale-0');
            editModalContent.classList.remove('scale-100');
        });
    </script>
    {{-- @vite('resources/js/admin-downloads.js') --}}
</body>

</html>
