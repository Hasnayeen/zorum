<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }} | @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Inter:400,500,600,700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles
    </head>
    <body class="">
        <div class="flex">
            {{-- Left Side bar --}}
            <div class="sticky top-0 min-h-screen max-h-screen w-56 flex flex-col">
                {{-- Logo --}}
                <div class="h-16 flex items-center bg-gray-800 text-white shadow-md">
                    <img src="{{ asset('images/logo.svg') }}" alt="logo" class="h-10 px-2">
                    <span class="text-4xl font-medium pl-1">Komla</span>
                </div>

                {{-- Menu --}}
                <div class="bg-gray-900 flex-grow shadow-md">
                    {{-- User Menu --}}
                    <div class="p-4 text-gray-300">
                        <a href="#" class="py-2 flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="pl-4 font-bold">
                                My Questions
                            </span>
                        </a>
                        <a href="#" class="py-2 flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="pl-4 font-bold">
                                My Answers
                            </span>
                        </a>
                        <a href="#" class="py-2 flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                            <span class="pl-4 font-bold">
                                Bookmarked
                            </span>
                        </a>
                    </div>
                    {{-- Activity Menu --}}
                    <div class="p-4 text-gray-300">
                        <a href="#" class="py-2 flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M5 13l4 4L19 7"></path></svg>
                            <span class="pl-4 font-bold">
                                Recent Answers
                            </span>
                        </a>
                        <a href="#" class="py-2 flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                            <span class="pl-4 font-bold">
                                No Reply Yet
                            </span>
                        </a>
                        <a href="#" class="py-2 flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                            <span class="pl-4 font-bold">
                                Most Popular
                            </span>
                        </a>
                    </div>
                </div>

                {{-- Bottom Profile Menu --}}
                <div class="h-16 bg-gray-800">
                    <a href="#" class="flex-shrink-0 w-full group block">
                        <div class="flex items-center">
                            <div class="h-16 flex items-center pl-2">
                                <img class="h-10 w-10 rounded-full" src="{{ asset('images/avatar.jpg') }}" alt="" />
                            </div>
                            <div class="ml-3">
                            <p class="text-sm leading-5 font-semibold text-white">
                                Nehal Hasnayeen
                            </p>
                            <p class="text-xs leading-4 font-medium text-gray-300 group-hover:text-gray-200 transition ease-in-out duration-150">
                                View profile
                            </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            {{-- Content area --}}
            <div class="flex-grow bg-gray-100">
                {{-- Navbar --}}
                <div class="h-16 bg-white shadow flex items-center justify-between sticky top-0">
                    {{-- Left Top Menu --}}
                    <div class="h-full flex items-center">
                        <a href="#" class="text-brand-500 border-b-2 border-brand-500 h-full flex items-center font-medium mx-6">
                            Latest
                        </a>
                        <a href="#" class="text-gray-600 mx-6">
                            Trending
                        </a>
                        <a href="#" class="text-gray-600 mx-6">
                            Categories
                        </a>
                        <a href="#" class="text-gray-600 mx-6">
                            Tags
                        </a>
                    </div>
                    {{-- Search Bar --}}
                    <div class="px-8 lg:w-96">
                        <div class="flex justify-between">
                            <div class="flex-1 flex items-center justify-center px-2 lg:justify-end lg:px-0">
                                <div class="max-w-lg w-full">
                                <label for="search" class="sr-only">Search</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                    </div>
                                    <input id="search" class="block w-full pl-10 pr-3 py-2 border border-gray-500 rounded-md leading-5 bg-white placeholder-gray-600 focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 focus:shadow-outline-blue sm:text-sm transition duration-150 ease-in-out" placeholder="Search" type="search" />
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex">
                    {{-- Category Menu --}}
                    <div class="bg-gray-200 w-64 shadow-md pl-2 shadow-md fixed h-full">
                        <div class="text-center py-4 text-sm font-medium text-gray-600 border-b border-gray-400">
                            Categories
                        </div>
                        {{-- List --}}
                        <div class="p-4 text-gray-600">
                            <div class="font-semibold text-sm text-gray-600 flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4"><path d="M19 9l-7 7-7-7"></path></svg>
                                <span class="pl-1">
                                    Tech
                                </span>
                            </div>
                            <a href="#" class="py-2 flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                                <span class="pl-2 font-bold">
                                    Laravel
                                </span>
                            </a>
                            <a href="#" class="py-2 flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                                <span class="pl-2 font-bold">
                                    TailwindCSS
                                </span>
                            </a>
                            <a href="#" class="py-2 flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                                <span class="pl-2 font-bold">
                                    Livewire
                                </span>
                            </a>
                        </div>
                        <div class="p-4 text-gray-600">
                            <div class="font-semibold text-sm text-gray-600 flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4"><path d="M19 9l-7 7-7-7"></path></svg>
                                <span class="pl-1">
                                    Help
                                </span>
                            </div>
                            <a href="#" class="py-2 flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                                <span class="pl-2 font-bold">
                                    Database
                                </span>
                            </a>
                            <a href="#" class="py-2 flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                                <span class="pl-2 font-bold">
                                    Testing
                                </span>
                            </a>
                            <a href="#" class="py-2 flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                                <span class="pl-2 font-bold">
                                    Server
                                </span>
                            </a>
                            <a href="#" class="py-2 flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                                <span class="pl-2 font-bold">
                                    Design
                                </span>
                            </a>
                        </div>
                        <div class="p-4 text-gray-600">
                            <div class="font-semibold text-sm text-gray-600 flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4"><path d="M19 9l-7 7-7-7"></path></svg>
                                <span class="pl-1">
                                    Community
                                </span>
                            </div>
                            <a href="#" class="py-2 flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                                <span class="pl-2 font-bold">
                                    Jobs
                                </span>
                            </a>
                            <a href="#" class="py-2 flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                                <span class="pl-2 font-bold">
                                    Showcase
                                </span>
                            </a>
                            <a href="#" class="py-2 flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                                <span class="pl-2 font-bold">
                                    Category Request
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="w-64"></div>

                    {{-- Main Content Area --}}
                    <div class="flex-grow pl-8 py-4">
                        <div class="bg-white rounded-md shadow">
                            <div class="flex items-center w-full">
                                <div class="flex-grow p-6 rounded-t-md">
                                    <div class="text-3xl text-gray-800 font-medium pb-2 flex items-center">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-600"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="pl-2">
                                            Complex validation logic 
                                        </span>
                                    </div>
                                    <div class="pb-2">
                                        I have a disclosure form that I only need to validate 2 fields out of six based on if the required q...
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="text-gray-700 text-sm">
                                            <a href="#" class="text-blue-700 text-base font-bold">Jonathan Taylor</a>
                                            asked <span class="font-semibold">15 min ago</span> in 
                                            <a href="#" class="text-blue-700 text-base font-bold">Server</a>
                                        </div>
                                        <div class="bg-brand-200 text-brand-800 px-4 py-1 text-sm rounded-full">
                                            Last activity: 2 hour ago
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center w-full border-t">
                                <div class="flex-grow p-6">
                                    <div class="text-3xl text-gray-800 font-medium pb-2 flex items-center">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-600"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="pl-2">
                                            Graphql similar library for laravel. 
                                        </span>
                                    </div>
                                    <div class="pb-2">
                                        I am trying to make GraphQL similar library for laravel. I would invited to all who want to contribu...
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="text-gray-700 text-sm">
                                            <a href="#" class="text-blue-700 text-base font-bold">Caleb Mudiro</a>
                                            asked <span class="font-semibold">15 min ago</span> in 
                                            <a href="#" class="text-blue-700 text-base font-bold">Server</a>
                                        </div>
                                        <div class="bg-brand-200 text-brand-800 px-4 py-1 text-sm rounded-full">
                                            Last activity: 2 hour ago
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center w-full border-t">
                                <div class="flex-grow p-6">
                                    <div class="text-3xl text-gray-800 font-medium pb-2 flex items-center">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-green-600"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="pl-2">
                                            How to Set Cookies During Unit Test? (new solution) 
                                        </span>
                                    </div>
                                    <div class="pb-2">
                                        I had the same problem working with laravel in version 5.5 presented in the thread erkanarslan, howe...
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="text-gray-700 text-sm">
                                            <a href="#" class="text-blue-700 text-base font-bold">Adam Schoger</a>
                                            asked <span class="font-semibold">15 min ago</span> in 
                                            <a href="#" class="text-blue-700 text-base font-bold">Server</a>
                                        </div>
                                        <div class="flex">
                                            <a href="" class="bg-green-200 text-green-800 px-4 py-1 text-sm rounded-full mr-2">
                                                View Solution
                                            </a>
                                            <div class="bg-brand-200 text-brand-800 px-4 py-1 text-sm rounded-full">
                                                Last activity: 2 hour ago
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center w-full border-2 border-brand-500">
                                <div class="flex-grow p-6">
                                    <div class="flex">
                                        <div class="text-brand-600 font-bold text-sm rounded-full flex items-center">
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                            <span class="pl-1">
                                                Trending
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-3xl text-gray-800 font-medium pb-2 flex items-center">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-green-600"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="pl-2">
                                            Best open source approach to build a pwa?
                                        </span>
                                    </div>
                                    <div class="pb-2">
                                        I am not very expert coder. I was looking for a (perhaps BaaS)solution to to save my app data which ...
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="text-gray-700 text-sm">
                                            <a href="#" class="text-blue-700 text-base font-bold">Jason Vints</a>
                                            asked <span class="font-semibold">15 min ago</span> in 
                                            <a href="#" class="text-blue-700 text-base font-bold">Server</a>
                                        </div>
                                        <div class="flex">
                                            <a href="" class="bg-green-200 text-green-800 px-4 py-1 text-sm rounded-full mr-2">
                                                View Solution
                                            </a>
                                            <div class="bg-brand-200 text-brand-800 px-4 py-1 text-sm rounded-full">
                                                Last activity: 2 hour ago
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center w-full border-t">
                                <div class="flex-grow p-6">
                                    <div class="text-3xl text-gray-800 font-medium pb-2 flex items-center">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-600"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="pl-2">
                                            Vapor deployment fail 
                                        </span>
                                    </div>
                                    <div class="pb-2">
                                        Hi! I'm using vapor to deploy laravel applications to AWS. The build step succeeds, but after it fai...
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="text-gray-700 text-sm">
                                            <a href="#" class="text-blue-700 text-base font-bold">John Doe</a>
                                            asked <span class="font-semibold">15 min ago</span> in 
                                            <a href="#" class="text-blue-700 text-base font-bold">Server</a>
                                        </div>
                                        <div class="bg-brand-200 text-brand-800 px-4 py-1 text-sm rounded-full">
                                            Last activity: 2 hour ago
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Side Column --}}
                    <div class="w-96 px-8 py-4">
                        {{-- Rules Card --}}
                        <div class="bg-white overflow-hidden shadow rounded text-gray-700 font-medium mb-4">
                            <div class="bg-indigo-100 px-4 py-4 sm:px-6 text-gray-600 font-semibold flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                                <span class="pl-2">
                                    Rules
                                </span>
                            </div>
                            <div class="px-4 py-3 sm:px-6 text-sm font-bold">
                                <div class="py-2">
                                    1. Be on topic
                                </div>
                                <div class="py-2">
                                    2. Do not use offensive language or be abusive
                                </div>
                                <div class="py-2">
                                    3. Do not cross post on channels
                                </div>
                            </div>
                        </div>

                        {{-- Top Contributors Card --}}
                        <div class="bg-white overflow-hidden shadow rounded text-gray-700 font-medium mb-4">
                            <div class="bg-indigo-100 px-4 py-4 sm:px-6 text-sm text-gray-600 font-semibold flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                <span class="pl-2">
                                    Top Contributors
                                </span>
                            </div>
                            <div class="px-4 py-3 sm:px-6">
                                <a href="#" class="flex-shrink-0 w-full group block">
                                    <div class="flex items-center">
                                        <div class="h-16 flex items-center pl-2">
                                            <img class="h-10 w-10 rounded-full" src="{{ asset('images/avatar.jpg') }}" alt="" />
                                        </div>
                                        <div class="ml-3">
                                        <p class="text-sm leading-5">
                                            <span class="font-bold text-lg">42</span> answers
                                        </p>
                                        <p class="text-sm leading-5">
                                            <span class="font-bold text-base">3500</span> total points
                                        </p>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="flex-shrink-0 w-full group block">
                                    <div class="flex items-center">
                                        <div class="h-16 flex items-center pl-2">
                                            <img class="h-10 w-10 rounded-full" src="{{ asset('images/15.jpg') }}" alt="" />
                                        </div>
                                        <div class="ml-3">
                                        <p class="text-sm leading-5">
                                            <span class="font-bold text-lg">39</span> answers
                                        </p>
                                        <p class="text-sm leading-5">
                                            <span class="font-bold text-base">3150</span> total points
                                        </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        {{-- Moderators Card --}}
                        <div class="bg-white overflow-hidden shadow rounded text-gray-700 font-medium mb-4">
                            <div class="bg-indigo-100 px-4 py-4 sm:px-6 text-sm text-gray-600 font-semibold flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="pl-2">
                                    Moderators
                                </span>
                            </div>
                            <div class="px-4 py-3 sm:px-6 flex">
                                <div class="flex relative z-0 overflow-hidden">
                                    <img class="relative z-30 inline-block h-10 w-10 rounded-full text-white shadow-solid" src="{{ asset('images/2.jpg') }}" alt="" />
                                    <img class="relative z-20 -ml-2 inline-block h-10 w-10 rounded-full text-white shadow-solid" src="{{ asset('images/15.jpg') }}" alt="" />
                                    <img class="relative z-10 -ml-2 inline-block h-10 w-10 rounded-full text-white shadow-solid" src="{{ asset('images/42.jpg') }}" alt="" />
                                    <img class="relative z-0 -ml-2 inline-block h-10 w-10 rounded-full text-white shadow-solid" src="{{ asset('images/2.jpg') }}" alt="" />
                                </div>
                            </div>
                        </div>

                        {{-- Community Sponsor Card --}}
                        <div class="bg-white overflow-hidden shadow rounded text-gray-700 font-medium mb-4">
                            <div class="bg-indigo-100 px-4 py-4 sm:px-6 text-gray-600 font-semibold flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8"><path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                <span class="pl-2">
                                    Sponsors
                                </span>
                            </div>
                            <div class="px-4 py-4 sm:px-6">
                                <div class="">
                                    <img src="{{ asset('images/sponsor.svg') }}" alt="sponsor logo" class="h-16">
                                </div>
                                <div class="py-2">
                                    StaticKit provides you everything you need to start your next business
                                </div>
                                <div class="py-2">
                                    <a href="#" class="text-brand-600 underline">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        @livewireScripts
    </body>
</html>
