@extends('layout.layout')
@php
    $title='Statistik Gemba';
    $subTitle = 'Gemba - Statistik';
@endphp

@section('content')

    {{-- Stat Highlights  --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 3xl:grid-cols-5 gap-6">
        
        {{-- Card  --}}
        
        <div class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-cyan-600/10 to-bg-white">
            <div class="card-body p-5">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="font-medium text-neutral-900 dark:text-white mb-1">Isu Aktif</p>
                        <h6 class="mb-0 dark:text-white">20,000</h6>
                    </div>
                    <div class="w-[50px] h-[50px] bg-cyan-600 rounded-full flex justify-center items-center">
                        <iconify-icon icon="pajamas:issue-type-incident" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="font-medium text-sm text-neutral-600 dark:text-white mt-3 mb-0 flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 text-success-600 dark:text-success-400"><iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +4000</span>
                    Last 30 days operations
                </p>
            </div>
        </div>

        {{-- Card  --}}

        <div class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-purple-600/10 to-bg-white">
            <div class="card-body p-5">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="font-medium text-neutral-900 dark:text-white mb-1">Isu Terselesaikan</p>
                        <h6 class="mb-0 dark:text-white">15,000</h6>
                    </div>
                    <div class="w-[50px] h-[50px] bg-purple-600 rounded-full flex justify-center items-center">
                        <iconify-icon icon="pajamas:task-done" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="font-medium text-sm text-neutral-600 dark:text-white mt-3 mb-0 flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 text-danger-600 dark:text-danger-400"><iconify-icon icon="bxs:down-arrow" class="text-xs"></iconify-icon> -800</span>
                    Last 30 days operations
                </p>
            </div>
        </div>

        {{-- Card  --}}

        <div class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-blue-600/10 to-bg-white">
            <div class="card-body p-5">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="font-medium text-neutral-900 dark:text-white mb-1">Aksi Terlambat</p>
                        <h6 class="mb-0 dark:text-white">5,000</h6>
                    </div>
                    <div class="w-[50px] h-[50px] bg-warning-600 rounded-full flex justify-center items-center">
                        <iconify-icon icon="pajamas:pause" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="font-medium text-sm text-neutral-600 dark:text-white mt-3 mb-0 flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 text-success-600 dark:text-success-400"><iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +200</span>
                    Last 30 days operations
                </p>
            </div>
        </div>

        {{-- card  --}}

        <div class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-success-600/10 to-bg-white">
            <div class="card-body p-5">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="font-medium text-neutral-900 dark:text-white mb-1">Total Apresiasi</p>
                        <h6 class="mb-0 dark:text-white">$42,000</h6>
                    </div>
                    <div class="w-[50px] h-[50px] bg-success-600 rounded-full flex justify-center items-center">
                        <iconify-icon icon="gg:awards" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="font-medium text-sm text-neutral-600 dark:text-white mt-3 mb-0 flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 text-success-600 dark:text-success-400"><iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> 100</span>
                    Last 30 days operations
                </p>
            </div>
        </div>
    </div>

    {{-- Top Info Issue  --}}
    <div class="grid grid-cols-1 2xl:grid-cols-12 gap-6 py-8">

        @livewire('Card.Analytic.Stat.Area')
        
        @livewire('Card.Analytic.Stat.CauseType')

        @livewire('Card.Analytic.Donut.Action')
    </div>

    {{-- Overdue Actions Table  --}}
    <div class="card h-full p-0 rounded-xl border-0 overflow-hidden">
        <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
            <div class="flex items-center flex-wrap gap-3">
                <span class="text-base font-medium text-secondary-light mb-0">Aksi Terlambat</span>
            </div>
        </div>
        <div class="card-body p-6">
            <table id="overdue-action-table" class="border border-neutral-200 dark:border-neutral-600 rounded-lg border-separate	">
                <thead>
                    <tr>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Tipe Aksi
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Deskripsi
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Area
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Batas Waktu
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                PIC
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($overdue_actions as $action)
                        <tr>
                            <td>
                                {{ $action->type }}
                            </td>
                            <td>
                                {{ $action->description }}
                            </td>
                            <td>
                                {{ $action->issue->line }}
                            </td>
                            <td>
                                {{ $action->due_date }}
                            </td>
                            <td class="text-center">
                                <span class="bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-8 py-1.5 rounded-full font-medium text-sm">
                                {{ $action->pic->name }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('user-script')
<script src="{{ asset('assets/js/data-table/analytic-overdue-action.js') }}"></script>

<script>
    $(".delete-btn").on("click", function() {
        $(this).closest(".user-grid-card").addClass("hidden")
    });

    // ================================ Action Overview Donut chart Start ================================ 
    
    // ================================ Users Overview Donut chart End ================================ 
</script>
@endsection