<div 
id="solution-editor" 
class="@if($show == true) flex @endif bg-neutral-600/10 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
style="display: @if($show === true)
                 flex
         @else
                 none
         @endif;"
         >
    <div class="relative p-4 max-h-full" style="width: 80%">
        <div class="relative bg-white rounded-lg shadow dark:bg-dark-2">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white"> Detail Akar Masalah </h3>
                <button type="button" wire:click="doClose()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Tutup Formulir</span>
                </button>
            </div>
            <div class="p-4 md:p-5 grid grid-cols-1 xl:grid-cols-3 gap-4">
                {{-- PIC Card :Start  --}}
                <div class="card rounded-xl overflow-hidden border-0 flex flex-nowrap sm:flex-row flex-col">
                    <div class="flex shrink-0">
                        <div class="w-[64px] h-[64px] inline-flex items-center justify-center bg-primary-600 text-white rounded-xl">
                            <iconify-icon icon="material-symbols:person-outline" class="h5 mb-0"></iconify-icon>
                        </div>
                    </div>
                    <div class="px-4">
                        <h5 class="card-title text-lg text-neutral-900 dark:text-neutral-200 mb-1.5">Oleh</h5>
                        <p class="card-text text-neutral-600"> {{ $cause->creator->name ?? '' }} </p>
                    </div>
                </div>
                {{-- PIC Card :End  --}}

                {{-- Type card :Start  --}}
                <div class="card rounded-xl overflow-hidden border-0 flex flex-nowrap sm:flex-row flex-col">
                    <div class="flex shrink-0">
                        <div class="w-[64px] h-[64px] inline-flex items-center justify-center bg-primary-600 text-white rounded-xl">
                            <iconify-icon icon="tabler:tag" class="h5 mb-0"></iconify-icon>
                        </div>
                    </div>
                    <div class="px-4">
                        <h5 class="card-title text-lg text-neutral-900 dark:text-neutral-200 mb-1.5">Kategori Penyebab</h5>
                        <p class="card-text text-neutral-600"> {{ $cause->category ?? '' }} </p>
                    </div>
                </div>
                {{-- Type card :End  --}}

                {{-- Due Date :Start  --}}
                <div class="card rounded-xl overflow-hidden border-0 flex flex-nowrap sm:flex-row flex-col">
                    <div class="flex shrink-0">
                        <div class="w-[64px] h-[64px] inline-flex items-center justify-center bg-primary-600 text-white rounded-xl">
                            <iconify-icon icon="mdi:clock-outline" class="h5 mb-0"></iconify-icon>
                        </div>
                    </div>
                    <div class="px-4">
                        <h5 class="card-title text-lg text-neutral-900 dark:text-neutral-200 mb-1.5">Waktu Laporan</h5>
                        <p class="card-text text-neutral-600">{{ $cause != null ? Carbon\Carbon::parse($cause->due_date)->translatedFormat('d F Y - H:i') : '' }}</p>
                    </div>
                </div>
                {{-- Due Date :End  --}}

                {{-- Card: Description :Start  --}}
                <div class="card col-span-3 rounded-xl overflow-hidden border-0 flex flex-nowrap sm:flex-row flex-col">
                    <div class="flex shrink-0">
                        <div class="w-[64px] h-[64px] inline-flex items-center justify-center bg-primary-600 text-white rounded-xl">
                            <iconify-icon icon="material-symbols:description-outline" class="h5 mb-0"></iconify-icon>
                        </div>
                    </div>
                    <div class="px-4">
                        <h5 class="card-title text-lg text-neutral-900 dark:text-neutral-200 mb-1.5">Deskripsi Aksi</h5>
                        <p class="card-text text-neutral-600"> {{ $cause->description ?? '' }} </p>
                    </div>
                </div>
                {{-- Card: Description :End  --}}

                {{-- Files Card : Start  --}}
                <div class="card h-full p-0 rounded-xl border-0 overflow-hidden w-full my-4 col-span-4">
                    <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
                        <div class="flex items-center flex-wrap gap-3">
                            <span class="text-xl font-medium text-secondary-light mb-0">Temuan Lapangan </span>
                        </div>

                    </div>
                    <div class="card-body p-6">
                        @if ($cause != null)
                                <div id="cause-files-carousel" class="p-0 dots-style-circle dots-positioned">
                                    @foreach ($cause->files as $file)
                                        @if ($file->type == "PHOTO")
                                            {{-- Tempalate IMG  --}}
                                            <div class="mx-2">
                                                <div class="user-grid-card">
                                                    <div class="relative border border-neutral-200 dark:border-neutral-600 rounded-2xl overflow-hidden p-4">
                                                        {{--  File  --}}
                                                        <img src="{{ $file->image_url }}" alt="" style="width: 100% ;height: 225px; object-fit:cover; cursor: pointer" onclick="showImageModal('{{ $file->image_url }}')">
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            {{-- Tempalate IMG  --}}
                                            <div class="mx-2">
                                                <div class="user-grid-card">
                                                    <div class="relative border border-neutral-200 dark:border-neutral-600 rounded-2xl overflow-hidden p-4" onclick="showVideoModal('{{ $file->image_url }}')">
                                                        {{--  File  --}}
                                                        <video
                                                        muted
                                                        autoplay
                                                        loop
                                                        playsinline
                                                        style="width: 100% ;height: 225px; object-fit:cover; cursor:pointer;"
                                                        >
                                                            <source src="{{ $file->image_url }}" type="video/mp4">
                                                        </video>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                    </div>
                </div>
                {{-- Files Card : End  --}}
            </div>
            <div class="flex items-center gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="button" wire:click="doClose()" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-base px-[50px] py-[11px] rounded-lg">
                    Kembali
                </button>
            </div>
        </div>
    </div>
</div>

@push('lv-scripts')
    <script>
        window.addEventListener('initCauseFilesCarousel', () => {
        // Wait for the modal DOM to be visible/rendered
        setTimeout(() => {
            const $carousel = $("#cause-files-carousel");

            if ($carousel.hasClass('slick-initialized')) {
                $carousel.slick('unslick');
            }

            $carousel.slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 4, 
                dots: true,
                speed: 600,
            });
        }, 150); // small delay ensures modal is visible in DOM
    });
    </script>
@endpush