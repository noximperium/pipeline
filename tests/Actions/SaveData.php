<?php

namespace NoxImperium\Pipeline\Tests\Actions;

use NoxImperium\Pipeline\Action;

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
