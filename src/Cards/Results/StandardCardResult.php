<?php

namespace Cysha\Casino\Cards\Results;

use Cysha\Casino\Cards\CardCollection;
use Cysha\Casino\Cards\Contracts\CardResults;
use Cysha\Casino\Cards\Hand;
use Cysha\Casino\Cards\HandCollection;

class StandardCardResult implements CardResults
{
    /**
     * @var int
     */
    private $rank = 0;

    /**
     * @var array
     */
    private $value = [];

    /**
     * @var CardCollection
     */
    private $cards;

    /**
     * @var string
     */
    private $definition = null;

    /**
     * @var HandCollection
     */
    private $hand = null;

    /**
     *
     */
    public function __construct(int $rank, array $value, CardCollection $cards, string $definition, Hand $hand)
    {
        $this->rank = $rank;
        $this->value = $value;
        $this->cards = $cards;
        $this->definition = $definition;
        $this->hand = $hand;
    }

    /**
     * @return int
     */
    public function rank(): int
    {
        return $this->rank;
    }

    /**
     * @return array
     */
    public function value(): array
    {
        return $this->value;
    }

    /**
     * @return CardCollection
     */
    public function cards(): CardCollection
    {
        return $this->cards;
    }

    /**
     * @return string
     */
    public function definition(): string
    {
        return $this->definition;
    }

    /**
     * @return Hand
     */
    public function hand(): Hand
    {
        return $this->hand;
    }
}
