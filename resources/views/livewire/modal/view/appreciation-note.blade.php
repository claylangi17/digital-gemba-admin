<!-- Main modal -->
<div 
class="@if($show == true) flex @endif bg-neutral-600/10 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
style="display: @if($show === true)
                 flex
         @else
                 none
         @endif;"
         >
    <div class="relative p-4 w-full  max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-dark-2">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white"> Detail Catatan Apresiasi </h3>
                <button wire:click="doClose()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Tutup Formulir</span>
                </button>
            </div>
            <div class="p-4 md:p-5 space-y-4">
                @if ($note != null)
                <img src="{{ $note->files ? asset('storage/' . $note->files) : asset('assets/images/user-grid/user-grid-bg1.png') }}" alt="" style="width: 100% ;height: 250px; object-fit:cover">
                @endif
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-3">
                        <label for="name" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Penerima Apresiasi</label>
                        <p>
                            {{ $note->receivers_name ?? '' }}
                        </p>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Diberikan Oleh</label>
                        <p>
                            {{ $note->by ?? '' }}
                        </p>
                    </div>
                    <div class="mb-3 col-span-2">
                        <label for="email" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Catatan Apresiasi</label>
                        <p>
                            {{ $note->description ?? '' }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button wire:click="doClose()" type="button" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-base px-[50px] py-[11px] rounded-lg">
                    Kembali
                </button>
            </div>
        </div>
    </div>
</div>