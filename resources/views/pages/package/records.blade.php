<x-layout>
  <x-breadcrumb client_id="{{ $client->id }}" />
  <p>画面説明：xxxxx</p>
  <div class="mb-4 d-flex gap-5">
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#createModal">新規作成</button>
    <button class="btn button" type="submit" form="recordsUpdateForm">保存</button>
  </div>
  <x-ui.table>
    <thead>
      <tr class="table-lightblue">
        <th>勘定科目名称</th>
        <th>科目分類</th>
        <th>貸借</th>
        <th>前期金額</th>
        <th>当期金額</th>
        <th>適用</th>
      </tr>
    </thead>
    <tbody>
      <form action="/clients/{{ $client->id }}/{{ $statement }}" method="post" id="recordsUpdateForm">
        @method('PUT')
        @csrf
        @foreach ($accounts as $account)
          <tr>
            <td>{{ $account->title }}</td>
            <td>{{ $account->category->title }}</td>
            <td>{{ $account->dr_cr->title() }}</td>
            <td></td>
            <td class="p-0"><input type="number" name="accounts[{{ $account->id }}][amount]" value="{{ $account->record(Session::get('selected_term')?->id)?->amount }}" class="p-2 border-0"></td>
            <td class="p-0"><input type="text" name="accounts[{{ $account->id }}][note]" value="{{ $account->record(Session::get('selected_term')?->id)?->note }}" class="p-2 border-0"></td>
          </tr>
        @endforeach
      </form>
    </tbody>
  </x-ui.table>
  
  @foreach ($accounts as $account)
    <x-ui.modal id="editModal{{ $account->id }}" title="編集">
      <form action="/accounts/{{ $account->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">勘定科目名称</label>
          <input type="text" name="title" value="{{ $account->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">科目分類</label>
          <select class="form-select" name="category_id">
            @foreach ($categories as $category)
              <option value="{{ $category->id }}" @selected($account->category_id === $category->id)>{{ $category->title }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">貸借</label>
          <select class="form-select" name="dr_cr">
            @foreach (App\Enums\DrCr::cases() as $case)
              <option value="{{ $case }}" @selected($account->dr_cr === $case)>{{ $case->title() }}</option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-ui.modal>   
  @endforeach
</x-layout>