<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\UseCase\DiscoverInterfaces\Builder;

use Crusade\LaravelInterface\Infrastructure\ArrayList;
use Crusade\LaravelInterface\Shared\ValueObject\FileContent;
use Crusade\LaravelInterface\Shared\ValueObject\FullQualifiedClassNameVo;

final class ArrayListConverter
{
    /**
     * @param ArrayList<string,FullQualifiedClassNameVo> $content
     */
    public function build(ArrayList $content): FileContent
    {
        $string = "<?php ";
        $string .= "return [";
        // TODO Check possible usage od print_r
        $content->each(
            function (FullQualifiedClassNameVo $value, string $key) use (&$string): void {
                $string .= "'$key' => ";
                $string .= "'$value',";
            }
        );

        $string .= '];';

        return new FileContent($string);
    }
}
