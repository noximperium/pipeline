<?php

namespace NoxImperium\RequestPipeline;

abstract class Pipe
{
  public $next;

  public abstract function handle($request);

  public function passDown($request)
  {
    return $this->next->handle($request);
  }

  public function setNext($next)
  {
    $this->next = $next;
  }
}
