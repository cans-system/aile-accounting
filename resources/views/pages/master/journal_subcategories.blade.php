<x-layout>
  <x-breadcrumb client_id="{{ $client->id }}" />
  <p>画面説明：xxxxx</p>
  <div class="mb-4 d-flex gap-5">
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#createCompany">新規作成</button>
  </div>
  <x-table>
    <thead>
      <tr class="table-lightblue">
        <th>連結仕訳分類</th>
        <th>ID</th>
        <th>小分類名称</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($journal_subcategories as $subcategory)
        <tr>
          <td>{{ $subcategory->journal_category->title }}</td>
          <td>{{ $subcategory->id }}</td>
          <td>{{ $subcategory->title }}</td>
          <td>
            <x-ellipsis
            edit-modal-id="editModal{{ $subcategory->id }}"
            delete-action="/journal_subcategories/{{ $subcategory->id }}" />
          </td>
        </tr>
      @endforeach
    </tbody>
  </x-table>
  
  @foreach ($journal_subcategories as $subcategory)
    <x-modal id="editModal{{ $subcategory->id }}" title="編集">
      <form action="/journal_subcategories/{{ $subcategory->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">連結仕訳分類</label>
          <select class="form-select" name="journal_category_id">
            @foreach ($journal_categories as $category)
              <option value="{{ $category->id }}" @selected($subcategory->journal_category_id === $category)>
                {{ $category->title }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">小分類名称</label>
          <input type="text" name="title" value="{{ $subcategory->title }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-modal>   
  @endforeach

  <x-modal id="createCompany" title="新規作成">
    <form action="/clients/{{ $client->id }}/journal_subcategories" method="post">
      @csrf
      <div class="mb-3">
        <label class="form-label">連結仕訳分類</label>
        <select class="form-select" name="journal_category_id">
          @foreach ($journal_categories as $category)
            <option value="{{ $category->id }}">
              {{ $category->title }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">小分類名称</label>
        <input type="text" name="title" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">作成</button>
    </form>
  </x-modal>   
</x-layout>