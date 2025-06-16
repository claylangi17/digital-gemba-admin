{{-- Action : Start  --}}
<div class="card h-full p-0 rounded-xl border-0 overflow-hidden w-full my-4">
    <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
        <div class="flex items-center flex-wrap gap-3">
            <span class="text-xl font-medium text-secondary-light mb-0">Solusi / Aksi </span>

            <button wire:click="reload()" class="btn btn-secondary border border-neutral-600 text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2">
                <iconify-icon icon="uis:refresh" class="icon text-xl line-height-1"></iconify-icon>
            </button>
        </div>

        @if ($issue->status == "OPEN")
            <div class="flex items-center justify-end gap-3">
                <button onclick="Livewire.dispatch('showModalAISuggestAction', ['{{ $issue->id }}' ,'{{ $issue->line }}', '{{ $issue->description }}'])" class="btn btn-secondary border border-neutral-600 text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2">
                    <iconify-icon icon="mingcute:ai-line" class="icon text-xl line-height-1"></iconify-icon>
                    Tanya AI
                </button>
                <button onclick="Livewire.dispatch('showModalFormAction', { id: '' , issue_id: '{{ $issue->id }}' })" class="btn btn-primary text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2">
                    <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                    Buat Aksi Baru
                </button>
            </div>
        @endif
    </div>
    <div class="card-body p-6">
        <table id="genba-action-table" class="border border-neutral-200 dark:border-neutral-600 rounded-lg border-separate	">
            <thead>
                <tr>
                    <th scope="col" class="text-neutral-800 dark:text-white">
                        <div class="form-check style-check flex items-center">
                            <input class="form-check-input" id="serial" type="checkbox">
                            <label class="ms-2 form-check-label" for="serial">
                                ID.
                            </label>
                        </div>
                    </th>
                    <th scope="col" class="text-neutral-800 dark:text-white">
                        <div class="flex items-center gap-2">
                            Tipe Aksi
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </div>
                    </th>
                    <th scope="col" class="text-neutral-800 dark:text-white">
                        <div class="flex items-center gap-2">
                            Deskripsi
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </div>
                    </th>
                    <th scope="col" class="text-neutral-800 dark:text-white">
                        <div class="flex items-center gap-2">
                            PIC
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </div>
                    </th>
                    <th scope="col" class="text-neutral-800 dark:text-white">
                        <div class="flex items-center gap-2">
                            Tenggat Waktu
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </div>
                    </th>
                    <th scope="col" class="text-neutral-800 dark:text-white">
                        <div class="flex items-center gap-2">
                            Status
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </div>
                    </th>
                    <th scope="col" class="text-neutral-800 dark:text-white">
                        <div class="flex items-center gap-2">
                            Action
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($actions as $act)
                    <tr>
                        <td>
                            <div class="form-check style-check flex items-center">
                                <input class="form-check-input" type="checkbox">
                                <label class="ms-2 form-check-label">
                                    {{ $act->id }}
                                </label>
                            </div>
                        </td>
                        <td>
                            <h6 class="text-xs mb-0 font-semibold"> {{ $act->type }} </h6>
                        </td>
                        <td>
                            <span> {{ $act->description }} </span>
                        </td>
                        <td>
                            <span> {{ $act->pic->name }} </span>
                        </td>
                        <td>
                            <span> {{ $act->due_date }} </span>
                        </td>
                        <td>
                            @if ($act->status == "PROGRESS")
                                @if ($act->due_date < Carbon\Carbon::now())
                                    <p class="bg-danger-100 dark:bg-danger-600/25 text-danger-600 dark:text-danger-400 px-6 py-1.5 rounded-full font-medium text-xs text-center">Terlambat</p>
                                @else
                                    <p class="bg-warning-100 dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 px-6 py-1.5 rounded-full font-medium text-xs text-center">Dalam Proses</p>
                                @endif
                            @else
                                <p class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-xs text-center">Terselesaikan</p>
                            @endif
                        </td>
                        <td>
                            <button onclick="Livewire.dispatch('showModalViewAction', { id: '{{ $act->id }}' })" class="w-8 h-8 bg-primary-50 dark:bg-primary-600/10 text-primary-600 dark:text-primary-400 rounded-full inline-flex items-center justify-center">
                                <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                            </button>
                            @if ($issue->status == "OPEN")
                                <button onclick="Livewire.dispatch('showModalFormAction', { id: '{{ $act->id }}' })" class="w-8 h-8 bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 rounded-full inline-flex items-center justify-center">
                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                </button>
                            @endif
                            <a href="{{ route('action.delete', [$act->id]) }}" data-confirm-delete="true" class="w-8 h-8 bg-danger-100 dark:bg-danger-600/25 text-danger-600 dark:text-danger-400 rounded-full inline-flex items-center justify-center">
                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- Action : End  --}}

@push('lv-scripts')
<script src="{{ asset('assets/js/data-table/genba-action.js') }}"></script>

<script>
    Livewire.on('resetGenbaActionTable', () => {
        setTimeout(() => {
            if (document.getElementById("genba-action-table") && typeof simpleDatatables.DataTable !== 'undefined') {

                let multiSelect = true;
                let rowNavigation = false;
                let table = null;

                const resetTable = function () {
                    if (table) {
                        table.destroy();
                    }

                    const options = {
                        columns: [
                            { select: [0, 4], sortable: false } // Disable sorting on the first column (index 0 and 6)
                        ],
                        perPage: 5,
                        labels: {
                            placeholder: "Cari...",
                            searchTitle: "Cari Aksi",
                            pageTitle: "Halaman {page}",
                            perPage: "Item per halaman",
                            noRows: "Tidak Ada Data",
                            info: "Menampilkan {start} sampai {end} dari {rows} item",
                            noResults: "Tidak Ada Aksi Yang Cocok",
                        },
                        rowRender: (row, tr, _index) => {
                            if (!tr.attributes) {
                                tr.attributes = {};
                            }
                            if (!tr.attributes.class) {
                                tr.attributes.class = "";
                            }
                            if (row.selected) {
                                tr.attributes.class += " selected";
                            } else {
                                tr.attributes.class = tr.attributes.class.replace(" selected", "");
                            }
                            return tr;
                        }
                    };
                    if (rowNavigation) {
                        options.rowNavigation = true;
                        options.tabIndex = 1;
                    }

                    table = new simpleDatatables.DataTable("#genba-action-table", options);

                    // Mark all rows as unselected
                    table.data.data.forEach(data => {
                        data.selected = false;
                    });

                    table.on("datatable.selectrow", (rowIndex, event) => {
                        event.preventDefault();
                        const row = table.data.data[rowIndex];
                        if (row.selected) {
                            row.selected = false;
                        } else {
                            if (!multiSelect) {
                                table.data.data.forEach(data => {
                                    data.selected = false;
                                });
                            }
                            row.selected = true;
                        }
                        table.update();
                    });
                };

                // Row navigation makes no sense on mobile, so we deactivate it and hide the checkbox.
                const isMobile = window.matchMedia("(any-pointer:coarse)").matches;
                if (isMobile) {
                    rowNavigation = false;
                }

                resetTable();
                }
        }, 100);
    })
</script>
@endpush
