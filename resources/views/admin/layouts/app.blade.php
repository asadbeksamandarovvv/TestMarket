<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('plugins/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/css/icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <script>
        function fetchSubCategories() {
            var categoryId = document.getElementById("category_id").value;

            if (categoryId == "") {
                document.getElementById("subCategoryDiv").style.display = "none"; // Subkategoriya qismni yashirish
                return;
            }

            // Ota kategoriya tanlanganida subkategoriya ko'rsatiladi
            fetch('/categories/subcategories/' + categoryId)
                .then(response => response.json())
                .then(data => {
                    var subCategorySelect = document.getElementById("sub_category_id");
                    subCategorySelect.innerHTML = '<option value="">Select subcategory...</option>'; // Tozalash

                    if (data.length > 0) {
                        // Agar subkategoriya bor bo'lsa, ularni qo'shish
                        data.forEach(subCategory => {
                            var option = document.createElement("option");
                            option.value = subCategory.id;
                            option.text = subCategory.name;
                            subCategorySelect.appendChild(option);
                        });

                        document.getElementById("subCategoryDiv").style.display = "block"; // Subkategoriya ro'yxatini ko'rsatish
                    } else {
                        document.getElementById("subCategoryDiv").style.display = "none"; // Subkategoriya mavjud emas, yashirish
                    }
                })
                .catch(error => {
                    console.error('Error fetching subcategories:', error);
                });
        }

    </script>
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
    @yield('content')

</div>
<script src="{{ asset('plugins/js/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
