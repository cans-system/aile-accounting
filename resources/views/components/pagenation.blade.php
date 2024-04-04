<ul class="pagination mb-0 mt-4" style="justify-content: center;">
  @if ($pgnt["first"])
    <li class="page-item">
      <button name="page" value="{{ $pgnt["first"] }}" form="params" class="page-link" href="#">
        <i class="fa-solid fa-angles-left"></i>
      </button>
    </li>
  @endif
  @if ($pgnt["pprev"])
    <li class="page-item">
      <button name="page" value="{{ $pgnt["pprev"]  }}" form="params" class="page-link" href="#">
        {{ $pgnt["pprev"] }}
      </button>
    </li>
  @endif
  @if ($pgnt["prev"])
    <li class="page-item">
      <button name="page" value="{{ $pgnt["prev"]  }}" form="params" class="page-link" href="#">
        {{ $pgnt["prev"] }}
      </button>
    </li>
  @endif
  @if ($pgnt["current"])
    <li class="page-item">
      <button name="page" value="{{ $pgnt["current"] }}" form="params" class="page-link active" href="#">
        {{ $pgnt["current"] }}
      </button>
    </li>
  @endif
  @if ($pgnt["next"])
    <li class="page-item">
      <button name="page" value="{{ $pgnt["next"]  }}" form="params" class="page-link" href="#">
        {{ $pgnt["next"] }}
      </button>
    </li>
  @endif
  @if ($pgnt["nnext"])
    <li class="page-item">
      <button name="page" value="{{ $pgnt["nnext"]  }}" form="params" class="page-link" href="#">
        {{ $pgnt["nnext"] }}
      </button>
    </li>
  @endif
  @if ($pgnt["last"])
    <li class="page-item">
      <button name="page" value="{{ $pgnt["last"]  }}" form="params" class="page-link" href="#">
        <i class="fa-solid fa-angles-right"></i>
      </button>
    </li>
  @endif
</ul>
