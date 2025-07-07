<div 
id="solution-editor" 
class="@if($show == true) flex @endif bg-neutral-600/10 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
style="display: @if($show === true)
                 flex
         @else
                 none
         @endif;"
         >
    <div class="relative p-4 max-h-full" style="width: 70%">
        <div class="relative bg-white rounded-lg shadow dark:bg-dark-2">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white"> Selesaikan Aksi </h3>
                <button type="button" wire:click="doClose()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Tutup Formulir</span>
                </button>
            </div>
            <div class="p-4 md:p-5 grid grid-cols-1 xl:grid-cols-4 gap-4">
                {{-- PIC Card :Start  --}}
                <div class="card rounded-xl overflow-hidden border-0 flex flex-nowrap sm:flex-row flex-col">
                    <div class="flex shrink-0">
                        <div class="w-[64px] h-[64px] inline-flex items-center justify-center bg-primary-600 text-white rounded-xl">
                            <iconify-icon icon="material-symbols:person-outline" class="h5 mb-0"></iconify-icon>
                        </div>
                    </div>
                    <div class="px-4">
                        <h5 class="card-title text-lg text-neutral-900 dark:text-neutral-200 mb-1.5">PIC</h5>
                        <p class="card-text text-neutral-600"> {{ $action->pic->name ?? '' }} </p>
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
                        <h5 class="card-title text-lg text-neutral-900 dark:text-neutral-200 mb-1.5">Tipe Aksi</h5>
                        <p class="card-text text-neutral-600"> {{ $action->type ?? '' }} </p>
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
                        <h5 class="card-title text-lg text-neutral-900 dark:text-neutral-200 mb-1.5">Tenggat Waktu</h5>
                        <p class="card-text text-neutral-600">{{ $action != null ? Carbon\Carbon::parse($action->due_date)->translatedFormat('d F Y - H:i') : '' }}</p>
                    </div>
                </div>
                {{-- Due Date :End  --}}

                {{-- Status Card :Start  --}}
                <div class="card rounded-xl overflow-hidden border-0 flex flex-nowrap sm:flex-row flex-col">
                    <div class="flex shrink-0">
                        <div class="w-[64px] h-[64px] inline-flex items-center justify-center bg-primary-600 text-white rounded-xl">
                            <iconify-icon icon="grommet-icons:status-info" class="h5 mb-0"></iconify-icon>
                        </div>
                    </div>
                    <div class="px-4">
                        <h5 class="card-title text-lg text-neutral-900 dark:text-neutral-200 mb-1.5">Status</h5>
                        @if ($action)
                            @if ($action->status == "PROGRESS")
                                <p class="bg-warning-100 dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 px-6 py-1.5 rounded-full font-medium text-xs mb-2">Dalam Proses</p>
                            @else
                                <p class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-xs mb-2">Terselesaikan</p>
                            @endif
                        @endif
                    </div>
                </div>
                {{-- Status Card :End  --}}

                {{-- Card: Description :Start  --}}
                <div class="card col-span-4 rounded-xl overflow-hidden border-0 flex flex-nowrap sm:flex-row flex-col">
                    <div class="flex shrink-0">
                        <div class="w-[64px] h-[64px] inline-flex items-center justify-center bg-primary-600 text-white rounded-xl">
                            <iconify-icon icon="material-symbols:description-outline" class="h5 mb-0"></iconify-icon>
                        </div>
                    </div>
                    <div class="px-4">
                        <h5 class="card-title text-lg text-neutral-900 dark:text-neutral-200 mb-1.5">Deskripsi Aksi</h5>
                        <p class="card-text text-neutral-600"> {{ $action->description ?? '' }} </p>
                    </div>
                </div>
                {{-- Card: Description :End  --}}
            </div>
            <div class="p-4 md:p-5 space-y-4">
                <form id="action-completion-form" action="{{ route('action.complete') }}" enctype="multipart/form-data" method="POST" class="grid grid-cols-2 gap-2">
                    @csrf
                    
                    <input type="text" value="{{ $action->id ?? '' }}" name="action_id" id="action_id" hidden>

                    <div class="mb-3 col-span-2">
                        <label for="description" class="block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Deskripsi Penyelesaian</label>
                        <textarea name="description" id="description" class="form-control" rows="4" cols="50" placeholder="Enter a description..."></textarea>
                    </div>

                    <div class="mb-3 col-span-2">
                        <label for="files" class="form-label">Foto / Video Penyelesaian Aksi</label>
                        <input class="border border-neutral-200 dark:border-neutral-600 w-full rounded-lg" type="file" name="files[]" id="files" multiple accept="image/*,video/*">
                    </div>
                </form>
            </div>
            <div class="flex items-center gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="button" wire:click="doClose()" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-base px-[50px] py-[11px] rounded-lg">
                    Batal
                </button>
                <button id="save-action-completion" type="submit" class="btn btn-primary border border-primary-600 text-base px-7 py-3 rounded-lg">
                    Selesaikan Aksi
                </button>
            </div>
        </div>
    </div>
</div>

@push('lv-scripts')
    <script>
        $('#save-action-completion').on('click', function(e) {
            e.preventDefault();

            $('#action-completion-form').submit();
        });
    </script>
@endpush