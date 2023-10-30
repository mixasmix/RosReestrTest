<?php

declare(strict_types = 1);

namespace App\VO;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Attrs
{
    #[ORM\Column(type: Types::STRING)]
    private string $plotId;

    #[ORM\Column(type: Types::INTEGER)]
    private int $plotArea;

    #[ORM\Column(type: Types::FLOAT)]
    private float $plotPrice;

    #[ORM\Column(type: Types::STRING)]
    private string $plotNumber;

    #[ORM\Column(type: Types::STRING)]
    private string $plotAddress;
    #[ORM\Column(type: Types::STRING)]
    private string $categoryCode;

    #[ORM\Column(type: Types::STRING)]
    private string $categoryName;

    #[ORM\Column(type: Types::INTEGER)]
    private int $plotAreaInaccuracy;

    #[ORM\Column(type: Types::STRING)]
    private string $permittedUseDocumentName;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $permittedUseClassifierCode;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $permittedUseClassifierName;

    /**
     * @param string $plotId
     * @param int $plotArea
     * @param int $plotPrice
     * @param string $plotNumber
     * @param string $plotAddress
     * @param string $categoryCode
     * @param string $categoryName
     * @param int $plotAreaInaccuracy
     * @param string $permittedUseDocumentName
     * @param string|null $permittedUseClassifierCode
     * @param string|null $permittedUseClassifierName
     */
    public function __construct(
        string $plotId,
        int $plotArea,
        float $plotPrice,
        string $plotNumber,
        string $plotAddress,
        string $categoryCode,
        string $categoryName,
        int $plotAreaInaccuracy,
        string $permittedUseDocumentName,
        ?string $permittedUseClassifierCode,
        ?string $permittedUseClassifierName
    ) {
        $this->plotId = $plotId;
        $this->plotArea = $plotArea;
        $this->plotPrice = $plotPrice;
        $this->plotNumber = $plotNumber;
        $this->plotAddress = $plotAddress;
        $this->categoryCode = $categoryCode;
        $this->categoryName = $categoryName;
        $this->plotAreaInaccuracy = $plotAreaInaccuracy;
        $this->permittedUseDocumentName = $permittedUseDocumentName;
        $this->permittedUseClassifierCode = $permittedUseClassifierCode;
        $this->permittedUseClassifierName = $permittedUseClassifierName;
    }

    public function getPlotId(): string
    {
        return $this->plotId;
    }

    public function getPlotArea(): int
    {
        return $this->plotArea;
    }

    public function getPlotPrice(): float
    {
        return $this->plotPrice;
    }

    public function getPlotNumber(): string
    {
        return $this->plotNumber;
    }

    public function getPlotAddress(): string
    {
        return $this->plotAddress;
    }

    public function getCategoryCode(): string
    {
        return $this->categoryCode;
    }

    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    public function getPlotAreaInaccuracy(): int
    {
        return $this->plotAreaInaccuracy;
    }

    public function getPermittedUseDocumentName(): string
    {
        return $this->permittedUseDocumentName;
    }

    public function getPermittedUseClassifierCode(): ?string
    {
        return $this->permittedUseClassifierCode;
    }

    public function getPermittedUseClassifierName(): ?string
    {
        return $this->permittedUseClassifierName;
    }
}
