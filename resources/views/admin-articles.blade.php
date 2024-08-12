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
    <title>bvcklesmiggle</title>
</head>

<body class="bg-gray-200">
  <div class="cardPopup fixed inset-0 flex opacity-100 -z-10 transition-opacity items-center justify-center">
    {{-- <div class="cardPopupContent transition ease-in-out duration-300 bg-white border-2 border-black w-[85%] max-h-[80%] p-3 mt-12" onclick="event.stopPropagation()"> --}}
    <div class="cardPopupContent transition ease-in-out duration-300 scale-0 bg-white border-2 border-black max-w-[85%] max-h-[85%] px-3 overflow-y-auto"
        onclick="event.stopPropagation()">
        <div class="card-popup-header text-end border-b-2 border-black sticky top-0 pt-3 bg-white">
            <button>
                <i class="closePopup text-3xl text-black fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
</div>

    <div class="flex">
        <div class="sidebar h-screen py-6 bg-dark flex flex-col padding-container">
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
            <button class="w-fit px-2 py-1 my-6 text-white font-bold bg-primary rounded border-2 border-black flexCenter gap-2 card">
              Add Article
              <i class="fa-solid fa-plus text-white"></i>
            </button>
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Column 2</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Row 1 Data 1</td>
                        <td>Row 1 Data 2</td>
                    </tr>
                    <tr>
                        <td>Row 2 Data 1</td>
                        <td>Row 2 Data 2</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "columnDefs": [{
                        "width": "10%",
                        "targets": 0
                    }, // Mengatur lebar kolom pertama
                    {
                        "width": "90%",
                        "targets": 1
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
    </script>
    @vite('resources/js/products.js')
</body>

</html>