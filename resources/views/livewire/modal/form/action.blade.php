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
                <form id="action-form" action="{{ $mode == "create" ? route("action.create") : route("action.update") }}" method="POST" class="grid grid-cols-2 gap-2">
                    @csrf
                    
                    @if ($mode == "create")
                        <input type="text" value="{{ $issue_id ?? '' }}" name="issue_id" id="issue_id" hidden>
                    @else
                        <input type="text" value="{{ $action->id ?? '' }}" name="action_id" id="action_id" hidden>
                    @endif

                    <div class="mb-3">
                        <label for="pic_id" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">PIC</label>
                        <select id="pic_id" name="pic_id" required>
                            @if ($mode == "create")
                                @foreach ($users as $user)
                                    @if ($user->id != Auth::user()->id)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            @else
                                @foreach ($users as $user)
                                    @if ($user->id != Auth::user()->id)
                                        @if ($user->id == $action->pic->id)
                                            <option value="{{ $user->id }}" selected>{{ $user->name }}</option>  
                                        @else
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="due_date" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Tenggat Waktu</label>
                        <div class="relative">
                            <input class="form-control rounded-lg bg-white dark:bg-neutral-700" id="due_date" name="due_date" type="text" value="{{ $action == null ? '' : Carbon\Carbon::parse($action->due_date)->translatedFormat('d/m/Y H:i')   }}">
                            <span class="absolute end-0 top-1/2 -translate-y-1/2 me-3 line-height-1"><iconify-icon icon="solar:calendar-linear" class="icon text-lg"></iconify-icon></span>
                        </div>
                    </div>

                    <div class="mb-3 w-full">
                        <label for="type" class="block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Tipe Aksi</label>
                        <select id="type" name="type" class="form-control w-full" required>
                            @if ($mode == "create")
                                <option class="text-black" value="CORRECTIVE">Korektif</option>
                                <option class="text-black" value="PREVENTIVE">Preventif</option>
                            @else
                                <option class="text-black" value="CORRECTIVE" {{ $action->type == "CORRECTIVE" ? 'selected' : '' }}>Korektif</option>
                                <option class="text-black" value="PREVENTIVE" {{ $action->type == "PREVENTIVE" ? 'selected' : '' }}>Preventif</option>
                            @endif
                        </select>
                    </div>

                    <div class="mb-3 w-full">
                        <label for="root_cause_selector" class="block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Pilih Penyebab Terkait</label>
                        <select id="root_cause_selector" name="root_cause_selector" style="width: 100%" required>
                            @if ($causes)
                                @foreach ($causes as $cause)
                                    @if ($action)
                                        @if ($action->rootCause->id == $cause->id)
                                            <option value="{{ $cause->id }}" selected>{{ $cause->description }} - {{ $cause->category }}</option>
                                        @else
                                            <option value="{{ $cause->id }}">{{ $cause->description }} - {{ $cause->category }}</option>
                                        @endif
                                    @else
                                        <option value="{{ $cause->id }}">{{ $cause->description }} - {{ $cause->category }}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="mb-3 col-span-2">
                        <label for="description" class="block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Deskripsi Aksi</label>
                        <textarea name="description" id="description" class="form-control" rows="4" cols="50" placeholder="Enter a description...">{{ $action->description ?? '' }}</textarea>
                    </div>
                </form>
            </div>
            <div class="flex items-center gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="button" wire:click="doClose()" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-base px-[50px] py-[11px] rounded-lg">
                    Batal
                </button>
                <button id="save-action" type="submit" class="btn btn-primary border border-primary-600 text-base px-7 py-3 rounded-lg">
                    Simpan Aksi
                </button>
            </div>
        </div>
    </div>
</div>

@push('lv-scripts')
    <script src="{{ asset('assets/js/full-calendar.js') }}"></script>
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>

    <script>
        Livewire.on('initActionRootCauseSelector', () => {
            setTimeout(() => {
                VirtualSelect.init({ 
                    ele: '#root_cause_selector',
                    search: true,
                    maxWidth: "100%",
                    additionalClasses: 'vir-select',
                });

                VirtualSelect.init({ 
                    ele: '#pic_id',
                    name: 'pic_id',
                    maxWidth: '100%',
                    search: true,
                    noOptionsText: "Tidak ada karyawan",
                    noSearchResultsText: "Karyawan tidak ditemukan",
                    searchPlaceholderText: "Cari....",
                    placeholder: "Pilih PIC",
                });

                @if ($mode == "update")
                    document.querySelector('#pic_id').setValue('{{ $action->pic->id }}');
                @endif
            }, 100);
        });

        function getDatePicker(receiveID) {
                flatpickr(receiveID, {
                    enableTime: true,
                    dateFormat: "d/m/Y H:i",
                });
            }
            getDatePicker("#due_date");

        $('#save-action').on('click', function(e) {
            e.preventDefault();

            $('#action-form').submit();
        });
    </script>
@endpush