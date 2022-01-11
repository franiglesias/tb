# Elephant Carpaccio

## About Elephant Carpaccio

This exercise was invented by Alistair Cockburn. The target of the exercise is to learn how to vertically slice user
stories into really thin vertical slices.

A vertical slice is a piece of a story with the following characteristics:

* **Vertical**: it cuts across multiple architectural layers or technical stacks. Usually, a vertical slice contains
  elements of user interface, backend, persistence, etc. The user can perceive a change in the things that are possible
  to do with the software.
* **Testable**: you can verify the behavior of the system with tests. Or better yet: you can specify it with tests and
  develop it in TDD/BDD fashion.
* **User valuable**: users obtain some value from the delivery of the slice. Value can benefit only part of potential
  users, or satisfy only specific use cases. You need to provide value with each slice.

## The exercise

You can find
the [Original facilitation guide of Elephant Carpaccio here](https://docs.google.com/document/d/1TCuuu-8Mm14oxsOnlk8DqfZAA1cvtYu9WGv67Yj_sSk/pub)
. This README is an adaptation of the facilitation guide.

### Schedule

1. Organize the participants in small teams (2-3 people) with a computer per team if you want to do the coding part.
2. (20 min) Discussion about user stories. Some teams could need an introduction to the concept.
3. (20-30 min) Slice the product in 10-20 demo-able user stories or slices. They should be doable in less than 8
   minutes. UI mockup, creation of data tables, and other technical things, are not considered slices by themselves. A
   valid slice provides new value to the user.
4. Discuss the slices.
5. (40 min) [OPTIONAL] Develop the application in 40 minutes: 5 iterations (sprints) of 8 minutes each.
6. (15-20 min) Debrief

### Notes

* Participants can be both developers and business people. The best is to have both, of course.
* Less than 10 slices means that the team needs to re-think their work.
* The coding part is optional, but surely fun. You can
  check [this repo to find Extreme Carpaccio, a version in which several teams can compete](https://github.com/dlresende/extreme-carpaccio)
  . Thanks to [Abraham Vallez](https://abrahamvallez.medium.com) for the suggestion.

## The product that we want to develop

Product is a retail calculator that can accept 3 inputs:

* How many items
* Price per item
* 2-letter state code (for taxes)

Output is total price. Discount rate is applied based on order value. Taxes are applied based on state code on
discounted price. To clarify: we apply the discount first, and then, we apply the taxes.

Discounts:

| Order value | Discount rate |
|:------------|:-------------:|
| $1,000      |      3%       |
| $5,000      |      5%       |
| $7,000      |      7%       |
| $10,000     |      10%      |
| $50,000     |      15%      |

Taxes:

| State | Tax rate |
|-------|----------|
| UT    | 6.85%    |
| NV    | 8.00%    |
| TX    | 6.25%    |
| AL    | 4.00%    |
| CA    | 8.25%    |

## Prioritization

The main problem you have doing this exercise has to do with deciding what should be done next.

Our target is to be able to apply the five discounts and support the five states on taxes. Instead of trying to reach
that goal in one shot, we should work in tiny steps.

Each step or slice should have UI, input and output and be visibly different from the previous one. We should deliver
some value on every iteration. It's true that first iterations could have very limited value because we need to address
several technical concerns in order to start providing business value.

Let's see some examples:

User has to be able to reach the entry point of the application, so our first movement should guarantee that the
application can run.

Taxes are a legal requirement, so we should implement them before discounts, that are optional. Supporting taxes
provides more value because they are mandatory to be allowed to run the business.

Input validation or fancy gui details are important, but provide the least value, so they should be done _after_
reaching the main target.

### Why to go soooo small

Narrow vertical slices can be implemented in very little time. This allows to put them in production sooner and obtain
feedback sooner. Maybe in a matter of hours. This way, we can react faster to problems or changes, or detect problems
before they grow too much. We can even rollback easily in case of problems.

Most importantly, we are providing value to our customers as soon as possible.

On the other hand, once we reach enough proficiency slicing things we remove the need for estimates. That's because at a
certain point we start creating slices that we can deliver regularly, in a pretty predictable pace. We will know that we
can deliver a certain number of slices in a week, for example.

### Possible milestones

**[Walking skeleton](https://www.henricodolfing.com/2018/04/start-your-project-with-walking-skeleton.html)**: the
walking skeleton ties the main elements needed to the application. It can be a simple _hello-world_ that shows that the
application is reachable and can provide some output. In the real world, this kind of approach helps to reduce risks,
establish the project, create deploy pipelines, etc.

**Calculate order value**: accept items and prices and output the product.

**Hardcoded State tax**: hard coded (arbitrary) state tax. This is an example of how to provide value to a subset of
potential users. It is a deliverable that we can put into production and go live.

**Input of State tax**: application allows to introduce the tax rate. It is not the best solution, but it is enough to
provide value to more customers. With this you could go live in all the states, but check the next milestone.

**Input of State**: only supports two states. Show error message for unsupported ones. We could go live in supported
states.

**All states supported**: no comments.

**Support for one discount**: we can start to make our best customers happier.

**All discounts supported**: our main target.

## User stories

A user story expresses a desire about hte value expected form a software system from the user perspective. Typically, we
write a user story using this template:

As a [role]
I want to [do something with the system]
So that [benefit expected from the feature]

This declaration should fit in a card. The next step should be a conversation between the development team and the user
or users interested in the story, so all together can define a way to provide the value to the user. Acceptance criteria
should be defined to be able to test the implementation.

These are
the [INVEST guidelines to define user stories](https://agileforall.com/new-to-agile-invest-in-good-user-stories/):

* **Independent**: you can build and deliver it in isolation. This can be hard to achieve.
* **Negotiable**: the story expresses a need and that is the start of a conversation with the user to gather the context
  and decide about the details of how to implement it.
* **Valuable**: the story provides value to the user once deployed. Prioritization of stories should be done by business
  value, so we need to know it.
* **Estimatable**: you can estimate the cost of doing the story, so you can decide if the cost worth the value. If you
  cannot estimate it, it is possible that you need to split the story (estimate here does not mean story points or time)
* **Small**: it can be done in an iteration or sprint. This depends on the teams. It can be hours or days.
* **Testable**: you can verify that the need expressed in the story is fulfilled by the implementation using some
  acceptance criteria, the best if using automated acceptance tests (BDD).

## Slicing techniques

When you have to deal with a big user story or project, different techniques can be applied to achieve a good vertical
slicing that helps the team to deliver value in small, low-risk, chunks.

* [SPIDR method](https://www.youtube.com/watch?v=ZHtSogsF8Yc)
* [Strategies for Story Slicing](https://medium.com/agilegreat/story-slicing-216af738ef4c)
* [Why Most People Split Workflows Wrong](https://www.humanizingwork.com/why-most-people-split-workflows-wrong/)
* [The Humanizing Work Guide to Splitting User Stories](https://www.humanizingwork.com/the-humanizing-work-guide-to-splitting-user-stories/)

### By Paths

* Identify the different paths of the user story (i.e: Happy path, Sad paths).
* Identify variations inside those paths (i.e: payment methods, filters, etc.).
* Split it based on the identified paths.

Example:

* As a user I want to buy and pay for products.

* As a user I want to buy a product paying with Stripe.
* As a user I want to buy a product paying with PayPal.
* As a user I want to buy several products and choose the payment method.

It is frequent that the first path is more complex than the others, because we have to design some things and introduce
new components that we could not have. At the same time, the rest of the path will become easier to implement.

Also, if one of the paths seems to be too wide, you can apply other strategies to slice it.

### By Interface (or platform)

* Identify the different interfaces (UI) that the software has to offer (mobile, console, web, computer, etc.).
* Identify variations (i.e: platform (mobile android, mobile ios, web chrome, web safari, computer windows, computer
  macOs...))
* Split based on the identified variations. You can choose attending to different criteria: number of users, expected
  revenue, ease of development...

Example: A typical situation is to have a web based application and mobile apps. We could start by developing the web
for mobile because we expect most user would want to access our app using their phones, and because it is easier to
develop a web application mobile first and scale to computer screen after (the mobile web version is usable in the
desktop).

### By Data types or parameters to handle

* Identify different data types or types of parameters to handle.
* Identify if it is possible to express them in common formats.

Example: dates can be introduced using simple text fields, that are easier to implement, so we can provide value to the
user early. We introduce date picker in a future iteration. It is true that the first method is prone to user errors,
but user can start working and providing feedback.

### By Business Rules

* Identify and isolate the business rules that apply to the story.
* Create one story by rule.
* Group together those that are so closely related that could be addressed in the same slice.

### By Spike

A spike is an experiment we make to learn something about the problem. Spike should answer concrete questions, and no
more than those questions. We can slice the story using the outcomes of the spike.
