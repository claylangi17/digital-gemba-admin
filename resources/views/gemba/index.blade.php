@extends('layout.layout')
@php
    $title='Riwayat Gemba';
    $subTitle = 'Gemba';
    $script = '<script>
                        $(".delete-btn").on("click", function() {
                            $(this).closest(".user-grid-card").addClass("hidden")
                        });
                </script>
                <script src="' . asset('assets/js/data-table.js') . '"></script>
                ';
@endphp

@section('content')

    <div class="card h-full p-0 rounded-xl border-0 overflow-hidden">
        <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
            <div class="flex items-center flex-wrap gap-3">
                <span class="text-base font-medium text-secondary-light mb-0">Riwayat</span>                
            </div>
            <button  class="btn btn-primary text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2" data-modal-target="default-modal" data-modal-toggle="default-modal">
                <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                Buat Sesi Gemba Baru
            </button>
        </div>
        <div class="card-body p-6">
            <table id="genba-history-table" class="border border-neutral-200 dark:border-neutral-600 rounded-lg border-separate	">
                <thead>
                    <tr>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="form-check style-check flex items-center">
                                <input class="form-check-input" id="serial" type="checkbox">
                                <label class="ms-2 form-check-label" for="serial">
                                    ID
                                </label>
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Nama Sesi
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Tanggal Dibuat
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Terakhir Diperbaharui
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Status
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Aksi
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($genbas as $genba)
                        
                    <tr>
                        <td>
                            <div class="form-check style-check flex items-center">
                                <input class="form-check-input" type="checkbox">
                                <label class="ms-2 form-check-label">
                                    {{ $genba->id }}
                                </label>
                            </div>
                        </td>
                        <td>
                            {{ $genba->name }}
                        </td>
                        <td>
                            {{ $genba->created_at->translatedFormat('d F Y') }}
                        </td>
                        <td>
                            {{ $genba->updated_at->translatedFormat('d F Y') }}
                        </td>
                        <td> 
                            @if ($genba->status == "FINISH")
                                <span class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-sm">Selesai</span> 
                            @elseif ($genba->status == "PROGRESS")
                                <span class="bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-6 py-1.5 rounded-full font-medium text-sm">Dalam Proses</span>
                            @else
                                <span class="bg-warning-100 dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 px-6 py-1.5 rounded-full font-medium text-sm">Tertunda</span>
                            @endif
                        </td>
                        <td>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('genba.view', [$genba->id]) }}" class="w-8 h-8 bg-primary-50 dark:bg-primary-600/10 text-primary-600 dark:text-primary-400 rounded-full inline-flex items-center justify-center">
                                    <iconify-icon icon="solar:eye-bold"></iconify-icon>
                                </a>
                                <form action="{{ route('genba.delete', [$genba->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sesi gemba ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 bg-danger-50 dark:bg-danger-600/10 text-danger-600 dark:text-danger-400 rounded-full inline-flex items-center justify-center">
                                        <iconify-icon icon="solar:trash-bin-minimalistic-bold"></iconify-icon>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Main modal -->
    <div id="default-modal" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full  max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-dark-2">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white"> Buat Sesi Gemba Baru </h3>
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