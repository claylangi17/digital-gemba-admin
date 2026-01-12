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
                    <a href="{{ route('genba.history') }}"> <iconify-icon icon="iconoir:arrow-left" class="icon"></iconify-icon> </a>
    
                </div>
            </div>
            {{-- Back Button - End  --}}


            <div class="col-auto">
                <div class="flex items-center gap-2">
                    <p class="font-semibold mb-0 dark:text-white text-xl text-center">{{ $genba->name }}</p>

                    @if ($genba->status == "PROGRESS")
                        <span class="bg-warning-100 dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 rounded-full text-xs p-2 py-1.5 font-semibold">Dalam Proses</span>
                    @else
                        <span class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 rounded-full text-xs p-2 py-1.5 font-semibold">Terselesaikan</span>
                    @endif
                </div>
                <p class="text-center ">{{ $genba->created_at->translatedFormat('d F Y - H:i') }} WIB</p>
            </div>
            
            @livewire('Switch.ThemeMode')
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

                @if ($genba->status == "PROGRESS")
                    <button onclick="Livewire.dispatch('showModalFormIssue', { session_id: '{{ $genba->id }}' })" class="btn btn-primary text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2">
                        <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                        Tambahkan Isu Baru
                    </button>
                @endif

                @if ($issues->count() > 0)
                <div class="w-full py-6">
                    <div class="flex items-center justify-between mb-1.5">
                        <p>{{ ceil(($issues->where('status', 'CLOSED')->count() / $issues->count()) * 100) }}% Isu Terselesaikan</p>

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
                <div id="issue-carousel" class="flex gap-4 overflow-x-auto pb-4">
                    @if ($issues->count() > 0)
                        @foreach ($issues as $issue)

                            @php
                                $assignedNames = $users->whereIn('id', explode(',', $issue->assigned_ids))->pluck('name');
                                $displayedAssigned = $assignedNames->take(3);
                                $remainingAssigned = max($assignedNames->count() - $displayedAssigned->count(), 0);
                                $assignedTooltip = $assignedNames->implode(', ');
                            @endphp

                            @if ($issue->status == "OPEN")
                                <div class="issue-card shrink-0 w-[320px]" data-description="{{ strtolower($issue->description) }}">
                                    {{-- Tempalate Onprogress  --}}
                                    <div class="user-grid-card">
                                        <div class="relative border border-neutral-200 dark:border-neutral-600 rounded-2xl overflow-hidden p-4">
                                            
            
                                            <div class="flex items-center justify-between gap-4">
                                                <div class="flex items-center gap-2">
            
                                                    {{-- Aspect  --}}
                                                    <span class="bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-6 py-1.5 rounded-full font-medium text-xs"> {{ $issue->line?->name ?? '-' }} </span>
                                                    {{-- Status  --}}
                                                    <span class="bg-warning-100 dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 px-6 py-1.5 rounded-full font-medium text-xs">Dalam Proses</span>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <a href="{{ route('issue.view', [$issue->id]) }}" class="btn bg-primary-600 hover:bg-primary-700 text-white w-[48px] h-[48px] flex items-center justify-center gap-2">
                                                        <iconify-icon icon="solar:eye-outline" class="text-lg"></iconify-icon>
                                                    </a>
                                                    <button type="button" class="btn bg-danger-100 hover:bg-danger-200 text-danger-600 w-[48px] h-[48px] flex items-center justify-center gap-2" onclick="deleteIssueConfirmation('{{ $issue->id }}')">
                                                        <iconify-icon icon="solar:trash-bin-minimalistic-broken" class="text-lg"></iconify-icon>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            {{-- Issue Name  --}}
                                            <h6 class="text-lg mb-2 mt-2">
                                                {{ $issue->description }}
                                            </h6>
                                            
                                            {{-- Supporting File  --}}
                                            @if ($issue->files->first())
                                                @if ($issue->files->first()->type == "PHOTO")
                                                    <img src="{{ $issue->files->first()->image_url }}" alt="" style="width: 100% ;height: 225px; object-fit:cover; cursor: pointer" onclick="showImageModal('{{ $issue->files->first()->image_url }}')">
                                                @else
                                                    <video
                                                        muted
                                                        autoplay
                                                        loop
                                                        playsinline
                                                        style="width: 100% ;height: 225px; object-fit:cover; cursor:pointer;"
                                                        onclick="showVideoModal('{{ $issue->files->first()->image_url }}')"
                                                    >
                                                        <source src="{{ $issue->files->first()->image_url }}" type="video/mp4">
                                                    </video>
                                                @endif
                                            @else
                                                <img src="https://placehold.co/300x225?text=tambahkan%20file%20terkait%20isu%20ini" alt="" style="width: 100% ;height: 225px; object-fit:cover">
                                            @endif
                                            
                                            <div class="text-xs py-2">
                                                <span class="font-semibold block">Ditugaskan:</span>
                                                <div class="flex flex-wrap gap-1" title="{{ $assignedTooltip }}">
                                                    @foreach ($displayedAssigned as $name)
                                                        <span class="bg-neutral-100 dark:bg-neutral-700 px-2 py-0.5 rounded-full border border-neutral-200 dark:border-neutral-600">
                                                            {{ \Illuminate\Support\Str::limit($name, 12) }}
                                                        </span>
                                                    @endforeach
                                                    @if ($remainingAssigned > 0)
                                                        <span class="bg-neutral-100 dark:bg-neutral-700 px-2 py-0.5 rounded-full border border-neutral-200 dark:border-neutral-600">
                                                            +{{ $remainingAssigned }} lainnya
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form id="delete-issue-form-{{ $issue->id }}" action="{{ route('issue.delete', $issue->id) }}" method="post" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="session_id" value="{{ $genba->id }}">
                                    </form>
                                </div>
                            @else
                                <div class="issue-card shrink-0 w-[320px]" data-description="{{ strtolower($issue->description) }}">
                                    {{-- Tempalate Finish  --}}
                                    <div class="user-grid-card">
                                        <div class="relative border border-neutral-200 dark:border-neutral-600 rounded-2xl overflow-hidden p-4">
                                            

                                            <div class="flex items-center justify-between gap-4">
                                                <div class="flex items-center gap-3">
            
                                                    {{-- Aspect  --}}
                                                    <span class="bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-6 py-1.5 rounded-full font-medium text-xs"> {{ $issue->line?->name ?? '-' }} </span>
                                                    {{-- Status  --}}
                                                    <span class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-xs">Terselesaikan</span>
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    <a href="{{ route('issue.view', [$issue->id]) }}" class="btn bg-primary-600 hover:bg-primary-700 text-white w-[48px] h-[48px] flex items-center justify-center gap-2">
                                                        <iconify-icon icon="solar:eye-outline" class="text-lg"></iconify-icon>
                                                    </a>
                                                    <button type="button" class="btn bg-danger-100 hover:bg-danger-200 text-danger-600 w-[48px] h-[48px] flex items-center justify-center gap-2" onclick="deleteIssueConfirmation('{{ $issue->id }}')">
                                                        <iconify-icon icon="solar:trash-bin-minimalistic-broken" class="text-lg"></iconify-icon>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            {{-- Issue Name  --}}
                                            <h6 class="text-lg mb-2 mt-2">
                                                {{ $issue->description }}
                                            </h6>
                                            
                                            {{-- Supporting File  --}}
                                            @if ($issue->files->first())
                                                @if ($issue->files->first()->type == "PHOTO")
                                                    <img src="{{ $issue->files->first()->image_url }}" alt="" style="width: 100% ;height: 225px; object-fit:cover; cursor: pointer" onclick="showImageModal('{{ $issue->files->first()->image_url }}')">
                                                @else
                                                    <video
                                                        muted
                                                        autoplay
                                                        loop
                                                        playsinline
                                                        style="width: 100% ;height: 225px; object-fit:cover; cursor:pointer;"
                                                        onclick="showVideoModal('{{ $issue->files->first()->image_url }}')"
                                                    >
                                                        <source src="{{ $issue->files->first()->image_url }}" type="video/mp4">
                                                    </video>
                                                @endif
                                            @else
                                                <img src="https://placehold.co/300x225?text=tambahkan%20file%20terkait%20isu%20ini" alt="" style="width: 100% ;height: 225px; object-fit:cover">
                                            @endif
                                            <div class="text-xs py-2">
                                                <span class="font-semibold block">Ditugaskan:</span>
                                                <div class="flex flex-wrap gap-1" title="{{ $assignedTooltip }}">
                                                    @foreach ($displayedAssigned as $name)
                                                        <span class="bg-neutral-100 dark:bg-neutral-700 px-2 py-0.5 rounded-full border border-neutral-200 dark:border-neutral-600">
                                                            {{ \Illuminate\Support\Str::limit($name, 12) }}
                                                        </span>
                                                    @endforeach
                                                    @if ($remainingAssigned > 0)
                                                        <span class="bg-neutral-100 dark:bg-neutral-700 px-2 py-0.5 rounded-full border border-neutral-200 dark:border-neutral-600">
                                                            +{{ $remainingAssigned }} lainnya
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form id="delete-issue-form-{{ $issue->id }}" action="{{ route('issue.delete', $issue->id) }}" method="post" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="session_id" value="{{ $genba->id }}">
                                    </form>
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
            </div>
        </div>
        {{-- Issue Card : End  --}}

        @livewire("Card.Table.Genba.Attendance", [$genba])

        {{-- Appreciation Card : Start  --}}
        <div class="card h-full p-0 rounded-xl border-0 overflow-hidden w-full my-4">
            <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
                <div class="flex items-center flex-wrap gap-3">
                    <span class="text-xl font-medium text-secondary-light mb-0">Catatan Apresiasi </span>
                </div>

                @if ($genba->status == "PROGRESS")
                    <button class="btn btn-primary text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2" data-modal-target="appreciation-modal" data-modal-toggle="appreciation-modal">
                        <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                        Tambahkan Apresiasi Baru
                    </button>
                @endif

            </div>
            <div class="card-body p-6">
                @if ($appreciations->count() > 0)
                        <div class="p-0 dots-style-circle dots-positioned cursor-pointer" id="progress-carousel">
                            @foreach ($appreciations as $appreciation)
                                <div onclick="Livewire.dispatch('showModalViewAppreciationNote', { id: '{{ $appreciation->id }}' })">
                                    <div class="card bg-success-100 border border-gray-200 rounded-xl overflow-hidden flex flex-nowrap sm:flex-row flex-col mx-2">
                                    
                                        <div class="card-body p-4 grow"> 
                                            
                                            <div class="block mb-1.5">
                                                <h5 class="card-title text-lg text-neutral-900 dark:text-neutral-200">{{ $appreciation->receivers_name }} </h5>
                                                <span>{{ $appreciation->line }}</span>
                                            </div>
                                            <p class="card-text text-neutral-600 mb-4">{{ $appreciation->description }}</p>
                
                                            <span class="text-xs">Dari: {{ $appreciation->byUser->name ?? '' }}</span>

                                        </div>
                                        <div class="flex shrink-0">
                                            @if($appreciation->files && $appreciation->file_type == 'PHOTO')
                                                <img src="{{ $appreciation->image_url }}" style="width: 170px ; height: 166px; object-fit:cover" alt="">
                                            @elseif($appreciation->files && $appreciation->file_type == 'VIDEO')
                                                <video style="width: 170px ; height: 166px; object-fit:cover" muted autoplay loop playsinline>
                                                    <source src="{{ $appreciation->image_url }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @else
                                                <img src="https://placehold.co/200x200?text=Tidak%20ada%20media%20apresiasi" style="width: 170px ; height: 166px; object-fit:cover" alt="">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="slider-progress">
                            <span></span>
                        </div>
                    @else
                        <div class="flex items-center justify-center">
                            Belum Ada Catatan Apresiasi
                        </div>
                    @endif
            </div>
        </div>
        {{-- Appreciation Card : End  --}}

        {{-- Finishing Card : Start  --}}
        <div class="card h-full p-0 rounded-xl border-0 overflow-hidden w-full">
            <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
                <div class="flex items-center flex-wrap gap-3">
                    <span class="text-xl font-medium text-secondary-light mb-0">Finalisasi Genba</span>
                </div>

                <div class="flex items-center flex-wrap gap-3">
                    <button onclick="Livewire.dispatch('showModalAIReport', { session_id: '{{ $genba->id }}' })" class="btn btn-secondary border border-neutral text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2">
                        <iconify-icon icon="tabler:file-download" class="icon text-xl line-height-1"></iconify-icon>
                        Cetak Laporan Gemba
                    </button>
    
                    @if ($genba->status != "FINISH")
                        <button id="close-genba-btn" class="btn bg-success-600 text-white hover:bg-success-700 text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2">
                            <iconify-icon icon="ic:round-done-all" class="icon text-xl line-height-1"></iconify-icon>
                            Tutup Sesi
                        </button>

                        <form id="close-genba-form" action="{{ route('genba.close') }}" method="post" hidden>
                            @csrf
                            <input type="text" name="id" id="id" value="{{ $genba->id }}">
                        </form>
                    @endif
                </div>

            </div>
        </div>
        {{-- Finishing Card : End  --}}
    </section>

    {{-- Issue Modal  --}}
    @livewire("Modal.Form.Issue")


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
                            <div id="line"></div>
                        </div>
                        <div class="mb-3 w-full">
                            <div class="mb-3">
                                <label for="receiver_id" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">ID Penerima</label>
                                <input type="text" class="form-control" placeholder="Masukkan ID penerima apresiasi " id="receiver_id" name="receiver_id" required>
                            </div>
                            <div class="mb-3">
                                <label for="receiver_name" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Nama Penerima</label>
                                <input type="text" class="form-control" placeholder="Masukkan nama penerima apresiasi " id="receiver_name" name="receiver_name" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi Apresiasi</label>
                            <textarea name="description" class="form-control" rows="4" cols="50" placeholder="Masukan Deskripsi..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="photos" class="form-label">Foto/Video Pendukung Apresiasi</label>
                            <input class="border border-neutral-200 dark:border-neutral-600 w-full rounded-lg" type="file" name="photos" id="photos" accept="image/*,video/*">
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
    <div id="attendance-modal" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full" role="dialog" aria-labelledby="attendance-modal-title">
        <div class="relative p-4 w-full  max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-dark-2">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 id="attendance-modal-title" class="text-xl font-semibold text-gray-900 dark:text-white"> Tambahkan Peserta </h3>
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
                            <div id="user_ids"></div>
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
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            {!! QrCode::size(225)->generate('SESSION_'. $genba->created_at->translatedFormat('Y_m_d') . "_T" . $genba->id ) !!}
                        </div>
                    </div>
                    <p class="mb-0 text-sm text-secondary-light text-center">ID Sesi: {{ $genba->id }} </p>

                    <p class="mb-2 font-semibold">Petunjuk Penggunaan</p>


                    <ul class="rounded-lg overflow-hidden">
                        <li class="text-white p-2 bg-primary-600 border-b border-primary-200 dark:border-primary-600">1. Buka aplikasi mobile attendance di smartphone Anda</li>
                        <li class="text-primary-600 p-2 bg-white dark:bg-primary-700 border-b border-primary-200 dark:border-primary-600">2. Pilih menu 'Scan QR' pada aplikasi </li>
                        <li class="text-white p-2 bg-primary-600 border-b border-primary-200 dark:border-primary-600">3. Arahkan kamera ke QR code yang ditampilkan </li>
                        <li class="text-primary-600 p-2 bg-white dark:bg-primary-700 border-b border-primary-200 dark:border-primary-600">4. Tunggu hingga muncul konfirmasi kehadiran</li>
                        <li class="text-white p-2 bg-primary-600">5. Ulangi langkah 1-4 sebelum mengakhiri sesi genba </li>
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

    @livewire('Modal.View.AppreciationNote')
    @livewire('Modal.View.Report')

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
        // Use DOMContentLoaded to ensure DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing components...');
            
            // Initialize close genba button
            const closeGenbaBtn = document.getElementById('close-genba-btn');
            const closeGenbaForm = document.getElementById('close-genba-form');
            
            console.log('Close button found:', closeGenbaBtn);
            console.log('Close form found:', closeGenbaForm);
            
            if (closeGenbaBtn && closeGenbaForm) {
                closeGenbaBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Close button clicked');
                    
                    // Check if SweetAlert2 is available
                    if (typeof Swal !== 'undefined') {
                        console.log('Using SweetAlert2');
                        Swal.fire({
                            title: 'Apakah Anda Yakin?',
                            text: "Genba ini akan dinyatakan telah 'Selesai' dilaksanakan",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya, konfirmasi!',
                            confirmButtonColor: '#2563eb',
                            cancelButtonColor: '#d33',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                console.log('User confirmed, submitting form...');
                                closeGenbaForm.submit();
                            } else {
                                console.log('User cancelled');
                            }
                        });
                    } else {
                        console.log('SweetAlert2 not available, using native confirm');
                        if (confirm("Genba ini akan dinyatakan telah 'Selesai' dilaksanakan. Lanjutkan?")) {
                            console.log('User confirmed, submitting form...');
                            closeGenbaForm.submit();
                        } else {
                            console.log('User cancelled');
                        }
                    }
                });
                
                console.log('Event listener attached successfully');
            } else {
                console.error('Close button or form not found!');
                if (!closeGenbaBtn) console.error('close-genba-btn element not found');
                if (!closeGenbaForm) console.error('close-genba-form element not found');
            }

            // Initialize VirtualSelect components
            console.log('Initializing VirtualSelect components...');
            
            // Check if VirtualSelect is available
            if (typeof VirtualSelect === 'undefined') {
                console.error('VirtualSelect is not loaded');
                return;
            }

            // Initialize line selector
            if (document.getElementById('line')) {
                VirtualSelect.init({ 
                    ele: '#line',
                    name: 'line',
                    maxWidth: '100%',
                    search: true,
                    noOptionsText: "Tidak ada pilihan",
                    noSearchResultsText: "Pilihan tidak ditemukan",
                    searchPlaceholderText: "Cari....",
                    placeholder: "Pilih Line",
                    options : [
                         @foreach ($lines as $line)
                         { label: {!! json_encode($line->name) !!}, value: {!! json_encode($line->name) !!} },
                         @endforeach
                     ]
                });
            }

            // Initialize receivers selector
            if (document.getElementById('receivers')) {
                VirtualSelect.init({ 
                    ele: '#receivers',
                    name: 'receivers',
                    maxWidth: '100%',
                    multiple: true,
                    search: true,
                    noOptionsText: "Tidak ada karyawan",
                    noSearchResultsText: "Karyawan tidak ditemukan",
                    searchPlaceholderText: "Cari....",
                    placeholder: "Pilih Karyawan",
                    options: [
                         @foreach ( $users as $user )
                             @if (Auth::user()->id != $user->id)
                             { label: {!! json_encode($user->name) !!}, value: {!! json_encode($user->id . '#' . $user->name) !!} },
                             @endif
                         @endforeach
                     ],
                });
            }

            // Initialize user_ids selector
            console.log('Initializing VirtualSelect for user_ids...');
            if (document.getElementById('user_ids')) {
                console.log('Element user_ids found, initializing VirtualSelect...');
                VirtualSelect.init({ 
                    ele: '#user_ids',
                    name: 'user_ids',
                    maxWidth: '100%',
                    multiple: true,
                    search: true,
                    noOptionsText: "Tidak ada karyawan",
                    noSearchResultsText: "Karyawan tidak ditemukan",
                    searchPlaceholderText: "Cari....",
                    placeholder: "Pilih Karyawan",
                    options: [
                         @foreach ( $users as $user )
                         { label: {!! json_encode($user->name) !!}, value: {!! json_encode($user->id) !!} },
                         @endforeach
                     ],
                });
                console.log('VirtualSelect for user_ids initialized');
            } else {
                console.log('Element user_ids not found');
            }

            // Initialize save button event listeners
            console.log('Initializing save button event listeners...');
            
            // Save appreciation button
            $('#save-appreciation').on('click', function(e) {
                e.preventDefault();
                $('#appreciation-note-form').submit();
            });

            // Save attendance button
            $('#save-attendance').on('click', function(e) {
                e.preventDefault();
                
                console.log('Save attendance clicked');
                
                // Get selected user IDs from VirtualSelect
                const userIds = document.querySelector('#user_ids').value;
                console.log('Selected user IDs:', userIds);
                
                if (!userIds || userIds.length === 0) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Peringatan!',
                            text: 'Silakan pilih minimal satu peserta',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        alert('Silakan pilih minimal satu peserta');
                    }
                    return;
                }
                
                // Create hidden input for user_ids if it doesn't exist
                let userIdsInput = document.querySelector('#attendance-form input[name="user_ids"]');
                if (!userIdsInput) {
                    userIdsInput = document.createElement('input');
                    userIdsInput.type = 'hidden';
                    userIdsInput.name = 'user_ids';
                    document.getElementById('attendance-form').appendChild(userIdsInput);
                }
                
                // Set the value
                userIdsInput.value = userIds;
                console.log('Form will be submitted with user_ids:', userIdsInput.value);

                $('#attendance-form').submit();
            });

            console.log('All components initialized successfully');
        });

        // Debug: Check if users data is available
        console.log('Users data from server:');
        @if(isset($users) && count($users) > 0)
            console.log('Users count: {{ count($users) }}');
            @foreach($users as $user)
                console.log('User: {{ $user->name }} (ID: {{ $user->id }})');
            @endforeach
        @else
            console.log('No users data available');
        @endif

    </script>

    <script>
        window.deleteIssueConfirmation = function(issueId) {
            const submitForm = () => {
                const form = document.getElementById(`delete-issue-form-${issueId}`);
                if (form) {
                    form.submit();
                } else {
                    console.error('Delete form not found for issue', issueId);
                }
            };

            if (window.Swal && typeof window.Swal.fire === 'function') {
                Swal.fire({
                    title: 'Hapus Isu?',
                    text: 'Isu dan semua data terkait akan dihapus permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#2563eb',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        submitForm();
                    }
                });
            } else {
                if (confirm('Hapus isu ini beserta seluruh data terkait?')) {
                    submitForm();
                }
            }
        }

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

        // Function to show image modal
        function showImageModal(path) {
            Swal.fire({
                imageUrl: path,
                imageWidth: 'auto',
                imageHeight: 'auto',
                showCloseButton: true,
                showConfirmButton: false,
                customClass: {
                    image: 'img-fluid'
                }
            });
        }

        // Function to show video modal
        function showVideoModal(path) {
            Swal.fire({
                html: `
                    <video controls style="width: 100%; max-width: 800px; height: auto;">
                        <source src="${path}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                `,
                showCloseButton: true,
                showConfirmButton: false,
                width: 'auto',
                customClass: {
                    popup: 'video-modal'
                }
            });
        }
    </script>

</body>
</html>
