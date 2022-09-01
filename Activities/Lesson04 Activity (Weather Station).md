---
layout: lecture
title: Weather Station Observer Pattern Example
nav_exclude: true
---

This project contains starter code to demonstrate the *observer* design pattern. The starter code for this activity is located in
[week2-designpatterns-observer.zip]({{ site.baseurl }}{% link Activities/week2-designpatterns-observer.zip %})

To run it on your computer, run `npm install` to fetch the dependencies for the project, and then run
`ts-node src/WeatherStation.ts` (or `npm run demo`, if `ts-node` does not work), which should produce the following output:
```
Current conditions: 80F degrees and 65% humidity
Avg/max/min temperature = 80/80/0
Heat Index: 82.95535063710001
Forecast: Improving weather on the way!
Current conditions: 82F degrees and 70% humidity
Avg/max/min temperature = 81/82/0
Heat Index: 86.90123306385205
Forecast: Watch out for cooler, rainy weather
Current conditions: 78F degrees and 90% humidity
Avg/max/min temperature = 80/82/0
Heat Index: 83.64967139559604
Forecast: More of the same
```

As we discussed in class, there is a lot to be improved from this design. Working in your group,
modify this code so that it uses the observer pattern, with each of the various display classes as
the observers, and the `WeatherData` as the subject object.

A high-level sketch of this design is:
1. Create a `WeatherDataObserver` interface, which defines your `update` method
2. Create an `observers` array in `WeatherData` and helper methods to register and de-register observers. Add code to notify the observers of updates when the weather data updates.
3. Modify each of `CurrentConditionsDisplay`, `ForecastDisplay`, `HeatIndexDisplay` and `StatisticsDisplay` to be implementors of the new observer interface. These display classes should display their information whenever the weather data is updated.
4. Modify `WeatherStation`, so that it creates the `XXXDisplay`s, and subscribes them to the `WeatherData`
5. Update `WeatherData.measurementsChanged` to notify its observers of the update
6. Compare the output of your new program to the output you got by running the original version.  Are the lines printed in the same order?  Why or why not?
7. Can you modify the code so that the various `XXXDisplay` classes are all implementations of the same interface?  Why might or might not this be a good idea?

When you are done, run `npm run pack`  to create a zip archive with your code. (Do **NOT** say `npm pack`, since that creates a .tgz, not a .zip.)

This activity is based on the running example in Chapter 2 of "Head First Design Patterns, 2nd Edition" by Robson and Freeman.
