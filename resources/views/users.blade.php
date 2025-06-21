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
            <button onclick="Livewire.dispatch('showModalFormUser', { id: ''})" class="btn btn-primary text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2">
                <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                Tambahkan Pengguna Baru
            </button>
        </div>
        <div class="card-body p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 3xl:grid-cols-4 gap-6">
                @foreach ($users as $user)
                    @if ($user->id != Auth::user()->id)
                        <div class="user-grid-card">
                            <div class="relative border border-neutral-200 dark:border-neutral-600 rounded-2xl overflow-hidden">
                                <img src="{{ $user->coverPhoto ? asset('storage/' . $user->coverPhoto->path) : asset('assets/images/user-grid/user-grid-bg1.png') }}" alt="" style="width: 360px ;height: 120px; object-fit:cover">
                                <div class="pe-6 pb-4 ps-6 text-center mt--50">
                                    <img src="{{ $user->profilePhoto ? asset('storage/' . $user->profilePhoto->path) : asset('assets/images/user-grid/user-grid-img1.png') }}" alt="" class="border br-white border-width-2-px w-[100px] h-[100px] ms-auto me-auto -mt-[50px] rounded-full object-fit-cover">
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
                                        <button href="#" class="bg-primary-50 hover:bg-primary-600 dark:hover:bg-primary-600 hover:text-white dark:hover:text-white dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 bg-hover-primary-600 hover-text-white p-2.5 text-sm btn-sm px-4 py-3 rounded-lg flex items-center justify-center mt-4 font-medium gap-2">
                                            <iconify-icon icon="solar:eye-linear" class="icon text-xl line-height-1"></iconify-icon>
                                            Lihat 
                                        </button> 
                                        <button onclick="Livewire.dispatch('showModalFormUser', { id: '{{ $user->id }}'})" class="bg-warning-50 hover:bg-warning-600 dark:hover:bg-warning-600 hover:text-white dark:hover:text-white dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 bg-hover-warning-600 hover-text-white p-2.5 text-sm btn-sm px-4 py-3 rounded-lg flex items-center justify-center mt-4 font-medium gap-2">
                                            <iconify-icon icon="solar:ruler-cross-pen-outline" class="icon text-xl line-height-1"></iconify-icon>
                                            Ubah 
                                        </button> 
                                        <a href="{{ route('users.delete', [$user->id]) }}" data-confirm-delete="true" class="bg-danger-50 hover:bg-danger-600 dark:hover:bg-danger-600 hover:text-white dark:hover:text-white dark:bg-danger-600/25 text-danger-600 dark:text-danger-400 bg-hover-danger-600 hover-text-white p-2.5 text-sm btn-sm px-4 py-3 rounded-lg flex items-center justify-center mt-4 font-medium gap-2">
                                            <iconify-icon icon="solar:trash-bin-trash-linear" class="icon text-xl line-height-1"></iconify-icon>
                                            Hapus
                                        </a>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
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

    @livewire('Modal.Form.User')

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