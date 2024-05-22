<x-layout>
  <x-breadcrumb client_id="{{ $client->id }}" />
  <p>画面説明：xxxxx</p>
  <div class="mb-4 d-flex gap-5">
    <form action="{{ route('clients.businesses.store', ['client' => $client->id]) }}" method="post">
      @csrf
      <input type="hidden" name="enabled" value="1">
      <div class="d-flex gap-2 align-items-end">
        <div>
          <label class="form-label">事業セグメント名称</label>
          <input type="text" name="title" class="form-control form-control-sm" required>
        </div>
        <div>
          <label class="form-label">開示セグメント</label>
          <select class="form-select form-select-sm" name="disclosed_business_list_id">
            @foreach ($lists as $list)
              <option value="{{ $list->id }}">{{ $list->title }}</option>
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
        <th>事業セグメント名称</th>
        <th>開示セグメント</th>
        <th>有効/利用不可</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($businesses as $business)
        <form action="/businesses/{{ $business->id }}" method="post" id="update{{ $business->id }}">
          @csrf
          @method('PUT')
        </form>
        <form
          action="/businesses/{{ $business->id }}"
          method="post"
          onsubmit="return window.confirm('本当に削除しますか？')"
          id="destroy{{ $business->id }}"
        >
          @csrf
          @method('DELETE')
        </form>  
        <tr>
          <td>{{ $business->id }}</td>
          <td>
            <input type="text" name="title" value="{{ $business->title }}" class="form-control form-control-sm" form="update{{ $business->id }}" required>
          </td>
          <td>
            <select class="form-select form-select-sm" name="disclosed_business_list_id" form="update{{ $business->id }}">
              @foreach ($lists as $list)
                <option value="{{ $list->id }}" @selected($list->id == $business->disclosed_business_list_id)>{{ $list->title }}</option>
              @endforeach
            </select>  
          </td>
          <td>
            <div class="form-check form-switch">
              <input
                class="form-check-input"
                type="checkbox"
                value="1"
                name="enabled"
                form="update{{ $business->id }}"
                @checked($business->enabled)
              />
            </div>
          </td>
          <td>
            <button type="submit" class="btn btn-primary btn-sm" form="update{{ $business->id }}">更新</button>
            <button type="submit" class="btn btn-danger btn-sm" form="destroy{{ $business->id }}">削除</button>
          </td>
        </tr>
      @endforeach
    </tbody>
  </x-ui.table>
</x-layout>