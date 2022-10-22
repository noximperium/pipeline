<?php

namespace NoxImperium\RequestPipeline;

abstract class Action
{
  abstract public function process($request);
}
