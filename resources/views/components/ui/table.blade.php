@props(['small' => false])

<table
class="table table-bordered border-secondary w-auto {{ $small ? 'table-sm' : '' }}"
style="font-size: {{ $small ? '14px' : '16px' }};"
>
    {{ $slot }}
</table>