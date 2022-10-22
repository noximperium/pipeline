<?php

use NoxImperium\RequestPipeline\RequestPipeline;
use NoxImperium\RequestPipeline\Tests\Actions\SaveData;
use NoxImperium\RequestPipeline\Tests\Pipes\Authentication;
use NoxImperium\RequestPipeline\Tests\Pipes\Jsonify;

require __DIR__ . '/../../vendor/autoload.php';

class TestPipe
{
}

class TestAction
{
}

test('asserts missing action throw exception', function () {
  $request = [
    'auth_key' => 'afafdsf987asf98as98f7as',
    'data' => 'test data'
  ];

  $pipeline = RequestPipeline::build()
    ->addPipe(new  Authentication)
    ->addPipe(new Jsonify);

  $pipeline->run($request);
})->throws('Action has not been set.');

test('asserts passed object to `addPipe` that not extends NoxImperium\RequestPipeline\Pipe throw exception', function () {
  $request = [
    'auth_key' => 'afafdsf987asf98as98f7as',
    'data' => 'test data'
  ];

  $pipeline = RequestPipeline::build()
    ->addPipe(new TestPipe);

  $pipeline->run($request);
})->throws('Passed class on `addPipe` does not extends Pipe class.');

test('asserts passed object to `setAction` that not extends NoxImperium\RequestPipeline\Action throw exception', function () {
  $request = [
    'auth_key' => 'afafdsf987asf98as98f7as',
    'data' => 'test data'
  ];

  $pipeline = RequestPipeline::build()
    ->addPipe(new Authentication)
    ->setAction(new TestAction);

  $pipeline->run($request);
})->throws('Passed class on `setAction` does not extends Action class.');

test('asserts no pipes set throw exception', function () {
  $request = [
    'auth_key' => 'afafdsf987asf98as98f7as',
    'data' => 'test data'
  ];

  $pipeline = RequestPipeline::build()
    ->setAction(new SaveData);

  $pipeline->run($request);
})->throws('No pipe has been added.');

test('asserts valid pipes and action returns processed data.', function () {
  $request = [
    'auth_key' => 'afafdsf987asf98as98f7as',
    'data' => 'test data'
  ];

  $pipeline = RequestPipeline::build()
    ->addPipe(new Authentication)
    ->addPipe(new Jsonify)
    ->setAction(new SaveData);

  $response = $pipeline->run($request);

  $expectedResponse = [
    'status' => 201,
    'text' => 'Created'
  ];

  expect($response)->toBe(json_encode($expectedResponse));
});
