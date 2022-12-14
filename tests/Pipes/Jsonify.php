<?php

namespace NoxImperium\Pipeline\Tests\Pipes;

use NoxImperium\Pipeline\Pipe;

class Jsonify extends Pipe
{
  public function handle($request)
  {
    $response = $this->next($request);

    return json_encode($response);
  }
}
