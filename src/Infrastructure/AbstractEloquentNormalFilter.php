<?php
declare(strict_types=1);

namespace Henry\Infrastructure;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class AbstractEloquentNormalFilter
 * @package Henry\Infrastructure
 */
abstract class AbstractEloquentNormalFilter
{
    protected $searchField;
    protected $field;

    /**
     * @param Builder $queryBuilder
     * @param array $conditions
     * @return Builder
     */
    public function filter(Builder $queryBuilder, array $conditions = []): Builder
    {
        $queryParam = array_get($conditions, $this->searchField);

        if (!$queryParam) {
            return $queryBuilder;
        }

        $operator = $this->assertExistOperator($queryParam);

        if (!\is_array($queryParam)) {
            return $queryBuilder->where($this->field, $operator, $queryParam);
        }

        if ($operator === '!=') {
            return $queryBuilder->whereNotIn($this->field, $queryParam);
        }

        return $queryBuilder->whereIn($this->field, $queryParam);
    }

    /**
     * @param array $queryParam
     * @return string
     */
    private function assertExistOperator(array &$queryParam): string
    {
        $operators = ['<=', '>=', '=', '!='];

        $operator = (string)array_get($queryParam, 'operator', '');

        if (!$operator) {
            return $operator;
        }

        if (!\in_array($operator, $operators, true)) {
            $operator = '=';
        }

        array_forget($queryParam, 'operator');
        $queryParam = \count($queryParam) <= 1 ? (string)$queryParam : $queryParam;

        return $operator;
    }
}
