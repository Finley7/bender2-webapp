<?php

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictConstructorRector;

return static function (RectorConfig $rectorConfig): void {

    $rectorConfig->sets([
        SetList::CODE_QUALITY,
        SetList::PHP_81,
        SetList::DEAD_CODE,
        SetList::EARLY_RETURN,
        SetList::CODING_STYLE,
        SetList::NAMING
    ]);
};