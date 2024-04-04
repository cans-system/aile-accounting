@if (Auth::user()->isAdmin())
<div class="toast-container position-fixed top-0 start-50 p-3 translate-middle-x">
  <div class="p-2 align-items-center text-bg-warning border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">管理者としてこのページを閲覧しています</div>
    </div>
  </div>
</div>
@endif