<!DOCTYPE html>
<html lang="ja">
<x-head />
<body>
  <x-header />
  <main>
    <div class="px-4 pb-2">
      {{ $slot }}
    </div>
  </main>
  <x-ui.toast />
</body>
</html>