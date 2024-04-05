<header>
  <div class="bg-text-blue fw-bold px-4">
    <div class="d-flex justify-content-between align-items-center py-3">
      <h1 class="mb-0">
        <a class="text-decoration-none p-2 text-reset" href="/">
          AILE system
        </a>
      </h1>
      <ul class="d-flex gap-4 fs-5 list-unstyled mb-0">
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
    <ul class="d-flex gap-4 fs-5 list-unstyled mb-0 pb-2">
      @foreach (MyUtil::getParentPages() as $page)
        <li class="position-relative hover">
          <a class="text-decoration-none p-2 text-reset" role="button">{{ $page->title }}</a>
          <div class="position-absolute top-100 bg-text-blue p-3 pt-4 hover-list" style="width: 900px; display: none;">
            @foreach ($page->children as $child)
              <div class="mb-2">
                <h4 class="fw-bold">{{ $child->title }}</h4>
                <ul>
                  @foreach ($child->children as $grandchild)
                    <li><a class="text-decoration-none text-reset" href="{{ $page->path }}{{ $grandchild->path }}">{{ $grandchild->title }}</a></li>
                  @endforeach
                </ul>
              </div>
            @endforeach
          </div>
        </li>
      @endforeach
    </ul>
  </div>
</header>