# Leap Year

## About Leap Year kata

It's a very good first exercise to start with TDD, baby steps, red-green-refactor cycle, and the TDD rules.

## The exercise

Our target is to write a program that can tell if a year is leap year or not. You can resolve it writing a function or a class.

Remember the rules:

* If year number is divisible by 4 it is leap year, and we add an extra day at the end of February, but...
* From time to time we need to avoid adding one day to keep the calendar in sync with seasons, so if year number is divisible by 100 then it is not leap year. 
* Also, this introduces a little error, so we compensate it with an extra day every 400 years. When a year number is divisible by 400, then it is leap year.  

This exercise is pretty good to learn the basics of the TDD classicist approach, and the red-green-refactor cycle. If you are looking for a good kata to start learning TDD, this is one of the best.

## Red-green-refactor cycle

We start the exercise writing a test that will fail. We say that it is "red", because it's the colour used by test frameworks to display failing tests.

Then, we write production code to make that test pass. The framework will display the green colour to show that. We only add new behavior during this phase. The code can be naive or obvious. We don't care about design at this moment, we want a clean, rough, simple, solution that make the test pass.

Whe we are green, **and only then**, we refactor the solution to a cleaner design, addressing duplication, bad names, and other smells. If we don't have enough information to decide, it's better to postpone and introduce a new example to test. So, we will be again in "red".

## TDD Rules

* You can't write any production code until you have first written a failing unit test.
* You can't write more of a unit test than is sufficient to fail, and not compiling is failing.
* You can't write more production code than is sufficient to pass the currently failing unit test.

## Remember

You should practice this very same exercise several times. Not only at this moment, practice it again next year, and the next... If you work with different programming languages, try with them.
