<x-layout>
  <x-breadcrumb client_id="{{ $client->id }}" />
  <p>画面説明：xxxxx</p>
  <div class="mb-4 d-flex gap-5">
    <form action="{{ route('clients.journal_categories.store', ['client' => $client->id]) }}" method="post">
      @csrf
      <div class="d-flex gap-2 align-items-end">
        <div>
          <label class="form-label">個別修正/連結修正</label>
          <select class="form-select form-select-sm" name="modify">
            @foreach (App\Enums\Modify::cases() as $case)
              <option value="{{ $case }}">{{ $case->title() }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="form-label">連結仕訳分類名称</label>
          <input type="text" name="title" class="form-control form-control-sm" required>
        </div>
        <div>
          <label class="form-label">繰越タイプ</label>
          <select class="form-select form-select-sm" name="carryover">
            @foreach (App\Enums\Carryover::cases() as $case)
              <option value="{{ $case }}">{{ $case->title() }}</option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-success btn-sm">作成</button>
      </div>
    </form>
  </div>
  <x-ui.table>
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
        <form action="/journal_categories/{{ $category->id }}" method="post" id="update{{ $category->id }}">
          @csrf
          @method('PUT')
        </form>
        <form
          action="/journal_categories/{{ $category->id }}"
          method="post"
          id="destroy{{ $category->id }}"
          onsubmit="return window.confirm('関連するデータも削除されますが本当に削除しますか？')"
        >
          @csrf
          @method('DELETE')
        </form>
          <tr>
            <td>{{ $category->id }}</td>
            <td>
              <select class="form-select form-select-sm" name="modify" form="update{{ $category->id }}">
                @foreach (App\Enums\Modify::cases() as $case)
                  <option value="{{ $case }}" @selected($category->modify === $case)>{{ $case->title() }}</option>
                @endforeach
              </select>
            </td>
            <td>
              <input type="text" name="title" value="{{ $category->title }}" class="form-control form-control-sm" form="update{{ $category->id }}" required>
            </td>
            <td>
              <select class="form-select form-select-sm" name="carryover" form="update{{ $category->id }}">
                @foreach (App\Enums\Carryover::cases() as $case)
                  <option value="{{ $case }}" @selected($category->carryover === $case)>{{ $case->title() }}</option>
                @endforeach
              </select>
            </td>
            <td>
              <button type="submit" class="btn btn-primary btn-sm" form="update{{ $category->id }}">更新</button>
              <button type="submit" class="btn btn-danger btn-sm" form="destroy{{ $category->id }}">削除</button>
            </td>
          </tr>
        </form>
      @endforeach
    </tbody>
  </x-ui.table>
</x-layout>