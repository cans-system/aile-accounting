@if (session('toast'))
  <div class="toast-container position-fixed bottom-0 start-50 p-3 translate-middle-x">
    <div class="toast align-items-center text-bg-{{ session('toast')[0] }} border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">{{ session('toast')[1] }}</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>
@endif