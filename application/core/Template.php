<?php

namespace Core;

class Template
{
  public static function treat(string &$content, string $extension)
  {
    if(! '.html' === $extension) return false;
  }
}
