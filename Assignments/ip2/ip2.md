---
layout: assignment
title: "Individual Project 2"
permalink: /assignments/ip2
parent: Assignments
nav_order: 2
due_date: "Wednesday October 19, 11:00am ET"
submission_notes: Submit via GradeScope
---

Welcome back! We were pleased to see your thorough implementation of the new Interactables abstraction in the townService of Covey.Town.
While you have been working on these backend features, our UX designer Calin has finished the design of the ViewingAreas feature, and we're now ready to give you the rest of the feature.
Calin found the [react-player](https://github.com/cookpete/react-player) component, which seems to be a great component to use to implement video playback within Covey.Town.

In this (final) deliverable for the ViewingAreas feature, you will create the following components:
* Within the backend townService: REST and socket-io endpoints to process API calls from clients, dispatching them to the controllers delivered in IP1.
* Within the frontend application:
  * An event handler for the frontend `TownController` to process `interactableUpdate` messages dispatched by the `townService` (you implemented those backend components in IP1).
  * A `ViewingAreaController` and `ConversationAreaController` that will maintain data structures and dispatch events to the UI in response to updates from the `TownController`
  * React hooks to update existing React components in response to changes to `ViewingAreas`, `ConversationAreas`, and town settings
  * A React component for the `ViewingArea` that integrates the `react-player` with those hooks and controllers

When you complete this deliverable, you should have a fully-functioning implementation of the Viewing Area feature, and a better understanding of the covey.town architecture.

This sequence diagram shows the interaction between these high level components to create a new viewing area and play a video back synchronized between multiple frontends.

[![](https://mermaid.ink/img/pako:eNqdlU1vozAQhv_KiEtTqbmutDlUSujmtFWkQHPKxTVDatXYrG0SRVX_-45tCKGF7kdOQOadmfcZD7wlXBeYLBKLvxpUHB8EOxhW7RXQjzVOq6Z6RhPva2ac4KJmysFu-QjMwvKI5nxjYSfwJNRhaZDtRIEaRhTphCDVyhkt5ViZfCDK9Un10TBbG7pBVdx-Fq6C0AsyNEfBEWYrxl_HgzdrH5wyKRRV6bLCLBNVLUUp0IuiTGmHoKkfT2ABS2gsXSMJjAUGx2D-afsTnIZasnMLgoLn9_d5uqBCZ8WBk2-HVxBmCk-BHGnbDhl34khRXhyf5CklWU0ngdn2R5YDZ1K2OVbpvK2bNZyjtXDJRM-DhfaP-LzAz1V7y770NVKhSm0q8i1lMOsZ6BLISgRxIT1QUT5iypkTWnlMYboxNDQc-xUeKTXDniU-1QV1NIKoRbKj-CbEPNJxlqOBu7QzHFpLX5g6jKeMswqhW5wbOgnk647aPgWTxBrcC147ZHRYvnIYTtbA4Wb9hUON1-30-L3o2_w7aM4bE-WK0J_hBQ3GcGq2h96tTdkd6K79Z9oE0vsg0qO89HhjP1cNIB4a44U-gRd_QEX4owFAyWqLRS4qzJAP2PuhYiXc1XmNosEoV-OjH-a9_RuWE5Ihzviy6myBsB6LX65-sN1r4ZriBaJlVXsSPvJs4Y-XncC5Wf8fgfyfJKMrMxHbb01t9MHQeyIuDkwK-uXJEF-tRzEMBVFCpQ3SEjEFhRGlg4lT94fp0DCSu6RCUzFR0EfszT_eJ7ScFe6TBV0WWLJGun2yV-8U6j9oGcmThTMN3iURQPvNSxYlkxbffwNJ5Faj)](https://mermaid.live/edit#pako:eNqdlU1vozAQhv_KiEtTqbmutDlUSujmtFWkQHPKxTVDatXYrG0SRVX_-45tCKGF7kdOQOadmfcZD7wlXBeYLBKLvxpUHB8EOxhW7RXQjzVOq6Z6RhPva2ac4KJmysFu-QjMwvKI5nxjYSfwJNRhaZDtRIEaRhTphCDVyhkt5ViZfCDK9Un10TBbG7pBVdx-Fq6C0AsyNEfBEWYrxl_HgzdrH5wyKRRV6bLCLBNVLUUp0IuiTGmHoKkfT2ABS2gsXSMJjAUGx2D-afsTnIZasnMLgoLn9_d5uqBCZ8WBk2-HVxBmCk-BHGnbDhl34khRXhyf5CklWU0ngdn2R5YDZ1K2OVbpvK2bNZyjtXDJRM-DhfaP-LzAz1V7y770NVKhSm0q8i1lMOsZ6BLISgRxIT1QUT5iypkTWnlMYboxNDQc-xUeKTXDniU-1QV1NIKoRbKj-CbEPNJxlqOBu7QzHFpLX5g6jKeMswqhW5wbOgnk647aPgWTxBrcC147ZHRYvnIYTtbA4Wb9hUON1-30-L3o2_w7aM4bE-WK0J_hBQ3GcGq2h96tTdkd6K79Z9oE0vsg0qO89HhjP1cNIB4a44U-gRd_QEX4owFAyWqLRS4qzJAP2PuhYiXc1XmNosEoV-OjH-a9_RuWE5Ihzviy6myBsB6LX65-sN1r4ZriBaJlVXsSPvJs4Y-XncC5Wf8fgfyfJKMrMxHbb01t9MHQeyIuDkwK-uXJEF-tRzEMBVFCpQ3SEjEFhRGlg4lT94fp0DCSu6RCUzFR0EfszT_eJ7ScFe6TBV0WWLJGun2yV-8U6j9oGcmThTMN3iURQPvNSxYlkxbffwNJ5Faj)

The sequence beings when a user selects a video to play in a viewing area, entering it into the `ViewingAreaVideo`:
1. The `ViewingAreaVideo` asks the `TownController` to create a new viewing area with the specified video
2. The `TownController` asks the `townService` to create the new viewing area with the specified video, making a REST call
3. Assuming that the request was valid, the `townService` returns success
4. Assuming that the request was valid, the `TownController` returns success
5. The `townService` broadcasts an `interactableUpdate` message with the new video URL (happening in parallel with 9)
6. The `TownController` receives the `interactableUpdate`, finds the correct `ViewingAreaController` and pushes an `updateModel` event to it
7. The `ViewingAreaController` updates its model, and emits a `videoChange` event to its listeners
8. The `ViewingAreaVideo` receives the update, re-renders, and now plays the video
9. The `townService` sends the same `interactableUpdate` to Calin's frontend, and (6-8) happen in Calin's frontend
10. During playback, Avery's ViewingAreaVideo updates the `elapsedTimeSec` on the `ViewingAreaController`
11. In response to the update from the `ViewingAreaVideo`, the `ViewingAreaController` asks the `TownController` to emit an update to the `townService`
12. The `TownController` emits the `interactableUpdate` event, notifying the backend of the elapsed playack time
13. The `townService` relays that `interactableUpdate` to other clients, which will ensure that their video playback is synchronized
14. In parallel to 10-13, Calin's client emits `interactableUpdate` updates with their `elapsedTimeSec`
15. The `townService` forwards this update to Avery's frontend `TownController`
16. Avery's `TownController` finds the `ViewingAreaController` responsible for that viewing area, and calls its `updateModel` method, updating its view of the `elapsedTimeSec`
17. The `ViewingAreaController` emits a `progressChange` event to its listeners.
18. The `ViewingAreaVideo` will seek to the new `elapsedTimeSec` if it is out of sync

## Objectives of this assignment
The objectives of this assignment are to:
* Write new TypeScript code that uses asynchronous operations
* Write test cases that utilize mocks and spies
* Write React components and hooks that make use of state

## Getting started with this assignment

Start by [downloading the starter code]({{site.baseurl}}{%link /Assignments/ip2/ip2-handout.zip %}). Extract the archive and run `npm install` to fetch the dependencies. 

### Installation notes

**Configuring Jest and VSCode**: If you would like to use the built-in Jest test runner for VSCode (where it shows the tests and their status in the sidebar), the easiest way to accomplish this for this project is to open *just* the "frontend" directory or just the "townService" directory in VSCode - not the top-level "ip2-handout" directory. If you have a quick-fix to make it work with the whole project at once, please feel free to share on Piazza and we will incorportate that here.

**NPM install failures**: The libraries used for React require some native binaries to be installed -- code written and compiled for your computer (not JavaScript). If you run into issues with `npm install` not succeeding, please try installing the following libraries using either [Homebrew (if on Mac)](https://brew.sh), apt-get, or your favorite other package manager: `pixman`, `cairo`, `pkgconfig` and `pango`. For example, run `brew install pixman cairo pkgconfig pango`. If you are on a newer Mac with an M1 or M2 chip, you may need to use `arch -arm64 brew install pixman cairo pango`.


Changelog:
* 9/26: Update description for `socket.on('interactableUpdate')` on this page to match the handout; update the handout to remove prettier/linting issues (if you already have downloaded the handout, `npm run format` in the frontend directory will get you the same thing)
* 9/27: Clarify that `socket.on('interactableUpdate')`  should forward the interactableUpdate message to the other players in the town using the emitter `newPlayer.townEmitter`. Update handout so that `ViewingAreaController` getter for `video` return type is `string | undefined`. Add installation suggestions.
* 9/29: Added sequence diagram of hook that uses town events.

## Grading
This submission will be scored out of 200 points, 180 of which will be automatically awarded by the grading script, with the remaining 20 manually awarded by the course staff.

Your code will automatically be evaluated for linter errors and warnings. Submissions that have *any* linter errors will automatically receive a grade of 0. **Do not wait to run the linter until the last minute**. To check for linter errors, run the command `npm run lint` from the terminal. The handout contains the same eslint configuration that is used by our grading script.

Your code will be automatically evaluated for functional correctness by a test suite that expands on the core tests that are distributed in the handout. 
Your tests will be automatically evaluated for functional correctness by a process that will inject bugs into our reference solution: to receive full marks your tests must detect a minimum number of injected bugs. 
You will __not__ receive detailed feedback on which injected bugs you do or do not find.

The autograding script will impose a strict rate limit of 5 submissions per 24 hours.
Submissions that fail to grade will not count against the quota.
This limit exists to encourage you to start early on this assignment: students generally report that assignments like this take between 10-36 hours.
If you start early, you will be able to take full advantage of the resources that we provide to help you succeed: office hours, discussion on Piazza --- and the ability to have a greater total number of submission attempts.

Your code will be manually evaluated for conformance to our course [style guide]({{ site.baseurl }}{% link style.md %}). This manual evaluation will account for 10% of your total grade on this assignment. We will manually evaluate your code for style on the following rubric:

To receive all 20 points:
* All new names (e.g. for local variables, methods, and properties) follow the naming conventions defined in our style guide
* There are no unused local variables
* All public properties and methods (other than getters, setters, and constructors) are documented with JSDoc-style comments that describes what the property/method does, as defined in our style guide
* The code and tests that you write generally follows the design principles discussed in week one. In particular, your design does not have duplicated code that could have been refactored into a shared method.

We will review your code and note each violation of this rubric. We will deduct four points for each violation, up to a maximum of deducting all 20 style points.

## Implementation Tasks
This deliverable has four parts; each part will be graded on its own rubric. You should complete the assignment one part at a time, in the order presented here:

### Task 1: Implement Backend Handlers (15 points total)
In your last deliverable for the indivdiual project, you implemented a considerable portion of the backend code to support Interactables. What remains are the public-facing web service APIs that the client can directly invoke.

These methods are located in two files:
* townService/src/town/Town.ts (`socket.on('interactableUpdate')` handler and `addViewingArea`)
* townService/src/town/TownsController.ts (`createViewingArea`)

The `socket.on` handler is automatically invoked by the [socket-io library](https://socket.io) when an event is received from a remote client.
The `createViewingArea` function is automatically invoked by the [tsoa REST middleware](https://github.com/lukeautry/tsoa) when a REST request is made by a remote client.
We will learn more about both technologies in modules 9 and 10; for the purposes of this assignment you need only implement the functions as specified (such that they pass the provided test cases).

To run the tests for this part, run the command `npm test TestName` in the `townService` directory, where `TestName` is either `Town.test` or `TownsController`.

Clarification (9/24): A viewing area is "active" if there is a video set. 

{::options parse_block_html="true" /}
<details>
<summary markdown="span">View the specification for these tasks</summary>
{% highlight typescript %}
//townService/src/town/Town.ts
/**
   * Creates a new viewing area in this town if there is not currently an active
   * viewing area with the same ID. The viewing area ID must match the name of a
   * viewing area that exists in this town's map, and the viewing area must not
   * already have a video set.
   *
   * If successful creating the viewing area, this method:
   *    Adds any players who are in the region defined by the viewing area to it
   *    Notifies all players in the town that the viewing area has been updated by
   *      emitting an interactableUpdate event
   *
   * @param viewingArea Information describing the viewing area to create.
   *
   * @returns True if the viewing area was created or false if there is no known
   * viewing area with the specified ID or if there is already an active viewing area
   * with the specified ID or if there is no video URL specified
   */
  public addViewingArea(viewingArea: ViewingAreaModel): boolean

// townService/src/town/TownsController.ts
  /**
   * Creates a viewing area in a given town
   *
   * @param townID ID of the town in which to create the new viewing area
   * @param sessionToken session token of the player making the request, must
   *        match the session token returned when the player joined the town
   * @param requestBody The new viewing area to create
   *
   * @throws InvalidParametersError if the session token is not valid, or if the
   *          viewing area could not be created
   */
  @Post('{townID}/viewingArea')
  @Response<InvalidParametersError>(400, 'Invalid values specified')
  public async createViewingArea(
    @Path() townID: string,
    @Header('X-Session-Token') sessionToken: string,
    @Body() requestBody: ViewingArea,
  ): Promise<void>

// townService/src/town/Town.ts

// Set up a listener to process updates to interactables.
// Currently only knows how to process updates for ViewingArea's, and
// ignores any other updates for any other kind of interactable.
// For ViewingArea's: Uses the 'newPlayer' object's 'towmEmitter' to forward
// the interactableUpdate to the other players in the town. Also dispatches an
// updateModel call to the viewingArea that corresponds to the interactable being
// updated. Does not throw an error if the specified viewing area does not exist.
  socket.on('interactableUpdate', (update: Interactable) => {});
{% endhighlight %}
</details>

#### Grading for Task 1:
You do not need to write any tests for task 1. The handout contains all of the tests that our grading script will use.

Point break down for each of the implementation tasks:
* Implement Town.ts socket.on('interactableUpdate'): 5 points
* Implement Town.ts addViewingArea: 5 points
* Implement TownController.ts createViewingArea: 5 points

To receive marks for implementing each feature, your implementation must pass all of our tests for it.

### Task 2: Implement and Test Frontend Controllers (65 points total)
Similar to the organization of the backend townService, the frontend application also has controllers that maintain the state of each interactable.

The relevant files for this task are located in the directory `frontend/src/classes/`.

The `TownController` interacts with the `townService`, receiving `ServerToClientEvents` from the backend and emitting `ClientToServerEvents` to the backend.

The `TownController`, in turn, emits `TownEvents` to components in the frontend. These events are the events that the GUI components will observe. Each Viewing Area is represented by a `ViewingAreaController`, which emits `ViewingAreaEvents`. Each Conversation Area is represented by a `ConversationAreaController`, which emits `ConversationAreaEvents`. GUI components that display details about each converation area or viewing area will subscribe to these events so that they can remain up-to-date with the current state of the interactable.

Your next task is to implement the `ViewingAreaController` and `ConversationAreaController`, along with the event handler for `TownController` to receive `interactableUpdate` messages from the townService.
Each of these classes are stubbed out in the handout.

Our handout does *not* include all of the tests in `ViewingAreaController.test.ts` or `ConversationAreaController.test.ts`. To receive full marks on task 2, you will *also* need enhance these test suites to check all of the behaviors of the methods that you are implementing.
Testing the behavior of the `ViewingAreaController` and `ConversationAreaController` will require you to use *mocks*. 
The `ViewingAreaController.test.ts` and `ConversationAreaController.test.ts` files in the handout contain all of the setup code that you will need to write tests to check that the correct listeners are invoked.
The `mockListeners` object (in each test) are *mock* objects, which do not provide any implementation of the listener callbacks, but keep track of when they have been called.
In this way, you can write an assertion that some listener method is called by asserting that the mock listener was called.

To write an assertion that, for example, the `occupantsChange` listener is invoked in `ConversationAreaController`, you could use Jest's [toHaveBeenCalled()](https://jestjs.io/docs/expect#tohavebeencalled) matcher, as in:
`expect(mockListeners.occupantsChange).toHaveBeenCalled()`. You might also find it useful to use the [toHaveBeenCalledWith(args..)](https://jestjs.io/docs/expect#tohavebeencalledwitharg1-arg2-) matcher to check the arguments that are passed to the listener.
To assert that a listener was *not* called, chain the [`not` matcher](https://jestjs.io/docs/expect#not), as in `expect(...).not.toHaveBeenCalled()`.

We strongly suggest writing the tests before (or concurrent) with implementing the classes, so that you can use your own tests to help you develop your implementation.

Note: you may find it useful to use the helper methods `isConversationArea` and `isViewingArea`, defined in `TypeUtils.ts`

To run the tests for this part, run the command `npm test TestName` in the `frontend` directory, where `TestName` is either `ViewingAreaController`, `ConversationAreaController`, or `TownController`.

{::options parse_block_html="true" /}
<details>
<summary markdown="span">View the specification for these tasks</summary>
ConversationAreaController:

{% highlight typescript %}
  /**
   * Create a new ConversationAreaController
   * @param id
   * @param topic
   */
  constructor(id: string, topic?: string) {
    super();
    this._id = id;
    this._topic = topic;
  }
  /**
   * The ID of this conversation area (read only)
   */
  get id() 
  /**
   * The list of occupants in this conversation area. Changing the set of occupants
   * will emit an occupantsChange event.
   */
  set occupants(newOccupants: PlayerController[]) 
  get occupants() 

  /**
   * The topic of the conversation area. Changing the topic will emit a topicChange event
   *
   * Setting the topic to the value `undefined` will indicate that the conversation area is not active
   */
  set topic(newTopic: string | undefined) 
  get topic(): string | undefined

  /**
   * A conversation area is empty if there are no occupants in it, or the topic is undefined.
   */
  isEmpty(): boolean

  /**
   * Return a representation of this ConversationAreaController that matches the
   * townService's representation and is suitable for transmitting over the network.
   */
  toConversationAreaModel(): ConversationAreaModel
{% endhighlight %}


ViewingAreaController

{% highlight typescript %}
  /**
   * Constructs a new ViewingAreaController, initialized with the state of the
   * provided viewingAreaModel.
   *
   * @param viewingAreaModel The viewing area model that this controller should represent
   */
  constructor(viewingAreaModel: ViewingAreaModel) 

  /**
   * The ID of the viewing area represented by this viewing area controller
   * This property is read-only: once a ViewingAreaController is created, it will always be
   * tied to the same viewing area ID.
   */
  public get id()

  /**
   * The URL of the video assigned to this viewing area, or undefined if there is not one.
   */
  public get video()

  /**
   * The URL of the video assigned to this viewing area, or undefined if there is not one.
   *
   * Changing this value will emit a 'videoChange' event to listeners
   */
  public set video(video: string | undefined)

  /**
   * The playback position of the video, in seconds (a floating point number)
   */
  public get elapsedTimeSec()

  /**
   * The playback position of the video, in seconds (a floating point number)
   *
   * Changing this value will emit a 'progressChange' event to listeners
   */
  public set elapsedTimeSec(elapsedTimeSec: number)

  /**
   * The playback state - true indicating that the video is playing, false indicating
   * that the video is paused.
   */
  public get isPlaying() 

  /**
   * The playback state - true indicating that the video is playing, false indicating
   * that the video is paused.
   *
   * Changing this value will emit a 'playbackChange' event to listeners
   */
  public set isPlaying(isPlaying: boolean)

  /**
   * @returns ViewingAreaModel that represents the current state of this ViewingAreaController
   */
  public viewingAreaModel(): ViewingAreaModel 
{% endhighlight %}

TownController `socket.on('interactableUpdate')`

{% highlight typescript %}
    /**
     * When an interactable's state changes, push that update into the relevant controller, which is assumed
     * to be either a Viewing Area or a Conversation Area, and which is assumed to already be represented by a
     * ViewingAreaController or ConversationAreaController that this TownController has.
     *
     * If a conversation area transitions from empty to occupied (or occupied to empty), this handler will emit
     * a conversationAreasChagned event to listeners of this TownController.
     *
     * If the update changes properties of the interactable, the interactable is also expected to emit its own
     * events (@see ViewingAreaController and @see ConversationAreaController)
     */
    this._socket.on('interactableUpdate', interactable => {})

{% endhighlight %}
</details>

#### Grading for Task 2:
Point break down for each of the implementation tasks:
* Implement ConversationAreaController: 7 points
* Implement ViewingAreaController: 7 points
* Implement TownController.interactableUpdate: 6 points

To receive marks for implementing each feature, your implementation must pass all of our tests for it.

Point break down for each of the testing tasks:
* Test ConversationAreaController occupants property: 7 points
* Test ConversationAreaController topic property: 7 points
* Test ConversationAreaController isEmpty: 7 points
* Test ConversationAreaController toConversationAreaModel: 2 points
* Test ViewingAreaController video property: 7 points
* Test ViewingAreaController elapsedTimeSec property: 7 points
* Test ViewingAreaController isPlaying property: 7 points
* Test ViewingAreaController viewingAreaModel: 1 points

Partial marks are available for detecting some (but not all) faults. The number of faults detected may not directly correlate with the difficulty of writing the test: there are several faults that are nearly guaranteed to be detected together (writing a test that finds one of them is guaranteed to find both of them), which is why there are different cutoffs for partial and full marks for the tests.

### Task 3: Implement React Hooks (60 points total)
As discussed in Module 8, an effective pattern for building React applications is to use *hooks* within components to access global state. 
As part of the refactoring to implement the *Interactable* abstraction throughout Covey.Town, Avery also refactored the entire React-based frontend to use this pattern of hooks.
Before implementing the final component that displays and synchronizes video playback in Viewing Areas, your next task will be to implement these hooks - some of which are related to the interactables, and some of which 
are related to Avery's overall refactoring to use more hooks.

Some of these hooks may require you to include `useEffect` and/or `useState` hooks within the hook that you are building.
For each of the hooks, consider the events that they might need to listen to (i.e. `TownEvents` for the hooks that monitor a `TownController` and `ConversationAreaEvents` for those that monitor a `ConversationAreaController`).
Hooks that need to monitor `TownController` events may require you to use our own `useTownController()` hook, which returns the current `TownController`.

The sequence diagram below shows the expected interactions between hooks that subscribe to `TownEvents`, indicating the interfaces that the hook uses:
[![](https://mermaid.ink/img/pako:eNqNU8tu2zAQ_JUFTwlg-wN0CFAoAXRoL5V604UWVzFRkqsuSRdGkH_PUrQB5YGiOvExOzM7K76oiQyqRkX8kzFM-Gj1M2s_BpBP50Qh-yNy3S-ak53sokOCoQcdYaC_oUc-2wm_gLQ3SEshMTmHDJ9hXUG1OSby0BH9_oxYeVryCwWU7aSds-EZKDOc1oJaEigh0FlE2mYD18aggUQQJ0a8Ytv9_uGha-AnBoMcYb-yRsgRh5ON1U5xc3dfC7pSMAhxn49CZI9YKPXa3tNZdDYeHM4JaAbhT3J9EAffbUwYkO8Oh8P9DmbLMQGv4kDBXWr10N9UnrwV51CyRR6odVYkNjrDrYEr8ION7nrbrk1piEmLr4gp3WZZEKLzLV7CdGIKlKO7iKN9NSWJlel7LUMQjss_E2b0cmhgZhnhVylXG5NDHfKyzixufEJp-FeI22DTCf8r2ir9Lt0xqJ3yyF5bI3_2S6kelRB6HFUjS4Ozzi6NagyvAi199pKCahJn3Km8GAnr-hBUM2sX5RSNTcQ_6mtZH83rGxqDFX0)](https://mermaid.live/edit#pako:eNqNU8tu2zAQ_JUFTwlg-wN0CFAoAXRoL5V604UWVzFRkqsuSRdGkH_PUrQB5YGiOvExOzM7K76oiQyqRkX8kzFM-Gj1M2s_BpBP50Qh-yNy3S-ak53sokOCoQcdYaC_oUc-2wm_gLQ3SEshMTmHDJ9hXUG1OSby0BH9_oxYeVryCwWU7aSds-EZKDOc1oJaEigh0FlE2mYD18aggUQQJ0a8Ytv9_uGha-AnBoMcYb-yRsgRh5ON1U5xc3dfC7pSMAhxn49CZI9YKPXa3tNZdDYeHM4JaAbhT3J9EAffbUwYkO8Oh8P9DmbLMQGv4kDBXWr10N9UnrwV51CyRR6odVYkNjrDrYEr8ION7nrbrk1piEmLr4gp3WZZEKLzLV7CdGIKlKO7iKN9NSWJlel7LUMQjss_E2b0cmhgZhnhVylXG5NDHfKyzixufEJp-FeI22DTCf8r2ir9Lt0xqJ3yyF5bI3_2S6kelRB6HFUjS4Ozzi6NagyvAi199pKCahJn3Km8GAnr-hBUM2sX5RSNTcQ_6mtZH83rGxqDFX0)

Be sure to follow the [rules of hooks](https://reactjs.org/docs/hooks-rules.html) when implementing your hooks - these will be enforced by the linter, and also by the TAs when grading for style.

To run the tests for this part, run the command `npm test hooks` in the `frontend` directory.

{::options parse_block_html="true" /}
<details>
<summary markdown="span">View the specification for the hooks</summary>
In `frontend/src/classes/TownController.ts`

{% highlight typescript %}
/**
 * A react hook to retrieve the settings for this town
 *
 * This hook will cause components that use it to re-render when the settings change.
 *
 * This hook relies on the TownControllerContext.
 * @returns an object with the properties "friendlyName" and "isPubliclyListed",
 *  representing the current settings of the current town
 */
export function useTownSettings()

/**
 * A react hook to retrieve the active conversation areas. This hook will re-render any components
 * that use it when the set of conversation areas changes. It does *not* re-render its dependent components
 * when the state of one of those areas changes - if that is desired, @see useConversationAreaTopic and @see useConversationAreaOccupants
 *
 * This hook relies on the TownControllerContext.
 *
 * @returns the list of conversation area controllers that are currently "active"
 */
export function useActiveConversationAreas(): ConversationAreaController[] 

/**
 * A react hook to return the PlayerController's corresponding to each player in the town.
 *
 * This hook will cause components that use it to re-render when the set of players in the town changes.
 *
 * This hook will *not* trigger re-renders if a player moves.
 *
 * This hook relies on the TownControllerContext.
 *
 * @returns an array of PlayerController's, representing the current set of players in the town
 */
export function usePlayers(): PlayerController[] 
{% endhighlight %}

In `frontend/src/classes/ConversationAreaController.ts`:
{% highlight typescript %}
/**
 * A react hook to retrieve the occupants of a ConversationAreaController, returning an array of PlayerController.
 *
 * This hook will re-render any components that use it when the set of occupants changes.
 */
export function useConversationAreaOccupants(area: ConversationAreaController): PlayerController[]

/**
 * A react hook to retrieve the topic of a ConversationAreaController.
 * If there is currently no topic defined, it will return NO_TOPIC_STRING.
 *
 * This hook will re-render any components that use it when the topic changes.
 */
export function useConversationAreaTopic(area: ConversationAreaController): string

{% endhighlight %}
</details>

There are no hooks for the `ViewingAreaController` at this point - Avery noticed that the data in the `ViewingAreaController` is only used by at most one component, so felt that it would be an over-eager design optimization to define reusable hooks to access that data now.

#### Grading for Task 3:
You do not need to write any tests for task 1. The handout contains all of the tests that our grading script will use.

Point break down for each of the implementation tasks:
* Implement TownController.ts useTownSettings: 12 points
* Implement TownController.ts useActiveConversationAreas: 12 points
* Implement TownController.ts usePlayers: 12 points
* Implement ConversationAreaController.ts useConversationAreaOccupants: 12 points
* Implement ConversationAreaController.ts useConversationAreaTopic: 12 points

To receive marks for implementing each feature, your implementation must pass all of our tests for it.

### Task 4: GUI Component for Viewing Area Videos (40 points)
With the controllers implemented, the last task will be to implement the frontend GUI component to play back videos in a Viewing Area. Avery has implemented the skeleton for this component, which also includes a form to set the video for a viewing area if it hasn't already been set.

Your task is to implement the component `ViewingAreaVideo`, which renders the viewing area's video and synchronizes playback with the `ViewingAreaController`. You will find that there is already a skeleton of this component created, which renders a `<ReactPlayer>` component inside of a `<Container>`, along with the ID of the `ViewingArea`.

In addition to `useState` and `useEffect`, this component will also need to make use of React's [`useRef` hook](https://reactjs.org/docs/hooks-reference.html#useref). `useRef` is used to make a reference to a child component - the React documentation shows how `useRef` is used to make a reference to a text input that can be used from within an event handler.
The handout code contains the declaration of a `useRef` hook and ties that reference to the `ReactPlayer` component. You will find it necessary to reference the `ReactPlayer` component in order to retrieve its current playback timecode, and to seek to a new timecode.

To run the tests for this part, run the command `npm test ViewingAreaVideo` in the `frontend` directory.

 The specification for this component is provided in comments in the file `frontend/src/components/Town/interactables/ViewingAreaVideo.tsx`, and reproduced below:
{::options parse_block_html="true" /}
<details><summary markdown="span">View the specification for this component</summary>
{% highlight typescript %}
/**
 * The ViewingAreaVideo component renders a ViewingArea's video, using the ReactPlayer component.
 * The URL property of the ReactPlayer is set to the ViewingAreaController's video property, and the isPlaying
 * property is set, by default, to the controller's isPlaying property.
 *
 * The ViewingAreaVideo subscribes to the ViewingAreaController's events, and responds to
 * playbackChange events by pausing (or resuming) the video playback as appropriate. In response to
 * progressChange events, the ViewingAreaVideo component will seek the video playback to the same timecode.
 * To avoid jittering, the playback is allowed to drift by up to ALLOWED_DRIFT before seeking: the video should
 * not be seek'ed to the newTime from a progressChange event unless the difference between the current time of
 * the video playback exceeds ALLOWED_DRIFT.
 *
 * The ViewingAreaVideo also subscribes to onProgress, onPause, onPlay, and onEnded events of the ReactPlayer.
 * In response to these events, the ViewingAreaVideo updates the ViewingAreaController's properties, and
 * uses the TownController to emit a viewing area update.
 *
 * @param props: A single property 'controller', which is the ViewingAreaController corresponding to the 
 *               current viewing area.
 */
export function ViewingAreaVideo({
  controller,
}: {
  controller: ViewingAreaController;
}): JSX.Element
{% endhighlight %}
</details>

*Hints*: The `playing` property of the `ReactPlayer` will need to be changed during the component's lifetime: set to `false` when another player pauses the video, or `true` when it is resumed. This might be a good use-case for `useState`. In contrast, seeking the video to a new timecode is accomplished not by changing a property, but by using the [instance method `seekTo`](https://github.com/CookPete/react-player#instance-methods) of the ReactPlayer. The handout code already has a `useRef()` hook to demonstrate how to get a reference to the component.

#### Grading for Task 4:
You do not need to write any tests for task 4. The handout contains all of the tests that our grading script will use.

Point break down for each of the implementation tasks:
* Implement ViewingAreaVideo - Set properties of the ReactPlayer: 6 points
* Implement ViewingAreaVideo - Bridging events from the ViewingAreaController to the ReactPlayer: 17 points
* Implement ViewingAreaVideo - Bridging events from the ReactPlayer to the ViewingAreaController: 17 points

To receive marks for implementing each feature, your implementation must pass all of our tests for it.


## Submission Instructions
Submit your assignment in GradeScope. The easiest way to get into GradeScope the first time is to first
[sign into Canvas](https://northeastern.instructure.com/courses/99531) and then click the link on our course for "GradeScope". 
You should then also have the option to create an account on GradeScope (if you don't already have one) so that you can log in to GradeScope directly.
Please contact the instructors immediately if you have difficulty accessing the course on GradeScope.

To submit your assignment: run the command `npm run zip` **in the top-level directory of the handout**. This will produce a file called `covey-town.zip` which should contain these files:
* townService/src/town/Town.ts
* townService/src/town/TownsController.ts
* frontend/src/classes/TownController.ts
* frontend/src/classes/ConversationAreaController.ts
* frontend/src/classes/ConversationAreaController.test.ts
* frontend/src/classes/ViewingAreaController.ts
* frontend/src/classes/ViewingAreaController.test.ts
* frontend/src/components/Town/interactables/ViewingAreaVideo.tsx

GradeScope will provide you with feedback on your submission, but note that it will *not* include any marks that will be assigned after we manually grade your submission for code style (it will show 0 for this until it is graded). It may take several minutes for the grading script to complete.

GradeScope is configured to only provide feedback on at most 5 submissions per-24-hours per-student (submissions that fail to run or receive a grade of 0 are not counted in that limit). We strongly encourage you to lint and test your submission on your local development machine, and *not* rely on GradeScope for providing grading feedback - relying on GradeScope is a very slow feedback loop.
To check for linter errors, run the command `npm run lint` from the terminal. The handout contains the same eslint configuration that is used by our grading script.
