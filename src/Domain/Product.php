<?php

namespace Archel\TellDontAsk\Domain;

/**
 * Class Product
 * @package Archel\TellDontAsk\Domain
 */
class Product
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;

    /**
     * @var Category
     */
    private $category;

    private function __construct()
    {
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    private function setName(string $name) : void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPrice() : float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    private function setPrice(float $price) : void
    {
        $this->price = $price;
    }

    /**
     * @return Category
     */
    public function getCategory() : Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    private function setCategory(Category $category) : void
    {
        $this->category = $category;
    }

    public static function create(string $name, float $price, Category $category): self
    {
        $product = new self();
        $product->setName($name);
        $product->setPrice($price);
        $product->setCategory($category);

        return $product;
    }


}