<?php

declare(strict_types=1);

namespace Maksimator\ProductLabels\Test\Unit\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Model\AbstractModel;
use Maksimator\ProductLabels\Model\LabelRepository;
use Maksimator\ProductLabels\Model\ResourceModel\Label\Command\Delete;
use Maksimator\ProductLabels\Model\ResourceModel\Label\Command\Get;
use Maksimator\ProductLabels\Model\ResourceModel\Label\Command\GetList;
use Maksimator\ProductLabels\Model\ResourceModel\Label\Command\Save;
use PHPUnit\Framework\TestCase;

class LabelRepositoryTest extends TestCase
{
    private LabelRepository $repository;

    private Get $getCommand;
    private Save $saveCommand;
    private Delete $deleteCommand;
    private GetList $getListCommand;

    protected function setUp(): void
    {
        $this->getCommand = $this->createMock(Get::class);
        $this->saveCommand = $this->createMock(Save::class);
        $this->deleteCommand = $this->createMock(Delete::class);
        $this->getListCommand = $this->createMock(GetList::class);

        $this->repository = new LabelRepository(
            $this->saveCommand,
            $this->getCommand,
            $this->deleteCommand,
            $this->getListCommand
        );
    }

    public function testCreateNewModel(): void
    {
        $model = $this->createMock(AbstractModel::class);
        $this->getCommand->expects($this->once())
            ->method('createNewModel')
            ->with([])
            ->willReturn($model);

        $this->assertSame($model, $this->repository->createNewModel());
    }

    public function testGetModelClass(): void
    {
        $this->getCommand->expects($this->once())
            ->method('getModelClass')
            ->willReturn('Test\\Class');

        $this->assertSame('Test\\Class', $this->repository->getModelClass());
    }

    public function testDelete(): void
    {
        $model = $this->createMock(AbstractModel::class);
        $this->deleteCommand->expects($this->once())
            ->method('delete')
            ->with($model);

        $this->repository->delete($model);
    }

    public function testGet(): void
    {
        $model = $this->createMock(AbstractModel::class);
        $this->getCommand->expects($this->once())
            ->method('get')
            ->with('123', null)
            ->willReturn($model);

        $this->assertSame($model, $this->repository->get('123'));
    }

    public function testSave(): void
    {
        $model = $this->createMock(AbstractModel::class);
        $this->saveCommand->expects($this->once())
            ->method('save')
            ->with($model);

        $this->repository->save($model);
    }

    public function testGetList(): void
    {
        $searchCriteria = $this->createMock(SearchCriteriaInterface::class);
        $results = $this->createMock(SearchResultsInterface::class);

        $this->getListCommand->expects($this->once())
            ->method('getList')
            ->with($searchCriteria)
            ->willReturn($results);

        $this->assertSame($results, $this->repository->getList($searchCriteria));
    }
}
