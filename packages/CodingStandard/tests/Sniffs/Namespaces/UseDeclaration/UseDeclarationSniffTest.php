<?php declare(strict_types=1);

namespace Symplify\CodingStandard\Tests\Sniffs\Namespaces\UseDeclaration;

use PHPUnit\Framework\TestCase;
use Symplify\CodingStandard\Tests\CodeSnifferRunner;
use SymplifyCodingStandard\Sniffs\Namespaces\UseDeclarationSniff;

final class UseDeclarationSniffTest extends TestCase
{

    public function testDetection()
    {
        $codeSnifferRunner = new CodeSnifferRunner(UseDeclarationSniff::NAME);

        $this->assertSame(1, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong.php'));
        $this->assertSame(1, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong2.php'));
        $this->assertSame(1, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/wrong3.php'));
        $this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct.php'));
        $this->assertSame(0, $codeSnifferRunner->getErrorCountInFile(__DIR__ . '/correct2.php'));
    }
}
