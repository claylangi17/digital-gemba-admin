<!-- Top Issue Category Start -->
<div class="col-span-12 md:col-span-6 2xl:col-span-4">
    <div class="card border-0 h-full">
        <div class="card-header">
            <div class="flex items-center flex-wrap gap-2 justify-between">
                <h6 class="font-bold text-lg mb-0">Data Penyebab</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="flex items-center justify-between gap-3 mb-6">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-lg flex-shrink-0 bg-info-50 dark:bg-info-600/20 flex justify-center items-center">
                        <iconify-icon icon="material-symbols:source-environment-rounded" class="text-primary-600 text-2xl mb-0"></iconify-icon>
                    </div>
                    <div class="flex-grow-1 px-4"> 
                        <h6 class="sm:text-base text-xs mb-0 font-medium">Enviroment</h6>
                        <span class="text-sm text-neutral-600 font-medium">Lingkungan Produksi</span>
                    </div>
                </div>
                <div class="">
                    <span class="text-primary-light text-sm block text-right">
                        <svg class="radial-progress" data-percentage="{{ $environment }}" viewBox="0 0 80 80">
                            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
                            <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">{{ $environment }}</text>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="flex items-center justify-between gap-3 mb-6">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-lg flex-shrink-0 bg-info-50 dark:bg-info-600/20 flex justify-center items-center">
                        <iconify-icon icon="ix:machine-a" class="text-primary-600 text-2xl mb-0"></iconify-icon>
                    </div>
                    <div class="flex-grow-1 px-4"> 
                        <h6 class="sm:text-base text-xs mb-0 font-medium">Machine</h6>
                        <span class="text-sm text-neutral-600 font-medium">Mesin Produksi</span>
                    </div>
                </div>
                <div class="">
                    <span class="text-primary-light text-sm block text-right">
                        <svg class="radial-progress" data-percentage="{{ $machine }}" viewBox="0 0 80 80">
                            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
                            <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">{{ $machine }}</text>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="flex items-center justify-between gap-3 mb-6">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-lg flex-shrink-0 bg-info-50 dark:bg-info-600/20 flex justify-center items-center">
                        <iconify-icon icon="famicons:man-outline" class="text-primary-600 text-2xl mb-0"></iconify-icon>
                    </div>
                    <div class="flex-grow-1 px-4"> 
                        <h6 class="sm:text-base text-xs mb-0 font-medium">Man</h6>
                        <span class="text-sm text-neutral-600 font-medium">Operator Mesin</span>
                    </div>
                </div>
                <div class="">
                    <span class="text-primary-light text-sm block text-right">
                        <svg class="radial-progress" data-percentage="{{ $man }}" viewBox="0 0 80 80">
                            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
                            <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">{{ $man }}</text>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="flex items-center justify-between gap-3 mb-6">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-lg flex-shrink-0 bg-info-50 dark:bg-info-600/20 flex justify-center items-center">
                        <iconify-icon icon="uis:process" class="text-primary-600 text-2xl mb-0"></iconify-icon>
                    </div>
                    <div class="flex-grow-1 px-4"> 
                        <h6 class="sm:text-base text-xs mb-0 font-medium">Method</h6>
                        <span class="text-sm text-neutral-600 font-medium">Metode Produksi</span>
                    </div>
                </div>
                <div class="">
                    <span class="text-primary-light text-sm block text-right">
                        <svg class="radial-progress" data-percentage="{{ $method }}" viewBox="0 0 80 80">
                            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
                            <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">{{ $method }}</text>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="flex items-center justify-between gap-3 mb-6">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-lg flex-shrink-0 bg-info-50 dark:bg-info-600/20 flex justify-center items-center">
                        <iconify-icon icon="hugeicons:material-and-texture" class="text-primary-600 text-2xl mb-0"></iconify-icon>
                    </div>
                    <div class="flex-grow-1 px-4"> 
                        <h6 class="sm:text-base text-xs mb-0 font-medium">Material</h6>
                        <span class="text-sm text-neutral-600 font-medium">Bahan Baku Produksi</span>
                    </div>
                </div>
                <div class="">
                    <span class="text-primary-light text-sm block text-right">
                        <svg class="radial-progress" data-percentage="{{ $material }}" viewBox="0 0 80 80">
                            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
                            <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">{{ $material }}</text>
                        </svg>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Issue Category End -->

<script>
    document.addEventListener('livewire:init', () => {
        $("svg.radial-progress").each(function(index, value) {
            $(this).find($("circle.complete")).removeAttr("style");
        });

                // Activate progress animation on scroll
                $(window).scroll(function() {
                    $("svg.radial-progress").each(function(index, value) {
                        // If svg.radial-progress is approximately 25% vertically into the window when scrolling from the top or the bottom
                        if (
                            $(window).scrollTop() > $(this).offset().top - ($(window).height() * 0.75) &&
                            $(window).scrollTop() < $(this).offset().top + $(this).height() - ($(window).height() * 0.25)
                        ) {
                            // Get percentage of progress
                            percent = $(value).data("percentage");
                            // Get radius of the svg"s circle.complete
                            radius = $(this).find($("circle.complete")).attr("r");
                            // Get circumference (2πr)
                            circumference = 2 * Math.PI * radius;
                            // Get stroke-dashoffset value based on the percentage of the circumference
                            strokeDashOffset = circumference - ((percent * circumference) / 100);
                            // Transition progress for 1.25 seconds
                            $(this).find($("circle.complete")).animate({
                                "stroke-dashoffset": strokeDashOffset
                            }, 1250);
                        }
                    });
                }).trigger("scroll");
                // ================================ Aminated Radial Progress Bar End ================================ 
    })
</script>