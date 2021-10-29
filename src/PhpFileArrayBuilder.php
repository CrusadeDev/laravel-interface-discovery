<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface;

use Crusade\LaravelInterface\ValueObject\Content;
use Crusade\LaravelInterface\ValueObject\FullQualifiedClassNameVo;

final class PhpFileArrayBuilder
{
    /**
     * @param ArrayList<string,FullQualifiedClassNameVo> $content
     * @return Content
     */
    public function build(ArrayList $content): Content
    {
        $string = "<?php ";
        $string .= "return [";

        $content->each(
            function (FullQualifiedClassNameVo $value, string $key) use (&$string): void {
                $string .= "'$key' => ";
                $string .= "'$value',";
            }
        );

        $string .= '];';

        return new Content($string);
    }
}
