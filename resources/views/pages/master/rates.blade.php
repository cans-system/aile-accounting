<x-layout>
  <x-breadcrumb client_id="{{ $client->id }}" />
  <p>画面説明：xxxxx</p>
  <div class="mb-4 d-flex gap-5">
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#createModal">新規作成</button>
  </div>
  <x-table>
    <thead>
      <tr class="table-lightblue">
        <th>通貨</th>
        <th>期末日レート</th>
        <th>期中平均レート</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($rates as $rate)
        <tr>
          <td>{{ $rate->currency->title }}</td>
          <td>{{ $rate->last_day_rate }}</td>
          <td>{{ $rate->average_rate }}</td>
          <td>
            <x-ellipsis
            edit-modal-id="editModal{{ $rate->id }}"
            delete-action="/rates/{{ $rate->id }}" />
          </td>
        </tr>
      @endforeach
    </tbody>
  </x-table>
  
  @foreach ($rates as $rate)
    <x-modal id="editModal{{ $rate->id }}" title="編集">
      <form action="/rates/{{ $rate->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">通貨</label>
          <select class="form-select" name="currency_id">
            @foreach ($currencies as $currency)
              <option value="{{ $currency->id }}" @selected($rate->currency_id === $currency->id)>{{ $currency->title }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">期末日レート</label>
          <input type="number" name="last_day_rate" step="0.01" value="{{ $rate->last_day_rate }}" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">期中平均レート</label>
          <input type="number" name="average_rate" step="0.01" value="{{ $rate->average_rate }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-modal>   
  @endforeach

  <x-modal id="createModal" title="新規作成">
    <form action="/clients/{{ $client->id }}/rates" method="post">
      @csrf
      <div class="mb-3">
        <label class="form-label">通貨</label>
        <select class="form-select" name="currency_id">
          @foreach ($currencies as $currency)
            <option value="{{ $currency->id }}">{{ $currency->title }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">期末日レート</label>
        <input type="number" name="last_day_rate" step="0.01" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">期中平均レート</label>
        <input type="number" name="average_rate" step="0.01" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">作成</button>
    </form>
  </x-modal>   
</x-layout>