<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Question') }} :: {{ $question->id }}
        </h2>
    </x-slot>

    <x-container>

        <x-form put :action="route('question.update', $question)">


            <x-textarea name='question' label='Add your question here' :value="$question->question" />

            <x-btn.primary>
                Save
            </x-btn.primary>

            <x-btn.reset>
                Cancel
                </x-btn.secundy>


        </x-form>


    </x-container>



</x-app-layout>