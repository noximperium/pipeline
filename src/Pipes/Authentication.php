<?php

namespace NoxImperium\RequestPipeline\Pipes;

use NoxImperium\RequestPipeline\Pipe;

class Authentication extends Pipe
{
  public function handle($request)
  {
    if (!isset($request['id'])) return [
      'status' => 401,
      'text' => 'Unauthenticated'
    ];

    return $this->passDown($request);
  }
}
