<?php
namespace App\Libs;

use App\Models\Page;
use Illuminate\Support\Facades\DB;

class MyUtil {
  public static function url_param_change($par=Array(),$op=0) {
    $url = parse_url($_SERVER["REQUEST_URI"]);
    if(isset($url["query"])) parse_str($url["query"],$query);
    else $query = Array();
    foreach($par as $key => $value){
        if($key && is_null($value)) unset($query[$key]);
        else $query[$key] = $value;
    }
    $query = str_replace("=&", "&", http_build_query($query));
    $query = preg_replace("/=$/", "", $query);
    return $query ? (!$op ? "?" : "").htmlspecialchars($query, ENT_QUOTES) : "";
  }
  
  public static function pagenation($posts_par_page, $posts_sum, $page) {
    $first = 1;
    $last = ceil($posts_sum / $posts_par_page);
    $offset = $posts_par_page * ($page - 1);
    return [
      "current" => $page,
      "pprev" => $page - 2 < $first ? false : $page - 2,
      "prev" => $page - 1 < $first ? false : $page - 1,
      "next" => $page + 1 > $last ? false : $page + 1,
      "nnext" => $page + 2 > $last ? false : $page + 2,
      "first" => $page - 2 < $first ? false : $first,
      "last" => $page + 2 > $last ? false : $last,
      "last_page" => $last,
      "offset" => $offset,
      "sum" => $posts_sum,
      "current_start" => $offset + 1,
      "current_end" => $posts_sum < $offset + $posts_par_page ? $posts_sum : $offset + $posts_par_page,
    ];
  }

  public static function array_str($array, $delimiter=", ") {
    $str = "";
    if (empty($array)) {
      return $str;
    }
    $last = array_slice($array, -1)[0];
    foreach ($array as $item) {
      $str .= $item;
      if ($item !== $last) $str .= $delimiter;
    }
    return $str;
  }  
}