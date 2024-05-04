<x-layout>
  <x-breadcrumb client_id="{{ $client->id }}" />
  <p>画面説明：会計期間を設定する画面です。</p>
  <div class="mb-4 d-flex gap-5">
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#createModal">新規作成</button>
  </div>
  <x-table>
    <thead>
      <tr class="table-lightblue">
        <th>分類</th>
        <th>会計期間コード</th>
        <th>会計期間</th>
        <th>月次/四半期/年度</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($terms as $term)
        <tr>
          <td>{{ $term->group->title() }}</td>
          <td>{{ $term->id }}</td>
          <td>
            {{ date('Y年n月期', strtotime($term->month)) }}_{{ $term->type->title() }}
          </td>
          <td>{{ $term->period->title() }}</td>
          <td>
            <x-ellipsis
            edit-modal-id="editModal{{ $term->id }}"
            delete-action="/terms/{{ $term->id }}" />
          </td>
        </tr>
      @endforeach
    </tbody>
  </x-table>
  
  @foreach ($terms as $term)
    <x-modal id="editModal{{ $term->id }}" title="編集">
      <form action="/terms/{{ $term->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">分類</label>
          <select class="form-select" name="group">
            @foreach (App\Enums\TermGroup::cases() as $case)
              <option value="{{ $case }}" @selected($term->group === $case)>{{ $case->title() }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">会計期間</label>
          <div class="input-group">
            <input type="month" name="month" value="{{ $term->month }}" class="form-control" required>
            <select class="form-select" name="type">
              @foreach (App\Enums\TermType::cases() as $case)
                <option value="{{ $case }}" @selected($term->type === $case)>{{ $case->title() }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">月次/四半期/年度</label>
          <select class="form-select" name="period">
            @foreach (App\Enums\TermPeriod::cases() as $case)
              <option value="{{ $case }}" @selected($term->period === $case)>{{ $case->title() }}</option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-modal>   
  @endforeach

  <x-modal id="createModal" title="新規作成">
    <form action="/clients/{{ $client->id }}/terms" method="post">
      @csrf
      <div class="mb-3">
        <label class="form-label">分類</label>
        <select class="form-select" name="group">
          @foreach (App\Enums\TermGroup::cases() as $case)
            <option value="{{ $case }}">{{ $case->title() }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">会計期間</label>
        <div class="input-group">
          <input type="month" name="month" value="{{ $term->month }}" class="form-control" required>
          <select class="form-select" name="type">
            @foreach (App\Enums\TermType::cases() as $case)
              <option value="{{ $case }}">{{ $case->title() }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">月次/四半期/年度</label>
        <select class="form-select" name="period">
          @foreach (App\Enums\TermPeriod::cases() as $case)
            <option value="{{ $case }}">{{ $case->title() }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary">作成</button>
    </form>
  </x-modal>   
</x-layout>