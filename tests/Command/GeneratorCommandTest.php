<?php

declare(strict_types=1);

namespace KejawenLab\Semart\Skeleton\Tests\Command;

use KejawenLab\Semart\Skeleton\Command\GeneratorCommand;
use KejawenLab\Semart\Skeleton\Generator\GeneratorFactory;
use KejawenLab\Semart\Skeleton\Tests\Generator\Stub;
use KejawenLab\Semart\Skeleton\Tests\TestCase\CommandTestCase;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * @author Muhamad Surya Iksanudin <surya.iksanudin@gmail.com>
 */
class GeneratorCommandTest extends CommandTestCase
{
    public function setUp()
    {
        static::bootKernel();
    }

    public function testRunCommand()
    {
        static::$application->add(new GeneratorCommand($this->getMockBuilder(GeneratorFactory::class)->disableOriginalConstructor()->getMock()));

        $command = static::$application->find('semart:generate');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
            'entity' => Stub::class,
        ));

        $output = $commandTester->getDisplay();
        $this->assertContains(sprintf('Simple CRUD for %s class is generated', Stub::class), $output);
    }
}
