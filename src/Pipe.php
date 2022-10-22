<?php

namespace NoxImperium\RequestPipeline;

abstract class Pipe
{
  private $next = null;
  private $action = null;

  public abstract function handle($request);

  public function passDown($request)
  {
    if ($this->action !== null) return $this->action->process($request);
    return $this->next->handle($request);
  }

  public function setNext($next)
  {
    $this->next = $next;
  }

  public function setAction($action)
  {
    $this->action = $action;
  }
}
