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
                        <input type="text" class="bg-white dark:bg-neutral-700 h-10 w-auto" name="issue-search" id="issue-search" placeholder="Cari isu">
                        <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                    </form>
                </div>

                <button  class="btn btn-primary text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2" data-modal-target="issue-modal" data-modal-toggle="issue-modal">
                    <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                    Tambahkan Isu Baru
                </button>

                @if ($issues->count() > 0)
                <div class="w-full py-6">
                    <div class="flex items-center justify-between mb-1.5">
                        <p>{{ ($issues->where('status', "CLOSED")->count() / $issues->count()) * 100 }}% Isu Terselesaikan</p>
                        <p>
                            {{ $issues->where('status', "CLOSED")->count() }} 
                            / 
                            {{ $issues->count() }} 
                            Selesai
                        </p>
                    </div>
                    <div class="w-full bg-primary-600/10 rounded-full h-2">
                        <div class="bg-primary-600 h-2 rounded-full dark:bg-primary-600" style="width:  {{ ($issues->where('status', "CLOSED")->count() / $issues->count()) * 100 }}%"></div>
                    </div>
                </div>
                @endif
            </div>
            <div class="card-body p-6">
                <div id="issue-carousel" class="p-0 dots-style-circle dots-positioned">
                    @if ($issues->count() > 0)
                        @foreach ($issues as $issue)
                        
                            @if ($issue->status == "OPEN")
                                <div class="mx-2 issue-card" data-description="{{ strtolower($issue->description) }}">
                                    {{-- Tempalate Onprogress  --}}
                                    <div class="user-grid-card">
                                        <div class="relative border border-neutral-200 dark:border-neutral-600 rounded-2xl overflow-hidden p-4">
                                            
            
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-2">
            
                                                    {{-- Aspect  --}}
                                                    <span class="bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-6 py-1.5 rounded-full font-medium text-xs"> {{ $issue->line }} </span>
                                                    {{-- Status  --}}
                                                    <span class="bg-warning-100 dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 px-6 py-1.5 rounded-full font-medium text-xs">Dalam Proses</span>
                                                </div>

                                                <a href="{{ route('issue.view', [$issue->id]) }}" class="btn bg-primary-600 hover:bg-primary-700 text-white w-[60px] h-[50px] flex items-center justify-center gap-2">
                                                    <iconify-icon icon="solar:eye-outline" class="text-xl"></iconify-icon>
                                                </a>
                                            </div>
                                            
                                            {{-- Issue Name  --}}
                                            <h6 class="text-lg mb-2 mt-2">
                                                {{ $issue->description }}
                                            </h6>
                                            
                                            {{-- Supporting File  --}}
                                            <img src="{{ asset('storage/' . $issue->files->where('type', 'PHOTO')->first()->path) }}" alt="" style="width: 100% ;height: 225px; object-fit:cover">
                                            
                                            <span class="text-xs py-2">
                                                <span class="font-semibold">Ditugaskan: </span>

                                                {{ $users->whereIn('id', explode(',', $issue->assigned_ids))->pluck('name')->implode(', ') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="mx-2 issue-card" data-description="{{ strtolower($issue->description) }}">
                                    {{-- Tempalate Finish  --}}
                                    <div class="user-grid-card">
                                        <div class="relative border border-neutral-200 dark:border-neutral-600 rounded-2xl overflow-hidden p-4">
                                            

                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-2">
            
                                                    {{-- Aspect  --}}
                                                    <span class="bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-6 py-1.5 rounded-full font-medium text-xs"> {{ $issue->line }} </span>
                                                    {{-- Status  --}}
                                                    <span class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-xs">Terselesaikan</span>
                                                </div>

                                                <a href="{{ route('issue.view', [$issue->id]) }}" class="btn bg-primary-600 hover:bg-primary-700 text-white w-[60px] h-[50px] flex items-center justify-center gap-2">
                                                    <iconify-icon icon="solar:eye-outline" class="text-xl"></iconify-icon>
                                                </a>
                                            </div>
                                            
                                            {{-- Issue Name  --}}
                                            <h6 class="text-lg mb-2 mt-2">
                                                {{ $issue->description }}
                                            </h6>
                                            
                                            {{-- Supporting File  --}}
                                            <img src="{{ asset('storage/' . $issue->files->first()->path) }}" alt="" style="width: 100% ;height: 225px; object-fit:cover">
                                            <span class="text-xs py-2">
                                                <span class="font-semibold">Ditugaskan: </span>

                                                {{ $users->whereIn('id', explode(',', $issue->assigned_ids))->pluck('name')->implode(', ') }}
                                            </span>
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
                                    <p class="text-center">Belum Ada Isu Terdata</p>
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
        {{-- Issue Card : End  --}}

        {{-- Attendance Card : Start  --}}
        <div class="card h-full p-0 rounded-xl border-0 overflow-hidden w-full">
            <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
                <div class="flex items-center flex-wrap gap-3">
                    <span class="text-xl font-medium text-secondary-light mb-0">Presensi </span>
                </div>

                <div class="flex items-center flex-wrap gap-3">
                    <button  class="btn btn-secondary border border-neutral text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2" data-modal-target="attendance-modal" data-modal-toggle="attendance-modal">
                        <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                        Tambahkan Peserta
                    </button>
    
                    <button  class="btn btn-primary text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2" data-modal-target="qr-modal" data-modal-toggle="qr-modal">
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
                                <th scope="col" class="!bg-white dark:!bg-neutral-700 border-b border-neutral-200 dark:border-neutral-600">Waktu Masuk</th>
                                <th scope="col" class="!bg-white dark:!bg-neutral-700 border-b border-neutral-200 dark:border-neutral-600">Waktu Keluar</th>
                                <th scope="col" class="!bg-white dark:!bg-neutral-700 border-b border-neutral-200 dark:border-neutral-600 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($attendances as $attendance)
                                
                                {{-- Present  --}}
                                @if ($attendance->status == "PRESENT")
                                    <tr class="odd:bg-neutral-100 dark:odd:bg-neutral-600">
                                        <td>
                                            {{ $users->where('id', $attendance->user_id)->first()->name }}
                                        </td>
                                        <td class="capitalize">
                                            {{ $users->where('id', $attendance->user_id)->first()->department }}
                                        </td>
                                        <td>
                                            <span class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-sm">Hadir</span>
                                        </td>
                                        <td>
                                            {{ $attendance->time_in ?? '-' }}
                                        </td>
                                        <td>
                                            {{ $attendance->time_out ?? '-' }}
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" class="w-8 h-8 bg-danger-50 dark:bg-danger-600/10 text-danger-600 dark:text-danger-400 rounded-full inline-flex items-center justify-center">
                                                <iconify-icon icon="solar:trash-bin-trash-bold"></iconify-icon>
                                            </a>
                                        </td>
                                    </tr>
                                @endif

                                {{-- Late  --}}
                                @if ($attendance->status == "LATE")
                                    <tr class="odd:bg-neutral-100 dark:odd:bg-neutral-600">
                                        <td>
                                            {{ $users->where('id', $attendance->user_id)->first()->name }}
                                        </td>
                                        <td class="capitalize">
                                            {{ $users->where('id', $attendance->user_id)->first()->department }}
                                        </td>
                                        <td>
                                            <span class="bg-warning-100 dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 px-6 py-1.5 rounded-full font-medium text-sm">Terlambat</span>
                                        </td>
                                        <td>
                                            {{ $attendance->time_in ?? '-' }}
                                        </td>
                                        <td>
                                            {{ $attendance->time_out ?? '-' }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('attendance.delete', [$attendance->id]) }}" data-confirm-delete="true" class="w-8 h-8 bg-danger-50 dark:bg-danger-600/10 text-danger-600 dark:text-danger-400 rounded-full inline-flex items-center justify-center">
                                                <iconify-icon icon="solar:trash-bin-trash-bold"></iconify-icon>
                                            </a>
                                        </td>
                                    </tr>
                                @endif

                                {{-- Absent  --}}
                                @if ($attendance->status == "ABSENT")
                                    <tr class="odd:bg-neutral-100 dark:odd:bg-neutral-600">
                                        <td>
                                            {{ $users->where('id', $attendance->user_id)->first()->name }}
                                        </td>
                                        <td class="capitalize">
                                            {{ $users->where('id', $attendance->user_id)->first()->department }}
                                        </td>
                                        <td>
                                            <span class="bg-danger-100 dark:bg-danger-600/25 text-danger-600 dark:text-danger-400 px-6 py-1.5 rounded-full font-medium text-sm">Absen</span>
                                        </td>
                                        <td>
                                            {{ $attendance->time_in ?? '-' }}
                                        </td>
                                        <td>
                                            {{ $attendance->time_out ?? '-' }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('attendance.delete', [$attendance->id]) }}" data-confirm-delete="true" class="w-8 h-8 bg-danger-50 dark:bg-danger-600/10 text-danger-600 dark:text-danger-400 rounded-full inline-flex items-center justify-center">
                                                <iconify-icon icon="solar:trash-bin-trash-bold"></iconify-icon>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            {{-- Template Present  --}}
                            

                            {{-- Template Absent  --}}
                            

                            {{-- Template Late  --}}
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- Attendance Card : End  --}}

        {{-- Appreciation Card : Start  --}}
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
        {{-- Appreciation Card : End  --}}
    </section>

    {{-- Issue Modal  --}}
    <div id="issue-modal" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full  max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-dark-2">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white"> Buat Isu Baru </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="issue-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Tutup Formulir</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <form id="issue-form" action="{{ route("issue.create") }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="text" value="{{ $genba->id }}" name="session_id" id="session_id" hidden >
                        <div class="mb-3 w-full">
                            <label for="assigned_ids" class="block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Ditugaskan Kepada</label>
                            <select id="assigned_ids" multiple name="assigned_ids" required>
                                @foreach ($users as $user)
                                    @if ($user->id != Auth::user()->id)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="line" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Line</label>
                            <select class="form-control" id="line" name="line" required>
                                @foreach ($lines as $line)
                                    <option value="{{ $line->name }}">{{ $line->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 w-full">
                            <label for="items" class="block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Item Terkait</label>
                            <select id="items" multiple name="items" required>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi Permasalahan</label>
                            <textarea name="description" id="description" class="form-control" rows="4" cols="50" placeholder="Masukan Deskripsi..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="files" class="form-label">Foto / Video Pendukung</label>
                            <input class="border border-neutral-200 dark:border-neutral-600 w-full rounded-lg" type="file" name="files[]" id="files" multiple accept="image/*,video/*">
                        </div>
                    </form>
                </div>
                <div class="flex items-center gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="button" data-modal-hide="issue-modal" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-base px-[50px] py-[11px] rounded-lg" data-bs-dismiss="issue-modal">
                        Batal
                    </button>
                    <button id="save-issue" type="submit" class="btn btn-primary border border-primary-600 text-base px-7 py-3 rounded-lg">
                        Tambahkan Isu
                    </button>
                </div>
            </div>
        </div>
    </div>


    {{-- Appreciations Modal  --}}
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

    {{-- Attendance Modal  --}}
    <div id="attendance-modal" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full  max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-dark-2">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white"> Tambahkan Peserta </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="attendance-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Tutup Formulir</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <form id="attendance-form" action="{{ route("attendance.create") }}" method="POST">
                        @csrf
                        <input type="text" value="{{ $genba->id }}" name="session_id" id="session_id" hidden >
                        <div class="mb-3 w-full">
                            <label for="user_ids" class="block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Peserta</label>
                            <select id="user_ids" multiple name="user_ids" required>
                                @foreach ($users as $user)
                                    @if ($user->id != Auth::user()->id)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="flex items-center gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="button" data-modal-hide="attendance-modal" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-base px-[50px] py-[11px] rounded-lg" data-bs-dismiss="attendance-modal">
                        Batal
                    </button>
                    <button id="save-attendance" type="submit" class="btn btn-primary border border-primary-600 text-base px-7 py-3 rounded-lg">
                        Tambahkan Peserta
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- QR Modal  --}}
    <div id="qr-modal" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full  max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-dark-2">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white"> Kode QR Kehadiran </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="qr-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Tutup Formulir</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <p class="mb-0 text-center"> Scan QR Ini Untuk Mencatat Kehadiran </p>
                    <div class="flex items-center justify-center">
                        {!! QrCode::size(225)->generate('SESSION_'. $genba->created_at->translatedFormat('Y_m_d') . "_T" . $genba->id ) !!}
                    </div>
                    <p class="mb-0 text-sm text-secondary-light text-center">ID Sesi: {{ $genba->id }} </p>

                    <p class="mb-2 font-semibold">Petunjuk Penggunaan</p>


                    <ul class="rounded-lg overflow-hidden">
                        <li class="text-secondary-light p-2 bg-primary-50 dark:bg-primary-600 border-b border-primary-200 dark:border-primary-600">1. Buka aplikasi mobile attendance di smartphone Anda</li>
                        <li class="text-secondary-light p-2 bg-white dark:bg-primary-700 border-b border-primary-200 dark:border-primary-600">2. Pilih menu 'Scan QR' pada aplikasi </li>
                        <li class="text-secondary-light p-2 bg-primary-50 dark:bg-primary-600 border-b border-primary-200 dark:border-primary-600">3. Arahkan kamera ke QR code yang ditampilkan </li>
                        <li class="text-secondary-light p-2 bg-white dark:bg-primary-700 border-b border-primary-200 dark:border-primary-600">4. Tunggu hingga muncul konfirmasi kehadiran</li>
                        <li class="text-secondary-light p-2 bg-primary-50 dark:bg-primary-600">5. Ulangi langkah 1-4 sebelum mengakhiri sesi genba </li>
                    </ul>
                </div>
                <div class="flex items-center gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="button" data-modal-hide="qr-modal" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-base px-[50px] py-[11px] rounded-lg" data-bs-dismiss="qr-modal">
                        Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>

    <x-script/>

    <script src="{{ asset('assets/js/defaultCarousel.js') }}"></script>

    <script>
        const searchInput = document.getElementById('issue-search');
        const cards = document.querySelectorAll('.issue-card');
    
        // Debounce utility function
        function debounce(func, delay = 300) {
            let timeout;
            return (...args) => {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), delay);
            };
        }
    
        function filterIssues(query) {
            let matchCount = 0;
    
            cards.forEach(card => {
                const desc = card.dataset.description;
                if (desc.includes(query)) {
                    card.style.display = 'block';
                    matchCount++;
                } else {
                    card.style.display = 'none';
                }
            });

        }
    
        searchInput.addEventListener('input', debounce(function () {
            const query = $("#issue-search").val().toLowerCase().trim();
            filterIssues(query);
        }, 250));
    </script>
    

    <script>
        VirtualSelect.init({ 
            ele: '#assigned_ids',
            maxWidth: '100%',
            additionalClasses: 'vir-select',
        });

        VirtualSelect.init({ 
            ele: '#items',
            maxWidth: '100%',
            allowNewOption: true,
            additionalClasses: 'vir-select',
        });

        VirtualSelect.init({ 
            ele: '#receivers',
            maxWidth: '100%',
            additionalClasses: 'vir-select',
        });

        VirtualSelect.init({ 
            ele: '#user_ids',
            maxWidth: '100%',
            additionalClasses: 'vir-select',
        });

        $('#save-issue').on('click', function(e) {
            e.preventDefault();

            $('#issue-form').submit();
        });

        $('#save-appreciation').on('click', function(e) {
            e.preventDefault();

            $('#appreciation-note-form').submit();
        });

        $('#save-attendance').on('click', function(e) {
            e.preventDefault();

            $('#attendance-form').submit();
        });

        $("#issue-carousel").slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3, 
            arrows: true, 
            dots: true,
            infinite: true,
            speed: 600,
            prevArrow: '',
            nextArrow: '',
        })

        $("#progress-carousel").slick({
            infinite: true,
            slidesToShow: 2,
            slidesToScroll: 2, 
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
