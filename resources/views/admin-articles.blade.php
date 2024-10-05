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
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script> --}}
    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    @vite('resources/js/trix.umd.min.js')
    {{-- <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css"> --}}
    {{-- <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script> --}}
    {{-- <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script> --}}
    <title>bvcklesmiggle</title>

    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }

        trix-editor {
            background-color: #fff;
            /* border-radius: 10px */
        }
    </style>
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

        {{-- ADD CATEGORY MODAL --}}
        <div
            class="addCategoryModal fixed inset-0 flex -z-10 opacity-100 transition-opacity items-center justify-center">
            <div class="addCategoryModalContent scale-0 transition ease-in-out duration-300 bg-white border-2 border-black max-w-[370px] max-h-[85%] w-[80vw] px-5 overflow-y-auto"
                onclick="event.stopPropagation()">
                <div class="card-popup-header flexBetween border-b-2 border-black sticky top-0 pt-5 pb-3 bg-white">
                    <h1 class="font-bold text-2xl text-black font-segoe">Add Category</h1>
                    <button onclick="disableButton()">
                        <i class="closePopupCategory text-3xl text-black fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="card-popup-body pt-5">
                    <form method="POST" action="{{ route('admin-articles.store') }}" class="flex-col gap-5"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="block text-xs mb-1 font-bold" for="name">Category<span
                                        class="text-red-600">*</span></label>
                                <input required type="text" name="name" id="name"
                                    oninput="checkCategoryFilled()" placeholder="Enter category's name"
                                    class="text-xs w-full rounded-lg px-3 py-2 border border-gray-500 bg-transparent">
                            </div>
                        </div>
                        <div class="mt-4 flexEnd gap-3 sticky bottom-0 bg-white py-3">
                            <button type="button" onclick="disableSaveAddCategoryBtn()"
                                class="w-fit px-4 py-1 text-white font-bold bg-gray-500 rounded closePopup">
                                Cancel
                            </button>
                            <button disabled id="saveAddCategoryBtn" type="submit"
                                class="w-fit px-6 py-1 text-white font-bold bg-primary rounded disabled:cursor-not-allowed disabled:opacity-30">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- EDIT ARTICLE MODAL --}}
        <div class="editModal fixed inset-0 flex -z-10 opacity-100 transition-opacity items-center justify-center">
            <div class="editModalContent scale-0 transition ease-in-out duration-300 bg-white border-2 border-black max-w-[60%] max-h-[85%] px-5 overflow-y-auto w-full"
                onclick="event.stopPropagation()">
                <div class="card-popup-header flexBetween border-b-2 border-black sticky top-0 pt-5 pb-3 bg-white z-40">
                    <h1 class="font-bold text-2xl text-black font-segoe">Edit Article</h1>
                    <button>
                        <i class="closePopupArticle text-3xl text-black fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="card-popup-body pt-5">
                    <form id="editArticleForm" method="POST" action="" class="flex-col gap-5"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="block text-xs mb-1 font-bold" for="titleEdit">Title<span
                                        class="text-red-600">*</span></label>
                                <input required id="titleEdit" type="hidden" name="titleEdit">
                                <trix-editor required id="titleEditTrix" input="titleEdit"
                                    oninput="checkInputFilled(this)"></trix-editor>
                                {{-- <input required type="text" name="titleEdit" id="titleEdit"
                                    oninput="checkInputFilled(this)" placeholder="Enter article's title"
                                    class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400"> --}}
                            </div>
                            <div>
                                <label class="block text-xs mb-1 font-bold" for="authorEdit">Author<span
                                        class="text-red-600">*</span></label>
                                <input required type="text" name="authorEdit" id="authorEdit"
                                    oninput="checkInputFilled(this)" placeholder="Enter article's author"
                                    class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400">
                            </div>
                            <div class="relative">
                                <label class="block text-xs mb-1 font-bold" for="category">Category<span
                                        class="text-red-600">*</span></label>
                                <div class="relative">
                                    <select name="categoryEdit" id="categoryEdit" oninput="checkInputFilled(this)"
                                        required
                                        class="w-full px-3 py-2 rounded-lg appearance-none border border-gray-400 text-xs cursor-pointer">
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute top-0 right-0 h-full flexCenter pe-3"><i
                                            class="fa-solid fa-chevron-down"></i></div>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs mb-1 font-bold">New Article's Image</label>
                                <input type="file" name="articleImageEdit" id="articleImage"
                                    accept=".jpeg,.jpg,.png,.webp"
                                    class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400 bg-white @error('image') is-invalid @enderror"
                                    onchange="validateFiles('articleImage', 'articleImagesPreview', 'articleImageError')">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="text-red-500 text-xs pt-2" id="articleImageError"></div>
                                <!-- Tempat error message -->
                                <div class="grid grid-cols-2 gap-3 pt-4" id="articleImagesPreview"></div>
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs mb-1 font-bold">Body</label>
                                <input required id="bodyEdit" type="hidden" name="bodyEdit">
                                <trix-editor id="bodyEditTrix" input="bodyEdit"
                                    oninput="checkInputFilled(this)"></trix-editor>
                            </div>
                        </div>
                        <div class="mt-4 flexEnd gap-3 sticky bottom-0 bg-white border-t-2 border-black py-3">
                            <button type="button"
                                class="w-fit px-4 py-1 text-white font-bold bg-gray-500 rounded closePopupArticle">
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

        {{-- VIEW COMMENT MODAL --}}
        <div
            class="viewCommentModal fixed inset-0 flex -z-10 opacity-100 transition-opacity items-center justify-center">
            <div class="viewCommentModalContent scale-0 transition ease-in-out duration-300 bg-white border-2 border-black max-w-[370px] max-h-[85%] w-[80vw] px-5 overflow-y-auto"
                onclick="event.stopPropagation()">
                <div class="card-popup-header flexBetween border-b-2 border-black sticky top-0 pt-5 pb-3 bg-white">
                    <h1 class="font-bold text-2xl text-black font-segoe">Comments</h1>
                    <button onclick="disableButton()">
                        <i class="closePopupCategory text-3xl text-black fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="card-popup-body pt-5">
                    <form method="POST" action="{{ route('admin-articles.store') }}" class="flex-col gap-5"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="block text-xs mb-1 font-bold" for="name">Category<span
                                        class="text-red-600">*</span></label>
                                <input required type="text" name="name" id="name"
                                    oninput="checkCategoryFilled()" placeholder="Enter category's name"
                                    class="text-xs w-full rounded-lg px-3 py-2 border border-gray-500 bg-transparent">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="flex">
            <x-sidebar/>
            <div class="content grow padding-container pt-5">
                <h1 class="font-bold text-3xl mb-4">Articles</h1>
                <form method="POST" action="{{ route('admin-articles.store') }}" class="flex-col gap-5"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label class="block text-xs mb-1 font-bold" for="title">Title<span
                                    class="text-red-600">*</span></label>
                            <input type="hidden" name="title" id="title">
                                <trix-editor required id="titleTrix" input="title"
                                    oninput="checkInputFilled(this)"></trix-editor>
                        </div>
                        <div>
                            <label class="block text-xs mb-1 font-bold" for="author">Author<span
                                    class="text-red-600">*</span></label>
                            <input required type="text" name="author" id="author"
                                oninput="checkInputFilled(this)" placeholder="Enter article's author"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400">
                        </div>
                        <div class="relative">
                            <label class="block text-xs mb-1 font-bold" for="category">Category<span
                                    class="text-red-600">*</span></label>
                            <div class="relative">
                                <select name="category" id="category" oninput="checkInputFilled(this)"
                                    class="w-full px-3 py-2 rounded-lg appearance-none border border-gray-400 text-xs cursor-pointer">
                                    <option value="">-- Select Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute top-0 right-0 h-full flexCenter pe-3"><i
                                        class="fa-solid fa-chevron-down"></i></div>
                            </div>
                            {{-- <div
                                class="categoryContainer absolute top-full mt-1 h-0 overflow-hidden duration-300 z-50">
                                <ul class="leading-loose px-5 py-3 border border-gray-400 bg-dark rounded-xl">
                                    <li><a class="font-bold font-segoe color-primary" href="#">ALL</a>
                                    <li>
                                        <hr class="border-t-1 border-gray-200 border-dashed my-2 px-16">
                                    </li>
                                    <li><a class="text-light font-semibold font-segoe hover:color-primary"
                                            href="products?category=head%20gear">Head
                                            Gear</a></li>
                                    <li><a class="text-light font-semibold font-segoe hover:color-primary"
                                            href="#">Body
                                            Armor</a></li>
                                    <li><a class="text-light font-semibold font-segoe hover:color-primary"
                                            href="#">Hand
                                            Wear</a></li>
                                    <li><a class="text-light font-semibold font-segoe hover:color-primary"
                                            href="#">Foot
                                            Wear</a></li>
                                    <li>
                                        <hr class="border-t-1 border-gray-200 border-dashed my-2 px-16">
                                    </li>
                                    <li><a class="text-light font-semibold font-segoe hover:color-primary"
                                            href="#">Storage</a></li>
                                    <li><a class="text-light font-semibold font-segoe hover:color-primary"
                                            href="#">Extended</a></li>
                                    <li><a class="text-light font-semibold font-segoe hover:color-primary"
                                            href="#">Items</a></li>
                                </ul>
                            </div> --}}
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs mb-1 font-bold">Article's Image</label>
                            <input type="file" name="articleImage" id="articleImage"
                                accept=".jpeg,.jpg,.png,.webp"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400 bg-white @error('image') is-invalid @enderror"
                                onchange="validateFiles('articleImage', 'articleImagesPreview', 'articleImageError')">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="text-red-500 text-xs pt-2" id="articleImageError"></div>
                            <!-- Tempat error message -->
                            <div class="grid grid-cols-2 gap-3 pt-4" id="articleImagesPreview"></div>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs mb-1 font-bold">Body</label>
                            <input required id="body" type="hidden" name="body">
                            <trix-editor input="body" id="bodyTrix" oninput="checkInputFilled(this)"></trix-editor>
                        </div>
                    </div>
                    <div class="flexBetween">
                        <button type="button" id="addCategoryBtn"
                            class="w-fit px-4 py-1 my-6  color-primary font-bold rounded border-2 border-primary flexCenter gap-2">
                            Add Category
                            <i class="fa-solid fa-plus color-primary"></i>
                        </button>
                        <button id="addArticleBtn"
                            class="w-fit px-4 py-1 my-6  text-white font-bold bg-primary rounded border-2 border-black flexCenter gap-2 disabled:cursor-not-allowed disabled:opacity-30">
                            Add Article
                            <i class="fa-solid fa-plus text-white"></i>
                        </button>
                    </div>
                </form>
                <hr class="border-gray-300 mb-10">
                <div class="table-container overflow-x-auto">
                    <table id="myTable" class="display table-fixed w-full">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Article Image</th>
                                <th>Body</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                                <tr>
                                    <input type="hidden" id="rowId" value="{{ $article->id }}">
                                    <td id="rowNo">No.</td>
                                    <td id="rowTitle">{!! $article->title !!}</td>
                                    <td id="rowAuthor">{{ $article->author }}</td>
                                    <td id="rowCategory">{{ $article->categories->implode('name', ', ') }}</td>
                                    <td>
                                        @if ($article->image)
                                            <div class="relative">
                                                <img id="rowArticleImage" src="{{ asset('storage/' . $article->image) }}"
                                                    alt="Article Image"
                                                    class="img-fluid cursor-pointer rowArticleImage"
                                                    onclick="openModal('{{ asset('storage/' . $article->image) }}')">
                                            </div>
                                        @endif
                                    <td id="rowBody">
                                        <div class="line-clamp-3">
                                            {!! $article->body !!}
                                        </div>
                                    </td>
                                    <td id="rowActions">
                                        <div class="flexCenter gap-5">
                                            <button class="hidden" type="button">
                                                <i class="viewCommentBtn fa-solid fa-comment text-lg"></i>
                                            </button>
                                            <button type="button">
                                                <i class="editBtn fa-solid fa-edit text-lg"></i>
                                            </button>
                                            <form action="{{ route('admin-articles.destroy', $article->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this article?');">
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
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "responsive": true,
                "columnDefs": [
                    {
                        "width": "10%",
                        "targets": 0
                    }, // Mengatur lebar kolom pertama
                    {
                        "width": "10%",
                        "targets": 1
                    }, // Mengatur lebar kolom pertama
                    {
                        "width": "10%",
                        "targets": 2
                    }, // Mengatur lebar kolom pertama
                    {
                        "width": "10%",
                        "targets": 3
                    }, // Mengatur lebar kolom pertama
                    {
                        "width": "20%",
                        "targets": 4
                    }, // Mengatur lebar kolom pertama
                    {
                        "width": "15%",
                        "targets": 5
                    }, // Mengatur lebar kolom pertama
                    {
                        "width": "10%",
                        "targets": 6
                    } // Mengatur kolom kedua untuk menempati sisa ruang
                ],
                "order": [
                    [1, 'asc']
                ],
                "rowCallback": function(row, data, index) {
                    var table = $('#myTable').DataTable();
                    $('td:eq(0)', row).html(table.page.info().start + index + 1);
                }
            });
        });

        // ADD ARTICLE
        function previewArticleImages() {
            const articleImages = document.querySelector('#articleImage').files;
            const articleImagesPreview = document.querySelector('#articleImagesPreview');
            articleImagesPreview.innerHTML = ''; // Bersihkan preview sebelumnya

            for (const image of articleImages) {
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image);

                oFReader.onload = function(oFREvent) {
                    const imgElement = document.createElement('img');
                    imgElement.src = oFREvent.target.result;
                    imgElement.classList.add('img-fluid');
                    imgElement.classList.add('border');
                    imgElement.classList.add('border-gray-200');
                    imgElement.style.maxWidth = '100%';
                    articleImagesPreview.appendChild(imgElement);
                };
            }
        }

        function previewDetailImages() {
            const detailImages = document.querySelector('#detailImage').files;
            const detailImagePreview = document.querySelector('#detailImagePreview');
            detailImagePreview.innerHTML = ''; // Bersihkan preview sebelumnya

            for (const image of detailImages) {
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image);

                oFReader.onload = function(oFREvent) {
                    const imgElement = document.createElement('img');
                    imgElement.src = oFREvent.target.result;
                    imgElement.classList.add('img-fluid');
                    imgElement.classList.add('border');
                    imgElement.classList.add('border-gray-200');
                    imgElement.style.maxWidth = '100%';
                    detailImagePreview.appendChild(imgElement);
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

        // EDIT ARTICLE
        function previewArticleImagesEdit() {
            const articleImages = document.querySelector('#articleImageEdit').files;
            const articleImagesPreview = document.querySelector('#articleImagesPreviewEdit');
            articleImagesPreview.innerHTML = ''; // Bersihkan preview sebelumnya

            for (const image of articleImages) {
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image);

                oFReader.onload = function(oFREvent) {
                    const imgElement = document.createElement('img');
                    imgElement.src = oFREvent.target.result;
                    imgElement.classList.add('img-fluid');
                    imgElement.classList.add('border');
                    imgElement.classList.add('border-gray-200');
                    imgElement.style.maxWidth = '100%';
                    articleImagesPreview.appendChild(imgElement);
                };
            }
        }

        function previewDetailImagesEdit() {
            const detailImages = document.querySelector('#detailImageEdit').files;
            const detailImagePreview = document.querySelector('#detailImagePreviewEdit');
            detailImagePreview.innerHTML = ''; // Bersihkan preview sebelumnya

            for (const image of detailImages) {
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image);

                oFReader.onload = function(oFREvent) {
                    const imgElement = document.createElement('img');
                    imgElement.src = oFREvent.target.result;
                    imgElement.classList.add('img-fluid');
                    imgElement.classList.add('border');
                    imgElement.classList.add('border-gray-200');
                    imgElement.style.maxWidth = '100%';
                    detailImagePreview.appendChild(imgElement);
                };
            }
        }


        // function previewArticleImage() {
        //     const articleImage = document.querySelector('#articleImage');
        //     const articleImagePreview = document.querySelector(".articleImagePreview");
        //     console.log(articleImagePreview);
        //     articleImagePreview.style.display = 'bflock';

        //     const oFReader = new FileReader();
        //     oFReader.readAsDataURL(articleImage.files[0]);

        //     oFReader.onload = function(oFREvent) {
        //         articleImagePreview.src = oFREvent.target.result;
        //     }
        // }

        // function previewDetailImage() {
        //     const detailImage = document.querySelector('#detailImage');
        //     const detailImagePreview = document.querySelector(".detailImagePreview");
        //     console.log(detailImagePreview);
        //     detailImagePreview.style.display = 'block';

        //     const oFReader = new FileReader();
        //     oFReader.readAsDataURL(detailImage.files[0]);

        //     oFReader.onload = function(oFREvent) {
        //         detailImagePreview.src = oFREvent.target.result;
        //     }
        // }

        // $(document).ready(function() {
        //     $('#myTable').DataTable();
        // });
        // $(document).ready(function() {
        //     $('#myTable').DataTable({
        //         "columnDefs": [{
        //             "searchable": false,
        //             "orderable": false,
        //             "targets": 0,
        //             "render": function(data, type, row, meta) {
        //                 return meta.row + 1;
        //             }
        //         }],
        //         "order": [
        //             [1, 'asc']
        //         ]
        //     });
        // });
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

        // CHECK INPUT FILL ARTICLE
        const addArticleBtn = document.querySelector('#addArticleBtn');
        addArticleBtn.setAttribute('disabled', true);

        document.getElementById('bodyTrix').addEventListener('trix-paste', function(event) {
            // Dapatkan konten yang dipaste
            // const pastedContent = event.paste;

            // Lakukan sesuatu dengan konten yang dipaste
            // console.log('Content pasted:', pastedContent);
            checkInputFilled()
        });

        document.getElementById('bodyEditTrix').addEventListener('trix-paste', function(event) {
            // Dapatkan konten yang dipaste
            // const pastedContent = event.paste;

            // Lakukan sesuatu dengan konten yang dipaste
            // console.log('Content pasted:', pastedContent);
            checkInputFilled()
        });

        function checkInputFilled(e) {
            // console.log(e.value);
            const title = document.querySelector('#titleTrix');
            const author = document.querySelector('#author');
            const category = document.querySelector('#category');
            const body = document.querySelector('#bodyTrix');
            if (title.value && author.value && category.value && body.value) {
                addArticleBtn.removeAttribute('disabled');
            } else {
                addArticleBtn.setAttribute('disabled', true);
            }
        }

        // function disableAddArticleBtn() {
        //     addArticleBtn.setAttribute('disabled', true);
        // }

        // CHECK INPUT FILL CATEGORY
        const saveAddCategoryBtn = document.querySelector('#saveAddCategoryBtn');
        saveAddCategoryBtn.setAttribute('disabled', true);

        function checkCategoryFilled() {
            const name = document.querySelector('#name');
            if (name.value) {
                saveAddCategoryBtn.removeAttribute('disabled');
            } else {
                saveAddCategoryBtn.setAttribute('disabled', true);
            }
        }

        function disableSaveAddCategoryBtn() {
            saveAddCategoryBtn.setAttribute('disabled', true);
        }
    </script>
    @vite('resources/js/admin-articles.js')
</body>

</html>
