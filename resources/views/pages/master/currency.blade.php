<x-layout>
  <x-breadcrumb grandparent="マスタ設定" parent="外貨換算関連マスタ">
    <a class="bdcb bdcb-child active">通貨マスタ</a>
    <a class="bdcb bdcb-child">換算レート設定マスタ</a>
    <a class="bdcb bdcb-child">外貨修正仕訳分類マスタ</a>
  </x-breadcrumb>
  <p>画面説明：xxxxx</p>
  <div class="mb-4 d-flex gap-5">
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#createCurrency">新規作成</button>
  </div>
  <table class="table table-bordered border-secondary w-auto">
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
            <x-ellipsis
            edit-modal-id="editCurrency{{ $currency->id }}"
            delete-action="/master/currencies/{{ $currency->id }}" />
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  
  @foreach ($currencies as $currency)
    <x-modal id="editCurrency{{ $currency->id }}" title="編集">
      <form action="/master/currencies/{{ $currency->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">通貨名称</label>
          <input type="text" name="title" value="{{ $currency->title }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-modal>   
  @endforeach

  <x-modal id="createCurrency" title="新規作成">
    <form action="/master/currencies" method="post">
      @csrf
      <div class="mb-3">
        <label class="form-label">通貨名称</label>
        <input type="text" name="title" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">作成</button>
    </form>
  </x-modal>   
</x-layout>