<?php


namespace App\Helper;
use App\Status;
use Symfony\Component\Workflow\Marking;
use Symfony\Component\Workflow\MarkingStore\MarkingStoreInterface;

class StatusMarker implements MarkingStoreInterface
{

    protected $videoStatus;

    public function __construct(Status $videoStatus)
    {
        $this->videoStatus = $videoStatus;
    }

    /**
     * Gets a Marking from a subject.
     *
     * @param object $subject A subject
     *
     * @return Marking The marking
     */
    public function getMarking($subject)
    {

        // TODO: Implement getMarking() method.
        return new Marking([$subject->status->slug => 1]);
    }

    /**
     * Sets a Marking to a subject.
     *
     * @param object $subject A subject
     * @param Marking $marking
     */
    public function setMarking($subject, Marking $marking)
    {
        // TODO: Implement setMarking() method.
        $status = Status::where('slug', '=', key($marking->getPlaces()))
            ->firstOrFail();

        $subject->status()->associate($status);
        $subject->save();

    }
}
