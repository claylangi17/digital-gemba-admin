<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<x-head/>

<body class="dark:bg-neutral-800 bg-neutral-100 dark:text-white">

    <div class="navbar-header border-b border-neutral-200 dark:border-neutral-600">
        <div class="flex items-center justify-between">
            {{-- Back Button - Start  --}}
            <div class="col-auto">
                <div class="flex flex-wrap items-center gap-[16px]">
                    <a href="$"> <iconify-icon icon="iconoir:arrow-left" class="icon"></iconify-icon> </a>
    
                </div>
            </div>
            {{-- Back Button - End  --}}


            <div class="col-auto flex gap-4">
                <p class="font-semibold dark:text-white text-xl text-center">Detail Isu</p>
                @if ($issue->status == "OPEN")
                    <p class="bg-warning-100 dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 px-6 py-1.5 rounded-full font-medium text-xs mb-2">Dalam Proses</p>
                @else
                    <p class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-xs mb-2">Terselesaikan</p>
                @endif
            </div>
            
            {{-- Dark Mode Swtich - Start  --}}
            <div class="col-auto">
                <div class="flex flex-wrap items-center gap-3">
                    <button type="button" id="theme-toggle" class="w-10 h-10 bg-neutral-200 dark:bg-neutral-700 dark:text-white rounded-full flex justify-center items-center">
                        <span id="theme-toggle-dark-icon" class="hidden">
                            <i class="ri-sun-line"></i>
                        </span>
                        <span id="theme-toggle-light-icon" class="hidden">
                            <i class="ri-moon-line"></i>
                        </span>
                    </button>
                </div>
            </div>
            {{-- Dark Mode Swtich - End  --}}
        </div>
    </div>

    @include('sweetalert::alert')

    <section class="dashboard-main-body">
        {{-- Issue Card : Start  --}}
        <div class="card h-full p-0 rounded-xl border-0 overflow-hidden w-full my-4">
            <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
                <div class="flex items-center flex-wrap gap-3">
                    <span class="text-xl font-medium text-secondary-light mb-0">Informasi Isu </span>
                </div>
            </div>
            <div class="card-body p-6">
                
                <div class="grid grid-cols-1 xl:grid-cols-4 gap-6">
                    {{-- Card: Line :Start  --}}
                    <div class="card rounded-xl overflow-hidden border-0 flex flex-nowrap sm:flex-row flex-col">
                        <div class="flex shrink-0">
                            <div class="w-[64px] h-[64px] inline-flex items-center justify-center bg-primary-600 text-white rounded-xl">
                                <iconify-icon icon="ion:location-outline" class="h5 mb-0"></iconify-icon>
                            </div>
                        </div>
                        <div class="px-4">
                            <h5 class="card-title text-lg text-neutral-900 dark:text-neutral-200 mb-1.5">Lokasi Permasalahan</h5>
                            <p class="card-text text-neutral-600"> {{ $issue->line }} </p>
                        </div>
                    </div>
                    {{-- Card: Line :End  --}}

                    {{-- Card: Item :Start  --}}
                    <div class="card rounded-xl overflow-hidden border-0 flex flex-nowrap sm:flex-row flex-col">
                        <div class="flex shrink-0">
                            <div class="w-[64px] h-[64px] inline-flex items-center justify-center bg-primary-600 text-white rounded-xl">
                                <iconify-icon icon="fluent-mdl2:product" class="h5 mb-0"></iconify-icon>
                            </div>
                        </div>
                        <div class="px-4">
                            <h5 class="card-title text-lg text-neutral-900 dark:text-neutral-200 mb-1.5">Item Terdampak</h5>
                            <p class="card-text text-neutral-600"> {{ $items }} </p>
                        </div>
                    </div>
                    {{-- Card: Item :End  --}}

                    {{-- Card: Time :Start  --}}
                    <div class="card rounded-xl overflow-hidden border-0 flex flex-nowrap sm:flex-row flex-col">
                        <div class="flex shrink-0">
                            <div class="w-[64px] h-[64px] inline-flex items-center justify-center bg-primary-600 text-white rounded-xl">
                                <iconify-icon icon="mdi:clock-outline" class="h5 mb-0"></iconify-icon>
                            </div>
                        </div>
                        <div class="px-4">
                            <h5 class="card-title text-lg text-neutral-900 dark:text-neutral-200 mb-1.5">Waktu Pelaporan</h5>
                            <p class="card-text text-neutral-600">{{ $issue->created_at->translatedFormat('d F Y - H:i') }}</p>
                        </div>
                    </div>
                    {{-- Card: Time :End  --}}

                    {{-- Card: Assigned :Start  --}}
                    <div class="card rounded-xl overflow-hidden border-0 flex flex-nowrap sm:flex-row flex-col">
                        <div class="flex shrink-0">
                            <div class="w-[64px] h-[64px] inline-flex items-center justify-center bg-primary-600 text-white rounded-xl">
                                <iconify-icon icon="formkit:people" class="h5 mb-0"></iconify-icon>
                            </div>
                        </div>
                        <div class="px-4">
                            <h5 class="card-title text-lg text-neutral-900 dark:text-neutral-200 mb-1.5">Ditugaskan</h5>
                            <p class="card-text text-neutral-600"> {{ $users->whereIn('id', explode(',', $issue->assigned_ids))->pluck('name')->implode(', ') }} </p>
                        </div>
                    </div>
                    {{-- Card: Assigned :End  --}}
                </div>

                <div class="grid grid-cols-1 gap-6 py-6">
                    {{-- Card: Description :Start  --}}
                    <div class="card rounded-xl overflow-hidden border-0 flex flex-nowrap sm:flex-row flex-col">
                        <div class="flex shrink-0">
                            <div class="w-[64px] h-[64px] inline-flex items-center justify-center bg-primary-600 text-white rounded-xl">
                                <iconify-icon icon="material-symbols:description-outline" class="h5 mb-0"></iconify-icon>
                            </div>
                        </div>
                        <div class="px-4">
                            <h5 class="card-title text-lg text-neutral-900 dark:text-neutral-200 mb-1.5">Deskripsi Permasalahan</h5>
                            <p class="card-text text-neutral-600"> {{ $issue->description }} </p>
                        </div>
                    </div>
                    {{-- Card: Description :End  --}}
                </div>
            </div>
        </div>
        {{-- Issue Card : End  --}}

        {{-- Files Card : Start  --}}
        <div class="card h-full p-0 rounded-xl border-0 overflow-hidden w-full my-4">
            <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
                <div class="flex items-center flex-wrap gap-3">
                    <span class="text-xl font-medium text-secondary-light mb-0">Temuan Lapangan </span>
                </div>
            </div>
            <div class="card-body p-6">
                <div id="files-carousel" class="p-0 dots-style-circle dots-positioned">
                </div>
            </div>
        </div>
        {{-- Files Card : End  --}}

        {{-- Root Cause Card : Start  --}}
        <div class="card h-full p-0 rounded-xl border-0 overflow-hidden w-full my-4">
            <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
                <div class="flex items-center flex-wrap gap-3">
                    <span class="text-xl font-medium text-secondary-light mb-0">Akar Masalah </span>
                </div>
            </div>
            <div class="card-body p-6">
                <table id="genba-cause-table" class="border border-neutral-200 dark:border-neutral-600 rounded-lg border-separate	">
                    <thead>
                        <tr>
                            <th scope="col" class="text-neutral-800 dark:text-white">
                                <div class="form-check style-check flex items-center">
                                    <input class="form-check-input" id="serial" type="checkbox">
                                    <label class="ms-2 form-check-label" for="serial">
                                        No.
                                    </label>
                                </div>
                            </th>
                            <th scope="col" class="text-neutral-800 dark:text-white">
                                <div class="flex items-center gap-2">
                                    Oleh
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </div>
                            </th>
                            <th scope="col" class="text-neutral-800 dark:text-white">
                                <div class="flex items-center gap-2">
                                    Kategori Penyebab
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
                                    Action
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($root_causes as $cause)
                            <tr>
                                <td>
                                    <div class="form-check style-check flex items-center">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="ms-2 form-check-label">
                                            {{ $cause->id }}
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <h6 class="text-base mb-0 font-medium grow"> {{ $cause->creator->name }} </h6>
                                </td>
                                <td>
                                    <p> {{ $cause->category }} </p>
                                </td>
                                <td>
                                    <span> {{ $cause->description }} </span>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="w-8 h-8 bg-primary-50 dark:bg-primary-600/10 text-primary-600 dark:text-primary-400 rounded-full inline-flex items-center justify-center">
                                        <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                    </a>
                                    <a href="javascript:void(0)" class="w-8 h-8 bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 rounded-full inline-flex items-center justify-center">
                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                    </a>
                                    <a href="javascript:void(0)" class="w-8 h-8 bg-danger-100 dark:bg-danger-600/25 text-danger-600 dark:text-danger-400 rounded-full inline-flex items-center justify-center">
                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Root Cause Card : End  --}}

        {{-- Solution Card : Start  --}}
        <div class="card h-full p-0 rounded-xl border-0 overflow-hidden w-full my-4">
            <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
                <div class="flex items-center flex-wrap gap-3">
                    <span class="text-xl font-medium text-secondary-light mb-0">Solusi / Aksi </span>
                </div>
            </div>
            <div class="card-body p-6">
                <table id="genba-action-table" class="border border-neutral-200 dark:border-neutral-600 rounded-lg border-separate	">
                    <thead>
                        <tr>
                            <th scope="col" class="text-neutral-800 dark:text-white">
                                <div class="form-check style-check flex items-center">
                                    <input class="form-check-input" id="serial" type="checkbox">
                                    <label class="ms-2 form-check-label" for="serial">
                                        ID.
                                    </label>
                                </div>
                            </th>
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
                                    PIC
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </div>
                            </th>
                            <th scope="col" class="text-neutral-800 dark:text-white">
                                <div class="flex items-center gap-2">
                                    Tenggat Waktu
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
                                    Action
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($actions as $act)
                            <tr>
                                <td>
                                    <div class="form-check style-check flex items-center">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="ms-2 form-check-label">
                                            {{ $act->id }}
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <h6 class="text-xs mb-0 font-semibold"> {{ $act->type }} </h6>
                                </td>
                                <td>
                                    <span> {{ $act->description }} </span>
                                </td>
                                <td>
                                    <span> {{ $act->creator->name }} </span>
                                </td>
                                <td>
                                    <span> {{ $act->due_date }} </span>
                                </td>
                                <td>
                                    @if ($act->status == "PROGRESS")
                                        <p class="bg-warning-100 dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 px-6 py-1.5 rounded-full font-medium text-xs text-center">Dalam Proses</p>
                                    @else
                                        <p class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-xs text-center">Terselesaikan</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="w-8 h-8 bg-primary-50 dark:bg-primary-600/10 text-primary-600 dark:text-primary-400 rounded-full inline-flex items-center justify-center">
                                        <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                    </a>
                                    <a href="javascript:void(0)" class="w-8 h-8 bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 rounded-full inline-flex items-center justify-center">
                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                    </a>
                                    <a href="javascript:void(0)" class="w-8 h-8 bg-danger-100 dark:bg-danger-600/25 text-danger-600 dark:text-danger-400 rounded-full inline-flex items-center justify-center">
                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Solution Card : End  --}}
    </section>

    <x-script/>

    <script src="{{ asset('assets/js/defaultCarousel.js') }}"></script>
    <script src="{{ asset('assets/js/data-table/genba-cause.js') }}"></script>
    <script src="{{ asset('assets/js/data-table/genba-action.js') }}"></script>

    <script>

        $("#issue-carousel").slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4, 
            arrows: true, 
            dots: true,
            infinite: true,
            speed: 600,
            prevArrow: '',
            nextArrow: '',
        })
    </script>

</body>
</html>
