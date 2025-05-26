@extends('layout.layout')
@php
    $title='Manajemen Pengguna';
    $subTitle = 'Pengguna';
    $script = '<script>
                        $(".delete-btn").on("click", function() {
                            $(this).closest(".user-grid-card").addClass("hidden")
                        });
                </script>';
@endphp

@section('content')

    <div class="card h-full p-0 rounded-xl border-0 overflow-hidden">
        <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
            <div class="flex items-center flex-wrap gap-3">
                <span class="text-base font-medium text-secondary-light mb-0">Tampilkan</span>
                <select class="form-select form-select-sm w-auto dark:bg-neutral-600 dark:text-white border-neutral-200 dark:border-neutral-500 rounded-lg">
                    <option>10</option>
                    <option>20</option>
                    <option>30</option>
                    <option>40</option>
                    <option>50</option>
                    <option>60</option>
                    <option>70</option>
                    <option>80</option>
                    <option>90</option>
                    <option>10</option>
                </select>
                <form class="navbar-search">
                    <input type="text" class="bg-white dark:bg-neutral-700 h-10 w-auto" name="search" placeholder="Cari Pengguna">
                    <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                </form>
            </div>
            <button  class="btn btn-primary text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2" data-modal-target="default-modal" data-modal-toggle="default-modal">
                <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                Tambahkan Pengguna Baru
            </button>
        </div>
        <div class="card-body p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 3xl:grid-cols-4 gap-6">
                @foreach ($users as $user)
                    <div class="user-grid-card">
                        <div class="relative border border-neutral-200 dark:border-neutral-600 rounded-2xl overflow-hidden">
                            <img src="{{ asset('assets/images/user-grid/user-grid-bg1.png') }}" alt="" class="w-full object-fit-cover">
                            <div class="pe-6 pb-4 ps-6 text-center mt--50">
                                <img src="{{ asset('assets/images/user-grid/user-grid-img1.png') }}" alt="" class="border br-white border-width-2-px w-[100px] h-[100px] ms-auto me-auto -mt-[50px] rounded-full object-fit-cover">
                                <h6 class="text-lg mb-0 mt-1.5">
                                    {{ $user->name }}
                                </h6>
                                <span class="text-secondary-light mb-4">
                                    {{ $user->email }}
                                </span>

                                <div class="center-border relative bg-gradient-to-r from-danger-500/10 to-danger-50/25 rounded-lg p-3 flex items-center gap-4 before:absolute before:w-px before:h-full before:z-[1] before:bg-neutral-200 dark:before:bg-neutral-500 before:start-1/2">
                                    <div class="text-center w-1/2">
                                        <h6 class="text-base mb-0"> {{ $user->department }} </h6>
                                        <span class="text-secondary-light text-sm mb-0">Department</span>
                                    </div>
                                    <div class="text-center w-1/2">
                                        <h6 class="text-base mb-0"> {{ $user->role }} </h6>
                                        <span class="text-secondary-light text-sm mb-0">Role</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between gap-2">
                                    <a href="#" class="bg-primary-50 hover:bg-primary-600 dark:hover:bg-primary-600 hover:text-white dark:hover:text-white dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 bg-hover-primary-600 hover-text-white p-2.5 text-sm btn-sm px-4 py-3 rounded-lg flex items-center justify-center mt-4 font-medium gap-2">
                                        <iconify-icon icon="solar:eye-linear" class="icon text-xl line-height-1"></iconify-icon>
                                        Lihat 
                                    </a> 
                                    <a href="#" class="bg-warning-50 hover:bg-warning-600 dark:hover:bg-warning-600 hover:text-white dark:hover:text-white dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 bg-hover-warning-600 hover-text-white p-2.5 text-sm btn-sm px-4 py-3 rounded-lg flex items-center justify-center mt-4 font-medium gap-2">
                                        <iconify-icon icon="solar:ruler-cross-pen-outline" class="icon text-xl line-height-1"></iconify-icon>
                                        Ubah 
                                    </a> 
                                    <a href="{{ route('users.delete', [$user->id]) }}" data-confirm-delete="true" class="bg-danger-50 hover:bg-danger-600 dark:hover:bg-danger-600 hover:text-white dark:hover:text-white dark:bg-danger-600/25 text-danger-600 dark:text-danger-400 bg-hover-danger-600 hover-text-white p-2.5 text-sm btn-sm px-4 py-3 rounded-lg flex items-center justify-center mt-4 font-medium gap-2">
                                        <iconify-icon icon="solar:trash-bin-trash-linear" class="icon text-xl line-height-1"></iconify-icon>
                                        Hapus
                                    </a>    
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex items-center justify-between flex-wrap gap-2 mt-6">
                <span>Menampilkan 1 sampai 10 dari 12 pengguna</span>
                <ul class="pagination flex flex-wrap items-center gap-2 justify-center">
                    <li class="page-item">
                        <a class="page-link bg-neutral-300 dark:bg-neutral-600 text-secondary-light font-semibold rounded-lg border-0 flex items-center justify-center h-8 w-8 text-base" href="javascript:void(0)"><iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon></a>
                    </li>
                    <li class="page-item">
                        <a class="page-link text-secondary-light font-semibold rounded-lg border-0 flex items-center justify-center h-8 w-8 text-base bg-primary-600 text-white" href="javascript:void(0)">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link bg-neutral-300 dark:bg-neutral-600 text-secondary-light font-semibold rounded-lg border-0 flex items-center justify-center h-8 w-8" href="javascript:void(0)">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link bg-neutral-300 dark:bg-neutral-600 text-secondary-light font-semibold rounded-lg border-0 flex items-center justify-center h-8 w-8 text-base" href="javascript:void(0)">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link bg-neutral-300 dark:bg-neutral-600 text-secondary-light font-semibold rounded-lg border-0 flex items-center justify-center h-8 w-8 text-base" href="javascript:void(0)">4</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link bg-neutral-300 dark:bg-neutral-600 text-secondary-light font-semibold rounded-lg border-0 flex items-center justify-center h-8 w-8 text-base" href="javascript:void(0)">5</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link bg-neutral-300 dark:bg-neutral-600 text-secondary-light font-semibold rounded-lg border-0 flex items-center justify-center h-8 w-8 text-base" href="javascript:void(0)"> <iconify-icon icon="ep:d-arrow-right" class=""></iconify-icon> </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Main modal -->
    <div id="default-modal" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full  max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-dark-2">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white"> Tambahkan Pengguna Baru </h3>
                    <button id="btn-close-default-modal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Tutup Formulir</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <form id="user-form" action="{{ route("users.create") }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Nama Pengguna</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama pengguna " id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Email</label>
                            <input type="text" class="form-control" placeholder="Masukan alamat email" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="department" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Departemen</label>
                            <select class="form-control" id="department" name="department" required>
                                <option value="manufacture">Manufaktur</option>
                                <option value="qc">Quality Control</option>
                                <option value="management">Manajemen</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="superadmin">Superadmin</option>
                                <option value="admin">Admin</option>
                                <option value="user">Karyawan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Kata Sandi</label>
                            <div class="relative mb-5">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Buat kata sandi default">
                                <span class="toggle-password ri-eye-line cursor-pointer absolute end-0 top-1/2 -translate-y-1/2 me-4 text-secondary-light" data-toggle="#your-password"></span>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="flex items-center gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button id="btn-cancel-default-modal" type="button" data-modal-hide="default-modal" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-base px-[50px] py-[11px] rounded-lg" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button id="btn-submit-default-modal" type="submit" class="btn btn-primary border border-primary-600 text-base px-7 py-3 rounded-lg" id="saveTaskButton">
                        Tambahkan Pengguna
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('user-script')
<script>
    // Open Modal 
    $("#btn-open-default-modal").on("click", function() {
        $("#default-modal").removeClass("hidden").addClass("flex");

        $("#user-form")[0].reset()
    });

    // Close Modal
    $("#btn-close-default-modal").on("click", function() {
        $("#default-modal").removeClass("flex").addClass("hidden");
    });

    $("#btn-cancel-default-modal").on("click", function() {
        $("#default-modal").removeClass("flex").addClass("hidden");
    });

    // Form Process 
    $('#btn-submit-default-modal').on('click', function(e) {
        e.preventDefault();

        $('#user-form').submit();
    });
</script>
@endsection