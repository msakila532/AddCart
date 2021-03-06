<?php

namespace CRUD\AddCart\Model;

use CRUD\AddCart\Api\SingleCartDetailsInterface;
use CRUD\AddCart\Api\DataInterfaceFactory;
use CRUD\AddCart\Model\AddcartFactory as CartModel;
use CRUD\AddCart\Model\ResourceModel\Addcart as CartResource;
use CRUD\AddCart\Model\ResourceModel\Addcart\CollectionFactory;
use Magento\Framework\Exception\LocalizedException;

class SingleCartDetailsRepository implements SingleCartDetailsInterface
{
    /**
     * @var DataInterfaceFactory
     */

    private $dataInterfaceFactory;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var CartModel
     */
    private $model;

    /**
     * @var CartResource
     */

    private $resource;

    public function __construct(
        CollectionFactory $collectionFactory,
        DataInterfaceFactory $dataInterfaceFactory,
        CartModel $model,
        CartResource $resource
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->dataInterfaceFactory = $dataInterfaceFactory;
        $this->model = $model;
        $this->resource = $resource;
    }
    /**
     * @param int $id
     * @return \CRUD\AddCart\Api\DataInterface[]
     */
    public function getCartById(int $id)
    {
        $model = $this->model->create();
        $this->resource->load($model, $id, 'id');
        $model->getData();

        $dataInterface = $this->dataInterfaceFactory->create();
        $dataInterface->setId($model->getId());
        $dataInterface->setSku($model->getSku());
        $dataInterface->setCustomerId($model->getCustomerId());
        $dataInterface->setQuoteId($model->getQuoteId());
        $dataInterface->setCreatedAt($model->getCreatedAt());
        $data[] = $dataInterface;
        return $data;

    }
}
