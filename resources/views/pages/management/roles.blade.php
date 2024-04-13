<x-layout>
  <x-breadcrumb :page="MyUtil::get_page_current()" />
  <p>画面説明：ユーザー企業内のユーザーを管理できます</p>
  <div class="mb-4 d-flex gap-5">
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#createModal">新規作成</button>
  </div>
  <x-table>
    <thead>
      <tr class="table-lightblue">
        <th>ID</th>
        <th>ロール</th>
        <th>マスタ設定</th>
        <th>連結パッケージ</th>
        <th>連結決算処理</th>
        <th>ユーザー管理</th>
        <th>締め処理</th>
        <th>繰越処理</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($roles as $role)
        <tr>
          <td>{{ $role->id }}</td>
          <td>{{ $role->title }}</td>
          @foreach ([$role->master, $role->package, $role->settlement ,$role->users, $role->closing, $role->carryover] as $item)
            <td class="text-center">
              @switch($item)
                @case('writable')
                  <i class="fa-regular fa-circle"></i>
                  @break
                @case('approveonly')
                  <i class="fa-solid fa-circle"></i>
                  @break 
                @case('readonly')
                  △
                  @break 
                @case('disabled')
                  <i class="fa-solid fa-xmark"></i>
                  @break 
              @endswitch
            </td>              
          @endforeach
          <td>
            <x-ellipsis
            edit-modal-id="editModal{{ $role->id }}"
            delete-action="/management/roles/{{ $role->id }}" />
          </td>
        </tr>
      @endforeach
    </tbody>
  </x-table>
  
  @foreach ($roles as $role)
    <x-modal id="editModal{{ $role->id }}" title="編集">
      <form action="/management/roles/{{ $role->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">ロール</label>
          <input type="text" name="name" class="form-control" value="{{ $role->title }}" required>
        </div>
        @foreach (['マスタ設定', '連結パッケージ', '連結決算処理', 'ユーザー管理', '締め処理', '繰越処理'] as $item)
          <div class="mb-3">
            <label class="form-label">{{ $item }}</label>
            <select class="form-select" name="detail_summary">
              <option value="writable">入力、編集、削除</option>
              <option value="approveonly">承認のみ</option>
              <option value="readonly">閲覧のみ</option>
              <option value="disabled">使用不可</option>
            </select>
          </div>
        @endforeach
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-modal>   
  @endforeach

  <x-modal id="createModal" title="新規作成">
    <form action="/management/roles" method="post">
      @csrf
      <div class="mb-3">
        <label class="form-label">ユーザー名</label>
        <input type="text" name="name" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">作成</button>
    </form>
  </x-modal>   
</x-layout>