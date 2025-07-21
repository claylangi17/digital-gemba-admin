<div 
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
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white"> Buat Laporan Sesi Gemba </h3>
                <button type="button" wire:click="doClose()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Tutup Formulir</span>
                </button>
            </div>
            <div class="mb-3 flex items-center gap-6 justify-between px-6 py-2">
                <label for="root_cause" class="inline font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2 capitalize">Klik Tombol Disamping untuk membuat laporan</label>
                <button wire:click="create_report()" onclick="show_report_loader()" class="btn btn-primary text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2">
                    <iconify-icon icon="mingcute:ai-line" class="icon text-xl line-height-1"></iconify-icon>
                    Buat Laporan
                </button>
                    
            </div>

            @unless ($isReportReady)
            <div wire:poll.5000ms="checkIfReportReady" id="report-loading" class="flex items-center justify-center gap-4 p-6 mb-3">
                <p class="text-primary-600">Mohon Tunggu Sebentar</p>
                <iconify-icon icon="eos-icons:three-dots-loading" class="icon text-2xl line-height-1 text-primary-600"></iconify-icon>
            </div>
            @endunless

            @if ($isReportReady)
            <div class="block mb-3 p-6" id="report-table">
                <div class="table-responsive">
                    <table class="table border-0 mb-0">
                        <thead>
                            <tr>
                                <th class="">Nama File</th>
                                <th class="">Dibuat Pada</th>
                                <th class="">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($reports && $reports->count() > 0)
                                @foreach ($reports as $item)
                                <tr>
                                    <td>
                                        {{ $item->filename }}
                                    </td>
                                    <td>
                                        {{ $item->created_at->translatedFormat('d F Y - H:i') }}
                                    </td>
                                    <td class="flex items-center justify-end">
                                        <a href="{{ $item->path }}"  class="btn bg-success-600 text-sm text-white btn-sm px-3 py-3 rounded-lg flex items-center gap-2">
                                            <iconify-icon icon="lucide:save" class="icon text-xl line-height-1"></iconify-icon>
                                            Download File
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="2" class="text-center">
                                    Belum Ada File - Silahkan Klik Tombol "Buat Laporan"
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
           
            <div class="flex items-center gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="button" wire:click="doClose()" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-base px-[50px] py-[11px] rounded-lg">
                    Kembali
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    Livewire.on('initRootCauseSelector', () => {
        setTimeout(() => {
            VirtualSelect.init({ 
                ele: '#root_cause',
                maxWidth: "60%",
                additionalClasses: 'vir-select',
            });
        }, 100);
    });

    function show_report_loader()
    {
        $("#report-loading").removeClass("hidden").addClass("flex");
        $("#report-table").removeClass("block").addClass("hidden");
    }

    function hide_report_loader()
    {
        $("#report-loading").removeClass("flex").addClass("hidden");
        $("#report-table").removeClass("hidden").addClass("block");
    }

    Livewire.on('gembaReportCreated', () => {
        hide_report_loader()
    });
</script>