<?php

namespace NoxImperium\RequestPipeline;

use Exception;

class RequestPipeline
{
  private $pipes = [];

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

    for($i = 0; $i < $lastIndex; $i++) {
      if ($i !== $lastIndex) $pipes[$i]->next = $pipes[$i + 1];
    }

    return new RequestPipeline($pipes);
  }

  public function addPipe($pipe)
  {
    if (get_parent_class($pipe) !== "NoxImperium\\RequestPipeline\\Pipe") throw new Exception('This class does not extends Pipe class.');

    $this->pipes[] = $pipe;

    $lastPipeIndex = count($this->pipes) - 1;
    if ($lastPipeIndex > 0) {
      $this->pipes[$lastPipeIndex - 1]->setNext($this->pipes[$lastPipeIndex]);
    }

    return $this;
  }

  public function execute($request)
  {
    return $this->pipes[0]->handle($request);
  }
}
