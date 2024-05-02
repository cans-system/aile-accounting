<x-layout>
  <x-breadcrumb :page="MyUtil::get_page_current()" />
  <p>画面説明：ユーザー企業内のユーザーを管理できます</p>
  <div class="mb-4 d-flex gap-5">
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#createModal">新規作成</button>
  </div>
  <p>〇：入力、編集、削除　●：承認のみ　△：閲覧のみ　×：使用不可</p>
  <x-table>
    <thead>
      <tr class="table-lightblue">
        <th>ID</th>
        <th>ロール</th>
        @foreach ($subjects as $subject)
          <th class="text-nowrap" style="width: 120px;">{{ $subject['ja'] }}</th>
        @endforeach
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($roles as $role)
        <tr>
          <td>{{ $role->id }}</td>
          <td>{{ $role->title }}</td>
          @foreach ($subjects as $subject)
            <td class="text-center">
              @switch($role[$subject['en']])
                @case('writable')
                  <i class="fa-regular fa-circle"></i>
                  @break
                @case('approveonly')
                  <i class="fa-solid fa-circle"></i>
                  @break 
                @case('readonly')
                  <span class="fw-bold">△</span>
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
            delete-action="/roles/{{ $role->id }}" />
          </td>
        </tr>
      @endforeach
    </tbody>
  </x-table>
  
  @foreach ($roles as $role)
    <x-modal id="editModal{{ $role->id }}" title="編集">
      <form action="/roles/{{ $role->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">ロール</label>
          <input type="text" name="title" class="form-control" value="{{ $role->title }}" required>
        </div>
        @foreach ($subjects as $subject)
          <div class="mb-3">
            <label class="form-label">{{ $subject['ja'] }}</label>
            <select class="form-select" name="{{ $subject['en'] }}">
              @foreach ($levels as $level)
                <option value="{{ $level['en'] }}" @selected($level['en'] === $role[$subject['en']])>
                  {{ $level['ja'] }}
                </option>
              @endforeach
            </select>
          </div>
        @endforeach
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-modal>   
  @endforeach

  <x-modal id="createModal" title="新規作成">
    <form action="/clients/{{ $client->id }}/roles" method="post">
      @csrf
      <div class="mb-3">
        <label class="form-label">ロール</label>
        <input type="text" name="title" class="form-control" required>
      </div>
      @foreach ($subjects as $subject)
        <div class="mb-3">
          <label class="form-label">{{ $subject['ja'] }}</label>
          <select class="form-select" name="{{ $subject['en'] }}">
            @foreach ($levels as $level)
              <option value="{{ $level['en'] }}">
                {{ $level['ja'] }}
              </option>
            @endforeach
          </select>
        </div>
      @endforeach
      <button type="submit" class="btn btn-primary">作成</button>
    </form>
  </x-modal>   
</x-layout>