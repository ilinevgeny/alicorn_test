<?php

namespace pizza;

use pizza\PizzaCatalog;
use pizza\IngredientCatalog;

class Runner
{
    public static function getCatalog(): PizzaCatalog
    {
        $ingredientCatalog = new IngredientCatalog();
        $ingredientCatalog->addIngredient(new Ingredient('tomato', 0.5));
        $ingredientCatalog->addIngredient(new Ingredient('sliced mushrooms', 0.5));
        $ingredientCatalog->addIngredient(new Ingredient('feta cheese', 1));
        $ingredientCatalog->addIngredient(new Ingredient('sausages', 1));
        $ingredientCatalog->addIngredient(new Ingredient('mozzarella cheese', 1.3));
        $catalog = new PizzaCatalog();
        $catalog->addPizza(new Pizza('MacDac Pizza', $ingredientCatalog->getIngredients(array('tomato', 'sausages', 'feta cheese'))));
        $catalog->addPizza(new Pizza('Lovely Mushroom Pizza', $ingredientCatalog->getIngredients(array('tomato', 'sausages'))));
        return $catalog;
    }
};
