<?php

declare(strict_types=1);

namespace Doctrine\Tests\Models\ValueConversionType;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @Entity
 * @Table(name="vct_inversed_manytomany_compositeid")
 */
class InversedManyToManyCompositeIdEntity
{
    /**
     * @var string
     * @Column(type="rot13")
     * @Id
     */
    public $id1;

    /**
     * @var string
     * @Column(type="rot13")
     * @Id
     */
    public $id2;

    /**
     * @psalm-var Collection<int, OwningManyToManyCompositeIdEntity>
     * @ManyToMany(targetEntity="OwningManyToManyCompositeIdEntity", mappedBy="associatedEntities")
     */
    public $associatedEntities;

    public function __construct()
    {
        $this->associatedEntities = new ArrayCollection();
    }
}
