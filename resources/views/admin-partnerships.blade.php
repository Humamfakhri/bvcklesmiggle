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

        <!-- VIEW IMAGE MODAL -->
        <div id="imageModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 items-center justify-center hidden">
            <div class="relative max-w-[80vh] max-h-[80vh]">
                <img id="modalImage" src="" alt="Full Image" class="img-fluid w-full">
                {{-- <img id="modalImage" src="" alt="Full Image" class="max-w-full max-h-full object-contain"> --}}
                <button onclick="closeModal()"
                    class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2 bg-primary w-8 h-8 rounded-full"><i
                        class="fa-solid fa-xmark text-white"></i></button>
            </div>
        </div>

        {{-- EDIT PARTNERSHIP MODAL --}}
        <div class="editModal fixed inset-0 flex -z-10 opacity-100 transition-opacity items-center justify-center">
            <div class="editModalContent scale-0 transition ease-in-out duration-300 bg-white border-2 border-black max-w-[60%] max-h-[85%] px-5 overflow-y-auto w-full"
                onclick="event.stopPropagation()">
                <div class="card-popup-header flexBetween border-b-2 border-black sticky top-0 pt-5 pb-3 bg-white">
                    <h1 class="font-bold text-2xl text-black font-segoe">Edit Partnership</h1>
                    <button>
                        <i class="closePopupPartnership text-3xl text-black fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="card-popup-body pt-5">
                    <form id="editPartnershipForm" method="POST" action="" class="flex-col gap-5"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="block text-xs mb-1 font-bold" for="nameEdit">Name<span
                                        class="text-red-600">*</span></label>
                                <input required type="text" name="nameEdit" id="nameEdit"
                                    oninput="checkInputFilled(this)" placeholder="Enter partnership's name"
                                    class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400">
                            </div>
                            <div>
                                <label class="block text-xs mb-1 font-bold" for="linkEdit">Link<span
                                        class="text-red-600">*</span></label>
                                <input required type="text" name="linkEdit" id="linkEdit"
                                    oninput="checkInputFilled(this)" placeholder="Enter partnership's link"
                                    class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs mb-1 font-bold">New Partnership's Image</label>
                                <input type="file" name="imageEdit" id="imageEdit" accept=".jpeg,.jpg,.png,.webp"
                                    class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400 bg-white @error('imageEdit') is-invalid @enderror"
                                    onchange="validateFiles('imageEdit', 'imageEditPreview', 'imageEditError')">
                                @error('imageEdit')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="text-red-500 text-xs pt-2" id="imageEditError"></div>
                                <!-- Tempat error message -->
                                <div class="grid grid-cols-2 gap-3 pt-4" id="imageEditPreview"></div>
                            </div>
                        </div>
                        <div class="mt-4 flexEnd gap-3 sticky bottom-0 bg-white border-t-2 border-black py-3">
                            <button type="button"
                                class="w-fit px-4 py-1 text-white font-bold bg-gray-500 rounded closePopupPartnership">
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
                <h1 class="font-bold text-3xl mb-4">Partnership</h1>
                <form method="POST" action="{{ route('admin-partnerships.store') }}" class="flex-col gap-5"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs mb-1 font-bold" for="name">Name<span
                                    class="text-red-600">*</span></label>
                            <input required type="text" name="name" id="name"
                                oninput="checkInputFilled(this)" placeholder="Enter partnership name"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400">
                        </div>
                        <div>
                            <label class="block text-xs mb-1 font-bold" for="link">Link</label>
                            <input required type="text" name="link" id="link"
                                oninput="checkInputFilled(this)" placeholder="Enter partnership link"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs mb-1 font-bold">Partnership's Image</label>
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
                        <button id="addPartnershipBtn"
                            class="w-fit px-4 py-1 my-6  text-white font-bold bg-primary rounded border-2 border-black flexCenter gap-2 disabled:cursor-not-allowed disabled:opacity-30">
                            Add Partnership
                            <i class="fa-solid fa-plus text-white"></i>
                        </button>
                    </div>
                </form>
                <hr class="border-gray-300 mb-10">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Link</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($partnerships as $partnership)
                            <tr>
                                <input type="hidden" id="rowId" value="{{ $partnership->id }}">
                                <td id="rowNo">No.</td>
                                <td id="rowName">{{ $partnership->name }}</td>
                                <td>
                                    @if ($partnership->image)
                                        <div class="relative">
                                            <img id="rowImage" src="{{ asset('storage/' . $partnership->image) }}"
                                                alt="Partnership Image"
                                                class="w-full cursor-pointer rowImage min-w-40"
                                                onclick="openModal('{{ asset('storage/' . $partnership->image) }}')">
                                        </div>
                                    @endif
                                </td>
                                <td id="rowLink">{{ $partnership->link }}</td>
                                <td id="rowActions">
                                    <div class="flexCenter gap-5">
                                        <button class="hidden" type="button">
                                            <i class="viewCommentBtn fa-solid fa-comment text-lg"></i>
                                        </button>
                                        <button type="button">
                                            <i class="editBtn fa-solid fa-edit text-lg"></i>
                                        </button>
                                        <form action="{{ route('admin-partnerships.destroy', $partnership->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this partnership?');">
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

        // ADD PARTNERSHIP
        function previewImages() {
            const images = document.querySelector('#image').files;
            const imagesPreview = document.querySelector('#imagesPreview');
            imagesPreview.innerHTML = ''; // Bersihkan preview sebelumnya

            for (const image of images) {
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image);

                oFReader.onload = function(oFREvent) {
                    const imgElement = document.createElement('img');
                    imgElement.src = oFREvent.target.result;
                    imgElement.classList.add('img-fluid');
                    imgElement.classList.add('border');
                    imgElement.classList.add('border-gray-200');
                    imgElement.style.maxWidth = '100%';
                    imagesPreview.appendChild(imgElement);
                };
            }
        }

        function validateFiles(inputId, previewId, errorId) {
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
            const maxSize = 2 * 1024 * 1024; // 2MB in bytes

            const inputFile = document.getElementById(inputId);
            const errorElement = document.getElementById(errorId);
            const previewElement = document.getElementById(previewId);
            errorElement.textContent = '';
            previewElement.innerHTML = ''; // Bersihkan preview sebelumnya

            for (const file of inputFile.files) {
                // Validasi tipe file
                if (!allowedTypes.includes(file.type)) {
                    errorElement.textContent = 'File harus berupa JPEG, JPG, PNG, atau WEBP.';
                    inputFile.value = ''; // Kosongkan input jika tidak valid
                    return;
                }

                // Validasi ukuran file
                if (file.size > maxSize) {
                    errorElement.textContent = 'File tidak boleh lebih besar dari 2MB.';
                    inputFile.value = ''; // Kosongkan input jika tidak valid
                    return;
                }

                // Buat preview gambar
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.classList.add('img-fluid', 'border', 'border-gray-200');
                    imgElement.style.maxWidth = '100%';
                    previewElement.appendChild(imgElement);
                };
                reader.readAsDataURL(file);
            }
        }

        // EDIT PARTNERSHIP
        function previewImagesEdit() {
            const images = document.querySelector('#imageEdit').files;
            const imagesPreview = document.querySelector('#imagesPreviewEdit');
            imagesPreview.innerHTML = ''; // Bersihkan preview sebelumnya

            for (const image of images) {
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image);

                oFReader.onload = function(oFREvent) {
                    const imgElement = document.createElement('img');
                    imgElement.src = oFREvent.target.result;
                    imgElement.classList.add('img-fluid');
                    imgElement.classList.add('border');
                    imgElement.classList.add('border-gray-200');
                    imgElement.style.maxWidth = '100%';
                    imagesPreview.appendChild(imgElement);
                };
            }
        }


        function openModal(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
            document.getElementById('imageModal').classList.add('flex');
            document.getElementById('imageModal').classList.add('z-50');
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.getElementById('imageModal').classList.remove('flex');
            document.getElementById('imageModal').classList.remove('z-50');
        }

        if (document.querySelector('.myAlert')) {
            const myAlert = document.querySelector('.myAlert');
            myAlert.classList.remove('opacity-0');
            myAlert.classList.add('opacity-100');
            setTimeout(() => {
                myAlert.classList.remove('opacity-100');
                myAlert.classList.add('opacity-0');
            }, 3000);
        }

        // CHECK INPUT FILL PARTNERSHIP
        const addPartnershipBtn = document.querySelector('#addPartnershipBtn');
        addPartnershipBtn.setAttribute('disabled', true);

        function checkInputFilled(e) {
            // console.log(e.value);
            const name = document.querySelector('#name');
            const link = document.querySelector('#link');
            const image = document.querySelector('#image');
            if (name.value && link.value && image.value) {
                addPartnershipBtn.removeAttribute('disabled');
            } else {
                addPartnershipBtn.setAttribute('disabled', true);
            }
        }

        // ============================== EDIT ============================== //
        const editBtns = document.querySelectorAll('.editBtn');
        const editModal = document.querySelector('.editModal');
        const editModalContent = document.querySelector('.editModalContent');

        const editPartnershipForm = document.querySelector('#editPartnershipForm');
        const inputNameEdit = document.querySelector('#nameEdit');
        const inputLinkEdit = document.querySelector('#linkEdit');
        const inputImageEdit = document.querySelector('#imageEdit');

        function clearEditFields() {
            inputNameEdit.value = "";
            inputLinkEdit.value = "";
            inputImageEdit.value = "";
            while (imageEditPreview.querySelector('img')) {
                imageEditPreview.querySelector('img').remove();
            }
        }

        editBtns.forEach(editBtn => {
            const tr = editBtn.parentElement.parentElement.parentElement.parentElement.parentElement
            editBtn.addEventListener('click', () => {
                clearEditFields();
                const rowId = tr.querySelector('#rowId').value;
                const rowName = tr.querySelector('#rowName').innerHTML;
                const rowImage = tr.querySelector('#rowImage');
                const rowLink = tr.querySelector('#rowLink').innerHTML;

                editPartnershipForm.action = "/sipalingadminB$/partnership/" + rowId;

                document.body.classList.add('overflow-hidden');
                editModal.classList.remove('opacity-0');
                editModal.classList.add('opacity-100');
                editModal.classList.add('bg-black/50');
                editModal.classList.remove('-z-10');
                editModal.classList.add('z-50');
                editModalContent.classList.add('scale-100');
                editModalContent.classList.remove('scale-0');

                // ASSIGN VALUE TO FIELDS
                inputNameEdit.value = rowName;
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
    {{-- @vite('resources/js/admin-partnerships.js') --}}
</body>

</html>
