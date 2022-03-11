<?php

namespace tests;

use Batch01;
use PHPUnit\Framework\TestCase;
use pizza\Ingredient;
use pizza\IngredientCatalog;
use pizza\Pizza;
use pizza\PizzaCatalog;
use pizza\Runner;
class BTest extends TestCase
{

    function testExistsPizza()
    {
        $pizza = Runner::getCatalog()->getPizza('MacDac Pizza');
        self::assertEquals('MacDac Pizza',$pizza->getName());
    }

    function testOrdering()
    {
        $pizza = Runner::getCatalog()->getPizza('MacDac Pizza');
        self::assertEquals('tomato, sausages, feta cheese', $pizza->getIngredientOrder());
        $pizza->ingredientOnTop('sausages');
        self::assertEquals('sausages, tomato, feta cheese', $pizza->getIngredientOrder());
    }

    function testTotalPrice()
    {
        $pizza = Runner::getCatalog()->getPizza('MacDac Pizza');

        self::assertEquals(3.75, $pizza->getPrice());
        $pizza->removeIngredient('tomato');
        //fwrite(STDERR, print_r($pizza, TRUE));
        self::assertEquals(3, $pizza->getPrice());
    }
}
