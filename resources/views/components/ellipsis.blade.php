@props(['editModalId', 'deleteAction'])

<div class="dropdown">
  <a class="text-decoration-none py-2 px-5 text-reset" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fa-solid fa-ellipsis"></i>
  </a>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" data-bs-toggle="modal" href="#{{ $editModalId }}">編集</a></li>
    <li>
      <form action="{{ $deleteAction }}" method="post" onsubmit="return window.confirm('本当に削除しますか？\r\n削除を実行するとユーザーの保有する質問や予約などのデータが削除されます')">
        @csrf
        @method('DELETE')
        <button class="dropdown-item">削除</button>
      </form>
    </li>
  </ul>
</div>