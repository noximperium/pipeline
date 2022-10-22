<?php

namespace NoxImperium\Pipeline\Tests\Pipes;

use NoxImperium\Pipeline\Pipe;

class Authentication extends Pipe
{
  public function handle($request)
  {
    if (!isset($request['auth_key'])) return $this->getMissingHeaderResponse();
    if ($request['auth_key'] === null) return $this->getUnauthenticatedResponse();

    return $this->passDown($request);
  }

  private function getMissingHeaderResponse()
  {
    return [
      'status' => 400,
      'text' => 'Missing authentication key in header.'
    ];
  }

  private function getUnauthenticatedResponse()
  {
    return [
      'status' => 401,
      'text' => 'Unauthenticated'
    ];
  }
}
