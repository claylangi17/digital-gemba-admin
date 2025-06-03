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
                <p class="font-semibold mb-0 dark:text-white text-xl text-center">{{ $genba->name }}</p>
                <p class="text-center ">{{ $genba->created_at->translatedFormat('d F Y - H:i') }} WIB</p>
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

                <button class="btn btn-primary text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2" data-modal-target="appreciation-modal" data-modal-toggle="appreciation-modal">
                    <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                    Tambahkan Apresiasi Baru
                </button>

            </div>
            <div class="card-body p-6">
                <div id="progress-carousel" class="p-0 dots-style-circle dots-positioned">
                    @foreach ($appreciations as $appreciation)
                    <div>
                        <div class="card bg-success-100 border border-gray-200 rounded-xl overflow-hidden flex flex-nowrap sm:flex-row flex-col mx-2">
                        
                            <div class="card-body p-4 grow"> 
                                
                                <div class="block mb-1.5">
                                    <h5 class="card-title text-lg text-neutral-900 dark:text-neutral-200">{{ $appreciation->receivers_name }} </h5>
                                    <span>{{ $appreciation->line }}</span>
                                </div>
                                <p class="card-text text-neutral-600 mb-4">{{ $appreciation->description }}</p>
    
                                <span class="text-xs">Dari: {{ $appreciation->by }}</span>
                            </div>
                            <div class="flex shrink-0">
                                <img src="{{ asset('storage/' . $appreciation->files) }}" style="width: 170px ; height: 166px; object-fit:cover" alt="">
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
                <div class="slider-progress">
                    <span></span>
                </div>
            </div>
        </div>
        {{-- Issue Card : End  --}}
    </section>


    {{-- Appreciations Modal  --}}
    <!-- Main modal -->
    <div id="appreciation-modal" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full  max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-dark-2">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white"> Tambahkan Catatan Apresiasi Baru </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="appreciation-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Tutup Formulir</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <form id="appreciation-note-form" action="{{ route("appreciation.note.create") }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="text" value="{{ $genba->id }}" name="session_id" id="session_id" hidden >
                        <div class="mb-3">
                            <label for="line" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Machine / Line</label>
                            <select class="form-control" id="line" name="line" required>
                                @foreach ($lines as $line)
                                    <option value="{{ $line->name }}">{{ $line->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 w-full">
                            <label for="receivers" class="block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Penerima Apresiasi</label>
                            <select id="receivers" multiple name="receivers" required>
                                @foreach ($users as $user)
                                    @if ($user->id != Auth::user()->id)
                                    <option value="{{ $user->id }}#{{ $user->name }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi Apresiasi</label>
                            <textarea name="description" class="form-control" rows="4" cols="50" placeholder="Masukan Deskripsi..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="photos" class="form-label">Foto Pendukung Apresiasi</label>
                            <input class="border border-neutral-200 dark:border-neutral-600 w-full rounded-lg" type="file" name="photos" id="photos">
                        </div>
                    </form>
                </div>
                <div class="flex items-center gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="button" data-modal-hide="appreciation-modal" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-base px-[50px] py-[11px] rounded-lg" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button id="save-appreciation" type="submit" class="btn btn-primary border border-primary-600 text-base px-7 py-3 rounded-lg">
                        Tambahkan Apresiasi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <x-script/>

    <script src="{{ asset('assets/js/defaultCarousel.js') }}"></script>

    <script>
        VirtualSelect.init({ 
            ele: '#receivers',
            maxWidth: '100%',
            additionalClasses: 'vir-select',
        });

        $('#save-appreciation').on('click', function(e) {
            e.preventDefault();

            $('#appreciation-note-form').submit();
        });

        $("#progress-carousel").slick({
            infinite: true,
            slidesToShow: 2,
            slidesToScroll: 1, 
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
