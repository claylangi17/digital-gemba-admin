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
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white"> {{ $mode == "create" ? "Buat Aksi" : "Edit Aksi" }} </h3>
                <button type="button" wire:click="doClose()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Tutup Formulir</span>
                </button>
            </div>
            <div class="p-4 md:p-5 space-y-4">
                <form id="cause-form" action="{{ $mode == "create" ? route("cause.create") : route("cause.update") }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-2">
                    @csrf
                    
                    @if ($mode == "create")
                        <input type="text" value="{{ $issue_id ?? '' }}" name="issue_id" id="issue_id" hidden>
                    @else
                        <input type="text" value="{{ $cause->id ?? '' }}" name="cause_id" id="cause_id" hidden>
                    @endif

                    <div class="mb-3">
                        <label for="files" class="form-label">Foto / Video Temuan Lapangan</label>
                        <input class="border border-neutral-200 dark:border-neutral-600 w-full rounded-lg" type="file" name="files[]" id="files" multiple accept="image/*,video/*">
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Faktor Penyebab</label>
                        <select class="form-control capitalize" id="category" name="category" style="width: 100%" required>
                            @if ($mode == "create")
                                <option value="man" class="capitalize text-black">man</option>
                                <option value="machine" class="capitalize text-black">machine</option>
                                <option value="material" class="capitalize text-black">material</option>
                                <option value="method" class="capitalize text-black">method</option>
                                <option value="environment" class="capitalize text-black">environemt</option>
                            @else
                                <option value="man" class="capitalize text-black" {{ $cause->category == "man" ? 'selected' : '' }}>man</option>
                                <option value="machine" class="capitalize text-black" {{ $cause->category == "machine" ? 'selected' : '' }}>machine</option>
                                <option value="material" class="capitalize text-black" {{ $cause->category == "material" ? 'selected' : '' }}>material</option>
                                <option value="method" class="capitalize text-black" {{ $cause->category == "method" ? 'selected' : '' }}>method</option>
                                <option value="environment" class="capitalize text-black" {{ $cause->category == "environment" ? 'selected' : '' }}>environemt</option>
                            @endif
                            
                        </select>
                    </div>

                    <div class="mb-3 col-span-2">
                        <label for="description" class="block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Deskripsi Permasalahan</label>
                        <textarea name="description" id="description" class="form-control" rows="4" cols="50" placeholder="Enter a description...">{{ $cause->description ?? '' }}</textarea>
                    </div>
                </form>
            </div>
            <div class="flex items-center gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="button" wire:click="doClose()" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-base px-[50px] py-[11px] rounded-lg">
                    Batal
                </button>
                <button id="save-cause" type="submit" class="btn btn-primary border border-primary-600 text-base px-7 py-3 rounded-lg">
                    Simpan Akar Masalah
                </button>
            </div>
        </div>
    </div>
</div>

@push('lv-scripts')
    <script>
        Livewire.on('showModalFormRootCause', () => {
            // Flat pickr or date picker js 
            
        })

        $('#save-cause').on('click', function(e) {
            e.preventDefault();

            $('#cause-form').submit();
        });
    </script>
@endpush