{{-- Attendance Card : Start  --}}
<div class="card h-full p-0 rounded-xl border-0 overflow-hidden w-full">
    <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
        <div class="flex items-center flex-wrap gap-3">
            <span class="text-xl font-medium text-secondary-light mb-0">Presensi </span>

            <button wire:click="reload()" class="btn btn-secondary border border-neutral-600 text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2">
                <iconify-icon icon="uis:refresh" class="icon text-xl line-height-1"></iconify-icon>
            </button>
        </div>

        @if ($genba->status == "PROGRESS")
            <div class="flex items-center flex-wrap gap-3">
                <button  class="btn btn-secondary border border-neutral text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2" data-modal-target="attendance-modal" data-modal-toggle="attendance-modal">
                    <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                    Tambahkan Peserta
                </button>

                <button  class="btn btn-primary text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2" data-modal-target="qr-modal" data-modal-toggle="qr-modal">
                    <iconify-icon icon="bx:qr" class="icon text-xl line-height-1"></iconify-icon>
                    Tampilkan Kode QR 
                </button>
            </div>
        @endif

    </div>
    <div class="card-body p-6">
        <div class="table-responsive">
            <table id="genba-attendance-table" class="border border-neutral-200 dark:border-neutral-600 rounded-lg border-separate	">
                <thead>
                    <tr>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Nama
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Departemen
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
                                Waktu Masuk
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Waktu Keluar
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2 justify-center">
                                Aksi
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($attendances as $attendance)
                        
                        {{-- Present  --}}
                        @if ($attendance->status == "PRESENT")
                            <tr>
                                <td>
                                    <h6 class="text-xs mb-0 font-semibold"> {{ $attendance->user->name }} </h6>
                                </td>
                                <td class="capitalize">
                                    {{ $attendance->user->department }}
                                </td>
                                <td>
                                    <span class="bg-success-100 dark:bg-success-600/25 text-success-600 dark:text-success-400 px-6 py-1.5 rounded-full font-medium text-sm">Hadir</span>
                                </td>
                                <td>
                                    {{ $attendance->time_in ?? '-' }}
                                </td>
                                <td>
                                    {{ $attendance->time_out ?? '-' }}
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" class="w-8 h-8 bg-danger-50 dark:bg-danger-600/10 text-danger-600 dark:text-danger-400 rounded-full inline-flex items-center justify-center">
                                        <iconify-icon icon="solar:trash-bin-trash-bold"></iconify-icon>
                                    </a>
                                </td>
                            </tr>
                        @endif

                        {{-- Late  --}}
                        @if ($attendance->status == "LATE")
                            <tr>
                                <td>
                                    <h6 class="text-xs mb-0 font-semibold"> {{ $attendance->user->name }} </h6>
                                </td>
                                <td class="capitalize">
                                    {{ $attendance->user->department }}
                                </td>
                                <td>
                                    <span class="bg-warning-100 dark:bg-warning-600/25 text-warning-600 dark:text-warning-400 px-6 py-1.5 rounded-full font-medium text-sm">Terlambat</span>
                                </td>
                                <td>
                                    {{ $attendance->time_in ?? '-' }}
                                </td>
                                <td>
                                    {{ $attendance->time_out ?? '-' }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('attendance.delete', [$attendance->id]) }}" data-confirm-delete="true" class="w-8 h-8 bg-danger-50 dark:bg-danger-600/10 text-danger-600 dark:text-danger-400 rounded-full inline-flex items-center justify-center">
                                        <iconify-icon icon="solar:trash-bin-trash-bold"></iconify-icon>
                                    </a>
                                </td>
                            </tr>
                        @endif

                        {{-- Absent  --}}
                        @if ($attendance->status == "ABSENT")
                            <tr>
                                <td>
                                    <h6 class="text-xs mb-0 font-semibold"> {{ $attendance->user->name }} </h6>
                                </td>
                                <td class="capitalize">
                                    {{ $attendance->user->department }}
                                </td>
                                <td>
                                    <span class="bg-danger-100 dark:bg-danger-600/25 text-danger-600 dark:text-danger-400 px-6 py-1.5 rounded-full font-medium text-sm">Absen</span>
                                </td>
                                <td>
                                    {{ $attendance->time_in ?? '-' }}
                                </td>
                                <td>
                                    {{ $attendance->time_out ?? '-' }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('attendance.delete', [$attendance->id]) }}" data-confirm-delete="true" class="w-8 h-8 bg-danger-50 dark:bg-danger-600/10 text-danger-600 dark:text-danger-400 rounded-full inline-flex items-center justify-center">
                                        <iconify-icon icon="solar:trash-bin-trash-bold"></iconify-icon>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- Attendance Card : End  --}}

@push('lv-scripts')
<script src="{{ asset('assets/js/data-table/genba-attendance.js') }}"></script>

<script>
    Livewire.on('resetGenbaAttendanceTable', () => {
        setTimeout(() => {
            if (document.getElementById("genba-attendance-table") && typeof simpleDatatables.DataTable !== 'undefined') {

                let multiSelect = true;
                let rowNavigation = false;
                let table = null;

                const resetTable = function () {
                    if (table) {
                        table.destroy();
                    }

                    const options = {
                        columns: [
                            { select: [5], sortable: false } // Disable sorting on the first column (index 0 and 6)
                        ],
                        perPage: 5,
                        labels: {
                            placeholder: "Cari...",
                            searchTitle: "Cari Peserta",
                            pageTitle: "Halaman {page}",
                            perPage: "Item per halaman",
                            noRows: "Tidak Ada Peserta",
                            info: "Menampilkan {start} sampai {end} dari {rows} item",
                            noResults: "Tidak Ada Peserta Yang Cocok",
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

                    table = new simpleDatatables.DataTable("#genba-attendance-table", options);

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
        }, 100)
    })
</script>
@endpush
