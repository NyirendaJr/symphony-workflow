<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Helper\StatusMarker;
use App\Order;
use Symfony\Component\Workflow\DefinitionBuilder;
use Symfony\Component\Workflow\Transition;
use Symfony\Component\Workflow\Workflow;


Route::get('/', function () {

    $definitionBuilder = new DefinitionBuilder;

    $definition = $definitionBuilder->addPlaces(['new', 'uploading', 'uploaded', 'transcoding', 'transcoded', 'draft', 'published'])
        ->addTransition(new Transition('upload', 'new', 'uploading'))
        ->addTransition(new Transition('finish_uploading', 'uploading', 'uploaded'))
        ->addTransition(new Transition('transcode', 'uploaded', 'transcoding'))
        ->addTransition(new Transition('finish_transcoding', 'transcoding', 'transcoded'))
        ->addTransition(new Transition('prepare', 'transcoded', 'draft'))
        ->addTransition(new Transition('publish', 'draft', 'published'))
        ->build();

    $status = \App\Status::all();
    for ($x = 1; $x < count($status); $x++) {
        $videoStatus = \App\Status::find($x);
        $workflow = new Workflow($definition, (new StatusMarker($videoStatus)));
        $video = Order::find(1);

        //$workflow->setMarking($video);
        //$workflow->getMarking($video);

        $workflow->can($video, '');
        $workflow->apply($video, '');
    }

});
