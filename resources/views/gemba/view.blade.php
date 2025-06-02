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


            <div class="col-auto">
                <p class="font-semibold mb-0 dark:text-white text-xl">Genba Session - Team Alpha Meeting</p>
                <p class="text-center ">15 Mei 2025 - 10:00 WIB</p>
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
                    <span class="text-xl font-medium text-secondary-light mb-0">Daftar Isu </span>
                    <form class="navbar-search">
                        <input type="text" class="bg-white dark:bg-neutral-700 h-10 w-auto" name="search" placeholder="Cari isu">
                        <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                    </form>
                </div>

                <button  class="btn btn-primary text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2" data-modal-target="default-modal" data-modal-toggle="default-modal">
                    <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                    Tambahkan Isu Baru
                </button>

                <div class="w-full py-6">
                    <div class="flex items-center justify-between">
                        <p>80% Isu Terselesaikan</p>
                        <p>3/5 Selesai</p>
                    </div>
                    <div class="w-full bg-primary-600/10 rounded-full h-2">
                        <div class="bg-primary-600 h-2 rounded-full dark:bg-primary-600" style="width: 90%"></div>
                    </div>
                </div>
            </div>
            <div class="card-body p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 3xl:grid-cols-4 gap-6">
                    {{-- Tempalate Finish  --}}
                    <div class="user-grid-card">
                        <div class="relative border border-neutral-200 dark:border-neutral-600 rounded-2xl overflow-hidden p-4">
                            

                            <div class="flex items-center gap-2">

                                {{-- Aspect  --}}
                                <span class="bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-6 py-1.5 rounded-full font-medium text-xs">Machine</span>
                                {{-- Status  --}}
                                <span class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-xs">Terselesaikan</span>
                            </div>
                            
                            {{-- Issue Name  --}}
                            <h6 class="text-lg mb-2 mt-2">
                                Kendala di mesin sealing
                            </h6>
                            
                            {{-- Supporting File  --}}
                            <img src="{{ asset('assets/images/card-component/card-img1.png') }}" alt="" class="w-full object-fit-cover">
                            <div class="pe-6 pb-4 ps-6 text-center mt--50">
                                
                                <div class="flex items-center justify-between gap-2">
                                        
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tempalate Onprogress  --}}
                    <div class="user-grid-card">
                        <div class="relative border border-neutral-200 dark:border-neutral-600 rounded-2xl overflow-hidden p-4">
                            

                            <div class="flex items-center gap-2">

                                {{-- Aspect  --}}
                                <span class="bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-6 py-1.5 rounded-full font-medium text-xs">Machine</span>
                                {{-- Status  --}}
                                <span class="bg-warning-100 dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 px-6 py-1.5 rounded-full font-medium text-xs">Dalam Process</span>
                            </div>
                            
                            {{-- Issue Name  --}}
                            <h6 class="text-lg mb-2 mt-2">
                                Kendala di lining machine
                            </h6>
                            
                            {{-- Supporting File  --}}
                            <img src="{{ asset('assets/images/card-component/card-img1.png') }}" alt="" class="w-full object-fit-cover">
                            <div class="pe-6 pb-4 ps-6 text-center mt--50">
                                
                                <div class="flex items-center justify-between gap-2">
                                        
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tempalate Onprogress  --}}
                    <div class="user-grid-card">
                        <div class="relative border border-neutral-200 dark:border-neutral-600 rounded-2xl overflow-hidden p-4">
                            

                            <div class="flex items-center gap-2">

                                {{-- Aspect  --}}
                                <span class="bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-6 py-1.5 rounded-full font-medium text-xs">Machine</span>
                                {{-- Status  --}}
                                <span class="bg-warning-100 dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 px-6 py-1.5 rounded-full font-medium text-xs">Dalam Process</span>
                            </div>
                            
                            {{-- Issue Name  --}}
                            <h6 class="text-lg mb-2 mt-2">
                                Kendala di lining machine
                            </h6>
                            
                            {{-- Supporting File  --}}
                            <img src="{{ asset('assets/images/card-component/card-img1.png') }}" alt="" class="w-full object-fit-cover">
                            <div class="pe-6 pb-4 ps-6 text-center mt--50">
                                
                                <div class="flex items-center justify-between gap-2">
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        {{-- Issue Card : End  --}}

        {{-- Attendance Card : Start  --}}
        <div class="card h-full p-0 rounded-xl border-0 overflow-hidden w-full">
            <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
                <div class="flex items-center flex-wrap gap-3">
                    <span class="text-xl font-medium text-secondary-light mb-0">Presensi </span>
                </div>

                <div class="flex items-center flex-wrap gap-3">
                    <button  class="btn btn-secondary border border-neutral text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2" data-modal-target="default-modal" data-modal-toggle="default-modal">
                        <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                        Tambahkan Peserta
                    </button>
    
                    <button  class="btn btn-primary text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2" data-modal-target="default-modal" data-modal-toggle="default-modal">
                        <iconify-icon icon="bx:qr" class="icon text-xl line-height-1"></iconify-icon>
                        Tampilkan Kode QR 
                    </button>
                </div>

            </div>
            <div class="card-body p-6">
                <div class="table-responsive">
                    <table class="table striped-table mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="!bg-white dark:!bg-neutral-700 border-b border-neutral-200 dark:border-neutral-600">Nama</th>
                                <th scope="col" class="!bg-white dark:!bg-neutral-700 border-b border-neutral-200 dark:border-neutral-600">Role</th>
                                <th scope="col" class="!bg-white dark:!bg-neutral-700 border-b border-neutral-200 dark:border-neutral-600">Status</th>
                                <th scope="col" class="!bg-white dark:!bg-neutral-700 border-b border-neutral-200 dark:border-neutral-600">Waktu Hadir</th>
                                <th scope="col" class="!bg-white dark:!bg-neutral-700 border-b border-neutral-200 dark:border-neutral-600 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Template Present  --}}
                            <tr class="odd:bg-neutral-100 dark:odd:bg-neutral-600">
                                <td>
                                    Clay
                                </td>
                                <td>Team Leader</td>
                                <td>
                                    <span class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-sm">Hadir</span>
                                </td>
                                <td>10:00</td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" class="w-8 h-8 bg-danger-50 dark:bg-danger-600/10 text-danger-600 dark:text-danger-400 rounded-full inline-flex items-center justify-center">
                                        <iconify-icon icon="solar:trash-bin-trash-bold"></iconify-icon>
                                    </a>
                                </td>
                            </tr>

                            {{-- Template Absent  --}}
                            <tr class="odd:bg-neutral-100 dark:odd:bg-neutral-600">
                                <td>
                                    Clay
                                </td>
                                <td>Operator</td>
                                <td>
                                    <span class="bg-danger-100 dark:bg-danger-600/25 text-danger-600 dark:text-danger-400 px-6 py-1.5 rounded-full font-medium text-sm">Absent</span>
                                </td>
                                <td>-</td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" class="w-8 h-8 bg-danger-50 dark:bg-danger-600/10 text-danger-600 dark:text-danger-400 rounded-full inline-flex items-center justify-center">
                                        <iconify-icon icon="solar:trash-bin-trash-bold"></iconify-icon>
                                    </a>
                                </td>
                            </tr>

                            {{-- Template Present  --}}
                            <tr class="odd:bg-neutral-100 dark:odd:bg-neutral-600">
                                <td>
                                    Clay
                                </td>
                                <td>Team Leader</td>
                                <td>
                                    <span class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-sm">Hadir</span>
                                </td>
                                <td>10:00</td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" class="w-8 h-8 bg-danger-50 dark:bg-danger-600/10 text-danger-600 dark:text-danger-400 rounded-full inline-flex items-center justify-center">
                                        <iconify-icon icon="solar:trash-bin-trash-bold"></iconify-icon>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- Attendance Card : End  --}}

        {{-- Issue Card : Start  --}}
        <div class="card h-full p-0 rounded-xl border-0 overflow-hidden w-full my-4">
            <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
                <div class="flex items-center flex-wrap gap-3">
                    <span class="text-xl font-medium text-secondary-light mb-0">Catatan Apresiasi </span>
                </div>

                <button  class="btn btn-primary text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2" data-modal-target="default-modal" data-modal-toggle="default-modal">
                    <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                    Tambahkan Apresiasi Baru
                </button>

            </div>
            <div class="card-body p-6">
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                    <div class="card bg-success-100 border border-gray-200 rounded-xl overflow-hidden flex flex-nowrap sm:flex-row flex-col">
                        
                        <div class="card-body p-4 grow"> 
                            
                            <div class="block mb-1.5">
                                <h5 class="card-title text-lg text-neutral-900 dark:text-neutral-200">Clay</h5>
                                <span>Line 6</span>
                            </div>
                            <p class="card-text text-neutral-600 mb-4">We quickly learn to fear and thus automatically avo id potentially stressful situations of all kinds, including the most common of all</p>

                            <span class="text-xs">Dari: wan cheng</span>
                        </div>
                        <div class="flex shrink-0">
                            <img src="{{ asset('assets/images/card-component/horizontal-card-img1.png') }}" class="h-full w-full object-fit-cover" alt="">
                        </div>
                    </div>

                    <div class="card bg-success-100 border border-gray-200 rounded-xl overflow-hidden flex flex-nowrap sm:flex-row flex-col">
                        
                        <div class="card-body p-4 grow"> 
                            
                            <div class="block mb-1.5">
                                <h5 class="card-title text-lg text-neutral-900 dark:text-neutral-200">Clay</h5>
                                <span>Line 6</span>
                            </div>
                            <p class="card-text text-neutral-600 mb-4">We quickly learn to fear and thus automatically avo id potentially stressful situations of all kinds, including the most common of all</p>

                            <span class="text-xs">Dari: wan cheng</span>
                        </div>
                        <div class="flex shrink-0">
                            <img src="{{ asset('assets/images/card-component/horizontal-card-img1.png') }}" class="h-full w-full object-fit-cover" alt="">
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        {{-- Issue Card : End  --}}
    </section>

    <x-script/>

    <script>
        // ================== Password Show Hide Js Start ==========
        function initializePasswordToggle(toggleSelector) {
            $(toggleSelector).on("click", function() {
                $(this).toggleClass("ri-eye-off-line");
                var input = $($(this).attr("data-toggle"));
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        }
        // Call the function
        initializePasswordToggle(".toggle-password");
        // ========================= Password Show Hide Js End ===========================
</script>

</body>
</html>
