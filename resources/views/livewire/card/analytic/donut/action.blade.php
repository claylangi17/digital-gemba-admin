<div class="col-span-12 md:col-span-6 2xl:col-span-4">
    <div class="card border-0 h-full rounded-lg">
        <div class="card-body p-6 flex flex-col justify-between gap-8">
            <div class="flex items-center flex-wrap gap-2 justify-between mb-5">
                <h6 class="font-bold text-lg mb-0">Status Aksi</h6>
                <select 
                    class="form-select form-select-sm w-auto bg-white dark:bg-neutral-800 dark:text-white border text-neutral-600"
                    wire:change="changeTimeScope($event.target.value)"
                >
                    <option value="all">Semua</option>
                    <option value="year">Tahun Ini</option>
                    <option value="month">Bulan Ini</option>
                    <option value="day">Hari Ini</option>
                </select>
            </div>

            <div>
                <div 
                id="actionStatusDonut" 
                class="margin-16-minus y-value-left apexcharts-tooltip-z-none"
                > </div>
            </div>

            <div 
                id="actionStatusDonut-data"
                class="hidden" 
                data-overdue="{{ $overdue }}"
                data-finish="{{ $finish }}"
                data-progress="{{ $progress }}">
            </div>

            <ul class="flex flex-wrap items-center justify-between mt-8 gap-3">
                <li class="flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full
                        bg-danger-600"></span>
                        <span class="text-neutral-600 text-sm font-semibold">Terlambat</span>
                    </div>
                    <span class="text-primary-light font-bold">{{ $overdue }}</span>
                </li>
                <li class="flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full
                        bg-success-600"></span>
                        <span class="text-neutral-600 text-sm font-semibold">Terlaksana</span>
                    </div>
                    <span class="text-primary-light font-bold"> {{ $finish }} </span>
                </li>
                <li class="flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full
                        bg-warning-600"></span>
                        <span class="text-neutral-600 text-sm font-semibold">Dalam Proses</span>
                    </div>
                    <span class="text-primary-light font-bold"> {{ $progress }} </span>
                </li>
            </ul>
        </div>
    </div>
</div>

@push('lv-scripts')
<script>
    function createDonut()
    {
            var options = {
            series: [{{ $finish }}, {{ $overdue }}, {{ $progress }}],
            colors: ["#15803d", "#b91c1c", "#f39016"],
            labels: ["Selesai", "Terlambat", "Proses"],
            legend: {
                show: false
            },
            chart: {
                id: 'action-donut',
                type: "donut",
                height: 270,
                sparkline: {
                    enabled: true // Remove whitespace
                },
                margin: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                }
            },
            stroke: {
                width: 0,
            },
            dataLabels: {
                enabled: false
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: "bottom"
                    }
                }
            }],
        };

        var actionStatusDonut = new ApexCharts(document.querySelector("#actionStatusDonut"), options);
        actionStatusDonut.render()
    }

    document.addEventListener('livewire:init', () => {
        createDonut()
    })
</script>
<script>

    function chartUpdate()
    {
        const finish = parseInt($("#actionStatusDonut-data").attr("data-finish")) || 0;
        const overdue = parseInt($("#actionStatusDonut-data").attr("data-overdue")) || 0;
        const progress = parseInt($("#actionStatusDonut-data").attr("data-progress")) || 0;

        ApexCharts.exec('action-donut', "updateSeries", [finish, overdue, progress]);
    }

    Livewire.on('requestChartUpdate', () => {
            

            setTimeout(() => {
                chartUpdate()
            }, 500);
        });

    
</script>
@endpush