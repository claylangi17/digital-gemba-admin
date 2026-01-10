<div class="navbar-header border-b border-neutral-200 dark:border-neutral-600">
    <div class="flex items-center justify-between">
        <div class="col-auto">
            <div class="flex flex-wrap items-center gap-[16px]">
                <button type="button" class="sidebar-toggle">
                    <iconify-icon icon="heroicons:bars-3-solid" class="icon non-active"></iconify-icon>
                    <iconify-icon icon="iconoir:arrow-right" class="icon active"></iconify-icon>
                </button>
                <button type="button" class="sidebar-mobile-toggle d-flex !leading-[0]">
                    <iconify-icon icon="heroicons:bars-3-solid" class="icon !text-[30px]"></iconify-icon>
                </button>

            </div>
        </div>
        <div class="col-auto">
            <div class="flex flex-wrap items-center gap-3">
                @livewire('Switch.ThemeMode')

                @if(Auth::user()->role == 'superadmin')
                    @php
                        $factories = \App\Models\Factory::all();
                        $currentFactoryId = session('viewing_factory_id');
                        $currentFactoryName = $currentFactoryId ? $factories->where('id', $currentFactoryId)->first()->name : 'Semua Pabrik';
                    @endphp
                    <div class="relative">
                        <button data-dropdown-toggle="dropdownFactory" class="flex items-center gap-2 px-3 py-2 bg-gray-100 dark:bg-neutral-700 rounded-lg text-sm font-medium hover:bg-gray-200 dark:hover:bg-neutral-600 transition" type="button">
                            <iconify-icon icon="mdi:factory" class="text-lg"></iconify-icon>
                            {{ $currentFactoryName }}
                            <iconify-icon icon="mdi:chevron-down" class="text-sm"></iconify-icon>
                        </button>
                        <div id="dropdownFactory" class="z-10 hidden bg-white dark:bg-neutral-700 rounded-lg shadow-lg dropdown-menu w-48 p-1">
                            <ul class="flex flex-col text-sm">
                                <li>
                                    <form action="{{ route('dashboard.set-factory') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="factory_id" value="">
                                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-neutral-600 rounded flex items-center gap-2 {{ !$currentFactoryId ? 'text-primary-600 font-bold' : '' }}">
                                            <iconify-icon icon="mdi:earth"></iconify-icon>
                                            Semua Pabrik
                                        </button>
                                    </form>
                                </li>
                                @foreach($factories as $factory)
                                <li>
                                    <form action="{{ route('dashboard.set-factory') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="factory_id" value="{{ $factory->id }}">
                                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-neutral-600 rounded flex items-center gap-2 {{ $currentFactoryId == $factory->id ? 'text-primary-600 font-bold' : '' }}">
                                            <iconify-icon icon="mdi:office-building"></iconify-icon>
                                            {{ $factory->name }}
                                        </button>
                                    </form>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                
                {{-- Profile Menu : start  --}}
                <button data-dropdown-toggle="dropdownProfile" class="flex justify-center items-center rounded-full" type="button">
                    <img src="{{ get_user_avatar(Auth::user(), 40) }}" alt="image" class="w-10 h-10 object-fit-cover rounded-full">
                </button>
                <div id="dropdownProfile" class="z-10 hidden bg-white dark:bg-neutral-700 rounded-lg shadow-lg dropdown-menu-sm p-3">
                    <div class="py-3 px-4 rounded-lg bg-primary-50 dark:bg-primary-600/25 mb-4 flex items-center justify-between gap-2">
                        <div>
                            <h6 class="text-lg text-neutral-900 font-semibold mb-0"> {{ Auth::user()->name }} </h6>
                            <span class="text-neutral-500">{{ Auth::user()->role }}</span>
                        </div>
                    </div>

                    <div class="max-h-[400px] overflow-y-auto scroll-sm pe-2">
                        <ul class="flex flex-col">
                            <li>
                                <button onclick="Livewire.dispatch('showModalViewUser', { id: '{{ Auth::user()->id }}'})" class="text-black dark:text-white px-0 py-2 hover:text-primary-600 dark:hover:text-primary-600 flex items-center gap-4" href="#">
                                    <iconify-icon icon="solar:user-linear" class="icon text-xl"></iconify-icon>  My Profile
                                </button>
                            </li>
                            <li>
                                <a class="text-black dark:text-white px-0 py-2 hover:text-danger-600 dark:hover:text-danger-600 flex items-center gap-4" href="{{ route('auth.logout.attempt') }}">
                                    <iconify-icon icon="lucide:power" class="icon text-xl"></iconify-icon>  Log Out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                {{-- Profile Menu : end  --}}

            </div>
        </div>
    </div>
</div>