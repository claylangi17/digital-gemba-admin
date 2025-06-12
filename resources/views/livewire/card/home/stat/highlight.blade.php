{{-- Stat Highlights  --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        
    {{-- Card Total Session  --}}
    
    <div class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-cyan-600/10 to-bg-white">
        <div class="card-body p-5">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <p class="font-medium text-neutral-900 dark:text-white mb-1">Total Sesi</p>
                    <h6 class="mb-0 dark:text-white"> {{ $total }} </h6>
                </div>
                <div class="w-[50px] h-[50px] bg-cyan-600 rounded-full flex justify-center items-center">
                    <iconify-icon icon="codicon:graph" class="text-white text-2xl mb-0"></iconify-icon>
                </div>
            </div>
        </div>
    </div>

    {{-- Card Progress Session  --}}

    <div class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-warning-600/10 to-bg-white">
        <div class="card-body p-5">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <p class="font-medium text-neutral-900 dark:text-white mb-1">Berjalan</p>
                    <h6 class="mb-0 dark:text-white"> {{ $progress }} </h6>
                </div>
                <div class="w-[50px] h-[50px] bg-warning-600 rounded-full flex justify-center items-center">
                    <iconify-icon icon="uim:process" class="text-white text-2xl mb-0"></iconify-icon>
                </div>
            </div>
        </div>
    </div>

    {{-- Card Done Session  --}}

    <div class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-success-600/10 to-bg-white">
        <div class="card-body p-5">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <p class="font-medium text-neutral-900 dark:text-white mb-1">Selesai</p>
                    <h6 class="mb-0 dark:text-white"> {{ $finish }} </h6>
                </div>
                <div class="w-[50px] h-[50px] bg-success-600 rounded-full flex justify-center items-center">
                    <iconify-icon icon="mdi:done-all" class="text-white text-2xl mb-0"></iconify-icon>
                </div>
            </div>
        </div>
    </div>
</div>