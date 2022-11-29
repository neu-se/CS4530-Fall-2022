---
layout: page
title: API and Backend Testing
permalink: /tutorials/backend-testig
parent: Tutorials
nav_order: 7
---

## Mocking axios

In unit testing, mocks provide us with the capability to stub the functionality provided by a dependency and a means to observe how our code interacts with the dependency. Mocks are especially useful when it's expensive or impractical to include a dependency directly into our tests, for example, in cases where your code is making HTTP calls to an API or interacting with the database layer.

It is preferable to stub out the responses for these dependencies, while making sure that they are called as required. This is where mocks come in handy.


- Use jest.mock(...) to mock axios module to test without actually hitting the API
- Use mockResolvedValue for .get to return data to assert against
- Want axios.get('/users.json') to return fake response

// need to add examples from code base

```ts
import axios from 'axios';
import Users from './users';

jest.mock('axios');

test('should fetch users', () => {
const users = [{name: 'Bob'}];
const resp = {data: users};
axios.get.mockResolvedValue(resp);

// or you could use the following depending on your use case:
// axios.get.mockImplementation(() => Promise.resolve(resp))

return Users.all().then(data => expect(data).toEqual(users));
});
```

- Use mockRejectedValue along with mockResolvedValue to reject with different expectations

```ts
test('async test', async () => {
 const asyncMock = jest
   .fn<() => Promise<never>>()
   .mockRejectedValue(new Error('Async error message'));

 await asyncMock(); // throws 'Async error message'
});
```

### Testing with jest-mock-extended
If you want to use proper dependency injection in Jest, you would need to use jest.mock() to mock out the class, or you would have to roll your on implementation using jest.fn().mockImplementation({}), returning a class like structure. Even then, TypeScript support is patchy for classes and pretty much non-existent for interfaces. Yes, spys can achieve the same functionality in some cases, but sometimes it does not feel like the right tool for the job.

jest-mock-extended provides a few helpers that make the job of mocking anything Typescript based much easier.

// need to add examples from code base
## Testing front end access to RESTful Web service APIs
Front end applications depend on servers for data access and other middleware resources. UI components in the React application use services to interact with controllers implemented in the Node server. React services send HTTP requests for data and Node servers respond with data. In this section we're going to learn how to test the access to RESTful Web service APIs.

To learn how to test RESTful Web service API access, we're going to review a working set of tests that verify access to the users RESTful Web service API

On the React side all access to RESTful Web service APIs is implemented in service files such as users-service.js one per resource. The users-service.js code below collects all CRUD operations implemented in terms of the popular axios library. The BASE_URL points to my server on Heroku and you should change it to point to your Heroku server. The createUser function posts a user object to the server and receives a response with the new user inserted in the database. The findAllUsers sends a GET request to the server and receives an array of all users. The findUserById retrieves a user by their primary key. The deleteUser removes a user by their primary key. The deleteUsersByUsername removes a user given their username.

```ts
import axios from "axios";
// change this to point to your server on Heroku
const BASE_URL = "https://software-engineering-node.herokuapp.com/api";

const USERS_API = `${BASE_URL}/users`;

export const createUser = (user) => axios.post(`${USERS_API}`, user)
    .then(response => response.data);

export const findAllUsers = () => axios.get(USERS_API)
    .then(response => response.data);

export const findUserById = (uid) => axios.get(`${USERS_API}/${uid}`)
    .then(response => response.data);

export const deleteUser = (uid) => axios.delete(`${USERS_API}/${uid}`)
    .then(response => response.data);

export const deleteUsersByUsername = (username) =>
  axios.get(`${USERS_API}/username/${username}/delete`)
    .then(response => response.data);
```

## Testing inserting users with the RESTful Web service API
The code below tests creating/inserting a user from the database using the users-service. To validate the deletion was successful, we check the status deleteCount making sure it’s at least one. Run the test in your environment and confirm the test passes.

```ts
describe('createUser', () => {
  const ripley = {
    username: 'ellenripley',
    password: 'lv426',
    email: 'ellenripley@aliens.com'
  };

  beforeAll(() => {
    return deleteUsersByUsername(ripley.username);
  });

  afterAll(() => {
    return deleteUsersByUsername(ripley.username);
  });

  test('can insert with REST API', async () => {
    const newUser = await createUser(ripley);

    expect(newUser.username)
      .toEqual(ripley.username);
    expect(newUser.password)
      .toEqual(ripley.password);
    expect(newUser.email)
      .toEqual(ripley.email);
  });
});

```

## Testing deleting users with RESTful web service API
The code below tests deleting a user from the database using the users-service. First we create a sample user to make sure we have a user to remove. To validate the deletion was successful, we check the status deleteCount making sure it's at least one. Run the test in your environment and confirm the test passes.

```ts
const sowell = {
    username: 'thommas_sowell',
    password: 'compromise',
    email: 'compromise@solutions.com'
  };

  beforeAll(() => {
    return createUser(sowell);
  });

  afterAll(() => {
    return deleteUsersByUsername(sowell.username);
  })

  test('can delete with REST API', async () => {
    const status = await 
      deleteUsersByUsername(sowell.username);

    expect(status.deletedCount)
      .toBeGreaterThanOrEqual(1);
  });
```

## Test retrieving all documents with RESTful Web service API
To test whether we can retrieve all users from the REST API, we first have to consider that there might already be users in the database and these should not affect our test results. We'll insert a couple of users of our own, retrieve all the users, and then confirm that the list contains the users we inserted. The findAllUsers test below implements a Jest test that first inserts users larry, curley and moe, retrieves all the users from the REST API, confirms the users we inserted are among all the users, and then cleans up after itself by removing the users we inserted for testing. Run the test and confirm it passes.

```ts
 test('retrieve all users from REST API', async () => {
    const users = await findAllUsers();

    expect(users.length)
      .toBeGreaterThanOrEqual(usernames.length);

    const usersWeInserted = users.filter(
      user => usernames.indexOf(user.username) >= 0);

    usersWeInserted.forEach(user => {
      const username = usernames
        .find(username => username === user.username);
      expect(user.username).toEqual(username);
      expect(user.password).toEqual(`${username}123`);
      expect(user.email)
        .toEqual(`${username}@stooges.com`);
    });
  });
```

# Testing the backend functions by accessing MongoDB 
This tutorial covers the basics of REST API testing if the API interacts with a local or cloud database. By the end of this tutorial you will have an introduction to basic unit testing of the backend services and interaction with MongoDB.

Let’s continue with our course example. In order to test that the courses are inserted in the DB and that it can be deleted from the DB as well, we need to add some dummy data in the database before the test runs and delete that data after the completion of the test.

```ts
beforeAll(async () => {
   connection = await mongoose.connect('mongodb://localhost:27017/test_'+process.env.DATABASE,{useNewUrlParser: true, useUnifiedTopology: true });
   db = mongoose.connection;
   await db.createCollection(courseDao);
  });


afterAll(async () => {
   await db.dropCollection(courseDao);
   await db.dropDatabase();
   await db.close();
   await connection.close();
});
```

## Testing the insertion in the database
```ts
describe('createCourse should create the course with desired title in the DB', () => {
  it('createCourse', () => {
    return courseDao.createCourse({
      title: 'cs1234-test'
    }).then(course =>
       expect(course.title)
        .toBe('cs1234-test'))
  })
})

```

## Testing the retrieval from the database

```ts
it('findAllCourses', () => {
  return courseDao.findAllCourses()
    .then(courses =>
            expect(courses.length)
      .toBeGreaterThanOrEqual
        (COURSE_COUNT));
});

describe('findCourseById', () => {
  test('findCourseById', () => {
    return courseDao
      .createCourse(
        {title: 'cs-findCourseById'})
      .then(newCourse => courseDao
        .findCourseById(newCourse._id))
      .then(course => expect(course.title)
        .toBe('cs-findCourseById'))})})

```


## Useful resources
- [Testing asynchronous code](https://jestjs.io/docs/asynchronous)
- [Setup and teardown](https://jestjs.io/docs/setup-teardown)
- [Important functions](https://jestjs.io/docs/api)
- [Mock functions](https://jestjs.io/docs/mock-function-api)
