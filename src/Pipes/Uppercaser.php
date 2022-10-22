<?php

namespace NoxImperium\RequestPipeline\Pipes;

use NoxImperium\RequestPipeline\Pipe;

class Uppercaser extends Pipe
{
  public function handle($request)
  {
    return [
      'status' => '200',
      'text' => 'success',
      'data' => strtoupper($request['data']),
    ];
  }
}
