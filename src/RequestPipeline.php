<?php

namespace NoxImperium\RequestPipeline;

use Exception;

class RequestPipeline
{
  private $pipes = [];
  private $action;

  private function __construct($pipes)
  {
    $this->pipes = $pipes;
  }

  public static function build()
  {
    return new RequestPipeline([]);
  }

  public static function from($pipes)
  {
    $lastIndex = count($pipes) - 1;

    for ($i = 0; $i < $lastIndex; $i++) {
      if ($i !== $lastIndex) $pipes[$i]->next = $pipes[$i + 1];
    }

    return new RequestPipeline($pipes);
  }

  public function addPipe($pipe)
  {
    if (get_parent_class($pipe) !== "NoxImperium\\RequestPipeline\\Pipe") {
      throw new Exception('Passed class on `addPipe` does not extends Pipe class.');
    }

    $this->pipes[] = $pipe;

    $lastPipeIndex = count($this->pipes) - 1;
    if ($lastPipeIndex > 0) {
      $this->pipes[$lastPipeIndex - 1]->setNext($this->pipes[$lastPipeIndex]);
    }

    return $this;
  }

  public function setAction($action)
  {
    if (get_parent_class($action) !== "NoxImperium\\RequestPipeline\\Action") {
      throw new Exception('Passed class on `setAction` does not extends Action class.');
    }

    $this->action = $action;

    return $this;
  }

  public function run($request)
  {
    $lastIndex = count($this->pipes) - 1;
    $this->pipes[$lastIndex]->setAction($this->action);

    return $this->pipes[0]->handle($request);
  }
}
