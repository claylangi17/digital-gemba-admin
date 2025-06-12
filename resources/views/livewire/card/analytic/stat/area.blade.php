<!-- Common Issues Start -->
<div class="col-span-12 md:col-span-6 2xl:col-span-4">
    <div class="card border-0 h-full">
        <div class="card-header">
            <div class="flex items-center flex-wrap gap-2 justify-between">
                <h6 class="font-bold text-lg mb-0">Area Permasalahan</h6>
            </div>
        </div>
        <div class="card-body">
            
            @foreach ($lines as $line)
                <div class="flex items-center justify-between gap-3 mb-[26px]">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg flex-shrink-0 bg-info-50 dark:bg-info-600/20 flex justify-center items-center">
                            <iconify-icon icon="tabler:square-filled" class="text-primary-600 text-2xl mb-0"></iconify-icon>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-base mb-0 font-normal"> {{ $line->name }} </h6>
                            <span class="text-sm text-neutral-600 font-normal"> {{ $line->issues->count() }} Isu </span>
                        </div>
                    </div>
                    <a href="javascript:void(0)" class="w-6 h-6 bg-primary-600/10 text-primary-600 dark:text-primary-600 flex justify-center items-center text-lg hover:bg-primary-600/20 rounded">
                        <i class="ri-arrow-right-s-line"></i>
                    </a>
                </div>
            @endforeach
            
        </div>
    </div>
</div>
<!-- Common Issues End -->