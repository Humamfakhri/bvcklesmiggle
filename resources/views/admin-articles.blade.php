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
    <title>bvcklesmiggle</title>
</head>

<body class="bg-gray-200">
    <!-- Modal -->
    <div id="imageModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 items-center justify-center hidden">
        <div class="relative max-w-[80vh] max-h-[80vh]">
            <img id="modalImage" src="" alt="Full Image" class="img-fluid w-full">
            {{-- <img id="modalImage" src="" alt="Full Image" class="max-w-full max-h-full object-contain"> --}}
            <button onclick="closeModal()"
                class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2 bg-primary w-8 h-8 rounded-full"><i
                    class="fa-solid fa-xmark text-white"></i></button>
        </div>
    </div>
    <div class="cardPopup fixed inset-0 flex -z-10 opacity-100 transition-opacity items-center justify-center">
        {{--  scale-0 --}}
        {{-- <div class="cardPopupContent transition ease-in-out duration-300 bg-white border-2 border-black w-[85%] max-h-[80%] p-3 mt-12" onclick="event.stopPropagation()"> --}}
        <div class="cardPopupContent scale-0 transition ease-in-out duration-300 bg-white border-2 border-black max-w-[60%] max-h-[85%] p-5 overflow-y-auto w-full"
            onclick="event.stopPropagation()">
            <div class="card-popup-header flexBetween border-b-2 border-black sticky top-0 pb-3 bg-white">
                <h1 class="font-bold text-2xl text-black font-segoe">Add Article</h1>
                <button>
                    <i class="closePopup text-3xl text-black fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="card-popup-body pt-5">
                {{-- <form method="post" action="" class="flex flex-col gap-5" enctype="multipart/form-data"> --}}
                {{-- <form method="POST" action="{{ route('admin-article-categories.store') }}" class="flex flex-col gap-5"
                    enctype="multipart/form-data">
                    @csrf
                </form> --}}
                <form method="POST" action="{{ route('admin-articles.store') }}" class="flex-col gap-5"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs mb-1 font-bold" for="title">Title</label>
                            <input required type="text" name="title" id="title"
                                placeholder="Enter article's title"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-500 bg-transparent">
                        </div>
                        <div>
                            <label class="block text-xs mb-1 font-bold" for="category">Category</label>
                            <input required type="text" name="category" id="category"
                                placeholder="Enter article's category"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-500 bg-transparent">
                        </div>
                        <div>
                            <label class="block text-xs mb-1 font-bold" for="articleImage">Article's Image</label>
                            {{-- <input required type="file" name="articleImage[]" id="articleImage" multiple
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-500 bg-transparent @error('image') is-invalid @enderror"
                                onchange="previewArticleImages()"> --}}
                            <input required type="file" name="articleImage[]" id="articleImage" multiple
                                accept=".jpeg,.jpg,.png,.webp"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-500 bg-transparent @error('image') is-invalid @enderror"
                                onchange="previewArticleImages()">

                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="grid grid-cols-2 gap-3" id="articleImagesPreview"></div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs mt-2 mb-1 font-bold" for="body">Body</label>
                        <textarea required type="text" name="body" id="body"
                            placeholder="Enter article's body"
                            rows="10"
                            class="text-xs w-full rounded-lg px-3 py-2 border border-gray-500 bg-transparent"></textarea>
                    </div>
                    <div class="mt-4 flexEnd gap-3">
                        <button type="button" class="w-fit px-4 py-1 text-white font-bold bg-gray-500 rounded">
                            Cancel
                        </button>
                        <button type="submit" class="w-fit px-6 py-1 text-white font-bold bg-primary rounded">
                            Save
                        </button>
                    </div>
                </form>
                {{-- <form method="post" action="" class="flex flex-col gap-5" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs mb-1 font-bold" for="name">Name</label>
                            <input required type="text" name="name" id="name"
                                placeholder="Enter article's name"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-500 bg-transparent">
                        </div>
                        <div>
                            <label class="block text-xs mb-1 font-bold" for="category">Category</label>
                            <input required type="category" name="category" id="category"
                                placeholder="Enter article's category"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-500 bg-transparent">
                        </div>
                        <div>
                            <label class="block text-xs mb-1 font-bold" for="articleImage">Article's Image</label>
                            <input required type="file" name="articleImage" id="articleImage"
                                placeholder="Enter article's image"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-500 bg-transparent @error('image') is-invalid @enderror"
                                onchange="previewArticleImage()">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="grid grid-cols-2 gap-3">
                                <img class="articleImagePreview img-fluid">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs mb-1 font-bold" for="detailImage">Detail's Image</label>
                            <input required type="file" name="detailImage" id="detailImage"
                                placeholder="Enter detail's image"
                                class="text-xs w-full rounded-lg px-3 py-2 border border-gray-500 bg-transparent @error('image') is-invalid @enderror"
                                onchange="previewDetailImage()">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="grid grid-cols-2 gap-3">
                                <img class="detailImagePreview img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 flexEnd gap-3">
                        <button
                            type="button"
                            class="w-fit px-4 py-1 text-white font-bold bg-gray-500 rounded">
                            Cancel
                        </button>
                        <button
                        type="submit"
                            class="w-fit px-6 py-1 text-white font-bold bg-primary rounded">
                            Save
                        </button>
                    </div>
                </form> --}}
            </div>
        </div>
    </div>

    <div class="flex">
        <div class="sidebar h-screen py-6 bg-dark flex flex-col padding-container sticky top-0">
            <img src="/img/logo.png" alt="" class="h-auto max-w-52">
            <ul class="flex flex-col gap-5 mt-5 grow">
                {{-- <li><x-nav-link href="/">HOME</x-nav-link></li> --}}
                <li><x-nav-link href="admin/articles">ARTICLES</x-nav-link></li>
                <li><x-nav-link href="admin/products">PRODUCTS</x-nav-link></li>
                {{-- <li><x-nav-link href="partnership">PARTNERSHIP</x-nav-link></li> --}}
            </ul>
            <div class="flex justify-between items-end border border-gray-500 px-3 py-2 rounded-lg">
                <div>
                    <small class="text-gray-400">You are logged in as:</small>
                    <h3 class="text-light font-bold">Admin</h3>
                </div>
                <button><i class="fa-solid fa-arrow-right-from-bracket color-primary text-2xl rotate-180"></i></button>
            </div>
        </div>
        <div class="content grow padding-container pt-5">
            <h1 class="font-bold text-3xl">Articles</h1>
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            <div class="flex gap-3">
                <button
                    class="w-fit px-2 py-1 my-6 text-white font-bold bg-primary rounded border-2 border-black flexCenter gap-2 card">
                    Add Article
                    <i class="fa-solid fa-plus text-white"></i>
                </button>
                {{-- <button
                    class="w-fit px-2 py-1 my-6 color-primary font-bold rounded border-2 border-primary flexCenter gap-2 card">
                    Add Category
                    <i class="fa-solid fa-plus color-primary"></i>
                </button> --}}
            </div>
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Content</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <td>No.</td>
                            <td>{{ $article->category }}</td>
                            <td>{{ $article->name }}</td>
                            <td>
                                <div class="grid grid-cols-3 gap-3">
                                    @foreach (json_decode($article->article_images) as $image)
                                        {{-- <img src="{{ asset('storage/' . $image) }}" alt="Article Image"
                                            class="img-fluid w-full"> --}}
                                        <div class="relative">
                                            <img src="{{ asset('storage/' . $image) }}" alt="Article Image"
                                                class="w-full cursor-pointer"
                                                onclick="openModal('{{ asset('storage/' . $image) }}')">
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td><img src="{{ asset('storage/' . $article->detail_image) }}" alt="Detail Image"
                                    class="w-full cursor-pointer"
                                    onclick="openModal('{{ asset('storage/' . $article->detail_image) }}')"></td>
                            <td>
                                <div class="flexCenter gap-5">
                                    <form action="{{ route('admin-articles.destroy', $article->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this article?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="button">
                                            <i class="fa-solid fa-edit color-primary text-lg"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin-articles.destroy', $article->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this article?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <i class="fa-solid fa-trash text-red-500 text-lg"></i>
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
                    imgElement.classList.add('rounded-lg');
                    imgElement.style.maxWidth = '100%';
                    articleImagesPreview.appendChild(imgElement);
                };
            }
        }

        function previewDetailImages() {
            const detailImages = document.querySelector('#detailImage').files;
            const detailImagesPreview = document.querySelector('#detailImagesPreview');
            detailImagesPreview.innerHTML = ''; // Bersihkan preview sebelumnya

            for (const image of detailImages) {
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image);

                oFReader.onload = function(oFREvent) {
                    const imgElement = document.createElement('img');
                    imgElement.src = oFREvent.target.result;
                    imgElement.classList.add('img-fluid');
                    imgElement.classList.add('rounded-lg');
                    imgElement.style.maxWidth = '100%';
                    detailImagesPreview.appendChild(imgElement);
                };
            }
        }


        // function previewArticleImage() {
        //     const articleImage = document.querySelector('#articleImage');
        //     const articleImagePreview = document.querySelector(".articleImagePreview");
        //     console.log(articleImagePreview);
        //     articleImagePreview.style.display = 'block';

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
    </script>
    @vite('resources/js/products.js')
</body>

</html>
