@props(['name','active'])
@php
    $classes= ($active == true) ?
    'bg-primary p-4 bg-lg border-1' :
    'bg-danger text-primary btn-lg';
@endphp
<div>
    <a {{$attributes->class([$classes])}} >
        {{$name}}
    </a>
</div>
