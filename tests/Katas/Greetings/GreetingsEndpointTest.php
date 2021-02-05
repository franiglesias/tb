<?php
declare(strict_types=1);

namespace App\Tests\Katas\Greetings;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * The exercise consists in create an API endpoint that can return a greeting
 *
 * Our MVP will be an endpoint able to return "Hello, {name}."
 *
 * MVP: As "Bob" I want to be greeted with "Hello, Bob" so that I feel good
 *
 * As anonymous user I want to be greeted with "Hello, my friend" so that I feel fine
 *
 * As "JERRY" (all caps) I want to be greeted with "HELLO, JERRY!" so that I feel fine
 *
 * As Jill and Jane we want to be greeted with "Hello, Jill and Jane." so that we feel good
 *
 * As Amy, Brian and Charlotte, we want to be greeted with "Hello Amy, Brian, and Charlotte." so that we feel good
 *
 * As Amy, BRIAN and Charlotte", we want to be greeted with "Hello, Amy and Charlotte. AND HELLO BRIAN!" so that we feel good
 *
 * As Bob, "Charlie, Dianne", we want to be greeted with "Hello, Bob, Charlie, and Dianne." so that we feel good
 *
 * A Bob, \"Charlie, Dianne\", we want to be greeted with "Hello, Bob and Charlie, Dianne."
 *
 *
 * We will use outside-in TDD approach.
 *
 * We expect a json object like:
 *
 * {"greeting":"Hello, my friend."}
 *
 * We should build a decently decoupled architecture
 */

class GreetingsEndpointTest extends WebTestCase
{

}
