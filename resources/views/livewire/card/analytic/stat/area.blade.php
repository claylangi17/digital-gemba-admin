<!-- Common Issues Start -->
<div class="col-span-12 md:col-span-6 2xl:col-span-4">
    <div class="card border-0 h-full">
        <div class="card-header">
            <div class="flex items-center flex-wrap gap-2 justify-between">
                <h6 class="font-bold text-lg mb-0">Area Permasalahan Terbanyak</h6>
            </div>
        </div>
        <div class="card-body">
            
            @foreach ($lines as $index=>$line)
                <div class="flex items-center justify-between gap-3 mb-[26px]">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg flex-shrink-0 bg-info-50 dark:bg-info-600/20 flex justify-center items-center">
                            <p class="text-xl text-primary-600 font-semibold">{{ $index + 1 }}</p>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-base mb-0 font-normal"> {{ $line->name }} </h6>
                            <span class="text-sm text-neutral-600 font-normal"> {{ $line->issues->count() }} Isu </span>
                        </div>
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
</div>
<!-- Common Issues End -->