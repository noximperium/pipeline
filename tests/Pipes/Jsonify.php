<?php

namespace NoxImperium\RequestPipeline\Tests\Pipes;

use NoxImperium\RequestPipeline\Pipe;

class Jsonify extends Pipe
{
  public function handle($request)
  {
    $response = $this->passDown($request);

    return json_encode($response);
  }
}