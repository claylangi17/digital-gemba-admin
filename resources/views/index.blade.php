@extends('layout.layout')

@php
    $title='Beranda';
    $subTitle = 'Beranda';
    $script= '<script src="' . asset('assets/js/homeOneChart.js') . '"></script>';
@endphp

@section('content')

    <div class="flex items-center justify-between gap-4 mb-8">
        <div class="w-1/2">
            <p class="text-[40px]">👋</p>
            <h4 class="mb-5">Selamat Datang di Genba Digital</h4>
            <h6 class="text-xl mb-2">Lacak dan kelola semua sesi GEMBA dengan efisien.</h6>
            <p class="mb-0 text-secondary-light max-w-[634px] text-base">
                GEMBA Walk adalah praktik manajemen yang mengutamakan pengamatan langsung di lapangan. Dengan GEMBA Digital, Anda dapat mendigitalisasi proses ini untuk pemantauan yang lebih efektif dan pengambilan keputusan yang lebih baik.
            </p>
        </div>
        <div class="w-1/ overflow-hidden rounded-xl" style="aspect-ratio: 16/9">
            <img src="{{ asset('assets/images/home-hero.png') }}" alt="" class="block mx-auto">
        </div>
    </div>

    @livewire("Card.Home.Stat.Highlight")

    {{-- Genba Card : Start  --}}
    <div class="card h-full p-0 rounded-xl border-0 overflow-hidden w-full my-4">
        <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
            <div class="flex items-center flex-wrap gap-3">
                <span class="text-xl font-medium text-secondary-light mb-0">Daftar Sesi Genba </span>
            </div>

        </div>
        <div class="card-body p-6">
            <div class="grid grid-cols-3 p-0 dots-style-circle dots-positioned gap-4">
                <div class="cursor-pointer" data-modal-target="default-modal" data-modal-toggle="default-modal">
                    {{-- Create Card  --}}
                    <div class="user-grid-card" >
                        <div class="py-14 relative flex items-center justify-center border border-dashed border-primary-200 dark:border-primary-600 rounded-2xl overflow-hidden p-4">
                            
                            <div>
                                <div class="flex items-center justify-center">
                                    <button class="btn bg-primary-600 hover:bg-primary-700 text-white rounded-lg px-3.5 py-2 text-sm flex items-center gap-2 justify-center" style="width: fit-content">
                                        <iconify-icon icon="ic:baseline-plus" class="text-xl"></iconify-icon>
                                    </button>
                                </div>
                                <h6 class="text-lg text-center mb-2 mt-2">
                                    Sesi Baru
                                </h6>
                                <p class="text-base text-center mb-2 mt-2">
                                    Buat Sesi Genba Baru
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($sessions->count() > 0)
                    @foreach ($sessions as $session)
                    
                        @if ($session->status == "PROGRESS")
                            <div class="genba-card">
                                {{-- Tempalate Onprogress  --}}
                                <div class="user-grid-card">
                                    <div class="relative border border-neutral-200 dark:border-neutral-600 rounded-2xl overflow-hidden p-4">
                                        
                                        {{-- Genba Name  --}}
                                        <h6 class="text-lg mb-2 mt-2">
                                            {{ $session->name }}
                                        </h6>
                                        <p class="text-base mb-2 mt-2">
                                            {{ $session->created_at }}
                                        </p>
                                        <p class="bg-warning-100 dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 px-6 py-1.5 rounded-full font-medium text-xs mt-6" style="width: fit-content">Sedang Berjalan</p>

                                        <div class="pt-6 flex items-center gap-2">
                                            <a href="{{ route('genba.view', [$session->id]) }}" class="btn bg-primary-600 hover:bg-primary-700 text-white rounded-lg px-3.5 py-2 text-sm flex items-center gap-2 justify-center" style="width: 100%">
                                                <iconify-icon icon="solar:eye-outline" class="text-xl"></iconify-icon>
                                                Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                        <div class="genba-card">
                            {{-- Tempalate Onprogress  --}}
                            <div class="user-grid-card">
                                <div class="relative border border-neutral-200 dark:border-neutral-600 rounded-2xl overflow-hidden p-4">
                                    
                                    {{-- Genba Name  --}}
                                    <h6 class="text-lg mb-2 mt-2">
                                        {{ $session->name }}
                                    </h6>
                                    <p class="text-base mb-2 mt-2">
                                        {{ $session->created_at }}
                                    </p>

                                    <p class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-xs mt-6" style="width: fit-content">Selesai</p>
                                    
                                    <div class="pt-6 flex items-center gap-2">
                                        <a href="{{ route('genba.view', [$session->id]) }}" class="btn bg-primary-600 hover:bg-primary-700 text-white rounded-lg px-3.5 py-2 text-sm flex items-center gap-2 justify-center" style="width: 100%">
                                            <iconify-icon icon="solar:eye-outline" class="text-xl"></iconify-icon>
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                    @endforeach
                @else
                    <div class="mx-2">
                        {{-- Tempalate None  --}}
                        <div class="user-grid-card">
                            <div class="relative rounded-2xl overflow-hidden p-4">
                                <p class="text-center">Belum Ada Sesi Genba</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="slider-progress">
                <span></span>
            </div>
        </div>
    </div>
    {{-- Genba Card : End  --}}

    <!-- Main modal -->
    <div id="default-modal" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full  max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-dark-2">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white"> Buat Sesi Genba Baru </h3>
                    <button id="btn-close-default-modal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Tutup Formulir</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <form id="user-form" action="{{ route("genba.create") }}" method="POST">
                        @csrf
                        <div class="mb-3">
                                <label for="name" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Nama Sesi</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama sesi genba " id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="start_time" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Batas Waktu Absen</label>
                            <div class=" relative">
                                <input class="form-control rounded-lg bg-white dark:bg-neutral-700" id="start_time" name="start_time" type="text">
                                <span class="absolute end-0 top-1/2 -translate-y-1/2 me-3 line-height-1"><iconify-icon icon="solar:calendar-linear" class="icon text-lg"></iconify-icon></span>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="flex items-center gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button id="btn-cancel-default-modal" type="button" data-modal-hide="default-modal" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-base px-[50px] py-[11px] rounded-lg" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button id="btn-submit-default-modal" type="submit" class="btn btn-primary border border-primary-600 text-base px-7 py-3 rounded-lg" id="saveTaskButton">
                        Buat & Masuk Sesi
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('user-script')
<script src="{{ asset('assets/js/full-calendar.js') }}"></script>
<script src="{{ asset('assets/js/flatpickr.js') }}"></script>
<script src="{{ asset('assets/js/data-table/genba-history.js') }}"></script>

<script>


    // Flat pickr or date picker js 
    function getDatePicker(receiveID) {
        flatpickr(receiveID, {
            enableTime: true,
            dateFormat: "d/m/Y H:i",
        });
    }
    getDatePicker("#start_time");

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