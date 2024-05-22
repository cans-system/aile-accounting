<x-layout>
  <x-breadcrumb client_id="{{ $client->id }}" />
  <p>画面説明：xxxxx</p>
  <div class="mb-2 d-flex gap-5">
    <form action="{{ route('clients.disclosed_business_lists.store', ['client' => $client->id]) }}" method="post">
      @csrf
      <input type="hidden" name="enabled" value="1">
      <div class="d-flex gap-2 align-items-end">
        <div>
          <label class="form-label">開示セグメント名称</label>
          <input type="text" name="title" class="form-control form-control-sm" required>
        </div>
        <button type="submit" class="btn btn-success btn-sm">作成</button>
      </div>
    </form>
  </div>
  <div class="vstack gap-2 mb-3">
    @foreach ($lists as $list)
      <form action="/disclosed_business_lists/{{ $list->id }}" method="post" id="updateList{{ $list->id }}">
        @csrf
        @method('PUT')
      </form>
      <form
        method="post"
        action="/disclosed_business_lists/{{ $list->id }}"
        onsubmit="return window.confirm('本当に削除しますか？')"
        id="deleteList{{ $list->id }}"
      >
        @csrf
        @method('DELETE')
      </form>
      <x-card.shadow id="{{ $list->id }}">
        <div class="card-body">
          <table class="table table-sm table-borderless mb-0">
            <tbody>
              <tr>
                <td style="width: 160px;">開示セグメント名称</td>
                <td>
                  <input
                    type="text"
                    name="title"
                    value="{{ $list->title }}"
                    class="form-control form-control-sm"
                    form="updateList{{ $list->id }}"
                    required
                  >
                </td>
              </tr>
              <tr>
                <td>有効/利用不可</td>
                <td>
                  <div class="form-check form-switch">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      value="1"
                      name="enabled"
                      form="updateList{{ $list->id }}"
                      @checked($list->enabled)
                    />
                  </div>
                </td>
              </tr>
              <tr>
                <td>事業セグメント</td>
                <td>
                  <div class="rounded-1 p-2 bg-light">
                    <div class="mb-2">
                      <form
                        action="{{ route('disclosed_business_lists.businesses.store', ['disclosed_business_list' => $list->id]) }}"
                        method="post"
                      >
                        @csrf
                        <input type="hidden" name="enabled" value="1">
                        <div class="d-flex gap-2 align-items-end">
                          <div>
                            <label class="form-label">事業セグメント名称</label>
                            <input
                              type="text"
                              name="title"
                              class="form-control form-control-sm"
                              required
                            >
                          </div>
                          <div>
                            <label class="form-label">開示セグメント</label>
                            <select class="form-select form-select-sm" name="disclosed_business_list_id">
                              @foreach ($lists as $l)
                                <option value="{{ $l->id }}">{{ $l->title }}</option>
                              @endforeach
                            </select>
                          </div>
                          <button type="submit" class="btn btn-success btn-sm">作成</button>
                        </div>
                      </form>
                    </div>
                    <x-table.fixed class="table-transparent">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>事業セグメント名称</th>
                          <th>有効/利用不可</th>
                          <th>操作</th>
                        </tr>
                      </thead>
                      <tbody class="table-group-divider">
                        @foreach ($list->businesses as $business)
                        <form action="/businesses/{{ $business->id }}" method="post" id="updateBusiness{{ $business->id }}">
                          @csrf
                          @method('PUT')
                        </form>
                        <form method="post" id="destroyBusiness{{ $business->id }}" action="/businesses/{{ $business->id }}" onsubmit="return window.confirm('本当に削除しますか？')">
                          @csrf
                          @method('DELETE')
                        </form>
                          <tr>
                            <td>{{ $business->id }}</td>
                            <td>
                              <input
                                type="text"
                                name="title"
                                value="{{ $business->title }}"
                                class="form-control form-control-sm"
                                form="updateBusiness{{ $business->id }}"
                                required
                              >
                            </td>
                            <td>
                              <div class="form-check form-switch">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  value="1"
                                  name="enabled"
                                  form="updateBusiness{{ $business->id }}"
                                  @checked($business->enabled)
                                />
                              </div>
                            </td>
                            <td>
                              <button type="submit" class="btn btn-primary btn-sm" form="updateBusiness{{ $business->id }}">更新</button>
                              <button type="submit" class="btn btn-danger btn-sm" form="destroyBusiness{{ $business->id }}">削除</button>
                            </td>
                          </tr>                  
                        @endforeach
                      </tbody>
                    </x-table.fixed>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="pt-2">
            <button class="btn btn-outline-dark btn-sm" form="updateList{{ $list->id }}">保存</button>
            <button class="btn btn-danger btn-sm" form="deleteList{{ $list->id }}">削除</button>
          </div>
        </div>
      </x-card.shadow>
    @endforeach
  </div>
</x-layout>