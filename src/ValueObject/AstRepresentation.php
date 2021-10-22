<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\ValueObject;

use PhpParser\Node\Stmt;

final class AstRepresentation
{
    /**
     * @param array<int, Stmt> $stmt
     */
    public function __construct(private array $stmt)
    {
    }

    /**
     * @return array<int, Stmt>
     */
    public function getStmt(): array
    {
        return $this->stmt;
    }
}
