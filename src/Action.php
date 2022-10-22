<?php

namespace NoxImperium\Pipeline;

abstract class Action
{
  abstract public function process($request);
}
