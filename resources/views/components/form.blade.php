@props([

    'action',
    'post' => null,
    'put' => null,
    'delete' => null,


])


<form class="max-w-sm mx-auto" action="{{ route('question.store') }}" method="POST">
    @csrf

    @if ($put)
        @method('PUT')
    @endif

    @if ($delete)
        @method('DELETE')
    @endif


    {{ $slot }}

    
</form>