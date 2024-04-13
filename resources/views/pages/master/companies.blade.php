<x-layout>
  <x-breadcrumb />
  <p>画面説明：xxxxx</p>
  <div class="mb-4 d-flex gap-5">
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#createCompany">新規作成</button>
  </div>
  <x-table>
    <thead>
      <tr class="table-lightblue">
        <th>ID</th>
        <th>会社名</th>
        <th>決算月</th>
        <th>通貨</th>
        <th>対象事業セグメント</th>
        <th>デフォルト事業セグメント</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($companies as $company)
        <tr>
          <td>{{ $company->id }}</td>
          <td>{{ $company->title }}</td>
          <td>{{ $company->fiscal_month }}月</td>
          <td>{{ $company->currency->title }}</td>
          <td>
            {{ MyUtil::array_str($company->businesses->pluck('title')->all(), '、') }}
          </td>
          <td>{{ $company->business->title }}</td>
          <td>
            <x-ellipsis
            edit-modal-id="editModal{{ $company->id }}"
            delete-action="/master/companies/{{ $company->id }}" />
          </td>
        </tr>
      @endforeach
    </tbody>
  </x-table>
  
  @foreach ($companies as $company)
    <x-modal id="editModal{{ $company->id }}" title="編集">
      <form action="/master/companies/{{ $company->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">会社名</label>
          <input type="text" name="title" value="{{ $company->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">決算月</label>
          <select class="form-select" name="fiscal_month">
            @for ($i = 1; $i <= 12; $i++)
              <option value="{{ $i }}" @selected($company->fiscal_month === $i)>{{ $i }}月</option>
            @endfor
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">通貨</label>
          <select class="form-select" name="currency_id">
            @foreach ($currencies as $currency)
              <option value="{{ $currency->id }}" @selected($company->currency_id === $currency->id)>{{ $currency->title }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">対象事業セグメント</label>
          <select class="form-select" name="business_id_list[]" multiple>
            @foreach ($businesses as $business)
              <option
              value="{{ $business->id }}"
              @selected($company->businesses->pluck('id')->contains($business->id))>
                {{ $business->title }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">デフォルトセグメント</label>
          <select class="form-select" name="business_id">
            @foreach ($company->businesses as $business)
            <option value="{{ $business->id }}" @selected($company->business_id === $business->id)>
              {{ $business->title }}
            </option>
            @endforeach
          </select>
        </div>  
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-modal>   
  @endforeach

  <x-modal id="createCompany" title="新規作成">
    <form action="/master/companies" method="post">
      @csrf
      <div class="mb-3">
        <label class="form-label">会社名</label>
        <input type="text" name="title" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">決算月</label>
        <select class="form-select" name="fiscal_month">
          @for ($i = 1; $i <= 12; $i++)
            <option value="{{ $i }}">{{ $i }}月</option>
          @endfor
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">通貨</label>
        <select class="form-select" name="currency_id">
          @foreach ($currencies as $currency)
            <option value="{{ $currency->id }}">{{ $currency->title }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">対象事業セグメント</label>
        <select class="form-select" name="business_id_list[]" multiple>
          @foreach ($businesses as $business)
          <option value="{{ $business->id }}">{{ $business->title }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">デフォルトセグメント</label>
        <select class="form-select" name="business_id">
          @foreach ($businesses as $business)
          <option value="{{ $business->id }}">{{ $business->title }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary">作成</button>
    </form>
  </x-modal>   
</x-layout>