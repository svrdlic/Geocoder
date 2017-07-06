<?php

declare(strict_types=1);

/*
 * This file is part of the Geocoder package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

namespace Geocoder\Provider\GoogleMaps\Model;

use Geocoder\Model\Address;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class GoogleAddress extends Address
{
    /**
     * @var string|null
     */
    private $locationType;

    /**
     * @var array
     */
    private $resultType = [];

    /**
     * @var string|null
     */
    private $formattedAddress;

    /**
     * @var string|null
     */
    private $subpremise;

    /**
     * @var SubLocalityLevelCollection
     */
    private $subLocalityLevels;

    /**
     * @param null|string $locationType
     *
     * @return GoogleAddress
     */
    public function withLocationType(string $locationType = null)
    {
        $new = clone $this;
        $new->locationType = $locationType;

        return $new;
    }

    /**
     * @return null|string
     */
    public function getLocationType()
    {
        return $this->locationType;
    }

    /**
     * @return array
     */
    public function getResultType(): array
    {
        return $this->resultType;
    }

    /**
     * @param array $resultType
     *
     * @return GoogleAddress
     */
    public function withResultType(array $resultType)
    {
        $new = clone $this;
        $new->resultType = $resultType;

        return $new;
    }

    /**
     * @return null|string
     */
    public function getFormattedAddress()
    {
        return $this->formattedAddress;
    }

    /**
     * @param null|string $formattedAddress
     */
    public function withFormattedAddress(string $formattedAddress = null)
    {
        $new = clone $this;
        $new->formattedAddress = $formattedAddress;

        return $new;
    }

    /**
     * @return null|string
     */
    public function getSubpremise()
    {
        return $this->subpremise;
    }

    /**
     * @param null|string $subpremise
     */
    public function withSubpremise(string $subpremise = null)
    {
        $new = clone $this;
        $new->subpremise = $subpremise;

        return $new;
    }

    /**
     * @return array
     */
    public function getSubLocalityLevels()
    {
        return $this->subLocalityLevels;
    }


    /**
     * @param array $subLocalityLevel
     * @return $this
     */
    public function withSubLocalityLevel(array $subLocalityLevel)
    {
        $subLocalityLevels = [];
        foreach ($subLocalityLevel as $level)
        {

            if (empty($level['level'])) {
                continue;
            }

            $name = $level['name'] ?? $level['code'] ?? null;
            if (empty($name)) {
                continue;
            }

            $subLocalityLevels[] = new SubLocalityLevel($level['level'], $name, $level['code'] ?? null);
        }

		$new = clone $this;
		$new->subLocalityLevels = new SubLocalityLevelCollection($subLocalityLevels);

		return $new;
    }
}