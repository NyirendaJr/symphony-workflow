<?php

namespace App\Http\Controllers;

use App\Helper\StatusMarker;
use Illuminate\Http\Request;
use Symfony\Component\Workflow\DefinitionBuilder;
use Symfony\Component\Workflow\Workflow;
use Symfony\Component\Workflow\Transition;
use App\Video;
class TestController extends Controller
{
    public function index()
    {
        $definitionBuilder = new DefinitionBuilder;

        $definition = $definitionBuilder->addPlaces(['new', 'uploading', 'transcoding', 'transcoded', 'draft', 'published'])
            ->addTransition(new Transition('upload', 'new', 'uploading'))
            ->addTransition(new Transition('finish_uploading', 'uploading', 'uploaded'))
            ->addTransition(new Transition('transcode', 'uploaded', 'transcoding'))
            ->addTransition(new Transition('finish_transcoding', 'transcoding', 'transcoded'))
            ->addTransition(new Transition('prepare', 'transcoded', 'draft'))
            ->addTransition(new Transition('publish', 'draft', 'published'))
            ->build();

        $workflow = new Workflow($definition, (new StatusMarker()));

        $video = video::find(1);
        $workflow->can($video, 'upload');
        $workflow->apply($video, 'upload');

    }
}
