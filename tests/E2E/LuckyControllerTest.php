<?php
declare(strict_types=1);

namespace App\Tests\E2E;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * The exercise consists in create an API endpoint that can return a random number
 * between 1 and 100 (1 and 100 included)
 *
 * We will use outside-in TDD approach.
 *
 * We expect a json object like:
 *
 * {"number":"58"}
 *
 * We should build a decently decoupled architecture
 */

class LuckyControllerTest extends WebTestCase
{

}
