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
        <th>会社・セグメント</th>
        <th>相手会社・セグメント</th>
        <th>借方金額</th>
        <th>貸方金額</th>
        <th>摘要</th>
        <th>ファイル名</th>
        <th>承認状況</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($details as $detail)
        <tr>
          <td>{{ $detail->id }}</td>
          <td>{{ $detail->company->title }}</td>
          <td>{{ $detail->business->title }}</td>
          <td>{{ $detail->target_company->title }}</td>
          <td>{{ $detail->target_business->title }}</td>
          <td>{{ $detail->account->title }}</td>
          <td>{{ $detail->dr_amount }}</td>
          <td>{{ $detail->cr_amount }}</td>
          <td>{{ $detail->note }}</td>
          <td>{{ $detail->file_name }}</td>
          <td></td>
          <td>
            <x-ellipsis
            edit-modal-id="editModal{{ $detail->id }}"
            delete-action="/categories/{{ $detail->id }}" />
          </td>
        </tr>
      @endforeach
    </tbody>
  </x-table>
  
  @foreach ($details as $detail)
    <x-modal id="editModal{{ $detail->id }}" title="編集">
      <form action="/categories/{{ $detail->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">科目分類名称</label>
          <input type="text" name="title" value="{{ $detail->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">有効/利用不可</label>
          <x-enabled :enabled="$detail->enabled" />
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