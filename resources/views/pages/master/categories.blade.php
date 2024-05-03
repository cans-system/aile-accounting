<x-layout>
  <x-breadcrumb client_id="{{ $client->id }}" />
  <p>画面説明：xxxxx</p>
  <div class="mb-4 d-flex gap-5">
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#createCompany">新規作成</button>
  </div>
  <x-table>
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
            <x-ellipsis
            edit-modal-id="editModal{{ $category->id }}"
            delete-action="/categories/{{ $category->id }}" />
          </td>
        </tr>
      @endforeach
    </tbody>
  </x-table>
  
  @foreach ($categories as $category)
    <x-modal id="editModal{{ $category->id }}" title="編集">
      <form action="/categories/{{ $category->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">科目分類名称</label>
          <input type="text" name="title" value="{{ $category->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">有効/利用不可</label>
          <x-enabled :enabled="$category->enabled" />
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-modal>   
  @endforeach

  <x-modal id="createCompany" title="新規作成">
    <form action="/categories" method="post">
      @csrf
      <div class="mb-3">
        <label class="form-label">科目分類名称</label>
        <input type="text" name="title" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">有効/利用不可</label>
        <x-enabled />
      </div>
      <button type="submit" class="btn btn-primary">作成</button>
    </form>
  </x-modal>   
</x-layout>