<?php

use NoxImperium\Pipeline\Pipeline;
use NoxImperium\Pipeline\Tests\Actions\SaveData;
use NoxImperium\Pipeline\Tests\Pipes\Authentication;
use NoxImperium\Pipeline\Tests\Pipes\Jsonify;

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

  $pipeline = Pipeline::build()
    ->addPipe(new  Authentication)
    ->addPipe(new Jsonify);

  $pipeline->run($request);
})->throws('Action has not been set.');

test('asserts passed object to `addPipe` that not extends NoxImperium\Pipeline\Pipe throw exception', function () {
  $request = [
    'auth_key' => 'afafdsf987asf98as98f7as',
    'data' => 'test data'
  ];

  $pipeline = Pipeline::build()
    ->addPipe(new TestPipe);

  $pipeline->run($request);
})->throws('Passed class on `addPipe` does not extends Pipe class.');

test('asserts passed object to `setAction` that not extends NoxImperium\Pipeline\Action throw exception', function () {
  $request = [
    'auth_key' => 'afafdsf987asf98as98f7as',
    'data' => 'test data'
  ];

  $pipeline = Pipeline::build()
    ->addPipe(new Authentication)
    ->setAction(new TestAction);

  $pipeline->run($request);
})->throws('Passed class on `setAction` does not extends Action class.');

test('asserts no pipes set throw exception', function () {
  $request = [
    'auth_key' => 'afafdsf987asf98as98f7as',
    'data' => 'test data'
  ];

  $pipeline = Pipeline::build()
    ->setAction(new SaveData);

  $pipeline->run($request);
})->throws('No pipe has been added.');

test('asserts valid pipes and action returns processed data.', function () {
  $request = [
    'auth_key' => 'afafdsf987asf98as98f7as',
    'data' => 'test data'
  ];

  $pipeline = Pipeline::build()
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
