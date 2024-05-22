@props(['class' => ''])

<table class="table mb-0 {{ $class }}" style="table-layout: fixed">
  {{ $slot }}
</table>