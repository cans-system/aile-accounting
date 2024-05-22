<x-layout>
  <x-breadcrumb client_id="{{ $client->id }}" />
  <p>画面説明：xxxxx</p>
  <div class="mb-4 d-flex gap-5">
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#createCompany">新規作成</button>
  </div>
  <x-ui.table>
    <thead>
      <tr class="table-lightblue">
        <th>ID</th>
        <th>会社・セグメント</th>
        <th>相手会社・セグメント</th>
        <th>勘定科目</th>
        <th>借方金額</th>
        <th>貸方金額</th>
        <th>摘要</th>
        <th>ファイル添付</th>
        <th>承認状況</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($details as $detail)
        <tr>
          <td>{{ $detail->id }}</td>
          <td>
            {{ $detail->company_business->company->title }}
            ・{{ $detail->company_business->business->title }}
          </td>
          <td>
            {{ $detail->target_company_business->company->title }}
            ・{{ $detail->target_company_business->business->title }}
          </td>
          <td>{{ $detail->account->title }}</td>
          <td>{{ $detail->dr_amount }}</td>
          <td>{{ $detail->cr_amount }}</td>
          <td>{{ $detail->note }}</td>
          <td>{{ $detail->file_name }}</td>
          <td></td>
          <td>
            <x-ui.ellipsis
            edit-modal-id="editModal{{ $detail->id }}"
            delete-action="/details/{{ $detail->id }}" />
          </td>
        </tr>
      @endforeach
    </tbody>
  </x-ui.table>
  
  @foreach ($details as $detail)
    <x-ui.modal id="editModal{{ $detail->id }}" title="編集">
      <form action="/details/{{ $detail->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">仕訳分類・仕訳小分類</label>
          <select class="form-select" name="journal_subcategory_id">
            @foreach ($jscs as $jsc)
              <option value="{{ $jsc->id }}" @selected($detail->journal_subcategory_id === $jsc)>
                {{ $jsc->journal_category->title }}・{{ $jsc->title }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">会社・セグメント</label>
          <select class="form-select" name="company_business_id">
            @foreach ($cbs as $cb)
              <option value="{{ $cb->id }}" @selected($detail->company_business_id === $cb)>
                {{ $cb->company->title }}・{{ $cb->business->title }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">相手会社・セグメント</label>
          <select class="form-select" name="target_company_business_id">
            @foreach ($cbs as $cb)
              <option value="{{ $cb->id }}" @selected($detail->target_company_business_id === $cb)>
                {{ $cb->company->title }}・{{ $cb->business->title }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">勘定科目</label>
          <select class="form-select" name="account_id">
            @foreach ($accounts as $account)
              <option value="{{ $account->id }}" @selected($detail->account_id === $account)>
                {{ $account->title }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">借方金額</label>
          <input class="form-control" type="number" name="dr_amount" value="{{ $detail->dr_amount }}">
        </div>
        <div class="mb-3">
          <label class="form-label">貸方金額</label>
          <input class="form-control" type="number" name="cr_amount" value="{{ $detail->cr_amount }}">
        </div>
        <div class="mb-3">
          <label class="form-label">摘要</label>
          <input class="form-control" type="text" name="note" value="{{ $detail->note }}">
        </div>
        <div class="mb-3">
          <label class="form-label">ファイル添付</label>
          <input class="form-control" type="file" name="file">
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-ui.modal>   
  @endforeach

  <x-ui.modal id="createCompany" title="新規作成">
    <form action="{{ route('clients.details.store', ['client' => $client->id]) }}" method="post">
      @csrf
      <div class="mb-3">
        <label class="form-label">仕訳分類・仕訳小分類</label>
        <select class="form-select" name="journal_subcategory_id">
          @foreach ($jscs as $jsc)
            <option value="{{ $jsc->id }}">
              {{ $jsc->journal_category->title }}・{{ $jsc->title }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">会社・セグメント</label>
        <select class="form-select" name="company_business_id">
          @foreach ($cbs as $cb)
            <option value="{{ $cb->id }}">
              {{ $cb->company->title }}・{{ $cb->business->title }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">相手会社・セグメント</label>
        <select class="form-select" name="target_company_business_id">
          @foreach ($cbs as $cb)
            <option value="{{ $cb->id }}">
              {{ $cb->company->title }}・{{ $cb->business->title }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">勘定科目</label>
        <select class="form-select" name="account_id">
          @foreach ($accounts as $account)
            <option value="{{ $account->id }}">
              {{ $account->title }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">借方金額</label>
        <input class="form-control" type="number" name="dr_amount">
      </div>
      <div class="mb-3">
        <label class="form-label">貸方金額</label>
        <input class="form-control" type="number" name="cr_amount">
      </div>
      <div class="mb-3">
        <label class="form-label">摘要</label>
        <input class="form-control" type="text" name="note">
      </div>
      <div class="mb-3">
        <label class="form-label">ファイル添付</label>
        <input class="form-control" type="file" name="file">
      </div>
      <button type="submit" class="btn btn-primary">作成</button>
    </form>
  </x-ui.modal>   
</x-layout>