<?php

namespace NoxImperium\RequestPipeline\Tests\Actions;

use NoxImperium\RequestPipeline\Action;

class SaveData extends Action
{
  public function process($request)
  {
    return [
      'status' => 201,
      'text' => 'Created'
    ];
  }
}
