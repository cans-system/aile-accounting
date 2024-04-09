<header>
  <div class="bg-text-blue px-4">
    <div class="d-flex justify-content-between align-items-center py-2">
      <h1 class="mb-0 h2">
        <a class="text-decoration-none p-2 text-reset" href="/">
          AILE system
        </a>
      </h1>
      <ul class="d-flex gap-4 list-unstyled mb-0">
        <li>
          <a class="text-decoration-none p-2 text-reset" href="{{ url()->current() }}" target="_blank">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
          </a>
        </li>
        <li><a class="text-decoration-none p-2 text-reset" href="">0000年00月期第0四半期</a></li>
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
									<button class="dropdown-item" href="/logout">ログアウト</button>
								</form>
							</li>
            </ul>
          </div>
        </li>
        <li><a class="text-decoration-none p-2 text-reset" href="">設定</a></li>
        <li><a class="text-decoration-none p-2 text-reset" href="">サポート</a></li>
      </ul>
    </div>
    <ul class="d-flex gap-4 list-unstyled mb-0">
      @foreach (config('app.pages') as $page)
        <li class="position-relative hover">
          <a class="text-decoration-none p-2 text-reset d-block" role="button">{{ $page[0] }}</a>
          <div class="position-absolute top-100 bg-text-blue p-3 hover-list z-1" style="width: 900px; display: none;">
            <div class="" style="column-count: 3;">
              @foreach ($page[2] as $child)
                <div class="col mb-4" style="break-inside: avoid;">
                  <h5>{{ $child[0] }}</h5>
                  <ul class="ps-4">
                    @foreach ($child[1] as $grandchild)
                      <li class="mb-1">
                        @if ($grandchild[2])
                          <a class="text-decoration-none text-reset" href="{{ $page[1] }}{{ $grandchild[1] }}">{{ $grandchild[0] }}</a>  
                        @else
                          <span class="opacity-25">{{ $grandchild[0] }}</span>
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