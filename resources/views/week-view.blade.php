<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center border-gray-200 px-6 py-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Week') }}
            </h2>
        </div>
    </x-slot>

    <div class="flex justify-center p-4">
        <div class="w-full max-w-4xl p-4">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden max-h-screen p-4">
                <div class="isolate flex flex-auto flex-col overflow-y-auto" style="max-height: 950px;">
                    <header class="flex flex-none items-center justify-between border-b border-gray-200 px-6 py-4">

                        <!-- Header controls -->
                        <div class="flex items-center space-x-2"> <!-- Add space between buttons if needed -->
                            <a href="{{ url()->current() . '?date=' . $previousWeek }}"
                                class="flex h-9 w-12 items-center justify-center rounded-l-md border-y border-l border-gray-300 pr-1 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:pr-0 md:hover:bg-gray-50">
                                <span class="sr-only">Previous week</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            {{-- <button type="button"
                                    class="hidden border-y border-gray-300 px-3.5 text-sm font-semibold text-gray-900 hover:bg-gray-50 focus:relative md:block">Week
                            </button> --}}
                            <span class="relative -mx-px h-5 w-px bg-gray-300 md:hidden"></span>
                            <a a href="{{ url()->current() . '?date=' . $nextWeek }}"
                                class="flex h-9 w-12 items-center justify-center rounded-r-md border-y border-r border-gray-300 pl-1 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:pl-0 md:hover:bg-gray-50">
                                <span class="sr-only">Next week</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>

                            <div class="relative inline-block text-left">
                                <button id="menu-button" type="button"
                                    class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                    aria-expanded="true" aria-haspopup="true">
                                    Week view
                                    <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <x-period-dropdown></x-period-dropwdown>

                                <button type="button"
                                    class="ml-6 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                                    Add event
                                </button>
                            </div>

                            <h1 class="text-base font-semibold leading-6 text-gray-900 ml-auto">
                                <time id="current-date" datetime="{{ $currentDate->format('Y-m') }}"
                                    data-date="{{ $currentDate }}">{{ $currentDate->format('F Y') }}</time>
                            </h1>

                    </header>


                    @php
                        $startOfWeek = $currentDate->startOfWeek();
                    @endphp

                    <div class="isolate flex flex-auto flex-col overflow-auto bg-white">
                        <div style="width: 165%" class="flex max-w-full flex-none flex-col sm:max-w-none md:max-w-full">
                            <div
                                class="sticky top-0 z-30 flex-none bg-white shadow ring-1 ring-black ring-opacity-5 sm:pr-8">
                                <div class="grid grid-cols-7 text-sm leading-6 text-gray-500 sm:hidden">
                                    @for ($i = 0; $i < 7; $i++)
                                        @php
                                            $day = $startOfWeek->copy()->addDays($i);
                                        @endphp
                                        <button type="button" class="flex flex-col items-center pb-3 pt-2">
                                            {{ $day->format('D') }} <span
                                                class="mt-1 flex h-8 w-8 items-center justify-center font-semibold text-gray-900">{{ $day->format('d') }}</span>
                                        </button>
                                    @endfor
                                </div>

                                <div
                                    class="-mr-px hidden grid-cols-7 divide-x divide-gray-100 border-r border-gray-100 text-sm leading-6 text-gray-500 sm:grid">
                                    <div class="col-end-1 w-14"></div>
                                    @for ($i = 0; $i < 7; $i++)
                                        @php
                                            $day = $startOfWeek->copy()->addDays($i);
                                        @endphp
                                        <div class="flex items-center justify-center py-3">
                                            <span>{{ $day->format('D') }} <span
                                                    class="items-center justify-center font-semibold text-gray-900">{{ $day->format('d') }}</span></span>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="flex flex-auto">
                                <div class="sticky left-0 z-10 w-14 flex-none bg-white ring-1 ring-gray-100"></div>
                                <div class="grid flex-auto grid-cols-1 grid-rows-1">
                                    <!-- Horizontal lines -->
                                    <div class="col-start-1 col-end-2 row-start-1 grid divide-y divide-gray-100"
                                        style="grid-template-rows: repeat(48, minmax(3.5rem, 1fr))">
                                        <div class="row-end-1 h-7"></div>
                                        @for ($i = 0; $i < 24; $i++)
                                            <div>
                                                <div
                                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">
                                                    {{ \Carbon\Carbon::createFromTime($i)->format('ga') }}
                                                </div>
                                            </div>
                                            <div></div>
                                        @endfor
                                    </div>

                                    <div
                                        class="col-start-1 col-end-2 row-start-1 hidden grid-cols-7 grid-rows-1 divide-x divide-gray-100 sm:grid sm:grid-cols-7">
                                        @for ($i = 0; $i < 7; $i++)
                                            <div class="col-start-{{ $i + 1 }} row-span-full"></div>
                                        @endfor
                                        <div class="col-start-8 row-span-full w-8"></div>
                                    </div>


                                    <!-- Events -->
                                    <x-event-li-elements :events="$events"> </x-event-li-elements>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.getElementById('menu-button');
        const menu = document.getElementById('dropdown-menu');

        menuButton.addEventListener('click', function() {
            menu.classList.toggle('hidden');
        });

        document.addEventListener('click', function(event) {
            if (!menuButton.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    });
</script>
