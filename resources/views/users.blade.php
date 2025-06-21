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
                <form class="navbar-search">
                    <input type="text" class="bg-white dark:bg-neutral-700 h-10 w-auto" name="user-search" id="user-search" placeholder="Cari Pengguna">
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
                        <div class="user-grid-card" data-name="{{ $user->name }}" data-email="{{ $user->name }}">
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('user-search');

        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase();
            const userCards = document.querySelectorAll('.user-grid-card');

            userCards.forEach(card => {
                const name = card.getAttribute('data-name').toLowerCase();
                const email = card.getAttribute('data-email').toLowerCase();

                if (name.includes(keyword) || email.includes(keyword)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection