<x-layout>
  <x-breadcrumb client_id="{{ $client->id }}" />
  <p>画面説明：ユーザー企業内のユーザーを管理できます</p>
  <div class="mb-4 d-flex gap-5">
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#createModal">新規作成</button>
  </div>
  <x-ui.table>
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
          <td>
            @if (count($user->companies) === count($companies))
              全社
            @else
              {{ MyUtil::array_str($user->companies->pluck('title')->all(), '、') }}                
            @endif
          </td>
          <td>
            <x-ui.ellipsis
            edit-modal-id="editModal{{ $user->id }}"
            delete-action="/users/{{ $user->id }}" />
          </td>
        </tr>
      @endforeach
    </tbody>
  </x-ui.table>
  
  @foreach ($users as $user)
    <x-ui.modal id="editModal{{ $user->id }}" title="編集">
      <form action="/users/{{ $user->id }}" method="post">
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
        <div class="mb-3">
          <label class="form-label">対象会社</label>
          <select class="form-select" name="company_id_list[]" multiple>
            @foreach ($companies as $company)
              <option
              value="{{ $company->id }}"
              @selected($user->companies->pluck('id')->contains($company->id))>
                {{ $company->title }}
              </option>
            @endforeach
          </select>
        </div>  
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-ui.modal>   
  @endforeach

  <x-ui.modal id="createModal" title="新規作成">
    <form action="{{ route('clients.users.store', ['client' => $client->id]) }}" method="post">
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
        <label class="form-label">対象会社</label>
        <select class="form-select" name="company_id_list[]" multiple>
          @foreach ($companies as $company)
            <option value="{{ $company->id }}">{{ $company->title }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">パスワード</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">作成</button>
    </form>
  </x-ui.modal>   
</x-layout>