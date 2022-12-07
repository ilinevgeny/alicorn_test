<?php
namespace pizza;

interface PizzaInterface
{
    public function getPrice();
    public function addIngredient(Ingredient $item = null);
    public function removeIngredient(string $name);
}

class Pizza implements PizzaInterface
{
    protected string $name;
    protected float $price = 0;
    protected array $ingredientCollection = array();
    protected array $ingredientOrder = array();

    public function __construct($name, $ingredientCollection)
    {
        $this->name = $name;
        foreach ($ingredientCollection as $item)
        {
            $this->addIngredient($item);
        }
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        $this->price = 0;
        foreach ($this->ingredientCollection as $item)
        {
            $this->price += $item->getPrice();
        }
        return $this->price + ($this->price / 2);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param Ingredient|null $item
     * @return void
     */
    public function addIngredient(Ingredient $item = null)
    {
        $this->ingredientCollection[$item->getName()] = $item;
        $this->ingredientOrder[$item->getName()] = count($this->ingredientOrder);
    }

    /**
     * @param string $name
     * @return void
     */
    public function removeIngredient(string $name): void
    {
        unset($this->ingredientCollection[$name]);
        unset($this->ingredientOrder[$name]);
        $this->ingredientOrder = array_flip(array_values(array_flip($this->ingredientOrder)));
    }

    /**
     * @param $name
     * @return void
     */
    public function ingredientOnTop($name): void
    {
        if(!array_key_exists($name, $this->ingredientOrder))
            return;
        unset($this->ingredientOrder[$name]);
        $this->ingredientOrder = array_flip($this->ingredientOrder);
        array_unshift($this->ingredientOrder, $name);
        $this->ingredientOrder = array_flip($this->ingredientOrder);
    }

    public function getIngredientOrder(): string
    {
        return implode(', ', array_keys($this->ingredientOrder));
    }
}

interface PizzaCatalogInterface
{
    /**
     * @param Pizza $pizza
     * @return mixed
     */
    public function addPizza(Pizza $pizza);

    /**
     * @param string $name
     * @return mixed
     */
    public function removePizza(string $name);
}

class PizzaCatalog implements PizzaCatalogInterface
{
    protected array $collectionPizza = array();

    /**
     * @param Pizza $pizza
     * @return void
     */
    public function addPizza(Pizza $pizza): void
    {
        $this->collectionPizza[$pizza->getName()] = $pizza;
    }

    /**
     * @param string $name
     * @return void
     */
    public function removePizza(string $name): void
    {
        unset($this->collectionPizza[$name]);
    }

    /**
     * @param $name
     * @return Pizza
     */
    public function getPizza($name) : Pizza
    {
        return $this->collectionPizza[$name];
    }
}
