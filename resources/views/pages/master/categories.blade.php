<x-layout>
  <x-breadcrumb client_id="{{ $client->id }}" />
  <p>画面説明：xxxxx</p>
  <div class="mb-4 d-flex gap-5">
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#createCompany">新規作成</button>
  </div>
  <x-ui.table>
    <thead>
      <tr class="table-lightblue">
        <th>ID</th>
        <th>科目分類名称</th>
        <th>有効/利用不可</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($categories as $category)
        <tr>
          <td>{{ $category->id }}</td>
          <td>{{ $category->title }}</td>
          <td>
            @if ($category->enabled)
              有効
            @else
              利用不可
            @endif
          </td>
          <td>
            <x-ui.ellipsis
            edit-modal-id="editModal{{ $category->id }}"
            delete-action="/categories/{{ $category->id }}" />
          </td>
        </tr>
      @endforeach
    </tbody>
  </x-ui.table>
  
  @foreach ($categories as $category)
    <x-ui.modal id="editModal{{ $category->id }}" title="編集">
      <form action="" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">科目分類名称</label>
          <input type="text" name="title" value="{{ $category->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">有効/利用不可</label>
          <x-ui.enabled :enabled="$category->enabled" />
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-ui.modal>   
  @endforeach

  <x-ui.modal id="createCompany" title="新規作成">
    <form action="{{ route('clients.categories.store', ['client' => $client->id]) }}" method="post">
      @csrf
      <div class="mb-3">
        <label class="form-label">科目分類名称</label>
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