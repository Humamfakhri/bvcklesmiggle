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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    @vite('resources/js/trix.umd.min.js')
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
            <div class="myAlert transition-opacity duration-300 rounded fixed top-0 right-0 padding-container pt-5"
                role="alert">
                <div class="bg-green-100 rounded border border-green-400 text-green-700 px-4 py-3">
                    {{-- <span class="block sm:inline">Berhasil</span> --}}
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @elseif (session('error'))
            <div class="myAlert transition-opacity duration-300 rounded fixed top-0 right-0 padding-container pt-5"
                role="alert">
                <div class="bg-red-100 rounded border border-red-400 text-red-700 px-4 py-3">
                    {{-- <span class="block sm:inline">Berhasil</span> --}}
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            </div>
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

        {{-- EDIT PRODUCT MODAL --}}
        <div class="editModal fixed inset-0 flex -z-10 opacity-100 transition-opacity items-center justify-center">
            <div class="editModalContent scale-0 transition ease-in-out duration-300 bg-white border-2 border-black max-w-[60%] max-h-[85%] px-5 overflow-y-auto w-full"
                onclick="event.stopPropagation()">
                <div class="card-popup-header flexBetween border-b-2 border-black sticky top-0 pt-5 pb-3 bg-white">
                    <h1 class="font-bold text-2xl text-black font-segoe">Edit Product</h1>
                    <button>
                        <i class="closePopup text-3xl text-black fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="card-popup-body pt-5">
                    <form method="POST" action="" id="editProductForm" class="flex-col gap-5"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs mb-1 font-bold" for="nameEdit">Name</label>
                                <input required type="text" name="nameEdit" id="nameEdit"
                                    placeholder="Enter product's name"
                                    class="text-xs w-full rounded-lg px-3 py-2 border border-gray-500 bg-transparent">
                            </div>
                            <div>
                                <label class="block text-xs mb-1 font-bold" for="categoryEdit">Category</label>
                                <input required type="text" name="categoryEdit" id="categoryEdit"
                                    placeholder="Enter product's category"
                                    class="text-xs w-full rounded-lg px-3 py-2 border border-gray-500 bg-transparent">
                            </div>
                            <div>
                                <label class="block text-xs mb-1 font-bold" for="linkShopeeEdit">Link Shopee</label>
                                <input required type="text" name="linkShopeeEdit" id="linkShopeeEdit"
                                    placeholder="https://shopee.co.id/..."
                                    class="text-xs w-full rounded-lg px-3 py-2 border border-gray-500 bg-transparent">
                            </div>
                            <div>
                                <label class="block text-xs mb-1 font-bold" for="linkTokopediaEdit">Link
                                    Tokopedia</label>
                                <input required type="text" name="linkTokopediaEdit" id="linkTokopediaEdit"
                                    placeholder="https://www.tokopedia.com/..."
                                    class="text-xs w-full rounded-lg px-3 py-2 border border-gray-500 bg-transparent">
                            </div>
                            {{-- <div class="col-span-2">
                                <label class="block text-xs mb-1 font-bold" for="thumbnailEdit">New Thumbnail</label>
                                <input type="file" name="thumbnailEdit[]" id="thumbnailEdit" multiple
                                    accept=".jpeg,.jpg,.png,.webp"
                                    class="text-xs w-full rounded-lg px-3 py-2 border border-gray-500 bg-transparent @error('image') is-invalid @enderror"
                                    onchange="validateFiles('thumbnailEdit', 'thumbnailsPreviewEdit', 'thumbnailEditError')">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="text-red-500 text-xs pt-2" id="thumbnailEditError"></div>
                                <!-- Tempat error message -->
                                <div class="grid grid-cols-3 gap-3 pt-4" id="thumbnailsPreviewEdit"></div>
                            </div> --}}
                            <div class="col-span-2">
                                <label class="block text-xs mb-1 font-bold" for="productImageEdit">New Product Image</label>
                                <input type="file" name="productImageEdit[]" id="productImageEdit" multiple
                                    accept=".jpeg,.jpg,.png,.webp"
                                    class="text-xs w-full rounded-lg px-3 py-2 border border-gray-500 bg-transparent @error('image') is-invalid @enderror"
                                    onchange="validateFiles('productImageEdit', 'productImagesPreviewEdit', 'productImageEditError')">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="text-red-500 text-xs pt-2" id="productImageEditError"></div>
                                <!-- Tempat error message -->
                                <div class="grid grid-cols-3 gap-3 pt-4" id="productImagesPreviewEdit"></div>
                            </div>
                            {{-- <div>
                                <label class="block text-xs mb-1 font-bold" for="detailImageEdit">New Detail's
                                    Image</label>
                                <input type="file" name="detailImageEdit" id="detailImageEdit"
                                    class="text-xs w-full rounded-lg px-3 py-2 border border-gray-500 bg-transparent @error('image') is-invalid @enderror"
                                    onchange="validateFiles('detailImageEdit', 'detailImagePreviewEdit', 'detailImageEditError')">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="text-red-500 text-xs pt-2" id="detailImageEditError"></div>
                                <!-- Tempat error message -->
                                <div class="grid grid-cols-2 gap-3 pt-4" id="detailImagePreviewEdit"></div>
                            </div> --}}
                            <div class="col-span-2">
                                <label class="block text-xs mb-1 font-bold">Issue</label>
                                <input id="issueEdit" type="hidden" name="issueEdit">
                                <trix-editor id="issueEdit2" input="issueEdit" oninput="addProductValidation(this)"></trix-editor>
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs mb-1 font-bold">Details</label>
                                <input id="detailsEdit" type="hidden" name="detailsEdit">
                                <trix-editor id="detailsEdit2" input="detailsEdit" oninput="addProductValidation(this)"></trix-editor>
                            </div>
                        </div>
                        <div class="mt-4 flexEnd gap-3 sticky bottom-0 bg-white border-t-2 border-black py-3">
                            <button type="button"
                                class="w-fit px-4 py-1 text-white font-bold bg-gray-500 rounded closePopup">
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
                    <form method="POST" action="{{ route('admin-products.store') }}" class="flex-col gap-5"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="block text-xs mb-1 font-bold" for="categoryName">Category<span
                                        class="text-red-600">*</span></label>
                                <input required type="text" name="categoryName" id="categoryName"
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


        <div class="flex">
            <x-sidebar/>
            <div class="content grow padding-container pt-5">
                <h1 class="font-bold text-3xl mb-4">Products</h1>
                {{-- <button id="addProductBtn"
                    class="w-fit px-2 py-1 my-6 text-white font-bold bg-primary rounded border-2 border-black flexCenter gap-2">
                    Add Product
                    <i class="fa-solid fa-plus text-white"></i>
                </button> --}}

                <form method="POST" action="{{ route('admin-products.store') }}" class="flex-col gap-5"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs mb-1 font-bold" for="name">Name<span
                                    class="text-red-600">*</span></label>
                            <input required type="text" name="name" id="name"
                                oninput="addProductValidation(this)" placeholder="Enter product name"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400">
                        </div>
                        <div class="relative">
                            <label class="block text-xs mb-1 font-bold" for="category">Category<span
                                    class="text-red-600">*</span></label>
                            <div class="relative">
                                <select name="category" id="category" oninput="addProductValidation(this)"
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
                        <div>
                            <label class="block text-xs mb-1 font-bold" for="linkShopee">Link Shopee</label>
                            <input required type="text" name="linkShopee" id="linkShopee"
                                oninput="addProductValidation(this)" placeholder="Enter Shopee product link"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400">
                        </div>
                        <div>
                            <label class="block text-xs mb-1 font-bold" for="linkTokopedia">Link Tokopedia</label>
                            <input required type="text" name="linkTokopedia" id="linkTokopedia"
                                oninput="addProductValidation(this)" placeholder="Enter Tokopedia product link"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400">
                        </div>
                        {{-- <div class="col-span-2">
                            <label class="block text-xs mb-1 font-bold">Product Images</label>
                            <input type="file" name="productImage[]" id="productImage" multiple
                                accept=".jpeg,.jpg,.png,.webp"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400 bg-white @error('image') is-invalid @enderror"
                                onchange="validateFiles('productImage', 'productImagesPreview', 'productImageError')">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="text-red-500 text-xs pt-2" id="productImageError"></div>
                            <!-- Tempat error message -->
                            <div class="grid grid-cols-4 gap-3 pt-4" id="productImagesPreview"></div>
                        </div> --}}
                        {{-- <div class="col-span-2">
                            <!-- Input untuk Thumbnail -->
                            <label class="block text-xs mb-1 font-bold">Product Thumbnail</label>
                            <input type="file" name="thumbnail" id="thumbnail" accept=".jpeg,.jpg,.png,.webp"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400 bg-white"
                                onchange="validateFiles('thumbnail', 'thumbnailPreview', 'thumbnailError')">
                            <div class="text-red-500 text-xs" id="thumbnailError"></div>
                            <div class="grid grid-cols-1 gap-3" id="thumbnailPreview"></div>
                        </div> --}}
                        
                        <div class="col-span-2">
                            <!-- Input untuk Gambar Detail -->
                            <label class="block text-xs mb-1 font-bold">Product Images</label>
                            <input type="file" name="productImage[]" id="productImage" multiple accept=".jpeg,.jpg,.png,.webp"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-400 bg-white"
                                onchange="validateFiles('productImage', 'productImagesPreview', 'productImageError')">
                            <div class="text-red-500 text-xs" id="productImageError"></div>
                            <div class="grid grid-cols-4 gap-3" id="productImagesPreview">
                                {{-- <img src="/img/blckruby1.jpg" alt="" class="w-full object-cover aspect-square border border-gray-200 mt-4"> --}}
                            </div>
                        </div>
                        
                        <div class="col-span-2">
                            <label class="block text-xs mb-1 font-bold">Issue</label>
                            <input id="issue" type="hidden" name="issue">
                            <trix-editor input="issue" oninput="addProductValidation(this)"></trix-editor>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs mb-1 font-bold">Details</label>
                            <input id="details" type="hidden" name="details">
                            <trix-editor input="details" oninput="addProductValidation(this)"></trix-editor>
                        </div>
                    </div>
                    <div class="flexBetween">
                        <button type="button" id="addCategoryBtn"
                            class="w-fit px-4 py-1 my-6  color-primary font-bold rounded border-2 border-primary flexCenter gap-2">
                            Add Category
                            <i class="fa-solid fa-plus color-primary"></i>
                        </button>
                        <button disabled id="addProductBtn"
                            class="w-fit px-4 py-1 my-6  text-white font-bold bg-primary rounded border-2 border-black flexCenter gap-2 disabled:cursor-not-allowed disabled:opacity-30">
                            Add Product
                            <i class="fa-solid fa-plus text-white"></i>
                        </button>
                    </div>
                </form>

                <hr class="my-10">

                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Product Images</th>
                            {{-- <th>Detail Image</th> --}}
                            <th>Issue</th>
                            <th>Details</th>
                            <th>Link</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <input type="hidden" id="rowId" value="{{ $product->id }}">
                                <td id="rowNo">No.</td>
                                <td id="rowName">{{ $product->name }}</td>
                                <td id="rowCategory">{{ $product->category }}</td>
                                <td>
                                    {{-- <div> --}}
                                    <div class="grid grid-cols-2 gap-3">
                                        @foreach (json_decode($product->product_images) as $image)
                                            {{-- <img src="{{ asset('storage/' . $image) }}" alt="Product Image"
                                            class="img-fluid w-full"> --}}
                                            <div class="relative">
                                                <img src="{{ asset('storage/' . $image) }}" alt="Product Image"
                                                    class="w-full object-cover aspect-square border border-gray-200 cursor-pointer rowProductImage"
                                                    onclick="openModal('{{ asset('storage/' . $image) }}')">
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                {{-- <td><img src="{{ asset('storage/' . $product->detail_image) }}" alt="Detail Image"
                                        id="rowDetailImage" class="w-full cursor-pointer"
                                        onclick="openModal('{{ asset('storage/' . $product->detail_image) }}')"></td> --}}
                                <td id="rowIssue">{!! $product->issue !!}</td>
                                <td id="rowDetails">{!! $product->details !!}</td>
                                <td>
                                    <div class="flexCenter gap-3">
                                        <button>
                                            <a id="rowLinkShopee" href="{{ $product->link_shopee }}"
                                                target="_blank">
                                                <img src="/img/shopee.png" alt="" class="w-8 h-auto">
                                            </a>
                                        </button>
                                        <button>
                                            <a id="rowLinkTokopedia" href="{{ $product->link_tokopedia }}"
                                                target="_blank">
                                                <img src="/img/tokopedia.png" alt="" class="w-8 h-auto">
                                            </a>
                                        </button>
                                    </div>
                                </td>
                                <td id="rowActions">
                                    <div class="flexCenter gap-4">
                                        <button type="button">
                                            <i class="editBtn fa-solid fa-edit text-lg"></i>
                                        </button>
                                        <form action="{{ route('admin-products.destroy', $product->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this product?');">
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

        // ADD PRODUCT
        function previewProductImages() {
            const productImages = document.querySelector('#productImage').files;
            const productImagesPreview = document.querySelector('#productImagesPreview');
            productImagesPreview.innerHTML = ''; // Bersihkan preview sebelumnya

            for (const image of productImages) {
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image);

                oFReader.onload = function(oFREvent) {
                    const imgElement = document.createElement('img');
                    imgElement.src = oFREvent.target.result;
                    imgElement.classList.add('img-fluid');
                    imgElement.classList.add('border');
                    imgElement.classList.add('border-gray-200');
                    imgElement.style.maxWidth = '100%';
                    productImagesPreview.appendChild(imgElement);
                };
            }
        }

        // function previewDetailImages() {
        //     const detailImages = document.querySelector('#detailImage').files;
        //     const detailImagePreview = document.querySelector('#detailImagePreview');
        //     detailImagePreview.innerHTML = ''; // Bersihkan preview sebelumnya

        //     for (const image of detailImages) {
        //         const oFReader = new FileReader();
        //         oFReader.readAsDataURL(image);

        //         oFReader.onload = function(oFREvent) {
        //             const imgElement = document.createElement('img');
        //             imgElement.src = oFREvent.target.result;
        //             imgElement.classList.add('img-fluid');
        //             imgElement.classList.add('border');
        //             imgElement.classList.add('border-gray-200');
        //             imgElement.style.maxWidth = '100%';
        //             detailImagePreview.appendChild(imgElement);
        //         };
        //     }
        // }

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
                    imgElement.classList.add('w-full', 'object-cover', 'aspect-square' , 'border', 'border-gray-200', 'mt-4');
                    // imgElement.style.maxWidth = '100%';
                    previewElement.appendChild(imgElement);
                };
                reader.readAsDataURL(file);
            }
        }

        // EDIT PRODUCT
        function previewProductImagesEdit() {
            const productImages = document.querySelector('#productImageEdit').files;
            const productImagesPreview = document.querySelector('#productImagesPreviewEdit');
            productImagesPreview.innerHTML = ''; // Bersihkan preview sebelumnya

            for (const image of productImages) {
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image);

                oFReader.onload = function(oFREvent) {
                    const imgElement = document.createElement('img');
                    imgElement.src = oFREvent.target.result;
                    imgElement.classList.add('img-fluid');
                    imgElement.classList.add('border');
                    imgElement.classList.add('border-gray-200');
                    imgElement.style.maxWidth = '100%';
                    productImagesPreview.appendChild(imgElement);
                };
            }
        }

        // function previewDetailImagesEdit() {
        //     const detailImages = document.querySelector('#detailImageEdit').files;
        //     const detailImagePreview = document.querySelector('#detailImagePreviewEdit');
        //     detailImagePreview.innerHTML = ''; // Bersihkan preview sebelumnya

        //     for (const image of detailImages) {
        //         const oFReader = new FileReader();
        //         oFReader.readAsDataURL(image);

        //         oFReader.onload = function(oFREvent) {
        //             const imgElement = document.createElement('img');
        //             imgElement.src = oFREvent.target.result;
        //             imgElement.classList.add('img-fluid');
        //             imgElement.classList.add('border');
        //             imgElement.classList.add('border-gray-200');
        //             imgElement.style.maxWidth = '100%';
        //             detailImagePreview.appendChild(imgElement);
        //         };
        //     }
        // }


        // function previewProductImage() {
        //     const productImage = document.querySelector('#productImage');
        //     const productImagePreview = document.querySelector(".productImagePreview");
        //     console.log(productImagePreview);
        //     productImagePreview.style.display = 'bflock';

        //     const oFReader = new FileReader();
        //     oFReader.readAsDataURL(productImage.files[0]);

        //     oFReader.onload = function(oFREvent) {
        //         productImagePreview.src = oFREvent.target.result;
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

        const addProductBtn = document.querySelector('#addProductBtn');
        addProductBtn.setAttribute('disabled', true);

        function addProductValidation() {
            const name = document.querySelector('#name');
            const category = document.querySelector('#category');
            const linkShopee = document.querySelector('#linkShopee');
            const linkTokopedia = document.querySelector('#linkTokopedia');
            const productImage = document.querySelector('#productImage');
            const issue = document.querySelector('#issue');
            const details = document.querySelector('#details');
            if (name.value && category.value && productImage.value && issue.value && details.value) {
                addProductBtn.removeAttribute('disabled');
            } else {
                addProductBtn.setAttribute('disabled', true);
            }
        }

        // function disableButton() {
        //     addProductBtn.setAttribute('disabled', true);
        // }

        // CHECK INPUT FILL CATEGORY
        const saveAddCategoryBtn = document.querySelector('#saveAddCategoryBtn');
        saveAddCategoryBtn.setAttribute('disabled', true);

        function checkCategoryFilled() {
            const categoryName = document.querySelector('#categoryName');
            if (categoryName.value) {
                saveAddCategoryBtn.removeAttribute('disabled');
            } else {
                saveAddCategoryBtn.setAttribute('disabled', true);
            }
        }

        function disableSaveAddCategoryBtn() {
            saveAddCategoryBtn.setAttribute('disabled', true);
        }
    </script>
    @vite('resources/js/admin-products.js')
</body>

</html>
