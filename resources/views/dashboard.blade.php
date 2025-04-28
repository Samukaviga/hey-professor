<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vote for a question') }}
        </h2>
    </x-slot>

    <x-container>


        <hr class="border-gray-700 mt-2">

        <div class="dark:text-gray-300 font-bold my-2 uppercase">List of Questions</div>

        <div class="dark:text-gray-500 space-y-4">

            @foreach ($questions as $item)

                <x-question :question="$item" />

            @endforeach

        </div>



    </x-container>



</x-app-layout>