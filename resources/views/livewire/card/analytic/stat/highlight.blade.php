{{-- Stat Highlights  --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 3xl:grid-cols-5 gap-6">
        
    {{-- Card Issue Active  --}}
    
    <div class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-cyan-600/10 to-bg-white">
        <div class="card-body p-5">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <p class="font-medium text-neutral-900 dark:text-white mb-1">Isu Aktif</p>
                    <h6 class="mb-0 dark:text-white"> {{ $active_issue }} </h6>
                </div>
                <div class="w-[50px] h-[50px] bg-cyan-600 rounded-full flex justify-center items-center">
                    <iconify-icon icon="pajamas:issue-type-incident" class="text-white text-2xl mb-0"></iconify-icon>
                </div>
            </div>
            <p class="font-medium text-sm text-neutral-600 dark:text-white mt-3 mb-0 flex items-center gap-2">
                @if ($active_issue > $active_issue_last)
                    <span class="inline-flex items-center gap-1 text-success-600 dark:text-success-400"><iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> + {{ $active_issue - $active_issue_last }} </span>
                @else
                    <span class="inline-flex items-center gap-1 text-danger-600 dark:text-danger-400"><iconify-icon icon="bxs:down-arrow" class="text-xs"></iconify-icon> - {{ $active_issue_last - $active_issue }} </span>
                @endif
                Selama 30 Hari Terakhir
            </p>
        </div>
    </div>

    {{-- Card Issue Done  --}}

    <div class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-purple-600/10 to-bg-white">
        <div class="card-body p-5">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <p class="font-medium text-neutral-900 dark:text-white mb-1">Isu Terselesaikan</p>
                    <h6 class="mb-0 dark:text-white"> {{ $done_issue }} </h6>
                </div>
                <div class="w-[50px] h-[50px] bg-purple-600 rounded-full flex justify-center items-center">
                    <iconify-icon icon="pajamas:task-done" class="text-white text-2xl mb-0"></iconify-icon>
                </div>
            </div>
            <p class="font-medium text-sm text-neutral-600 dark:text-white mt-3 mb-0 flex items-center gap-2">
                @if ($done_issue > $done_issue_last)
                    <span class="inline-flex items-center gap-1 text-success-600 dark:text-success-400"><iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> + {{ $done_issue - $done_issue_last }} </span>
                @else
                    <span class="inline-flex items-center gap-1 text-danger-600 dark:text-danger-400"><iconify-icon icon="bxs:down-arrow" class="text-xs"></iconify-icon> - {{ $done_issue_last - $done_issue }} </span>
                @endif
                Selama 30 Hari Terakhir
            </p>
        </div>
    </div>

    {{-- Card Overdue Action  --}}

    <div class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-blue-600/10 to-bg-white">
        <div class="card-body p-5">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <p class="font-medium text-neutral-900 dark:text-white mb-1">Aksi Terlambat</p>
                    <h6 class="mb-0 dark:text-white"> {{ $overdue_action }} </h6>
                </div>
                <div class="w-[50px] h-[50px] bg-warning-600 rounded-full flex justify-center items-center">
                    <iconify-icon icon="pajamas:pause" class="text-white text-2xl mb-0"></iconify-icon>
                </div>
            </div>
            <p class="font-medium text-sm text-neutral-600 dark:text-white mt-3 mb-0 flex items-center gap-2">
                @if ($overdue_action > $overdue_action_last)
                    <span class="inline-flex items-center gap-1 text-success-600 dark:text-success-400"><iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> + {{ $overdue_action - $overdue_action_last }} </span>
                @else
                    <span class="inline-flex items-center gap-1 text-danger-600 dark:text-danger-400"><iconify-icon icon="bxs:down-arrow" class="text-xs"></iconify-icon> - {{ $overdue_action_last - $overdue_action }} </span>
                @endif
                Selama 30 Hari Terakhir
            </p>
        </div>
    </div>

    {{-- Card Total Appreciation --}}

    <div class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-success-600/10 to-bg-white">
        <div class="card-body p-5">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <p class="font-medium text-neutral-900 dark:text-white mb-1">Total Apresiasi</p>
                    <h6 class="mb-0 dark:text-white"> {{ $total_appreciation }} </h6>
                </div>
                <div class="w-[50px] h-[50px] bg-success-600 rounded-full flex justify-center items-center">
                    <iconify-icon icon="gg:awards" class="text-white text-2xl mb-0"></iconify-icon>
                </div>
            </div>
            <p class="font-medium text-sm text-neutral-600 dark:text-white mt-3 mb-0 flex items-center gap-2">
                @if ($total_appreciation > $total_appreciation_last)
                    <span class="inline-flex items-center gap-1 text-success-600 dark:text-success-400"><iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> + {{ $total_appreciation - $total_appreciation_last }} </span>
                @else
                    <span class="inline-flex items-center gap-1 text-danger-600 dark:text-danger-400"><iconify-icon icon="bxs:down-arrow" class="text-xs"></iconify-icon> - {{ $total_appreciation_last - $total_appreciation }} </span>
                @endif
                Selama 30 Hari Terakhir
            </p>
        </div>
    </div>
</div>