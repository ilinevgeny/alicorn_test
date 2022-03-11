<?php
namespace pizza;
use pizza\Ingredient;

class IngredientCatalog
{
    protected array $ingredientCollection = array();

    /**
     * @param Ingredient $ingredient
     */
    public function addIngredient(Ingredient $ingredient): void
    {
        $this->ingredientCollection[$ingredient->getName()] = $ingredient;
    }

    /**
     * @param $namesArr
     * @return array
     */
    public function getIngredients($namesArr): array
    {
        $ingArr = array();
        foreach ($namesArr as $name) {
            $ingArr[$name] = $this->ingredientCollection[$name];
        }
        return $ingArr;
    }

    public function getIngredient($name) : Ingredient
    {
        return $this->ingredientCollection[$name];
    }
}
