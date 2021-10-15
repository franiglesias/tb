<?php
declare (strict_types=1);

namespace Design\App\Contexts;

use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

class DemoContext implements Context
{
    private KernelInterface $kernel;
    private ?Response $response;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
        $this->response = null;
    }

    /**
     * @When /^a demo scenario sends a request to "([^"]*)"$/
     */
    public function aDemoScenarioSendsARequestTo($uri): void
    {
        $request = Request::create($uri, 'GET');
        $this->response = $this->kernel->handle($request);
    }

    /**
     * @Then /^the response should be received$/
     */
    public function theResponseShouldBeReceived(): void
    {
        Assert::assertNotNull($this->response);
    }
}
