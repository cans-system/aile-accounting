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
        <th>個別修正/連結修正</th>
        <th>連結仕訳分類名称</th>
        <th>繰越タイプ</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($journal_categories as $category)
        <tr>
          <td>{{ $category->id }}</td>
          <td>{{ $category->modify->title() }}</td>
          <td>{{ $category->title }}</td>
          <td>{{ $category->carryover->title() }}</td>
          <td>
            <x-ellipsis
            edit-modal-id="editModal{{ $category->id }}"
            delete-action="/journal_categories/{{ $category->id }}" />
          </td>
        </tr>
      @endforeach
    </tbody>
  </x-table>
  
  @foreach ($journal_categories as $category)
    <x-modal id="editModal{{ $category->id }}" title="編集">
      <form action="/journal_categories/{{ $category->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">個別修正/連結修正</label>
          <select class="form-select" name="modify">
            @foreach (App\Enums\Modify::cases() as $case)
              <option value="{{ $case }}" @selected($category->modify === $case)>{{ $case->title() }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">連結仕訳分類名称</label>
          <input type="text" name="title" value="{{ $category->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">繰越タイプ</label>
          <select class="form-select" name="carryover">
            @foreach (App\Enums\Carryover::cases() as $case)
              <option value="{{ $case }}" @selected($category->carryover === $case)>{{ $case->title() }}</option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-modal>   
  @endforeach

  <x-modal id="createCompany" title="新規作成">
    <form action="/clients/{{ $client->id }}/journal_categories" method="post">
      @csrf
      <div class="mb-3">
        <label class="form-label">個別修正/連結修正</label>
        <select class="form-select" name="modify">
          @foreach (App\Enums\Modify::cases() as $case)
            <option value="{{ $case }}">{{ $case->title() }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">連結仕訳分類名称</label>
        <input type="text" name="title" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">繰越タイプ</label>
        <select class="form-select" name="carryover">
          @foreach (App\Enums\Carryover::cases() as $case)
            <option value="{{ $case }}">{{ $case->title() }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary">作成</button>
    </form>
  </x-modal>   
</x-layout>