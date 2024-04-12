<header>
  <div class="bg-text-blue px-4">
    <div class="d-flex justify-content-between align-items-center py-2">
      <h1 class="mb-0 h2">
        <a class="text-decoration-none p-2 text-reset" href="/">
          AILE system
        </a>
      </h1>
      <ul class="d-flex align-items-center gap-4 list-unstyled mb-0">
        <li>
          <a class="text-decoration-none p-2 text-reset" href="{{ url()->current() }}" target="_blank">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
          </a>
        </li>
        <li>
          <div class="dropdown">
            <a class="text-decoration-none p-2 text-reset dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              @if ($selected_term = Session::get('selected_term'))
                {{ date('Y年n月期', strtotime($selected_term->month)) }}_{{ $selected_term->type }}
              @else
                会計期間が選択されていません
              @endif
            </a>
            <ul class="dropdown-menu">
              @foreach (Auth::user()->client->terms as $term)
                <li>
                  <form action="/change_term" method="post">
                    @csrf
                    <input type="hidden" name="term_id" value="{{ $term->id }}">
                    <button class="dropdown-item">
                      {{ date('Y年n月期', strtotime($term->month)) }}_{{ $term->type }}
                    </button>
                  </form>
                </li>
              @endforeach
            </ul>
          </div>
        </li>
        <li><a class="text-decoration-none p-2 text-reset" href="">{{ request()->user()->client->title }}</a></li>
        <li>
          <div class="dropdown">
            <a class="text-decoration-none p-2 text-reset dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ request()->user()->name }}
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ request()->user()->link() }}">アカウント設定</a></li>
							<li><hr class="dropdown-divider"></li>
							<li>
								<form action="/logout" method="post">
									@csrf
									<button class="dropdown-item">ログアウト</button>
								</form>
							</li>
            </ul>
          </div>
        </li>
        <li><a class="text-decoration-none p-2 text-reset" href="">設定</a></li>
        <li><a class="text-decoration-none p-2 text-reset" href="">サポート</a></li>
        <li><a class="btn btn-light btn-sm" href="/admin/clients">ユーザー企業一覧</a></li>
      </ul>
    </div>
    <ul class="d-flex gap-4 list-unstyled mb-0">
      @foreach ($big_groups as $big_group)
        <li class="position-relative hover">
          <a class="text-decoration-none p-2 text-reset d-block" role="button">{{ $big_group->title }}</a>
          <div class="position-absolute top-100 bg-text-blue p-3 hover-list z-1" style="width: 900px; display: none;">
            <div class="" style="column-count: 3;">
              @foreach ($big_group->small_groups as $small_group)
                <div class="col mb-4" style="break-inside: avoid;">
                  <h5>{{ $small_group->title }}</h5>
                  <ul class="ps-4">
                    @foreach ($small_group->pages as $pages)
                      <li class="mb-1">
                        @if ($pages->enabled)
                          <a class="text-decoration-none text-reset" href="/{{ $big_group->path }}/{{ $pages->path }}">
                            {{ $pages->title }}
                          </a>  
                        @else
                          <span class="opacity-25">{{ $pages->title }}</span>
                        @endif
                      </li>
                    @endforeach
                  </ul>
                </div>
              @endforeach
            </div>
          </div>
        </li>
      @endforeach
    </ul>
  </div>
</header>