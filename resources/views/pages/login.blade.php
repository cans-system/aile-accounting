<!DOCTYPE html>
<html lang="ja" class="vh-100">
<x-head />
<body>
<main>
  <div class="vh-100 d-flex align-items-center justify-content-center">
    <div class="card" style="width: 330px;">
      <div class="card-body">
        <form action="/login" method="post">
          @csrf
          <h1 class="h3 mb-3 fw-normal">ログイン</h1>
          <div class="form-floating">
            <input type="email" class="form-control" name="email" placeholder="" autocomplete="username" value="{{ old('email') }}" required>
            <label for="floatingInput">メールアドレス</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" name="password" autocomplete="current-password" placeholder="" required>
            <label for="floatingPassword">パスワード</label>
          </div>
          <button class="btn btn-primary w-100 py-2" type="submit">ログイン</button>
          <p class="mt-5 mb-3 text-body-secondary">&copy; {{ config('app.name') }}</p>
          </form>
      </div>
    </div>
  </div>
</main>
<x-toast />
</body>
</html>