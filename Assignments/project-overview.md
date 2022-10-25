---
layout: page
title: Project Overview
permalink: /assignments/project-overview
parent: Assignments
nav_order: 3
---

# Project Overview
The individual and team project for this class are designed to mirror the experiences of a software engineer joining a new development team:
you will be "onboarded" to our codebase, make several individual contributions, and then form a team to propose, develop and implement a new feature.
The codebase that we are be developing on is a remote collaboration tool called [Covey.Town](https://www.covey.town).
Covey.Town provides a virtual meeting space where different groups of people can have simultaneous video calls, allowing participants to drift between different conversations, just like in real life.
Covey.Town is inspired by existing products like [Gather.Town](https://gather.town), [Sococo](https://www.sococo.com), and [Gatherly.IO](https://www.gatherly.io) --- but it is an open source effort, and the features will be proposed and implemented by you!
All implementation will take place in the TypeScript programming language, using React for the user interface.


Select projects from Spring 2022 are hosted [in our project showcase](https://neu-se.github.io/CS4530-Spring-2022/assignments/project-showcase).


### Overview of Project Deliverables

| Date | Deliverable | Description | 
| -----| ----------- | ----------- |
| 9/28/22 | Team Formation | Specify preferences for teammates |
| 10/12/22 | [Preliminary Project Plan]({{ site.baseurl }}{% link Assignments/project-plan.md %}) | Propose a new feature for Covey.Town that can be planned and implemented within 7 weeks |
| 10/26/22 | [Revised Project Plan]({{ site.baseurl }}{% link Assignments/revised-project-plan.md %}) | Refine the scope of your feature based on staff feedback, define detailed requirements and project acceptance criteria. |
| 11/30/22 | Project Implementation and Documentation | Deliver your new feature, including design documentation and tests |

### Summary of Project Grading
Your overall project grade (which will account for 40% of your final grade in this course) will be the weighted average of each of the deliverables.

* Planning Documents
  * 10% Preliminary Project Plan
  * 10% Revised Project Plan
* Activities During the Project
  * 10% Weekly Meetings with TA Mentor and Team Surveys
  * 5% Ongoing development progress, including code reviews
* Final Deliverables
  * Code 
    * 20% Final implementation of your feature
    * 10% Final test suite of your feature
   * Report
      * 5% Feature Overview
      * 10% Technical Overview
      * 10% Process Overview
   * 10% Demonstration
  
In cases where team members do not equally contribute to the project, we may assign different grades to different individuals, up to an extreme of deducting 50% of the team project grade for a student.
We will evaluate each individual's contribution on the basis of a variety of factors, including progress reports at weekly meetings, through inspecting version control history, through each students' self-reflection, and through each students' peer evaluation (during and/or) at the end of the project.
We will make regular efforts to collect and distribute this feedback throughout the project — our ultimate goal is for all students to participate and receive full marks.

### Team Formation
All projects will be completed in a team of 3-4 students.
The very first deliverable for the project will be a team formation survey: you will be able to indicate
your preferences for teammates. The instructors will assign students to the teams based on a number of factors including your responses to the survey.
All students in each team must be in the same section of the class.


### Team Meetings with TA Mentor
Each team will be assigned a TA to act as a mentor, who will also serve as your point of contact for project grading.
During the week of October 3-7, you will have a "Kickoff Meeting" with your TA mentor, where you will meet your TA mentor and have the opportunity to share any early ideas that you might want feedback on before submitting the project pitch.
Once project begins in full force, you will have weekly meetings with your TA mentor (scheduled at your team's and the TA's convenience) in order to help ensure that you are making progress on the project, and to help address problems that you encounter (be they technical or non-technical problems).

###  Preliminary Project Plan
All projects will involve frontend and backend development of a new feature for Covey.Town.
Once teams have been formed, you and your team will decide what kind of new feature you would like to build.
Your feature should be something that can be implemented within the timeframe allotted (5-7 weeks), and will be implemented in a fork of the main Covey.Town codebase.
Given that you will be up-to-speed on the Covey.Town codebase (and have been introduced to TypeScript, React, NodeJS, and testing frameworks),
and that you will have a team of three or four, we expect that the feature that you propose will be more complex than the feature implemented in the individual
homeworks.

The project plan will focus on two sections:
* User stories and conditions of satisfaction that describe the feature that you plan to implement.
* Work breakdown: Map your user stories to engineering tasks. Assign each task to a team member (or pair of team members), provide an estimate for how long each task will take, a rationale for that estimate, and schedule those stories into sprints.

### Creating a GitHub Repository
Your team's development must take place within a private GitHub repository in our GitHub Classroom. To create your repository, each member of your team should follow these instructions:
1. Sign in to [GitHub.com](https://www.github.com/), and then [use our invitation to create a repository with the covey.town codebase](https://classroom.github.com/a/hB4zVIzE). Check to see if one of your groupmates has created a group already - if so, select it to join it. Otherwise, you should enter your group number (e.g. "Group 7Y") as the team name. 
2. Refresh the page, and it will show a link to your new repository, for example: `https://github.com/neu-cs4530/fall22-team-project-group-7y`. Click the link to navigate to your new repository. This is the repository you will use for the project.

This repository will be private, and visible only to your team and the course staff. After the semester ends, you are welcome to make it public - you have complete administrative control of the repository. 
### Revised Project Plan
Based on the feedback that you receive from the course staff, you will revise your preliminary project plan, creating a more detailed plan to implement your new feature.

The project plan will include:
* Revised user stories and conditions of satisfaction (based on feedback on the preliminary project plan)
* Revised work breakdown (based on feedback on the preliminary project plan)

Your team will self-organize, as agile teams do, and will use the work breakdown and schedule as the basis for weekly check-ins with your team's TA.


### Project Implementation and Documentation
You will be assigned a mentor for your project who will work closely with you for the entire project. You will coordinate with the mentor to setup weekly meetings and regular sprint demos. Peer evaluation will also be used.
Your final team deliverable will be a "release" of your new feature on GitHub (with tests), and will be accompanied by a demo.
*Optionally,* you may also open a pull request to merge your feature into our main repository (submitting a pull request, or the pull request being merged into our
codebase is independent of the grade you receive, but provides a platform for more visiblity of your project). 

Your final team deliverable will include:
* The implementation of your new feature
* Automated tests for your new feature
* A report
    
Accompanying the final team deliverable will be an *individual reflection*, which every student must submit on their own, which will include your reflections on:
* The evolution of your project concept: How does the project that you delivered compare to what you originally planned to deliver? What caused these deviations?
* The software engineering processes that you feel could have been improved in your project: were there any procesess that in hindsight, you wish that you followed, or wish that you followed better?
* Your team dynamic: Provide a frank (and ideally, blameless) postmortem of your and your teammates collaborative performance and participation. If you had to do this same project over with the same teammates, what would *you* have done differently (or not) to improve your team's overall performance?

The details for the final project deliverable will be released by October 26th.
