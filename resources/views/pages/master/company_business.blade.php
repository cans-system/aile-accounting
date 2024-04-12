<x-layout>
  <x-breadcrumb />
  <p>画面説明：xxxxx</p>
  <div class="mb-4 d-flex gap-5">
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#createCompany">新規作成</button>
  </div>
  <x-table>
    <thead>
      <tr class="table-lightblue">
        <th>会社名</th>
        <th>事業セグメント名称</th>
        <th>デフォルトセグメント</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($relations as $relation)
        <tr>
          <td>{{ $relation->id }}</td>
          <td>{{ $relation->company->title }}</td>
          <td>{{ $relation->relation }}</td>
          <td>
            <x-ellipsis
            edit-modal-id="editModal{{ $relation->id }}"
            delete-action="/master/scopes/{{ $relation->id }}" />
          </td>
        </tr>
      @endforeach
    </tbody>
  </x-table>
  
  @foreach ($relations as $relation)
    <x-modal id="editModal{{ $relation->id }}" title="編集">
      <form action="/master/scopes/{{ $relation->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">会社</label>
          <select class="form-select" name="company_id">
            @foreach ($companies as $company)
              <option value="{{ $company->id }}" @selected($relation->company_id === $company->id)>{{ $company->title }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">会社区分</label>
          <select class="form-select" name="relation">
            <option value="親会社" @selected($relation->type === "親会社")>親会社</option>
            <option value="連結子会社" @selected($relation->type === "連結子会社")>連結子会社</option>
            <option value="持分法適用会社" @selected($relation->type === "持分法適用会社")>持分法適用会社</option>
            <option value="非連結会社" @selected($relation->type === "非連結会社")>非連結会社</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-modal>   
  @endforeach

  <x-modal id="createCompany" title="新規作成">
    <form action="/master/scopes" method="post">
      @csrf
      <div class="mb-3">
        <label class="form-label">会社</label>
        <select class="form-select" name="company_id">
          @foreach ($companies as $company)
            <option value="{{ $company->id }}">{{ $company->title }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">会社区分</label>
        <select class="form-select" name="relation">
          <option value="親会社">親会社</option>
          <option value="連結子会社">連結子会社</option>
          <option value="持分法適用会社">持分法適用会社</option>
          <option value="非連結会社">非連結会社</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">作成</button>
    </form>
  </x-modal>   
</x-layout>