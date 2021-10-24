<?php

namespace Rewsam\SimpleBoilerplating\Tests\Unit\Input;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Rewsam\SimpleBoilerplating\Input\RequiredInputParameterDefinition;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * @covers \Rewsam\SimpleBoilerplating\Input\RequiredInputParameterDefinition
 */
class RequiredInputParameterDefinitionTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $description;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->key = '42543';
        $this->description = '46362';
    }

    public function test__construct(): void
    {
        $sut = new RequiredInputParameterDefinition($this->key, $this->description);
        self::assertSame($this->key, $sut->getKey());
        self::assertSame($this->description, $sut->getDescription());
        $constraints = $sut->getConstraints();
        $expected = [NotNull::class, NotBlank::class];

        foreach ($constraints as $constraint) {
            $position = array_search(get_class($constraint), $expected);

            if ($position !== false) {
                unset($expected[$position]);
            }
        }

        self::assertEmpty($expected, sprintf('Not found %s constraints, but expected', implode(', ', $expected)));
    }
}
