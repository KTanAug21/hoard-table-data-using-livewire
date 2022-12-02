@extends('layouts.centered')
@section('content')
<div class="flex flex-col  items-center justify-center min-h-screen h-screen bg-gradient-to-b  from-green-300">
    <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl">
        <span class="text-transparent bg-clip-text bg-gradient-to-r to-pink-500 from-sky-400">
        Talk to Me
        </span>
    </h1>
    <div class="flex  items-center max-w-md mx-auto shadow rounded border-0 p-3">
        <livewire:talk-to-me />
    </div>
</div>
@stop