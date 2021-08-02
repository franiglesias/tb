# Prime Factors

## About Prime Factors kata

Prime Factors kata was "discovered" by Robert C. Martin when he was writing a program for helping his son with homework.

The exercise helped to start thinking if there is some kind of priority in the transformations to apply to production code during the red to green phase of TDD. Later, this was called the _Transformation priority premise_.

As a general rule, the _Transformation priority premise_ suggests that you start with code that is specific and change it making it more general while the tests become more specific.

## The exercise

Write a program (a function, or a class) to compute the prime factors of any integer. To keep the exercise simple enough, response can be represented as an array of the prime factors, repeated as many times as needed. For example:

```
$eighteen = new Number(18);
$eighteen->factors() = [2, 3, 3]
```

You can extend the exercise to get the factors as powers:

```
$eighteen = new Number(18);
$eighteen->factorsAsPowers() = [2, 3^2]
```

## Transformation Priority Premise

Check [this foundational post](https://blog.cleancoder.com/uncle-bob/2013/05/27/TheTransformationPriorityPremise.html). Then, this [other post with examples](https://elliotchance.medium.com/the-transformation-priority-premise-tpp-3e5dc08d445e).

These are the transformations:

* ({} → nil) no code at all → code that employs nil
* (nil → constant)
* (constant → constant+) a simple constant to a more complex constant
* (constant → scalar) replacing a constant with a variable or an argument
* (statement → statements) adding more unconditional statements.
* (unconditional → if) splitting the execution path
* (scalar → array)
* (array → container)
* (statement → tail-recursion)
* (if → while)
* (statement → non-tail-recursion)
* (expression → function) replacing an expression with a function or algorithm
* (variable → assignment) replacing the value of a variable.
* (case) adding a case (or else) to an existing switch or if

The premise itself is controversial, and other transformations could exist, or the priority could be slightly different. Anyway, it can be useful as an exercise to help us decide how to make our algorithm evolve in small steps.

## TDD Rules

* You can't write any production code until you have first written a failing unit test.
* You can't write more of a unit test than is sufficient to fail, and not compiling is failing.
* You can't write more production code than is sufficient to pass the currently failing unit test.

## Remember

You should practice this very same exercise several times. Not only at this moment, practice it again next year, and the next... If you work with different programming languages, try with them.
