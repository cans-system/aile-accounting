<x-layout>
  <x-breadcrumb client_id="{{ $client->id }}" />
  <p>画面説明：xxxxx</p>
  <div class="mb-4 d-flex gap-5">
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#createModal">新規作成</button>
  </div>
  <x-ui.table>
    <thead>
      <tr class="table-lightblue">
        <th>ID</th>
        <th>開示セグメント名称</th>
        <th>有効/利用不可</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($lists as $list)
        <tr>
          <td>{{ $list->id }}</td>
          <td>{{ $list->title }}</td>
          <td>
            @if ($list->enabled)
              有効
            @else
              利用不可
            @endif
          </td>
          <td>
            <x-ui.ellipsis
            edit-modal-id="editModal{{ $list->id }}"
            delete-action="/disclosed_business_lists/{{ $list->id }}" />
          </td>
        </tr>
      @endforeach
    </tbody>
  </x-ui.table>
  
  @foreach ($lists as $list)
    <x-ui.modal id="editModal{{ $list->id }}" title="編集">
      <form action="/disclosed_business_lists/{{ $list->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">開示セグメント名称</label>
          <input type="text" name="title" value="{{ $list->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">有効/利用不可</label>
          <x-ui.enabled :enabled="$list->enabled" />
        </div>  
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-ui.modal>   
  @endforeach

  <x-ui.modal id="createModal" title="新規作成">
    <form action="{{ route('clients.disclosed_business_lists.store', ['client' => $client->id]) }}" method="post">
      @csrf
      <div class="mb-3">
        <label class="form-label">開示セグメント名称</label>
        <input type="text" name="title" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">有効/利用不可</label>
        <x-ui.enabled />
      </div>
      <button type="submit" class="btn btn-primary">作成</button>
    </form>
  </x-ui.modal>   
</x-layout>