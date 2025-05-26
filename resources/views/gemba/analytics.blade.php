@extends('layout.layout')
@php
    $title='Statistik Gemba';
    $subTitle = 'Gemba - Statistik';
    $script = '<script>
                        $(".delete-btn").on("click", function() {
                            $(this).closest(".user-grid-card").addClass("hidden")
                        });
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
                        <p class="font-medium text-neutral-900 dark:text-white mb-1">Active Issues</p>
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
                        <p class="font-medium text-neutral-900 dark:text-white mb-1">Closed Issues</p>
                        <h6 class="mb-0 dark:text-white">15,000</h6>
                    </div>
                    <div class="w-[50px] h-[50px] bg-purple-600 rounded-full flex justify-center items-center">
                        <iconify-icon icon="pajamas:issue-type-incident" class="text-white text-2xl mb-0"></iconify-icon>
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
                        <p class="font-medium text-neutral-900 dark:text-white mb-1">Overdue Actions</p>
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
                        <p class="font-medium text-neutral-900 dark:text-white mb-1">Total Appreciations</p>
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
    <div class="grid grid-cols-1 2xl:grid-cols-12 gap-6 pt-8">
        <!-- Top Categories Card border-0 Start -->
        <div class="col-span-12 md:col-span-6 2xl:col-span-4">
            <div class="card border-0 h-full">
                <div class="card-header">
                    <div class="flex items-center flex-wrap gap-2 justify-between">
                        <h6 class="font-bold text-lg mb-0">Top Categories</h6>
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
        <!-- Top Categories Card border-0 End -->
        <!-- Instructor Card border-0 Start -->
        <div class="col-span-12 md:col-span-6 2xl:col-span-4">
            <div class="card border-0">
                <div class="card-header">
                    <div class="flex items-center flex-wrap gap-2 justify-between">
                        <h6 class="font-bold text-lg mb-0">Top Instructors</h6>
                        <a href="javascript:void(0)" class="text-primary-600 dark:text-primary-600 hover:text-primary-600 flex items-center gap-1">
                            View All
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="flex items-center justify-between gap-3 mb-6">
                        <div class="flex items-center">
                            <img src="{{ asset('assets/images/users/user1.png') }}" alt="" class="w-10 h-10 rounded-full
                            flex-shrink-0 me-3 overflow-hidden">
                            <div class="flex-grow-1">
                                <h6 class="sm:text-base text-xs mb-0 font-medium">Dianne Russell</h6>
                                <span class="text-sm text-neutral-600 font-medium">Agent ID: 36254</span>
                            </div>
                        </div>
                        <div class="">
                            <div class="flex items-center gap-1.5 mb-1">
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                            </div>
                            <span class="text-primary-light text-sm block text-right">25 Reviews</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-3 mb-6">
                        <div class="flex items-center">
                            <img src="{{ asset('assets/images/users/user2.png') }}" alt="" class="w-10 h-10 rounded-full
                            flex-shrink-0 me-3 overflow-hidden">
                            <div class="flex-grow-1">
                                <h6 class="sm:text-base text-xs mb-0 font-medium">Wade Warren</h6>
                                <span class="text-sm text-neutral-600 font-medium">Agent ID: 36254</span>
                            </div>
                        </div>
                        <div class="">
                            <div class="flex items-center gap-1.5 mb-1">
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                            </div>
                            <span class="text-primary-light text-sm block text-right">25 Reviews</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-3 mb-6">
                        <div class="flex items-center">
                            <img src="{{ asset('assets/images/users/user3.png') }}" alt="" class="w-10 h-10 rounded-full
                            flex-shrink-0 me-3 overflow-hidden">
                            <div class="flex-grow-1">
                                <h6 class="sm:text-base text-xs mb-0 font-medium">Albert Flores</h6>
                                <span class="text-sm text-neutral-600 font-medium">Agent ID: 36254</span>
                            </div>
                        </div>
                        <div class="">
                            <div class="flex items-center gap-1.5 mb-1">
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                            </div>
                            <span class="text-primary-light text-sm block text-right">25 Reviews</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-3 mb-6">
                        <div class="flex items-center">
                            <img src="{{ asset('assets/images/users/user4.png') }}" alt="" class="w-10 h-10 rounded-full
                            flex-shrink-0 me-3 overflow-hidden">
                            <div class="flex-grow-1">
                                <h6 class="sm:text-base text-xs mb-0 font-medium">Bessie Cooper</h6>
                                <span class="text-sm text-neutral-600 font-medium">Agent ID: 36254</span>
                            </div>
                        </div>
                        <div class="">
                            <div class="flex items-center gap-1.5 mb-1">
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                            </div>
                            <span class="text-primary-light text-sm block text-right">25 Reviews</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-3 mb-6">
                        <div class="flex items-center">
                            <img src="{{ asset('assets/images/users/user5.png') }}" alt="" class="w-10 h-10 rounded-full
                            flex-shrink-0 me-3 overflow-hidden">
                            <div class="flex-grow-1">
                                <h6 class="sm:text-base text-xs mb-0 font-medium">Arlene McCoy</h6>
                                <span class="text-sm text-neutral-600 font-medium">Agent ID: 36254</span>
                            </div>
                        </div>
                        <div class="">
                            <div class="flex items-center gap-1.5 mb-1">
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                            </div>
                            <span class="text-primary-light text-sm block text-right">25 Reviews</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center">
                            <img src="{{ asset('assets/images/users/user1.png') }}" alt="" class="w-10 h-10 rounded-full
                            flex-shrink-0 me-3 overflow-hidden">
                            <div class="flex-grow-1">
                                <h6 class="sm:text-base text-xs mb-0 font-medium">Arlene McCoy</h6>
                                <span class="text-sm text-neutral-600 font-medium">Agent ID: 36254</span>
                            </div>
                        </div>
                        <div class="">
                            <div class="flex items-center gap-1.5 mb-1">
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                                <span class="text-lg text-warning-600 dark:text-warning-600 flex line-height-1"><i class="ri-star-fill"></i></span>
                            </div>
                            <span class="text-primary-light text-sm block text-right">25 Reviews</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Instructor Card border-0 End -->
        <!-- Student Progress Card border-0 Start -->
        <div class="col-span-12 md:col-span-6 2xl:col-span-4">
            <div class="card border-0 h-full">
                <div class="card-header">
                    <div class="flex items-center flex-wrap gap-2 justify-between">
                        <h6 class="font-bold text-lg mb-0">Student's Progress</h6>
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
        <!-- Student Progress Card border-0 End -->
    </div>

    <div class="card h-full p-0 rounded-xl border-0 overflow-hidden">
        <div class="card-header border-b border-neutral-200 dark:border-neutral-600 bg-white dark:bg-neutral-700 py-4 px-6 flex items-center flex-wrap gap-3 justify-between">
            <div class="flex items-center flex-wrap gap-3">
                <span class="text-base font-medium text-secondary-light mb-0">Tampilkan</span>
                <select class="form-select form-select-sm w-auto dark:bg-neutral-600 dark:text-white border-neutral-200 dark:border-neutral-500 rounded-lg">
                    <option>10</option>
                    <option>20</option>
                    <option>30</option>
                    <option>40</option>
                    <option>50</option>
                    <option>60</option>
                    <option>70</option>
                    <option>80</option>
                    <option>90</option>
                    <option>10</option>
                </select>
                <form class="navbar-search">
                    <input type="text" class="bg-white dark:bg-neutral-700 h-10 w-auto" name="search" placeholder="Cari Pengguna">
                    <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                </form>
            </div>
            <button  class="btn btn-primary text-sm btn-sm px-3 py-3 rounded-lg flex items-center gap-2" data-modal-target="default-modal" data-modal-toggle="default-modal">
                <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                Tambahkan Pengguna Baru
            </button>
        </div>
        <div class="card-body p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 3xl:grid-cols-4 gap-6">
                
            </div>
            <div class="flex items-center justify-between flex-wrap gap-2 mt-6">
                <span>Menampilkan 1 sampai 10 dari 12 pengguna</span>
                <ul class="pagination flex flex-wrap items-center gap-2 justify-center">
                    <li class="page-item">
                        <a class="page-link bg-neutral-300 dark:bg-neutral-600 text-secondary-light font-semibold rounded-lg border-0 flex items-center justify-center h-8 w-8 text-base" href="javascript:void(0)"><iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon></a>
                    </li>
                    <li class="page-item">
                        <a class="page-link text-secondary-light font-semibold rounded-lg border-0 flex items-center justify-center h-8 w-8 text-base bg-primary-600 text-white" href="javascript:void(0)">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link bg-neutral-300 dark:bg-neutral-600 text-secondary-light font-semibold rounded-lg border-0 flex items-center justify-center h-8 w-8" href="javascript:void(0)">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link bg-neutral-300 dark:bg-neutral-600 text-secondary-light font-semibold rounded-lg border-0 flex items-center justify-center h-8 w-8 text-base" href="javascript:void(0)">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link bg-neutral-300 dark:bg-neutral-600 text-secondary-light font-semibold rounded-lg border-0 flex items-center justify-center h-8 w-8 text-base" href="javascript:void(0)">4</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link bg-neutral-300 dark:bg-neutral-600 text-secondary-light font-semibold rounded-lg border-0 flex items-center justify-center h-8 w-8 text-base" href="javascript:void(0)">5</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link bg-neutral-300 dark:bg-neutral-600 text-secondary-light font-semibold rounded-lg border-0 flex items-center justify-center h-8 w-8 text-base" href="javascript:void(0)"> <iconify-icon icon="ep:d-arrow-right" class=""></iconify-icon> </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Main modal -->
    <div id="default-modal" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full  max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-dark-2">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white"> Tambahkan Pengguna Baru </h3>
                    <button id="btn-close-default-modal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Tutup Formulir</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <form id="user-form" action="{{ route("users.create") }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Nama Pengguna</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama pengguna " id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Email</label>
                            <input type="text" class="form-control" placeholder="Masukan alamat email" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="department" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Departemen</label>
                            <select class="form-control" id="department" name="department" required>
                                <option value="manufacture">Manufaktur</option>
                                <option value="qc">Quality Control</option>
                                <option value="management">Manajemen</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="superadmin">Superadmin</option>
                                <option value="admin">Admin</option>
                                <option value="user">Karyawan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="inline-block font-semibold text-neutral-600 dark:text-neutral-200 text-sm mb-2">Kata Sandi</label>
                            <div class="relative mb-5">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Buat kata sandi default">
                                <span class="toggle-password ri-eye-line cursor-pointer absolute end-0 top-1/2 -translate-y-1/2 me-4 text-secondary-light" data-toggle="#your-password"></span>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="flex items-center gap-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button id="btn-cancel-default-modal" type="button" data-modal-hide="default-modal" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-base px-[50px] py-[11px] rounded-lg" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button id="btn-submit-default-modal" type="submit" class="btn btn-primary border border-primary-600 text-base px-7 py-3 rounded-lg" id="saveTaskButton">
                        Tambahkan Pengguna
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('user-script')
<script>
    // Open Modal 
    $("#btn-open-default-modal").on("click", function() {
        $("#default-modal").removeClass("hidden").addClass("flex");

        $("#user-form")[0].reset()
    });

    // Close Modal
    $("#btn-close-default-modal").on("click", function() {
        $("#default-modal").removeClass("flex").addClass("hidden");
    });

    $("#btn-cancel-default-modal").on("click", function() {
        $("#default-modal").removeClass("flex").addClass("hidden");
    });

    // Form Process 
    $('#btn-submit-default-modal').on('click', function(e) {
        e.preventDefault();

        $('#user-form').submit();
    });
</script>
@endsection