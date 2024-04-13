<x-layout>
  <x-breadcrumb :page="MyUtil::get_page_current()" />
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
          <td>{{ $term->group }}</td>
          <td>{{ $term->id }}</td>
          <td>
            {{ date('Y年n月期', strtotime($term->month)) }}_{{ $term->type }}
          </td>
          <td>{{ $term->period }}</td>
          <td>
            <x-ellipsis
            edit-modal-id="editModal{{ $term->id }}"
            delete-action="/master/terms/{{ $term->id }}" />
          </td>
        </tr>
      @endforeach
    </tbody>
  </x-table>
  
  @foreach ($terms as $term)
    <x-modal id="editModal{{ $term->id }}" title="編集">
      <form action="/master/terms/{{ $term->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">分類</label>
          <select class="form-select" name="group">
            <option value="実績" @selected($term->group === "実績")>実績</option>
            <option value="将来情報" @selected($term->group === "将来情報")>将来情報</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">会計期間</label>
          <div class="input-group">
            <input type="month" name="month" value="{{ $term->month }}" class="form-control" required>
            <select class="form-select" name="type">
              <option value="実績" @selected($term->type === "実績")>実績</option>
              <option value="計画" @selected($term->type === "計画")>計画</option>
              <option value="見込" @selected($term->type === "見込")>見込</option>
              <option value="予算" @selected($term->type === "予算")>予算</option>
            </select>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">月次/四半期/年度</label>
          <select class="form-select" name="period">
            <option value="月次" @selected($term->period === "月次")>月次</option>
            <option value="四半期" @selected($term->period === "四半期")>四半期</option>
            <option value="年度" @selected($term->period === "年度")>年度</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-modal>   
  @endforeach

  <x-modal id="createModal" title="新規作成">
    <form action="/master/terms" method="post">
      @csrf
      <div class="mb-3">
        <label class="form-label">分類</label>
        <select class="form-select" name="group">
          <option value="実績">実績</option>
          <option value="将来情報">将来情報</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">会計期間</label>
        <div class="input-group">
          <input type="month" name="month" class="form-control" required>
          <select class="form-select" name="type">
            <option value="実績">実績</option>
            <option value="計画">計画</option>
            <option value="見込">見込</option>
            <option value="予算">予算</option>
          </select>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">月次/四半期/年度</label>
        <select class="form-select" name="period">
          <option value="月次">月次</option>
          <option value="四半期">四半期</option>
          <option value="年度">年度</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">作成</button>
    </form>
  </x-modal>   
</x-layout>