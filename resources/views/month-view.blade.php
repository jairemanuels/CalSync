<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center border-gray-200 px-6 py-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Maand') }}
            </h2>
        </div>
    </x-slot>

    <div class="flex justify-center p-4">
        <div class="w-full max-w-4xl p-4">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden max-h-screen p-4">
                <div class="isolate flex flex-auto flex-col overflow-y-auto" style="max-height: 750px;">
                    <header class="flex flex-none items-center justify-between border-b border-gray-200 px-6 py-4">

                        <!-- Header controls -->
                        <div class="flex items-center space-x-2"> <!-- Add space between buttons if needed -->
                            <a href="?date={{ $previousMonth }}"
                                class="flex h-9 w-12 items-center justify-center rounded-l-md border-y border-l border-gray-300 pr-1 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:pr-0 md:hover:bg-gray-50">
                                <span class="sr-only">Previous month</span>
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
                            <a href="?date={{ $nextMonth }}"
                                class="flex h-9 w-12 items-center justify-center rounded-r-md border-y border-r border-gray-300 pl-1 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:pl-0 md:hover:bg-gray-50">
                                <span class="sr-only">Next month</span>
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
                                    Month view
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
        <div class="shadow ring-1 ring-black ring-opacity-5 lg:flex lg:flex-auto lg:flex-col">

            <div
                class="grid grid-cols-7 gap-px border-b border-gray-300 bg-gray-200 text-center text-xs font-semibold leading-6 text-gray-700 lg:flex-none">
                <div class="flex justify-center bg-white py-2">
                    <span>M</span>
                    <span class="sr-only sm:not-sr-only">on</span>
                </div>
                <div class="flex justify-center bg-white py-2">
                    <span>T</span>
                    <span class="sr-only sm:not-sr-only">ue</span>
                </div>
                <div class="flex justify-center bg-white py-2">
                    <span>W</span>
                    <span class="sr-only sm:not-sr-only">ed</span>
                </div>
                <div class="flex justify-center bg-white py-2">
                    <span>T</span>
                    <span class="sr-only sm:not-sr-only">hu</span>
                </div>
                <div class="flex justify-center bg-white py-2">
                    <span>F</span>
                    <span class="sr-only sm:not-sr-only">ri</span>
                </div>
                <div class="flex justify-center bg-white py-2">
                    <span>S</span>
                    <span class="sr-only sm:not-sr-only">at</span>
                </div>
                <div class="flex justify-center bg-white py-2">
                    <span>S</span>
                    <span class="sr-only sm:not-sr-only">un</span>
                </div>
            </div>

            {{-- Voor iedere kolom pakken we de events op die dag voor de komende 6 dagen --}}



            <div class="flex bg-gray-200 text-xs leading-6 text-gray-700 lg:flex-auto">
                <div class="hidden w-full lg:grid lg:grid-cols-7 lg:grid-rows-6 lg:gap-px">

                    @foreach ($days as $day)
                        <div
                        {{-- if its the day, create a blue circle around the text -> {{$day['isCurrentDay'] ? 'bg-blue' : ''}}" --}}
                            class="relative bg-gray-50 px-3 py-2 text-gray-500 {{$day['isCurrentMonth'] ? 'bg-white' : ''}}>
                            <time datetime="{{ $day['date']->format('Y-m-d') }}">{{ $day['date']->format('d') }} </time>
                            <ol class="mt-2">
                                @foreach ($day['events'] as $event)
                                    <li>
                                        <a href="#" class="group flex">
                                            <p
                                                class="flex-auto truncate font-medium text-gray-900 group-hover:text-indigo-600">
                                                {{ $event->name }}</p>
                                            {{-- <time datetime="{{ $event->event_time_start->format('Y-m-d\TH:i') }}"
                                                class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block">
                                                {{ $event->event_time_start->format('H:i') }}</time> --}}
                                        </a>
                                    </li>
                                @endforeach
                                {{-- <li>
                                    <a href="#" class="group flex">
                                        <p
                                            class="flex-auto truncate font-medium text-gray-900 group-hover:text-indigo-600">
                                            Design review</p>
                                        <time datetime="2022-01-03T10:00"
                                            class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block">10AM</time>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="group flex">
                                        <p
                                            class="flex-auto truncate font-medium text-gray-900 group-hover:text-indigo-600">
                                            Sales meeting</p>
                                        <time datetime="2022-01-03T14:00"
                                            class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block">2PM</time>
                                    </a>
                                </li> --}}
                            </ol>
                        </div>
                    @endforeach

                    <!--
                Always include: "relative py-2 px-3"
                Is current month, include: "bg-white"
                Is not current month, include: "bg-gray-50 text-gray-500"
              -->
                    {{-- <div class="relative bg-gray-50 px-3 py-2 text-gray-500">
                        <!--
                  Is today, include: "flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600 font-semibold text-white"
                -->
                        <time datetime="2021-12-27">27</time>
                    </div>
                    <div class="relative bg-gray-50 px-3 py-2 text-gray-500">
                        <time datetime="2021-12-28">28</time>
                    </div>
                    <div class="relative bg-gray-50 px-3 py-2 text-gray-500">
                        <time datetime="2021-12-29">29</time>
                    </div>
                    <div class="relative bg-gray-50 px-3 py-2 text-gray-500">
                        <time datetime="2021-12-30">30</time>
                    </div>
                    <div class="relative bg-gray-50 px-3 py-2 text-gray-500">
                        <time datetime="2021-12-31">31</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-01">1</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-01">2</time>
                    </div> --}}
                    {{-- <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-03">3</time>
                        <ol class="mt-2">
                            <li>
                                <a href="#" class="group flex">
                                    <p
                                        class="flex-auto truncate font-medium text-gray-900 group-hover:text-indigo-600">
                                        Design review</p>
                                    <time datetime="2022-01-03T10:00"
                                        class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block">10AM</time>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="group flex">
                                    <p
                                        class="flex-auto truncate font-medium text-gray-900 group-hover:text-indigo-600">
                                        Sales meeting</p>
                                    <time datetime="2022-01-03T14:00"
                                        class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block">2PM</time>
                                </a>
                            </li>
                        </ol>
                    </div> --}}
                    {{-- <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-04">4</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-05">5</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-06">6</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-07">7</time>
                        <ol class="mt-2">
                            <li>
                                <a href="#" class="group flex">
                                    <p
                                        class="flex-auto truncate font-medium text-gray-900 group-hover:text-indigo-600">
                                        Date night</p>
                                    <time datetime="2022-01-08T18:00"
                                        class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block">6PM</time>
                                </a>
                            </li>
                        </ol>
                    </div> --}}
                    {{-- <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-08">8</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-09">9</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-10">10</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-11">11</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-12"
                            class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600 font-semibold text-white">12</time>
                        <ol class="mt-2">
                            <li>
                                <a href="#" class="group flex">
                                    <p
                                        class="flex-auto truncate font-medium text-gray-900 group-hover:text-indigo-600">
                                        Sam's birthday party</p>
                                    <time datetime="2022-01-25T14:00"
                                        class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block">2PM</time>
                                </a>
                            </li>
                        </ol>
                    </div> --}}
                    {{-- <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-13">13</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-14">14</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-15">15</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-16">16</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-17">17</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-18">18</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-19">19</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-20">20</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-21">21</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-22">22</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-23">23</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-24">24</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-25">25</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-26">26</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-27">27</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-28">28</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-29">29</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-30">30</time>
                    </div>
                    <div class="relative bg-white px-3 py-2">
                        <time datetime="2022-01-31">31</time>
                    </div>
                    <div class="relative bg-gray-50 px-3 py-2 text-gray-500">
                        <time datetime="2022-02-01">1</time>
                    </div>
                    <div class="relative bg-gray-50 px-3 py-2 text-gray-500">
                        <time datetime="2022-02-02">2</time>
                    </div>
                    <div class="relative bg-gray-50 px-3 py-2 text-gray-500">
                        <time datetime="2022-02-03">3</time>
                    </div>
                    <div class="relative bg-gray-50 px-3 py-2 text-gray-500">
                        <time datetime="2022-02-04">4</time>
                        <ol class="mt-2">
                            <li>
                                <a href="#" class="group flex">
                                    <p
                                        class="flex-auto truncate font-medium text-gray-900 group-hover:text-indigo-600">
                                        Cinema with friends</p>
                                    <time datetime="2022-02-04T21:00"
                                        class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block">9PM</time>
                                </a>
                            </li>
                        </ol>
                    </div>
                    <div class="relative bg-gray-50 px-3 py-2 text-gray-500">
                        <time datetime="2022-02-05">5</time>
                    </div>
                    <div class="relative bg-gray-50 px-3 py-2 text-gray-500">
                        <time datetime="2022-02-06">6</time>
                    </div> --}}
                </div>
                <div class="isolate grid w-full grid-cols-7 grid-rows-6 gap-px lg:hidden">
                    <!--
                Always include: "flex h-14 flex-col py-2 px-3 hover:bg-gray-100 focus:z-10"
                Is current month, include: "bg-white"
                Is not current month, include: "bg-gray-50"
                Is selected or is today, include: "font-semibold"
                Is selected, include: "text-white"
                Is not selected and is today, include: "text-indigo-600"
                Is not selected and is current month, and is not today, include: "text-gray-900"
                Is not selected, is not current month, and is not today: "text-gray-500"
              -->
                    <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">
                        <!--
                  Always include: "ml-auto"
                  Is selected, include: "flex h-6 w-6 items-center justify-center rounded-full"
                  Is selected and is today, include: "bg-indigo-600"
                  Is selected and is not today, include: "bg-gray-900"
                -->
                        <time datetime="2021-12-27" class="ml-auto">27</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">
                        <time datetime="2021-12-28" class="ml-auto">28</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">
                        <time datetime="2021-12-29" class="ml-auto">29</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">
                        <time datetime="2021-12-30" class="ml-auto">30</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">
                        <time datetime="2021-12-31" class="ml-auto">31</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-01" class="ml-auto">1</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-02" class="ml-auto">2</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-03" class="ml-auto">3</time>
                        <span class="sr-only">2 events</span>
                        <span class="-mx-0.5 mt-auto flex flex-wrap-reverse">
                            <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                            <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                        </span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-04" class="ml-auto">4</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-05" class="ml-auto">5</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-06" class="ml-auto">6</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-07" class="ml-auto">7</time>
                        <span class="sr-only">1 event</span>
                        <span class="-mx-0.5 mt-auto flex flex-wrap-reverse">
                            <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                        </span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-08" class="ml-auto">8</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-09" class="ml-auto">9</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-10" class="ml-auto">10</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-11" class="ml-auto">11</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 font-semibold text-indigo-600 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-12" class="ml-auto">12</time>
                        <span class="sr-only">1 event</span>
                        <span class="-mx-0.5 mt-auto flex flex-wrap-reverse">
                            <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                        </span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-13" class="ml-auto">13</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-14" class="ml-auto">14</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-15" class="ml-auto">15</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-16" class="ml-auto">16</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-17" class="ml-auto">17</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-18" class="ml-auto">18</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-19" class="ml-auto">19</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-20" class="ml-auto">20</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-21" class="ml-auto">21</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 font-semibold text-white hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-22"
                            class="ml-auto flex h-6 w-6 items-center justify-center rounded-full bg-gray-900">22</time>
                        <span class="sr-only">2 events</span>
                        <span class="-mx-0.5 mt-auto flex flex-wrap-reverse">
                            <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                            <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                        </span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-23" class="ml-auto">23</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-24" class="ml-auto">24</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-25" class="ml-auto">25</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-26" class="ml-auto">26</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-27" class="ml-auto">27</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-28" class="ml-auto">28</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-29" class="ml-auto">29</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-30" class="ml-auto">30</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-white px-3 py-2 text-gray-900 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-01-31" class="ml-auto">31</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-02-01" class="ml-auto">1</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-02-02" class="ml-auto">2</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-02-03" class="ml-auto">3</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-02-04" class="ml-auto">4</time>
                        <span class="sr-only">1 event</span>
                        <span class="-mx-0.5 mt-auto flex flex-wrap-reverse">
                            <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                        </span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-02-05" class="ml-auto">5</time>
                        <span class="sr-only">0 events</span>
                    </button>
                    <button type="button"
                        class="flex h-14 flex-col bg-gray-50 px-3 py-2 text-gray-500 hover:bg-gray-100 focus:z-10">
                        <time datetime="2022-02-06" class="ml-auto">6</time>
                        <span class="sr-only">0 events</span>
                    </button>
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
