<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<x-head/>

<body class="dark:bg-neutral-800 bg-neutral-100 dark:text-white">   
    
    @include('sweetalert::alert')
    @livewire('Modal.View.Action')
    @livewire('Modal.View.RootCause')

    @if ($issue->status == "OPEN")
        @livewire("Modal.Form.Issue")
        @livewire('Modal.Form.Action')
        @livewire('Modal.Form.ActionCompletion')
        @livewire('Modal.Form.RootCause')
    @endif

    <div class="navbar-header border-b border-neutral-200 dark:border-neutral-600">
        <div class="flex items-center justify-between">
            {{-- Back Button - Start  --}}
            <div class="col-auto">
                <div class="flex flex-wrap items-center gap-[16px]">
                    <a href="{{ route('genba.view', [$issue->session_id]) }}"> <iconify-icon icon="iconoir:arrow-left" class="icon"></iconify-icon> </a>
    
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
            
            @livewire('Switch.ThemeMode')
        </div>
    </div>

    <section class="dashboard-main-body">
        {{-- Issue Card : Start  --}}
        <div class="card h-full p-0 rounded-xl border-0 overflow-hidden w-full my-4">
            <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
                <div class="flex items-center flex-wrap gap-3">
                    <span class="text-xl font-medium text-secondary-light mb-0">Informasi Isu </span>
                </div>

                @if ($issue->status == "OPEN")

                    <div class="flex items-center justify-end gap-3">
                        <button onclick="Livewire.dispatch('showModalFormIssue', { session_id: '{{ $issue->session->id }}', issue_id: '{{ $issue->id }}' })" class="btn btn-secondary border border-neutral-600 text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2">
                            <iconify-icon icon="tabler:edit" class="icon text-xl line-height-1"></iconify-icon>
                            Edit Detail Isu
                        </button>
    
                        <button onclick="closingConfirmation()" class="btn btn bg-success-600 hover:bg-success-700 text-sm btn-sm text-white px-3 py-3 rounded-lg flex items-center gap-2">
                            <iconify-icon icon="ic:round-done-all" class="icon text-xl line-height-1"></iconify-icon>
                            Tandai "Terselesaikan"
                        </button>
                    </div>

                    <form id="close-issue-form" action="{{ route('issue.close') }}" method="post" hidden>
                        @csrf
                        <input type="text" name="id" id="id" value="{{ $issue->id }}">
                        <input type="text" name="session_id" id="session_id" value="{{ $issue->session_id }}">
                    </form>
                @endif
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
                            <p class="card-text text-neutral-600"> {{ $issue->line->name }} </p>
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

                @if ($issue->status == "OPEN")
                    <button  class="btn btn-primary text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2" data-modal-target="issue-file-modal" data-modal-toggle="issue-file-modal">
                        <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                        Tambahkan File Baru
                    </button>
                @endif
            </div>
            <div class="card-body p-6">
                <div id="files-carousel" class="p-0 dots-style-circle dots-positioned">
                    @foreach ($issue->files as $file)
                        @if ($file->type == "PHOTO")
                            {{-- Tempalate IMG  --}}
                            <div class="mx-2">
                                <div class="user-grid-card">
                                    <div class="relative border border-neutral-200 dark:border-neutral-600 rounded-2xl overflow-hidden p-4">
                                        {{--  File  --}}
                                        <img src="{{ asset('storage/' . $file->path) }}" alt="" style="width: 100% ;height: 225px; object-fit:cover; cursor: pointer" onclick="showImageModal('{{ asset('storage/' . $file->path) }}')">
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- Tempalate IMG  --}}
                            <div class="mx-2">
                                <div class="user-grid-card">
                                    <div class="relative border border-neutral-200 dark:border-neutral-600 rounded-2xl overflow-hidden p-4" onclick="showVideoModal('{{ asset('storage/' . $file->path) }}')">
                                        {{--  File  --}}
                                        <video
                                        muted
                                        autoplay
                                        loop
                                        playsinline
                                        style="width: 100% ;height: 225px; object-fit:cover; cursor:pointer;"
                                        >
                                            <source src="{{ asset('storage/' . $file->path) }}" type="video/mp4">
                                        </video>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        {{-- Files Card : End  --}}

        @livewire('Card.Table.Issue.RootCause', ["issue" => $issue])

        @livewire('Card.Table.Issue.Action', ["issue" => $issue])

    </section>

    @if ($issue->status == "OPEN")
        {{-- Issue Files Modal  --}}
        <div id="issue-file-modal" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full  max-w-2xl max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-dark-2">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white"> Unggah File Terkait Isu </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="issue-file-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Tutup Formulir</span>
                        </button>
                    </div>
                    <div class="p-4 md:p-5 space-y-4">
                        <form id="issue-file-form" action="{{ route("issue.file.create") }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="text" value="{{ $issue->id }}" name="issue_id" id="issue_id" hidden >
                            <div class="mb-3">
                                <label for="files" class="form-label">File Foto / Video</label>
                                <input class="border border-neutral-200 dark:border-neutral-600 w-full rounded-lg" type="file" name="files[]" id="files" multiple accept="image/*,video/*">
                            </div>
                        </form>
                    </div>
                    <div class="flex items-center gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="button" data-modal-hide="issue-file-modal" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-base px-[50px] py-[11px] rounded-lg" data-bs-dismiss="issue-file-modal">
                            Batal
                        </button>
                        <button id="save-issue-file" type="submit" class="btn btn-primary border border-primary-600 text-base px-7 py-3 rounded-lg">
                            Tambahkan FIle
                        </button>
                    </div>
                </div>
            </div>
        </div>

    @endif

    {{-- Image Modal  --}}
    <div id="image-modal" class="hidden overflow-y-auto bg-neutral-600/10 overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full max-h-full">
        <div class="relative p-4 w-full max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-dark-2">
                <div class="p-6">
                    <img id="image-modal-file" style="height: 70vh; object-fit:scale-down; margin: 0 auto">
                </div>
                <div class="flex items-center gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button onclick="hideImageModal()" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-base px-[50px] py-[11px] rounded-lg">
                        Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Video Modal  --}}
    <div id="video-modal" class="hidden overflow-y-auto bg-neutral-600/10 overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full max-h-full">
        <div class="relative p-4 w-full max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-dark-2">
                <div class="p-6">
                    <video
                    style="height: 70vh; margin: 0 auto"
                    id="video-modal-file"
                    controls
                    >
                    </video>
                </div>
                <div class="flex items-center gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button onclick="hideVideoModal()" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-base px-[50px] py-[11px] rounded-lg">
                        Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>

    <x-script/>

    @livewire('Card.AI.Suggest.RootCause')
    @livewire('Card.AI.Suggest.Action')

    <script src="{{ asset('assets/js/defaultCarousel.js') }}"></script>


    <script>
        function closingConfirmation() {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Isu ini akan dinyatakan telah 'Selesai' ditangani",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, konfirmasi!',
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#close-issue-form").submit()
                }
            });
        }
    </script>

    <script>

        function showImageModal(path)
        {
            $("#image-modal").removeClass('hidden').addClass('flex');

            $('#image-modal-file').attr('src', path)
        }

        function hideImageModal(path)
        {
            $("#image-modal").removeClass('flex').addClass('hidden');

            $('#image-modal-file').attr('src', '')
        }

        function showVideoModal(path)
        {
            $("#video-modal").removeClass('hidden').addClass('flex');

            $('#video-modal-file').attr('src', path)
        }

        function hideVideoModal(path)
        {
            $("#video-modal").removeClass('flex').addClass('hidden');

            $('#video-modal-file').attr('src', '')
        }

        $("#files-carousel").slick({
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

        $('#save-issue-file').on('click', function(e) {
            e.preventDefault();

            $('#issue-file-form').submit();
        });
    </script>

</body>
</html>
