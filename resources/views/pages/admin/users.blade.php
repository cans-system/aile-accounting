<x-layout>
  <table class="table">
    <thead>
      <tr>
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
          <td contenteditable="true">{{ $user->name }}</td>
          <td contenteditable="true">{{ $user->email }}</td>
          <td contenteditable="true">{{ $user->role->title }}</td>
          <td contenteditable="true">{{ $user->number_of_lines }}</td>
          <td>
            <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#editUser{{ $user->id }}">
              編集
            </button>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  
  @foreach ($users as $user)
    <x-modal id="editUser{{ $user->id }}" title="ユーザー情報を編集">
      <form action="/admin/users/{{ $user->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label"><b>{{ $user->email }}</b>のステータス</label>
          <select class="form-select" name="role_id">
            @foreach ($roles as $role)
              <option value="{{ $role->id }}" @selected($role->id == $user->role_id)>{{ $role->title }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label"><b>{{ $user->email }}</b>の回線数</label>
          <input
          type="number" name="number_of_lines"
          class="form-control"min="1" max="300" required
          value="{{ $user->number_of_lines }}"
          >
        </div>
        <div class="form-text">
          回線数は1~300の間で指定する必要があります
        </div>
        <div class="text-end">
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <button type="submit" class="btn btn-success">更新</button>
        </div>
      </form>
      <form action="/admin/users/{{ $user->id }}" method="post" onsubmit="return window.confirm('本当に削除しますか？\r\n削除を実行するとユーザーの保有する質問や予約などのデータが削除されます')">
        @csrf
        @method('DELETE')
        <div class="text-end">
          <button class="btn btn-link">このユーザーを削除</button>
        </div>
      </form>
    </x-modal>      
  @endforeach
</x-layout>