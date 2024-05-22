<x-layout>
  <x-breadcrumb client_id="{{ $client->id }}" />
  <p>画面説明：xxxxx</p>
  <div class="mb-4 d-flex gap-5">
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#createModal">新規作成</button>
  </div>
  <x-ui.table>
    <thead>
      <tr class="table-lightblue">
        <th>ID</th>
        <th>通貨名称</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($currencies as $currency)
        <tr>
          <td>{{ $currency->id }}</td>
          <td>{{ $currency->title }}</td>
          <td>
            <x-ui.ellipsis
            edit-modal-id="editModal{{ $currency->id }}"
            delete-action="/currencies/{{ $currency->id }}" />
          </td>
        </tr>
      @endforeach
    </tbody>
  </x-ui.table>
  
  @foreach ($currencies as $currency)
    <x-ui.modal id="editModal{{ $currency->id }}" title="編集">
      <form action="/currencies/{{ $currency->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">通貨名称</label>
          <input type="text" name="title" value="{{ $currency->title }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-ui.modal>   
  @endforeach

  <x-ui.modal id="createModal" title="新規作成">
    <form action="/clients/{{ $client->id }}/currencies" method="post">
      @csrf
      <div class="mb-3">
        <label class="form-label">通貨名称</label>
        <input type="text" name="title" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">作成</button>
    </form>
  </x-ui.modal>   
</x-layout>