{{-- Root Cause Card : Start  --}}
<div class="card h-full p-0 rounded-xl border-0 overflow-hidden w-full my-4">
    <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
        <div class="flex items-center flex-wrap gap-3" style="width: 45%">
            <span class="text-xl font-medium text-secondary-light mb-0">Akar Masalah </span>

            <button onclick="location.reload()" class="btn btn-secondary border border-neutral-600 text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2">
                <iconify-icon icon="uis:refresh" class="icon text-xl line-height-1"></iconify-icon>
            </button>

            <div style="width: 50%">
                <select class="capitalize" id="filter_category" name="filter_category" style="width: 75%" required wire:change="change_category($event.target.value)">
                    <option value="all" class="capitalize">semua</option>
                    <option value="man" class="capitalize">man</option>
                    <option value="machine" class="capitalize">machine</option>
                    <option value="material" class="capitalize">material</option>
                    <option value="method" class="capitalize">method</option>
                    <option value="environment" class="capitalize">environment</option>
                </select>
            </div>
        </div>

        @if ($issue->status == "OPEN")
            <div class="flex items-center justify-end gap-3" style="width: 45%">
                <button onclick="Livewire.dispatch('showModalAISuggestRootCause', ['{{ $issue->id }}' ,'{{ $issue->line }}', '{{ $issue->description }}'])" class="btn btn-secondary border border-neutral-600 text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2">
                    <iconify-icon icon="mingcute:ai-line" class="icon text-xl line-height-1"></iconify-icon>
                    Tanya AI
                </button>
                <button onclick="Livewire.dispatch('showModalFormRootCause', { id: '' , issue_id: '{{ $issue->id }}' })" class="btn btn-primary text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2">
                    <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                    Tambahkan Akar Masalah
                </button>
            </div>
        @endif
    </div>
    <div class="card-body p-6">
        <table id="genba-cause-table" class="border border-neutral-200 dark:border-neutral-600 rounded-lg border-separate	">
            <thead>
                <tr>
                    <th scope="col" class="text-neutral-800 dark:text-white">
                        <div class="form-check style-check flex items-center">
                            <input class="form-check-input" id="serial" type="checkbox">
                            <label class="ms-2 form-check-label" for="serial">
                                No.
                            </label>
                        </div>
                    </th>
                    <th scope="col" class="text-neutral-800 dark:text-white">
                        <div class="flex items-center gap-2">
                            Oleh
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </div>
                    </th>
                    <th scope="col" class="text-neutral-800 dark:text-white">
                        <div class="flex items-center gap-2">
                            Kategori Penyebab
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
                            Action
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($root_causes as $cause)
                    <tr>
                        <td>
                            <div class="form-check style-check flex items-center">
                                <input class="form-check-input" type="checkbox">
                                <label class="ms-2 form-check-label">
                                    {{ $cause->id }}
                                </label>
                            </div>
                        </td>
                        <td>
                            <h6 class="text-base mb-0 font-medium grow"> {{ $cause->creator->name }} </h6>
                        </td>
                        <td>
                            <p> {{ $cause->category }} </p>
                        </td>
                        <td>
                            <span> {{ $cause->description }} </span>
                        </td>
                        <td>
                            <button onclick="Livewire.dispatch('showModalViewRootCause', { id: '{{ $cause->id }}' })" class="w-8 h-8 bg-primary-50 dark:bg-primary-600/10 text-primary-600 dark:text-primary-400 rounded-full inline-flex items-center justify-center">
                                <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                            </button>
                            @if ($issue->status == "OPEN")
                                <a href="{{ route('cause.delete', [$cause->id]) }}" data-confirm-delete="true" class="w-8 h-8 bg-danger-100 dark:bg-danger-600/25 text-danger-600 dark:text-danger-400 rounded-full inline-flex items-center justify-center">
                                    <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                </a>

                                <button onclick="Livewire.dispatch('showModalFormRootCause', { id: '{{ $cause->id }}' })" class="w-8 h-8 bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 rounded-full inline-flex items-center justify-center">
                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- Root Cause Card : End  --}}

@push('lv-scripts')
<script src="{{ asset('assets/js/data-table/genba-cause.js') }}"></script>

<script>
    Livewire.on('resetGenbaCauseTable', () => {
        setTimeout(() => {
            if (document.getElementById("genba-cause-table") && typeof simpleDatatables.DataTable !== 'undefined') {

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
                            searchTitle: "Cari Isu",
                            pageTitle: "Halaman {page}",
                            perPage: "Item per halaman",
                            noRows: "Tidak Ada Data",
                            info: "Menampilkan {start} sampai {end} dari {rows} item",
                            noResults: "Tidak Ada Isu Yang Cocok",
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

                    table = new simpleDatatables.DataTable("#genba-cause-table", options);

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
