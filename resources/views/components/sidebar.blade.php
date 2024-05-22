@php
  $user = Auth::user();
  $client = $user->client;
@endphp
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
                {{ date('Y年n月期', strtotime($selected_term->month)) }}_{{ $selected_term->type->title() }}
              @else
                会計期間が選択されていません
              @endif
            </a>
            <ul class="dropdown-menu">
              @foreach ($client->terms as $term)
                <li>
                  <form action="/change_term" method="post">
                    @csrf
                    <input type="hidden" name="term_id" value="{{ $term->id }}">
                    <button class="dropdown-item">
                      {{ date('Y年n月期', strtotime($term->month)) }}_{{ $term->type->title() }}
                    </button>
                  </form>
                </li>
              @endforeach
            </ul>
          </div>
        </li>
        <li><a class="text-decoration-none p-2 text-reset" href="">{{ $client->title }}</a></li>
        <li>
          <div class="dropdown">
            <a class="text-decoration-none p-2 text-reset dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ $user->name }}
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ $user->link() }}">アカウント設定</a></li>
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
          <a class="text-decoration-none p-2 text-reset d-block" role="button">
            AileSystem
          </a>
          <div class="position-absolute top-100 bg-text-blue p-3 hover-list z-1" style="width: 900px; display: none; left: {{ $big_group->left }}px">
            <div class="" style="column-count: 3;">
              @foreach ($big_group->small_groups as $small_group)
                <div class="col mb-4" style="break-inside: avoid;">
                  <h5>{{ $small_group->title }}</h5>
                  <ul class="ps-4">
                    @foreach ($small_group->pages as $pages)
                      <li class="mb-1">
                        @if ($pages->enabled)
                          <a class="text-decoration-none text-reset" href="/clients/{{ $client->id }}/{{ $pages->path }}">
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

<header class="border-end border-2 text-bg-white" id="header-sideber">
  <div class="sticky-top container vh-100 px-3 py-4 d-flex flex-column">
    <h1 class="mb-5">
      <a href="/home" class="text-black" style="text-decoration: none;">
        <img src="{{ asset('img/logo_yoko.png') }}" alt="" style="width: 220px;">
      </a>
    </h1>
    <nav id="navbar-example2" class="mb-auto">
      <ul class="nav nav-pills flex-column gap-1 mb-4">
        @foreach ($menu_list as $item)
          <li class="nav-item">
            <a
              class="nav-link nav-link-hover {{ request()->routeIs($item[3]) ? 'active bg-gradient' : 'link-body-emphasis' }}"
              href="{{ $item[0] }}"
            >
              <span class="text-center d-inline-block me-4" style="width: 16px;">
                <i data-lucide="{{ $item[2] }}"></i>
              </span>{{ $item[1] }}
            </a>
          </li>
        @endforeach
      </ul>
      @if(Auth::user()->isAdmin())
        <div class="fs-6 ps-2 mb-2">管理者メニュー</div>
        <ul class="nav nav-pills flex-column gap-1">
          @foreach ($admin_menu_list as $item)
            <li class="nav-item">
              <a href="{{ $item[0] }}" class="nav-link nav-link-hover {{ request()->routeIs($item[3]) ? 'active bg-gradient' : 'link-body-emphasis' }}">
                <span class="text-center d-inline-block me-4" style="width: 16px;">
                  <i data-lucide="{{ $item[2] }}"></i>
                </span>{{ $item[1] }}
              </a>
            </li>
          @endforeach
        </ul>
        @endif
      </ul>
      @if(Auth::user()['role'] === 'SUSPENDED')
        <div class="alert alert-danger mt-2 mb-0" role="alert">
          <span class="text-danger">
            <i class="fa-solid fa-circle-exclamation"></i>
          </span>
          アカウントが利用停止されています<br>
          <small>ご利用を再開するには管理者に<a href="/support">お問い合わせ</a>ください</small>
        </div>
      @endif
    </nav>
    <div class="dropdown">
      <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ Auth::user()->email }}
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="/users/{{ Auth::user()['id'] }}">アカウント設定</a></li>
        <li>
          <form action="/logout" method="post">
            @csrf
            <button class="dropdown-item" href="/logout">ログアウト</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</header>