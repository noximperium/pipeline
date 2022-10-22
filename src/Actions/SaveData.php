<?php

namespace NoxImperium\RequestPipeline\Actions;

use NoxImperium\RequestPipeline\Action;

class SaveData extends Action
{
  public function process($request)
  {
    return [
      'status' => '200',
      'text' => 'success',
      'data' => $request['data'],
    ];
  }
}
