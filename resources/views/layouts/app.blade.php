<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="IOT-10/iot-qr-dashboard/resources/favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .centered-text {
            margin-top: 5px;
            text-align: center;
        }

        .big-size {
            font-size: 18px;
            color: rgb(242, 242, 245);
            transition: color 0.3s;
        }

        .big-size:hover {
            color: rgb(199, 199, 199);
        }

        .container {
            background-color: rgb(37, 99, 235);
            color: white;
            padding: 9px;
            border-radius: 8px;
            width: 200px;
            text-align: center;
        }


    /* emergency button */
    #emergencyButton {
        background-color: rgb(255, 149, 0);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 5px 10px;
        transition: background-color 0.3s, color 0.3s;
        cursor: pointer;
    }


    #l1Button {
        background-color: rgb(52, 71, 219);
        color: white;
        border: none;
        border-radius: 99px;
        padding: 5px 10px;
        transition: background-color 0.3s, color 0.3s;
        cursor: pointer;
    }

    #l2Button {
        background-color: rgb(52, 71, 219);
        color: white;
        border: none;
        border-radius: 99px;
        padding: 5px 10px;
        transition: background-color 0.3s, color 0.3s;
        cursor: pointer;
    }

    #l3Button {
        background-color: rgb(52, 71, 219);
        color: white;
        border: none;
        border-radius: 99px;
        padding: 5px 10px;
        transition: background-color 0.3s, color 0.3s;
        cursor: pointer;
    }

    #l4Button {
        background-color: rgb(52, 71, 219);
        color: white;
        border: none;
        border-radius: 99px;
        padding: 5px 10px;
        transition: background-color 0.3s, color 0.3s;
        cursor: pointer;
    }

    #l5Button {
        background-color: rgb(52, 71, 219);
        color: white;
        border: none;
        border-radius: 99px;
        padding: 5px 10px;
        transition: background-color 0.3s, color 0.3s;
        cursor: pointer;
    }

    #updateButton {
        background-color: rgb(56, 59, 85);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 5px 10px;
        transition: background-color 0.3s, color 0.3s;
        cursor: pointer;
    }

    #updateButton:hover {
        background-color: rgb(40, 30, 27);
    }

    #emergencyButton:hover {
        background-color: rgb(215, 74, 27);
    }

 /* new modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 20%;
        border-radius: 10px;
    }

    .modal-header{
        margin-left: 10px;
        align-content: center;
    }

    .modal-footer {
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-body {
        text-align: center;
        padding: 10px 20px;
    }

    .modal-footer button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-yes {
        margin-left: 30px;
        background-color: #244ccf;
        color: white;
    }

    .btn-no {
        margin-right:30px;
        background-color: #f81a0b;
        color: white;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }


    </style>

</head>

<body>
    <header class="px-4 py-2 shadow">
        <div class="flex justify-between">
            <!-- Blade Template -->

            <div class="container">
                <h2>
                    <span id="currentDateTime" class="big-size"></span>
                </h2>
            </div>

<script>
    setInterval(function() {
        var now = new Date();
        var year = now.getFullYear();
        var month = String(now.getMonth() + 1).padStart(2, '0'); // Adding 1 to month because it starts from 0
        var day = String(now.getDate()).padStart(2, '0');
        var hours = String(now.getHours()).padStart(2, '0');
        var minutes = String(now.getMinutes()).padStart(2, '0');
        var seconds = String(now.getSeconds()).padStart(2, '0');
        var dateTimeString = year + "-" + month + "-" + day + " | " + hours + ":" + minutes + ":" + seconds;
        document.getElementById('currentDateTime').textContent = dateTimeString;
    }, 0); // Update every second


</script>

            <div class="flex items-center">
                <button data-search class="p-4 md:hidden focus:outline-none" type="button">
                    <svg data-search-icon class="fill-current w-4" viewBox="0 0 512 512"
                        style="top: 0.7rem; left: 1rem;">
                        <path
                            d="M225.474 0C101.151 0 0 101.151 0 225.474c0 124.33 101.151 225.474 225.474 225.474 124.33 0 225.474-101.144 225.474-225.474C450.948 101.151 349.804 0 225.474 0zm0 409.323c-101.373 0-183.848-82.475-183.848-183.848S124.101 41.626 225.474 41.626s183.848 82.475 183.848 183.848-82.475 183.849-183.848 183.849z" />
                        <path
                            d="M505.902 476.472L386.574 357.144c-8.131-8.131-21.299-8.131-29.43 0-8.131 8.124-8.131 21.306 0 29.43l119.328 119.328A20.74 20.74 0 00491.187 512a20.754 20.754 0 0014.715-6.098c8.131-8.124 8.131-21.306 0-29.43z" />
                    </svg>
                </button>

            </div>

            <div class="flex items-center">
                <button data-notifications class="p-3 mr-3 focus:outline-none hover:bg-gray-200 hover:rounded-md"
                    typle="button">
                    <svg class="fill-current w-5" viewBox="-21 0 512 512">
                        <path
                            d="M213.344 512c38.636 0 70.957-27.543 78.379-64H134.965c7.426 36.457 39.746 64 78.379 64zm0 0M362.934 255.98c-.086 0-.172.02-.258.02-82.324 0-149.332-66.988-149.332-149.332 0-22.637 5.207-44.035 14.273-63.277-4.695-.446-9.453-.723-14.273-.723-82.473 0-149.332 66.855-149.332 149.332v59.477c0 42.218-18.496 82.07-50.946 109.503C2.25 370.22-2.55 384.937 1.332 399.297c4.523 16.703 21.035 27.371 38.36 27.371H386.89c18.175 0 35.308-11.777 38.996-29.59 2.86-13.781-2.047-27.543-12.735-36.523-31.02-26.004-48.96-64.215-50.218-104.575zm0 0" />
                        <path style="fill: red;"
                            d="M469.344 106.668c0 58.91-47.754 106.664-106.668 106.664-58.91 0-106.664-47.754-106.664-106.664C256.012 47.758 303.766 0 362.676 0c58.914 0 106.668 47.758 106.668 106.668zm0 0" />
                    </svg>
                </button>

                <button data-dropdown
                    class="flex items-center px-3 py-2 focus:outline-none hover:bg-gray-200 hover:rounded-md"
                    type="button" x-data="{ open: false }" @click="open = true"
                    :class="{ 'bg-gray-200 rounded-md': open }">
                    <img src="https://i.ibb.co/Rc3b1z6/myy.png" alt="Profle" class="h-8 w-8 rounded-full">

                    <span class="ml-4 text-sm hidden md:inline-block">Maduranga</span>
                    <svg class="fill-current w-3 ml-4" viewBox="0 0 407.437 407.437">
                        <path
                            d="M386.258 91.567l-182.54 181.945L21.179 91.567 0 112.815 203.718 315.87l203.719-203.055z" />
                    </svg>

                    <div data-dropdown-items
                        class="text-sm text-left absolute top-0 right-0 mt-16 mr-4 bg-white rounded border border-gray-400 shadow"
                        x-show="open" @click.away="open = false">
                        <ul>
                            <li class="px-4 py-3 hover:bg-gray-200"><a href="{{ route('logout') }}">Log out</a></li>
                        </ul>
                    </div>
                </button>

            </div>
        </div>
    </header>

    <div class="flex flex-row">
        <div
            class="flex flex-col w-64 h-screen overflow-y-auto bg-gray-900 border-r rtl:border-r-0 rtl:border-l dark:bg-gray-900 dark:border-gray-700">
            <div class="sidebar text-center bg-gray-900">
                <div class="text-gray-100 text-xl">
                    <div class="p-2.5 mt-1 flex items-center">
                        <i class="bi bi-app-indicator px-2 py-1 rounded-md bg-blue-600"></i>
                        <h1 class="font-bold text-gray-200 text-[15px] ml-3">Admin Panel</h1>
                    </div>
                    <div class="my-2 bg-gray-600 h-[1px]"></div>
                </div>

                <a href="{{ route('admin/home') }}">
                    <div
                        class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-speedometer2"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Dashboard</span>
                    </div>
                </a>

                {{-- <a href="{{ route('admin/reports') }}">
                    <div
                        class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-bar-chart"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Reports</span>
                    </div>
                </a> --}}

                <a href="{{ route('admin/qr') }}">
                    <div
                        class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-plus-circle plus-icon"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Insert QR</span>
                    </div>
                </a>

                <a href="{{ route('admin/profile') }}">
                    <div
                        class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-bookmark-fill"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Profile</span>
                    </div>
                </a>
                <a href="{{ route('logout') }}">
                    <div class="my-4 bg-gray-600 h-[1px]"></div>
                    <div
                        class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Logout</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="flex flex-col w-full h-screen px-4 mt-10">
            <div>@yield('contents')</div>
        </div>
    </div>
</body>

</html>
