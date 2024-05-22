<x-layout>
  <x-breadcrumb client_id="{{ $client->id }}" />
  <p>画面説明：xxxxx</p>
  <div class="mb-4 d-flex gap-5">
    {{-- <button class="btn button" data-bs-toggle="modal" data-bs-target="#createCompany">新規作成</button> --}}
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
</x-layout>