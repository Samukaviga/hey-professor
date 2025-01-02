<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-container>

        <x-form post :action="route('question.store')">
                
               
            <x-textarea name='question' label='Add your question here' />
          
            <x-btn.primary>
                Save
            </x-btn.primary>
            
            <x-btn.reset>
                Cancel
            </x-btn.secundy>

           
        </x-form>

        <hr class="border-gray-700 mt-2" >

        <div class="dark:text-gray-300 font-bold my-2 uppercase">List of Questions</div>

        <div class="dark:text-gray-500 space-y-4">
          
            @foreach ($questions as $item )

            <x-question :question="$item" />
   
            @endforeach
        
        </div>
      

            
    </x-container>
     
           
   
</x-app-layout>
