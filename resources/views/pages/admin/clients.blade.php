<x-layout>
  <h2 class="pt-4 pb-2">【管理】ユーザー企業一覧</h2>
  <div class="mb-4 d-flex gap-5">
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#createUser">新規作成</button>
  </div>
  <x-table>
    <thead>
      <tr class="table-lightblue">
        <th>ユーザー企業名</th>
        <th>所在地</th>
        <th>担当者名</th>
        <th>担当者連絡先</th>
        <th>備考</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($clients as $client)
        <tr>
          <td>{{ $client->title }}</td>
          <td>{{ $client->location }}</td>
          <td>{{ $client->pic_name }}</td>
          <td>{{ $client->pic_contact }}</td>
          <td>{{ $client->note }}</td>
          <td>
            <x-ellipsis
            edit-modal-id="editUser{{ $client->id }}"
            delete-action="/admin/clients/{{ $client->id }}">
              <li>
                <form action="/admin/change_support_login_client" method="post">
                  @csrf
                  <input type="hidden" name="client_id" value="{{ $client->id }}">
                  <button class="dropdown-item">サポートログイン</button>
                </form>
              </li>
            </x-ellipsis>
          </td>
        </tr>
      @endforeach
    </tbody>
  </x-table>
  
  @foreach ($clients as $client)
    <x-modal id="editUser{{ $client->id }}" title="編集">
      <form action="/admin/clients/{{ $client->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">ユーザー企業名</label>
          <input type="text" name="title" value="{{ $client->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">所在地</label>
          <input type="text" name="location" value="{{ $client->location }}" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">担当者名</label>
          <input type="text" name="pic_name" value="{{ $client->pic_name }}" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">担当者連絡先</label>
          <input type="text" name="pic_contact" value="{{ $client->pic_contact }}" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">備考</label>
          <textarea name="note" class="form-control">{{ $client->note }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-modal>   
  @endforeach

  <x-modal id="createUser" title="新規作成">
    <form action="/admin/clients" method="post">
      @csrf
      <div class="mb-3">
        <label class="form-label">ユーザー企業名</label>
        <input type="text" name="title" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">所在地</label>
        <input type="text" name="location" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">担当者名</label>
        <input type="text" name="pic_name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">担当者連絡先</label>
        <input type="text" name="pic_contact" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">備考</label>
        <textarea name="note" class="form-control"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">作成</button>
    </form>
  </x-modal>   
</x-layout>