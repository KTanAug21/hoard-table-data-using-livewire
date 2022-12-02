@extends('layouts.centered')
@section('content')
    <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl">
        <span class="text-transparent bg-clip-text bg-gradient-to-r to-pink-500 from-sky-400">
        Talk to Me
        </span>
    </h1>
    <div class="flex  items-center max-w-md mx-auto shadow rounded border-0 p-3">
        <!--livewire:article-table /-->
        
        <livewire:search-compounder />
    </div>
@stop