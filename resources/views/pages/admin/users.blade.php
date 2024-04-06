<x-layout>
  <div class="py-1 mb-3 border-bottom border-primary fw-bold d-flex">
    <div class="bdcb">管理</div>
    <div class="bdcb"><i class="fa-solid fa-angle-right"></i></div>
    <div class="bdcb">ユーザー・ロール管理</div>
    <div class="bdcb"><i class="fa-solid fa-angle-right"></i></div>
    <a class="bdcb bdcb-child active">ユーザー管理</a>
    <a class="bdcb bdcb-child" href="/admin/roles">ロール管理</a>
  </div>
  <p>画面説明：ユーザー企業内のユーザーを管理できます</p>
  <div class="mb-4 d-flex gap-5">
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#createUser">新規作成</button>
  </div>
  <table class="table table-bordered border-secondary w-auto">
    <thead>
      <tr class="table-lightblue">
        <th>ユーザー名</th>
        <th>メールアドレス</th>
        <th>ロール</th>
        <th>対象会社</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->role->title }}</td>
          <td>{{ $user->number_of_lines }}</td>
          <td>
            <div class="dropdown">
              <a class="text-decoration-none py-2 px-5 text-reset" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis"></i>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" data-bs-toggle="modal" href="#editUser{{ $user->id }}">編集</a></li>
                <li>
                  <form action="/admin/users/{{ $user->id }}" method="post" onsubmit="return window.confirm('本当に削除しますか？\r\n削除を実行するとユーザーの保有する質問や予約などのデータが削除されます')">
                    @csrf
                    @method('DELETE')
                    <button class="dropdown-item">削除</button>
                  </form>
                </li>
              </ul>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  
  @foreach ($users as $user)
    <x-modal id="editUser{{ $user->id }}" title="編集">
      <form action="/admin/users/{{ $user->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">ユーザー名</label>
          <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
          <label class="form-label">メールアドレス</label>
          <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
          <label class="form-label">ロール</label>
          <select class="form-select" name="role_id">
            @foreach ($roles as $role)
              <option value="{{ $role->id }}" @selected($role->id == $user->role_id)>{{ $role->title }}</option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-modal>   
  @endforeach

  <x-modal id="createUser" title="新規作成">
    <form action="/admin/users" method="post">
      @csrf
      <div class="mb-3">
        <label class="form-label">ユーザー名</label>
        <input type="text" name="name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">メールアドレス</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">ロール</label>
        <select class="form-select" name="role_id">
          @foreach ($roles as $role)
          <option value="{{ $role->id }}" @selected($role->id == $user->role_id)>{{ $role->title }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">パスワード</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">更新</button>
    </form>
  </x-modal>   
</x-layout>