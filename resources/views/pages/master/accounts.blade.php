<x-layout>
  <x-breadcrumb :page="MyUtil::get_page_current()" />
  <p>画面説明：xxxxx</p>
  <div class="mb-4 d-flex gap-5">
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#createModal">新規作成</button>
  </div>
  <x-table>
    <thead>
      <tr class="table-lightblue">
        <th>ID</th>
        <th>勘定科目名称</th>
        <th>勘定科目名称-英字</th>
        <th>明細/集計</th>
        <th>財務諸表区分</th>
        <th>科目分類</th>
        <th>貸借</th>
        <th>年度末開示科目</th>
        <th>四半期開示科目</th>
        <th>換算レート区分</th>
        <th>換算差額調整勘定</th>
        <th>翌年度繰越科目</th>
        <th>有効/利用不可</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($accounts as $account)
        <tr>
          <td>{{ $account->id }}</td>
          <td>{{ $account->title }}</td>
          <td>{{ $account->title_en }}</td>
          <td>{{ $account->detail_summary }}</td>
          <td>{{ $account->statement->title() }}</td>
          <td>{{ $account->category->title }}</td>
          <td>{{ $account->dr_cr }}</td>
          <td>{{ $account->yaer_disclosed_account_list->title }}</td>
          <td>{{ $account->quarter_disclosed_account_list->title }}</td>
          <td>{{ $account->conversion }}</td>
          <td>{{ $account->fctr }}</td>
          <td></td>
          <td>
            @if ($account->enabled)
              有効
            @else
              利用不可
            @endif
          </td>
          <td>
            <x-ellipsis
            edit-modal-id="editModal{{ $account->id }}"
            delete-action="/master/accounts/{{ $account->id }}" />
          </td>
        </tr>
      @endforeach
    </tbody>
  </x-table>
  
  @foreach ($accounts as $account)
    <x-modal id="editModal{{ $account->id }}" title="編集">
      <form action="/master/accounts/{{ $account->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label">勘定科目名称</label>
          <input type="text" name="title" value="{{ $account->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">勘定科目名称-英字</label>
          <input type="text" name="title_en" value="{{ $account->title_en }}" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">明細/集計</label>
          <select class="form-select" name="detail_summary">
            <option value="明細科目" @selected($account->detail_summary === '明細科目')>明細科目</option>
            <option value="集計科目" @selected($account->detail_summary === '集計科目')>集計科目</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">財務諸表区分</label>
          <select class="form-select" name="statement">
            @foreach (App\Enums\Statement::cases() as $statement)
              <option value="{{ $statement }}" @selected($account->statement === $statement)>{{ $statement->title() }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">科目分類</label>
          <select class="form-select" name="category_id">
            @foreach ($categories as $category)
              <option value="{{ $category->id }}" @selected($account->category_id === $category->id)>{{ $category->title }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">貸借</label>
          <select class="form-select" name="dr_cr">
            <option value="貸方" @selected($account->dr_cr === '貸方')>貸方</option>
            <option value="借方" @selected($account->dr_cr === '借方')>借方</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">年度末開示科目</label>
          <select class="form-select" name="year_disclosed_account_list_id">
            @foreach ($disclosed_account_lists as $list)
              <option value="{{ $list->id }}"
              @selected($account->year_disclosed_account_list_id === $list->id)>
                {{ $list->title }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">四半期開示科目</label>
          <select class="form-select" name="quarter_disclosed_account_list_id">
            @foreach ($disclosed_account_lists as $list)
              <option value="{{ $list->id }}"
              @selected($account->quarter_disclosed_account_list_id === $list->id)>
                {{ $list->title }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">換算レート区分</label>
          <select class="form-select" name="conversion">
            <option value="期末日レート" @selected($account->conversion === '期末日レート')>期末日レート</option>
            <option value="期中平均レート" @selected($account->conversion === '期中平均レート')>期中平均レート</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">換算差額調整勘定</label>
          <select class="form-select" name="fctr">
            <option value="為替換算調整勘定-換算調整" @selected($account->dr_cr === '為替換算調整勘定-換算調整')>為替換算調整勘定-換算調整</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">有効/利用不可</label>
          <x-enabled :enabled="$account->enabled" />
        </div> 
        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </x-modal>   
  @endforeach
  <x-modal id="createModal" title="新規作成">
    <form action="/master/accounts" method="post">
      @csrf
      <div class="mb-3">
        <label class="form-label">勘定科目名称</label>
        <input type="text" name="title" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">勘定科目名称-英字</label>
        <input type="text" name="title_en" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">明細/集計</label>
        <select class="form-select" name="detail_summary">
          <option value="明細科目">明細科目</option>
          <option value="集計科目">集計科目</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">財務諸表区分</label>
        <select class="form-select" name="statement">
          @foreach (App\Enums\Statement::cases() as $statement)
            <option value="{{ $statement }}">{{ $statement->title() }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">科目分類</label>
        <select class="form-select" name="category_id">
          @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->title }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">貸借</label>
        <select class="form-select" name="dr_cr">
          <option value="貸方">貸方</option>
          <option value="借方">借方</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">年度末開示科目</label>
        <select class="form-select" name="year_disclosed_account_list_id">
          @foreach ($disclosed_account_lists as $list)
            <option value="{{ $list->id }}">{{ $list->title }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">四半期開示科目</label>
        <select class="form-select" name="quarter_disclosed_account_list_id">
          @foreach ($disclosed_account_lists as $list)
            <option value="{{ $list->id }}">{{ $list->title }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">換算レート区分</label>
        <select class="form-select" name="conversion">
          <option value="期末日レート">期末日レート</option>
          <option value="期中平均レート">期中平均レート</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">換算差額調整勘定</label>
        <select class="form-select" name="fctr">
          <option value="為替換算調整勘定-換算調整">為替換算調整勘定-換算調整</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">有効/利用不可</label>
        <x-enabled />
      </div>
      <button type="submit" class="btn btn-primary">作成</button>
    </form>
  </x-modal>   
</x-layout>