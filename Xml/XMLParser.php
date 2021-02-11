<?php


class XMLParser
{
    protected $xml;

    public function __construct(SimpleXMLElement $xml)
    {
        $this->xml = $xml;
    }

    public static function fromFilePath(string $path): self
    {
        return new static(simplexml_load_file($path));
    }

    /**
     * @return array<Product>
     */
    public function parse(): array
    {
        $products = [];

        foreach ($this->xml as $product) {
            $productModel = new Product();
            $productModel->name_product = $product['Название']->__toString();
            $productModel->code_product = $product['Код']->__toString();

            $data = [
                'name' => $product['Название']->__toString(),
                'code' => $product['Код']->__toString(),
            ];

            foreach ($product->children() as $child) {

                switch ($child->getName()) {
                    case 'Цена':
                        $productModel->addPrice(Price::make($child['Тип']->__toString(), $child->__toString()));

                        break;
                    case 'Свойства':
                        foreach ($child->children() as $littleChild){
                        $productModel->addProperty(Property::make($littleChild->getName(), $littleChild->__toString() . $littleChild['ЕдИзм']));
                        }
                        break;

//                    case 'Разделы':
//                        foreach ($child->children() as $littleChild){
//                            $productModel->addCategories(Category::make($littleChild->__toString()));
//                            //$data['category'][] =  $littleChild->__toString();
//                        }
//                        break;
                }
            }

            $products[] = $productModel;
        }

        return $products;
    }
}