<x-layout>
  <x-breadcrumb :page="MyUtil::get_page_current()" />
  <p>画面説明：xxxxx</p>
  <div class="mb-4 d-flex gap-5">
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#createCompany">新規作成</button>
  </div>
  <x-table>
    <thead>
      <tr class="table-lightblue">
        <th>ID</th>
        <th>会社名</th>
        <th>会社区分</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($scopes as $scope)
        <tr>
          <td>{{ $scope->id }}</td>
          <td>{{ $scope->company->title }}</td>
          <td>{{ $scope->relation->title() }}</td>
          <td>
            <x-ellipsis
            edit-modal-id="editModal{{ $scope->id }}"
            delete-action="/scopes/{{ $scope->id }}" />
          </td>
        </tr>
      @endforeach
    </tbody>
  </x-table>
  
  @foreach ($scopes as $scope)
    <x-modal id="editModal{{ $scope->id }}" title="編集">
      <form action="/scopes/{{ $scope->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">会社</label>
          <select class="form-select" name="company_id">
            @foreach ($companies as $company)
              <option value="{{ $company->id }}" @selected($scope->company_id === $company->id)>{{ $company->title }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">会社区分</label>
          <select class="form-select" name="relation">
            @foreach (App\Enums\ScopeRelation::cases() as $case)
              <option value="{{ $case }}" @selected($scope->relation === $case->title())>{{ $case->title() }}</option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-modal>   
  @endforeach

  <x-modal id="createCompany" title="新規作成">
    <form action="/scopes" method="post">
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
          @foreach (App\Enums\ScopeRelation::cases() as $case)
            <option value="{{ $case }}">{{ $case->title() }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary">作成</button>
    </form>
  </x-modal>   
</x-layout>