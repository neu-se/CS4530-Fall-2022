---
layout: assignment
title: "Individual Project 1"
permalink: /assignments/ip1
parent: Assignments
nav_order: 1
due_date: "Wednesday September 21, 11:00am ET"
submission_notes: Submit via GradeScope
---

Welcome aboard to the Covey.Town team! We're glad that you're here and ready to join our development team as a new software engineer.
We're building an open source virtual meeting application, and are very happy to see that we have so many new developers who can help make this application a reality.
By the end of the semester, you'll be able to propose, design, implement and test a new feature for our project.
We understand that some of you may have some web development experience, but don't expect that most of you do, and hence, have created an individual project to help you get up to speed with our existing codebase and development environment.

Covey.Town is a web application that consists of some code that runs in each client's web browser, and also code that runs on a server.
Users join the application in a "town": a 2D arcade-style map with different rooms to explore.
Each town is also a video call: when two players get close to each other, they can see and hear each other; there is also a text chat available within the town.
In Winter of 2021, our lead software engineer, Avery, developed a prototype for Covey.Town, and since then, hundreds of students in this class have built on that codebase.
The most recent class-wide effort added a concept called [Conversation Areas](https://neu-se.github.io/CS4530-Spring-2022/assignments/hw2), allowing players to post a textual description of the topic of their conversation, and making those video conversations private to those players standing within that same area.
Many student projects in Spring 2022 (some of which are [publicly showcased](https://neu-se.github.io/CS4530-Spring-2022/assignments/project-showcase)) involved creating other kinds of flexible interactions that involve objects in the arcade game, other elements displayed in the browser, and video chat.
For example: students created game areas, where players who approached a game board could play a simple game (like tic-tac-toe) together; others created bulletin boards that stored persistent messages; others created viewing areas that allowed multiple players to simultaneously playback the same video as a "watch party."

After studying all of the student projects and their implementation challenges, our lead software engineer, Avery, has refactored Covey.Town, designing a new abstraction to make it easier to create features like these. 
Avery's new abstraction, `InteractableArea`, is a region of the town that provides some interactive elements for players when they enter.
The abstraction cuts across the entire technology stack: `InteractableArea`s exist in the 2D map and the application automatically tracks when players enter and exit them.
By pressing the spacebar within an `InteractableArea`, the user can trigger an interaction with that area, which in turn can be easily used to display new content in the web app using React.
An `InteractableArea` in one user's browser can also emit events that are delivered in real-time to other players interacting with that same area.

The objective for this semester's individual project is to implement this new `InteractableArea` abstraction, with two concrete implementations: `ConversationArea` and `ViewingArea`. While the `ConversationArea` will be implemented by refactoring last semester's code to use the new interface, the  `ViewingArea` is a new concept.
The `ViewingArea` alows players to have "watch parties": each player who is within the `ViewingArea` sees the same streaming video.
If one player pauses the video, it pauses for all other players watching it, and the playback is synchronized between all players watching the video.

This implementation effort will be split across two deliverables. In this first deliverable, you will implement and test the core backend components for this feature, and in the second deliverable, you will connect these new components to the rest of the backend, and implement and test the frontend components. 

## Objectives of this assignment
The objectives of this assignment are to:
*  Get you familiar with the basics of TypeScript, VSCode, and the project codebase
*  Learn how to read and write code in TypeScript
*  Translate high-level requirements into code
*  Learn how to write unit tests with Jest

## Changelog
* 9/9/22: Added clear instructions to run eslint

## Getting started with this assignment

Before you begin, be sure to check that you have NodeJS 16.x installed, along with VSCode. We have provided a [tutorial on setting up a development environment for this class]({{site.baseurl}}{%link tutorials/week1-getting-started.md %})
Start by [downloading the starter code]({{site.baseurl}}{%link /Assignments/ip1/ip1-handout.zip %}). Extract the archive and run `npm install` to fetch the dependencies. Avery has provided you with some very basic sanity tests that you can extend for testing your implementation as you go.


### Overview of relevant classes
The UML class diagram below shows the three main classes that you will be implementing for this deliverable (`InteractableArea`, `ViewingArea`, and `ConversationArea`), along with several relevant classes that you will need to interact with. For `Town` and `ServerToClientEvents`, we show only the most relevant methods.
<script src="{{site.baseurl}}/assets/js/mermaid.min.js" />
<div class="mermaid">
 %%{init: { 'theme':'forest', } }%%
classDiagram
   class InteractableArea {
       +string id
       ~Player[] _occupants
       +string[] occupantsByID
       +boolean isActive
       +BoundingBox boundingBox
       +add(player: Player)
       +remove(player: Player)
       +addPlayersWithinBounds(allPlayers: Player[])
       +toModel()
       +contains(location: PlayerLocation)
       +overlaps(otherInteractable: Interactable)
       #_emitAreaChanged()
   }

   class ViewingArea {
       +string video
       +number progress
       +boolean isPlaying
       +updateModel(updatedModel:ViewingAreaModel)
       +fromMapObject(mapObject, townEmitter)
   }

   class ConversationArea {
       +string? topic
       +fromMapObject(mapObject, townEmitter)
   }
   class BoundingBox {
       +number x
       +number y
       +number width
       +number height
   }
   class Player {
       +PlayerLocation location
       +string id
       +string username
   }
   class PlayerLocation {
       +number x
       +number y
       +Direction rotation
       +boolean moving
       +string? interactableID
   }
   class Town {
       +string townID
       +string friendlyName
       +InteractableArea[] interactables
       +Player[] players
       +void initializeMap(mapFile: string)
   }
   class TownEmitter {
       +void emit(eventName: ServerToClientEvents, eventData)
   }
   class ServerToClientEvents {
       +void playerMoved(movedPlayer: Player)
       +void interactableUpdate(updatedInteractable: Interactable)
   }
   ViewingArea ..|> InteractableArea
   ConversationArea ..|> InteractableArea
   InteractableArea o-- BoundingBox
   InteractableArea o-- Player
   InteractableArea o-- TownEmitter
   Player o-- PlayerLocation
   Town o-- Player
   Town o-- InteractableArea
   Town o-- TownEmitter
   TownEmitter -- ServerToClientEvents
</div>

## Grading
This submission will be scored out of 100 points, 90 of which will be automatically awarded by the gradign script, with the remaining 10 manually awarded by the course staff.

Your code will automatically be evaluated for linter errors and warnings. Submissions that have *any* linter errors will automatically receive a grade of 0. **Do not wait to run the linter until the last minute**. To check for linter errors, run the command `npm run lint` from the terminal. The handout contains the same eslint configuration that is used by our grading script.

Your code will be automatically evaluated for functional correctness by a test suite that expands on the core tests that are distributed in the handout. 
Your tests will be automatically evaluated for functional correctness by a process that will inject bugs into our reference solution: to receive full marks your tests must detect a minimum number of injected bugs. 
You will __not__ receive detailed feedback on which injected bugs you do or do not find, and you will __not__ receive detailed feedback on which tests you do or do not pass.

The autograding script will impose a strict rate limit of 5 submissions per 24 hours.
Submissions that fail to grade will not count against the quota.
This limit exists to encourage you to start early on this assignment: students generally report that assignments like this take between 3-20 hours.
If you start early, you will be able to take full advantage of the resources that we provide to help you succeed: office hours, discussion on Piazza --- and the ability to have a greater total number of submission attempts.

Your code will be manually evaluated for conformance to our course [style guide]({{ site.baseurl }}{% link style.md %}). This manual evaluation will account for 10% of your total grade on this assignment. We will manually evaluate your code for style on the following rubric:

To receive all 10 points:
* All new names (e.g. for local variables, methods, and properties) follow the naming conventions defined in our style guide
* There are no unused local variables
* All public properties and methods (other than getters, setters, and constructors) are documented with JSDoc-style comments that describes what the property/method does, as defined in our style guide
* The code and tests that you write generally follows the design principles discussed in week one. In particular, your design does not have duplicated code that could have been refactored into a shared method.

We will review your code and note each violation of this rubric. We will deduct two points for each violation, up to a maximum of deducting all 10 style points.


## Implementation Tasks
This deliverable has four parts; each part will be graded on its own rubric. You should complete the assignment one part at a time, in the order presented here:

### Task 1: Implement and test the abstract class (34 points total)
Your first objective is to implement the abstract class `InteractableArea`. Avery has provided a skeleton for this class, specifying the properties that are expected and implementing the constructor.

There are six methods for you to implement in this class: `add`, `remove`, `contains`, `addPlayersWithinBounds` and `overlaps` (we suggest implementing them in this order). The specification for each method is provided in comments in the file, and reproduced below:
{::options parse_block_html="true" /}
<details><summary markdown="span">View the specification for these methods</summary>
{% highlight typescript %}
/**
* Adds a new player to this interactable area.
* 
* Adds the player to this area's occupants array, sets the player's
* interactableID, informs players in the town that the player's
* interactableID has changed, and informs players in the town that
* the area has changed.
* 
* Assumes that the player specified is a member of this town. 
* 
* @param player Player to add
*/
public add(player: Player): void;

/**
* Removes a player from this interactable area.
* 
* Removes the player from this area's occupants array, clears the player's
* interactableID, informs players in the town that the player's interactableID
* has changed, and informs players in the town that the area has changed
* 
* Assumes that the player specified is an occupant of this interactable area
* 
* @param player Player to remove
*/
public remove(player: Player): void;

/**
* Tests if a player location is contained within this InteractableArea.
* 
* This interactable area contains a PlayerLocation if any part of the player
* is within any part of this area.
* A PlayerLocation specifies only the center (x,y) coordinate of the player; 
* the width and height of the player are PLAYER_SPRITE_WIDTH and
* PLAYER_SPRITE_HEIGHT, respectively
* 
* @param location location to check
* 
* @returns true if location is within this area
*/
public contains(location: PlayerLocation): boolean;

/**
* Given a list of players, adds all of the players that are within this
* interactable area
* 
* @param allPlayers list of players to examine and potentially add to this
* interactable area
*/
public addPlayersWithinBounds(allPlayers: Player[]);

/**
* Tests if another InteractableArea overlaps with this . Two InteractableArea's
* overlap if it is possible for one player to overlap with both of them
* simultaneously. That is: There is an overlap if the rectangles of the two
* InteractableAreas overlap, where the rectangles are expanded by
* PLAYER_SPRITE_WIDTH/2 in each X dimension and PLAYER_SPRITE_HEIGHT/2 in each Y
* dimension.
* 
* @param otherInteractable interactable to checko
* 
* @returns true if a player could be contained within both InteractableAreas
* simultaneously
*/
public overlaps(otherInteractable: InteractableArea): boolean;

/**
* Emits an event to the players in the town notifying them that this
* InteractableArea has changed, passing the model for this
* InteractableArea in that event.
*/
protected _emitAreaChanged();
{% endhighlight %}

</details>

*Testing*: Avery has provided you with test cases for `add` and `remove`, as well as some very simple (and incomplete) tests for `contains` and `overlaps`. You can run these tests by running the command `npx jest --watch InteractableArea`, which will automatically re-run the tests as you update the file. You should add tests for `addPlayersWithinBounds`, and improve the `contains` and `overlaps` tests to consider all of the boundary conditions. Please implement these additional tests in the file `src/town/InteractableArea.test.ts`.

Grading for implementation tasks:
* `add`: 3 points
* `remove`: 3 points
* `contains`: 4 points
* `addPlayersWithinBounds`: 3 points
* `overlaps`: 4 points

Grading for testing tasks:
* `addPlayersWithinBounds`: 3 points
* `contains`:
  * 7 points for detecting all 10 faults, or
  * 2 points for detecting at least 3 faults
* `overlaps`
  * 7 points for detecting all 12 faults, or
  * 5 points for detecting at least 8 faults

### Task 2: Implement and test the ConversationArea (15 points total)
Now that we have the core functionality for the `InteractableArea` abstraction implemented, we can move on to implement one of its concrete instantiations: the `ConversationArea`. 

The `ConversationArea` specialized the `InteractableArea`, storing a `topic` field to represent the current topic of the conversation, which is included in the corresponding `ConversationAreaModel`. The `ConversationArea` has the same semantics for `add(Player)` as its generic supertype, and adds a special behavior to the `remove(Player)` method. When the last player exits a `ConversationArea`, the `topic` field for that `ConversationArea` should be reset to `undefined`, and an update should be emitted to players in the town (by invoking `this._emitAreaChanged()`).

For this task, Avery has provided the complete test suite for `remove`, however, you will need to provide a complete set of tests for `toModel` and `fromMapObject`. Please add these tests to the existing test suite in `src/town/ConversationArea.test.ts`. You can run these tests by running the command `npx jest --watch ConversationArea`, which will automatically re-run the tests as you update the file. 

<details><summary markdown="span">View the specification for these methods</summary>
{% highlight typescript %}

/**
* Convert this ConversationArea instance to a simple ConversationAreaModel
* suitable for transporting over a socket to a client.
*/
public toModel(): ConversationAreaModel;

/**
* Removes a player from this conversation area. 
* 
* Extends the base behavior of InteractableArea to set the topic of this
* ConversationArea to undefined and emit an update to other players in the
* town when the last player leaves.
* 
* @param player 
*/
public remove(player: Player);

/**
* Creates a new ConversationArea object that will represent a Conversation Area
* object in the town map.
* 
* @param mapObject An ITiledMapObject that represents a rectangle in which this
* conversation area exists
* @param broadcastEmitter An emitter that can be used by this conversation area
* to broadcast updates 
* @returns 
*/
public static fromMapObject(mapObject: ITiledMapObject,
                              broadcastEmitter: TownEmitter): ConversationArea;
{% endhighlight %}
</details>

Grading for implementation tasks:
* `toModel`: 3 points
* `remove`: 3 points
* `fromMapObject`: 3 points
  
Grading for testing tasks:
* `toModel`: 3 points
* `fromMapObject`: 3 points

### Task 3: Implement and test the ViewingArea (21 points total)
The `ViewingArea` specializes `InteractableArea` to store the state of the viewing area, these three properties: `video` (a string, representing the URL of the video to be played or `undefined` if none is set), `isPlaying` (a boolean, representing whether the video should be shown as playing or paused), and `elapsedTimeSec` (a number, representing the number of seconds elapsed in the playback of the video).

Like the `ConversationArea`, the `ViewingArea` specializes the behavior of `remove`, in this case setting the `video` property to `undefined` and emitting this update to the players in the town when the last player leaves the `ViewingArea`.

The `ViewingArea` also adds a new method, `updateModel`, which will be used in the next deliverable to apply updates to the `ViewingArea`s state while clients are playing videos.

Avery has again provided a complete test suite for `remove`, and will expect you to provide a complete set of tests for `updateModel`, `toModel` and `fromMapObject`. Please add these tests in the `src/town/ViewingArea.test.ts` file. You can run these tests by running the command `npx jest --watch ViewingArea`, which will automatically re-run the tests as you update the file. 

<details><summary markdown="span">View the specification for these methods</summary>
{% highlight typescript %}
    /**
     * Removes a player from this viewing area.
     * 
     * When the last player leaves, this method clears the video of this area and
     * emits that update to all of the players
     * 
     * @param player 
     */
    public remove(player: Player): void;

    /**
     * Updates the state of this ViewingArea, setting the video, isPlaying and progress properties
     * 
     * @param viewingArea updated model 
     */
    public updateModel({ isPlaying, progress, video }: ViewingAreaModel);

    /**
     * Convert this ViewingArea instance to a simple ViewingAreaModel suitable for 
     * transporting over a socket to a client.
     */
    public toModel(): ViewingAreaModel;

    /**
     * Creates a new ViewingArea object that will represent a Viewing Area object in the town map.
     * @param mapObject An ITiledMapObject that represents a rectangle in which this viewing area exists
     * @param townEmitter An emitter that can be used by this viewing area to broadcast updates to players in the town
     * @returns 
     */
    public static fromMapObject(mapObject: ITiledMapObject, townEmitter: TownEmitter): ViewingArea;
{% endhighlight %}
</details>

Grading for implementation tasks:
* `remove`: 3 points
* `updateModel`: 3 points
* `toModel`: 3 points
* `fromMapObject`: 3 points
  
Grading for testing tasks:
* `updateModel`: 3 points
* `toModel`: 3 points
* `fromMapObject`: 3 points

### Task 4: Implement and test createInteractablesFromMap (20 points total)
Your last task for this deliverable is to implement a function to validate the `InteractableArea`s defined in the town's map file and populate the `Town` with instances of `ViewingArea` and `ConversationArea` to represent those areas. Implement this function in the method `initializeFromMap` in `src/town/Town.ts`. 

Avery has provided you with a single test case that you can use to check your progress; you will find that it tests some basic functionality of this function, but does not test the full specification. Please add new tests in the same `describe` block as the existing one in `src/town/Town.test.ts`. You can run these tests by running the command `npx jest --watch Town.test`, which will automatically re-run the tests as you update the file. 

Hint: The function takes as a parameter an `ITiledMap` object; you can learn more about the structure from reviewing the type definition, from the [Tiled JSON Map Format Specification](https://doc.mapeditor.org/en/stable/reference/json-map-format/), and from the example provided in the test case for `initializeFromMap` in the handout. The specific *layer* of the map that you are looking for will be of the type `ITiledMapObjectLayer`. The object layer will list all of the objects. The `type` property of each object in that layer identifies it as a `ViewingArea`, `ConversationArea`, or other - you can ignore any others.

Grading:
* 10 points for a correct implementation
* 10 points for tests:
  * 10 points for detecting all 15 faults, or
  * 5 points for detecting at least 6 faults, or
  * 3 points for detecting at least 1 fault

## Submission Instructions
Submit your assignment in GradeScope. The easiest way to get into GradeScope the first time is to first
[sign into Canvas](https://northeastern.instructure.com/courses/99531) and then click the link on our course for "GradeScope". 
You should then also have the option to create an account on GradeScope (if you don't already have one) so that you can log in to GradeScope directly.
Please contact the instructors immediately if you have difficulty accessing the course on GradeScope.

To submit your assignment: upload *only* the files:
* `src/town/InteractableArea.ts` 
* `src/town/InteractableArea.test.ts` 
* `src/town/ConversationArea.ts` 
* `src/town/ConversationArea.test.ts` 
* `src/town/ViewingArea.ts` 
* `src/town/ViewingArea.test.ts` 
* `src/town/Town.test.ts` 
* `src/town/Town.ts` 

The grading script should also accept your submission if you upload only a subset of these files.

GradeScope will provide you with feedback on your submission, but note that it will *not* include any marks that will be assigned after we manually grade your submission for code style (it will show 0 for this until it is graded). It may take several minutes for the grading script to complete.

GradeScope is configured to only provide feedback on at most 5 submissions per-24-hours per-student (submissions that fail to run or receive a grade of 0 are not counted in that limit). We strongly encourage you to lint and test your submission on your local development machine, and *not* rely on GradeScope for providing grading feedback - relying on GradeScope is a very slow feedback loop.
To check for linter errors, run the command `npm run lint` from the terminal. The handout contains the same eslint configuration that is used by our grading script.
