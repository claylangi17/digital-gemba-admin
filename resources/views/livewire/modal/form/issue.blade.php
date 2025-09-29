<div 
id="issue-editor" 
class="{{ $show === true ? 'flex' : 'hidden' }} bg-neutral-600/10 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
>
    <div class="relative p-4 max-h-full" style="width: 70%">
        <div class="relative bg-white rounded-lg shadow dark:bg-dark-2">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white"> {{ $mode == "create" ? "Buat Isu Baru" : "Edit Detail Isu" }} </h3>
                <button type="button" wire:click="doClose()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Tutup Formulir</span>
                </button>
            </div>
            <div class="p-4 md:p-5 space-y-4">
                <form id="issue-form" action="{{ $mode == "create" ? route("issue.create") : route("issue.update") }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    
                    @if ($mode == "create")
                        <input type="text" value="{{ $session_id }}" name="session_id" id="session_id" hidden >
                    @else
                        <input type="text" value="{{ $issue->id }}" name="issue_id" id="issue_id" hidden >
                        <input type="text" value="{{ $issue->assigneds }}" name="assigneds" id="assigneds" hidden >
                        <input type="text" value="{{ $issue->line_id }}" name="line" id="line" hidden >
                        <input type="text" value="{{ $issue->items }}" name="item" id="item" hidden >
                    @endif
                    <div class="mb-3">
                        <label for="line_id" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Line</label>
                        <select name="line_id" id="lines">
                            @foreach ($lines as $line)
                                <option value="{{ $line->id }}">{{ $line->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 w-full">
                        <label for="items" class="block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Item Terkait</label>
                        <select name="items" id="items">
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Permasalahan</label>
                        <textarea name="description" id="description" class="form-control" rows="4" cols="50" placeholder="Masukan Deskripsi...">{{ $issue->description ?? '' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="files" class="form-label">Foto / Video Pendukung</label>
                        <input class="border border-neutral-200 dark:border-neutral-600 w-full rounded-lg" type="file" name="files[]" id="files" multiple accept="image/*,video/*">
                        <p class="text-xs text-neutral-500 mt-1">Biarkan kosong jika tidak ingin menambah file baru.</p>

                        @if($mode === 'update' && $issue && $issue->files->count())
                            <div class="mt-4">
                                <p class="font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">File Saat Ini</p>
                                <div class="grid gap-4 md:grid-cols-2">
                                    @foreach ($issue->files as $file)
                                        <div class="border border-neutral-200 dark:border-neutral-600 rounded-lg p-3 bg-neutral-50 dark:bg-neutral-700/50">
                                            <div class="flex items-center justify-between mb-2">
                                                <span class="text-xs font-medium text-neutral-600 dark:text-neutral-300">{{ $file->type }}</span>
                                                <label class="inline-flex items-center gap-2 text-xs text-danger-600 dark:text-danger-400">
                                                    <input type="checkbox" name="remove_files[]" value="{{ $file->id }}" class="rounded border-neutral-300 dark:border-neutral-600">
                                                    Hapus
                                                </label>
                                            </div>
                                            <div class="rounded-lg overflow-hidden">
                                                @if ($file->type === 'PHOTO')
                                                    <img src="{{ asset('storage/' . $file->path) }}" alt="File pendukung" class="w-full h-32 object-cover">
                                                @else
                                                    <video src="{{ asset('storage/' . $file->path) }}" class="w-full h-32 object-cover" controls></video>
                                                @endif
                                            </div>
                                            <a href="{{ asset('storage/' . $file->path) }}" target="_blank" class="text-primary-600 dark:text-primary-400 text-xs mt-2 inline-block">Lihat File</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="mb-3 w-full">
                        <label for="assigned_ids" class="block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Ditugaskan Kepada</label>
                        <select name="assigned_ids" id="assigned_ids">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="flex items-center gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="button" wire:click="doClose()" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-base px-[50px] py-[11px] rounded-lg">
                    Batal
                </button>
                <button id="save-issue" type="submit" class="btn btn-primary border border-primary-600 text-base px-7 py-3 rounded-lg">
                    Simpan Isu
                </button>
            </div>
        </div>
    </div>
</div>

@push('lv-scripts')

    <script>
        Livewire.on('initIssueVirSelector', () => {
            setTimeout(() => {
                VirtualSelect.init({ 
                    ele: '#assigned_ids',
                    name: 'assigned_ids',
                    maxWidth: '100%',
                    multiple: true,
                    search: true,
                    noOptionsText: "Tidak ada karyawan",
                    noSearchResultsText: "Karyawan tidak ditemukan",
                    searchPlaceholderText: "Cari....",
                    placeholder: "Pilih Karyawan",

                });

                VirtualSelect.init({ 
                    ele: '#lines',
                    name: 'line_id',
                    maxWidth: '100%',
                    search: true,
                    noOptionsText: "Tidak ada pilihan",
                    noSearchResultsText: "Pilihan tidak ditemukan",
                    searchPlaceholderText: "Cari....",
                    placeholder: "Pilih Line"
                });

                VirtualSelect.init({ 
                    ele: '#items',
                    name: 'items',
                    maxWidth: '100%',
                    multiple: true,
                    allowNewOption: true,
                    search: true,
                    noOptionsText: "Tidak ada item",
                    noSearchResultsText: "Item tidak ditemukan",
                    searchPlaceholderText: "Cari....",
                    placeholder: "Pilih Item"
                });
            }, 100);
        });

        $('#save-issue').on('click', function(e) {
            e.preventDefault();

            $('#issue-form').submit();
        });

        Livewire.on('UpdateIssueVirSelector', () => {
            setTimeout(() => {
                document.querySelector('#assigned_ids').setValue(JSON.parse(document.querySelector("#assigneds").value));
                document.querySelector('#items').setValue(document.querySelector("#item").value.split(','));
                document.querySelector('#lines').setValue(document.querySelector("#line").value);
            }, 200)
        })
    </script>

@endpush