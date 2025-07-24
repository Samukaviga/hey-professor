<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Questions') }}
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

        <!-- DRAFTS -->

        <hr class="border-gray-700 mt-2">

        <div class="dark:text-gray-300 font-bold my-2 uppercase">
            My Drafts
        </div>

        <div class="dark:text-gray-500 space-y-4">

            <x-table>
                <x-table-thead>

                    <tr>
                        <x-table-th>Question</x-table-th>
                        <x-table-th>Actions</x-table-th>

                    </tr>



                </x-table-thead>

                <x-table-tbody>
                    @foreach ($questions->where('draft', true) as $item)

                        <x-table-tr>
                            <x-table-td>
                                {{ $item->question }}
                            </x-table-td>
                            <x-table-td>
                                <!-- botao de deletar -->

                                
                                    <x-form :action="route('question.destroy', $item)" delete>
                                        <button class="hover:underline text-blue-200">Deletar</button>
                                    </x-form>

                                    <x-form :action="route('question.publish', $item)" put>
                                        <button
                                            class="hover:underline text-blue-200">Publicar
                                        </button>
                                    </x-form>

                            


                            </x-table-td>




                        </x-table-tr>

                    @endforeach

                </x-table-tbody>

            </x-table>


        </div>

        <!-- DRAFTS -->

        <!-- QUESTIONS -->

        <hr class="border-gray-700 mt-2">

        <div class="dark:text-gray-300 font-bold my-2 uppercase">
            My Questions
        </div>

        <div class="dark:text-gray-500 space-y-4">


            <!-- table -->

            <x-table>
                <x-table-thead>

                    <tr>
                        <x-table-th>Question</x-table-th>
                        <x-table-th>Actions</x-table-th>
                    </tr>

                </x-table-thead>

                <x-table-tbody>
                    @foreach ($questions->where('draft', false) as $item)

                        <x-table-tr>
                            <x-table-td>
                                {{ $item->question }}
                            </x-table-td>
                           
                            <x-table-td>
                                <x-form :action="route('question.destroy', $item)" delete>
                                    <button class="hover:underline text-blue-200">Deletar</button>
                                </x-form>
                                <!-- botao de publicar -->
                            
                            </x-table-td>
                        </x-table-tr>

                    @endforeach

                </x-table-tbody>

            </x-table>


        </div>

        <!-- QUESTIONS -->




    </x-container>



</x-app-layout>