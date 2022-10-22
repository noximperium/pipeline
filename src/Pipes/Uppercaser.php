<?php

namespace NoxImperium\RequestPipeline\Pipes;

use NoxImperium\RequestPipeline\Pipe;

class Uppercaser extends Pipe
{
  public function handle($request)
  {
    $request['data'] = strtoupper($request['data']);

    return $this->passDown($request);
  }
}
