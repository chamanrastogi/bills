@props(['route', 'method' => 'POST', 'isEdit' => false, 'enctype' => 'multipart/form-data'])

<form action="{{ $route }}" method="POST" enctype="{{ $enctype }}" class="forms-sample needs-validation"
    novalidate>
    @csrf

    @if (in_array(strtoupper($method), ['PUT', 'PATCH', 'DELETE']))
        @method($method)
    @endif

    @if ($isEdit)
        
        @method('PUT')
    @endif


    {{ $slot }}
</form>
