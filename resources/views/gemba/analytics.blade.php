@extends('layout.layout')
@php
    $title='Statistik Gemba';
    $subTitle = 'Gemba - Statistik';
    $script = '<script>
                        $(".delete-btn").on("click", function() {
                            $(this).closest(".user-grid-card").addClass("hidden")
                        });

                        // ================================ Users Overview Donut chart Start ================================ 
                    var options = {
                        series: [500, 500, 500],
                        colors: ["#FF9F29", "#487FFF", "#E4F1FF"],
                        labels: ["Active", "New", "Total"],
                        legend: {
                            show: false
                        },
                        chart: {
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

                    var chart = new ApexCharts(document.querySelector("#userOverviewDonutChart"), options);
                    chart.render();
                    // ================================ Users Overview Donut chart End ================================ 
                </script>';
@endphp

@section('content')

    {{-- Stat Highlights  --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 3xl:grid-cols-5 gap-6">
        
        {{-- Card  --}}
        
        <div class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-cyan-600/10 to-bg-white">
            <div class="card-body p-5">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="font-medium text-neutral-900 dark:text-white mb-1">Isu Aktif</p>
                        <h6 class="mb-0 dark:text-white">20,000</h6>
                    </div>
                    <div class="w-[50px] h-[50px] bg-cyan-600 rounded-full flex justify-center items-center">
                        <iconify-icon icon="pajamas:issue-type-incident" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="font-medium text-sm text-neutral-600 dark:text-white mt-3 mb-0 flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 text-success-600 dark:text-success-400"><iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +4000</span>
                    Last 30 days operations
                </p>
            </div>
        </div>

        {{-- Card  --}}

        <div class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-purple-600/10 to-bg-white">
            <div class="card-body p-5">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="font-medium text-neutral-900 dark:text-white mb-1">Isu Terselesaikan</p>
                        <h6 class="mb-0 dark:text-white">15,000</h6>
                    </div>
                    <div class="w-[50px] h-[50px] bg-purple-600 rounded-full flex justify-center items-center">
                        <iconify-icon icon="pajamas:task-done" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="font-medium text-sm text-neutral-600 dark:text-white mt-3 mb-0 flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 text-danger-600 dark:text-danger-400"><iconify-icon icon="bxs:down-arrow" class="text-xs"></iconify-icon> -800</span>
                    Last 30 days operations
                </p>
            </div>
        </div>

        {{-- Card  --}}

        <div class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-blue-600/10 to-bg-white">
            <div class="card-body p-5">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="font-medium text-neutral-900 dark:text-white mb-1">Aksi Terlambat</p>
                        <h6 class="mb-0 dark:text-white">5,000</h6>
                    </div>
                    <div class="w-[50px] h-[50px] bg-warning-600 rounded-full flex justify-center items-center">
                        <iconify-icon icon="pajamas:pause" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="font-medium text-sm text-neutral-600 dark:text-white mt-3 mb-0 flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 text-success-600 dark:text-success-400"><iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +200</span>
                    Last 30 days operations
                </p>
            </div>
        </div>

        {{-- card  --}}

        <div class="card shadow-none border border-gray-200 dark:border-neutral-600 dark:bg-neutral-700 rounded-lg h-full bg-gradient-to-r from-success-600/10 to-bg-white">
            <div class="card-body p-5">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="font-medium text-neutral-900 dark:text-white mb-1">Total Apresiasi</p>
                        <h6 class="mb-0 dark:text-white">$42,000</h6>
                    </div>
                    <div class="w-[50px] h-[50px] bg-success-600 rounded-full flex justify-center items-center">
                        <iconify-icon icon="gg:awards" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="font-medium text-sm text-neutral-600 dark:text-white mt-3 mb-0 flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 text-success-600 dark:text-success-400"><iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> 100</span>
                    Last 30 days operations
                </p>
            </div>
        </div>
    </div>

    {{-- Top Info Issue  --}}
    <div class="grid grid-cols-1 2xl:grid-cols-12 gap-6 py-8">

        <!-- Common Issues Start -->
        <div class="col-span-12 md:col-span-6 2xl:col-span-4">
            <div class="card border-0 h-full">
                <div class="card-header">
                    <div class="flex items-center flex-wrap gap-2 justify-between">
                        <h6 class="font-bold text-lg mb-0">Area Permasalahan</h6>
                        <a href="javascript:void(0)" class="text-primary-600 dark:text-primary-600 hover:text-primary-600 flex items-center gap-1">
                            View All
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="flex items-center justify-between gap-3 mb-[26px]">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg flex-shrink-0 bg-info-50 dark:bg-info-600/20 flex justify-center items-center">
                                <img src="{{ asset('assets/images/home-six/category-icon1.png') }}" alt="" class="">
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="text-base mb-0 font-normal">Web Development</h6>
                                <span class="text-sm text-neutral-600 font-normal">40+ Courses</span>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="w-6 h-6 bg-primary-600/10 text-primary-600 dark:text-primary-600 flex justify-center items-center text-lg hover:bg-primary-600/20 rounded">
                            <i class="ri-arrow-right-s-line"></i>
                        </a>
                    </div>
                    <div class="flex items-center justify-between gap-3 mb-[26px]">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg flex-shrink-0 bg-success-50 dark:bg-success-600/20 flex justify-center items-center">
                                <img src="{{ asset('assets/images/home-six/category-icon2.png') }}" alt="" class="">
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="text-base mb-0 font-normal">Graphic Design</h6>
                                <span class="text-sm text-neutral-600 font-normal">40+ Courses</span>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="w-6 h-6 bg-primary-600/10 text-primary-600 dark:text-primary-600 flex justify-center items-center text-lg hover:bg-primary-600/20 rounded">
                            <i class="ri-arrow-right-s-line"></i>
                        </a>
                    </div>
                    <div class="flex items-center justify-between gap-3 mb-[26px]">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg flex-shrink-0 bg-lilac-50 dark:bg-lilac-600/20 flex justify-center items-center">
                                <img src="{{ asset('assets/images/home-six/category-icon3.png') }}" alt="" class="">
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="text-base mb-0 font-normal">UI/UX Design</h6>
                                <span class="text-sm text-neutral-600 font-normal">40+ Courses</span>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="w-6 h-6 bg-primary-600/10 text-primary-600 dark:text-primary-600 flex justify-center items-center text-lg hover:bg-primary-600/20 rounded">
                            <i class="ri-arrow-right-s-line"></i>
                        </a>
                    </div>
                    <div class="flex items-center justify-between gap-3 mb-[26px]">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg flex-shrink-0 bg-warning-50 dark:bg-warning-600/20 flex justify-center items-center">
                                <img src="{{ asset('assets/images/home-six/category-icon4.png') }}" alt="" class="">
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="text-base mb-0 font-normal">Digital Marketing</h6>
                                <span class="text-sm text-neutral-600 font-normal">40+ Courses</span>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="w-6 h-6 bg-primary-600/10 text-primary-600 dark:text-primary-600 flex justify-center items-center text-lg hover:bg-primary-600/20 rounded">
                            <i class="ri-arrow-right-s-line"></i>
                        </a>
                    </div>
                    <div class="flex items-center justify-between gap-3 mb-[26px]">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg flex-shrink-0 bg-danger-50 dark:bg-danger-600/20 flex justify-center items-center">
                                <img src="{{ asset('assets/images/home-six/category-icon5.png') }}" alt="" class="">
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="text-base mb-0 font-normal">3d Illustration & Art Design</h6>
                                <span class="text-sm text-neutral-600 font-normal">40+ Courses</span>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="w-6 h-6 bg-primary-600/10 text-primary-600 dark:text-primary-600 flex justify-center items-center text-lg hover:bg-primary-600/20 rounded">
                            <i class="ri-arrow-right-s-line"></i>
                        </a>
                    </div>
                    <div class="flex items-center justify-between gap-3 mb-0">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg flex-shrink-0 bg-primary-600/10 flex justify-center items-center">
                                <img src="{{ asset('assets/images/home-six/category-icon6.png') }}" alt="" class="">
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="text-base mb-0 font-normal">Logo Design</h6>
                                <span class="text-sm text-neutral-600 font-normal">40+ Courses</span>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="w-6 h-6 bg-primary-600/10 text-primary-600 dark:text-primary-600 flex justify-center items-center text-lg hover:bg-primary-600/20 rounded">
                            <i class="ri-arrow-right-s-line"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <!-- Common Issues End -->
        
        <!-- Top Issue Category Start -->
        <div class="col-span-12 md:col-span-6 2xl:col-span-4">
            <div class="card border-0 h-full">
                <div class="card-header">
                    <div class="flex items-center flex-wrap gap-2 justify-between">
                        <h6 class="font-bold text-lg mb-0">Isu Berulang</h6>
                        <a href="javascript:void(0)" class="text-primary-600 dark:text-primary-600 hover:text-primary-600 flex items-center gap-1">
                            View All
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="flex items-center justify-between gap-3 mb-6">
                        <div class="flex items-center">
                            <img src="{{ asset('assets/images/home-six/student-img1.png') }}" alt="" class="w-10 h-10 rounded-lg flex-shrink-0 me-3 overflow-hidden">
                            <div class="flex-grow-1">
                                <h6 class="sm:text-base text-xs mb-0 font-medium">Theresa Webb</h6>
                                <span class="text-sm text-neutral-600 font-medium">UI/UX Design Course</span>
                            </div>
                        </div>
                        <div class="">
                            <span class="text-primary-light text-sm block text-right">
                                <svg class="radial-progress" data-percentage="33" viewBox="0 0 80 80">
                                    <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                                    <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
                                    <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">33</text>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between gap-3 mb-6">
                        <div class="flex items-center">
                            <img src="{{ asset('assets/images/home-six/student-img2.png') }}" alt="" class="w-10 h-10 rounded-lg flex-shrink-0 me-3 overflow-hidden">
                            <div class="flex-grow-1">
                                <h6 class="sm:text-base text-xs mb-0 font-medium">Robert Fox</h6>
                                <span class="text-sm text-neutral-600 font-medium">Graphic Design Course</span>
                            </div>
                        </div>
                        <div class="">
                            <span class="text-primary-light text-sm block text-right">
                                <svg class="radial-progress" data-percentage="70" viewBox="0 0 80 80">
                                    <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                                    <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
                                    <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">70</text>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between gap-3 mb-6">
                        <div class="flex items-center">
                            <img src="{{ asset('assets/images/home-six/student-img3.png') }}" alt="" class="w-10 h-10 rounded-lg flex-shrink-0 me-3 overflow-hidden">
                            <div class="flex-grow-1">
                                <h6 class="sm:text-base text-xs mb-0 font-medium">Guy Hawkins</h6>
                                <span class="text-sm text-neutral-600 font-medium">Web developer Course</span>
                            </div>
                        </div>
                        <div class="">
                            <span class="text-primary-light text-sm block text-right">
                                <svg class="radial-progress" data-percentage="80" viewBox="0 0 80 80">
                                    <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                                    <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
                                    <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">80</text>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between gap-3 mb-6">
                        <div class="flex items-center">
                            <img src="{{ asset('assets/images/home-six/student-img4.png') }}" alt="" class="w-10 h-10 rounded-lg flex-shrink-0 me-3 overflow-hidden">
                            <div class="flex-grow-1">
                                <h6 class="sm:text-base text-xs mb-0 font-medium">Cody Fisher</h6>
                                <span class="text-sm text-neutral-600 font-medium">UI/UX Design Course</span>
                            </div>
                        </div>
                        <div class="">
                            <span class="text-primary-light text-sm block text-right">
                                <svg class="radial-progress" data-percentage="20" viewBox="0 0 80 80">
                                    <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                                    <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
                                    <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">20</text>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between gap-3 mb-6">
                        <div class="flex items-center">
                            <img src="{{ asset('assets/images/home-six/student-img5.png') }}" alt="" class="w-10 h-10 rounded-lg flex-shrink-0 me-3 overflow-hidden">
                            <div class="flex-grow-1">
                                <h6 class="sm:text-base text-xs mb-0 font-medium">Jacob Jones</h6>
                                <span class="text-sm text-neutral-600 font-medium">UI/UX Design Course</span>
                            </div>
                        </div>
                        <div class="">
                            <span class="text-primary-light text-sm block text-right">
                                <svg class="radial-progress" data-percentage="40" viewBox="0 0 80 80">
                                    <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                                    <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
                                    <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">40</text>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between gap-3 mb-0">
                        <div class="flex items-center">
                            <img src="{{ asset('assets/images/home-six/student-img6.png') }}" alt="" class="w-10 h-10 rounded-lg flex-shrink-0 me-3 overflow-hidden">
                            <div class="flex-grow-1">
                                <h6 class="sm:text-base text-xs mb-0 font-medium">Darlene Robertson</h6>
                                <span class="text-sm text-neutral-600 font-medium">UI/UX Design Course</span>
                            </div>
                        </div>
                        <div class="">
                            <span class="text-primary-light text-sm block text-right">
                                <svg class="radial-progress" data-percentage="24" viewBox="0 0 80 80">
                                    <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                                    <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
                                    <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">24</text>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Issue Category End -->

        <div class="col-span-12 md:col-span-6 2xl:col-span-4">
            <div class="card border-0 h-full rounded-lg">
                <div class="card-body p-6 flex flex-col justify-between gap-8">
                    <div class="flex items-center flex-wrap gap-2 justify-between mb-5">
                        <h6 class="font-bold text-lg mb-0">Status Aksi</h6>
                        <select class="form-select form-select-sm w-auto bg-white dark:bg-neutral-800 dark:text-white border text-neutral-600">
                            <option>Tahun Ini</option>
                            <option>Bulan Ini</option>
                            <option>Minggu Ini</option>
                        </select>
                    </div>
                    <div id="userOverviewDonutChart" class="margin-16-minus y-value-left apexcharts-tooltip-z-none"></div>

                    <ul class="flex flex-wrap items-center justify-between mt-3 gap-3">
                        <li class="flex flex-col gap-2">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full
                                bg-warning-600"></span>
                                <span class="text-neutral-600 text-sm font-semibold">Organic Search</span>
                            </div>
                            <span class="text-primary-light font-bold">875</span>
                        </li>
                        <li class="flex flex-col gap-2">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full
                                bg-success-600"></span>
                                <span class="text-neutral-600 text-sm font-semibold">Referrals</span>
                            </div>
                            <span class="text-primary-light font-bold">450</span>
                        </li>
                        <li class="flex flex-col gap-2">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full
                                bg-primary-600"></span>
                                <span class="text-neutral-600 text-sm font-semibold">Social Media</span>
                            </div>
                            <span class="text-primary-light font-bold">4,305</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="card h-full p-0 rounded-xl border-0 overflow-hidden">
        <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
            <div class="flex items-center flex-wrap gap-3">
                <span class="text-base font-medium text-secondary-light mb-0">Aksi Terlambat</span>
            </div>
        </div>
        <div class="card-body p-6">
            <table id="overdue-action-table" class="border border-neutral-200 dark:border-neutral-600 rounded-lg border-separate	">
                <thead>
                    <tr>
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
                                Area
                                <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="text-neutral-800 dark:text-white">
                            <div class="flex items-center gap-2">
                                Batas Waktu
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($overdue_actions as $action)
                        <tr>
                            <td>
                                {{ $action->type }}
                            </td>
                            <td>
                                {{ $action->description }}
                            </td>
                            <td>
                                {{ $action->line }}
                            </td>
                            <td>
                                {{ $action->due_date }}
                            </td>
                            <td class="text-center">
                                <span class="bg-primary-100 dark:bg-primary-600/25 text-primary-600 dark:text-primary-400 px-8 py-1.5 rounded-full font-medium text-sm">
                                {{ $action->pic->name }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('user-script')
<script src="{{ asset('assets/js/data-table/analytic-overdue-action.js') }}"></script>

<script>
    
</script>
@endsection