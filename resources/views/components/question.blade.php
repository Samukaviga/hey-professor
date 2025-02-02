@props([
    'question',
])

<div
    class="rounded bg-white dark:bg-gray-800/50 shadow shadow-blue-500/50 p-4 dark:text-gray-500 flex justify-between items-center ">

    <span>{{ $question->question }}</span>


    <div>

        <x-form :action="route('question.like', $question)" class="flex space-x-1 mb-1 items-center text-green-500">
            <button class="flex space-x-1 mb-1 items-center text-green-500">
                <x-icons.thumbs-up class="w-5 h-5 hover:text-green-300 cursor-pointer" />

                <span>{{ $question->votes_sum_like ? $question->votes_sum_like : 0 }}</span>
            </button>
        </x-form>

        <x-form :action="route('question.inlike', $question)">
            <button class="flex space-x-1 mb-1 items-center text-red-500">
                <x-icons.thumbs-down class="w-5 h-5 hover:text-red-300 cursor-pointer" />

                <span>{{ $question->votes_sum_inlike ? $question->votes_sum_inlike : 0  }}</span>
            </button>
        </x-form>

    </div>


</div>